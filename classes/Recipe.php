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
}
