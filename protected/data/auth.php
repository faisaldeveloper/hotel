<?php
return array(
    'reader' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Can only read a post',
        'bizRule'=>'',
        'data'=>''
   ),
 
    'commentor' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Can post a comment',
        'bizRule'=>'',
        'data'=>''
    ),
 
    'admin' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Can read a post and post a comment',
        'children'=>array(
            'reader','commentor'
        ),
        'bizRule'=>'',
        'data'=>''
   )
);

?>