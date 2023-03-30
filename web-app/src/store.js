import { defineStore } from 'pinia';
import axios from 'axios';


const URL = 'http://localhost:8000/api/auth';

let  headers = {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
    };

export const useMainStore = defineStore({
  id: 'main',
  state: () => ({ 
    count: 0, 
    operations: [], 
    done:false,
    token: ''
  }),
  getters: {
  },
  actions: {
    async login() {
      try{
        const response = await axios.post(`${URL}/login`, {
              email: "user@email.com",
              password: "12345",
              remember_me: true
            }, 
            { headers }
        );

        this.token = `${response.data.token_type} ${response.data.access_token}`;
        return this.token 
      } catch (error) {
        console.error(error);
      }
    },

    async createOperation(data) {
      try{
        headers['Authorization'] = this.token;
        const response = await axios.post(`${URL}/operations`, {
              pair: data.pair,
              type_operation: data.type_operation,
              amount: data.amount,
              volumen: data.volumen
            }, 
            { headers }
        );

        this.done = response.data.status == 1;
        return this.done 
      } catch (error) {
        console.error(error);
      }
    },

    async listOperations() {
      try{
        headers['Authorization'] = this.token;
        const response = await axios.get(`${URL}/operations`,  {headers});

        this.operations = response.data.data.data;
        return this.operations;
      } catch (error) {
        console.error(error);
      }
    },

    async deleteOperation(id) {
      try{
        headers['Authorization'] = this.token;
        const response = await axios.delete(`${URL}/operations/${id}`, {headers});
        this.operations = this.operations.filter(item => item.id != id);
       
        return this.operations;
      } catch (error) {
        console.error(error);
      }
    },
  },
  persist: true,
})