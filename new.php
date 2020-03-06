<?php
  // require_once $_SERVER['DOCUMENT_ROOT'].'./_webProject/core/init.php';
  require_once 'core/init.php';
  include 'includes/head.php';

    $name=((isset($_POST['name']))?sanitize($_POST['name']):'');
    $email=((isset($_POST['email']))?sanitize($_POST['email']):'');
    $password=((isset($_POST['password']))?sanitize($_POST['password']):'');
    $confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $adresa=((isset($_POST['adresa']))?sanitize($_POST['adresa']):'');
    $telefon=((isset($_POST['telefon']))?sanitize($_POST['telefon']):'');

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
<link type="text/css" rel="css/bootstrap.min.css">
</head>
<!-- <div class="" id="login-form">
  <div > -->
    <?php
      if($_POST){
        $emailQuery=$db->query("SELECT * from users where email='$email'");
      $emailCount=mysqli_num_rows($emailQuery);

      if($emailCount!=0){
        $errors[]='Email already in use!';
      }
      $required=array('name','email','adresa','telefon','password','confirm');
      foreach ($required as $f) {
        if (empty($_POST[$f])) {
          $errors[]='Please enter all the fields!';
          break;
        }
      }
      if(strlen($password)<6)
      {
        $errors[]='Password must not be less than 6 characters!';
      }
      if($password!=$confirm)
      {
        $errors[]='Password mismatch!';
      }
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $errors[]='Please ensure you enter a valid email address!';
      }
      if(!empty($errors))
      {
        echo display_errors($errors);
      }
      else{
        //add user_data
        $hashed=password_hash($password,PASSWORD_DEFAULT);
        $db->query("INSERT into users (full_name,email, telefon, adresa, password,permissions) values('$name','$email','$telefon','$adresa','$hashed','user') ");

        $_SESSION['succes_flash']='Contul a fost creat cu succes!';
        header('Location:login.php');
      }
      }

      //sa fac functia de reset...
     ?>
  <!-- </div> -->

  <div class="col-md-6 col-md-offset-2">
    <div class="panel panel-primary">
      <div class="panel-heading">Create an account for free</div>
          <div class="panel-body">
              <form class="form-horizontal" method="post" action="new.php">
                  <div class="form-group">
                      <label class="control-label col-md-3">Name:</label>
                          <div class="col-md-9">
                              <input type="text" name="name" id="name" class="form-control">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Email:</label>
                          <div class="col-md-9">
                              <input type="text" name="email" id="email" class="form-control">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Phone number</label>
                          <div class="col-md-9">
                              <input type="number" class="form-control" name="telefon" id="telefon" min="1" max="100000000000">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Location:</label>
                          <div class="col-md-9">
                              <input type="password" name="adresa" id="adresa" class="form-control">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Password:</label>
                          <div class="col-md-9">
                              <input type="text" name="password" id="password" class="form-control" >
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Confirm password:</label>
                          <div class="col-md-9">
                              <input type="text" name="confirm" id="confirm" class="form-control">
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



      <!-- <h2 class="text-center">Create an account for free</h2<hr>
      <form class="text-center" style="margin-top:15px;" action="new.php" method="post">
        <div class="form-group">
  <div class="row">
        <div class="form-group  col-md-5">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
        </div>
        <div class="form-group col-md-5">
          <label for="email">Email:</label>
          <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
        </div>
        <div class="form-group col-md-5">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
        </div>
        <div class="form-group  col-md-5">
          <label for="confirm">Confirm password:</label>
          <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
        </div>
        <div class="form-group col-md-5 ">
          <label for="telefon">Phone number:</label>
          <input type="text" name="telefon" id="telefon" class="form-control" value="<?=$telefon;?>">
        </div>
        <div class="form-group col-md-5 ">
          <label for="adresa">Location:</label>
          <input type="text" name="adresa" id="adresa" class="form-control" value="<?=$adresa;?>">
        </div>
        <div class="form-group col-md-5 text-right" style="margin-top:10px;">
          <a href="index.php" class="btn btn-default">Cancel</a>
          <input type="submit" name="" value="Submit" class="btn btn-primary">

        </div>


</div></div>

      </form>

  <p class="text-right"><a href="index.php" alt="home">Home</a></p>
</div>
 -->

 <?php include 'includes/footer.php'; ?>
