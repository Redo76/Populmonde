<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Population du monde</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/slate/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="bg-white d-flex flex-column align-items-center">
    <h1 class="mt-5">Population du monde</h1>
    <div class="divSelect d-flex flex-wrap bg-light  m-5">
        <form action="/index.php" method="get" class="m-5" >
            <select name="continent" onchange="this.form.submit()" class="p-2 ">
                <option value="0">Monde</option>
                <?php foreach ($continents as $continent) : ?>
                    <?php if ($idContinent == $continent['id_continent'] ) :?>
                        <option value="<?=$continent['id_continent']?>" selected ><?= $continent['libelle_continent'] ?></option>
                    <?php else :?>
                        <option value="<?=$continent['id_continent']?>" ><?= $continent['libelle_continent'] ?></option>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </form>
        <form action="/index.php" method="get" class="m-5 d-flex">
            <?php if (isset($idContinent) && $idContinent != 0 && $idContinent != 3) :?>
    
            <select name="region" onchange="this.form.submit()"  class="p-2">
            <option value="">--</option>
            <?php foreach ($regions as $region) : ?>
                <?php if ($idRegion == $region['id_region']) :?>
                    <option value="<?=$region['id_region']?>" selected ><?= $region['libelle_region'] ?></option>
                <?php else :?>
                    <option value="<?=$region['id_region']?>" ><?= $region['libelle_region'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
            </select>
    
            <?php endif ?>
        </form>  
    </div>
    <div class="table-responsive">
    <table class="table table-striped ">
        <thead>
            <tr class="table-secondary tres">
                <th scope="col">Pays</th>
                <th scope="col">Population totale (en milliers)</th>
                <th scope="col">Taux de natalité</th>
                <th scope="col">Taux de mortalité</th>
                <th scope="col">Espérance de vie</th>
                <th scope="col">Taux de mortalité infantile	</th>
                <th scope="col">Nombre d'enfant(s) par femme	</th>
                <th scope="col">Taux de croissance	</th>
                <th scope="col">Population de 65 ans et plus (en milliers)</th>
                <th scope="col">superficie (en km²)</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <!-- <?php var_dump($data) ?> -->
            <?php foreach ($data as $key => $dataInfo) : ?>
                
                <?php if ($key == count($data) -1) :?>
                    <tr class="table-info">      
                <?php else :?>
                    <tr>
                <?php endif ?>
                    <td><?= $dataInfo["nom"]?></td>
                    <td><?= $dataInfo["pop"]?></td>
                    <td><?= $dataInfo["nat"]?></td>
                    <td><?= $dataInfo["mort"]?></td>
                    <td><?= $dataInfo["esp"]?></td>
                    <td><?= $dataInfo["mortinf"]?></td>
                    <td><?= $dataInfo["enf"]?></td>
                    <td><?= $dataInfo["croiss"]?></td>
                    <td><?= $dataInfo["65p"]?></td>
                    <td><?= $dataInfo["sup"]?></td>
                </tr>
                <?php endforeach ?>
        </tbody>
    </table>
    </div>
</body>
</html>