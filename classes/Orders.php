<?php
class Orders extends Model
{
    private $result;
    private $sql;
    private $Todays_Orders;
    private $Future_Orders;
    private $Purchase_Orders;

    public function __construct()
    {
        parent::__construct();
    }

   
    public function orderForToday() {
        return array(1,2,3,4);
    }
    public function orderForSevenDays() {
        return array(1,2,3,4);
    }
    public function pendingOrderForToday() {
        return array(1,2,3,4);
    }
    public function completedOrdersForToday() {
        return array(1,2,3,4);
    }
}