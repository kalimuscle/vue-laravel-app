<script>
import { computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useMainStore } from '../store';
import router from '../router';

export default {
  
  data() {
    return {
      pair: '',
      type_operation: '',
      amount: null,
      volumen: null,
      store: useMainStore()
    }
  },
  methods: {
    async submit() {
      // Validación de campos
      if (!this.pair || !this.type_operation || !this.amount || !this.volumen) {
        alert('Todos los campos son obligatorios');
        return;
      }
      
      if (isNaN(this.amount) || isNaN(this.volumen)) {
        alert('Los campos Cantidad y Volumen deben ser números');
        return;
      }
      
      // Aquí puedes realizar la lógica para enviar la operación a través de una API o guardarla en una base de datos
      console.log('Operación enviada:', this.pair, this.type_operation, this.amount, this.volumen);

      const data = {
        pair: this.pair,
        type_operation: this.type_operation,
        amount: this.amount,
        volumen: this.volumen
      }

      await this.store.createOperation(data);

      
      // Reiniciar los valores de los campos
      this.pair = '';
      this.type_operation = '';
      this.amount = null;
      this.volumen = null;
        
      router.push('/operations');
      alert('Trading successful');
    
      
      
    }
  }
}
</script>

<template>
    <div class="flex justify-center items-center">
        <form @submit.prevent="submit" class="bg-white p-6 rounded-lg border shadow-md">
            <h2 class="text-black text-2xl mb-6">New Operation</h2>
            <div class="mb-4">
                <label for="pair" class="block text-left text-black">Pair:</label>
                <select name="pair" id="pair" v-model="pair" class="w-full rounded-md border shadow-md px-4 py-2">
                    <option value="">Choose pair</option>
                    <option value="BTC/USDT">BTC/USDT</option>
                    <option value="ETH/USDT">ETH/USDT</option>
                    <option value="ADA/USDT">ADA/USDT</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="type_operation" class="block text-left text-black">Operation:</label>
                <select name="type_operation" id="type_operation" v-model="type_operation" class="w-full rounded-md border shadow-md px-4 py-2">
                    <option value="">Choose operation market</option>
                    <option value="buyMarket">Buy by market</option>
                    <option value="sellMarket">Sell by market</option>
                    <option value="buyLimit">Buy limit</option>
                    <option value="sellLimit">Sell limit</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-left text-black">Amount:</label>
                <input type="number" name="amount" id="amount" v-model="amount" step="0.01" min="0" required class="w-full rounded-md border shadow-md px-4 py-2">
            </div>
            <div class="mb-4">
                <label for="volumen" class="block text-left text-black">Volume:</label>
                <input type="number" name="volumen" id="volumen" v-model="volumen" step="0.01" min="0" required class="w-full rounded-md border shadow-md px-4 py-2">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Trade</button>
        </form>
    </div>
  </template>

  