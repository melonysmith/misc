<!--
* Created by: Melony Smith
* August 13th, 2016
* Server-Side Languages
* Week 2: Fruits DB App
-->

<?php

// add php to handle adding data to the database
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=SSL; port=8889', $user, $pass);

    // if the request method is post (if conditional statement)...
    if (isset($_POST['submit'])) {

        // ...create variables with post data...
        $fruit_Name = $_POST['fruitname'];
        $fruit_Color = $_POST['fruitcolor'];

        // ...use pdo to create insert into database statement with parameters...
        $stmt = $dbh->prepare("INSERT INTO fruits (fruitname, fruitcolor) VALUES (:fruitname, :fruitcolor);");

        // ...bind parameters to variables with post data...
        $stmt->bindParam(':fruitname', $fruit_Name);
        $stmt->bindParam(':fruitcolor', $fruit_Color);

        // ...execute insert...
        $stmt->execute();

    // ...end if conditional statement
    }

?>

<!-- begin html form (index.html) -->

<!DOCTYPE html>

<html lang="en">

<head>

    <title>Fruit DB App Project</title>
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

    <form action="fruits.php" method="post">

            <fieldset>

            <input type="text" name="fruitname" id="inputfield" placeholder="enter fruit name" value="" required/>
            <br /><br />
            <input type="text" name="fruitcolor" id="inputfield" placeholder="enter fruit color" value="" required/>

            <br /><br />

            <input type="submit" value="Add Fruit" name="submit" id="add">

            </fieldset>
    </form>

    <table id="displayfruit">

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>Action</th>

        </tr>

        <br /><br />

<!-- end html -->

<?php

// use pdo to create select statement...
$stmt = $dbh->prepare('SELECT * FROM fruits order by fruitid DESC');
// ...execute
$stmt->execute();
// use fetchall to return selected values for each row
$result = $stmt->fetchall();

    // foreach returned row...
    foreach($result as $row) {

        // ...echo id, name, and color...
        echo '<tr><td><br />' . $row['fruitid'] .
             '</td><td>' . $row['fruitname'] .
             '</td><td>' . $row['fruitcolor'] .
             '</td>
             
        <!-- ...ability to delete fruit... -->
        <td><a href="deletefruit.php?id=' . $row['fruitid']. "\">Delete</a></td>";
        
    // ...end foreach loop
    }

?>

    </table>

</body>

</html>