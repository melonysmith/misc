<?php

    /*
     * Created by PhpStorm.
     * User: melonysmith
     * Date: 8/19/16
     * Time: 9:19 PM
     */
?>

<?php

$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=SSL; port=8889', $user, $pass);

if (isset($_POST['submit'])) {

    $fruit_Name = $_POST['fruitname'];
    $fruit_Color = $_POST['fruitcolor'];
    $fruit_Image =  $_POST['fruitimage'];
    $stmt = $dbh->prepare("INSERT INTO fruits (fruitname, fruitcolor, fruitimage) VALUES (:fruitname, :fruitcolor, :fruitimage);");

    $stmt->bindParam(':fruitname', $fruit_Name);
    $stmt->bindParam(':fruitcolor', $fruit_Color);
    $stmt->bindParam(':fruitimage', $fruit_Image);

    $stmt->execute();

    }

$jcontent = file_get_contents("http://localhost:8888/SSL/Week3/project/fruitget.php");

$contents = json_decode($jcontent);

?>

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <title>Fruit Ads API</title>
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>

    <div id="header">
        <h1>Melony's Fruit Database App</h1>
    </div>

    <br /><br />

    <div id="intro">
        <p>Please enter a fruit and it's color for inclusion in the database.</p>
    </div>

    <br />

    <form action="fruitsads.php" method="post">

        <fieldset>

            <input type="text" name="fruitname" id="inputfield" placeholder="enter fruit name" value="" required />
            <br /><br />
            <input type="text" name="fruitcolor" id="inputfield" placeholder="enter fruit color" value="" required />
            <br /><br />
            <input type="text" name="fruitimage" id="inputfield" placeholder="image url" value="" required />

            <br /><br />

            <input type="submit" value="Add Fruit" name="submit" id="add">

        </fieldset>
    </form>

    <table id="displayfruit">

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>Image</th>
            <th>Action</th>

        </tr>

        <br /><br />

<?php

$stmt = $dbh->prepare('SELECT * FROM fruits order by fruitid DESC;');

$stmt->execute();

$result = $stmt->fetchAll();

foreach ($result as $row) {

    echo '<tr><td>' . $row['fruitid'] .
         '</td><td>' . $row['fruitname'] .
         '</td><td>' . $row['fruitcolor'] .
         '</td><td>' . $row['fruitimage'] .
         '<br /><br />
     <td><a href="deletefruit.php?id=' . $row['fruitid'] . '">Delete</a></td>';

    /*

     . '<br /><br />
     <td><a href="updatefruit.php?id=' . $row['fruitid'] . '">Update</a></td>';

    */

    }

    foreach ($contents->fruits as $fruit) {

        echo "<h1 class='fotd'>The fruit of the day is: $fruit->fruitcolor $fruit->fruitname</h1><br />
             <img class='fotdimg' src=" . $fruit->fruitimage . " width=200 /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";

    }
?>