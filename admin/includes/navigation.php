<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
    <h2><a href="../index.php" class="navbar-brand"> Availawatch Administration</a><br></h2>
      <ul class="nav navbar-nav">

        <li><a href="brands.php">Brands</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="users.php">Users</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage account  <?php echo $user_data['first']; ?>!<span class="caret"> </span</a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="../change_password.php">Update password</a></li>
            <li><a href="../logout.php">Log out</a></li>


          </ul>

        </li>




          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">aaaaaaaa<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">aaaaaaaa</a></li>
            </ul>
          </li> -->
      </ul>

    </div>
</nav>
