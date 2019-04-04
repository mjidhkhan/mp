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

    /**
     * Add new Stock Item
     */
    public function addItemInStock($data){
        
        
        $this->sql = $this->db->prepare('INSERT INTO  ingredients (ingredient_name, quantity, 
        reorder_level, notice_level, units) 
        VALUES (:ingredient_name, :quantity, :reorder_level,:notice_level, :units)');
            try {
                $this->db->beginTransaction();
                $this->sql->execute(array(':ingredient_name' => $data['item-name'],
                                    ':quantity' => $data['item-quantity'],
                                    ':reorder_level' => $data['reorder-level'],
                                    ':notice_level'=> $data['notice-level'],
                                    ':units'=> $data['item-unit'] ));
                $this->db->commit();
                $this->result = $this->db->lastInsertId();
                if ( $this->result > 0) {
                    $message = $data['']. ' added successfully</br>';
                    Session::setFlash($message, 'success');
                }

            } catch (PDOException $e) {
                $this->db->rollback();
                $message = 'Error!: '.$e->getMessage().'</br>';
                Session::setFlash($message, 'danger');

                return false;
            }
    }

    public function getStock(){
        $this->sql = $this->db->prepare('SELECT * FROM ingredients');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }
       
        return $this->result;
    }

    public function removeItemFromStock($data){
        $this->sql = $this->db->prepare('DELETE  FROM ingredients WHERE id=:id');
        $this->result = $this->sql->execute(array(':id'=>$data['id']));
        return $this->result;
    }

    public function updateInStockItems($data){
        
        $this->sql = $this->db->prepare('UPDATE  ingredients  SET ingredient_name=:ingredient_name, 
        quantity=:quantity, reorder_level=:reorder_level, 
        notice_level=:notice_level, units=:units WHERE id=:id');
        $this->result = $this->sql->execute(array(':id'=>$data['id'], ':ingredient_name'=>$data['data'][0],  ':quantity'=>$data['data'][1],
                                                  ':reorder_level'=>$data['data'][2], ':notice_level'=>$data['data'][3], 
                                                  ':units'=>$data['data'][4]));

        return $this->result;
    }

    public function getOutOfStock(){

        $this->sql = $this->db->prepare('SELECT * FROM ingredients WHERE quantity < reorder_level');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }
       
        return $this->result;

    }
}
