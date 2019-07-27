<?php
// Genral insert qwery
function insertRecord($tbl,$data){
//insertRecord("book_master",$data);
	$db = Database::getInstance();
	$db->query_insert($tbl,$data);
	
}
// Genral update qwery
//query_update($table, $data, $where='0')
function updateRecord($tbl,$data,$where){
//updateRecord("book_master",$data,"book_id=".$id);
	$db = Database::getInstance();
	$db->query_update($tbl,$data,$where);
}

// Genral select one qwery
function selectOne($tbl,$key,$id){
	//$bookrec=selectOne("book_master","book_id",$_GET['id']);
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM ".$tbl." where ".$key."='".$id."'");	
	return($records);
}

// Genral select one qwery
function selectLastInsertId($tbl,$key,$last_id){
	//$bookrec=selectOne("book_master","book_id",$_GET['id']);
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM ".$tbl." where ".$key."='".$last_id."'");	
	return($records);
}

function selectOneActive($tbl,$key,$id,$status,$order){
	//$bookrec=selectOne("book_master","book_id",$_GET['id']);
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM ".$tbl." where ".$key."='".$id."'");	
	return($records);
}

// Genral select All qwery
function selectAll($tbl,$key,$order){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM ".$tbl." ORDER BY ".$key." ".$order."");	
	return($records);
}
//selectAllTimeStamp
function selectAllTimeStamp($tbl,$key,$order){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT DISTINCT ctime FROM ".$tbl." ORDER BY ".$key." ".$order." LIMIT 0,1");	
	return($records);
}

function selectAllActive($tbl,$key,$order,$status){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM ".$tbl." where ".$status." ORDER BY ".$key." ".$order."");	
	return($records);
}


function selectLimit($tbl,$key,$order,$start_from,$pages){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM ".$tbl."  ORDER BY ".$key." ".$order." LIMIT ".$start_from." , ".$pages."");	
	return($records);
}

function selectLimitWhere($tbl,$where,$key,$order,$start_from,$pages){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM ".$tbl." where ".$where." ORDER BY ".$key." ".$order." LIMIT ".$start_from." , ".$pages."");	
	return($records);
}

function selectAllImagesLike($search){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM gallery_name_master where gallery_name LIKE '%".$search."%'");	
	return($records);
}
function selectAllEventLike($search){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM events_master where event_name LIKE '%".$search."%'");	
	return($records);
}

function FetchOrderDetails($email,$start,$end,$odate){
	//$recs=selectAll("book_master","book_id","DESC");
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM order_master where  order_timec > '".$start."' AND order_timec <  '".$end."' AND email='".$email."' AND order_date='".$odate."'  ORDER BY order_id ");	
	return($records);
}

// Genral delete qwery
function delete($tbl,$key,$id)
{
	//delete("book_master","book_id",$_GET['del']);
	$db = Database::getInstance();		
	$db->query("DELETE FROM ".$tbl." WHERE ".$key."=".$id."");	
}

function getEmailUser($user){
	$db = Database::getInstance();	
	$record=$db->fetch_all_array("SELECT user_email from user_master WHERE user_email='".$user."'");
	if(count($record)>0)
	{
		return $record[0]['user_email'];
	}
	else
	{
		return NULL;
	}	
	
}
 
  function Validatecoupon_code($user,$email){
	$db = Database::getInstance();	
	$record=$db->fetch_all_array("SELECT coupon_code,discount,email from feedback_inquiry WHERE coupon_code='".$user."' AND email='".$email."' AND status='Yes'");
	if(count($record)>0)
	{
		return $record[0]['discount'];
	}
	else
	{
		return NULL;
	}	
	
}

function validateLoginforgot($user){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from admin_account_master WHERE email='".$user."'");
	if(count($record)>0)
	{
		//print_r($record);
		return true;
	}
	else
	{
		return false;
	}
		
}

function getEmailIdsforgot($user){
	$db = Database::getInstance();
	/*$db->where('adm_user',$user);
	$db->orWhere('adm_email',$user);
	$row=$db->getOne('tbl_admin');*/
	
	$row=$db->fetch_all_array("SELECT admin_id,email,password  from admin_account_master WHERE email='".$user."'");

	return $row;
}

function validateLoginforgotweb($user){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from new_customer WHERE email='".$user."'");
	if(count($record)>0)
	{
		//print_r($record);
		return true;
	}
	else
	{
		return false;
	}
		
}

function validateLoginforgotvendorweb($user){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from vendors_new_registration WHERE email='".$user."'");
	if(count($record)>0)
	{
		//print_r($record);
		return true;
	}
	else
	{
		return false;
	}
		
}

function getAllcitysdata(){	
$citys=selectAll("city_master","city_id","ASC");	
		$city=array();
		if(count($citys)>0){
			$temp=0;
					foreach($citys as $r2){
					$city[$temp]['city_id']=$r2['city_id'];
					$city[$temp]['state_id']=$r2['state_id'];
					$city[$temp]['city_name']=$r2['city_name'];
					$city[$temp]['area_name']=selectAllActive("area_master","area_id","ASC","city_id='".$r2['city_id']."'");	
						
					$temp++;
					}
			return($city);		
		}	
	
	}
	
	
function getUserEmailId($user){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from register_master WHERE email='".$user."'");
	if(count($record)>0)
	{
		//print_r($record);
		return true;
	}
	else
	{
		return false;
	}
		
}

function getUserEmailIdUsers($user){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from user_master WHERE email='".$user."'");
	if(count($record)>0)
	{
		//print_r($record);
		return true;
	}
	else
	{
		return false;
	}
		
}

function getUserEmailIdUsers123($user){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from new_customer WHERE email='".$user."'");
	if(count($record)>0)
	{
		//print_r($record);
		return true;
	}
	else
	{
		return false;
	}
		
}
function getEmailIdsforgotweb($user){
	$db = Database::getInstance();
	/*$db->where('adm_user',$user);
	$db->orWhere('adm_email',$user);
	$row=$db->getOne('tbl_admin');*/
	
	$row=$db->fetch_all_array("SELECT * from new_customer WHERE email='".$user."'");
	return $row;
}

function getEmailIdsforgotvendorweb($user){
	$db = Database::getInstance();
	/*$db->where('adm_user',$user);
	$db->orWhere('adm_email',$user);
	$row=$db->getOne('tbl_admin');*/
	
	$row=$db->fetch_all_array("SELECT * from vendors_new_registration WHERE email='".$user."'");
	return $row;
}


function validateLoginadminOldPasswordweb($id,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from new_customer WHERE email='".$id."' AND password='".$pass."' ");
	if(count($record)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
		
}

function validateLoginadminOldPasswordvendorweb($id,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from vendors_new_registration WHERE email='".$id."' AND password='".$pass."' ");
	if(count($record)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
		
}

function validateLoginadminOldPassword($id,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from admin_account_master WHERE admin_id='".$id."' AND password='".$pass."' ");
	if(count($record)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
		
}

function selectOldId($tbl,$id,$name){
	$db = Database::getInstance();	
	$record=$db->fetch_all_array("SELECT ".$id." from ".$tbl." WHERE ".$id."=".$name."");
	
	if(count($record)>0)
	{
		//print_r($record); die;
		return $record[0][$id];
	}
	else
	{
	//print_r($record); die;
		return 0;
	}		 
}

 function getAllLists($country,$state,$city,$area,$category,$sub_category){
	$db = Database::getInstance();
	/*$db->where('adm_user',$user);
	$db->orWhere('adm_email',$user);
	$row=$db->getOne('tbl_admin');*/
	
	$row=$db->fetch_all_array("SELECT * from register_master WHERE country='".$country."' AND  state='".$state. "' AND city='" .$city."' AND area='".$area. "' AND category='".$category ."' AND sub_category='".$sub_category. "' ORDER  BY id DESC  ");

	return $row;
}

function AnyFindLastInsertId($tbl,$key)
{
$db = Database::getInstance();	
	$record=$db->fetch_all_array("SELECT ".$key. "  FROM ".$tbl. " ORDER BY ".$key. "  DESC LIMIT 0 , 1");
	if(count($record)>0)
	{
		return $record[0][$key];
	}
	else
	{
		return NULL;
	}		
}

function FindLastInsertId()
{
$db = Database::getInstance();	
	$record=$db->fetch_all_array("SELECT order_id FROM order_master ORDER BY order_id DESC LIMIT 0 , 1");
	if(count($record)>0)
	{
		return $record[0]['order_id'];
	}
	else
	{
		return NULL;
	}		
}

function FindLastInsertIdcouponcode()
{
$db = Database::getInstance();	
	$record=$db->fetch_all_array("SELECT discount FROM discount_master ORDER BY discount DESC LIMIT 0 , 1");
	if(count($record)>0)
	{
		return $record[0]['discount'];
	}
	else
	{
		return NULL;
	}		
}

function FindLastInsertagentId()
{
$db = Database::getInstance();	
	$record=$db->fetch_all_array("SELECT vendorreg_id FROM vendors_new_registration ORDER BY vendorreg_id DESC LIMIT 0 , 1");
	if(count($record)>0)
	{
		return $record[0]['vendorreg_id'];
	}
	else
	{
		return NULL;
	}		
}

 function getAllList($user_id){	
// $list=selectAllActive("register_master","id","DESC","id='".$user_id."'");
 $list=selectOne("register_master","id",$user_id);
 $country=isset($list[0]['country'])?$list[0]['country']:'';
$state=isset($list[0]['state'])?$list[0]['state']:'';
$city=isset($list[0]['city'])?$list[0]['city']:'';
$area=isset($list[0]['area'])?$list[0]['area']:'';
$category=isset($list[0]['category'])?$list[0]['category']:'';
$sub_category=isset($list[0]['sub_category'])?$list[0]['sub_category']:'';
 if($country=!'')
 {
 $lists['List']=getAllLists($country,$state,$city,$area,$category,$sub_category);	
 }
 return($lists);	
 }
 
 function getAllCategorySub(){	
$categorys=selectAll("category_master","category_id","ASC"); 
		$category=array();
		if(count($categorys)>0){
			$temp=0;
					foreach($categorys as $r){
					$category[$temp]['category_id']=$r['category_id'];
					$category[$temp]['category_name']=$r['category_name'];
					$category[$temp]['sub_category']=selectAllActive("subcategory_master","sub_id","ASC","category_id='".$r['category_id']."'");	
					$temp++;
					}
			return($category);		
		}	
	
	}
	
	function getAllstate($state_id){	
$state=selectAllActive("state_master","state_id","ASC","country_id='".$state_id."'");	
		$states=array();
		if(count($state)>0){
			$temp=0;
					foreach($state as $r){
					$states[$temp]['state_id']=$r['state_id'];
					$states[$temp]['country_id']=$r['country_id'];
					$states[$temp]['state_name']=$r['state_name'];
					$states[$temp]['city']=getAllcity($r['state_id']);	
						
					$temp++;
					}
			return($states);		
		}	
	
	}
	
		function getAllcity($city_id){	
$citys=selectAllActive("city_master","city_id","ASC","state_id='".$city_id."'");	
		$city=array();
		if(count($citys)>0){
			$temp=0;
					foreach($citys as $r2){
					$city[$temp]['city_id']=$r2['city_id'];
					$city[$temp]['state_id']=$r2['state_id'];
					$city[$temp]['country_id']=$r2['country_id'];
					$city[$temp]['city_name']=$r2['city_name'];
					$city[$temp]['area_name']=selectAllActive("area_master","area_id","ASC","city_id='".$r2['city_id']."'");	
						
					$temp++;
					}
			return($city);		
		}	
	
	}
	
	 function getAllGeneral(){	
$Generals=selectAll("country_master","country_id","ASC");
		$country=array();
		if(count($Generals)>0){
			$temp=0;
					foreach($Generals as $r){
					$country[$temp]['country_id']=$r['country_id'];
					$country[$temp]['country_name']=$r['country_name'];
					$country[$temp]['state']=getAllstate($r['country_id']);	
					/*if(count($state)>0){
				$temp1=0;
					foreach($state as $r1){
					$country[$temp][$temp1]['state_id']=$r1['state_id'];
					$country[$temp][$temp1]['country_id']=$r1['country_id'];
					$country[$temp][$temp1]['state_name']=$r1['state_name'];
					$city=selectAllActive("city_master","city_id","ASC","state_id='".$r1['state_id']."'");	
							if(count($city)>0){
			$temp2=0;
					foreach($city as $r2){
					$country[$temp][$temp1][$temp2]['city_id']=$r2['city_id'];
					$country[$temp][$temp1][$temp2]['state_id']=$r2['state_id'];
					$country[$temp][$temp1][$temp2]['country_id']=$r2['country_id'];
					$country[$temp][$temp1][$temp2]['city_name']=$r2['city_name'];
					$country[$temp][$temp1][$temp2]['area_name']=selectAllActive("area_master","area_id","ASC","city_id='".$r2['city_id']."'");	
			
					$temp2++;
					}
					}
					$temp1++;
					}
					}*/
					$temp++;
					}
			return($country);		
		}	
	
	}
	
	
	 function getAllServicesData(){	
$services_id=selectAll("services_master","services_id","DESC"); 
		$services=array();
		if(count($services_id)>0){
			$temp=0;
					foreach($services_id as $r){
					$services[$temp]['services_id']=$r['services_id'];
					$services[$temp]['services_name']=$r['services_name'];
					if($r['services_id']==1){
					$services[$temp]['Seva']=selectAll("register_master","id","ASC");
					}
					else
					{
					$services[$temp]['sub_services']=selectAllActive("subservices_master","subservices_id","ASC","services_id='".$r['services_id']."'");	
					}
					$temp++;
					}
			return($services);		
		}	
	
	}
 
 
//-----------------------------------------

function showMsgBox($msg){
	echo '<div class="alert alert-success">';
	echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
	echo $msg;
	echo '</div>';
}

function showErrBox($err){
	echo '<div class="alert alert-danger">';
	echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
	echo '<ul>';
	foreach($err as $e){
		echo '<li>'.$e.'</li>';
	}
	echo '</ul></div>';
}

function showErrBoxSingle($err){
	echo '<div class="alert alert-danger">';
	echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
	echo $err;
	echo '</div>';
}
function redirectDashboard(){
	
	header('Location: home.php');
}

function redirectLogin(){
	header('Location: index.php');
}

function redirect($link){
	header('Location: '.$link);
}

function setSess($key,$val){
	$_SESSION[$key]=$val;
}

function delSess($key){
	unset($_SESSION[$key]);
}

function getSess($key){
	return (empty($_SESSION[$key])?'':$_SESSION[$key]);
}

function isSessExist($key){
	return isset($_SESSION[$key]);
}

function pageLock(){
	if(!isSessExist('LOGGED_USER')){
		redirectLogin();
	}
}

function validateschemecodeid($code_number){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from scheme_offer_code WHERE code_number='".$code_number."'");
	if(count($record)>0) 
	{
		return true;
	} 
	else
	{
		return false;
	}
		
}

function validateLoginadmin($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from admin_account_master WHERE email='".$email."' AND password='".$pass."'");
	if(count($record)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
		
}
//validateLoginUserPass
function validateLoginUserPass($id,$pass){
	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from user_master WHERE user_id='".$id."' AND user_pass='".$pass."'");
	if(count($record)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
		
}
function validateLoginweb($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from register_master WHERE email='".$email."' AND password='".$pass."'");
	if(count($record)>0) 
	{
		return true;
	} 
	else
	{
		return false;
	}
		
}

function validateLoginwebuser($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from new_customer WHERE email='".$email."' AND password='".$pass."'");
	if(count($record)>0) 
	{
		return true;
	} 
	else
	{
		return false;
	}
		
}

function validateLoginwebvendor($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from vendors_new_registration WHERE email='".$email."' AND password='".$pass."' AND status='Yes'");
	if(count($record)>0) 
	{
		return true;
	} 
	else
	{
		return false;
	}
		
}
function getUserIdweb($user){
	$db = Database::getInstance();

	$record=$db->fetch_all_array("SELECT id from register_master WHERE email='".$user."'");	

	if(count($record)>0)
	{
		return $record[0]['id'];
	}
	else
	{
		return 0;
	}	
	
}

function getUserIdwebuser($user){
	$db = Database::getInstance();

	$record=$db->fetch_all_array("SELECT name from register_master WHERE email='".$user."'");	

	if(count($record)>0)
	{
		return $record[0]['name'];
	}
	else
	{
		return 0;
	}	
	
}

function getUserIdwebusername($user){
	$db = Database::getInstance();

	$record=$db->fetch_all_array("SELECT customer_fname from new_customer WHERE email='".$user."'");	

	if(count($record)>0)
	{
		return $record[0]['customer_fname'];
	}
	else
	{
		return 0;
	}	
	
}

function getUserIdwebuvendorname($user){
	$db = Database::getInstance();

	$record=$db->fetch_all_array("SELECT shop_auther from vendors_new_registration WHERE email='".$user."'");	

	if(count($record)>0)
	{
		return $record[0]['shop_auther'];
	}
	else
	{
		return 0;
	}	
	
}

function validateLoginUser($email,$pass){
	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from user_master WHERE user_email='".$email."' AND user_pass='".$pass."'");
	if(count($record)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
		
}
function validateLogin($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from admin_account_master WHERE email='".$email."' AND password='".$pass."'");
	if(count($record)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
		
}

function changePassword($user,$pass){
	$db = Database::getInstance();
	/*$db->where('adm_user', $user);
	$db->orWhere('adm_email', $user);
	$data=array('adm_password'=>$pass);
	$db->update('tbl_admin', $data);*/
	
	$db->query("UPDATE tbl_admin SET adm_password='".$pass."' WHERE adm_user='".$user."' OR adm_email='".$user."'");
}

function changeEmail($user,$pass,$email){
	$db = Database::getInstance();
	/*$db->where('adm_user', $user);
	$db->where('adm_password', $pass);
	$data=array('adm_email'=>$email);
	$db->update('tbl_admin', $data);*/
	
	$db->query("UPDATE tbl_admin SET adm_email='".$email."' WHERE adm_user='".$user."' OR adm_password='".$pass."'");
}

function getEmailId($user){
	$db = Database::getInstance();
	/*$db->where('adm_user',$user);
	$db->orWhere('adm_email',$user);
	$row=$db->getOne('tbl_admin');*/
	
	$row=$db->fetch_all_array("SELECT user_email from tbl_user WHERE user_email='".$user."'");
	if(count($row)>0)
	{
		return $row[0]['user_email'];
	}
	else
	{
		return 0;
	}
}

function getUserId($user){
	$db = Database::getInstance();
	/*
	$db->where('adm_user',$user);
	$db->orWhere('adm_email',$user);
	$row=$db->getOne('tbl_admin');
	return($row['adm_user']);
	
	*/	
	$record=$db->fetch_all_array("SELECT user_id from user_master WHERE user_email='".$user."'");	

	if(count($record)>0)
	{
		return $record[0]['user_id'];
	}
	else
	{
		return 0;
	}	
	
}

function getAdminId($user){
	$db = Database::getInstance();
	
	
	$record=$db->fetch_all_array("SELECT admin_id from admin_account_master WHERE email='".$user."'");
	
	//$record=$db->fetch_all_array("SELECT adm_user from tbl_admin WHERE adm_email='".$user."'");

	if(count($record)>0)
	{
		return $record[0]['admin_id'];
	}
	else
	{
		return 0;
	}	
	
}

function delPayment($id)
{
	$db = Database::getInstance();		
	$db->query("DELETE FROM payment_master WHERE id=".$id."");	
}

function getAllPayment(){
	$db = Database::getInstance();
	$records=$db->fetch_all_array("SELECT * FROM payment_master ORDER BY id DESC");	
	return($records);
}

function getUserPass($user){
	$db = Database::getInstance();
	/*
	$db->where('adm_user',$user);
	$db->orWhere('adm_email',$user);
	$row=$db->getOne('tbl_admin');
	return($row['adm_user']);
	
	*/
	
	$record=$db->fetch_all_array("SELECT user_password from tbl_user WHERE user_email='".$user."'");
	
	//$record=$db->fetch_all_array("SELECT adm_user from tbl_admin WHERE adm_email='".$user."'");

	if(count($record)>0)
	{
		return $record[0]['user_password'];
	}
	else
	{
		return 0;
	}	
	
}


function insertRecord1($tbl,$data){

	$db = Database::getInstance();
	$db->query_insert($tbl,$data);
	
}
/*
function updateRecord($tbl,$key,$val,$data){
	$db = MysqliDb::getInstance();
	$db->where($key, $val);
	$db->update($tbl, $data);
}
*/

#-#############################################
# desc: updates record in table according array 
# param: table_name,column_name,value, assoc array with data 
# return: nothing
function updateRecord1($tbl,$key,$val,$data){
	$db = Database::getInstance();
	$myquery="UPDATE ".$tbl." SET";
	$c=0;
	foreach($data as $k=>$v){
		$c++;
		if(isset($v))
		{
			if($c==count($data)){
				$myquery=$myquery." ".$k."='".$v."'";
			}else{
				$myquery=$myquery." ".$k."='".$v."',";
			}
		}
	}
	$myquery=$myquery." WHERE ".$key."=".$val."";
	//echo "<br><br><br><br><br><br><br><br><br>".$myquery;
	//exit();
	$db->query($myquery);
} 

function updateRecords($tbl,$key,$val,$data){
	$db = Database::getInstance();
	$myquery="UPDATE ".$tbl." SET";
	$c=0;
	foreach($data as $k=>$v){
		$c++;
		if(isset($v))
		{
			if($c==count($data)){
				$myquery=$myquery." ".$k."='".$v."'";
			}else{
				$myquery=$myquery." ".$k."='".$v."',";
			}
		}
	}
	$myquery=$myquery." WHERE ".$key."=".$val."";
	//echo "<br><br><br><br><br><br><br><br><br>".$myquery;
	//exit();
	$db->query($myquery);
} 

//updateAdminUserPassword
function updateAdminUserPassword($key,$data){
	updateRecord('admin_account_master','admin_id',$key,$data);
}

function updateuser($key,$data){
	updateRecord('tbl_user','user_email',$key,$data);
}



function getCityWiseShopsJSON($city){

	$db = Database::getInstance();
	// $records=$db->rawQuery("SELECT * FROM tbl_shops WHERE shp_city LIKE ? ORDER BY shp_timestamp DESC", array($city));
	
	$records=$db->fetch_all_array("SELECT * FROM tbl_shops WHERE shp_city LIKE '".$city."' ORDER BY shp_timestamp DESC");

	
	return($records);
}
//SELECT *, (SQRT(POW((doc_lat - '$lat'), 2) + POW((doc_lng - '$lng'), 2)) * $multiplier) AS distance FROM tbl_doc WHERE POW((doc_lat - '$lat'), 2) + POW((doc_lng - '$lng'), 2) < POW(($distance / $multiplier), 2) ORDER BY distance ASC
function getCountryWiseShopsJSON($country){

	$db = Database::getInstance();
	//  $records=$db->rawQuery("SELECT * FROM tbl_shops WHERE shp_country LIKE ? ORDER BY shp_timestamp DESC", array($country));
	
	$records=$db->fetch_all_array("SELECT * FROM tbl_shops WHERE shp_country LIKE '".$country."' ORDER BY shp_timestamp DESC");

	return($records);
}

function getLocationWiseShopsJSON($lat,$lng,$r=5){
	$db = Database::getInstance();
	$multiplier = 112.12; // use 69.0467669 if you want miles
	$distance = $r; // kilometers or miles if 69.0467669
	$Q="SELECT *, (SQRT(POW((shp_lat - ".$lat."), 2) + POW((shp_lng - ".$lng."), 2)) * ".$multiplier.") AS distance FROM tbl_shops WHERE POW((shp_lat - ".$lat."), 2) + POW((shp_lng - ".$lng."), 2) < POW((".$distance." / ".$multiplier."), 2) ORDER BY distance ASC";
	//$params=array($lat,$lng,$multiplier,$lat,$lng,$distance,$multiplier);
	//$records=$db->rawQuery($Q,$params);
	$records=$db->fetch_all_array($Q);
	return($records);
}
function isLocationExist($tbl,$lat,$lng){

//echo "inside LocationFinder";
	$db = Database::getInstance();
	$Q="SELECT COUNT(*) AS ROW_COUNT FROM $tbl WHERE shp_lat='$lat' AND shp_lng='$lng'";
	$rec=$db->fetch_all_array($Q);
	//print_r($Q);
	//echo '<br>'.$rec[0]['ROW_COUNT'];
	if($rec[0]['ROW_COUNT']>0){		
		return true;
	}else{
		return false;
	}
}

function checklatlong($tbl,$lat,$lng){

//echo "inside LocationFinder";
	$db = Database::getInstance();
	$Q="SELECT COUNT(*) AS ROW_COUNT FROM $tbl WHERE shp_lat='$lat' AND shp_lng='$lng'";
	$rec=$db->fetch_all_array($Q);
	//print_r($Q);
	//echo '<br>'.$rec[0]['ROW_COUNT'];
	if($rec[0]['ROW_COUNT']>0){	
		$lng=$lng-0.00010510;
		$lng=checklatlong($tbl,$lat,$lng);
		return $lng;			
	}else{
		return $lng;
	}
}


function checklatlongEvent($tbl,$lat,$lng){

//echo "inside LocationFinder";
	$db = Database::getInstance();
	$Q="SELECT COUNT(*) AS ROW_COUNT FROM $tbl WHERE evn_lat='$lat' AND evn_lng='$lng'";
	$rec=$db->fetch_all_array($Q);
	//print_r($Q);
	//echo '<br>'.$rec[0]['ROW_COUNT'];
	if($rec[0]['ROW_COUNT']>0){	
		$lng=$lng-0.00010510;
		$lng=checklatlongEvent($tbl,$lat,$lng);
		return $lng;			
	}else{
		return $lng;
	}
}


/* DB API  */

function LoginUser($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from register_master WHERE email='".$email."' AND password='".$pass."'");
	if(count($record)>0)
	{
		return($record);
	}
	else
	{
		return false;
	}
		
}


function LoginUser123($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from new_customer WHERE email='".$email."' AND password='".$pass."'");
	if(count($record)>0)
	{
		return($record);
	}
	else
	{
		return false;
	}
		
}

function LoginUserPerson($email,$pass){

	$db = Database::getInstance();
	$record=$db->fetch_all_array("SELECT * from user_master WHERE email='".$email."' AND password='".$pass."'");
	if(count($record)>0)
	{
		return($record);
	}
	else
	{
		return false;
	}
		
}
 

?>