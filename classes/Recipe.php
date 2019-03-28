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
}