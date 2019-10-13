<?php
require("./helpers/validators.php");
/* This class focuses on retrieving data to be shared with the Front-End*/

class generateData {
    protected $connection = null;
    public $validate; 

    //Processing data Files , JSON and CSV
    public function getAllCSVData($settingData)
    {
        try {
            $base = "../static/data/";
            $paths = $settingData->files['paths'];

            $json_path = $paths['first'];
            $csv_path = $paths['second'];
            //Validate path and file
            $this->validate = new validateData();
            $status = $this->validate->validateCSVFiles($base.$csv_path);
            if ($status === true) {
                //Reading file
                $data = file_get_contents($base.$csv_path);
                $json_data = json_decode($data,true);
                print_r(json_encode($json_data));
                exit(1);
            }

            $this->generateEmptyJSON();
        }
        catch (Exception $e) {
            $this->generateEmptyJSON();            
        }
    }
    //Processing data Files , JSON and CSV
    public function getAllJSONData($settingData)
    {
        try {
            $base = "../static/data/";
            $paths = $settingData->files['paths'];

            $json_path = $paths['first'];
            //Validate path and file
            $this->validate = new validateData();
            $status = $this->validate->validateJSONFiles($base.$json_path);
            if ($status === true) {
                //Reading file
                $data = file_get_contents($base.$json_path);
                print_r(json_encode($data));
                            
                exit(1);
            }

            $this->generateEmptyJSON();
                        
        }
        catch (Exception $e) {
            $this->generateEmptyJSON();            
        }
    }

    // For any possible future PDO call 
    public function connect()
    {
        try {
            $db = $this->conData['db'];
            $root = $this->conData['db'];
            $password = $this->conData['db'];

            $this->connection = new PDO($db, $root, $password);
        } catch (Exception $e) {
            $this->generateEmptyJSON();
        }
        
    }

    public function getAllMySQLData($settingData)
    {
        // Note PDO not configured 
        try {
            $this->conData = $settingData->pdo;
            $table = $this->conData['table'];
            $query = $this->connection->prepare(`SELECT * FROM $table`);
            $query->execute();
    
            return $query;
        } catch (Exception $e) {
            $this->generateEmptyJSON();
        }
        
    }

    public function generateEmptyJSON() {
        echo json_encode([]);
        exit(1);
    }
}