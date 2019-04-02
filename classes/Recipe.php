<?php

class Recipe extends Model
{
    private $result;
    private $sql;
    private $qtyInstock;

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

    public function fileUpload($fileName, $sourcePath, $targetPath, $fileType)
    {
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

    public function createNewRecipe($data, $filename)
    {
        // insert into recipe database

        if ($this->result = $this->insertDataToRecipe($data)) {
            if ($this->result = $this->insertDataToContents($data, $filename)) {
                $this->result = $this->insertDataToMealCourse($data);
            }
        }


        // insert into contents database
        if ($this->result) {
            echo 'sucessfully done.';
        }
        // insert into mean course
    }

    private function insertDataToRecipe($data)
    {
        for ($index = 1; $index <= 4; ++$index) {
            echo $data['item'.$index];
            $this->sql = $this->db->prepare('INSERT INTO  recipes (item_id, cours_id, qty_used) 
                                    VALUES (:item_id, :cours_id, :qty_used)');
            try {
                $this->db->beginTransaction();
                if ($this->sql->execute(array(':item_id' => $data['item'.$index],
                                                ':cours_id' => $data['mealcat'],
                                                ':qty_used' => $data['qty_'.$index], ))) {
                    $this->db->commit();

                    // update stock
                    $this->updateStock($data['item'.$index], $data['qty_'.$index]);
                    // return true;
                }
            } catch (PDOException $e) {
                $this->db->rollback();
                $message = 'Error!: '.$e->getMessage().'</br>';
                Session::setFlash($message, 'danger');

                return false;
            }
        }

        return true;
    }

    private function updateStock($itemID, $qtyUsed)
    {
        $this->sql = $this->db->prepare('SELECT quantity, reorder_level FROM `ingredients` WHERE id =:id');
        $this->sql->execute(array(':id' => $itemID));
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        if ($qtyUsed > $this->result[0]['reorder_level']) {
            $this->$qtyInstock = ($this->result[0]['quantity']) - $qtyUsed;
            $this->sql = $this->db->prepare('UPDATE ingredients SET quantity=:quantity WHERE id=:id');
            $this->sql->execute(array(':quantity' => $this->result, ':id' => $itemID));
        } else {
            $message = 'Not enough Stolck to prepare this recipe.';
            Session::setFlash($message, 'danger');
        }
        echo 'Eooro';

        // Update Stock
    }

    private function insertDataToContents($data, $filename)
    {
        echo 'FILE: '.$filename;
        echo print_r($data);
        $this->sql = $this->db->prepare('INSERT INTO  contents (title, visible, m_cat_id, m_type_id, description, image) 
                                    VALUES (:title, :visible, :m_cat_id, :m_type_id , :description, :image)');
        try {
            $this->db->beginTransaction();
            if ($this->sql->execute(array(':title' => $data['rcpname'], ':visible' => 1,
                                        ':m_cat_id' => $data['mealcat'], ':m_type_id' => $data['mealtype'],
                                        ':description' => $data['short_desc'], ':image' => $filename, ))) {
                $this->db->commit();

                return true;
            }
        } catch (PDOException $e) {
            $this->db->rollback();
            $message = 'Error!: '.$e->getMessage().'</br>';
            Session::setFlash($message, 'danger');

            return false;
        }
    }

    private function insertDataToMealCourse($data)
    {
        // Data to pass in query

        $this->sql = $this->db->prepare('INSERT INTO  meal_course (course_name, prep_date, course_type, time_to_prepare, 
                                                                course_notes, course_instructions, meal_cat_id) 
                                    VALUES (:course_name, :prep_date, :course_type, :time_to_prepare,
                                            :course_notes,:course_instructions, :meal_cat_id)');
        try {
            $this->db->beginTransaction();
            if ($this->sql->execute(array(':course_name' => $data['rcpname'], ':prep_date' => date('Y-m-d', time()), ':course_type' => $data['mealcat'],
                                            ':time_to_prepare' => 10, ':course_notes' => $data['additional_notes'],
                                             ':course_instructions' => $data['rcp_instructions'],
                                             ':meal_cat_id' => $data['mealcat'], ))) {
                $this->db->commit();
                $message = 'Recipe for '.$data['rcpname'].' created successfully.';
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
