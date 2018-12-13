<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:00
 */
namespace Shop\Model;

use Zend\InputFilter\InputFilter;

class Orders extends Base
{
    protected $table = 'orders';

    protected $data = [
        'id' => null,
        'id_user' => 0, //Если пользоваетлье зарегестрирован в ином случае пишем в about_user
        'about_user' => '', //Если пользователь не зарегестрирован то информация по пользователю Email телефон и тд попадает сюда в json
        'address' => '', // Адрес доставки получения
        'goods' => '', // id товаров и их количество в json масиве
        'total_price' => '', // Сумма заказа
        'date_time' => null,
        'is_deleted' => null,
        'status' => 1,
    ];

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name'     => 'id_user',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'address',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 200,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'goods',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'about_user',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                        ),
                    ),
                ),
            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}