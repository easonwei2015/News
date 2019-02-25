<!DOCTYPE html>
<html lang="tw">
<head>
    <meta charset="utf-8">
    <title>東亞新聞</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">
    <!-- The styles --> 
    <?php echo $style; ?>
</head>
<body>                    
	<!-- topbar starts -->
    <?php echo $top; ?>    	
	<?php echo $menu; ?>
	<?php echo $nav; ?>
	<?php echo $view_vedio; ?>
	<?php echo $show_vedio; ?>
	<?php echo $edit_vedio; ?>
	<?php echo $add_reported; ?>
	<?php echo $month_report; ?>
	<?php echo $view_week; ?>
	<?php echo $search_reported; ?>
	<?php echo $search_vedio; ?>
	<?php echo $add_vedio; ?>
	<?php echo $show_reported; ?>
	<?php echo $edit_reported; ?>
	<?php echo $modify_reported; ?>
	<!-- external javascript -->
	<?php echo $js; ?>	
	<?php echo $footer; ?>	
	
	<script language="JavaScript" type="text/JavaScript">
		function DP() {
			if (window.print){
				var Div1 = document.all.print_div.innerHTML;
				var css = '<style type="text/css" media=all>' +'p { line-height: 120%}' +'.ftitle { line-height: 120%; font-size: 18px; color: #000000}' +'td { font-size: 10px; color: #000000}' +'</style>' ;

				var body ='<table width="100%" border="1" cellspacing="1" cellpadding="5">' +' <tr> ' +' <td class="fbody"> ' +' <div align="center" class=ftitle>' + Div1 + '</div>' + ' </td>' +' </tr>' +'</table>';

				document.body.innerHTML = '' + css + body + '';
				window.print();
				window.history.go(0);
			}
		}
	</script>
</body>
</html>
