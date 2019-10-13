<?php
header("Access-Control-Allow-Origin: *");
require_once("./config.php");
require("./data.php");

try {
    
    $data = new generateData();
    $status = $settingData->load_files;
    $fileFormat = $settingData->files['formats'];
     
    //Loading files if true
    if ($status === true) {
        $validate = new validateData();
        $format = $validate->validateRequest();
        
        switch ($format) {
            case "json":
                $data->getAllJSONData($settingData);
                break;
            case "csv":
                $data->getAllCSVData($settingData);
                break;
            default:
                $data->getAllCSVData($settingData);
        }
        
        exit(1);
    }

    //Load default if status is fault, Note that this is not configured

    $data->getAllMySQLData($settingData);

} catch (Exception $e) {
    return json_encode([]);
}

