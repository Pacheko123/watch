<?php
  // require_once $_SERVER['DOCUMENT_ROOT'].'./_webProject/core/init.php';
  require_once 'core/init.php';
  include 'includes/head.php';

  $email=((isset($_POST['email']))?sanitize($_POST['email']):'');
  $email=(trim($email));
  $password=((isset($_POST['password']))?sanitize($_POST['password']):'');
  $password=(trim($password));
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
<!-- <div class="" id="login-form">
  <div > -->
    <?php
      if($_POST){
        //form validare
        if(empty($_POST['email']))
        {
          //$errors[]='Trebuie sa introdceti emailul!';
        }
        if (empty($_POST['password'])) {
          //$errors[]='Trebuie sa introdceti parola!';
        }
        //validare email
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        //$errors[]='Trebuie sa introduci o adresa de email valida!';
      }

        //verificam daca exista in baza de database
        $query=$db->query("SELECT * from users where email='$email'");
        $user=mysqli_fetch_assoc($query);
        $userCount=mysqli_num_rows($query);
        if($userCount<1){
          // $errors[]='No user with the email address!';
        }
        //verificam daca este la fel cu cea din baza de date;
        if(!password_verify($password, $user['password']) || $userCount<1)
        {
          $errors[]='Counter check your credentials!';
        }

        if (!empty($errors)) {
          echo display_errors($errors);
        }
        else{
          //acept
          $user_id=$user['id'];
          login($user_id);
        }
      }

      //sa fac functia de reset...
     ?>
  </div>

  <div class="col-md-6 col-md-offset-2">
    <div class="panel panel-primary">
      <div class="panel-heading">Login</div>
          <div class="panel-body">
              <form class="form-horizontal" method="post" action="login.php">
                  <div class="form-group">
                      <label class="control-label col-md-3">Email Address</label>
                          <div class="col-md-9">
                              <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Password</label>
                          <div class="col-md-9">
                              <input type="password" name="password" id="password" class="form-control">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">&nbsp;</label>
                          <div class="col-md-9">
                              <a href="index.php"><input type="button" name="login" value="Cancel" class="btn btn-primary btn-lg"></a>
                              <input type="submit" name="login" value="Login" class="btn btn-primary btn-lg">
                          </div>
                  </div>
              </form>
          </div>
    </div>
  </div>


  <!-- <h2 class="text-center">Login</h2><hr>
  <form action="login.php" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
    </div>
    <div class="form-group">
     <input type="button" value="Reset" class="btn btn-primary">
      <input type="submit" value="Login" class="btn btn-primary">
    </div>
  </form>
  <p class="text-right"><a href="index.php" alt="home">Stores</a></p>
</div> -->


 <?php include 'includes/footer.php'; ?>

<!-- </div> -->
