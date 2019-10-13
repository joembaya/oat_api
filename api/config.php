<?php
header("Access-Control-Allow-Origin: *");
//This configuration helps set where to expect and load data
global $settingData;

$settingData = (object) array(
  load_files => true,
  files => [
    formats => [
      json => "json",
      csv => "csv",
    ],
    paths => [
        first => "testtakers.csv",
        second => "testtakers.json",
    ]
  ],
  pdo => [
      db =>"taosys",
      root => "admin",
      password => "admin123",
      table => "login",
  ],
  restful => [
      paths => ""
  ]
  
);