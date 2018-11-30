<?php
namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use RuntimeException;
use Zend\Console\Request as ConsoleRequest;

class ConsoleController extends AbstractActionController{
    public function resetpasswordAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console, and the user has not
        // tricked our application into running this action from a public web
        // server:
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console!');
        }
        
        return "AAAAAA.\n";
        
    }
}