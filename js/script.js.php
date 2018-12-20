<?php 
	require('../config.php');
	if(!empty($conf->global->GRAPEFRUIT_HIGHLIGHTLINE))
	{
?>
		$(document).ready(function(){
		  
		var url = location.href;
		
		var test = url.indexOf("/compta/bank/releve.php?account=");// No hook on this module
		
		if (test > 0)
		{
			$("table").addClass("addclasshighlight");
		}
		
		$(".addclasshighlight .oddeven").on("click", function()
				{
			if ($(this).hasClass("checkedAddClassHighLight") == false && $(this).hasClass("uncheckedAddClassHighLight") == false)
			{
				$(this).addClass("checkedAddClassHighLight");
			}
			else if ($(this).hasClass("checkedAddClassHighLight") == true)
			{
				$(this).switchClass("checkedAddClassHighLight").addClass("uncheckedAddClassHighLight");
			}
			else
			{
				$(this).removeClass("uncheckedAddClassHighLight");
			}
				});
		});
<?php
	} // END : if(!empty($conf->global->GRAPEFRUIT_HIGHLIGHTLINE))
	
	
   
       


