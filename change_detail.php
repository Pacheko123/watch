<?php
  // require_once $_SERVER['DOCUMENT_ROOT'].'./_webProject/core/init.php';
  require_once 'core/init.php';
  if(!is_logged_in())
  {
    login_error_redirect();
  }
  include 'includes/head.php';
  $hashed=$user_data['password'];
  $user_id=$user_data['id'];
  $resource=$db->query("SELECT * from users where id='{$user_id}'");
  $res=mysqli_fetch_assoc($resource);
  $emaill=$res['email'];

  $old_password=((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
  $name=((isset($_POST['name']))?sanitize($_POST['name']):$res['full_name']);
  $adresa=((isset($_POST['adresa']))?sanitize($_POST['adresa']):$res['adresa']);
  $telefon=((isset($_POST['telefon']))?sanitize($_POST['telefon']):$res['telefon']);

  $old_password=(trim($old_password));

  $errors=array();

  ?>
  <!--partea de css este comuna.. asa ca am preferat ca aceste elemente de stil fiind necesare doar aici, sa le scriu aici -->
  <head>
  <style>
  body{
    background-image: url("images/ceasbuz1.jpg");
    background-size: 100vw 100vh;
    background-attachment: fixed;
  }
</style>
</head>
<!-- <div class="" id="login-form"> -->
    <?php
      if($_POST){
        //form validare
        if(empty($_POST['old_password']))
        {
          $errors[]='Kindly enter your password';
        }

        if(!password_verify($old_password, $hashed))
        {
          $errors[]='Counter check your password!';
        }
        if (!empty($errors)) {
          echo display_errors($errors);
        }
        else{
          $db->query("UPDATE users SET full_name='$name', adresa='$adresa', telefon='$telefon' where id='$user_id'");

          $_SESSION['success_flash']='Profile updated successfully!';
          header('Location:index.php');
        }
      }
     ?>

     <div class="col-md-6 col-md-offset-2">
       <div class="panel panel-primary">
         <div class="panel-heading">Modify profile</div>
             <div class="panel-body">
                 <form class="form-horizontal" method="post" action="change_detail.php">
                     <div class="form-group">
                         <label class="control-label col-md-3">Name:</label>
                             <div class="col-md-9">
                                 <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
                             </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3">Email:</label>
                             <div class="col-md-9">
                                 <input type="text" name="email" id="email" class="form-control" readonly value="<?=$res['email'];?>">
                             </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3">Location:</label>
                             <div class="col-md-9">
                                 <input type="text" name="adresa" id="adresa" class="form-control" value="<?=$adresa;?>">
                             </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3">Phone number:</label>
                             <div class="col-md-9">
                                 <input type="text" name="telefon" id="telefon" class="form-control" value="<?=$telefon;?>">
                             </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3">Old Password</label>
                             <div class="col-md-9">
                                 <input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
                             </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3">&nbsp;</label>
                             <div class="col-md-9">
                                <a href="index.php"><input type="button" name="login" value="Cancel" class="btn btn-primary btn-lg"></a>
                                 <input type="submit" name="login" value="Update profile" class="btn btn-outline-success btn-lg">
                             </div>
                     </div>
                 </form>
             </div>
       </div>
     </div>


 <?php include 'includes/footer.php'; ?>
