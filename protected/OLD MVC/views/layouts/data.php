<?php

if($_GET['what'] == 'input'){


$names = array('Sherlock Holmes', 'John Watson',
'Hercule Poirot', 'Jane Marple');
echo getHTML($names);
}


function getHTML($names)
{
$strResult = '<ul>';
for($i=0; $i<count($names); $i++)
{
$strResult.= '<li>'.$names[$i].'</li>';
}
$strResult.= '</ul>';
return $strResult;
}
?>