<?php
/**
 * Created by PhpStorm.
 * User: melonysmith
 * Date: 8/20/16
 * Time: 10:21 AM
 */

$user ="root";
$pass ="root";
$dbh = new PDO('mysql:host=localhost; dbname=SSL; port=8889', $user, $pass);

$sqlquery = $dbh->prepare ("SELECT fruitid, fruitname, fruitcolor, fruitimage FROM fruits order by RAND() LIMIT 1");

$sqlquery->execute();

$result = $sqlquery->fetchAll();

$result = array("fruits"=>$result);

header("Content-type:application/json");

$jsonfile = json_encode($result);

echo $jsonfile;

?>