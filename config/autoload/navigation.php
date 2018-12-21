<?php
/**
 * Created by PhpStorm.
 * User: b.akhmedov
 * Date: 07.11.18
 * Time: 10:40
 */
//https://docs.zendframework.com/tutorials/navigation/
//$this->navigation('Zend\Navigation\Admin')->menu()->setUlClass('widget widget-menu unstyled')
return [
    'default' => [
        [
            'label' => 'Главная',
            'route' => 'home',
            'class' => 'nav-link',
        ],
        [
            'label' => 'Витрина',
            'route' => 'shop',
            'class' => 'nav-link',
        ],
        [
            'label' => 'Корзина',
            'route' => 'cart',
            'class' => 'nav-link',
        ]
    ],

];