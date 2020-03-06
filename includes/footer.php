

</div><br><br>
<!--footer=-->
<footer class="col-md-12 text-center" id="footer"><b>&copy; Copyright  <?php $year = date("Y");  echo $year. " "; ?>Availawatch by <a href="https://pacheko123.github.io/pac"> Pacheko Inc.</b></a><br>
<br>
<a href="contact.php" class="btn btn-primary"><span class="glyphicon glyphicon-phone"></span>Contact Us!</a></footer>
<script>
//cu ajutorul acestei functii, logoul gliseaza pe imaginea din headerfull pana cand nu se mai vede
jQuery(window).scroll(function(){
  var vscroll=jQuery(this).scrollTop();
  jQuery('#logotext').css({
    "transform":"translate(0px,"+vscroll/2+"px)"})
});
//trimitem catre detailsmodal.php id-ul produsului
function detailsmodal(id){
  //data ce urmeaza a fi trimisa, respectiv id-ul..
  var data={"id" : id };
  jQuery.ajax({
    url:'includes/detailsmodal.php',
    method:"post",
    data: data,
    success: function(data){
      //in case of success, we add to the home page the next piece of html code with the id # details-modal
      jQuery('body').append(data);
      jQuery('#details-modal').modal('toggle');
    },
    error: function(){
      alert("Something went wrong... ");
    }
  });
};

function update_cart(mode,edit_id){
  var data={"mode": mode, "edit_id":edit_id};
  jQuery.ajax({
    url: 'admin/parser/update_cart.php',
    method:"post",
    data:data,
    success:function(){
      location.reload();
    },
    error: function(){alert("Something went wrong...");}
  });

}

function add_to_cart(id,available){
  jQuery('#modal_error').html("");
  var quantity=jQuery('#quantity').val();
  var product_id=id;
  var error='';
 if(quantity==''||quantity==0){
  error+='<p class="text-danger text-center">Quantity cannot be less than 1!</p>';
  jQuery('#modal_errors').html(error);
  return;
  }   else if(quantity>available){
    error+='<p class="text-danger text-center">The quantity you\'ve provided has exceeded the stock!</p>';
     jQuery('#modal_errors').html(error);
     return;
   }
   else{
    jQuery.ajax({
      // url: 'admin/parser/add_cart.php',
      url: 'includes/add_cart.php',
      method: 'post',
      data:{'product_id': id, 'quantity':quantity, 'available':available },
      success: function(){
       // location.reload();
       alert("Successfully added to cart");
       location.reload();

      },
      error: function(){
        alert("Something went wrong");
      }

    });
   }
};

    </script>
  </body>
</html>
