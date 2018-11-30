<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\Base;
use Application\Model\Users;
use Auth\Helpers\IPAPI;
use Auth\Helpers\Session;
use Auth\Helpers\UserInfo;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var Users
     */
    private $users;
    function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

}
