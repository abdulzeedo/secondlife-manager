const routes = [
    {
        path: '/consistency-check/:id',
        component: () => import('./modal-phone-dialog.vue'),
        props: true,
        children: [
            {
                name: 'modal-content-phone',
                path: '',
                component: () => import('./modal-content/modal-content-phone.vue'),
                props: true,
            },
            {
                name: 'modal-content-phone-return',
                path: 'add-return',
                component: () => import('./modal-content/modal-content-phone-return.vue'),
                props: true,
            },
        ]
    },
];
export default routes
