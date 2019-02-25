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
	<style>
	.f16p {
		font-size: 16pt;
		font-family: "新細明體";
	}

	.f26p {
		font-size: 30pt;
		font-family: "標楷體";
	}
	</style>
</head>
<body>                    
	<!-- topbar starts -->
    <?php echo $top; ?>    	
	<?php echo $menu; ?>
	<?php echo $nav; ?>
	
	<div class='box col-md-12'>
		<div class='box-inner'>
			<div class='box-header well' data-original-title=''>
				<h2>一周大事之主播搞</h2>
				<div class='box-icon'>
					<a href='#' class='btn btn-minimize btn-round btn-default'>
						<i class='glyphicon glyphicon-chevron-up'></i>
					</a>
				</div>
			</div>
			<div class='box-content'>										
				<center>
				  <br>					  
				  <table width="90%">
					<tbody>
					  <tr>
						<td align="center">
							<center>
								<input type="button" value="列印本頁" onclick="DP()" class='btn btn-primary btn-xs'>
							</center>
						</td>
					  </tr>
					</tbody>
				  </table>
					<div id='print_div'>
					    <?php foreach($week_ae_data as $key => $rows){
							$content = explode("|+|", $rows['content']);
							if(empty($content[0])){
								$content = $rows['content'];
							}
					    ?>
					   
							<hr width="90%">					  
							<table width="90%" border="0">
							<tbody>
								<tr>
								<td>
								  <p class="f26p"><?php echo $content[0]; ?></p></td>
								</tr>
							</tbody>
							</table>
							<hr width="90%">
							<?php if(($key % 2)==0){ ?>
								<p style="page-break-before:always;"></p>
							<?php } ?>
						
					    <?php } ?>	
					</div>	
				</center>			
			</div>
		</div>
	</div>	
	
	<!-- external javascript -->
	<?php echo $js; ?>	
	<?php echo $footer; ?>	
	
	<script language="JavaScript" type="text/JavaScript">
		function DP() {
			if (window.print){
				var Div1 = document.all.print_div.innerHTML;
				var css = '<style type="text/css" media=all>' +'p { line-height: 120%}' +'.ftitle { line-height: 120%; font-size: 18px; color: #000000}' +'td { font-size: 10px; color: #000000}' +'</style>' ;

				var body ='<table width="100%" border="1" cellspacing="1" cellpadding="5">' +' <tr> ' +' <td class="fbody"> ' +' <div align="center" class=ftitle>' + Div1 + '</div>' + ' </td>' +' </tr>' +'</table>';

				//document.body.innerHTML = '' + css + body + '';
				//this.style.display='none';
				document.body.innerHTML = Div1 ;
				window.print();
				window.history.go(0);
			}
		}
	</script>
</body>
</html>
