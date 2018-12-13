<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 07.03.18
 * Time: 15:00
 */
namespace Application\Model;

use Zend\InputFilter\InputFilter;

class Menu extends Base
{
    protected $table = 'menu';

    protected $data = [
        'id' => null,
        'level' => 0,
        'parent_level' => 0,
        'alias'  => null,
        'title'  => null,
        'id_page' => 0,
        'status' => 1,
        'date_time' => null,
        'is_visible' => null,
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
                'name'     => 'level',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'status',
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