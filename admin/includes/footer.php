</div><br><br>
<!--footer=-->
<footer class="col-md-12 text-center" id="footer">&copy; Copyright <?php $year = date("Y");  echo $year. " "; ?>Availawatch by Pacheko Inc.</footer>
<script>
  function get_child_options(){
    var parentID=jQuery('#parent').val();
    jQuery.ajax({
      url:'../parser/child_categories.php',
      type:'POST',
      data:{parentID : parentID},
      success:function(data){
        jQuery('#child').html(data);
      },
      error:function(){alert("Ceva a mers prost cu subcategoria")}
    });

  }
  jQuery('select[name="parent"]').change(get_child_options);

</script>
       </body>
   </html>
