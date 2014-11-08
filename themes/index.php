<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> Dashboard66</h1>

<input type="hidden" id="gage" name="gage" value="1" />
<?php 
$justgage  = Yii::app()->assetManager->publish(Yii::app()->basePath.'/scripts/justgage/');

Yii::app()->clientScript->registerScriptFile($justgage.'/raphael.2.1.0.min.js');
Yii::app()->clientScript->registerScriptFile($justgage.'/justgage.1.0.1.min.js');
?>

<?php 
		 $branch_id = $hotel_branch_id = yii::app()->user->branch_id;
		 $active_date = DayEnd::model()->find("branch_id= $branch_id")->active_date;
		
		$total_rooms = RoomMaster::model()->findAll("branch_id=$hotel_branch_id");		
		$available_rooms = RoomMaster::model()->findAll("mst_room_status = 'V' AND branch_id=$hotel_branch_id");
		$total_res = ReservationInfo::model()->findAll("reservation_status = 1 AND chkin_date LIKE '$active_date%' AND chkin_status='N' AND branch_id=$hotel_branch_id");		
		$occupied_rooms = CheckinInfo::model()->findAll("chkout_status = 'N' AND branch_id=$hotel_branch_id");			
			
			$total_rooms =count($total_rooms);
			$availabe = count($available_rooms);
			$occupied =count($occupied_rooms);
			$reserved = count($total_res);				
		
		////////////// from reservation info forcast 
		$sql_reservation = "select count(reservation_id)  From hms_reservation_info where chkin_status = 'N'
AND  chkin_date < '$active_date' AND chkout_date  > '$active_date' AND noshow_status !='Y' AND  reservation_status='1'";
		// echo $sql_reservation; 		
		$total_reservations2 = Yii::app()->db->createCommand($sql_reservation)->queryScalar();
		
		$sql_occupied_chkin = "select count(chkin_id)  From hms_checkin_info where chkout_status = 'N' AND  chkin_date <= '$active_date' AND  chkout_date > '$active_date'";
		$total_occupied = Yii::app()->db->createCommand($sql_occupied_chkin)->queryScalar();
		
		$total_occupied = $total_occupied +	$total_reservations2;
		////////////////////////////////////////////////////////////

$sql = "select count(reservation_id)  From hms_reservation_info where chkin_status = 'N' AND  chkin_date LIKE '$active_date%' AND reservation_status='1'";
	$total_coming = Yii::app()->db->createCommand($sql)->queryScalar();

 $depart = CheckinInfo::model()->findAll("chkout_date LIKE '$active_date%' AND chkout_status = 'N' AND branch_id=$hotel_branch_id");
 $total_depart = count($depart);

	//echo "-$total_depart--". $total_reservations;

	// $availabe =  ($availabe + $total_depart) - $total_coming;
	$availabe =  $total_rooms - $total_occupied;

?>
<script>
      var g1, g2, g3;
      
      window.onload = function(){
        var g1 = new JustGage({
          id: "g1", 
          value: <?php echo $occupied; ?>, 
		  levelColors : Array("#fd2600","#fc4f00","#b0e108"),
          min: 0,
          max: <?php echo $total_rooms; ?>,
          title: "Occupied Rooms",
		  titleFontColor :"#464646",
          label: "Occupied"
        });
        
        var g2 = new JustGage({
          id: "g2", 
          value:  <?php echo $reserved; ?>, 
          min: 0,
          max: <?php echo $total_rooms; ?>,
          title: "Reserved Rooms",
		  titleFontColor :"#464646",
          label: "Reserved"
        });
        
        var g3 = new JustGage({
          id: "g3", 
          value: <?php echo $availabe; ?>, 
          min: 0,
          max: <?php echo $total_rooms; ?>,
          title: "Available Rooms",
		  titleFontColor :"#464646",
          label: "Available"
        });
        
      
    /* 
        setInterval(function() { 			
			var a = $("#gage").val(); 
			var b = parseInt(a);		
			if(b%2==0){	
          		g1.refresh(<?php //echo $occupied; ?>);
          		g2.refresh(<?php //echo $reserved; ?>);  
		  		g3.refresh(<?php //echo $availabe; ?>);
			}
			else{
				g1.refresh(0);
          		g2.refresh(0);  
		  		g3.refresh(0);
			}
          //g3.refresh(getRandomInt(0, 50));    
		  $("#gage").val(b+1);       
        }, 2500);  */
		
		
      };
    </script>
<style type="text/css">

#g1 {
    display: inline-block;
    font-size: 12px;
    height: 170px;
    margin-right: 77px;
    width: 200px;
}

#g2 {
    display: inline-block;
    font-size: 12px;
    height: 170px;
    margin-right: 77px;
    width: 200px;
}

#g3 {
    display: inline-block;
    font-size: 12px;
    height: 170px;
    margin-right: 77px;
    width: 200px;
}
</style>
    
<div align="center" style="padding-left:65px">
 <div id="g1"></div>
    <div id="g2"></div>
    <div id="g3"></div>   
</div>

<!-------------Dashboard Icons Table-------------------->

<table cellspacing="5" style="padding-left:60px;">
 <tr>
    <td><img src="/hotel/images/icons/bservices.png" alt="Services" /></td>
    <td><img src="/hotel/images/icons/breservation.png" alt="Reservation" /></td>
    <td><img src="/hotel/images/icons/bguest.png" alt="Guests" /></td>
    <td><img src="/hotel/images/icons/bcheckin.png" alt="Check In" /></td>
    <td><img src="/hotel/images/icons/bcheckout.png" alt="Checkout" /></td>
  </tr>
  <tr>
   <td style="padding-left:15px;"><a href="Services/admin"><img src="/hotel/images/icons/service.png" alt="Services" /></a></td>
    <td style="padding-left:15px;"><a href="ReservationInfo/admin"><img src="/hotel/images/icons/reservation.png" alt="Reservation" /></a></td>
    <td style="padding-left:15px;"><a href="GuestInfo/admin"><img src="/hotel/images/icons/guestinfo.png" alt="Guests" /></a></td>
    <td style="padding-left:15px;"><a href="CheckinInfo/admin"><img src="/hotel/images/icons/checkin.png" alt="Check In" /></a></td>
    <td style="padding-left:15px;"><a href="CheckinInfo/admin"><img src="/hotel/images/icons/checkout.png" alt="Checkout" /></a></td>
  </tr>
   <tr>
    <td><img src="/hotel/images/icons/broom.png" alt="Rooms" /></td>
    <td><img src="/hotel/images/icons/bflight.png" alt="Flights" /></td>
    <td><img src="/hotel/images/icons/bcompany.png" alt="Company" /></td>
    <td><img src="/hotel/images/icons/bbranches.png" alt="In-House" /></td>
    <td><img src="/hotel/images/icons/bsalesp.png" alt="Sales Person" /></td>
  </tr>
  <tr>
   <td style="padding-left:15px;"><a href="RoomMaster/admin"><img src="/hotel/images/icons/rooms.png" alt="Rooms" /></a></td>
    <td style="padding-left:15px;"><a href="Flights/admin"><img src="/hotel/images/icons/flights.png" alt="Flights" /></a></td>
    <td style="padding-left:15px;"><a href="Company/admin"><img src="/hotel/images/icons/company.png" alt="Company" /></a></td>
    <td style="padding-left:15px;"><a href="CheckinInfo/inhouse" target="_blank"><img src="/hotel/images/icons/floors.png" alt="In-House" /></a></td>
    <td style="padding-left:15px;"><a href="SalePerson/admin"><img src="/hotel/images/icons/salesp.png" alt="Sales Person" /></a></td>
  </tr>
</table>





