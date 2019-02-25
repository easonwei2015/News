<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class View_lib {
	
	var $index_base_url = '';
	
    var $title   = '';
    var $content = '';
    var $date    = '';
	var $title_name    = '';
	var $path_name    = '';
		
    public function get_view($get_view)
    {		
		$this->index_base_url = base_url() . 'welcome/';
		(isset($get_view['act'])) ? $act = $get_view['act'] : $act ='';
		$this->path_name = $this->_get_path_name($act);
		
		// title name
		(!isset($get_view['path'])) ? $this->title_name = '' : $this->title_name = $this->_get_title_name($get_view['path']);
	
		// 初始化
		$data['style'] = '';
		$data['top'] = '';
		$data['footer'] = '';
		$data['nav'] = '';
		$data['menu'] = '';
		$data['js'] = '';
		$data['intro'] = '';
		$data['users'] = '';
		$data['login'] = '';
		$data['change_pwd'] = '';
		$data['view_reported'] = '';
		$data['show_reported'] = '';
		$data['edit_reported'] = '';
		$data['modify_reported'] = '';
		$data['month_report'] = '';
		$data['view_vedio'] = '';
		$data['show_vedio'] = '';
		$data['edit_vedio'] = '';
		$data['add_reported'] = '';
		$data['view_week'] = '';
		$data['search_reported'] = '';
		$data['search_vedio'] = '';
		$data['add_vedio'] = '';
		
		if(isset($get_view['style']))
		{
			$data['style']= $this->_get_style($get_view);		
		}
		
		if(isset($get_view['top']))
		{	
			$data['top']= $this->_get_top($get_view);
		}
		
		if(isset($get_view['footer']))
		{	
			$data['footer']= $this->_get_footer($get_view);
		}

		if(isset($get_view['nav']))
		{		
			$data['nav']= $this->_get_nav($get_view);
		}		
		
		if(isset($get_view['menu']))
		{		
			$data['menu']= $this->_get_menu($get_view);
		}
		
		if(isset($get_view['js']))
		{			
			$data['js']= $this->_get_js($get_view);
		}
		
		if(isset($get_view['intro']))
		{
			$data['intro']= $this->_get_intro($get_view);

			}
		
		if(isset($get_view['users']))
		{
			$data['users']= $this->_get_users($get_view);
		}
		
		if(isset($get_view['login']))
		{			
			$data['login']= $this->_get_login($get_view);
		}
		
		if(isset($get_view['change_pwd']))
		{			
			$data['change_pwd']= $this->_get_change_pwd($get_view);
		}	
		if(isset($get_view['view_reported']))
		{			
			$data['view_reported']= $this->_get_view_reported($get_view);
		}
		
		if(isset($get_view['show_reported']))
		{			
			$data['show_reported']= $this->_get_show_reported($get_view);
		}
		
		if(isset($get_view['edit_reported']))
		{			
			$data['edit_reported']= $this->_get_edit_reported($get_view);
		}		
		
		if(isset($get_view['modify_reported']))
		{			
			$data['modify_reported']= $this->_get_modify_reported($get_view);
		}	
		
		if(isset($get_view['month_report']))
		{			
			$data['month_report']= $this->_get_month_report($get_view);
		}	
		if(isset($get_view['view_vedio']))
		{			
			$data['view_vedio']= $this->_get_view_vedio($get_view);
		}
		if(isset($get_view['show_vedio']))
		{			
			$data['show_vedio']= $this->_get_show_vedio($get_view);
		}		
		if(isset($get_view['edit_vedio']))
		{			
			$data['edit_vedio']= $this->_get_edit_vedio($get_view);
		}	
		if(isset($get_view['add_reported']))
		{			
			$data['add_reported']= $this->_get_add_reported($get_view);
		}	
		if(isset($get_view['view_week']))
		{			
			$data['view_week']= $this->_get_view_week($get_view);
		}	
		if(isset($get_view['search_reported']))
		{			
			$data['search_reported']= $this->_get_search_reported($get_view);
		}	
		if(isset($get_view['search_vedio']))
		{			
			$data['search_vedio']= $this->_get_search_vedio($get_view);
		}			
		if(isset($get_view['add_vedio']))
		{			
			$data['add_vedio']= $this->_get_add_vedio($get_view);
		}		
		
		return $data;  
    }
	
	// 載入 css
	function _get_style($get_view)
	{
		$style = " <link href='" . base_url() . "assets/css/bootstrap-cerulean.min.css' rel='stylesheet'>						
										<link href='" . base_url() . "assets/css/charisma-app.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
										<link href='" . base_url() . "assets/bower_components/chosen/chosen.min.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/css/jquery.noty.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/css/noty_theme_default.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/css/elfinder.min.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/css/elfinder.theme.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/css/jquery.iphone.toggle.css' rel='stylesheet'>
										<link href='" . base_url() . "assets/css/uploadify.css' rel='stylesheet'>
										
										<script src='" . base_url() . "assets/bower_components/jquery/jquery.min.js'></script>
										<!--<script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>-->
										<script src='http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js'></script>
										<link rel='shortcut icon' href='" . base_url() . "assets/img/favicon.ico'>
										<link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
										<script src='https://code.jquery.com/jquery-1.12.4.js'></script>
										<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
										<script src='" . base_url() . "assets/ckeditor/ckeditor.js'></script>						
		";
		return $style;
	}
	
	// 載入天
	function _get_top($get_view)
	{
		(isset($get_view['session']['ssnUserName']))? $user_name = $get_view['session']['ssnUserName'] : $user_name = '';
		(isset($get_view['session']['ssnLoginID']))? $log_id = $get_view['session']['ssnLoginID'] : $log_id = '';
		$search='';
		if(!isset($get_view['session']['ssnUserNo'])){
			$get_view['session']['ssnUserNo']='';			
		}else{
			/*
			$search = "
						<div class='btn-group pull-right theme-container animated tada'>	
							<form>		
									<select class='form-control' name='CompanySelect' id='CompanySelect' '=''>
															<option value=''>所有地區</option>
															<option value='1'>洄瀾</option>
															<option value='2'>東亞</option>
															<option value='3'>東台</option>
														</select>
								<tr><td><input placeholder='Search' name='query' type='text'></td>									
								</tr>	
								<td><button class='btn btn-success   btn-round btn-lg'>搜</button></td>
							</form>		
						</div>
					";			
			*/		
		}
		
		$logout ="<li class='divider'></li>";
		if(!isset($get_view['login'])){
			$logout ="<li><a href='".$this->index_base_url."index/?person=".$get_view['session']['ssnUserNo']."'>個人登入紀錄</a></li>
					  <li class='divider'></li>
					  <li><a href='#'>登入Log：".$log_id."</a></li>
					  <li class='divider'></li>			
					  <li><a href='" . $this->index_base_url . "logout'>登出</a></li>
					 ";
		}
		
		$top = "
				<div class='navbar navbar-default' role='navigation'>
					<div class='navbar-inner'>
						<button type='button' class='navbar-toggle pull-left animated flip'>
							<span class='sr-only'>Toggle navigation</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>
						<a class='navbar-brand' href='" . base_url() . "'> <img alt='Charisma Logo' src='" . base_url() . "assets/img/logo20.png' class='hidden-xs'/>
							<span>TYCATV</span></a>

						<!-- user dropdown starts -->
						<div class='btn-group pull-right'>
							<button class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
								<i class='glyphicon glyphicon-user'></i><span class='hidden-sm hidden-xs'> " . $user_name . "</span>
								<span class='caret'></span>
							</button>
							<ul class='dropdown-menu'>
								
								".$logout."
							</ul>
						</div>
						<!-- user dropdown ends -->

						<!-- theme selector starts -->
						".$search."
						<!-- theme selector ends -->
											
						

					</div>
				</div>
		";		
		return $top;
	}
	
	// 載入 頁簽
	function _get_nav($get_view)
	{
		$nav = "
			<ul class='breadcrumb'>
				<li>
					<a href='". base_url() . "'>TYCATV</a>
				</li>
				<li>
					<a href='#'>" . $this->title_name . "</a>
				</li>
			</ul>
		";
		return $nav;
	}
	
	// 載入導覽列
	function _get_menu($get_view)
	{
		if(preg_match( "/3{1,}/", $get_view['session']['ssnLevel'])){
		}		
		$menu ="
				<div class='ch-container'>
					<div class='row'>        
						<!-- left menu starts -->
						<div class='col-sm-2 col-lg-2'>
							<div class='sidebar-nav'>
								<div class='nav-canvas'>
									<div class='nav-sm nav nav-stacked'>

									</div>
									<ul class='nav nav-pills nav-stacked main-menu'>
										<li><a class='ajax-link' href='" . base_url() . "'><i class='glyphicon glyphicon-home'></i><span> 回到首頁</span></a>
										";
		// 權限管理									
		if(preg_match( "/0{1,}/", $get_view['session']['ssnLevel'])){									
			$menu .="
											<li class='nav-header hidden-md'>使用者</li>
												<ul class='nav nav-pills nav-stacked'>
													<li><a href='" . $this->index_base_url ."view_users'> 檢視</a></li>
												</ul>
			";
		}
		
		// 權限管理
		if(preg_match( "/2{1,}/", $get_view['session']['ssnLevel'])){			
			$menu .="		
											 <li class='nav-header hidden-md'>影帶管理</li>
												<ul class='nav nav-pills nav-stacked'>
													<li><a href='" . $this->index_base_url ."add_vedio' class= 'glyphicon glyphicon-plus'> 新增</a></li>
													<li><a href='" . $this->index_base_url ."search_vedio' class='glyphicon glyphicon-globe'> 搜尋</a></li>
													<li><a href='" . $this->index_base_url ."view_vedio?act=1' class ='glyphicon glyphicon-eye-open'> 瀏覽</a></li>
													<li><a href='" . $this->index_base_url ."view_vedio?act=0' class='glyphicon glyphicon-trash'> 資源回收筒</a></li>
												</ul>
											</li>	
											 <li class='nav-header hidden-md'> 新聞稿</li>
												<ul class='nav nav-pills nav-stacked'>
													<li><a href='" . $this->index_base_url ."add_reported' class='glyphicon glyphicon-plus'> 發布</a></li>
													<li><a href='" . $this->index_base_url ."search_reported' class='glyphicon glyphicon-globe'> 搜尋</a></li>
													<li><a href='" . $this->index_base_url ."view_week?view=0' class ='glyphicon glyphicon-eye-open'> 瀏覽一週大事</a></li>
													<li><a href='" . $this->index_base_url ."week_ae' class='glyphicon glyphicon-file'> 一週大事之主播稿</a></li>
													<li><a href='" . $this->index_base_url ."view_reported?act=0' class='glyphicon glyphicon-trash'> 瀏覽已刪除</a></li>
													<li><a href='" . $this->index_base_url ."view_reported?act=1' class ='glyphicon glyphicon-eye-close'> 瀏覽未報導</a></li>
													<li><a href='" . $this->index_base_url ."view_reported?act=9' class ='glyphicon glyphicon-eye-open'> 瀏覽已報導</a></li>
													<li><a href='" . $this->index_base_url ."view_ae' class= 'glyphicon glyphicon-gift'> 瀏覽主播稿標題+內文</a></li>
													<li><a href='" . $this->index_base_url ."month_report' class =' glyphicon glyphicon-list-alt '> 月報表</a></li>
												</ul>
												";
		}										
										
		$menu.="
										<li><a href='" . $this->index_base_url . "logout' target='_parent'><i class='glyphicon glyphicon-lock'></i><span> 登出</span></a>
										</li>		
									</ul>
								</div>
							</div>
						</div>
						<!--/span-->
						<!-- left menu ends -->

						<noscript>
							<div class='alert alert-block col-md-12'>
								<h4 class='alert-heading'>Warning!</h4>

								<p>You need to have <a href='http://en.wikipedia.org/wiki/JavaScript' target='_blank'>JavaScript</a>
									enabled to use this site.</p>
							</div>
						</noscript>

						<div id='content' class='col-lg-10 col-sm-10'>
							<!-- content starts -->
						<div>								
				</div>
		";
		
		return $menu;
	}
	
	// 載入 js
	function _get_js($get_view)
	{
		$js = "
				<script src='" .  base_url() . "assets/bower_components/bootstrap/dist/js/bootstrap.min.js'></script>

				<!-- library for cookie management -->
				<script src='" .  base_url() . "assets/js/jquery.cookie.js'></script>
				<!-- calender plugin -->
				<script src='" .  base_url() . "assets/bower_components/moment/min/moment.min.js'></script>
				<script src='" .  base_url() . "assets/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
				<!-- data table plugin -->
				<script src='" .  base_url() . "assets/js/jquery.dataTables.min.js'></script>

				<!-- select or dropdown enhancer -->
				<script src='" .  base_url() . "assets/bower_components/chosen/chosen.jquery.min.js'></script>
				<!-- plugin for gallery image view -->
				<script src='" .  base_url() . "assets/bower_components/colorbox/jquery.colorbox-min.js'></script>
				<!-- notification plugin -->
				<script src='" .  base_url() . "assets/js/jquery.noty.js'></script>
				<!-- library for making tables responsive -->
				<script src='" .  base_url() . "assets/bower_components/responsive-tables/responsive-tables.js'></script>
				<!-- tour plugin -->
				<script src='" .  base_url() . "assets/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js'></script>
				<!-- star rating plugin -->
				<script src='" .  base_url() . "assets/js/jquery.raty.min.js'></script>
				<!-- for iOS style toggle switch -->
				<script src='" .  base_url() . "assets/js/jquery.iphone.toggle.js'></script>
				<!-- autogrowing textarea plugin -->
				<script src='" .  base_url() . "assets/js/jquery.autogrow-textarea.js'></script>
				<!-- multiple file upload plugin -->
				<script src='" .  base_url() . "assets/js/jquery.uploadify-3.1.min.js'></script>
				<!-- history.js for cross-browser state change on ajax -->
				<script src='" .  base_url() . "assets/js/jquery.history.js'></script>
				<!-- application script for Charisma demo -->
				<script src='" .  base_url() . "assets/js/charisma.js'></script>		
		";
		return $js;
	}
	
	// 使用者登入資料
	function _get_intro($get_view)
	{
		$tr_str = '';
		if(!empty($get_view['user_login_list']))
		{
			$tr_str .="
					<table class='table table-striped'>
						<thead>											
							<tr>
								<th>姓名</th>
								<th>IP Address</th>
								<th>時間</th>
							</tr>
						</thead>
						<div class='box-content'>
			";
			foreach($get_view['user_login_list'] as $rows)
			{
				$tr_str .= "<tr>
							 <td>" . $rows['username'] . "</td>
							 <td class='center'>" . $rows['ip_addr'] . "</td>
							 <td class='center'>" . $rows['datetime'] . "</td>
						   </tr>
				";				
			}
			$tr_str.="</div>
					</table>			
			";
		}
		
		$intro = "
				<div class='row'>
					<div class='box col-md-12'>
						<div class='box-inner'>
							<div class='box-header well'>
								<h2><i class='glyphicon glyphicon-info-sign'></i> 使用者登入資料</h2>

								<div class='box-icon'>
									<a href='#' class='btn btn-minimize btn-round btn-default'><i
											class='glyphicon glyphicon-chevron-up'></i></a>
									<a href='#' class='btn btn-close btn-round btn-default'><i
											class='glyphicon glyphicon-remove'></i></a>
								</div>
							</div>
							<div class='box-content row'>
								<div class='col-lg-5 col-md-12 visible-xs center-text'>
									<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
									<!-- Charisma Demo 5 -->
									<ins class='adsbygoogle'
										 style='display:inline-block;width:250px;height:250px'
										 data-ad-client='ca-pub-5108790028230107'
										 data-ad-slot='8957582309'></ins>
									<script>
										(adsbygoogle = window.adsbygoogle || []).push({});
									</script>
								</div>
								<!-- Ads end -->								
										". $tr_str . "									
							</div>
						</div>
					</div>
				</div>	
		";
		return $intro;
	}	
	
	//  檢視使用者
	function _get_users($get_view)
	{

		$tr_str = '';
		$label_status='';
		foreach($get_view['users_list'] as $rows)
		{
			($rows['active']=='1') ? $label_status = "<span class='label-success label label-default'>使用中</span>" : $label_status = "<span class='label-default label label-danger'>停用中</span>";
			$tr_str .= "<tr>
							<td>" . $rows['no'] . "</td>
							<td class='center'>" . $rows['user_id'] . "</td>
							<td class='center'>" . $rows['username'] . "</td>
							<td class='center'>" . $rows['level'] . "</td>
							<td class='center'>
								" . $label_status . "
							</td>
							<td class='center'>
								<a class='btn btn-info' href='" . $this->index_base_url . "change_pwd?no=" . $rows['no']. "'>
									<i class='glyphicon glyphicon-edit icon-white'></i>
									變更密碼
								</a>
							</td>								
					   </tr>
			";
			
		}
		
		$users = "
				<div class='row'>
					<div class='box col-md-12'>
						<div class='box-inner'>
							<div class='box-header well' data-original-title=''>
								<h2><i class='glyphicon glyphicon-user'></i> ".$this->title_name."</h2>
								<div class='box-icon'>
									<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>
									<a href='#' class='btn btn-close btn-round btn-default'><i class='glyphicon glyphicon-remove'></i></a>
								</div>
							</div>
							<div class='box-content'>
								<table class='table table-striped table-bordered responsive'>
									<thead>
										<tr>
											<th>No</th>
											<th>帳號</th>
											<th>姓名</th>
											<th>群組</th>
											<th>act</th>
											<th>功能</th>
										</tr>
									</thead>
									<tbody>
										" . $tr_str . "
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>		
		";
		
		return $users;
	}		
	
	// 登入頁面
	function _get_login($get_view)
	{
		$login = "
					<div class='row'>
						<div class='well col-md-5 center login-box'>
							<div class='alert alert-info'>
								請輸入 帳號 及 密碼
							</div>
							<form class='form-horizontal' action='" . $this->index_base_url. "login' method='post'>
								<fieldset>
									<div class='input-group input-group-lg'>
										<span class='input-group-addon'><i class='glyphicon glyphicon-user red'></i></span>
										<input type='text' id='Username' name='Username' class='form-control' placeholder='帳號'>
									</div>
									<div class='clearfix'></div><br>

									<div class='input-group input-group-lg'>
										<span class='input-group-addon'><i class='glyphicon glyphicon-lock red'></i></span>
										<input type='password'  id='password'  name='password' class='form-control' placeholder='密碼'>
									</div>
									<div class='clearfix'></div>
									<div class='clearfix'></div>
									<p class='center col-md-5'>
										<button type='submit' class='btn btn-primary'>登陸</button>
									</p>
									建議使用 Chrome 瀏覽器瀏覽網頁
								</fieldset>
							</form>
						</div>
						<!--/span-->
					</div>		
			";		
		return $login;
	}		
	
	function _get_change_pwd($get_view)
	{
		$change_pwd= "
						<div class='row'>
							<div class='box col-md-12'>
								<div class='box-inner'>
									<div class='box-header well' data-original-title=''>
										<h2><i class='glyphicon glyphicon-edit'></i> ".$this->title_name."</h2>

										<div class='box-icon'>
											<a href='#' class='btn btn-setting btn-round btn-default'><i class='glyphicon glyphicon-cog'></i></a>
											<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>
											<a href='#' class='btn btn-close btn-round btn-default'><i class='glyphicon glyphicon-remove'></i></a>
										</div>
									</div>
									<div class='box-content'>
										<form name = 'form1'  action='" . $this->index_base_url . "change_pwd' method='POST' onsubmit='return check()'>
											<div class='form-group'>
												<label >請輸入新密碼</label>
												<input type='password' class='form-control' id='password'  name='password' placeholder='新密碼'>
											</div>
											<div class='form-group'>
												<label >請再輸入一次</label>
												<input type='password' class='form-control' id='repassword' name='repassword' placeholder='再輸入一次'>
											</div>
											<input type='hidden' id='no' name='no' value='" . $get_view['no'] . "'>
											<button type='submit' class='btn btn-default' >送出</button>
											<button type='reset' class='btn btn-default'>重填</button>
										</form>
									</div>
								</div>
							</div>
						</div>			
		";
		
		return $change_pwd;
	}
	
	// 瀏覽 新聞稿
	function _get_view_reported($get_view)
	{
		$now_page = $get_view['now_page'] + 1;
		$last_page = $get_view['now_page'] -1 ; //上一頁
		$next_page = $get_view['now_page'] +1 ; //下一頁
		($get_view['now_page'] < 1) ? $last_page_content = '' : $last_page_content = "<li><a href='" . $this->index_base_url ."view_reported/?act=" . $get_view['act'] . "&page=". $last_page ."'>上一頁</a></li>";
		
		$sort_title="";
		// 串權限看到的物件
		if(preg_match( "/3{1,}/", $get_view['session']['ssnLevel'])){
			$sort_title="<th>排序</th>";
		}
		
		$tr_str = '';
		foreach($get_view['reported_list'] as $index => $rows)
		{
			$title ='';
			$edit_url =  $this->index_base_url ."show_reported/?no=" . $rows['no'];	
			$title = explode("|+|", $rows['title']);
			if(!isset($title[1])){$title[1]='';} // fix php notice @20170123 
			
			if($title[1]==''){
				$title = $title[0];
			}else{
				$title = $title[0] . '–' . $title[1];
			}
	
			$d_or_re='';
			if($get_view['act'] == 0){
				/*
				$d_or_re ="
							<a class='label label-info' href='".$this->index_base_url ."d_or_undo/?no=" . $rows['no']."&act=1'>
								<i class='glyphicon glyphicon-share-alt'></i>
								還原
							</a>			
				";
				*/				
			}else{
				
				$d_or_re ="
							<a class='label-default label label-danger' href='".$this->index_base_url ."d_or_undo/?no=" . $rows['no']."&act=0'>
								<i class='glyphicon glyphicon-trash icon-white'></i>
								刪除
							</a>
				";					
			}
			
			
			$tr_str .= "<tr>
							<td>" . $rows['name'] . "</td>
							<td class='center'>" . $title . "</td>
							<td>
								<a class='label-success label label-default' href='" . $edit_url . "'>
									<i class='glyphicon glyphicon-edit icon-white'></i>
									編輯
								</a>
								".$d_or_re."
							</td>							
							<td class='center'>" . $rows['username'] . "</td>							
							<td class='center'>" . $rows['datetime'] . "</td>
			";
			
			// 串權限看到的物件
		    if(preg_match( "/3{1,}/", $get_view['session']['ssnLevel'])){
				$tr_str.="<td class='center'>
						    <input name='n" . $index . "' type='hidden' value='" . $rows['no'] . "'>
							<input name='s" . $index . "'  type='text' value = ' " . $rows['sort'] . " '>
						  </td>";		
			}	
			
			$tr_str.="				
						</tr>					   
			";			
		}
		
		// 組 快速選頁
		$selete_option = '';		
		for ( $i=1; $i<=$get_view['page_total']; $i++ )	
		{	
			$page = $i -1 ;
			if((string) $i == (string) $get_view['now_page']+1){
				$selete_option .= '<option value=' . $page . ' selected>第 ' . $i . ' 頁';
			}else{
				$selete_option .= '<option value=' . $page . '>第 ' . $i . ' 頁';
			}
		}		
		$selete_option .= '</select></td>';

		$view_reported = "					
						<form id ='query_form' action ='" . $this->index_base_url ."view_reported' method ='GET'>
							<ul class='pagination pagination-centered'>
								<li><a href='#' onclick='javascript:DP()'>列印本頁</a></li>
								" . $last_page_content . "
								<li class='active'><a href='#'>第" . $now_page . "頁</a></li>				
								<li><a href='" . $this->index_base_url ."view_reported/?act=" . $get_view['act'] . "&page=". $next_page ."'>下一頁</a></li>
							
									<select class='form-control' name='page' id='page' onchange='JavaScript:showPage()'>" . $selete_option . "	
									<input type='hidden' name='act' id='act' value ='" . $get_view['act'] . "'>
									<input type='hidden' name='opt' id='opt' value =''>
												
							</ul>
							<ul class='pagination pagination-centered'>
								<select class='form-control' name='CompanySelect' id='CompanySelect' '=''>
									<option value=''>所有地區</option>
									<option value='1'>洄瀾</option>
									<option value='2'>東亞</option>
									<option value='3'>東台</option>
								</select>
																					
								<input class='form-control' type='text' id='datepicker' name='datepicker'  placeholder='點此選擇查詢日期' class='hasDatepicker'>
							</ul>
							<ul class='pagination pagination-centered'>								
								<input class='btn btn-primary btn-sm' type='button' value='查詢' onclick='JavaScript:showPage()'>
								<input class='btn btn-primary btn-sm' type='button' value='清空' onclick='clear_value()'>	
								<input class='btn btn-primary btn-sm' type='button' value='重新排列' onclick='JavaScript:order_sort()'>
								<input type='hidden' name='rows_count' id='rows_count' value='".$get_view['rows_count']."'>	
								
							</ul>
							<div class='row'>
								<div class='box col-md-12'>								
									<div class='box-inner'>
										<div class='box-header well' data-original-title=''>
											<h2>" . $this->title_name . "</h2>

											<div class='box-icon'>
												<a href='#' class='btn btn-setting btn-round btn-default'><i class='glyphicon glyphicon-cog'></i></a>
												<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>
												<a href='#' class='btn btn-close btn-round btn-default'><i class='glyphicon glyphicon-remove'></i></a>
											</div>
										</div>
										
											<div class='box-content'>
												<div id='print_div'>
													<table class='table table-bordered table-striped table-condensed'>
														<thead>
															<tr>
																<th>社會</th>
																<th>標題</th>
																<th>動作</th>
																<th>發布人</th>
																<th>發布時間</th>
																".$sort_title."
															</tr>
														</thead>
														<tbody>
															" . $tr_str . "
														</tbody>
													</table>
												</div>
												<ul class='pagination pagination-centered'>
													<li><a href='#' onclick='javascript:DP()'>列印本頁</a></li>
													" . $last_page_content . "
													<li class='active'><a href='#'>第" . $now_page . "頁</a></li>				
													<li><a href='" . $this->index_base_url ."view_reported/?act=" . $get_view['act'] . "&page=". $next_page ."'>下一頁</a></li>
												</ul>											
											</div>
									</div>
								</div>
							</div>	
						</form>	
<script>
						function order_sort()
						{
							 $('#opt').val('sort');
							 this.query_form.submit();
						}
						 function showPage()
						 {
							 this.query_form.submit();
						 }
						function clear_value() {
							$('#datepicker').val('');
							$('#CompanySelect').val('');
						}								 
						
						</script>						
		";
		
		return $view_reported;
		
	}
	
	// 瀏覽 影帶管理
	function _get_view_vedio($get_view)
	{
		$tr_str = '';
		foreach($get_view['vedio_data'] as $rows)
		{
			
			$tr_str .= "<tr>
							<td>" . $rows['record_no'] . "</td>
							<td class='center'>
								<a href='" . $this->index_base_url ."show_vedio/?no=".$rows['no']."&act=".$get_view['act']."'>".$rows['no'] . "> " . $rows['title']."</a>
							</td>						
							<td class='center'>" . $rows['time'] . "</td>							
							<td class='center'>" . $rows['username'] . "</td>							
						</tr>					   
			";
			
		}
		
		$veiw_vedio = "	<div class='row'>
							<div class='box col-md-8'>								
								<div class='box-inner'>
									<div class='box-header well' data-original-title=''>
										<h2>".$this->title_name."</h2>

										<div class='box-icon'>
											<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>	
										</div>
									</div>
									
										<div class='box-content' id='print_div'>
											<div id='print_div'>
												<table class='table table-bordered table-striped table-condensed'>
													<thead>
														<tr>
															<th>影帶編號</th>
															<th>內容</th>
															<th>時間</th>
															<th>發布人</th>
														</tr>
													</thead>
													<tbody>
														" . $tr_str . "
													</tbody>
												</table>
											</div>									
										</div>
								</div>
							</div>
						</div>	
		";
		
		return $veiw_vedio;
		
	}	
	
	// 新聞稿 詳細資料
	function _get_show_reported($get_view)
	{	
		$title= explode("|+|", $get_view['title']);			
		$content= explode("|+|", $get_view['content']);
		
		
		// fix php notice
		if(!isset($title[1])){ $title[1] = '';}
		if(!isset($content[1])){ $content[1] = '';}	
		$interviewee = '';		
		
		// 組 受訪者 
		
		if ( !empty($get_view['interviewee']) )
		{
			$interviewee_array = explode("|+|", $get_view['interviewee']);
		
			$intervieweecounter = count( $get_view['interviewee'] );			
		
			for ($counter = 0; $counter <= $intervieweecounter; $counter++)
			{
				if ($counter>0) { $interviewee .= '<br>'; }
				 $interviewee .= $interviewee_array[$counter];
			}
		}	
		
		$category = $this->_get_category($get_view['category']);
		
		$show_reported = "
						<div class='box col-md-8'>
							<div class='box-inner'>
								<div class='box-header well' data-original-title=''>
									<h2>".$this->title_name."</h2>
									<div class='box-icon'>
										<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>
									</div>
								</div>
								<div class='box-content'>
									<div id='print_div'>
										<table class='table table-striped'>
											<thead>
											<tr>
												<th></th>												
												<th></th>
												<th></th>
											</tr>
											</thead>										
											<tbody>
												<tr>
													<td width='80'>發布時間 : 
													</td>
													<td>" . $get_view['datetime'] . "</td>
												<tr>	
													<td>類別 : </td>
													<td>" . $category  . "</td>
												</tr>
												<tr>
													<td>標題 : </td>
													<td>" . $title[0]  . "</td>
												</tr>
												<tr>	
													<td>標題 : </td>
													<td>" . $title[1]  . "</td>
												</tr>
												<tr>	
													<td>長度 : </td>
													<td>" . ''  . "</td>
												</tr>
												<tr>	
													<td>發布人 :</td>
													<td> " . $get_view['username'] . "</td>
												</tr>
												<tr>	
													<td>受訪者 :</td>
													<td>" . $interviewee . "</td>											
												</tr>
												<tr>	
													<td>主播搞 : </td>
													<td> " . $content[0] . " </td>											
												</tr>	
												<tr>
													<td>新聞搞 : </td>
													<td> " . $content[1] . " </td>													
												</tr>												
											</tbody>										
										</table>
									</div>
									<td class='center'>
										<ul class='pagination pagination-centered'>
											<li><a href='#' onclick='javascript:DP()'>列印本頁</a></li>

											<li class='pagination pagination-centered'><a href='" . $this->index_base_url ."edit_reported/?no=" . $get_view['no'] . "'>編輯</a></li>				
											<li><a href='".$this->index_base_url ."d_or_undo/?no=" . $get_view['no']."&act=0'>刪除</a></li>
										</ul>									
									</td>	
								</div>
							</div>
						</div>				
		";
		
		return $show_reported;
		
	}
	
	// 影帶管理 詳細資料
	function _get_show_vedio($get_view)
	{
		if($get_view['act'] == 1){
			$d_or_undo = "<li><a href='" . $this->index_base_url ."d_vedio/?no=".$get_view['no']."&act=0'>刪除</a></li>";
		}else{
			$d_or_undo = "<li><a href='" . $this->index_base_url ."d_vedio/?no=".$get_view['no']."&act=1'>還原</a></li>";
		}
		$show_vedio = "
						<div class='box col-md-8'>
							<div class='box-inner'>
								<div class='box-header well' data-original-title=''>
									<h2>".$this->title_name."</h2>
									<div class='box-icon'>
										<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>
									</div>
								</div>
								<div class='box-content' id='print_div'>
									<table class='table table-striped'>
										<thead>
										<tr>
											<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th></th>
											<th></th>
										</tr>
										</thead>
										<div >
											<tbody>
												<tr>
													<td width='110'>發布人 : </td>
													<td>" . $get_view['show_vedio_data']['username'] . "</td>
												<tr>	
													<td>影帶編號 : </td>
													<td>" . $get_view['show_vedio_data']['record_no']  . "</td>
												</tr>
												<tr>
													<td>日期 : </td>
													<td>" . $get_view['show_vedio_data']['date']  . "</td>
												</tr>
												<tr>	
													<td>內容 : </td>
													<td>" . $get_view['show_vedio_data']['title']  . "</td>
												</tr>
												<tr>	
													<td>詳細說明 : </td>
													<td>" . str_replace( chr(13).chr(10), "<br>", $get_view['show_vedio_data']['content'] )  . "</td>
												</tr>
												<tr>	
													<td>時間 :</td>
													<td> " . $get_view['show_vedio_data']['time'] . "</td>
												</tr>
												<tr>	
													<td>路徑 :</td>
													<td>" . $get_view['show_vedio_data']['path'] . "</td>											
												</tr>											
										</tbody>
									</div>
								</table>
							</div>
							<td class='center'>
								<ul class='pagination pagination-centered'>
									<li><a href='#' onclick='javascript:DP()'>列印本頁</a></li>

									<li class='pagination pagination-centered'><a href='" . $this->index_base_url ."edit_vedio/?no=". $get_view['no']."'>編輯</a></li>				
									".$d_or_undo."
								</ul>									
							</td>							
						</div>
					</div>				
		";
		
		return $show_vedio;
		
	}	
	
	// 編輯 新聞稿
	function _get_edit_reported($get_view)
	{	
		$title= explode("|+|", $get_view['title']);
		$interviewee = explode("|+|", $get_view['interviewee']);		
		$content= explode("|+|", $get_view['content']);
		//$category = $get_view['category'];
		
		// fix php notice
		if(!isset($title[1])){ $title[1] = '';}
		if(!isset($interviewee[1])){ $interviewee[1] = '';}
		if(!isset($content[1])){ $content[1] = '';}

		// 組 類別
		$category_option = '<select name="category">';
		$category_array = $this->_get_category('GET');
		$Num = count($category_array);
		
		for ($i=1; $i<=$Num; $i++) {
			if ( (string) $i == (string)$get_view['category']){
				$category_option .= '<option value="' . $i . '" selected>' . $category_array[$i] . '　</option>';
			}else{
				$category_option .=  '<option value="' . $i . '">' . $category_array[$i] . '　</option>';
			}
		}

		$edit_reported = "
							<form method='post' name='form1' action='" . $this->index_base_url. "modify_reported' onsubmit='return check()'>
								<div class='box col-md-8'>
									<div class='box-inner'>
										<div class='box-header well' data-original-title=''>
											<h2>".$this->title_name."</h2>
											<div class='box-icon'>
												<a href='#' class='btn btn-minimize btn-round btn-default'>
													<i class='glyphicon glyphicon-chevron-up'></i>
												</a>
											</div>
										</div>
										<div class='box-content'>
											<table class='table table-striped'>
												<div id='print_div'>													
													<tbody>
														<div id='ctrl_option'>
															<tr>
																<td>類別：</td>
																<td>
																	" . $category_option . "
																</td>																
															</tr>
															<script>
																$('div.ctrl_option select').val('" . (string) $get_view['category'] . "');
															</script>																
														</div>	
														<tr>
															<td>標題：</td>
															<td>
																<input name='title1' type='text' size='50' maxlength='50' value='" . $title[0]. "'></td>
														</tr>
														<tr>
															<td>副標題：</td>
															<td>
																<input name='title2' type='text' size='50' maxlength='50' value='" . $title[1] . "'></td>
														</tr>
														<tr>
															<td valign='top'>受訪者：</td>
															<td>
																<input name='interviewee1' type='text' size='50' value='" . $interviewee[0] . "'>
																<br>
																<input name='interviewee2' type='text' size='50' value='" . $interviewee[1] . "'></td>
														</tr>
														<tr>
															<td valign='top'>主播稿：</td>
															<td>
																<textarea class='autogrow' name='content1' id='content1' rows='10' cols='100'>" . $content[0] . "</textarea>
																<br><a>大斷行: Enter ，小斷行 : Shift + Enter</a>
															</td>
																														
														</tr>
														<tr>
															<td valign='top'>新聞稿：</td>
															<td>
																<textarea class='autogrow' name='content2' id='content2'  rows='10' cols='100'>" . $content[1] . "</textarea>
																<br><a>大斷行: Enter ，小斷行 : Shift + Enter</a>
															</td>
														</tr>
														<script>
															CKEDITOR.replace( 'content1', {});
															CKEDITOR.replace( 'content2', {});												
														</script>
														<div class='box-content'>
															<tr>
																<td></td>
																<td>
																	<input name='no' type='hidden' value='" .  $get_view['no'] . "'>
																	<p class='right'><button class='btn btn-primary btn-sm'>送出</button></p>
																</td>
																
															</tr>
														</div>																
													</tbody>
												</div>
											</table>
										</div>
									</div>
								</div>
							</form>
							
							<script>							
								function check()
								{
									if (document.form1.category.value == '0'){	
										alert('請選擇 類別');	
										return false;	
									}
									if (document.form1.title1.value == ''){	
										alert('請輸入 標題');	
										return false;	
									}

									var content1= CKEDITOR.instances.content1.getData();								
									var content2= CKEDITOR.instances.content2.getData();
									
									<!--if (document.form1.content1.value ==''){-->
									if (content1 ==''){
										alert('請輸入 主播稿');	
										return false;	
									}
									<!--if (document.form1.content2.value ==''){-->
									if (content2 ==''){
										alert('請輸入 新聞稿');	
										return false;	
									}
									//this.form1.submit();
								}															
							</script>	
		";
		
		return $edit_reported;
		
	}
	
	// 編輯 影帶管理
	function _get_edit_vedio($get_view)
	{	
		// 設置路徑 D、E、F磁碟
		if ( !empty($get_view['show_vedio_data']['path']) )	{
			$drv  = substr($get_view['show_vedio_data']['path'], 0, 1);
			$path = substr($get_view['show_vedio_data']['path'], 2);
		}	else	{
			$drv = "d";
			$path = "";
		}
		
		if(empty($get_view['show_vedio_data']['date'])){$get_view['show_vedio_data']['date']='';}
		if(empty($get_view['show_vedio_data']['username'])){$get_view['show_vedio_data']['username']='';}
		if(empty($get_view['show_vedio_data']['record_no'])){$get_view['show_vedio_data']['record_no']='';}
		if(empty($get_view['show_vedio_data']['title'])){$get_view['show_vedio_data']['title']='';}
		if(empty($get_view['show_vedio_data']['content'])){$get_view['show_vedio_data']['content']='';}
		if(empty($get_view['show_vedio_data']['time'])){$get_view['show_vedio_data']['time']='';}
		if(empty($get_view['show_vedio_data']['act'])){$get_view['show_vedio_data']['act']='';}
  
		$edit_vedio = "
						<form method='post' name='form1' action='" . $this->index_base_url. "modify_vedio' onsubmit='return check()'>
							<div class='box col-md-8'>
								<div class='box-inner'>
									<div class='box-header well' data-original-title=''>
										<h2>".$this->title_name."</h2>
										<div class='box-icon'>
											<a href='#' class='btn btn-minimize btn-round btn-default'>
												<i class='glyphicon glyphicon-chevron-up'></i>
											</a>
										</div>
									</div>
									<div class='box-content'>
										<table class='table table-striped'>
											<div id='print_div'>													
												<tbody>
													<div id='ctrl_option'>
														<tr>
															<td>發布人：</td>
															<td>
																" . $get_view['show_vedio_data']['username'] . "
															</td>																
														</tr>														
													</div>	
													<tr>
														<td>編號 : </td>
														 <td><input name='r_no' type='text' size='6' maxlength='4' value='".$get_view['show_vedio_data']['record_no']."'></td>
													</tr>
													<tr>
														<td>日期 : </td>
														<td><input name='date' type='text' size='14' maxlength='10' value='".$get_view['show_vedio_data']['date']."'>
														(格式：0000-00-00)</td>
													</tr>
													<tr>
														<td valign='top'>內容 : </td>
														<td><input name='title' type='text' size='50' maxlength='40' value='".$get_view['show_vedio_data']['title']."'></td>
													</tr>
													<tr>
														<td valign='top'>細要說明 : </td>															
														</td><td><textarea name='content' cols='50' rows='10'>".$get_view['show_vedio_data']['content']."</textarea></td>
													</tr>
													<tr>
														<td valign='top'>時間 : </td>
														<td><input name='r_time' type='text' size='8' maxlength='6' value='".$get_view['show_vedio_data']['time']."'></td>
													</tr>														
													<tr>
														<td>路徑：</td>
														<td>
														<div class='ctrl_option'>
															<select>
																<option value='d'>D磁碟</option>
																<option value='e'>E磁碟</option>
																<option value='f'>F磁碟</option>
															</select>
														</div>	
														<input name='path' type='text' size='50' maxlength='40' value='" . $path . "'></td>
													</tr>											
													</div>		
													<script>
														$('div.ctrl_option select').val('".$drv."');
													</script>
													<div class='box-content'>
														<tr>
															<td></td>
															<td>
																<input name='no' type='hidden' value='" .  $get_view['no'] . "'>
																<p class='right'><button class='btn btn-primary btn-sm'>送出</button>
																</p>
															</td>
															
														</tr>
													</div>																
												</tbody>
											</div>
										</table>
									</div>
								</div>
							</div>
						</form>
						
						<script>							
							function check()
							{
								if (document.form1.r_no.value == ''){alert('請輸入 編號');return false;}
								if (document.form1.title.value == ''){alert('請輸入 內容');return false;}
								this.form1.submit();
							}
						</script>	
		";
		
		return $edit_vedio;
		
	}	
	
	// 發布 新聞稿
	function _get_add_reported($get_view)
	{	  
		// 組類別
		$category = $this->_get_category('GET');
		$category_option ='';
		foreach($category as $key => $rows)
		{
			
				$category_option.="<option value='".$key."'>".$rows."</option>";					
		}
		
		$add_reported = "
						<div class='box col-md-8'>
							<div class='box-inner'>
								<div class='box-header well' data-original-title=''>
									<h2>".$this->title_name."</h2>
									<div class='box-icon'>
										<a href='#' class='btn btn-minimize btn-round btn-default'>
											<i class='glyphicon glyphicon-chevron-up'></i>
										</a>
									</div>
								</div>
								<div class='box-content'>
									<form method='post' name='add' action='" . $this->index_base_url. "add_reported' onsubmit='return check()'>
										<table class='table table-striped'>												
											<tbody>		
												<center>
													<tbody>
														<tr>
															<td width='10%'>地區別：</td>
															<td width='90%'>
																<select name='location'>
																	<option value='0'>請選擇地區別</option>
																	<option value='1'>洄瀾</option>
																	<option value='2'>東亞</option>
																	<option value='3'>東台</option>
																</select>
															</td>
														</tr>
														<tr>
															<td width='10%'>類別：</td>
															<td width='90%'>
															<select name='category'>
																".$category_option."
															</select>	
															</td>
														</tr>
														<tr>
															<td>標題：</td><td><input name='title1' type='text' size='50' maxlength='50' value=''></td>
														</tr>
														<tr>
															<td>副標題：</td><td><input name='title2' type='text' size='50' maxlength='50' value=''></td>
														</tr>
														<tr>
															<td valign='top'>受訪者：</td>
															<td><input name='interviewee1' type='text' size='50'><br>
															<input name='interviewee2' type='text' size='50'></td>
														</tr>
														<tr>
														<td valign='top'>主播稿：</td><td><textarea name='content1' cols='100' rows='10'></textarea></td>
														</tr>
														<tr>
														  <td valign='top'>新聞稿：</td><td><textarea name='content2' cols='100' rows='10'></textarea></td>																										  
														</tr>	
														<script>
															CKEDITOR.replace( 'content1', {});
															CKEDITOR.replace( 'content2', {});												
														</script>
												    </tbody>											  
												</center>								
											</tbody>
										</table>
											<center><input type='hidden' name='func' value='add'>
											   <p class='right'><button class='btn btn-primary btn-sm'>送出</button>
											</center>										
									</form>	
								</div>
							</div>
						</div>
				<script>
					function check()
					{
						if (document.add.location.value == '0'){alert('請輸入 地區別');return false;}
						if (document.add.category.value == '0'){alert('請選擇 類別');return false;}
						if (document.add.title1.value == ''){alert('請輸入 標題');	return false;}
						<!--if (document.add.content1.value ==''){alert('請輸入 主播稿');return false;}-->
						<!--if (document.add.content2.value ==''){alert('請輸入 新聞稿');return false;}-->
						
						var content1= CKEDITOR.instances.content1.getData();								
						var content2= CKEDITOR.instances.content2.getData();						
						if (content1 ==''){alert('請輸入 主播稿');return false;}
						if (content2 ==''){alert('請輸入 新聞稿');return false;}
						
						this.add.submit();
						
					}					
				</script>
		";
		
		return $add_reported;
		
	}	
	
	// 發布影帶管理
	function _get_add_vedio($get_view)
	{	  
		// 組類別
		/*
		$category = $this->_get_category('GET');
		$category_option ='';
		foreach($category as $key => $rows)
		{
			
				$category_option.="<option value='".$key."'>".$rows."</option>";					
		}
		*/
		
		$add_vedio = "
						<div class='box col-md-8'>
							<div class='box-inner'>
								<div class='box-header well' data-original-title=''>
									<h2>".$this->title_name."</h2>
									<div class='box-icon'>
										<a href='#' class='btn btn-minimize btn-round btn-default'>
											<i class='glyphicon glyphicon-chevron-up'></i>
										</a>
									</div>
								</div>
								<div class='box-content'>						
									<form method='post' name='add' action='" . $this->index_base_url. "add_vedio' onsubmit='return check()'>
										<table class='table table-striped'>
											<tbody>
												<tr>
													<td width='20%'>發布人：</td>
													<td width='80%'>".$get_view['session']['ssnT_Name']."</td>
												</tr>
												<tr>
													<td>編號：</td>
													<td>
													<input name='r_no' type='text' size='6' maxlength='4'>
													</td>
												</tr>
												<tr>
													<td>日期：</td>
													<td><input name='date' type='text' size='14' maxlength='10'>
													(格式：0000-00-00)</td>
												</tr>
												<tr>
													<td>內容：</td><td><input name='title' type='text' size='50' maxlength='40'></td>
												</tr>
												<tr>
													<td valign='top'>細要說明：</td><td><textarea name='content' cols='50' rows='10'></textarea></td>
												</tr>
												<tr>
													<td valign='top'>時間：</td>
													<td><input name='r_time' type='text' size='8' maxlength='6'></td>
												</tr>
												<tr>
												  <td>路徑：</td><td>
													<select name='drv'>
														<option value='d\' selected=''>D磁碟</option>
														<option value='e\'>E磁碟</option>
														<option value='f\'>F磁碟</option>
													</select>
												  <input name='path' type='text' size='45' maxlength='40'></td>
												</tr>
												<tr>
													<td colspan='2' align='center'><hr>
													<input type='hidden' name='opt' value='add'>
												</tr>
										  </tbody>
										</table>
										<center><input type='hidden' name='func' value='add'>
										   <p class='right'><button class='btn btn-primary btn-sm'>送出</button>
										</center>
									</form>																		
								</div>
							</div>
						</div>
						<script>
							function check()
							{
								if (document.add.r_no.value == ''){alert('請輸入 編號');return false;}
								if (document.add.title.value == ''){alert('請輸入 內容');return false;}
								
								this.add.submit();
							}					
						</script>
		";
		
		return $add_vedio;
		
	}	
	
	// 瀏覽一週大事
	function _get_view_week($get_view)
	{	  
		// 組類別
		$t_td ='';
		foreach($get_view['view_week_data'] as $key => $rows)
		{			
			$title = explode("|+|", $rows['title']);
			
			if(!isset($title[1])){$title[1]='';} // fix php notice @20170123 
			
			if($title[1]==''){
				$title = $title[0];
			}else{
				$title = $title[0] . '–' . $title[1];
			}	
			
			$t_td.="<tr>";		
			// 串權限看到的物件	
		    if(preg_match( "/3{1,}/", $get_view['session']['ssnLevel'])){
				$t_td.="<td align='center'><input type='checkbox' name='n".$key."' value='".$rows['no']."'></td>";
			}
			
			$t_td.="<td align='center'><p class='f14p'>".$rows['name']."</p></td>
					<td><p class='f14p'><a href='".$this->index_base_url."show_reported/?no=".$rows['no']."'>".$title."</a></p></td>
					<td><p class='f14p' align='center'>".$rows['username']."</p></td>
					<td><p class='f12p' align='center'>".$rows['datetime']."</p></td>												
			";	
			// 串權限看到的物件
		    if(preg_match( "/3{1,}/", $get_view['session']['ssnLevel']) && $get_view['view']=="1"){
				$t_td.="<td><div align='center'><input name='a".$key."' type='hidden' value='".$rows['no']."'><input name='s".$key."' type='text' size='2' maxlength='2' value='".$rows['sort']."'></div></td>  ";
			}			
			
			$t_td.="</tr>";		
		}
		
		$action ='';
		$sort='';
		$title2='';
		// 串權限看到的物件
		if(preg_match( "/3{1,}/", $get_view['session']['ssnLevel'])){
			if($get_view['view']=="1"){
				$action ="
						<input name='Submit' type='submit' value='刪除' class='btn btn-primary btn-xs'>														　
						<input type='hidden' name='opt' value='del' >				
				";
				$sort = "
						<input name='Submit' type='submit' value='重新排列' class='btn btn-primary btn-xs'>														
						<input type='hidden' name='opt1' value='sort' class='btn btn-primary btn-xs'>		
				";	
				$title2="<th scope='col'><p class='f14p'>排序</p></th>  ";
				
			}else{
				$action ="
						<input name='Submit' type='submit' value='新增' class='btn btn-primary btn-xs'>
						<input type='hidden' name='opt' value='add' class='btn btn-primary btn-xs'>					
				";									
			}
		}
		
		$view_week = "
						<div class='box col-md-8'>
							<div class='box-inner'>
								<div class='box-header well' data-original-title=''>
									<h2>".$this->title_name."</h2>
									<div class='box-icon'>
										<a href='#' class='btn btn-minimize btn-round btn-default'>
											<i class='glyphicon glyphicon-chevron-up'></i>
										</a>
									</div>
								</div>
								<form method='post' name='add' action='" . $this->index_base_url. "view_week'>
									<div class='box-content' id='print_div'>
										<table class='table table-striped'>																							
											<tbody>							
												<center>												
													<tr>
														<th></th>
														<th></th>
														<th></th>	
														<th></th>	
															
														<th>
															<div class='ctrl_option'>
																<select class='form-control' onchange='popJump(this)'>
																	<option value='1' selected>瀏覽已加入　</option>
																	<option value='0'>瀏覽未加入　</option>
																</select>
															</div>
														</th>											
													</tr>
													<tr>
														<th scope='col'><p class='f14p'>選擇</p></th>
														<th scope='col'><p class='f14p'>類別</p></th>
														<th scope='col'><p class='f14p'>標題</p></th>
														<th scope='col'><p class='f14p'>發布人</p></th>
														<th scope='col'><p class='f14p'>發布時間</p></th>
														".$title2."
													</tr>
													".$t_td."												
												</center>										
											</tbody>
										</table>
									</div>
	
										<center>													
											".$action."														
											<input type='button' value='列印本頁' onclick='javascript:DP()' class='btn btn-primary btn-xs'>
											".$sort."		
											<input type='hidden' name='num' value='".$get_view['num']."'>	
											<input type='hidden' name='view' value='".$get_view['view']."'>
										</center>									
								</form>
						</div>
					</div>	
					<script language='javascript'>
						function popJump(selOBJ)
						{
							location.href = '".$this->index_base_url."view_week?view=' + selOBJ.options[selOBJ.selectedIndex].value;
						}
						$('div.ctrl_option select').val('".$get_view['view']."');
								
						$('#n1').change(function() {
							  if(this.checked) {
								  alert(1);
							  }
						});						
					</script>
		";
		
		return $view_week;
		
	}		
	
	// 月報表
	function _get_month_report($get_view)
	{		
		// 上一月
		$month = date("Y-m", mktime(0,0,0, date("m")-1, date("d"), date("Y")));		
		
		// 查詢資料整理
		foreach ($get_view['month_data'] as $key => $rows)
		{
			$username = $rows['username'];
			$category = $rows['category'];
			$load_array[$username][$category]=$rows['SUM'];
		}

		$category = $this->_get_category('GET'); // 取得目前分類
		$Num = count($category); // 計算分類數量
		
		// 小計初始化
		$sub_total = array();
		for($i=1;$i<=$Num;$i++)
		{	
			$sub_total[$i] ='';
		}		
		
		$t_td='';
		$total_count = 0;
		foreach($load_array as $poster => $data)
		{	
			$t_td .= "<tr><td align='center'>".$poster."</td>";			
			$total = 0;
			
			for($i=1;$i<=$Num;$i++)
			{	
				if(isset($data[$i])){
					$t_td .= "<td align='center'>".$data[$i]."</td>";
					$count = $data[$i]; // fix php notice
					$sub_total[$i]+=$data[$i];
				}else{
					$t_td .= "<td align='center'>&nbsp;</td>";
					$count = 0;
				}
				$total += $count;
				$total_count +=$count;
			}
			$t_td .= "<td align='center'>".$total."</td></tr>";
		}
		
		$t_td .= "<tr><td align='center'>小計</td>";
		for($i=1;$i<=$Num;$i++)
		{	
			$t_td .= "<td align='center'>".$sub_total[$i]."</td>"; // 小計
		}			
		
		$t_td .= "<td align='center'>".$total_count."</td></tr>"; // 總計所有數量

		$month_report= "
						<div class='box col-md-8'>
							<div class='box-inner'>
								<div class='box-header well' data-original-title=''>
									<h2>".$this->title_name."</h2>
									<div class='box-icon'>
										<a href='#' class='btn btn-minimize btn-round btn-default'>
										<i class='glyphicon glyphicon-chevron-up'></i>
										</a>
									</div>
								</div>
								<div class='box-content' id='print_div'>
									<table class='table table-striped'>																							
										<tbody>
											
											<center>
												<h1>".$month."月份</h1>
												<table border='2' width='100%'>
													<tbody>
														<tr>
															<td>&nbsp;</td>
															<td align='center'>社會</td>
															<td align='center'>政治</td>
															<td align='center'>生活</td>
															<td align='center'>農業</td>
															<td align='center'>奇聞</td>
															<td align='center'>社團</td>
															<td align='center'>文教</td>
															<td align='center'>環衛</td>
															<td align='center'>無標題</td>
															<td align='center'>總計</td>
														</tr>
													  ".$t_td."
													</tbody>
												</table>
											    <br>																						
											</center>	
										</tbody>			
									</table>
								</div>
								<center>
									<input type='button' class='btn btn-primary btn-lg'  value='列印本頁' onclick='javascript:DP()' >
								</center>									
							</div>
						</div>							
		";
		
		return $month_report;		
	}	
	
	// 影帶管理搜尋
	function _get_search_vedio($get_view)
	{	
		if(!isset($get_view['search_data'])){$get_view['search_data']='';}
		if(!isset($get_view['find'])){$get_view['find']='';}
		if(!isset($get_view['act'])){$get_view['act']='';}
		
		$tr_str = '';
		if($get_view['search_data']!==''){	
		
			$tr_str = "
						<table class='table table-bordered table-striped table-condensed'>
							<thead>
								<tr>
									<th>影帶編號</th>
									<th>內容</th>
									<th>時間</th>
									<th>發布人</th>
								</tr>
							</thead>
							<tbody>					
			";		
			foreach($get_view['search_data'] as $rows)
			{
				$title = explode('|+|', $rows['title']);
				$tr_str .= "			
								<tr>
									<td>" . $rows['record_no'] . "</td>
									<td class='center'><a target='_blank' href='".$this->index_base_url."show_vedio?no=".$rows['no']."'>" . $title[0] . "</a></td>
									<td class='center'>" . $rows['time'] . "</td>							
									<td class='center'>" . $rows['username'] . "</td>
								</tr>	
				";
			}	
			
			$tr_str .="								
						</tbody>
					</table>			
			";
		}	
		
		$search_vedio= "		
							<div class='row'>
								<div class='box col-md-8'>								
									<div class='box-inner'>
										<div class='box-header well' data-original-title=''>
											<h2>".$this->title_name."</h2>

											<div class='box-icon'>
												<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>	
											</div>
										</div>
										
										<div class='box-content'>
											<center>
												<form method='post' name='form1' action='" . $this->index_base_url. "search_vedio' onsubmit='return check()'>
													<table width='auto' align='center'>
														<tbody>
															<tr>
																<td width='30%' align='center'>
																	字串：<input type='text' name='find' value='".$get_view['find']."' placeholder='請搜尋精準字句，降低伺服器負擔'>　
																	<input type='submit' name='Submit' value='送出'><p></p></td>
																	<input type='hidden' name='search' value='search'>
																		
															</tr>
															<script>							
																$('div.ctrl_option select').val('".$get_view['act']."');
															</script>	
														</tbody>
													</table>
												<hr>
												</form>
											</center>										
											<div id='print_div'>	
												
												<div class='box-content'>
													<div id='print_div'>
														" . $tr_str . "
													</div>									
												</div>													
											</div>
										</div>
									</div>		
								</div>
							</div>
							<script>							
								function check()
								{
									if (document.form1.find.value.trim() == ''){	
										alert('請輸入搜尋字串');	
										return false;	
									}
								}															
							</script>								
		";
		

		return $search_vedio;		
	}

	// 新聞稿搜尋
	function _get_search_reported($get_view)
	{	
		if(!isset($get_view['search_data'])){$get_view['search_data']='';}
		if(!isset($get_view['find'])){$get_view['find']='';}
		if(!isset($get_view['act'])){$get_view['act']='';}
		
		$tr_str = '';
		if($get_view['search_data']!==''){	
		
			$tr_str = "
						<table class='table table-bordered table-striped table-condensed'>
							<thead>
								<tr>
									<th>類別</th>
									<th>標題</th>
									<th>發布人</th>
									<th>發布時間</th>
								</tr>
							</thead>
							<tbody>					
			";		
			foreach($get_view['search_data'] as $rows)
			{
				$title = explode('|+|', $rows['title']);
				$tr_str .= "			
								<tr>
									<td>" . $rows['name'] . "</td>
									<td class='center'><a target='_blank' href='".$this->index_base_url."show_reported?no=".$rows['no']."'>" . $title[0] . "</a></td>
									<td class='center'>" . $rows['username'] . "</td>							
									<td class='center'>" . $rows['datetime'] . "</td>
								</tr>	
				";
			}	
			
			$tr_str .="								
						</tbody>
					</table>			
			";
		}	
		
		$search_reported= "		
							<div class='row'>
								<div class='box col-md-8'>								
									<div class='box-inner'>
										<div class='box-header well' data-original-title=''>
											<h2>".$this->title_name."</h2>

											<div class='box-icon'>
												<a href='#' class='btn btn-minimize btn-round btn-default'><i class='glyphicon glyphicon-chevron-up'></i></a>	
											</div>
										</div>
										
										<div class='box-content'>
											<center>
												<form method='post' name='form1' action='" . $this->index_base_url. "search_reported' onsubmit='return check()'>
													<table width='auto' align='center'>
														<tbody>
															<tr>
																<td>
																	<div class='ctrl_option'>
																		搜尋：
																		<select name='act'>
																			<option value='0'>已刪除　</option>
																			<option value='1' selected=''>未報導　</option>
																			<option value='9'>已報導　</option>
																			<option value='all'>全部　</option>
																		</select>	
																	</div>
																</td>																　
															   <!--<input type='checkbox' name='s_title' value='check'>只搜標題</p>-->
																
															</tr>
															<tr>
																<td width='30%' align='center'>
																	字串：<input type='text' name='find' value='".$get_view['find']."' placeholder='請搜尋精準字句，降低伺服器負擔'>　
																	<input type='submit' name='Submit' value='送出'><p></p></td>
																	<input type='hidden' name='search' value='search'>
																		
															</tr>
															<script>							
																$('div.ctrl_option select').val('".$get_view['act']."');
															</script>	
														</tbody>
													</table>
												<hr>
												</form>
											</center>										
											<div id='print_div'>	
												
												<div class='box-content'>
													<div id='print_div'>
														" . $tr_str . "
													</div>									
												</div>													
											</div>
										</div>
									</div>		
								</div>
							</div>
							<script>							
								function check()
								{
									if (document.form1.find.value.trim() == ''){	
										alert('請輸入搜尋字串');	
										return false;	
									}
								}															
							</script>								
		";
		

		return $search_reported;		
	}		
	
	// 尾頁
	function _get_footer($get_view)
	{			
		$get_footer = "
						<footer class='row'>
							<p class='col-md-9 col-sm-9 col-xs-12 copyright'>&copy; <a href='' target='_self'>東亞有線電視</a> 2017</p>
						</footer>
		";
		
		return $get_footer;
		
	}
		
	// title name && path name	
	function _get_title_name($code)
	{		
		$path_conver = array(
						'view_users' => '檢視',
						'month_reports' => '月報表',
						'login' => '登入',
						'change_pwd' => '變更密碼',
						'view_reported' => '瀏覽報導',
						'show_reported' => '瀏覽報導',
						'edit_reported' => '修改報導',
						'month_report' => '月報表',
						'view_vedio' => '瀏覽影帶',
						'add_reported' => '新增報導',
						'search_reported' => '搜尋報導',
						'search_vedio' => '搜尋影帶',
						'view_ae' => '瀏覽主播搞標題 + 內文',
						'view_week' => '瀏覽一周大事',
						'week_ae' => '一周大事之主播搞',
						'show_vedio' => '瀏覽影帶',
						'edit_vedio' => '編輯影帶',
						'add_vedio' => '發布影帶',
					   );
					   
		// 例外處理			   
		$exception = array('view_reported','show_reported','edit_reported');
		
		if(in_array($code, $exception)){
			return $this->path_name;
		}
					   
		return $path_conver[$code];
	}
	
	// 新聞類別，因類別不常新增，從資料庫拉出，避免每次新增都需查詢
	function _get_category($code)
	{	
		$category_conver = array(
						'1' => '社會',
						'2' => '政治',
						'3' => '生活',
						'4' => '農業',
						'5' => '奇聞',
						'6' => '社團',
						'7' => '文教',
						'8' => '環衛',
						'9' => '請選擇',
					   );
					   
		if($code === 'GET'){
			return $category_conver;
		}
		
		return $category_conver[$code];
	}	
	
	// 共用頁面 例外處理
	function _get_path_name($code)
	{	
		$code= (string)$code;
	
		$report_name = array(
						'0' => '瀏覽已刪除',
						'1' => '瀏覽未報導',
						'9' => '瀏覽已報導',
						'' => ''
					   );	
		
		return $report_name[$code];
	}	
}

/* End of file Someclass.php */