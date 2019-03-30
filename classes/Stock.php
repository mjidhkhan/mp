<?php

class Stock extends Model
{
    private $result;
    private $sql;
    private $qtyInstock;
    private $current_day;
    private $nextWeek;
    private $nextday;

    public function __construct()
    {
        parent::__construct();
        $date = date('Y-m-d'); // current date
        $this->current_day = $date;
        $this->nextday = strtotime(date('Y-m-d', strtotime($date)).' +1 day');
        $this->nextWeek = strtotime(date('Y-m-d', strtotime($date)).' +1 week');
    }

    public function ckeckOrdersForToday()
    {
        echo $this->current_day;
    }

    public function ordersForNextWeek()
    {
        echo $this->nextWeek;
    }

    public function ordersForNextDay()
    {
        echo $this->nextday;
    }

    public function checkLowStock()
    {
        $this->sql = $this->db->prepare('SELECT * FROM `ingredients` WHERE quantity BETWEEN reorder_level AND notice_level');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    public function checkOutOfStock()
    {
        $this->sql = $this->db->prepare('SELECT * FROM `ingredients` WHERE quantity < reorder_level');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    public function checkFutureOrders()
    {
    }
}
