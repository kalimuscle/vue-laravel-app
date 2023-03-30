<script>
import { ref } from 'vue';
import { useMainStore } from '../store';
import router from '../router';

export default {
  
  data() {
    return {
      store: useMainStore()
    }
  },
  methods: {
    login() {
      this.store.login();
      router.push('/new');
      
    }
  }
}
</script>

<template>
  <div class="flex justify-center items-center h-screen">
    <button @click="login" class="px-4 py-2 rounded-md bg-blue-500 text-white">
      Login
    </button>
  </div>
</template>
