<?php 
  $error =[];
  $name ="";
  $gender="";
   //1-Create Connection
   require_once("connection.php");
   //====Update====
   if($_SERVER["REQUEST_METHOD"] == 'POST'){
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
            $image = $_FILES ['image']?? null ;
            $imagepath = "";
          if ($image["name"]){
              $imagepath = "Image/" .$image['name'];
              move_uploaded_file ($image['tmp_name'],$imagepath);
          } else {
            $imagepath = $_REQUEST["oldimage"];
          }
          
            //Prepare
            $upSt = $pdo->prepare("update sa set name=:name,price =:price,note=:note,image=:image WHERE product_id = :id");
      
            //BindValue
            $upSt->bindValue(':name', $_REQUEST['name']);
            $upSt->bindValue(':price', $_REQUEST['price']);
            $upSt->bindValue(':note', $_REQUEST['note']);
            $upSt->bindValue(':id', $_REQUEST['id']);
            $upSt->bindValue(':image', $imagepath);
            $upSt->execute();
      
            header("Location: index.php");
            return false;
         }

   }
   $id = $_REQUEST['id'];
      
      //2-Prepare Statement   
      $statement = $pdo->prepare("SELECT * FROM sa WHERE product_id = :id");

      //3-BindValue
      $statement->bindValue(':id', $id);
      
      //4-Execute
      $statement->execute();
   
      // header("Location: index.php");
      //5-Fetch Data
      $pro = $statement->fetch(PDO::FETCH_ASSOC);
      if (!empty($error)){
         $product['name'] = $name;
         $product['price'] = $price;
         $product['name'] = $note;
      }
      // echo var_dump($pro["name"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
   .container {
      background-color: aliceblue;
      width: 600px;
      height: 400px;
      margin: auto;
      margin-top: 30px;
      padding: 30px;
      box-shadow: 0 0 0 2px;
   }
   .btn-success {
      margin-right: 50px;
   }
</style>
<body>
   <div class="container">
      <h1>Edit Product</h1>
      <form action="" method="post" enctype="multipart/form-data">
         <div class="mb-3 row">
            <label for="proName" class="form-label col-md-2">Product Name </label>
            <div class="col-md-9">
               <input type="text" id="proName" class="form-control" name="name" value="<?php  echo $pro['name']?>" />
            </div>
         </div>
         <div class="mb-3 row">
            <label for="proPrice" class="form-label col-md-2">Price </label>
            <div class="col-md-9">
               <input type="number" id="proPrice" class="form-control" name="price" value="<?php  echo $pro['price']?>" />
            </div>
         </div>
         <div class="mb-3 row">
            <label for="proNote" class="form-label col-md-2">Note </label>
            <div class="col-md-9">
               <textarea type="text" id="proNote" class="form-control" name="note"><?php  echo $pro['note']?></textarea>
            </div>
         </div>
         <div class="mb-3 row">
                        <label for="inputPassword" class="col-md-2 col-form-label">Image</label>
                        <div class="col-sm-9">
                        <input type="file" class="form-control" id="image" name="image">
                        <input type="hidden" class="form-control" id="oldimage" name="oldimage" value="<?php  echo $pro['image']?>" >
                        </div>
                </div>
         <input type="hidden" name="id" value="<?php  echo $pro['product_id']?>" />
         <button class="btn btn-success" style="float:right;">Save</button>
      </form>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>