import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes : [
        {
            path: '/',
            component: () => import('../components/invoices/Index.vue')
        },
        {
            path: '/:pathMatch(.*)*',
            component: () => import('../views/PageNotFound.vue')
        },

    ]
});

export default router;
