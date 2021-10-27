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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Sree Manjunatha Mart</title>
    <style>

                body{
                        font-family: 'Gotham', sans-serif;
                        font-weight: 500;font-style: normal;
                    }
                   h1, h2,h4{
                        font-family: 'Gotham Black', sans-serif;
                    }
                
    </style>
    <script>
    showSales('Paid')
    </script>
</head>
<body>

        <div class="panel panel-primary">
      <div class="panel-heading"><center><a href="Menu.php"><button class="btn btn-secondary"><span class="glyphicon glyphicon-chevron-left"></span> Home </button></a><h1>Sales</h1>
      <center>From <input type="date" class="form-control form-inline" value="<?php echo date("Y-m-d") ?>" id="from" max="<?php echo date("Y-m-d") ?>" style="width: 150px;">
      <br>
      To <input type="date" class="form-control form-inline"  id="to" value="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d") ?>" style="width: 150px;">
      <br>
      <button class="btn btn-warning" style="width: 150px;" onclick="showSales('Paid')"><span class="glyphicon glyphicon-search"></span> Search</button>
      </center></div>

    </div>
    <div id="sales">
  
    </div>
</body>
</html>