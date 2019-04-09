<?php

class Products extends Model
{
    private $result;
    private $sql;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllMeals()
    {
        $this->sql = $this->db->prepare('SELECT * FROM course_details');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    /** Vegetarian Meals Start */
    

    public function getAllVegetarianStarters()
    {
        if (ID != '' || ID != null) {
            $this->sql = $this->db->prepare('SELECT * 
            FROM  meal_course,course_details   
            WHERE course_details.course_id=:ID');
            $this->sql->execute(array(':ID' => ID));
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        } else {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.meal_type = 1 
                AND meal_course.meal_cat_id = 1 
                AND meal_course.id = course_details.course_id ');
            $this->sql->execute();
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
              
            }
        }

        return $this->result;
    }

    public function getAllVegetarianMains()
    {
        if (ID != '' || ID != null) {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.id =  :ID');
            $this->sql->execute(array(':ID' => ID));
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        } else {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course  
                INNER JOIN course_details 
                ON meal_course.id = course_details.course_id 
                WHERE meal_course.meal_type = 1 
                AND meal_course.meal_cat_id = 2');
            $this->sql->execute();
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        }

        return $this->result;
    }

    /** Vegetarian Meals End */

    /** Non Vegetarian Meals Start */
    public function getAllNonVegetarian()
    {
        $this->sql = $this->db->prepare('SELECT * 
            FROM  meal_course,course_details   
            WHERE meal_course.meal_type = 1 
            AND meal_course.meal_cat_id = 2 
            AND meal_course.id = course_details.course_id ');
        $this->sql->execute();
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }

        return $this->result;
    }

    public function getAllNonVegetarianStarters()
    {
        if (ID != '' || ID != null) {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE  course_details.id = :ID ');
            $this->sql->execute(array(':ID' => ID));
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        } else {
            $this->sql = $this->db->prepare('SELECT * 
            FROM  meal_course   
            INNER JOIN course_details
            ON meal_course.id = course_details.course_id
            WHERE meal_course.meal_type = 2 
            AND meal_course.meal_cat_id = 1');
            $this->sql->execute();
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        }

        return $this->result;
    }

    public function getAllNonVegetarianMains()
    {
        if (ID != '' || ID != null) {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.meal_type = 2 
                AND meal_course.meal_cat_id = 2 
                AND meal_course.id = :ID ');
            $this->sql->execute(array(':ID' => ID));
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        } else {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.meal_type = 2 
                AND meal_course.meal_cat_id = 2 
                AND meal_course.id = course_details.course_id ');
            $this->sql->execute();
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        }

        return $this->result;
    }

    /** Non Vegetarian Meals End */
    public function getAllDeserts()
    {
        if (ID != '' || ID != null) {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.meal_type = 1 
                AND meal_course.meal_cat_id = 2 
                AND meal_course.id = :ID');
            $this->sql->execute(array(':ID' => ID));
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        } else {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.meal_type = 1 
                AND meal_course.meal_cat_id = 2 
                AND meal_course.id = course_details.course_id ');
            $this->sql->execute();
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        }

        return $this->result;
    }

    public function getAllRefreshments()
    {
        if (ID != '' || ID != null) {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.meal_type = 1 
                AND meal_course.meal_cat_id = 2 
                AND meal_course.id =  :ID');
            $this->sql->execute(array(':ID' => ID));
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        } else {
            $this->sql = $this->db->prepare('SELECT * 
                FROM  meal_course,course_details   
                WHERE meal_course.meal_type = 1 
                AND meal_course.meal_cat_id = 2 
                AND meal_course.id = course_details.course_id ');
            $this->sql->execute();
            $count = $this->sql->rowCount();
            if ($count > 0) {
                $this->result = $this->sql->fetchAll();
            }
        }

        return $this->result;
    }

    public function getProductDetails($id){
        $this->sql = $this->db->prepare('SELECT * 
        FROM  course_details   
        WHERE course_id =  :ID');
        $this->sql->execute(array(':ID' => $id['id']));
        $count = $this->sql->rowCount();
        if ($count > 0) {
            $this->result = $this->sql->fetchAll();
        }
        return $this->result;
    }
}
