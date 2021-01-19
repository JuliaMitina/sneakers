<?php
//ключи-это url адреса/маршруты
return [
    '' => [
        'controller' => 'main', //название страницы
        'action' => 'index' //название метода в контроллере
    ],
    'catalogue' => [
        'controller' => 'catalogue',
        'action' => 'index'
    ],
     'catalogue/adidas' => [
        'controller' => 'catalogue',
        'action' => 'adidas'
    ],
    'catalogue/nike' => [
        'controller' => 'catalogue',
        'action' => 'nike'
     ],
    'entrance' => [
        'controller' => 'entrance',
        'action' => 'index'
    ],
    'entrance/checkuser' => [
        'controller' => 'entrance',
        'action' => 'checkuser'
    ],
    'entrance/registration' => [
        'controller' => 'entrance',
        'action' => 'registration'
    ],
    'catalogue/add_to_cart' => [
        'controller' => 'catalogue',
        'action' => 'add_to_cart'
    ],
    'cart' => [
        'controller' => 'cart',
        'action' => 'index'
    ],


    // 'catalogue/get_client_cart' => [
    //     'controller' => 'catalogue',
    //     'action' => 'get_client_cart'
    // ],
    // 'catalogue/delete_from_cart' => [
    //     'controller' => 'catalogue',
    //     'action' => 'delete_from_cart'
    // ],
    // 'catalogue/checkout' => [
    //     'controller' => 'catalogue',
    //     'action' => 'checkout'
    // ],
    // 'catalogue/get_client_orders' => [
    //     'controller' => 'catalogue',
    //     'action' => 'get_client_orders'
    // ],

    // 'contacts' => [
    //     'controller' => 'contacts',
    //     'action' => 'index'
    // ]
    
];