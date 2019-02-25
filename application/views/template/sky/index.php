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
	<?php echo $intro; ?>
	<?php echo $users; ?>
	<?php echo $login; ?>
	<?php echo $change_pwd; ?>
	<!-- external javascript -->
	<?php echo $js; ?>	
	<?php echo $footer; ?>	
</body>

	<script>
	 function check()
	 {
		if ($("input[id='password']").val() == '' || $("input[id='repassword']").val() == '')	{	alert('請輸入新密碼');	return false;	}

		if ($("input[id='password']").val() != $("input[id='repassword']").val())	{	alert('上下兩欄密碼不相同');	return false;	}

	 }	
	</script>
</html>
