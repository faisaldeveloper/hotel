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





