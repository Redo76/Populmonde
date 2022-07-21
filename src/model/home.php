<?php
function PDO(){
    try {
    $db = new PDO("mysql:host=localhost;dbname=pays;charset=utf8","userPays","52XlfjU8As(WlCx.");
    return $db;
    }
    catch (\Exception $e) {
        die('Erreur : ' . $e -> getMessage());
    }
}

// function 





function getContinents(){
    $db = PDO();
    $continentsDB = $db -> prepare("SELECT * FROM t_continents c");
    $continentsDB -> execute();
    $continents = $continentsDB -> fetchAll();
    return $continents;
}

function getContinentByRegionId($id){
    $db = PDO();
    $continentDB = $db -> prepare("SELECT r.continent_id FROM t_regions r WHERE r.id_region = :id");
    $continentDB -> execute(["id" => $id]);
    $continent = $continentDB -> fetch();
    return $continent[0];
}

function getRegions($id){
    $db = PDO();
    $regionsDB = $db -> prepare("SELECT * FROM t_regions r WHERE r.continent_id = :id");
    $regionsDB -> execute(["id" => $id]);
    $regions = $regionsDB -> fetchAll();
    return $regions;
}


function continentsData(){
    $db = PDO();
    $continentsDataDB = $db -> prepare("SELECT c.libelle_continent as nom, SUM(p.population_pays) as pop, ROUND(AVG(p.taux_natalite_pays) , 2)as nat, ROUND(AVG(p.taux_mortalite_pays),2) as mort, ROUND(AVG(p.esperance_vie_pays),2) as esp, ROUND(AVG(p.taux_mortalite_infantile_pays),2) as mortinf, ROUND(AVG(p.nombre_enfants_par_femme_pays) ,2) as enf, ROUND(AVG(p.taux_croissance_pays) ,2) as croiss, ROUND(AVG(p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup FROM t_pays p INNER JOIN t_continents c ON p.continent_id = c.id_continent GROUP BY c.libelle_continent
    UNION 
    SELECT 'Monde' as nom, SUM(p.population_pays) as pop, ROUND(AVG(p.taux_natalite_pays) , 2)as nat, ROUND(AVG(p.taux_mortalite_pays),2) as mort, ROUND(AVG(p.esperance_vie_pays),2) as esp, ROUND(AVG(p.taux_mortalite_infantile_pays),2) as mortinf, ROUND(AVG(p.nombre_enfants_par_femme_pays) ,2) as enf, ROUND(AVG(p.taux_croissance_pays) ,2) as croiss, ROUND(AVG(p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup 
    FROM t_pays p;");
    $continentsDataDB -> execute();
    $continentsData = $continentsDataDB -> fetchAll();
    return $continentsData;
}

function regionsData($idContinent){
    $db = PDO();
    $regionsDB = $db -> prepare("SELECT r.libelle_region as nom, SUM(p.population_pays) as pop, ROUND(AVG(p.taux_natalite_pays) , 2)as nat, ROUND(AVG(p.taux_mortalite_pays),2)  as mort, ROUND(AVG(p.esperance_vie_pays),2) as esp, ROUND(AVG(p.taux_mortalite_infantile_pays),2) as mortinf, ROUND(AVG(p.nombre_enfants_par_femme_pays),2) as enf, ROUND(AVG(p.taux_croissance_pays),2) as croiss, ROUND(AVG(p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup FROM t_pays p INNER JOIN t_regions r ON p.region_id = r.id_region INNER JOIN t_continents c ON r.continent_id = c.id_continent WHERE c.id_continent = :id GROUP BY r.libelle_region
    UNION 
    SELECT c.libelle_continent as nom, SUM(p.population_pays) as pop, ROUND(AVG(p.taux_natalite_pays) , 2)as nat, ROUND(AVG(p.taux_mortalite_pays),2) as mort, ROUND(AVG(p.esperance_vie_pays),2) as esp, ROUND(AVG(p.taux_mortalite_infantile_pays),2) as mortinf, ROUND(AVG(p.nombre_enfants_par_femme_pays) ,2) as enf, ROUND(AVG(p.taux_croissance_pays) ,2) as croiss, ROUND(AVG(p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup FROM t_pays p INNER JOIN t_continents c ON p.continent_id = c.id_continent WHERE c.id_continent = :id");
    $regionsDB -> setFetchMode(PDO::FETCH_ASSOC);
    $regionsDB -> execute(["id" => $idContinent]);
    $regions = $regionsDB -> fetchAll();
    return $regions;
}

function paysData($idRegion){
    $db = PDO();
    $paysDB = $db -> prepare("SELECT p.libelle_pays as nom, SUM(p.population_pays) as pop, ROUND(AVG(p.taux_natalite_pays) , 2)as nat, ROUND(AVG(p.taux_mortalite_pays),2) as mort, ROUND(AVG(p.esperance_vie_pays),2) as esp, ROUND(AVG(p.taux_mortalite_infantile_pays),2) as mortinf, ROUND(AVG(p.nombre_enfants_par_femme_pays) ,2) as enf, ROUND(AVG(p.taux_croissance_pays) ,2) as croiss, ROUND(AVG(p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup FROM t_pays p INNER JOIN t_regions r ON p.region_id = r.id_region WHERE r.id_region = :id GROUP BY p.libelle_pays
    UNION 
    SELECT r.libelle_region as nom, SUM(p.population_pays) as pop, ROUND(AVG(p.taux_natalite_pays) , 2)as nat, ROUND(AVG(p.taux_mortalite_pays),2) as mort, ROUND(AVG(p.esperance_vie_pays),2) as esp, ROUND(AVG(p.taux_mortalite_infantile_pays),2) as mortinf, ROUND(AVG(p.nombre_enfants_par_femme_pays) ,2) as enf, ROUND(AVG(p.taux_croissance_pays) ,2) as croiss, ROUND(AVG(p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup FROM t_pays p INNER JOIN t_regions r ON p.region_id = r.id_region WHERE r.id_region = :id");
    $paysDB -> setFetchMode(PDO::FETCH_ASSOC);
    $paysDB -> execute(["id" => $idRegion]);
    $pays = $paysDB -> fetchAll();
    return $pays;
}

function ameriqueSept(){
    $db = PDO();
    $amerDB = $db -> prepare("SELECT p.libelle_pays as nom, SUM(p.population_pays) as pop, ROUND(p.taux_natalite_pays , 2) as nat, ROUND(p.taux_mortalite_pays,2) as mort, ROUND(p.esperance_vie_pays,2) as esp, ROUND(p.taux_mortalite_infantile_pays,2) as mortinf, ROUND(p.nombre_enfants_par_femme_pays, 2) as enf, ROUND(p.taux_croissance_pays, 2) as croiss, ROUND((p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup FROM t_pays p WHERE p.continent_id = 3 GROUP BY p.libelle_pays
    UNION 
    SELECT c.libelle_continent as nom, SUM(p.population_pays) as pop, ROUND(AVG(p.taux_natalite_pays) , 2)as nat, ROUND(AVG(p.taux_mortalite_pays),2) as mort, ROUND(AVG(p.esperance_vie_pays),2) as esp, ROUND(AVG(p.taux_mortalite_infantile_pays),2) as mortinf, ROUND(AVG(p.nombre_enfants_par_femme_pays) ,2) as enf, ROUND(AVG(p.taux_croissance_pays) ,2) as croiss, ROUND(AVG(p.population_plus_65_pays),2) as 65p, SUM(p.superficie_km2) as sup FROM t_pays p INNER JOIN t_continents c ON p.continent_id = c.id_continent WHERE c.id_continent = 3");
    $amerDB -> setFetchMode(PDO::FETCH_ASSOC);
    $amerDB -> execute();
    $amer = $amerDB -> fetchAll();
    return $amer;
}

// function getIdName($id){
//     switch ($id) {
//         case 0:
//             return "Monde";
//             break;
//         case 1:
//             return "Afrique";
//             break;
//         case 2:
//             return "Amérique Latine et Caraïbes";
//             break;
//         case 3:
//             return "Amérique Septentrionale";
//             break;
//         case 4:
//             return "Asie";
//             break;
//         case 5:
//             return "Europe";
//             break;
//         case 6:
//             return "Océanie";
//             break;
//         default:
//             return "--";
//             break;
//     }
// }