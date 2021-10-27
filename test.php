<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    $con=mysqli_connect("localhost","root","tiger@007","SMM");
    $sql1="select distinct Vendors.Vendor_name,Customers.Customer_name,Cart.Total,Cart.Order_number from Vendors,Customers,Cart where Cart.VID=Vendors.VID AND Cart.CID=Customers.CID AND Date between '$from' AND '$to'
    ";
    $res1=mysqli_query($con,$sql1);
    if(!$res1)
    {
        echo $sql1;
    }
    else{
    $data='
    <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Biller</th>
                    <th>Customer</th>
                    <th>Order Number</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
    ';
    while($rows=mysqli_num_rows($res1))
    {
        
        $data.='
        <tr>
        <td>'.$rows['Vendor_name'].'</td>
        <td>'.$rows['Customer_name'].'</td>
        <td>'.$rows['Order_number'].'</td>
        <td>'.$rows['Total'].'</td>
        <td><button class="btn btn-success">View Bill</button></td>
        </tr>
        ';
    }
    $data.='
    </tbody>
    </table>
    ';
    echo $data;
    ?>
</body>
</html>