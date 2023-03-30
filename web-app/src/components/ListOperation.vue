<script>
import { computed } from 'vue';
import { useMainStore } from '../store';

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
  mounted() {
      this.operations();
  },
  methods: {
    async operations() {
      await this.store.listOperations();
    },  
    async deleteOperation(id) {
      await this.store.deleteOperation(id);
    },
 }
}
</script>

<template>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th class="px-4 py-2">Pair</th>
          <th class="px-4 py-2">Tipo de operacion</th>
          <th class="px-4 py-2">Cantidad</th>
          <th class="px-4 py-2">Volumen</th>
          <th class="px-4 py-2">Fecha</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(operation, index) in this.store.operations" :key="index" :class="index % 2 == 0 ? 'bg-white' : 'bg-gray-100'">
          <td class="border text-black px-4 py-2">{{ operation.pair }}</td>
          <td class="border text-black px-4 py-2">{{ operation.type_operation }}</td>
          <td class="border text-black px-4 py-2">{{ operation.amount }}</td>
          <td class="border text-black text-black px-4 py-2">{{ operation.volumen }}</td>
          <td class="border text-black px-4 py-2">{{ operation.created_at }}</td>
          <td class="border text-black px-4 py-2">
            <button @click="deleteOperation(operation.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
