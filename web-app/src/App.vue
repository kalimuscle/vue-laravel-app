<script setup>
  import HelloWorld from './components/HelloWorld.vue';
  
  import { useMainStore } from './store';

  let store = useMainStore();
</script>

<template >
  <router-view></router-view>
</template>

