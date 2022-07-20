<?php

require("../src/model/home.php");

function home(){
    $continents = getContinents();
    // $nom = getIdName($_GET["continent"]);
    
    if (isset($_GET["region"]) && $_GET["region"] ) {
        $idRegion = $_GET["region"];
        $data = paysData($idRegion);
        $idContinent = $_GET["continent"];
        $regions = getRegions($_GET["continent"]);
    }
    elseif (isset($_GET["continent"]) && $_GET["continent"]) {
        $regions = getRegions($_GET["continent"]);
        $idContinent = $_GET["continent"];
        if (isset($_GET["region"])) {
            $idRegion = $_GET["region"];
            // foreach ($regions as $key => $region) {
            //    if ($region['id_region'] ==  $_GET["region"]) {
            
            //         $idRegion = $_GET["region"];
            //     return;
            //    }
            // }
            // $idRegion = 0;
        }
        if ($idContinent == 3) {
            $data = ameriqueSept();
        }
        else{
            $data = regionsData($idContinent);
        }
    }
    else {
        $data = continentsData();
    }
    



    require("../templates/homepage.php");
}