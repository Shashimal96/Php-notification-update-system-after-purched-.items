<?php 
session_start();
if(!isset($_SESSION['USER_LOGIN']) || $_SESSION['USER_LOGIN'] != "yes") {
    header("Location: login.php"); 
    exit();
}
require ('top.php');
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && $_POST['name'] != '' && $_POST['email'] != '' && $_POST['mobile'] != ''){
   if(isset($_POST['psw']) && $_POST['psw'] != ''){
     $sql="UPDATE users SET name='".$_POST['name']."', email='".$_POST['email']."', mobile='".$_POST['mobile']."', password='".$_POST['psw']."' WHERE id=".$_SESSION['USER_ID'].";";
   } else {
     $sql="UPDATE users SET name='".$_POST['name']."', email='".$_POST['email']."', mobile='".$_POST['mobile']."' WHERE id=".$_SESSION['USER_ID'].";";
   }
   $res=mysqli_query($con,$sql);
 }

if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] !=''){
   $sql="select * from users WHERE id=".$_SESSION['USER_ID'].";";
   $res=mysqli_query($con,$sql);
   $row=mysqli_fetch_assoc($res);
 }
?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Dashboard</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                       <form method="POST">
                        <table style="margin-left:auto; margin-right:auto;">
                           <tr>
                              <th>Name</th>
                              <td style="padding-top:2vh; padding-bottom:2vh;">&nbsp; : &nbsp;</td>
                              <td><input type="text" placeholder="Name" name="name" value=<?php echo $row['name']; ?> style="padding-left:1vh; padding-right:1vh; border:none;" required></input></td>
                           </tr>
                           <tr>
                              <th>Email</th>
                              <td style="padding-top:2vh; padding-bottom:2vh;">&nbsp; : &nbsp;</td>
                              <td><input type="email" placeholder="Email" name="email" value=<?php echo $row['email']; ?> style="padding-left:1vh; padding-right:1vh; border:none;" required></input></td>
                           </tr>
                           <tr>
                              <th>Mobile</th>
                              <td style="padding-top:2vh; padding-bottom:2vh;">&nbsp; : &nbsp;</td>
                              <td><input type="text" placeholder="Mobile" name="mobile" value=<?php echo $row['mobile']; ?> style="padding-left:1vh; padding-right:1vh; border:none;" required></input></td>
                           </tr>
                           <tr>
                              <th>Password</th>
                              <td style="padding-top:2vh; padding-bottom:2vh;">&nbsp; : &nbsp;</td>
                              <td><input type="password" placeholder="Enter new password" name="psw" value="" style="padding-left:1vh; padding-right:1vh; border:none;"></input></td>
                           </tr>
                           <tr>
                              <th>Registered on:</th>
                              <td style="padding-top:2vh; padding-bottom:2vh;">&nbsp; : &nbsp;</td>
                              <td style="padding-left:1vh; padding-right:1vh;"><?php echo $row['added_on']; ?></td>
                           </tr>
                           <tr>
                              <td><br><button type="submit">Update Profile</button></td>
                           </tr>
                        </table>
</form>
                        <br><br><br>
                    </div>
                </div>
            </div>
        <!-- cart-main-area end -->
    
       
<?php require ('footer.php')?>