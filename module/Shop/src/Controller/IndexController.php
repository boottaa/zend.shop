<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Shop\Controller;

use Shop\Model\Orders;
use Shop\Model\Goods;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $options, $goods, $orders;

    function __construct(array $options, Goods $goods, Orders $orders)
    {
        $this->options = $options;
        $this->goods = $goods;
        $this->orders = $orders;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page');

        $goods_pagination = $this->goods->fetchAll()->setItemCountPerPage(10);
        $goods_pagination->setCurrentPageNumber($page);

        foreach ($goods_pagination as &$item){
            if( empty($item['image']) ){
                $item['image'] = 'no_image.png';
            }
            $item['image'] = '/static/images/' . $item['image'];
        };

        return new ViewModel([ 'items' =>  $goods_pagination]);
    }

    public function productAction()
    {

        $id = $this->params()->fromRoute('id');
        $product = [];

        try{
            $product = $this->goods->getOnly(['id' => $id]);
            if (empty($product['image'])) {
                $product['image'] = 'no_image.png';
            }
            $product['image'] = '/static/images/' . $product['image'];

        }catch (\Exception $e){
            $this->getResponse()->setStatusCode(404);
        }

        return new ViewModel(['item' => $product]);
    }
}
