<script type="text/javascript">
    segundo = 0;
    
    function timer(){
	var now = new Date();
	var time = now.toLocaleString().split('GMT', 1);
	document.getElementById("datetime").innerHTML = time[0];
	setTimeout("timer()",1000);
	
	segundo++;
	if (segundo == 3) {
	    var style = document.styleSheets;

	    for (var i=0; i<style.length; i++) {
		var rules = style[i].cssRules || style[i].rules;

		for (var j=0; j<rules.length; j++) {
		    if (rules[j].selectorText === ".message_ok" || rules[j].selectorText === ".message_error") {
			rules[j].style.display = "none";
		    }
		}
	    }
	}
    }
</script> 

<?php 
function whats_the_time() {
    echo "<form name='clock' onload='javascript:return timer();'></form>";
}
?>