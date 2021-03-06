<?php
	require_once '../core/init.php';
  if(!is_logged_in()){
    header('Location:login.php');
  }
  if (!has_permission('admin')) {
    permission_error_redirect('index.php');
  }


  include 'includes/head.php';
  include 'includes/navigation.php';

  $tranQuery=$db->query("SELECT * from transactions");
  ?>
  <h2>Transactions</h2>

	<br>
	<hr>

	<table class="table table-bordered table-striped table-condensed">
		<thead>
			<th>Date</th>
			<th>User</th>
			<th>Address</th>
			<th>Oras</th>
			<th>Judet</th>
			<th>Tara</th>
			<th>Postal Code </th>
			<th>Subtotal</th>
			<th>Taxes</th>
			<th>Total</th>
		</thead>
		<tbody>
			<?php while($tran=mysqli_fetch_assoc($tranQuery)): ?>
				<tr>
					<td><?=$tran['txn_data'];?></td>
					<td><?=$tran['email'];?></td>
					<td><?=$tran['street'];?></td>
					<td><?=$tran['city'];?></td>
					<td><?=$tran['state'];?></td>
					<td><?=$tran['country'];?></td>
					<td><?=$tran['zip_code'];?></td>
					<td><?=$tran['sub_total'];?></td>
					<td><?=$tran['tax'];?></td>
					<td><?=$tran['grand_total'];?></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
  <?php include 'includes/footer.php'; ?>
