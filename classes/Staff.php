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

    public function getDesignation(){
        $this->sql = $this->db->prepare('SELECT * FROM designation');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }
        return $this->result;
    }

    public function RegisterStaff($data, $filename)
    {
        //echo print_r($data);

        $username = trim($data['username']);
        $fullname = trim($data['fullname']);
        $password = trim($data['password']);
        $repeatpassword = trim($data['cpassword']);
        $email = trim($data['email']);
        if(array_key_exists('designation', $data)){
            $status =trim($data['designation']);
        }else{
            $status = 9; // this id for client
        }
       
        if ($username && $fullname && $password && $repeatpassword && $email) {
            if ($password == $repeatpassword) {
                $hashed_password = sha1($password);
                if ($this->UsernameLengthIsOK($username) &&
                    $this->PasswordLengthIsOK($password) &&
                    $this->UsernameIsOK($username)) {
                    $this->CreateNewUser($fullname,$username, $hashed_password, $email, $status, $filename);
                }
            } else {
                $message = 'Password donot match';
                Session::setFlash($message, 'danger');
            }
        } else {
            $message = 'Please fill in all fields.';
            Session::setFlash($message, 'danger');
        }
    }

    private function UsernameLengthIsOK($username)
    {
        $this->result = true;
        if (!strlen($username) > 30) {
            $message = 'Full name or username must be less then 30 characters';
            Session::setFlash($message, 'danger');
            $this->result = false;
        }

        return $this->result;
    }

    private function PasswordLengthIsOK($password)
    {
        $this->result = true;
        if (strlen($password) > 25 || strlen($password) < 6) {
            $message = 'Password must be between 6 to 25 characters';
            Session::setFlash($message, 'danger');
            $this->result = false;
        }

        return $this->result;
    }

    private function UsernameIsOK($username)
    {
        $this->result = true;
        $this->sql = $this->db->prepare('SELECT * FROM users WHERE username=:username');
        $this->sql->execute(array(':username' => $username));
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = false;
            $message = "The user with Name: $username already exist.";
            Session::setFlash($message, 'danger');
        }

        return $this->result;
    }

    private function CreateNewUser($fullname, $username, $hashed_password, $email, $status, $filename)
    {
        $this->sql = $this->db->prepare('INSERT INTO  users (fullname, username, email, hashed_password, status,image) 
                                    VALUES (:fullname, :username, :email, :hashed_password, :status, :image)');
        try {
            $this->db->beginTransaction();
            $this->sql->execute(array(':fullname' => $fullname, ':username' => $username,
                                    ':email' => $email, ':hashed_password' => $hashed_password,
                                    ':status' => $status,  ':image' => $filename, ));
            $this->db->commit();
            $message = 'User Created. Please go to login page.';
            Session::setFlash($message, 'success');
        } catch (PDOException $e) {
            $this->db->rollback();
            $message = 'Error!: '.$e->getMessage().'</br>';
            Session::setFlash($message, 'danger');
        }
    }

    public function LogOut()
    {
        Session::destroy();
    }


    public function fileUpload($fileName, $sourcePath, $targetPath, $fileType)
    {
        echo $fileName;
        $valid_extensions = array('jpeg', 'jpg', 'png');
        $temporary = explode('.', $fileName);
        $file_extension = end($temporary);
        if ((($fileType == 'image/png') || ($fileType == 'image/jpg') || ($fileType == 'image/jpeg')) && in_array($file_extension, $valid_extensions)) {
            // $sourcePath = $_FILES['file']['tmp_name'];
            //$targetPath = "../../static/mp/images/".$fileName;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedFile = $fileName;
            }
        }
    }

    public function getAllEmployees(){
        $this->sql = $this->db->prepare('SELECT * FROM users WHERE status !=9');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    public function deleteStaffMember($data){
        $this->sql = $this->db->prepare('DELETE  FROM users WHERE id=:id');
        $this->sql->execute(array(':id'=>$data['id']));
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }
   
}