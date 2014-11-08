function closeAlert(){
    $('#StyledAlert').hide('slow');    
}
function alert(message)
{    
    $('#StyledAlert').show('slow');
    $('#StyledAlertText').html(message);
}