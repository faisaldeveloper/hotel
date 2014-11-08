<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>
<?php
//$username=Yii::app()->user->name;
//$usermodel=User::model()->find("username='$username'");
//$userid = $usermodel->id;


//yii::import("application.modules.srbac.models.Assignments");

//$assignments=Assignments::model()->find("itemname like 'Tset%' and userid='$userid'");
//echo "id is ".$assignments->userid;

//Yii::app()->user->checkAccess("UserIndex");

?>
<div id="topper">




</div>


<div class="container" id="page">

<?php 

			/*$session=new CHttpSession;
  			$session->open();
			
  			$hotel_branch_id = $session['hotel_branch_id'];
			
			$session->close();
			echo " Branch Id is  ".$hotel_branch_id;
			
			*/
			
			if(isset(Yii::app()->user->branch_id)){
			//echo "Branch id is   ".Yii::app()->user->branch_id;	
			}
			
			
?>
	<?php echo $content; ?>
	



</div><!-- page -->

</body>
</html>