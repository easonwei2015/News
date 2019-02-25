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
	<?php echo $view_reported; ?>
	<?php echo $show_reported; ?>
	<?php echo $edit_reported; ?>
	<?php echo $modify_reported; ?>
	<?php echo $add_reported; ?>
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
	  $( function() {
		//clear_value();
		$("#datepicker").datepicker({
		  //日期格式	
		  dateFormat: 'yy-mm-dd',			
		  //可使用下拉式選單 - 月份
		  changeMonth : true,
		  //可使用下拉式選單 - 年份
		  changeYear : true,
		  //設定 下拉式選單月份 在 年份的後面
		  showMonthAfterYear : true
		});	
		
		//$('#datepicker').val(<?php echo $datepicker; ?>);						 
		$('#datepicker').val('<?php echo $datepicker; ?>');						 
		$('#CompanySelect').val('<?php echo $CompanySelect; ?>');		
		
		//設定中文語系
		$.datepicker.regional['zh-TW'] = {
		   dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
		   dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"],
		   monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		   monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		   prevText: "上月",
		   nextText: "次月",
		   weekHeader: "週"
		};
		//將預設語系設定為中文
		$.datepicker.setDefaults($.datepicker.regional["zh-TW"]);	
	  } );	
	 
	</script>
</body>
</html>
