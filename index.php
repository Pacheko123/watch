<?php


  require_once 'core/init.php';

  
  if(has_permission('admin')){
    header('Location:admin/index.php');
  }

  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerfull.php';
  include 'includes/leftbar.php';

  $sql="SELECT * from products where oferta=1";
  $oferta=$db->query($sql);
?>

<div class="col-md-8">
  <div class="row">
    <h2 class="text-center">Products offer</h2>
   
    <?php while($item=mysqli_fetch_assoc($oferta)) : ?>
    <div class="col-sm-3 text-center">
      <h4><?php echo $item['title']?></h4>
      <img src="<?php echo $item['image']?>" alt="<?php echo $item['title']?>" class="img-thumb"/>
      <p class="list-price text-danger">Before:<s>$<?php echo $item['list_price']?></s></p>
      <p class="price">Now: $<?php echo $item['price']?></p>
      
      <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $item['id']; ?>)">Details</button>
    </div>
  <?php endwhile; ?>
  </div>
</div>
<?php
  include 'includes/rightbar.php';
  include 'includes/footer.php';
  ?>
