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
	<?php echo $intro; ?>
	<?php echo $users; ?>
	<?php echo $login; ?>
	<?php echo $change_pwd; ?>
	<?php echo $view_reported; ?>
	<?php echo $show_reported; ?>
	<?php echo $edit_reported; ?>
	<?php echo $modify_reported; ?>
	
	
	<div class='box col-md-12'>
		<div class='box-inner'>
			<div class='box-header well' data-original-title=''>
				<h2>瀏覽主播搞標題 + 內文</h2>
				<div class='box-icon'>
					<a href='#' class='btn btn-minimize btn-round btn-default'>
						<i class='glyphicon glyphicon-chevron-up'></i>
					</a>
				</div>
			</div>
			<div class='box-content'>
				<center>
				  <br>
				  <table width='90%'><tbody><tr><td width='30%'></td><td width='30%' align='center'><form><input type='button' value='列印本頁' onclick='javascript:DP()' class='btn btn-primary btn-xs'></form></td><td width='30%' align='right'><?php echo $now_date ; ?></td></tr></tbody></table>
				    <hr>
				    <table width='90%' border='0'>

					</table>
				    <div id='print_div'>
					<?php foreach($ae_data as $key => $rows){ ?>
						<?php 
							$title = explode("|+|", $rows['title']);
							$content = explode("|+|", $rows['content']);
							if(!empty($title[1])){$title[0] = $title[0].'-'.$title[1];}
						?>
						
						<table width='90%'>
							<tbody>
								<tr>
									<td width='5%'><?php echo $rows['name']; ?></td>
									<td width='75%'>
									<p class='f16p'><?php echo $key . "." . $title[0]; ?></p></td>
									<td width='5%'><?php echo $rows['username'];  ?></td>
								</tr>
								</tbody>
						</table>
						<table width='90%' border='0'>
							<tbody>
								<tr>
								<td><p class='f26p'><?php echo $content[0];  ?></p></td>
								</tr>
							</tbody>
						</table>	
						<hr>							
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
