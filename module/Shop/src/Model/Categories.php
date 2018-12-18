<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:00
 */
namespace Shop\Model;

use Zend\InputFilter\InputFilter;

class Categories extends Base
{
    protected $table = 'categories';

    protected $data = [
        'id' => null,
        'title' => '', //Название
        'description' => '', //Описание

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


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}