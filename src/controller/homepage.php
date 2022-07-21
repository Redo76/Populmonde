<?php
session_start();

require("../src/model/home.php");

function home(){
    $continents = getContinents();
    // $nom = getIdName($_GET["continent"]);
    
    if (isset($_GET["region"])) {
        if ($_GET["region"] == "") {
            $idContinent = $_SESSION["lastIdContinent"];
            $data = regionsData($idContinent);
            $regions = getRegions($idContinent);
        } else {
            $idRegion = $_GET["region"];
            $data = paysData($idRegion);
            $idContinent = getContinentByRegionId($idRegion);
            $regions = getRegions($idContinent);
        }
    }
    elseif (isset($_GET["continent"]) && $_GET["continent"] !=0 ) {
        $regions = getRegions($_GET["continent"]);
        $idContinent = $_GET["continent"];
        if (isset($_GET["region"])) {
            $idRegion = $_GET["region"];
        }
        if ($idContinent == 3) {
            $data = ameriqueSept();
            $_SESSION["lastIdContinent"] = $idContinent;
        } 
        else{
            $data = regionsData($idContinent);
            $_SESSION["lastIdContinent"] = $idContinent;
        }
    }
    else  {
        $data = continentsData();
        }

    require("../templates/homepage.php");
}