<?php
session_start();
if ($_SESSION['usr']=='')
{
  header("Location: index.html");
}
?>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <script src='https://code.jquery.com/jquery-3.1.0.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="controller.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        showProducts();
        $(document).ready(function(){
        $('#key').keyup(function(){
                    var k=$('#key').val();
                    if(k!='')
                    {
                       $.ajax({
                        url:'backend.php',
                        type:'post',
                        data:{
                            Search:k
                        },
                        success:function(data,status)
                        {
                            $('#records').html(data);
                        }
                        }); 
                    }
                    else{
                        showProducts();
                    }
                });
              });
      </script>
</head>
<body>
        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="showUpForm">
                
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page Content -->
        <div class="panel panel-primary">
      <div class="panel-heading"><center><a href="Menu.php"><button class="btn btn-secondary"><span class="glyphicon glyphicon-chevron-left"></span> Home </button></a><h1>Purchase</h1></center></div>
      <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-body">
          <input type="text" placeholder="Search" name="" class="form-control" id="key"><br>
          <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                Add Products
              </button>

              <!-- Modal -->
              <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form>
                      <input type="text" class="form-control" placeholder="Product Name" id="pname">
                      <br>
                      <input type="text" class="form-control" placeholder="Manufacturer" id="manf">
                      <br>
                        <input type="number" class="form-control" placeholder="Qty" id="qty">
                        <br>
                        <input type="number" class="form-control" placeholder="MRP" id="mrp">
                      <br>
                        <input type="number" class="form-control" placeholder="Purchased Rate" id="prate">
                        <br>
                        <input type="number" class="form-control" placeholder="Wholesale Rate" id="wrate">
                        <br>
                        <input type="number" class="form-control" placeholder="Retail Rate" id="rrate">
                        <br>
                        <select class="form-control" id="payment">
                          <option>Paid</option>
                          <option>Not Paid</option>
                        </select>
                        <br>
                        Is Instock
                        <select class="form-control" id="instock">
                          <option>Yes</option>
                          <option>No</option>
                        </select>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <input type="reset" class="btn btn-primary" onclick="addProduct()" value="Save changes">
                        </div>  
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>
        </div>
      </div>         
      </div>
    </div>
    <div id="records">

    </div>
      
</body>
</html>