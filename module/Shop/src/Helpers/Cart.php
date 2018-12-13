<?php
namespace Shop\Helpers;

class Cart{

    private $goods = [], $total_price = 0;

    function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->goods = &$_SESSION['goods'];
        $this->total_price = &$_SESSION['total_price'];
    }


    function add($id, $data){
        if(empty($this->goods[$id])){
            $data['count'] = '1';
            $this->goods[$id] = $data;
        }else{
            $this->goods[$id]['count']++;
        }

        $this->total_price += $data['price'];

        return true;
    }

    function delete($id){
        if (isset($this->goods[$id])) {
            $this->total_price -= ($this->goods[$id]['price'] * $this->goods[$id]['count']);
            unset($this->goods[$id]);
            return true;
        }else{
            return false;
        }
    }

    function recount($id, $count){
        if (isset($this->goods[$id])) {
            //Сначала вычитаем стоимость этого товара потому что нужно пересчитать
            $this->total_price -= ($this->goods[$id]['price'] * $this->goods[$id]['count']);
            if ($this->goods[$id]['count'] < $count) {
                $this->goods[$id]['count'] = $count;
                $this->total_price += ($this->goods[$id]['price'] * $count);
            } elseif ($this->goods[$id]['count'] > $count) {
                $this->goods[$id]['count'] = $count;
                $this->total_price -= ($this->goods[$id]['price'] * $count);
            } elseif ($count == "0") {
                $this->delete($id);
            }

            return true;
        }else{
            return false;
        }
    }

    function clear(){
        $this->goods = null;
        $this->total_price = null;
    }

    function getCart(){
        return $this->goods;
    }

    function getTotlaPrice(){
        return $this->total_price;
    }
}