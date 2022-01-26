<?php

return [
    [
        'key' => 'doquot',
        'name' => 'doquot::app.admin.main',
        'route' => 'admin.doquot.index',
        'sort' => '3',
        'icon-class' => 'dashboard-icon',
    ],
    [
        'key' => 'doquot.index',
        'name' => 'doquot::app.admin.index',
        'route' => 'admin.doquot.index',
        'sort' => '1',
        'icon-class' => '',
    ],
    [
        'key' => 'doquot.quotations',
        'name' => 'doquot::app.quotations.title',
        'route' => 'admin.doquot.quotations.index',
        'sort' => '2',
        'icon-class' => '',
    ],
    [
        'key' => 'doquot.settings',
        'name' => 'doquot::app.settings.title',
        'route' => 'admin.doquot.settings.index',
        'sort' => '4',
        'icon-class' => '',
    ],
];
