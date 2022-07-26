<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>12 paskaita PHP ir JSON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
<?php 

//masyvas
//asociatyvus masyvas

$klientas1 = array(
    "vardas" => "Vardenis",
    "pavarde" => "Pavardenis",
    "gimimoData" => "1990-01-15"
);

$klientas2 = array(
    "vardas" => "Destytojas",
    "pavarde" => "Destytojauskas",
    "gimimoData" => "1990-01-15"
);

$klientai = [$klientas1, $klientas2];

// var_dump($klientai);

//masyvas masyve

$a = [0,1,2,3,4,5];
$b = [6,7,8,9,10,11];

//numeruojamas dvimatis masyvas
$c = [$a, $b];

// var_dump($c);


//var_dump
// numeruojamas masyvas
// $skaiciai = [1,2,3,4,5,6,7,8];

// $kintamas = 1;
// $kintamas2 = "tekstas";

// var_dump($klientai);
// var_dump($skaiciai);
// var_dump($kintamas);
// var_dump($kintamas2 );

// echo $klientai["vardas"];
// echo "<br>";
// echo $klientai["pavarde"];
// echo "<br>";
// echo $klientai["gimimoData"];



$klientas1 = array(
    "nr" => 1,
    "vardas" => "Vardenis",
    "pavarde" => "Pavardenis",
    "gimimoData" => "1990-01-15"
);

$klientas2 = array(
    "nr" => 2,
    "vardas" => "Destytojas",
    "pavarde" => "Destytojauskas",
    "gimimoData" => "1990-01-15"
);
$klientas3 = array(
    "nr" => 3,
    "vardas" => "Destytojas1",
    "pavarde" => "Destytojauskas2",
    "gimimoData" => "1990-01-15"
);
$klientas4 = array(
    "nr" => 4,
    "vardas" => "Destytojas5",
    "pavarde" => "Destytojauskas2",
    "gimimoData" => "1990-01-15"
);
$klientas5 = array(
    "nr" => 5,
    "vardas" => "Destytojas5",
    "pavarde" => "Destytojauskas2",
    "gimimoData" => "1990-01-15"
);

$klientai = [$klientas1, $klientas2, $klientas4,$klientas5];

//json_encode - PHP masyva pavercia i JSON masyva
//json_decode - JSON masyva pavercia i PHP masyva

//json masyvas - jis yra tekstinio tipo

// var_dump($klientai);
//  $klientai = json_encode($klientai);

//  setcookie("klientai", $klientai, time() + 86400, '/');


// var_dump($klientai);





// $klientai = json_decode($klientai);
// var_dump($klientai);

//JSON
//Javascript Object Notation
//Javascripto objekto notacija

//JSON masyvas - masyvas JSON sintakses formatu

//Javascriptu mes taip galime koreguoti sausainiukus
//tiek PHP tiek Javascript gali koreguoti cookies turini
//mes taip sujungti PHP ir Javascript
//per PHP as negaliu perduoti masyvo
//Javascriptas nesupranta PHP masyvo
//Tiek javascript, tiek PHP supranta JSON formato masyva


//1.1 Sukurti klientu lentele
// 1.2 Sukurti kliento papildymo forma
?>
<div class="form col-lg-4">
    <form method="POST" action="index.php">
        <div class="mb-3">
            <label class="form-label">Numeris</label>
            <input class="form-control" name="numeris"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Vardas</label>
            <input class="form-control" name="vardas"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Pavardė</label>
            <input class="form-control" name="pavarde"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Gimimo data</label>
            <input class="form-control" name="gimimoData"/>
        </div>

        <button class="btn btn-primary" type="submit" name="patvirtinti">Įrašyti</button>
    </form>
</div>

<?php 
    if(isset($_POST["patvirtinti"])) {
        $numeris = $_POST["numeris"];
        $vardas = $_POST["vardas"];
        $pavarde = $_POST["pavarde"];
        $gimimoData = $_POST["gimimoData"];

        // Pasiimti is cookies JSON formato masyva
        $klientaiCookies = $_COOKIE["klientai"]; //json formato        
        //JSON formato masyva pasiversti i PHP formato masyva. Su json_decode komanda
        $klientaiPhp = json_decode($klientaiCookies, true);
        //papildyti masyva nauja informacija
        $klientaiPhp[] = array(
            "nr" => $numeris,
            "vardas" =>  $vardas,
            "pavarde" => $pavarde,
            "gimimoData" => $gimimoData
        );
        //si masyva paversti i JSON formata
        $klientaiCookies = json_encode($klientaiPhp);
        //si atnaujinta masyva sukelti i sausainiuka
        setcookie("klientai", $klientaiCookies, time() + 86400, '/' );

        header("Location: index.php");
    }
?>

<table class="table">
    <tr>
        <th>Nr.</th>
        <th>Vardas</th>
        <th>Pavardė</th>
        <th>Gimimo data</th>
    </tr>    
    <?php 
    //asociatyvu masyva mes galime praeiti su foreach

    $klientai = json_decode($_COOKIE["klientai"], true);
    foreach($klientai as $klientas) {
        echo "<tr>";
            echo "<td>".$klientas["nr"]."</td>";
            echo "<td>".$klientas["vardas"]."</td>";
            echo "<td>".$klientas["pavarde"]."</td>";
            echo "<td>".$klientas["gimimoData"]."</td>";
        echo "</tr>";
    }
    ?>`
</table>



</div>
</body>
</html>