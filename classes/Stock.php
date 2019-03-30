<?php

class Stock extends Model
{
    private $result;
    private $sql;
    private $qtyInstock;

    public function __construct()
    {
        parent::__construct();
    }
}
