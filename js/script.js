$(document).ready(function(){
	    
    var url = location.href;
    
    var test = url.indexOf("/compta/bank/releve.php?account=1&num=");
    
    if (test > 0)
    {
    	$(".oddeven").addClass("checkable")
    }

    $( ".oddeven" ).click(function() {
    	if ($(".oddeven").hasClass("checkable"))
    	{
    		if ($(this).hasClass("checked") == false && $(this).hasClass("unchecked") == false)
    		{
    			$(this).addClass("checked");
    		}
    		else if ($(this).hasClass("checked") == true)
    		{
    			$(this).removeClass("checked");
    			$(this).addClass("unchecked");
    		}
    		else
    		{
    			$(this).removeClass("unchecked");
    		}
    	}
    });
    
       
});


