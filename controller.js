function makePay(onum)
{
  pay='makePay';
  var conf=confirm("Are you sure??");
  if(conf==true)
  {
    $.ajax({
      url:'backend.php',
      type:'post',
      data:{
        onum:onum,
        pay:pay
      },
      success:function(response)
      {
        if(response==1)
        {
          alert("Payment Successful")
        }
        showPurchaseCredits();
      }
    });
  }
}
function showCreds(onum)
{
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
      onum:onum
    },
    success:function(data,status)
    {
      $('#showCreds').html(data);
    }
  });
}
function showPurchaseCredits()
{
  var from=$('#from').val();
  var to=$('#to').val();
  const date1=new Date(from);
  const date2=new Date(to);
  showCredits='showCredits';
  if(from!='' && to!='')
  {
    if(date1>date2)
    {
      alert("from date is greater than to date")
    }
    else{
      $.ajax({
        url:'backend.php',
        type:'post',
        data:{
          from:from,
          to:to,
          showCredits:showCredits
        },
        success:function(data,status)
        {
          $('#pcreds').html(data);
        }
      });
    }
  }
  else{
    alert("Enter all the fields")
  }
}
function viewBill(cid,oid)
{
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
      cid:cid,
      oid:oid
    },
    success:function(data,status)
    {
      window.location="Cart.php";
    }
  })
}
function showSales(purpose)
{
  var from=$('#from').val();
  var to=$('#to').val();
  const date1=new Date(from);
  const date2=new Date(to);
  if(from!='' && to!='')
  {
    if(date1>date2)
    {
      alert("from date is greater than to date")
    }
    else{
      $.ajax({
        url:'backend.php',
        type:'post',
        data:{
          from:from,
          to:to,
          purpose:purpose
        },
        success:function(data,status)
        {
          $('#sales').html(data);
        }
      });
    }
  }
  else{
    alert("Enter all the fields")
  }
}
function logOut()
{
  logout="logout";
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
      logout:logout
    },
    success:function(response)
    {
      if(response==1)
      {
        window.location="index.html";
      }
     }
  });
}
function printBill()
{
  $("#print").hide();
  $("#checkout").hide();
  window.print()
  $("#print").show();
  $("#checkout").show();
}
function getBill(oid,cid)
{
  Getbill="getBill";
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
      Getbill:Getbill
    },
    success:function(data,status)
    {
      $('#bill').html(data);
     }
  });
}
function checkOut(oid,sum)
{
  if(sum==0)
  {
    alert("Cannot checkout cart total is zero")
  }
  else{
    var payment=$('#cartPay').val();
    var conf=confirm(" Order Id "+oid+" Payment Method: "+payment)
    if(conf==true)
    {
      $.ajax({
        url:'backend.php',
        type:'post',
        data:{
            checkOutID:oid,
            Payment:payment
        },
        success:function(response)
        {
           if(response==1)
           {
              alert("done")
              window.location="generateBill.php";
           }
           else
           {
              alert(response)
           }
         }
      });
    }
  }
}
function delCart(pid)
{
  var conf=confirm("Are you sure?")
  if(conf==true)
  {
    $.ajax({
      url:'backend.php',
      type:'post',
      data:{
          delCartItem:pid
      },
      success:function(response)
      {
         showCart();
       }
    });
  }
}
function upCart(pid,rate)
{
  var qty=$('#qty'+pid).val()
  var total=rate*qty;
  var todo='update';
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
        pid:pid,
        rate:rate,
        qty:qty,
        total:total,
        todo:todo
    },
    success:function(response)
    {
      alert(response)
       showCart();
    }
  });
}
function showCart()
{
  var show='showCart';
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
        showCart:show,
    },
    success:function(data,status)
    {
       $('#records').html(data);
     }
  });
}
function addCart(pid,rate)
{
  var qty=$('#qty'+pid).val()
  var total=rate*qty;
  var todo='add';
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
        pid:pid,
        rate:rate,
        qty:qty,
        total:total,
        todo:todo
    },
    success:function(data,status)
    {
       alert("Done");
    }
  });
}
function setSession()
{
  var cusname=$('#cusname').val()
  var fone=$('#fone').val()
  var custype=$('#custype').val()
  var phoneno = /^\d{10}$/;
  fone.toString()
  if(cusname!='' && fone!='')
  {
    if(fone.match(phoneno))
    {
      $.ajax({
        url:'backend.php',
        type:'post',
        data:{
            cusname:cusname,
            fone:fone,
            custype:custype
        },
        success:function(response)
        {
           if(response==1)
           {
            window.location="Menu.php";
           }
        }
      });
    }
    else
    {
      alert("phone number must be minimum of 10 digits") 
    }
  }
  else{
    alert("Enter all the fields!!!")
  }
}
function showBillDesk(custype)
{
  var show='showBillDesk';
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
        showBillDesk:show,
        type:custype
    },
    success:function(data,status)
    {
       $('#records').html(data);
     }
  });
}
function upProduct(pid)
{
  pname=$('#pname').val();
  manf=$('#manf').val();
  qty=$('#qty').val();
  mrp=$('#mrp').val();
  prate=$('#prate').val();
  wrate=$('#wrate').val();
  rrate=$('#rrate').val();
  qty=parseFloat(qty)
  mrp=parseFloat(mrp)
  prate=parseFloat(prate)
  wrate=parseFloat(wrate)
  rrate=parseFloat(rrate)
  if(pname!='' && manf!='' && qty!='' && mrp!='' && prate!='' && wrate!='' && rrate!='')
  {
    if(prate>mrp || rrate<wrate || rrate>mrp || wrate>mrp || qty==0 || prate==0 || wrate==0 || rrate==0)
    {
      if(prate>mrp)
      {
        alert("Purchased rate is greater than MRP");
      }
      else if(rrate<wrate){
        alert("Retail rate is greater than wholesale rate");
      }
      else if(rrate>mrp)
      {
        alert("Retail rate is greater than MRP");
      }
      else if(wrate>mrp)
      {
        alert("Wholesale rate is greater than MRP");
      }
      else if(qty==0)
      {
        alert("Quantity cannot be zero!!!")
      }
      else if(prate==0)
      {
        alert("Purchased Rate cannot be zero!!!")
      }
      else if(wrate==0)
      {
        alert("Wholesale Rate cannot be zero!!!")
      }
      else if(rrate==0)
      {
        alert("Retail Rate cannot be zero!!!")
      }
    }
    else{
      $.ajax({
        url:'backend.php',
        type:'post',
        data:{
         pid:pid,
         pname:pname,
         manf:manf,
         qty:qty,
         mrp:mrp,
         prate:prate,
         wrate:wrate,
         rrate:rrate
        },
        success:function(response)
        {
          alert(response)
          showProducts();
        }
      });
    }
  }
}
function showUpData(pid)
{
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
        showUpId:pid
    },
    success:function(data,status)
    {
      $('#showUpForm').html(data);
       showProducts();
     }
  });
}
function deleteItem(pid)
{
  var conf=confirm("Are you sure?")
  if(conf==true)
  {
    $.ajax({
      url:'backend.php',
      type:'post',
      data:{
          delid:pid
      },
      success:function(data,status)
      {
         showProducts();
       }
    });
  }
}
function showProducts()
{
  var show='show';
  $.ajax({
    url:'backend.php',
    type:'post',
    data:{
        show:show,
    },
    success:function(data,status)
    {
       $('#records').html(data);
     }
  });
}
function addProduct()
{
  pname=$('#pname').val();
  manf=$('#manf').val();
  qty=$('#qty').val();
  mrp=$('#mrp').val();
  prate=$('#prate').val();
  wrate=$('#wrate').val();
  rrate=$('#rrate').val();
  payment=$('#payment').val();
  isInstock=$('#instock').val();
  qty=parseFloat(qty)
  mrp=parseFloat(mrp)
  prate=parseFloat(prate)
  wrate=parseFloat(wrate)
  rrate=parseFloat(rrate)
  if(pname!='' && manf!='' && qty!='' && mrp!='' && prate!='' && wrate!='' && rrate!='')
  {
    if(prate>mrp || rrate<wrate || rrate>mrp || wrate>mrp || qty==0 || prate==0 || wrate==0 || rrate==0)
    {
      if(prate>mrp)
      {
        alert("Purchased rate is greater than MRP");
      }
      else if(rrate<wrate){
        alert("Retail rate is greater than wholesale rate");
      }
      else if(rrate>mrp)
      {
        alert("Retail rate is greater than MRP");
      }
      else if(wrate>mrp)
      {
        alert("Wholesale rate is greater than MRP");
      }
      else if(qty==0)
      {
        alert("Quantity cannot be zero!!!")
      }
      else if(prate==0)
      {
        alert("Purchased Rate cannot be zero!!!")
      }
      else if(wrate==0)
      {
        alert("Wholesale Rate cannot be zero!!!")
      }
      else if(rrate==0)
      {
        alert("Retail Rate cannot be zero!!!")
      }
    }
    else
    {
      $.ajax({
        url:'backend.php',
        type:'post',
        data:{
         pname:pname,
         manf:manf,
         qty:qty,
         mrp:mrp,
         prate:prate,
         wrate:wrate,
         rrate:rrate,
         payment:payment,
         isInstock:isInstock
        },
        success:function(response)
        {
          alert(response)
          showProducts();
        }
      });
    }
  }
  else
  {
    alert("Please Enter all Fields!!!");
  }
}
function login()
{
    var usr=$('#usr').val();
    var pwd=$('#pwd').val();
    $(document).on('change','#usr',function(){
        usr=$('#usr').val();
    })
    if(pwd=='')
    {
        alert("Enter Password Please!!!");
    }
    else
    {
        $.ajax({
            url:'backend.php',
            type:'post',
            data:{
              usr:usr,
              pwd:pwd
            },
            success:function(response)
            {
              if(response==1)
              {
                  window.location="customer.html";
              }
              else
              {
                  alert("Wrong Password Please Try Again!!!")
              }
            }
          });
    }
    
}
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
  }
  
  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
  }