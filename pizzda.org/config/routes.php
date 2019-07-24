<?php

return array(
    // Товар:
    'pizza/([0-9]+)' => 'pizza/view/$1', // actionView в ProductController
    // Корзина:
    'cart/checkout' => 'cart/checkout', // actionAdd в CartController    
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController    
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController    
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
    'cart' => 'cart/index', // actionIndex в CartController
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet/password' => 'cabinet/password',
    'cabinet/orders' => 'cabinet/orders',
    'cabinet/order/view/([0-9]+)' => 'cabinetOrders/view/$1',
    'cabinet/order/cancel/([0-9]+)' => 'cabinetOrders/cancel/$1',
    'cabinet' => 'cabinet/index',
    // Управление товарами:    
    'admin/pizza/create' => 'adminPizza/create',
    'admin/pizza/update/([0-9]+)' => 'adminPizza/update/$1',
    'admin/pizza/delete/([0-9]+)' => 'adminPizza/delete/$1',
    'admin/pizza' => 'adminPizza/index',
    // Управление заказами:    
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    // Админпанель:
    'admin' => 'admin/index',
    // О магазине
    'contacts' => 'site/contact',
    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
