$(document).ready(function(){
	    
    var url = location.href;
    
    var test = url.indexOf("/compta/bank/releve.php?account=1&num=");// No hook on this place ,bullshit
    
    if (test > 0)
    {
    	$("table").addClass("addClassHighLight");
    }

    $(".addClassHighLight .oddeven").on("click", function()
    {
		if ($(this).hasClass("checkedAddClassHighLight") == false && $(this).hasClass("uncheckedAddClassHighLight") == false)
		{
			$(this).addClass("checkedAddClassHighLight");
		}
		else if ($(this).hasClass("checkedAddClassHighLight") == true)
		{
			$(this).removeClass("checkedAddClassHighLight").addClass("uncheckedAddClassHighLight");
		}
		else
		{
			$(this).removeClass("uncheckedAddClassHighLight");
		}
    });
   
       
});


