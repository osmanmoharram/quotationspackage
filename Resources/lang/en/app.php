<?php

return [
    'doquot' => [
        'title' => 'DOQuot Package',
        'dashboard' => 'DOQuot Dashbord',
    ],

    'admin' => [
        'main' => 'DOQuot',
        'index' => 'DOQuot'
    ],

    'quotations' => [
        'title' => 'Quotations',
        'create' => 'Create Quotation',
        'add' => 'Add New Quotation',
        'show' => 'Show Quotation No.',
        'edit' => 'Edit Quotation No.',
        'update' => 'Update',
        'fields' => [
            'serial_no' => 'Serial No',
            'client' => 'Client',
            'tax' => 'Tax Rate',
            'total' => 'Total',
            'validity' => 'Validity',
            'created_at' => 'Created At',
            'status' => 'Status',
            'actions' => 'Actions',
            'rejection_reason' => 'Rejection Reason',
            'products' => [
                'title' => 'Products',
                'number' => 'Number of Products',
                'unit_price' => 'Unit Price',
                'quantity' => 'Quantity',
                'total' => 'Total'
            ],
        ],
    ],

    'settings' => [
        'title' => 'Settings',
        'fields' => [
            'require_approval_amount' => 'Require Admin Approval Amount'
        ]
    ],

    'acl' => [
        'admin' => [
            'main' => 'DOQuot',
            'index' => 'DOQuot'
        ],
    ],

    'widgets' => [
        'dashboard' => [
            'mainwidget' => 'Main DOQuot Widget'
        ]
    ],
];
