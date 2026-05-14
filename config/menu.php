<?php

return [
    'entities' => [
        'users' => ['id' => 'users', 'to' => '/users', 'text' => 'Users', 'icon' => 'UserMultiple'],
    ],

    'apps' => [
        'sales' => [
            'id' => 'sales', 'to' => '/sales', 'text' => 'Sales', 'icon' => 'Store04',
            'subPages' => [
                'list' => ['id' => 'list', 'to' => '/sales/list', 'text' => 'List', 'icon' => 'ProductLoading'],
                'view' => ['id' => 'view', 'to' => '/sales/view', 'text' => 'View', 'icon' => 'DeliveryView01'],
            ],
        ],
        'customer' => [
            'id' => 'customer', 'to' => '/customer', 'text' => 'Customer', 'icon' => 'UserMultiple',
            'subPages' => [
                'list' => ['id' => 'list', 'to' => '/customer/list', 'text' => 'List', 'icon' => 'UserList'],
                'edit' => ['id' => 'edit', 'to' => '/customer/edit', 'text' => 'Edit', 'icon' => 'EditUser02'],
                'view' => ['id' => 'view', 'to' => '/customer/view', 'text' => 'View', 'icon' => 'UserAccount'],
            ],
        ],
        'products' => [
            'id' => 'products', 'to' => '/products', 'text' => 'Products', 'icon' => 'PackageOpen',
            'subPages' => [
                'list' => ['id' => 'list', 'to' => '/products/list', 'text' => 'List', 'icon' => 'PackageSearch'],
                'edit' => ['id' => 'edit', 'to' => '/products/edit', 'text' => 'Edit', 'icon' => 'Edit02'],
            ],
        ],
        'projects' => [
            'id' => 'projects', 'to' => '/projects', 'text' => 'Projects', 'icon' => 'DashboardSquare03',
            'subPages' => [
                'board' => ['id' => 'board', 'to' => '/projects/board', 'text' => 'Board', 'icon' => 'DashboardSquareSetting'],
                'list' => ['id' => 'list', 'to' => '/projects/list', 'text' => 'List', 'icon' => 'ListView'],
                'grid' => ['id' => 'grid', 'to' => '/projects/grid', 'text' => 'Grid', 'icon' => 'GridView'],
            ],
        ],
        'invoices' => [
            'id' => 'invoices', 'to' => '/invoices', 'text' => 'Invoices', 'icon' => 'Invoice03',
            'subPages' => [
                'list' => ['id' => 'list', 'to' => '/invoices/list', 'text' => 'List', 'icon' => 'Invoice02'],
                'view' => ['id' => 'view', 'to' => '/invoices/view', 'text' => 'View', 'icon' => 'Invoice04'],
            ],
        ],
        'mail' => [
            'id' => 'mail', 'to' => '/mail', 'text' => 'Mail', 'icon' => 'Mail01',
            'subPages' => [
                'inbox' => ['id' => 'inbox', 'to' => '/mail/inbox', 'text' => 'Inbox', 'icon' => 'MailOpen01'],
                'new' => ['id' => 'new', 'to' => '/mail/new', 'text' => 'New', 'icon' => 'MailEdit02'],
            ],
        ],
        'chat' => ['id' => 'chat', 'to' => '/chat', 'text' => 'Chat', 'icon' => 'Message02'],
    ],

    'pagesExamples' => [
        'list' => [
            'id' => 'list', 'to' => '/list', 'text' => 'Lists', 'icon' => 'LeftToRightListBullet',
            'subPages' => [
                'example1' => ['id' => 'example1', 'to' => '/products/list', 'text' => 'Example 1', 'icon' => 'LeftToRightListBullet'],
                'example2' => ['id' => 'example2', 'to' => '/sales/view', 'text' => 'Example 2', 'icon' => 'LeftToRightListBullet'],
            ],
        ],
        'grid' => [
            'id' => 'grid', 'to' => '/grid', 'text' => 'Grids', 'icon' => 'GridView',
            'subPages' => [
                'example1' => ['id' => 'example1', 'to' => '/projects/grid', 'text' => 'Example 1', 'icon' => 'GridView'],
            ],
        ],
        'edit' => [
            'id' => 'edit', 'to' => '/edit', 'text' => 'Edit', 'icon' => 'PencilEdit02',
            'subPages' => [
                'example1' => ['id' => 'example1', 'to' => '/customer/edit', 'text' => 'Example 1', 'icon' => 'PencilEdit02'],
                'example2' => ['id' => 'example2', 'to' => '/products/edit', 'text' => 'Example 2', 'icon' => 'PencilEdit02'],
            ],
        ],
        'login' => ['id' => 'login', 'to' => '/login', 'text' => 'Login', 'icon' => 'Login03'],
        'signup' => ['id' => 'signup', 'to' => '/signup', 'text' => 'Signup', 'icon' => 'AddTeam'],
        'notFound' => ['id' => 'notFound', 'to' => '/notFound', 'text' => '404 Not Found', 'icon' => 'HelpSquare'],
        'underConstruction' => ['id' => 'underConstruction', 'to' => '/under-construction', 'text' => 'Under Construction', 'icon' => 'DashboardBrowsing'],
    ],
];
