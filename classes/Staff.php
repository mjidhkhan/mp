<?php

class Staff extends Model
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


    public function newStaffMember($data){
        $this->sql = $this->db->prepare('SELECT * FROM `users` WHERE email:email');
        $this->sql->execute(array(':email'=>$data['']));
        $count = $this->sql->rowCount();
        if ($count > 0) {
           return 'UF';
        }else{
            $this->sql = $this->db->prepare('INSERT INTO  users (fullname, username, 
        email, hashed_password, status, image) 
        VALUES (:fullname, :username, :email,:hashed_password, :status, :image)');
            try {
                $this->db->beginTransaction();
                $this->sql->execute(array(':fullname' => $data['empName'],
                                    ':username' => $data['empUname'],
                                    ':email' => $data['empEmail'],
                                    ':hashed_password'=> $hashed_password,
                                    ':status'=> $data['item-unit'], ':image'=>$data['file']));
                $this->db->commit();
                $this->result = $this->db->lastInsertId();
                if ( $this->result > 0) {
                    $this->result =true;
                }

            } catch (PDOException $e) {
                $this->db->rollback();
                return false;
            }
        }

        return $this->result;
    }
}