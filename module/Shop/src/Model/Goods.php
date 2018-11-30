<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:00
 */
namespace Application\Model;

use Zend\InputFilter\InputFilter;

class Goods extends Base
{
    protected $table = 'goods';

    protected $data = [
        'id' => null,
        'id_user' => 0, //Id пользователя который добавил товар если ноль то товар добавился автоматичиски через систему интеграции.
        'id_category' => 1,
        'title' => '', //Название товара
        'description' => '', //Описание товара
        'price' => '', //цена товара
        'keywords' => '', //Теги для SEO
        'currency' => '', //Валюта в которой указана цена.
        'date_time' => null,
        'is_deleted' => null,

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