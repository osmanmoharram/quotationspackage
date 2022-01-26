<?php

return [
    [
        'key' => 'doquot',
        'name' => 'doquot::app.acl.admin.main',
        'route' => 'admin.doquot.index',
        'sort' => 3,
    ],
    [
        'key' => 'doquot.index',
        'name' => 'doquot::app.acl.admin.index',
        'route' => 'admin.doquot.index',
        'sort' => 1,
    ],
    [
        'key' => 'doquot.quotations',
        'name' => 'doquot::app.acl.quotations.index',
        'route' => 'admin.doquot.quotations.index',
        'sort' => '2'
     ],
     [
        'key' => 'doquot.quotations.create',
        'name' => 'doquot::app.acl.quotations.create',
        'route' => 'admin.doquot.quotations.create',
        'sort' => '1'
     ],
     [
        'key' => 'doquot.quotations.edit',
        'name' => 'doquot::app.acl.quotations.edit',
        'route' => 'admin.doquot.quotations.edit',
        'sort' => '2'
     ],
     [
        'key' => 'doquot.quotations.delete',
        'name' => 'doquot::app.acl.quotations.delete',
        'route' => 'admin.doqout.quotations.delete',
        'sort' => '3'
     ],
     [
        'key' => 'doquot.settings',
        'name' => 'doquot::app.acl.settings.index',
        'route' => 'admin.doquot.settings.index',
        'sort' => '4'
     ],
];
