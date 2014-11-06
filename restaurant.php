<?php
    include "constant.php";
    Class Restaurant
    {
        private static $dbOperation;
        
        public function Restaurant()
        {
            self::$dbOperation = new DBOperation("restaurant");
        }
        
        public static function addRestaurant($arrayData)
        {
            return self::$dbOperation->insertData($arrayData);
        }
        
        public static function deleteRestaurant($arrQuery)
        {
            return self::$dbOperation->deleteData($arrQuery);
        }
        
        public static function editRestaurant($contact_no,$arrayNew)
        {
            global $restaurant_contact_no;
            $arrCondition = array();
            $arrCondition[$restaurant_contact_no] = $contact_no;
            self::$dbOperation->updateData($arrCondition,$arrayNew);
        }
        
        public static function listOfRestaurants()
        {
            return self::$dbOperation->getAll();
        }
        
        public static function listOfRestaurantsSorted($sortBy)
        {
            $arrQuery = [];
            return self::$dbOperation->get($arrQuery,$sortBy);
        }
        
        public static function listOfRestaurantsSearch($keyword,$orderBy)
        {
            global $restaurant_name;
            $arrQuery[$restaurant_name] = $keyword;
            return self::$dbOperation->getSearch($arrQuery,$orderBy);
        }
        
        public static function getRestaurantDetails($resto_contact_number)
        {
            global $restaurant_contact_no;
            global $empty_string;
            $arrQuery = [];
            $arrQuery[$restaurant_contact_no] = $resto_contact_number;
            $rows = self::$dbOperation->get($arrQuery,$empty_string);
            if(count($rows) == 1){
                return $rows[0];
            }
            return false;
        }
        
        public static function getRestaurantCapacity($resto_contact_number){
            global $restaurant_contact_no;
            global $restaurant_total1seaters;
            global $restaurant_total2seaters;
            global $restaurant_total4seaters;
            global $empty_string;
            $condition2 = [];
            $condition2[$restaurant_contact_no] = $resto_contact_number;
            $rows2 = self::$dbOperation->get($condition2,$empty_string);
            $row2 = $rows2[0];
            $seatCapacity = [];
            $seatCapacity[$restaurant_total1seaters] = $row2[$restaurant_total1seaters];
            $seatCapacity[$restaurant_total2seaters] = $row2[$restaurant_total2seaters];
            $seatCapacity[$restaurant_total4seaters] = $row2[$restaurant_total4seaters];
            return $seatCapacity;
        }

    };
?>