import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes : [
        {
            path: '/',
            component: () => import('../components/invoices/Index.vue')
        },
        {
            path: '/newinvoice',
            component: () => import('../components/invoices/NewInvoice.vue')
        },
        {
            path: '/show-invoice/:id',
            component: () => import('../components/invoices/ShowInvoice.vue'),
            props : true
        },
        {
            //renvoie le composant PageNotFound pour tous les url
            //qui n'existe pas parmi nos routes
            path: '/:pathMatch(.*)*',
            component: () => import('../views/PageNotFound.vue')
        },

    ]
});

export default router;
