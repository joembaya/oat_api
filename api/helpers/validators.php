<?php

class validateData {

    public $defaultFormat = "csv";

    public function validateJSONFiles($file) {
           //In this section we can further detail other 
           try {
            if (file_exists($file)) {
                return true;
                exit(1);
            }
        } catch(Exception $e) {
            return $flag;
            exit(1);
        }
    }

    public function validateCSVFiles($file) {
        //In this section we can further detail other 
        try {
            if (file_exists($file)) {
                return true;
                exit(1);
            }
        } catch(Exception $e) {
            return false;
            exit(1);
        }
    }

    public function validateRequest() {
        try{
            if(isset($_REQUEST['format'])) {
                $option = $_REQUEST['format'];
                if(preg_match('/^[A-Za-z0-9_-]*$/', $option)) {
                    if (is_string($option)) {
                        return $option;
                        exit(1);
                    }
                }  
            }
            
            return $this->defaultFormat;

        } catch (Exception $e) {
            return $this->defaultFormat;
        }
    }
}