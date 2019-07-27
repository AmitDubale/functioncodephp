<?php 
require_once('DB.Config.php');
require_once('Core.php');
require_once('Function.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert Update Delete Code PHP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-8"><br/>
				<center><h3>Insert Contact Us Form</h3></center>
				<div class="contactform">
					<table class="table table-striped table-bordered">
						<tr>
							<th>Stud Id</th>
							<th>Full Name</th>
							<th>Email Id</th>
							<th>Phone No</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>
						<?php 
						$info=selectAll("home_slider_images","img_id","DESC");
						$srno=1;
						if(count($info)>0){
						foreach($info as $p){	
						?>
						<tr>
							<td><?php echo $res['stud_id']; ?></td>
							<td><?php echo $res['fullname']; ?></td>
							<td><?php echo $res['email']; ?></td>
							<td><?php echo $res['contact']; ?></td>
							<td><button><a href="update.php?stud_id=<?php echo $res['stud_id']; ?>">Update</a></button></td>
							<td><button><a href="delete.php?stud_id=<?php echo $res['stud_id']; ?>">Delete</a></button></td>
						</tr>
						<?php $srno++; } } ?>
					</table>
				</div>
			</div>
			<div class="col-md-4">
				<img src="images/contatto.png" class="img-responsive">
			</div>
		</div>
	</div>

</body>
</html>