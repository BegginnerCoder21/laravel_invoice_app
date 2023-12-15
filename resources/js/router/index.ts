import { createRouter, createWebHistory } from 'vue-router';


const routes = [
    {
      path: '/',
      name: 'exemple',
      component: () => import('../components/exemple.vue')
    },

    {
        path: '/:pathMatch(.*)*',
        name: 'example',
        component: () => import('../components/example.vue')
    },
     ];
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
