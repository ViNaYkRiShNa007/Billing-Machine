<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
$con=mysqli_connect("localhost","root","tiger@007","SMM");
extract($_POST);
$date=date("Y-m-d");
//update payment details for given order number
if(isset($_POST['onum']) && isset($_POST['pay']))
{
    $sql="UPDATE SMM.Products
    SET Payment='Paid', isInstock='yes'
    WHERE Order_number=$onum AND Payment='Not Paid';
    ";   
    $res=mysqli_query($con,$sql);
    if($res)
    {
        echo 1;
    }
}
//show purchased bill of given id
if(isset($_POST['onum']))
{
    $sql="SELECT Product_name, Manufacturer, Quantity, MRP, Purchased_rate ,Payment  FROM SMM.Products WHERE Order_number=$onum AND Payment='Not Paid'";
    $res=mysqli_query($con,$sql);
    $total=0;
    $sum=0;
    $data='
    <div class="modal-body">
    <table class="table table-bordered">
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Manufacturer</th>
        <th>Quantity</th>
        <th>MRP</th>
        <th>Rate</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>';
    while($rows=mysqli_fetch_array($res))
    {
        $data.='
        <tr>
        <td>'.$rows['Product_name'].'</td>
        <td>'.$rows['Manufacturer'].'</td>
        <td>'.$rows['Quantity'].'</td>
        <td>'.$rows['MRP'].'</td>
        <td>'.$rows['Purchased_rate'].'</td>
        <td>'.$total=(int)($rows['Purchased_rate']*$rows['Quantity']).'</td>
        </tr>
        ';
        $sum=(int)($sum+$total);
    }
    $data.='
    <tr><td colspan="6"><center><h1>Total Outstanding ₹ '.$sum.'</h1></center></td></tr>
    </tbody>
    </table>
    <div class="modal-footer">
    <button type="button" class="btn btn-success" onclick="makePay('.$onum.')" data-dismiss="modal">Make Payment</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
    ';
    $sum=0;
    echo $data;
}
//show puchase credits
if(isset($_POST['from']) && isset($_POST['to']) && isset($_POST['showCredits']))
{
    $sql="SELECT distinct Order_number,Purchased_date FROM SMM.Products where Purchased_date between '$from' AND '$to' AND Payment='Not Paid'";
    $res=mysqli_query($con,$sql);
    $total=0;
    $data='<table class="table table-bordered">
    <thead>
    <tr>
        <th>Order Number</th>
        <th>Purchased Date</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>';
    while($rows=mysqli_fetch_array($res))
    {
        $data.='
        <tr>
        <td>'.$rows['Order_number'].'</td>
        <td>'.$rows['Purchased_date'].'</td>
        ';
        $num=$rows['Order_number'];
        $sql1="select SUM(Purchased_rate*Quantity) as value_total from Products where Order_number=$num AND Payment='Not Paid'";
        $res1=mysqli_query($con,$sql1);
        $row=mysqli_fetch_assoc($res1);
        $total+=$row['value_total'];
        $data.='
        <td>₹'.$row['value_total'].'</td>
        <td><button class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal" onclick="showCreds('.$rows['Order_number'].')">View Bill<button></td>
        </tr>
        ';
    }
    $data.='
    <tr><td colspan="4"><center><h1>Total Outstanding ₹ '.$total.'</h1></center></td></tr>
    </tbody>
    </table>';
    echo $data;
}
//set session for customer id and order number
if(isset($_POST['cid']) && isset($_POST['oid']))
{
    $_SESSION["order_no"]=$oid;
    $_SESSION['cid']=$cid;
    $_SESSION['mode']='return';
}
//show sales records
if(isset($_POST['from']) && isset($_POST['to']) && isset($_POST['purpose']))
{
    if($purpose=='Credits')
    {
        $sql="select distinct Vendors.Vendor_name,Customers.Customer_name,Cart.Order_number,Cart.CID from Vendors,Customers,Cart where Cart.VID=Vendors.VID AND Cart.CID=Customers.CID AND Date between '$from' AND '$to' AND Cart.Status='Billed' AND Payement_method='Credit'";
    }
    else{
        $sql="select distinct Vendors.Vendor_name,Customers.Customer_name,Cart.Order_number,Cart.CID from Vendors,Customers,Cart where Cart.VID=Vendors.VID AND Cart.CID=Customers.CID AND Date between '$from' AND '$to' AND Cart.Status='Billed'";
    }
    $res=mysqli_query($con,$sql);
    $data='<table class="table table-bordered">
    <thead>
    <tr>
        <th>Biller</th>
        <th>Customer</th>
        <th>Order Number</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>';
    $total=0;
    while($rows=mysqli_fetch_array($res))
    {
        $data.='
        <tr>
        <td>'.$rows['Vendor_name'].'</td>
        <td>'.$rows['Customer_name'].'</td>
        <td><button class="btn btn-success btn-block" onclick="viewBill('.$rows['CID'].','.$rows['Order_number'].')">'.$rows['Order_number'].' <span class="glyphicon glyphicon-chevron-right"></span></button></td>
        ';
        $num=$rows['Order_number'];
        $sql1="select SUM(Total) as value_total from Cart where Order_number=$num";
        $res1=mysqli_query($con,$sql1);
        $row=mysqli_fetch_assoc($res1);
        $total+=$row['value_total'];
        $data.='<td>'.$row['value_total'].'</td>
        </tr>';
    }
    $data.='
    <tr><td colspan="4"><center><h1>Total Sales ₹ '.$total.'</h1></center></td></tr>
    </tbody>
    </table>
    ';
    echo $data;
}
//logout
if(isset($_POST['logout']))
{
    session_destroy();
    echo 1;
}
//generate bill
if(isset($_POST['Getbill']))
{
    $OID=$_SESSION["order_no"];
    $CID=$_SESSION['cid'];
    $sql1="select Products.PID, Products.Product_name, Products.MRP,Cart.Rate ,Cart.QTY,Cart.Total,Customers.Customer_name, Customers.Phone from Vendors,Products,Cart,Customers where Vendors.VID=Cart.VID and Cart.PID=Products.PID and Customers.CID=$CID and Cart.Order_number=$OID
    ";
    $sum=0;
    $sum1=0;
    $i=0;
    $res1=mysqli_query($con,$sql1);
    $data='
    <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Selling Rate</th>
                    <th>QTY</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
    ';
    while($rows=mysqli_fetch_array($res1))
    {
        $cusname=$rows['Customer_name'];
        $cusfone=$rows['Phone'];
        $sum=$sum+$rows['Total'];
        $sum1=$sum1+($rows['MRP']*$rows['QTY']);
        $i++;
        $data.='
        <tr>
        <td>'.$rows['Product_name'].'</td>
        <td>₹ '.$rows['Rate'].'</td>
        <td>'.$rows['QTY'].' </td>
        <td>₹ '.$rows['Total'].'</td>
        </tr>
        <tr>
        ';
    }
    $data.='
    <h1>Sree Manjunatha Mart  <button id="print" class="btn btn-primary" onclick="printBill()"><span class="glyphicon glyphicon-print"></span></button> <button id="checkout"class="btn btn-danger" onclick="logOut()"><span class="glyphicon glyphicon-log-out"></span></button></h1>
    <h3>#511, 64th cross, 5th Block, Rajajinagar, Bangalore - 10</h3>
    <hr>
    <table class="table table-bordered">
    <tr>
    <th><h1>Grand Total</h1></th><td><h1>₹ '.$sum.'</h1></td>
    </tr>
    </table>
    <hr>
    <table class="table table-bordered">
    <tr><th>Order Number</th><td><b>'.$OID.'</b></td>
    <th>Customer Name</th><td>'.$cusname.'</td>
    <th>Customer Phone</th><td>'.$cusfone.'</td>
    </table>
    <hr>
    </tbody>
    </table>';
    echo $data;
}
//checkout
if(isset($_POST['checkOutID']) && isset($_POST['Payment']))
{
    $sql="UPDATE Cart SET Status='Billed', Payement_method='$Payment' WHERE Order_number=$checkOutID
    ";
    $res=mysqli_query($con,$sql);  
    if($res)
    {
        echo 1;
    }
    else{
        echo $sql;
        echo mysqli_err($res);
    }
}
//delete cart item
if(isset($_POST['delCartItem']))
{
    $OID=$_SESSION["order_no"];
    $pid=$delCartItem;
    $sql1="select QTY as quantity from Cart where PID=$pid and Order_number=$OID";
        $res1=mysqli_query($con,$sql1);
        $row=mysqli_fetch_assoc($res1);
    $newQty=$row['quantity'];
        $sql4="update Products set Quantity=Quantity+$newQty where PID=$pid";
        $res4=mysqli_query($con,$sql4);  
        $inStock=0;
    $sql="DELETE FROM SMM.Cart WHERE PID=$pid";
    $res=mysqli_query($con,$sql);
    if(!$res)
    {
        echo $mysqli_err($res);
    }
}
//show cart data
if(isset($_POST['showCart']))
{
    $OID=$_SESSION["order_no"];
    $CID=$_SESSION['cid'];
    $sql="select Products.PID, Products.Product_name, Products.MRP,Cart.Rate ,Cart.QTY,Cart.Total from Vendors,Products,Cart,Customers where Vendors.VID=Cart.VID and Cart.PID=Products.PID and Customers.CID=$CID and Cart.Order_number=$OID
    ";
    $sum=0;
    $i=0;
    $res=mysqli_query($con,$sql);
    $data='
    <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>MRP</th>
                    <th>Selling Rate</th>
                    <th>QTY</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
    ';
    while($rows=mysqli_fetch_array($res))
    {
        $sum=$sum+$rows['Total'];
        $i++;
        $data.='
        <tr>
        <td>'.$rows['Product_name'].'</td>
        <td>₹ '.$rows['MRP'].'</td>
        <td>₹ '.$rows['Rate'].'</td>
        <td><input type="number" value='.$rows['QTY'].' class="form-control"  placeholder="Qty" id="qty'.$rows['PID'].'" min="0"  value="1" style="width: 75px;"> </td>
        <td>₹ '.$rows['Total'].'</td>
        </tr>
        <tr>
        <th>Action</th>
        ';
            $data.='
        <td><button class="btn btn-primary btn-block" onclick="upCart('.$rows['PID'].','.$rows['Rate'].')"><span class="glyphicon glyphicon-ok-sign"></span></button></td>';
        $data.='
        <td><button class="btn btn-danger btn-block" onclick="delCart('.$rows['PID'].')"><span class="glyphicon glyphicon-remove-sign"></span></button></td>
        </tr>
        ';
    }
    $data.='
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><h1>Total</h1></td>
    <td><h1>₹ '.$sum.'<h1></td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>
    <div class="form-group">
    <label for="cartPay">Payment Method</label>
    <select class="form-control" id="cartPay">
        <option>Cash</option>
        <option>Paytm</option>
        <option>Credit</option>
    </select>
    </div>
    </td>
    <td><br><button type="button" class="btn btn-success" onclick="checkOut('.$OID.','.$sum.')">Proceed <span class="glyphicon glyphicon-chevron-right"></span></button></td>
    </tr>
    </tbody>
    </table>';
    echo $data;
}
// add and update to cart
if(isset($_POST['pid']) && isset($_POST['rate']) && isset($_POST['qty']) && isset($_POST['total']) && isset($_POST['todo']))
{
    $VID=$_SESSION['uid'];
    $OID=$_SESSION["order_no"];
    $CID=$_SESSION['cid'];
    $sql1="SELECT * FROM Cart WHERE PID=$pid AND VID=$VID AND CID=$CID AND Order_number=$OID AND Status='Currently Billing' AND `Date`='$date'";
    $res1=mysqli_query($con,$sql1);
    if(mysqli_num_rows($res1)>0)
    {
        if(isset($_SESSION['var'.$pid.'']))
        {
            if($todo=='add')
            {
                $newQty=$_SESSION['var'.$pid.''];
                $total=$qty*$rate;
                $newQty=$qty+$newQty;
                $_SESSION['var'.$pid.'']=$newQty;
                    $newQty=abs($newQty);
                    echo $newQty;
                    $sql4="update Products set Quantity=Quantity-$qty where PID=$pid";
                    $res4=mysqli_query($con,$sql4);
                    $qty=$newQty;
            }
            elseif($todo=='update')
            {
                $newQty=$_SESSION['var'.$pid.''];
                echo 'existing '.$newQty.' entered '.$qty;
                if($qty<$newQty)
                {
                    $newQty=$qty-$newQty;
                    $newQty=abs($newQty);
                    echo $newQty;
                    $_SESSION['var'.$pid.'']=$newQty;
                    $sql4="update Products set Quantity=Quantity+$newQty where PID=$pid";
                    $res4=mysqli_query($con,$sql4); 
                    echo ' updated '.$qty;
                } 
                elseif($qty>$newQty)
                {
                    $newQty=$qty-$newQty;
                    $newQty=abs($newQty);
                    echo $newQty;
                    $_SESSION['var'.$pid.'']=$newQty;
                    $sql4="update Products set Quantity=Quantity-$newQty where PID=$pid";
                    $res4=mysqli_query($con,$sql4); 
                    echo ' updated '.$qty;
                }
            }
        }
        $sql2="UPDATE Cart SET QTY=$qty, Total=QTY*$rate WHERE  PID=$pid AND VID=$VID AND CID=$CID AND Order_number=$OID AND Status='Currently Billing' AND `Date`='$date';
        ";
        $res2=mysqli_query($con,$sql2);
        if($res2)
        {
            echo "updated";
        }
        else
        {
            echo $sql2;
        }
    }
    else
    {
        $_SESSION['var'.$pid.'']+=$qty;
        echo $_SESSION['var'.$pid.''];
        $total=$qty*$rate;
        $sql4="update Products set Quantity=Quantity-$qty where PID=$pid";
        $res4=mysqli_query($con,$sql4);
        $sql3="INSERT INTO Cart (VID, PID, QTY, `Date`, Total, Status, Payement_method, Order_number, CID,Rate) VALUES($VID, $pid, $qty, '$date', $total, 'Currently Billing', '', $OID, $CID ,$rate);
        ";
        $res3=mysqli_query($con,$sql3);
        if($res3)
        {
            echo "inserted";
        }
        else
        {
            echo $sql3;
        }
    }
   
}
//Search bill desk
if(isset($_POST['searchDesk']) && isset($_POST['type']))
{
    $sql="SELECT * FROM Products WHERE Product_name LIKE '%" .$searchDesk. "%' OR Manufacturer LIKE '%" .$searchDesk. "% ' AND isInstock='Yes' AND Quantity>0
    ";
    $data='
    <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Manufacturer</th>
                    <th>Selling Rate</th>
                    <th>QTY</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
    ';
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($rows=mysqli_fetch_array($result))
        {
            if($type=='Retail')
            {
                $data.='
                <tr>
                    <td>'.$rows['Product_name'].'</td>
                    <td>'.$rows['Manufacturer'].'</td>
                    <td id="SR'.$rows['PID'].'">₹ '.$rows['Selling_rate'] .'</td>
                    <td><input type="number" class="form-control"  placeholder="Qty" id="qty'.$rows['PID'].'" min="0"  value="1"></td>
                    <td><button class="btn btn-warning" onclick="addCart('.$rows['PID'].','.$rows['Selling_rate'] .')"><span class="glyphicon glyphicon-shopping-cart"></span></button></td>
                </tr>
            ';
            }
            else{
                $data.='
                <tr>
                <td>'.$rows['Product_name'].'</td>
                <td>'.$rows['Manufacturer'].'</td>
                <td id="SR'.$rows['PID'].'">₹ '.$rows['Selling_rate'] .'</td>
                <td><input type="number" class="form-control"  placeholder="Qty" id="qty'.$rows['PID'].'" min="0"  value="1"></td>
                <td><button class="btn btn-warning" onclick="addCart('.$rows['PID'].','.$rows['Wholesale_rate'] .')"><span class="glyphicon glyphicon-shopping-cart"></span></button></td>
                </tr>
            ';
            }
            
        }
        $data.=' </tbody>
        </table>';
        echo $data;
    }
}
//saving customer details
if(isset($_POST['cusname']) && isset($_POST['fone']) && isset($_POST['custype']))
{
    $sql1="SELECT * FROM Customers WHERE Customer_name='$cusname' AND Phone=$fone";
    $res1=mysqli_query($con,$sql1);
    if($res1)
    if(mysqli_num_rows($res1)>0)
    {
        while($rows=mysqli_fetch_array($res1))
        {
            $_SESSION['cid']=$rows['CID'];
            $_SESSION['cusname']=$rows['Customer_name'];
            $_SESSION['fone']=$rows['Phone'];
            $_SESSION['custype']=$custype;
        }
        echo 1;
    }
    else
    {
        $sql2="INSERT INTO Customers (Customer_name, Phone) VALUES('$cusname', $fone);
        ";
        $res2=mysqli_query($con,$sql2);
        if($res2)
        {
            $sql1="SELECT * FROM Customers WHERE Customer_name='$cusname' AND Phone=$fone";
            $res1=mysqli_query($con,$sql1);
            while($rows=mysqli_fetch_array($res1))
                {
                    $_SESSION['cid']=$rows['CID'];
                    $_SESSION['cusname']=$rows['Customer_name'];
                    $_SESSION['fone']=$rows['Phone'];
                    $_SESSION['custype']=$custype;
                }
                echo 1;
        }
        else
        {
            echo 0;
        }
            
    }
    
    
}
//show items in billdesk
if(isset($_POST['showBillDesk']) && isset($_POST['type']))
{
    $sql="SELECT * FROM Products Where isInstock='yes' AND Quantity>0;
    ";
    $data='
    <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Manufacturer</th>
                    <th>Selling Rate</th>
                    <th>QTY</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
    ';
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($rows=mysqli_fetch_array($result))
        {
            if($type=='Retail')
            {
                $data.='
                <tr>
                    <td>'.$rows['Product_name'].'</td>
                    <td>'.$rows['Manufacturer'].'</td>
                    <td>₹ '.$rows['Selling_rate'] .'</td>
                    <td><input type="number" placeholder="Qty" min="0" class="form-control" id="qty'.$rows['PID'].'" value="1" ></td>
                    <td><button class="btn btn-warning" onclick="addCart('.$rows['PID'].','.$rows['Selling_rate'] .')"><span class="glyphicon glyphicon-shopping-cart"></span></button></td>

                </tr>
            ';
            }
            else{
                $data.='
                <tr>
                    <td>'.$rows['Product_name'].'</td>
                    <td>'.$rows['Manufacturer'].'</td>
                    <td>₹ '.$rows['Wholesale_rate'] .'</td>
                    <td><input type="number" placeholder="Qty" min="1" class="form-control" id="qty'.$rows['PID'].'" value="1" ></td>
                    <td><button class="btn btn-warning" onclick="addCart('.$rows['PID'].','.$rows['Wholesale_rate'] .')"><span class="glyphicon glyphicon-shopping-cart"></span></button></td>
                </tr>
            ';
            }
            
        }
        $data.=' </tbody>
        </table>';
        echo $data;
    }
}
//Search Inventory
if(isset($_POST['Search']))
{
    $sql="SELECT * FROM Products WHERE Product_name LIKE '%" .$Search. "%' OR Manufacturer LIKE '%" .$Search. "%';
    ";
    $data='
    <table class="table ">
    ';
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($rows=mysqli_fetch_array($result))
        {
            $data.='
            <tr rowspan="2">
            <td ><b>'.$rows['Product_name'].', '.$rows['Manufacturer'].'</b></td>
            <td>Purchased Rate ₹ '.$rows['Purchased_rate'].'</td>
            <td>Instock Quantity '.$rows['Quantity'].'</td>
            <td><button class="btn btn-block btn-warning" data-toggle="modal" onclick="showUpData('.$rows['PID'].')" data-target="#updateModal"><span class="glyphicon glyphicon-pencil"></span></button></td>
            </tr>
            <tr >
            
            <td rowspan="2">MRP ₹'.$rows['MRP'].'</td>
            <td >Wholesale Rate ₹ '.$rows['Wholesale_rate'].'</td>
            <td rowspan="2">Date '.date("d-m-Y",strtotime($rows['Purchased_date'])).'</td>
            <td><button class="btn btn-block btn-danger" onclick="deleteItem('.$rows['PID'].')"><span class="glyphicon glyphicon-trash"></span></button></td>
            </tr>
            <tr>
            
            <td>Selling Rate ₹ '.$rows['Selling_rate'].'</td>
            </tr>
            <tr>
            
            </tr>
            ';
        }
        $data.='</table>';
        echo $data;
    }
}
//update the information
if(isset($_POST['pid']) && isset($_POST['pname']) && isset($_POST['manf'])&& isset($_POST['qty']) && isset($_POST['mrp']) && isset($_POST['prate']) && isset($_POST['wrate']) && isset($_POST['rrate']))
{
    $sql="UPDATE Products SET Product_name='$pname', Quantity=$qty, MRP=$mrp, Purchased_rate=$prate, Selling_rate=$rrate, Manufacturer='$manf', Wholesale_rate=$wrate WHERE PID=$pid
    ";
    $res=mysqli_query($con,$sql);
    echo "updated!!!";
}
//update modal for inventory
if(isset($_POST['showUpId']))
{
    $sql="SELECT  Product_name, Quantity, MRP, Purchased_rate, Selling_rate, Manufacturer, Purchased_date, Wholesale_rate FROM Products WHERE PID=$showUpId;
    ";
    $data='';
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($rows=mysqli_fetch_array($result))
        {
            $data.='
            <form>
                    Product Name
                      <input type="text" class="form-control" placeholder="Product Name" id="pname" value="'.$rows['Product_name'].'">
                      <br>
                      Manufacturer
                      <input type="text" class="form-control" placeholder="Manufacturer" value="'.$rows['Manufacturer'].'" id="manf">
                      <br>
                      Quantity
                        <input type="number" class="form-control" placeholder="Qty" value="'.$rows['Quantity'].'" id="qty">
                        <br>
                        MRP
                        <input type="number" class="form-control" placeholder="MRP" value="'.$rows['MRP'].'" id="mrp">
                      <br>
                      Purchased Rate
                        <input type="number" class="form-control" placeholder="Purchased Rate" value="'.$rows['Purchased_rate'].'" id="prate">
                        <br>
                        Wholesale Rate
                        <input type="number" class="form-control" placeholder="Wholesale Rate" value="'.$rows['Wholesale_rate'].'" id="wrate">
                        <br>
                        Selling Rate
                        <input type="number" class="form-control" placeholder="Retail Rate" value="'.$rows['Selling_rate'].'" id="rrate">
                        
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <input type="reset" class="btn btn-primary" onclick="upProduct('.$showUpId.')" data-dismiss="modal" value="Save changes">
                        </div>  
                      </form>
            ';
        }
        echo $data;
    }
}
//delete from inventory
if(isset($_POST['delid']))
{
    $sql="DELETE FROM SMM.Products WHERE PID=$delid";
    $res=mysqli_query($con,$sql);
}
//show inventory details
if(isset($_POST['show']))
{
    $sql="SELECT PID, Product_name, Quantity, MRP, Purchased_rate, Selling_rate, Manufacturer, Purchased_date, Wholesale_rate FROM Products ORDER BY Quantity;
    ";
    $data='
    <table class="table ">
    ';
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($rows=mysqli_fetch_array($result))
        {
            
                $data.='
            <tr rowspan="2">
            <td ><b>'.$rows['Product_name'].', '.$rows['Manufacturer'].'</b></td>
            <td>Purchased Rate ₹ '.$rows['Purchased_rate'].'</td>
            <td>Instock Quantity '.$rows['Quantity'].'</td>
            <td><button class="btn btn-block btn-warning" data-toggle="modal" onclick="showUpData('.$rows['PID'].')" data-target="#updateModal"><span class="glyphicon glyphicon-pencil"></span></button></td>
            </tr>
            <tr >
            
            <td rowspan="2">MRP ₹'.$rows['MRP'].'</td>
            <td >Wholesale Rate ₹ '.$rows['Wholesale_rate'].'</td>
            <td rowspan="2">Date '.date("d-m-Y",strtotime($rows['Purchased_date'])).'</td>
            <td><button class="btn btn-block btn-danger" onclick="deleteItem('.$rows['PID'].')"><span class="glyphicon glyphicon-trash"></span></button></td>
            </tr>
            <tr>
            
            <td>Selling Rate ₹ '.$rows['Selling_rate'].'</td>
            </tr>
            <tr>
            
            </tr>
            ';
            
        }
        $data.='</table>';
        echo $data;
    }
}
//add products
if(isset($_POST['pname']) && isset($_POST['manf'])&& isset($_POST['qty']) && isset($_POST['mrp']) && isset($_POST['prate']) && isset($_POST['wrate']) && isset($_POST['rrate']) && isset($_POST['payment']) && isset($_POST['isInstock']))
{
    $date=date("Y-m-d");
    $sql1="SELECT * FROM Products WHERE Product_name='".$pname."' AND Manufacturer='".$manf."' AND MRP=$mrp";
    $PO=$_SESSION["PO_no"];
    $res1=mysqli_query($con,$sql1);
    if(mysqli_num_rows($res1)>0)
    {
        echo "This Product already exists!!!";
        echo $sql1;
    }
    else
    {
        $sql2="INSERT INTO Products (Product_name, Quantity, MRP, Purchased_rate, Selling_rate, Manufacturer, Purchased_date, Wholesale_rate, Payment,Order_number,isInstock) VALUES('".$pname."', $qty, $mrp, $prate, $rrate,'".$manf."', '".$date."',$wrate,'".$payment."',$PO,'".$isInstock."');
        ";
        $res2=mysqli_query($con,$sql2);
        if($res2)
        {
            echo "Inserted";
        }
        else
        {
            echo $sql2;
        }
    }
}
//login
if(isset($_POST['usr']) && isset($_POST['pwd']) )
{
    $pwd=mysqli_real_escape_string($con,$_POST['pwd']);
    $sql="select * from Vendors where Vendor_name='".$usr."' and Password='".$pwd."'";
    $res=mysqli_query($con,$sql);
    
    if(mysqli_num_rows($res)>0)
    {
        $_SESSION["usr"]=$usr;
        if($usr=='Prasad')
        {
            $_SESSION["uid"]=1;
        }
        elseif($usr=='Kavitha')
        {
            $_SESSION["uid"]=2;
        }
        elseif($usr=='Keerthan')
        {
            $_SESSION["uid"]=3;
        }
        elseif($usr=='Vinay')
        {
            $_SESSION["uid"]=4;
        }
        $_SESSION["order_no"]=rand(10000,99999);
        $_SESSION["PO_no"]=rand(10000,99999);
        $_SESSION['mode']='edit';
        echo 1;
    }
    else
    {
        echo 0;
    }
}
?>