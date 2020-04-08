<?php

define("ROOT", "/projekat3");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"] . ROOT);
define("BASE_URL", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http' . '://' . $_SERVER['SERVER_NAME']);
define("FULL_URL", BASE_URL . ROOT);

define("ENV_FAJL", ABSOLUTE_PATH . "/app/config/.env");

define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv){

    $podaci = file(ENV_FAJL);

    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=", $value);
        if($konfig[0]==$naziv){
            $vrednost = trim($konfig[1]);
        }
    }
    return $vrednost;
}
