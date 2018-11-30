<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Method;
use Zend\ServiceManager\Factory\InvokableFactory;

$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

return [
    'console' => [
        'router' => [
            'routes' => [
                'user-reset-password' => [
                    'options' => [
                        'route'    => 'user resetpassword [--verbose|-v] <userEmail>',
                        'defaults' => [
                            'controller' => Application\Controller\Index::class,
                            'action'     => 'resetpassword',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
