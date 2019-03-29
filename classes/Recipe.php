<?php

class Recipe extends Model
{
    private $result;
    private $sql;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllIngredients()
    {
        $this->sql = $this->db->prepare('SELECT * FROM `ingredients` ');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    public function getAllMealTypes()
    {
        $this->sql = $this->db->prepare('SELECT * FROM `meal_type` ');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    public function getAllMealCategoryType()
    {
        $this->sql = $this->db->prepare('SELECT * FROM `meal_category` ');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    public function fileUpload($fileName, $sourcePath, $targetPath,$fileType){
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $fileName);
        $file_extension = end($temporary);
        if((($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
           // $sourcePath = $_FILES['file']['tmp_name'];
            //$targetPath = "../../static/mp/images/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        }
    }

    public function createNewRecipe($data){
        echo print_r($data);
        // insert into recipe database
        if($this->result = $this->insertDataToRecipe($data)){
            if($this->result = $this->insertDataToContents($data)){
                $this->result = $this->insertDataToMealCourse($data);
            }
        }

        // insert into contents database
        if($this->result){
            echo 'sucessfully done.';
        }
        // insert into mean course
    }

    private function insertDataToRecipe($data){

        return true;
        $this->sql = $this->db->prepare('INSERT INTO  recipe (item_id, course_id, qty_used) 
                                    VALUES (:item_id, :course_id, :qty_used)');
        try {
            $this->db->beginTransaction();
            if ($this->sql->execute(array(':item_id' => $fullname, ':course_id' => $username, ':qty_used' => $email ))){
                $this->db->commit();
                $message = 'User Created. Please go to login page.';
                Session::setFlash($message, 'success');
                return true;
            }
        } catch (PDOException $e) {
            $this->db->rollback();
            $message = 'Error!: '.$e->getMessage().'</br>';
            Session::setFlash($message, 'danger');
            return false;
        }

    }

    private function insertDataToContents($data){
        return true;
        $this->sql = $this->db->prepare('INSERT INTO  content (title, visible, m_cat_id, m_type_id, content) 
                                    VALUES (:title, :visible, :m_cat_id, :m_type_id , :content)');
        try {
            $this->db->beginTransaction();
            if ($this->sql->execute(array(':title' => $title, ':visible' => 1, 
                                    ':m_cat_id' => $mCatID, ':m_type_id'=>$mTypeID, ':content'=>$content ))){
                $this->db->commit();
                $message = 'User Created. Please go to login page.';
                Session::setFlash($message, 'success');
                return true;
            }
        } catch (PDOException $e) {
            $this->db->rollback();
            $message = 'Error!: '.$e->getMessage().'</br>';
            Session::setFlash($message, 'danger');
            return false;
        }
    }

    private function insertDataToMealCourse($data){
        return true;
        $this->sql = $this->db->prepare('INSERT INTO  recipe (course_name, course_type, time_to_prepare, course_notes, course_instructions, meal_cat_id) 
                                    VALUES (:item_id, :course_id, :qty_used)');
        try {
            $this->db->beginTransaction();
            if ($this->sql->execute(array(':item_id' => $fullname, ':course_id' => $username, ':qty_used' => $email ))){
                $this->db->commit();
                $message = 'User Created. Please go to login page.';
                Session::setFlash($message, 'success');
                return true;
            }
        } catch (PDOException $e) {
            $this->db->rollback();
            $message = 'Error!: '.$e->getMessage().'</br>';
            Session::setFlash($message, 'danger');
            return false;
        }
    }
}
