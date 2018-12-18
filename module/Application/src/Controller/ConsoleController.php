<?php
namespace Application\Controller;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Mvc\Controller\AbstractActionController;
use RuntimeException;
use Zend\Console\Request as ConsoleRequest;

class ConsoleController extends AbstractActionController{

    /**
     * @var Adapter
     */
    private $db;

    function __construct(AdapterInterface $adapter)
    {
        $this->db = $adapter;
    }

    public function initAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console, and the user has not
        // tricked our application into running this action from a public web
        // server:
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console!');
        }

        echo "### START PREPARE DB ### \n";

        $sessions = "
        CREATE TABLE IF NOT EXISTS `sessions` (
          `id` INT(11) NOT NULL AUTO_INCREMENT,
          `id_user` INT(11) NOT NULL DEFAULT '0',
          `session` VARCHAR(45) NOT NULL DEFAULT '',
          `ip` VARCHAR(45) NOT NULL DEFAULT '0.0.0.0',
          `date_time` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00')
        ";

        $users = "
        CREATE TABLE IF NOT EXISTS `users` (
          `id` INT(11) NOT NULL AUTO_INCREMENT,
          `level` INT(11) NOT NULL DEFAULT '0' COMMENT 'level rights\n',
          `fname` VARCHAR(45) NULL DEFAULT NULL,
          `lname` VARCHAR(45) NULL DEFAULT NULL,
          `phone` VARCHAR(45) NULL DEFAULT NULL,
          `email` VARCHAR(45) NULL DEFAULT NULL,
          `password` VARCHAR(45) NULL DEFAULT NULL,
          `date_time` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
          `is_deleted` ENUM('0', '1') NOT NULL DEFAULT '0',
          `status` INT(11) NOT NULL DEFAULT '0')
        ";

        $orders = "
        CREATE TABLE IF NOT EXISTS `orders` (
          `id` INT NOT NULL AUTO_INCREMENT,
          `id_user` INT NULL COMMENT 'Если пользоваетлье зарегестрирован в ином случае пишем в about_user',
          `about_user` TEXT NULL COMMENT 'Если пользователь не зарегестрирован то информация по пользователю Email телефон и тд попадает сюда в json',
          `address` VARCHAR(255) NULL COMMENT 'Адрес доставки получения',
          `goods` TEXT NULL COMMENT 'id товаров и их количество в json масиве',
          `total_price` INT NOT NULL DEFAULT '0' COMMENT '// Сумма заказа',
          `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          `is_deleted` ENUM('0', '1') NOT NULL DEFAULT '0',
          `status` INT NOT NULL DEFAULT 0,
          PRIMARY KEY (`id`));
        ";

        $goods = "
        CREATE TABLE IF NOT EXISTS `goods` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `id_user` int(11) DEFAULT NULL COMMENT 'Id пользователя который добавил товар если ноль то товар добавился автоматически через систему интеграции.',
          `id_category` int(11) DEFAULT NULL,
          `title` varchar(200) NOT NULL COMMENT 'Название товара',
          `description_short` varchar(2000) DEFAULT NULL COMMENT 'Описание товаров краткое (в description и привью)',
          `description` text COMMENT 'Описание товара полное при просмогтре товаров',
          `price` decimal(13,2) NOT NULL DEFAULT '1.00' COMMENT 'цена товара',
          `old_price` decimal(13,2) DEFAULT NULL,
          `rating` float NOT NULL DEFAULT '0',
          `image` varchar(255) DEFAULT NULL,
          `keywords` varchar(255) DEFAULT NULL COMMENT 'Ключевые слова для поиска товара в Яндекс и гуггле',
          `article` int(11) DEFAULT NULL COMMENT 'Номер товара не обязателен ',
          `currency` varchar(5) NOT NULL DEFAULT 'RUB' COMMENT 'Валюта (рубль по умочанию)\n',
          `date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`))
        ";

        $pages = "
        CREATE TABLE IF NOT EXISTS `pages` (
          `id` INT NOT NULL AUTO_INCREMENT,
          `title` VARCHAR(255) NOT NULL,
          `description` VARCHAR(1000) NULL,
          `keywords` VARCHAR(1000) NULL,
          `alias` VARCHAR(100) NULL,
          `text` TEXT NOT NULL,
          `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          `is_deleted` ENUM('0', '1') NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`))
        ";

        $categories = "
        CREATE TABLE IF NOT EXISTS `categories` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `title` varchar(255) NOT NULL,
          `description` text NOT NULL,
          PRIMARY KEY (`id`))
        ";

        echo "### CREATED TABLE SESSIONS ### \n";
        $this->db->query($sessions, Adapter::QUERY_MODE_EXECUTE);
        echo "### CREATED TABLE USERS ###### \n";
        $this->db->query($users, Adapter::QUERY_MODE_EXECUTE);
        echo "### CREATED TABLE ORDERS ##### \n";
        $this->db->query($orders, Adapter::QUERY_MODE_EXECUTE);
        echo "### CREATED TABLE GOODS ###### \n";
        $this->db->query($goods, Adapter::QUERY_MODE_EXECUTE);
        echo "### CREATED TABLE PAGES ###### \n";
        $this->db->query($pages, Adapter::QUERY_MODE_EXECUTE);
        echo "### CREATED TABLE CATEGORIES ###### \n";
        $this->db->query($categories, Adapter::QUERY_MODE_EXECUTE);

        return "### END ### \n";
    }
}