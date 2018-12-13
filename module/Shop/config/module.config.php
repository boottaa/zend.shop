<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Shop;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;


return [
    'router' => [
        'routes' => [
            'shop' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/_shop[/:id]',
                    'constraints' => [
                        'id' => '[0-9A-z]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cart' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/_cart[/:action][/:id]',
                    'constraints' => [
                        'action' => '[0-9A-z]+',
                        'id' => '[0-9A-z]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CartController::class,
                        'action'     => 'cart',
                    ],
                ],
            ],



            'product' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/_product[/:id]',
                    'constraints' => [
                        'id' => '[0-9A-z]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'product',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
