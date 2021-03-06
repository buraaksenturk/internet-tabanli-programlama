<?php
// If you installed via composer, just use this code to require autoloader on the top of your projects.
require 'medoo.php';
    
// Using Medoo namespace
use Medoo\Medoo;
    
$database = new Medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => 'word',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="janjan.css">
</head>
<body>
    <table class="blueTable">
        <thead>
            <tr>
            <th>ID</th>
            <th>İsim</th>
            <th>Bölge</th>
            <th>Ülke Kodu</th>
            <th>Nüfus</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sehirKayitlari=$database->select("sehirler","*");
            foreach ($sehirKayitlari as $satir) {
                echo "<tr>
                        <td>".$satir["ID"]."</td>
                        <td>".$satir["isim"]."</td>
                        <td>".$satir["bolge"]."</td>
                        <td>".$satir["ulke_kodu"]."</td>
                        <td>".$satir["nufus"]."</td>
                    </tr>";
            }
        ?>
        </tbody>
    </table>
</body>
</html>