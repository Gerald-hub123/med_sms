<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			//select last 5 retialers
			$query_selectRetailer = "SELECT * FROM retailer,area WHERE retailer.area_id=area.area_id ORDER BY retailer_id DESC LIMIT 5";
			$result_selectRetailer = mysqli_query($con,$query_selectRetailer);
			//select last 5 manufacturers
			$query_selectManufacturer = "SELECT * FROM manufacturer ORDER BY man_id DESC LIMIT 5";
			$result_selectManufacturer = mysqli_query($con,$query_selectManufacturer);
			//select last 5 products
			$query_selectProducts = "SELECT * FROM products,categories,unit WHERE products.pro_cat=categories.cat_id AND products.unit=unit.id ORDER BY pro_id DESC LIMIT 5";
			$result_selectProducts = mysqli_query($con,$query_selectProducts);
		}
		else {
			header('Location:../index.php');
		}
	}
	else {
		header('Location:../index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Admin: Home </title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1><center>Welcome Admin</center></h1>




		<body>
			<p><big><b>welcome to the admin panel. in this section the system administrater can;</b></big>
				<small><ul>

				<li>1. Add products,</li>
				<li>2. Add and manage available products</li>
				<li>3. Add the hospitals</li> 
				<li>4. Add drivers</li>
				<li>5. Manage unit and categories of products</li>
				<li>6. Add and manager hospital managers</li>
				<li>6. Manage and edit their profiles </li>
				<li>7. Managing the number of suppliers who can and will operate using this system.</li>
				</small>
			</ul>
				<br>

				<p><center><big>   -> Basically this panel is to be used by the Technical support team to ensure that the system is serving the intended functions to all the portals using it.</big></center></p>

			</body>
			<br>
			<br>
			<br>
			<article>
			<h2>Recently Added Hospital Managers</h2>
			<table class="table_displayData">
				<tr>
					<th>Sr. No.</th>
					<th>Username</th>
					<th>Area Code</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Address</th>
				</tr>
				<?php $i=1; while($row_selectRetailer = mysqli_fetch_array($result_selectRetailer)) { ?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $row_selectRetailer['username']; ?> </td>
					<td> <?php echo $row_selectRetailer['area_code']; ?> </td>
					<td> <?php echo $row_selectRetailer['phone']; ?> </td>
					<td> <?php echo $row_selectRetailer['email']; ?> </td>
					<td> <?php echo $row_selectRetailer['address']; ?> </td>
				</tr>
				<?php $i++; } ?>
			</table>
		</article>
		
		<article>
			<h2>Recently Added Manufacturers</h2>
			<table class="table_displayData">
			<tr>
				<th>Sr. No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Username</th>
			</tr>
			<?php $i=1; while($row_selectManufacturer = mysqli_fetch_array($result_selectManufacturer)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectManufacturer['man_name']; ?> </td>
				<td> <?php echo $row_selectManufacturer['man_email']; ?> </td>
				<td> <?php echo $row_selectManufacturer['man_phone']; ?> </td>
				<td> <?php echo $row_selectManufacturer['username']; ?> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		</article>
		
		<article>
			<h2>Recently Added Products</h2>
			<table class="table_displayData">
			<tr>
				<th> Code </th>
				<th> Name </th>
				<th> Price </th>
				<th> Unit </th>
				<th> Category </th>
				<th> Quantity </th>
			</tr>
			<?php $i=1; while($row_selectProducts = mysqli_fetch_array($result_selectProducts)) { ?>
			<tr>
				<td> <?php echo $row_selectProducts['pro_id']; ?> </td>
				<td> <?php echo $row_selectProducts['pro_name']; ?> </td>
				<td> <?php echo $row_selectProducts['pro_price']; ?> </td>
				<td> <?php echo $row_selectProducts['unit_name']; ?> </td>
				<td> <?php echo $row_selectProducts['cat_name']; ?> </td>
				<td> <?php if($row_selectProducts['quantity'] == NULL){ echo "N/A";} else {echo $row_selectProducts['quantity'];} ?> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		</article>
	</section>
	<?php
		include("../includes/footer.inc.php");
	?>
</body>
</html>