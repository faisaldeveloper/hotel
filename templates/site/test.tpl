<style type="text/css">
.container{
width:700px;
margin:0 auto;
padding:5px 5px 0px 5px;
margin-top:-10px;
height:970px;
border: 1px solid;
/* background: #6699FF; */
}

.topheader{
	width:694px;
	height:100px;
	margin:auto;
	font-family:"Book Antiqua";
	color:black;
	
}
.header-left{
width:200px;
float:left;
padding:3px;
font-weight:300;
margin-top:7px;
margin-left:1px;
font-size:12px;
}

.header-mid{
width:250px;
float:left;
text-align:center;}

.header-right{
width:230px;
float:left;
margin-top:7px;
text-align:right;
padding:3px;
font-weight:300;
font-size:12px;}

.text-area{
width:690px;
margin:auto;
margin:-7px 3px;
font-family:"Lucida Handwriting";
font-size:14px;
text-align:justify;

}
.terms{
width:695px;
margin:auto;
padding-bottom:0px;
font-style:italic;
font-weight:700;
font-family:"Book Antiqua";
font-size:13px;

}
.terms ul li{
list-style-type: decimal;
}

.form{
width:694px;
margin:auto;
font-size:14px;
}
.sign{
width:694px;

}
.sign p{
float:right;
padding:20px 38px;
font-size:14px;
}

td.mytd {
	padding-top: 10px;
    border-bottom: 1px solid #000000;
}	
  </style>
  

  
  <div class="container_mce">
  <div class="container">
<div class="topheader">
<div class="header-left">
House No.10, Street No.38.<br />
F-8/1, Islamabad.<br />
Ph: 051-2261168, 051-2261170<br />
Fax:051-2261169
</div>

<div class="header-mid"><img src="{$base_url}/hotel_logos/le-royal.png" /></div>

<div class="header-right">
House No.2, Street No.57,<br />
F-8/4, Islamabad.<br />
Ph: 051-2287815, 051-2287816<br />
Fax: 051-2287816
</div>
</div><!--topheader close!-->
<div class="text-area">
<p>Rules of the LF Royal Guest House which are read/understood and signed by the guest, who wishes to stay in it.The Guest is bound to observe the following LE Royal Guest House Rules after signing the said Card:</p>
</div>
<div class="terms">
<ul>
<li> At the of check in, Guests are requested to prove their identity.</li>
<li> Right of admisssion are reserved.</li>
<li> No illegality is allowed againts the law of the Land.</li>
<li> Immoral activities are strictly prohibited.</li>
<li> Check out time is 12:00 Noon.</li>
<li> Advance rent will be paid at the time of check in.</li>
<li> Checque are not acceptable, only cash is accepted.</li>
<li> Bills are to be paid on presentation. No baggage is to be removed form the room until the bill are completely settled.</li>
<li> Lady visitor is not allowed to  visit single person's room, staying as a Guest and Vice versa.<br />They are only allowed to see other in the lobby area.</li>

<li> Visitor are not allowed to visit Guests in Guest House after 11 PM.</li>
<li> No percious things or cash will be left in the room while leaving the room and should be kept in personal custody and in case of any theft, burglary or any mishap, the Management, will not be resonsible.</li>
<li> If the car of any Guest is stolen from parking lot, the Management will not be responsible.</li>
<li> The Management is in no way responsible for any accident or even death.</li>
<li> Please keep the unloack form inside,except during night or resting intervals.</li>
<li> Ironing not allowed in any case,for ironing call ext.0 for Room Service.</li>
<li> Damages Caused by the Guest to the Guest House Building and other articles, belongings of the Guest House, will be charged from the Guest on precailing market price.</li>
<li> Guest are requested to refrain from playing music in loud voice or have parties in their rooms.</li>
<li> Please switch off all electrical appliances and hand over your room key at the Reception when you leave.</li>

</ul></div>




<div class="form">
<table width="90%" style="margin-left:30px;">
<tr>
<td class="mytd"><b> Guest Name (In capital)</b> {$guest_name }</td>
</tr>
<tr>
<td class="mytd"><b> Adress. </b> {$guest_address}</td>
</tr>
<tr>
<td class="mytd"><b> Telephone.</b> {$guest_mobile.$spaces1}<b> Identity Card No. </b> {$guest_identity_no}</td>
</tr>
<tr>
<td class="mytd"><b> Email.</b>&nbsp;{$guest_address}</td>
</tr>
<tr>
<td class="mytd"><b> Mobile No.</b> {$guest_mobile}</td>
</tr>
<tr>
<td class="mytd"><b> Passport No.</b> {$passport_no.$spaces1}<b> Date/Place od Issue</b> {$place_of_issue}</td>
</tr>
<tr>
<td class="mytd"><b> Nationality.</b> {$country_name}{$spaces}<b> Profession.</b> {$prof} <b>  Room.</b> {$room_name} </td>
</tr>
<tr>
<td class="mytd"><b> No of Persons accompanying.</b> {$total_person} Person(s){$spaces1}<b> Purpose of Visit. </b>  </td>
</tr>
<tr>
<td class="mytd"><b> Coming from.</b> {$comming_from} <b> Relation. </b> {$relation} </td>
</tr>
<tr>
<td class="mytd"><b> Check in Date. </b> {$chkin_date.$spaces1}<b> Time. </b> {$cin_time}</td>
</tr>
<tr>
<td class="mytd"><b> Check Out Date.</b> {$chkout_date.$spaces1}<b> Time.</b> {$chkout_time} </td>
</tr>
<tr>
<td class="mytd"><b> Mode od Payment. </b> {$payment_mode}</td>
</tr>
</table>
</div>

<div style="padding-top:20px; float:left; padding-left:30px;"> <input type="button" value="Print" onclick="javascript: window.print() " />    </div>


<div class="sign"><p>Signature of Guest.____________________</p></div>

</div><!--container close!-->



  </div>  
   

