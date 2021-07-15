let list = [{
        icon: 'mdi-view-dashboard',
        title: 'dashboard',
        to: '/',
    },
    {
        icon: 'mdi-account',
        title: 'user',
        to: '/profile',
    },
    {
        title: 'home_page',
        icon: 'mdi-page-previous',
        to: '/home_page',
        children: [
            // {
            //     title: 'view',
            //     icon: 'fas fa-eye',
            //     to: '',
            //     group: 'home_page'
            // },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'home_page'
            },
        ]
    },
    {
        title: 'about_page',
        icon: 'mdi-information-outline',
        to: '/about_page',
        children: [
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'about_page'
            },
        ]
    },
    {
        title: 'items',
        icon: 'mdi-sitemap',
        to: '/items',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'items'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'items'
            },
        ]
    },
    {
        title: 'accessors',
        icon: 'mdi-briefcase-plus-outline',
        to: '/accessors',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'accessors'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'accessors'
            },
        ]
    },
    {
        title: 'categories',
        icon: 'mdi-format-list-bulleted-type',
        to: '/categories',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'categories'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'categories'
            },
        ]
    },
    {
        title: 'countries',
        icon: 'mdi-map-marker',
        to: '/countries',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'countries'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'countries'
            },
        ]
    },
    {
        title: 'cities',
        icon: 'mdi-map-marker',
        to: '/cities',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'cities'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'cities'
            },
        ]
    },
    // {
    //     title: 'types',
    //     icon: 'mdi-format-font',
    //     to: '/types',
    //     children: [{
    //             title: 'view',
    //             icon: 'fas fa-eye',
    //             to: '',
    //             group: 'types'
    //         },
    //         {
    //             title: 'create',
    //             icon: 'fas fa-plus',
    //             to: 'form',
    //             group: 'types'
    //         },
    //     ]
    // },
    {
        title: 'customers',
        icon: 'mdi-face-agent',
        to: '/customers',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'customers'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'customers'
            },
        ]
    },
    {
        title: 'gardners',
        icon: 'mdi-tractor',
        to: '/gardners',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'gardners'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'gardners'
            },
        ]
    },
    // {
    //     title: 'orders',
    //     icon: 'mdi-order-bool-descending-variant',
    //     to: '/orders',
    //     children: [{
    //             title: 'view',
    //             icon: 'fas fa-eye',
    //             to: '',
    //             group: 'orders'
    //         },
    //         {
    //             title: 'create',
    //             icon: 'fas fa-plus',
    //             to: 'form',
    //             group: 'orders'
    //         },
    //     ]
    // },
    // {
    //     title: 'tasks',
    //     icon: 'mdi-file-tree',
    //     to: '/tasks',
    //     children: [{
    //             title: 'view',
    //             icon: 'fas fa-eye',
    //             to: '',
    //             group: 'tasks'
    //         },
    //         {
    //             title: 'create',
    //             icon: 'fas fa-plus',
    //             to: 'form',
    //             group: 'tasks'
    //         },
    //     ]
    // },
    {
        title: 'task_confirmations',
        icon: 'mdi-ticket-confirmation-outline',
        to: '/task_confirmations',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'task_confirmations'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'task_confirmations'
            },
        ]
    },
    {
        title: 'payments',
        icon: 'mdi-credit-card-outline',
        to: '/payments',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'payments'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'payments'
            },
        ]
    },
    // {
    //     title: 'taxes',
    //     icon: 'mdi-sale',
    //     to: '/taxes',
    //     children: [{
    //             title: 'view',
    //             icon: 'fas fa-eye',
    //             to: '',
    //             group: 'taxes'
    //         },
    //         {
    //             title: 'create',
    //             icon: 'fas fa-plus',
    //             to: 'form',
    //             group: 'taxes'
    //         },
    //     ]
    // },
    {
        title: 'posts',
        icon: 'mdi-note-text',
        to: '/posts',
        children: [{
                title: 'view',
                icon: 'fas fa-eye',
                to: '',
                group: 'posts'
            },
            {
                title: 'create',
                icon: 'fas fa-plus',
                to: 'form',
                group: 'posts'
            },
        ]
    },
    

];
export default list;