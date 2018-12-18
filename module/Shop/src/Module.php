<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Shop;


use Interop\Container\ContainerInterface;
use Shop\Helpers\Cart;
use Shop\Model\Categories;
use Shop\Model\Goods;
use Shop\Model\Orders;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Log\Logger;
use Zend\ModuleManager\Feature\ConfigProviderInterface;


class Module implements ConfigProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'options' => function( $container )
                {
                    /**
                     * @var  ContainerInterface $container
                     */
                    return [
                        'debug' => ($container->get('config'))['isDebug'],
                        'shop' => ($container->get('config'))['shop'],
                    ];
                }
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\IndexController::class => function ($container) {
                    /**
                     * @var  ContainerInterface $container
                     */
                    $adapter = $container->get(AdapterInterface::class);
                    $logger = $container->get(Logger::class);
                    $options = $container->get('options');

                    $goods = new Goods($adapter, $logger, $options);
                    $orders = new Orders($adapter, $logger, $options);
                    $categories = new Categories($adapter, $logger, $options);

                    return new Controller\IndexController($options, $goods, $orders, $categories);
                },
                Controller\CartController::class => function ($container) {
                    /**
                     * @var  ContainerInterface $container
                     */
                    $adapter = $container->get(AdapterInterface::class);
                    $logger = $container->get(Logger::class);
                    $isDebug = ($container->get('config'))['isDebug'];
                    $goods = new Goods($adapter, $logger, $isDebug);
                    $orders = new Orders($adapter, $logger, $isDebug);

                    return new Controller\CartController($goods, $orders, new Cart());
                },
            ]


        ];
    }
}
