<?php 
$error =[];
$name ="";
$gender="";
if ($_SERVER ['REQUEST_METHOD'] == "POST"){

    //Upload image
    $image = $_FILES ['image']?? null ;
    $imagepath = "";
    if ($image){
        //with random
        //$imagepath = "images/ . randomString(8) . $image[name]";
        //with date
        $imagepath = "Image/" .$image['name'];
        move_uploaded_file ($image['tmp_name'],$imagepath);
    }
    function randomString ($n) {
        $characters = "1234567890abcdefghijklmnopqrstuvwxyz";
        $str = "";
        for ($i=0; $i<$n; $i){
            $ind = rand(0,strlen($characters)-1);
            $str .= $characters[$ind];
        }
    }
    // 1== Create Connection
    require ("connection.php");
    // 2 ==Prepare Connection
    $name = $_REQUEST['name'];
    $price = $_REQUEST['price'];
    $note = $_REQUEST['note'];
    //validation
    $error = [];
    if (!$name){
        $error [] = "Name is required";
    }
    if (!$price){
        $error [] = "Price is required";
    }
    if (!$note){
        $error [] = "Note is required";
    }
    if (empty($error)){
           // Prepare 
    $statement = $pdo->prepare(
        "Insert into sa (name, price,note,image)
        values(:name,:price,:note,:image)"
    );
          $statement->bindValue(':name', $name);
          $statement->bindValue(':price', $price);
          $statement->bindValue(':note', $note);
          $statement->bindValue(':image', $imagepath);
          // 3== Execute statement
          $statement->execute();
          header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
</head>
<style>
    
     body {
        margin: 0;
        padding: 0;
     }
     .col-sm-1 {
        margin-left: 50px;
     }
     h1 {
        margin-left: 50px;
     }
    .btn-primary {
        width: 100px;
        margin-left: 78%;
        margin-top: 10px;
    }
</style>
<body>
     <div class="add-new-product">
        <h1>Add Product</h1>
        <?php if (!empty($error)){?>
             <div class="alert alert-danger">
                <ul>
                    <?php foreach ($error as $err):?>
                        <li><?php echo $err ?></li>
                    <?php endforeach ?>
                </ul>
             </div>
        <?php } ?>
        <form  method="POST" action="" enctype="multipart/form-data">
                <div class="mb-4 row">
                        <label for="inputPassword" class="col-sm-1 col-form-label">Name</label>
                        <div class="col-sm-9">
                        <input value="<?php echo $name ?>" type="text" class="form-control" id="name" name="name">
                        </div>
                </div>
                <div class="mb-4 row">
                        <label for="inputPassword" class="col-sm-1 col-form-label">Price</label>
                        <div class="col-sm-9">
                        <input value="<?php echo $name ?>" type="number" class="form-control" id="price" name="price">
                        </div>
                </div>
                <div class="mb-4 row">
                        <label for="inputPassword" class="col-sm-1 col-form-label">Note</label>
                        <div class="col-sm-10">
                        <textarea value="<?php echo $name ?>" name="note" id="note" cols="150" rows="4"></textarea>
                </div>
                <div class="mb-4 row">
                        <label for="inputPassword" class="col-sm-1 col-form-label">Image</label>
                        <div class="col-sm-9">
                        <input type="file" class="form-control" id="image" name="image">
                        </div>
                </div>
                <button class="btn btn-primary" type="submit">Add</button>
                
        </form>
    
    </div>
</body>
</html>