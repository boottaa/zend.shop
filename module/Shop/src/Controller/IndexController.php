<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Shop\Controller;

use Shop\Model\Categories;
use Shop\Model\Orders;
use Shop\Model\Goods;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $options, $goods, $orders, $categories;

    function __construct(array $options, Goods $goods, Orders $orders, Categories $categories)
    {
        $this->options = $options;
        $this->goods = $goods;
        $this->orders = $orders;
        $this->categories = $categories;
    }

    public function indexAction()
    {

        $where = [];
        $page = $this->params()->fromQuery('page');
        $id = $this->params()->fromRoute('id');

        if(!empty($id)){
            $where = ['id_category' => $id];
        }

        $categories = $this->categories->fetchAll()->setItemCountPerPage(100);
        $goods_pagination = $this->goods->fetchAll($where)->setItemCountPerPage(10);
        $goods_pagination->setCurrentPageNumber($page);

        foreach ($goods_pagination as &$item){
            if( empty($item['image']) ){
                $item['image'] = 'no_image.png';
            }
            $item['image'] = '/static/images/' . $item['image'];
        };

        return new ViewModel([ 'items' =>  $goods_pagination, 'categories' => $categories]);
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
