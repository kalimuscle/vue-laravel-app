import {createRouter, createWebHistory} from 'vue-router';
import HelloWorld from '../components/HelloWorld.vue';
import NewOperation from '../components/NewOperation.vue';
import ListOperation from '../components/ListOperation.vue'

const routes = [
    { 
        path: '/',
        name: 'HelloWorld',
        component: HelloWorld 
    },
    { 
        path: '/new',
        name: 'NewOperation',
        component: NewOperation 
    },
    { 
        path: '/operations', 
        name: 'Operations',
        component: ListOperation 
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
  
 