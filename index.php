<!-- <?php 
 //Connection
 require("connection.php");
 //Prepare Query
 $statement = $pdo->prepare("select * From sa");
 //Execute Query
 $statement->execute();
 //Get Data
 $productList = $statement->fetchAll(PDO::FETCH_ASSOC);
 echo var_dump($productList);
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="body">
  <style>
      *{
          margin: auto;
          padding: 0;
      }
      .btn-primary {
          float: right;
      }
      .body {
        padding: 40px;
      }
      .img {
        width: 80px;
        height: 100px;
      }
  </style>
<table class="table">
      <h1>Productlist</h1>
      <a href="add.php"><button type="button" class="btn btn-primary">Add Product</button></a>
  <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Note</th>
          <th scope="col">Image</tr>
  </thead>
  <tbody>
      <?php foreach($productList as $key => $pro){?>
      <tr>
          <th scope="row"><?php echo $key + 1?></th>
          <td><?php echo $pro['name']?></td>
          <td><?php echo $pro['price']>20? "Hight Price": "Low Price"?></td>
          <td><?php echo $pro['note']?></td>
          <td><img class="img" src="<?php  echo $pro['image'] ?? ""  ?>"></td>
          <td>
          <a href="delete.php?id=<?php echo $pro['product_id']?>"class="btn btn-info" type="submit"><i class="bi bi-trash"></i></a>
         
          <a href="edit.php?id=<?php echo $pro['product_id']?>" class="btn btn-info" type="submit">Edit</a>
          </td>
      </tr>
      <?php } ?>

  </tbody>
</table>
</body>
</html>