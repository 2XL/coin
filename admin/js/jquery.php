<script>
    $(function() {
	$(".spinner").spinner(
	    {
		min: 0,
		max: 100,
		increment: 'fast' 
	    }
	);
	     
	$(".spinner_hour").spinner(
	    {
		min: 0,
		max: 23
	    }
	);
	    
	$(".spinner_minute").spinner(
	    {
		min: 0,
		max: 59,
		increment: 'fast',
		resize: '10'
	    }
	);
	
	
	$(".datepicker").datepicker(
	    {
		changeYear: true,
		yearRange: '-100:+0',
		dateFormat: 'dd-mm-yy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá']
	    }
	);
    });
</script>