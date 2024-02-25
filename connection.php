<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        *{
            margin: 0;
            padding: 0;
        }
    </style>
<body>
    <?php
     $pdo = new PDO('mysql:host:localhost;port=3306;dbname=voengbunheab','voengbunheab','bunheab@0517');
     $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    ?>
</body>
</html>