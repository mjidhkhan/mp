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
}