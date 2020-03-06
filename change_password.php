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
  $old_password=((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
  $old_password=(trim($old_password));
  $password=((isset($_POST['password']))?sanitize($_POST['password']):'');
  $password=(trim($password));
  $confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
  $confirm=(trim($confirm));
  $new_hashed=password_hash($password, PASSWORD_DEFAULT);
  $errors=array();

  ?>
  <!--partea de css este comuna.. asa ca am preferat ca aceste elemente de stil fiind necesare doar aici, sa le scriu aici -->
  <head>
  <style>
  body{
    background-image: url("images/ceasbuz.jpg");
    background-size: 100vw 100vh;
    background-attachment: fixed;
  }
</style>
</head>

    <?php
      if($_POST){

      if (strlen($password)<6) {
        $errors[]='Password should be 6 characters or more';
      }

        //verificam daca este la fel cu cea din baza de date;
        if(!password_verify($old_password, $hashed) || strcmp($password, $confirm)!=0)
        {
          $errors[]='Counter check and retry!';
        }
        if (!empty($errors)) {
          echo display_errors($errors);
        }
        else{
          $db->query("UPDATE users SET password='$new_hashed' where id='$user_id'");

          $_SESSION['success_flash']='Password changed successfully!';
          header('Location:index.php');
        }
      }
     ?>
  </div>
  <div class="col-md-6 col-md-offset-2">
    <div class="panel panel-primary">
      <div class="panel-heading">Update Password</div>
          <div class="panel-body">
              <form class="form-horizontal" method="post" action="change_password.php">
                  <div class="form-group">
                      <label class="control-label col-md-3">Old Password</label>
                          <div class="col-md-9">
                              <input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">New Password</label>
                          <div class="col-md-9">
                              <input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">&nbsp;</label>
                          <div class="col-md-9">
                              <a href="index.php"><input type="button" name="login" value="Cancel" class="btn btn-primary btn-lg"></a>
                              <input type="submit" name="login" value="Change Password" class="btn btn-outline-success btn-lg">
                          </div>
                  </div>
              </form>
          </div>
    </div>
  </div>

 <?php include 'includes/footer.php'; ?>
