<?php 
require_once('DB.Config.php');

if(isset($_GET['id'])!='')
{
$rec=Selectone("student_detail","img_id",$_GET['id']);
$img_names=isset($rec[0]['img_names'])?$rec[0]['img_names']:'';
$pages_links=isset($rec[0]['pages_links'])?$rec[0]['pages_links']:'';
$img_file=isset($rec[0]['img_file'])?$rec[0]['img_file']:'';
$status=isset($rec[0]['status'])?$rec[0]['status']:'';
}
//Delete Item Category
if(isset($_GET['del'])!='')
{
	delete("student_detail","img_id",$_GET['del']);
	$who_add=$_SESSION['LOGGED_USER'];
	$add_datetime=date('Y-m-d H:i:s');
	$data2=array(
		'login_user'=>$who_add,
		'login_datetime'=>$add_datetime,
		'task'=>'img_id Delete',
		'remote_addr'=>$remote_adr,
		'request_uri'=>$request_uri,
		'file'=>$_GET['del']
		);
		insertRecord('logs_master',$data2);
}
//set error array
$err=array();
//Add New Item Category
if(isset($_REQUEST['home_page_slider']))
{

//updated Recode
	if(isset($_GET['id'])!='')
	{
		$img_names=stripslashes(trim(isset($_POST['img_names'])?$_POST['img_names']:''));
		$pages_links=stripcslashes(trim(isset($_POST['pages_links'])?$_POST['pages_links']:''));
		if(isset($_POST['status'])!=''){ $status='Yes';} else { $status='No';}
		$status=$status;
			
		if(empty($img_names)){
		$err[]="Enter images Name";
		}
		
		$compo_file=isset($_FILES["thumb"]["name"])?$_FILES["thumb"]["name"]:'';
		//upload image		
		$thumbnail='';
		if(isset($_POST['oldimage'])!='')
		{
		$thumbnail=$_POST['oldimage'];				
		}	
		if(!empty($_FILES["thumb"]))
		{	
			$allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
			$temp = explode(".", $_FILES["thumb"]["name"]);
			$extension = end($temp);
			
			if ((($_FILES["thumb"]["type"] == "image/gif")
			|| ($_FILES["thumb"]["type"] == "image/jpeg")
			|| ($_FILES["thumb"]["type"] == "image/jpg")
			|| ($_FILES["thumb"]["type"] == "image/pjpeg")
			|| ($_FILES["thumb"]["type"] == "image/x-png")
			|| ($_FILES["thumb"]["type"] == "image/png"))
			&& in_array($extension, $allowedExts)
			) {
			  if ($_FILES["thumb"]["error"] > 0) {
				 $err[]= "Return Code: " . $_FILES["thumb"]["error"] ;
			  } else if(empty($err)){
				if (file_exists("./images/sliderimage/" . $_FILES["thumb"]["name"])) {
				   $err[]= $_FILES["thumb"]["name"] . " already exists. ";
				} else {
					$img_name="IMG_".time().".".$extension;
					move_uploaded_file($_FILES["thumb"]["tmp_name"],
					"images/sliderimage/" . $img_name);	
					$src = "images/sliderimage/".$img_name;
					$dist = "images/sliderimage/thumbnail_".$img_name;
					$thumbnail = 'thumbnail_'.$img_name;
					thumbnail($src, $dist, 1260, 550);						  
				}
			  }
			} else {
			   if($compo_file!=''){
				$err[]= "Invalid File Format";
				}
			}
		}
		
		$who_add=$_SESSION['LOGGED_USER'];
		$add_datetime=date('Y-m-d H:i:s');
		if(empty($err)){
			$data=array(
			'img_names'=>$img_names,			
			'pages_links'=>$pages_links,
			'img_file'=>$thumbnail,	
			'who_add'=>$who_add,
			'add_datetime'=>$add_datetime,
			'status'=>$status
		);
			$id=$_GET['id'];
			updateRecord("student_detail",$data,"img_id=".$id);
			$data2=array(
			'login_user'=>$who_add,
			'login_datetime'=>$add_datetime,
			'task'=> 'Update Item',
			'remote_addr'=>$remote_addr,
			'request_uri'=>$request_uri,
			'file'=>$img_names
			);
			insertRecord('logs_master',$data2);
			//print_r($data); die;		
			//echo "<script>alert('Category Updated Successfully');</script>";	
			unset($data); // array empty
			$_SESSION["subcategory"]="images Updated Successfully";
			$_SESSION['most_recent_activity'] = time();
			echo'<script>window.location="home_page_slider.php";</script>'; // redriect	
		}
	}
	
	//Insert Records
	else
	{
		$img_names=stripcslashes(trim(isset($_POST['img_names'])?$_POST['img_names']:''));
		$pages_links=stripcslashes(trim(isset($_POST['pages_links'])?$_POST['pages_links']:''));
		if(isset($_POST['status'])!=''){ $status='Yes'; } else { $status="No"; }
		$status='Yes';
		
		if(empty($img_names)){
		$err[]="Enter Images Name";
		}
		
		$thumbnail='';
		if(!empty($_FILES["thumb"]))
		{	
			$allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
			$temp = explode(".", $_FILES["thumb"]["name"]);
			$extension = end($temp);
		
			if ((($_FILES["thumb"]["type"] == "image/gif")
			|| ($_FILES["thumb"]["type"] == "image/jpeg")
			|| ($_FILES["thumb"]["type"] == "image/jpg")
			|| ($_FILES["thumb"]["type"] == "image/pjpeg")
			|| ($_FILES["thumb"]["type"] == "image/x-png")
			|| ($_FILES["thumb"]["type"] == "image/png"))
			&& in_array($extension, $allowedExts)
			) {
			  if ($_FILES["thumb"]["error"] > 0) {
				 $err[]= "Return Code: " . $_FILES["thumb"]["error"] ;
			  } else if(empty($err)){
				if (file_exists("./images/sliderimage/" . $_FILES["thumb"]["name"])) {
				   $err[]= $_FILES["thumb"]["name"] . " already exists. ";
				} else {
					$img_name="IMG_".time().".".$extension;
					move_uploaded_file($_FILES["thumb"]["tmp_name"],
					"images/sliderimage/" . $img_name);			
					$src = "images/sliderimage/".$img_name;
					$dist = "images/sliderimage/thumbnail_".$img_name;
					$thumbnail = 'thumbnail_'.$img_name;
					thumbnail($src, $dist, 1260, 550);							  
				}
			  }
			} else {
			  $err[]= "Invalid File Format";
			}
		}	
		
		//print_r($cat_name); die;
		$who_add=$_SESSION['LOGGED_USER'];
		$add_datetime=date('Y-m-d H:i:s');
		if(empty($err)){
			$data=array(
			'img_names'=>$img_names,
			'pages_links'=>$pages_links,
			'img_file'=>$thumbnail,
			'who_add'=>$who_add,
			'add_datetime'=>$add_datetime,
			'status'=>$status
			);
			insertRecord("student_detail",$data);
			$data2=array(
			'login_user'=>$who_add,
			'login_datetime'=>$add_datetime,
			'task'=>'Add Item',
			'remote_addr'=>$remote_addr,
			'request_uri'=>$request_uri,
			'file'=>$img_names
			);
			insertRecord('logs_master',$data2);
			
			//echo "<script>alert('Book Added Category Successfully');</script>";	
			unset($data); // array empty
			$_SESSION["subcategory"]="Images Added Successfully";
			$_SESSION['most_recent_activity'] = time();
			echo'<script>window.location="home_page_slider.php";</script>'; // redriect	
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Insert Update Delete Code PHP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-7"><br/>
				<center><h3>Insert Contact Us Form</h3></center>
				<div class="contactform">
					<form role="form" name="done" method="POST">
						<div class="form-group">
							<label>Full Name :-</label>
							<input type="text" class="form-control" name="fullname" value="" placeholder="Enter Your Name" required>
						</div>
						<div class="form-group">
							<label>Email :-</label>
							<input type="email" class="form-control" name="email" value="" placeholder="Enter Your Email Id" required>
						</div>
						<div class="form-group">
							<label>Phone No :-</label>
							<input type="text" class="form-control" name="contact" value="" placeholder="Enter Your Phone Number" required>
						</div>
							<center><button type="submit" name="done">Submit</button></center>
					</form>
				</div>
			</div>
			<div class="col-md-5">
				<img src="contatto.png" class="img-responsive">
			</div>
		</div>
	</div>

</body>
</html>