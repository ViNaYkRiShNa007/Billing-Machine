<?php
session_start();
if ($_SESSION['usr']=='')
{
  header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="controller.js"></script>
    <link href="http://fonts.cdnfonts.com/css/gotham" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
    #topnav-right{
        float: right;
    }
    body{
                        font-family: 'Gotham', sans-serif;
                        font-weight: 500;font-style: normal;
                    }
                   h1, h2,h4{
                        font-family: 'Gotham Black', sans-serif;
                    }
</style>
    <title>Sree Manjunatha Mart</title>
</head>
<body>
<div class="w3-bar w3-light-grey w3-border w3-xlarge">
  <a href="#" class="w3-bar-item w3-button w3-green"><span class="glyphicon glyphicon-user"></span></a>
  <?php echo $_SESSION['usr']?>
  <a href="#" onclick="logOut()" id="topnav-right" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-log-out"></span></a>
  </div>
<div class="w3-row">
  <div class="w3-col s4 w3-blue w3-center">
  <a href="Billdesk.php">
  <div class="w3-card-4" style="width:100%">
    <img src="billdesk.gif" alt="Alps" style="width:100%;height:250px">
    <div class="w3-container w3-center">
    <button class="btn-primary btn-block">Bill Desk</button>
    </div>
    </a>
  </div>
  </div>
  <div class="w3-col s4 w3-orange w3-center">
  <div class="w3-card-4" style="width:100%">
    <img src="cart.gif" alt="Alps" style="width:100%;height:250px">
    <div class="w3-container w3-center">
      <a href="Cart.php"><button class="btn-warning btn-block">Cart</button></a>
    </div>
  </div>
  </div>
  <div class="w3-col s4 w3-green w3-center">
  <div class="w3-card-4" style="width:100%">
    <img src="sales.gif" alt="Alps" style="width:100%;height:250px">
    <div class="w3-container w3-center">
      <a href="Sales.php"><button class="btn-success btn-block">Sales</button></a>
    </div>
  </div>
  </div>
</div>
<div class="w3-row">
  <div class="w3-col s4 w3-green w3-center">
  <div class="w3-card-4" style="width:100%">
    <img src="inventory.gif" alt="Alps" style="width:100%;height:250px">
    <div class="w3-container w3-center">
      <a href="Purchase.php"><button class="btn-success btn-block">Inventory</button></a>
    </div>
  </div>  

  </div>
  <div class="w3-col s4 w3-red w3-center">
  <div class="w3-card-4" style="width:100%">
    <img src="salescredit.gif" alt="Alps" style="width:100%;height:250px">
    <div class="w3-container w3-center">
      <a href="SalesCredit.php"><button class="btn-danger btn-block">Sales Credit</button></a>
    </div>
  </div> 

  </div>
  <div class="w3-col s4 w3-orange w3-center">
  <div class="w3-card-4" style="width:100%">
    <img src="purchasecredit.gif" alt="Alps" style="width:100%;height:250px">
    <div class="w3-container w3-center">
      <a href="PurchaseCredit.php"><button class="btn-warning btn-block">Purchase Credit</button></a>
    </div>
  </div>  

  </div>
</div>
</body>
</html>