<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> Dashboard</h1>

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
   <td style="padding-left:15px;">
   <?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/service.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('Services/Admin'), array('title'=>'Services'));
?></td>
    <td style="padding-left:15px;"><?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/reservation.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('ReservationInfo/Admin'), array('title'=>'Reservation'));
?></td>
    <td style="padding-left:15px;"> <?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/guestinfo.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('GuestInfo/Admin'), array('title'=>'Guests Info'));
?></td>
    <td style="padding-left:15px;"><?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/checkin.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('CheckinInfo/Admin'), array('title'=>'CheckIn Info'));
?></td>
    <td style="padding-left:15px;">
    <?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/checkout.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('CheckinInfo/Admin'), array('title'=>'Folios'));
?>   </td>
  </tr>
  
   <tr>
    <td><img src="/hotel/images/icons/broom.png" alt="Rooms" /></td>
    <td><img src="/hotel/images/icons/bflight.png" alt="Flights" /></td>
    <td><img src="/hotel/images/icons/bcompany.png" alt="Company" /></td>
    <td><img src="/hotel/images/icons/bbranches.png" alt="Branches" /></td>
    <td><img src="/hotel/images/icons/bsalesp.png" alt="Sales Person" /></td>
  </tr>
  <tr>
   <td style="padding-left:15px;"><?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/rooms.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('RoomMaster/Admin'), array('title'=>'Rooms'));
?></td>
    <td style="padding-left:15px;"><?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/flights.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('Flights/Admin'), array('title'=>'Flights'));
?> </td>
    <td style="padding-left:15px;"><?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/company.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('Company/Admin'), array('title'=>'Company'));
?>  </td>
    <td style="padding-left:15px;"><?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/floors.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('HmsFloor/Admin'), array('title'=>'Floors'));
?> </td>
    <td style="padding-left:15px;"><?php  
$imghtml=CHtml::image(Yii::app()->request->baseUrl.'/images/icons/checkout.png', 'image', array('style'=>'margin-top:5px')); 
echo CHtml::link($imghtml, array('HmsRoomType/Admin'), array('title'=>'Room Types'));
?>  </td>
  </tr>
</table>





