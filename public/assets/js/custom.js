function delete_notifier(event,elmId,msg)
{
    event.preventDefault();

    var r = confirm(msg);
    if (r == true) 
    {
        document.getElementById(elmId).submit();
    }
    
}