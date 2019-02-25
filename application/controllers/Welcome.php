<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	var $index_base_url = '';
	
    function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
		$this->load->library('session');
		$this->load->model('main_model');
		$this->load->library('view_lib');
		$this->load->helper('url');
		$this->index_base_url = base_url() . 'welcome/';
    }
    	
	/**
	 * 首頁
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/index
	 */	
	public function index()
	{		
		$this->_check_login();
		
		$get_view['session'] = $this->_get_session();
		
		if(isset($_GET['person'])){			
			($_GET['person'] == $get_view['session']['ssnUserNo'])?$person = $_GET['person']:$person = '';						
		}else{
			$person = '';
		}
		
		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js'] = $get_view['intro'] = $get_view['footer']= '';		
		
		$get_view['user_login_list']='';
		// 權限檢查
		if(preg_match( "/0{1,}/", $get_view['session']['ssnLevel'])){		
			$get_view['user_login_list'] = $this->main_model->get_user_login($person);
		// 個人登入資訊	
		}else if ($person !=''){
			$get_view['user_login_list'] = $this->main_model->get_user_login($person);
		}
		
		// 組views
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/index.php',$data);
	}
	
	/**
	 * 檢視使用者
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/view_users
	 */	
	public function view_users()
	{
		$this->_check_login();
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();
		
		// 權限檢查
		if(!preg_match( "/0{1,}/", $get_view['session']['ssnLevel'])){
			exit;
		}
		
		$get_view['users_list'] = $this->main_model->get_users_list();

		$get_view['style'] = $get_view['top'] = $get_view['nav'] = $get_view['menu'] = $get_view['js'] = $get_view['users'] = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/index.php',$data);
	}

	/**
	 * 登入
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/login
	 */	
	public function login()
	{		
		$this->_return_index();
		$get_view['path'] = $this->router->fetch_method();
		if(isset($_POST['Username']))
		{	
			$data['account'] = $_POST['Username'];
			$data['passwd'] = $_POST['password'];	
	
			$data['ip'] = $this->input->ip_address();
			
			$login_data = $this->main_model->check_user($data);
			if($login_data['status']){
				$newdata = array(
								   'ssnUserNo'  => $login_data['user_id'],
								   'ssnUserName'     => $login_data['t_name'],								   
								   'ssnT_Name' => $login_data['username'],
								   'ssnLevel' => $login_data['level'],
								   'ssnLoginID' => $login_data['logid']
							   );

				$this->session->set_userdata($newdata);
				$this->_return_index();
			}else{
			}			
		}
		
		$this->load->helper('url');
		$this->load->library('view_lib');
		$get_view['session'] = $this->_get_session();
		
		$get_view['style'] = $get_view['top']  = $get_view['js'] = $get_view['login'] = '';
		
		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/index.php',$data);
				
	}
	
	/**
	 * 發布已刪除、未報導、已報導
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/add_reported
	 */
	public function add_reported()
	{
		$this->_check_login();		
		$get_view['session'] = $this->_get_session();

		$get_view['path'] = $this->router->fetch_method();	
		if(!isset($_POST['func'])){$_POST['func']='';}
	
		// add_reported submit
		if($_POST['func']=='add')
		{
			if ( !empty($_POST['title1']) || !empty($_POST['title2']) )
				$data['title'] = $_POST['title1'] . '|+|' . $_POST['title2'];
				
			if ( !empty($_POST['interviewee1']) || !empty($_POST['interviewee2']) )
				$data['interviewee'] = $_POST['interviewee1'] . '|+|' . $_POST['interviewee2'];

			if ( !empty($_POST['content1']) || !empty($_POST['content2']) )
				$data['content'] = $_POST['content1'] . '|+|' . $_POST['content2'];	

			$data['location']= $_POST['location'];
			$data['category']=$_POST['category'];
			$data['now'] = date ("Y-m-d H:i:s");
			$data['poster'] = $get_view['session']['ssnUserNo'];
			
			if(empty($data['interviewee'])){$data['interviewee']='';};
			
			// 新增內容
			$no = $this->main_model->add_reported($data);
		
			$url= $this->index_base_url."show_reported?no=" . (string)$no;
			header("Location:$url" );			
		}
		

		$get_view['style'] = $get_view['top' ]= $get_view['nav'] = $get_view['menu'] = $get_view['js'] = $get_view['add_reported'] = $get_view['footer']= '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		$this->load->view('template/sky/normal.php',$data);
	}
	
	/**
	 * 瀏覽已刪除、未報導、已報導
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/view_reported
	 */
	public function view_reported()
	{
		$show_num = 20; // 每頁顯示筆數	
		
		$this->_check_login();		
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();
		// 已刪除 0 , 未報導 1 , 已報導 9
		(isset($_GET['act'])) ? $act = $_GET['act'] : $act = '';		

		$query_data['act'] = $act;
		
		(isset($_GET['page'])) ? $now_Page = $_GET['page']: $now_Page = 0 ;
		
		// 選擇公司別
		if(isset($_GET['CompanySelect'])){
			$query_data['CompanySelect'] = $_GET['CompanySelect']; 
		}else{
			$query_data['CompanySelect'] = ''; 
		}
		
		// 重新排序
		if(isset($_GET['opt']) && $_GET['opt'] == 'sort'){
			$this->main_model->update_report_sort($_GET);	
		}
		
		// 選擇查詢日期
		if(isset($_GET['datepicker'])){ 
			$query_data['datepicker'] = $_GET['datepicker']; 
		}else{
			$query_data['datepicker'] = ''; 
		}
		
		$reported_count = $this->main_model->get_reported_count($query_data);			
		
		$record_begin = $now_Page * $show_num;	// 本頁之起始指標
		
		$PageTotal = ceil($reported_count/$show_num); // 計算總頁數		
		
		$query_data['record_begin'] = $record_begin;
		$query_data['show_num'] = $show_num;		

		$get_view['reported_list'] = $this->main_model->get_reported($query_data);
		$get_view['now_page'] = $now_Page;
		$get_view['act'] = $act;
		$get_view['page_total'] = $PageTotal;
		$get_view['rows_count'] = count($get_view['reported_list']);		

		$get_view['style'] = $get_view['top' ]= $get_view['nav'] = $get_view['menu'] = $get_view['js'] = $get_view['view_reported'] = $get_view['footer']= '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$data['datepicker'] = $query_data['datepicker'] ;		
		$data['CompanySelect'] = $query_data['CompanySelect'] ;

		$this->load->view('template/sky/reported.php',$data);
	}
	
	/**
	 * 已刪除、未報導、已報導  查看詳細內容
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/show_reported
	 */	
	public function show_reported()
	{
		(isset($_GET['no'])) ? $no = $_GET['no'] : $no = '';
		$this->_check_login();		
		
		$get_view = $this->main_model->get_show_reported($no);
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();		
		$get_view['no'] = $no;

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js'] = $get_view['show_reported'] = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/normal.php',$data);
	}
	/**
	 * 已刪除、未報導、已報導  編輯頁面
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/edit_reported
	 */		
	public function edit_reported()
	{		
		(isset($_GET['no'])) ? $no = $_GET['no'] : $no = '';
		$this->_check_login();
		
		
		$get_view = $this->main_model->get_show_reported($no);
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();
		$get_view['no'] = $_GET['no'];

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js'] = $get_view['edit_reported'] = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/normal.php',$data);		
	}
	
	/**
	 * 搜尋已刪除、未報導、已報導
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/search_reported
	 */
	public function search_reported()
	{
		
		$this->_check_login();		
		$get_view['session'] = $this->_get_session();

		$get_view['path'] = $this->router->fetch_method();	
		if(!isset($_POST['search'])){$_POST['search']='';}
		
		// search_reported submit
		if($_POST['search']!=='')
		{
			if(trim($_POST['find']=='')){echo "<script>history.back()</script>";}
				
			$get_view['act']= $_POST['act'];
			$get_view['find']=$_POST['find'];
			// 搜尋內容
			$get_view['search_data'] = $this->main_model->search_reported($get_view);
		}

		$get_view['style'] = $get_view['top' ]= $get_view['nav'] = $get_view['menu'] = $get_view['js'] = $get_view['search_reported'] = $get_view['footer']= '';	

		// 組view
		$data = $this->view_lib->get_view($get_view);
		$this->load->view('template/sky/normal.php',$data);
	}	
	
/**
	 * 發布影帶
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/add_vedio
	 */
	public function add_vedio()
	{
		$this->_check_login();		
		$get_view['session'] = $this->_get_session();

		$get_view['path'] = $this->router->fetch_method();	
		if(!isset($_POST['opt'])){$_POST['opt']='';}

		// add_reported submit
		if($_POST['opt']=='add')
		{
			$get_view['r_no']= $_POST['r_no'];
			$get_view['date']=$_POST['date'];
			$get_view['title'] = $_POST['title'];
			$get_view['content'] = $_POST['content'];
			$get_view['r_time'] = $_POST['r_time'];
			
			$get_view['r_path'] = trim($_POST['path']);
			if(!empty($get_view['r_path'])){
				$get_view['r_path'] = $_POST['drv'] . $get_view['r_path'];
			}			
			
			// 新增內容
			$no = $this->main_model->add_vedio($get_view);
		
			$url= $this->index_base_url."view_vedio?act=1";
			header("Location:$url" );			
		}


		$get_view['style'] = $get_view['top' ]= $get_view['nav'] = $get_view['menu'] = $get_view['js'] = $get_view['add_vedio'] = $get_view['footer']= '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		$this->load->view('template/sky/normal.php',$data);
	}	
	
	/**
	 * 搜尋影帶管理
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/search_vedio
	 */
	public function search_vedio()
	{
		
		$this->_check_login();		
		$get_view['session'] = $this->_get_session();

		$get_view['path'] = $this->router->fetch_method();	
		if(!isset($_POST['find'])){$_POST['find']='';}
		
		// search_reported submit
		if($_POST['find']!=='')
		{
			if(trim($_POST['find']=='')){echo "<script>history.back()</script>";}
				
			$get_view['find']=$_POST['find'];
			// 搜尋內容
			$get_view['search_data'] = $this->main_model->search_vedio($get_view);
		}

		$get_view['style'] = $get_view['top' ]= $get_view['nav'] = $get_view['menu'] = $get_view['js'] = $get_view['search_vedio'] = $get_view['footer']= '';	

		// 組view
		$data = $this->view_lib->get_view($get_view);
		$this->load->view('template/sky/normal.php',$data);
	}	
	
	/**
	 * 已刪除、未報導、已報導  送出修改內容
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/modify_reported
	 */		
	public function modify_reported()
	{		
		if($_POST['content2']=='' || $_POST['content1']=='' || $_POST['title1']=='' || $_POST['category']=='')
		{
			echo "<script>history.back()</script>";
		}
		
		$data['no'] = $_POST['no'];
		$data['category'] = $_POST['category'];
		$data['title1'] = $_POST['title1'];
		$data['title2'] = $_POST['title2'];
		$data['content1'] = $_POST['content1'];
		$data['content2'] = $_POST['content2'];
		$data['interviewee1'] = $_POST['interviewee1'];
		$data['interviewee2'] = $_POST['interviewee2'];
		
		// 修改內容
		$this->main_model->modify_reported($data);
	
		$url= $this->index_base_url."show_reported?no=" . (string) $data['no'];
		header("Location:$url" );		
	}
	
	/**
	 * 影帶管理  查看詳細內容
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/show_vedio
	 */	
	public function show_vedio()
	{
		(isset($_GET['no'])) ? $no = $_GET['no'] : $no = '';
		(isset($_GET['act'])) ? $act = $_GET['act'] : $act = '';	
		$this->_check_login();		

		$get_view['show_vedio_data'] = $this->main_model->get_show_vedio($no);

		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();		
		$get_view['no'] = $no;
		$get_view['act'] = $act;

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js'] = $get_view['show_vedio'] = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/normal.php',$data);
	}		
	/**
	 * 影帶管理  編輯頁面
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/edit_vedio
	 */		
	public function edit_vedio()
	{		
		(isset($_GET['no'])) ? $no = $_GET['no'] : $no = '';
		$this->_check_login();
		
		
		$get_view['show_vedio_data'] = $this->main_model->get_show_vedio($no);
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();
		$get_view['no'] = $_GET['no'];

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js'] = $get_view['edit_vedio'] = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/reported.php',$data);		
	}	
	
	/**
	 * 影帶管理  修改頁面
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/modify_vedio
	 */		
	public function modify_vedio()
	{		
		if($_POST['r_no']=='' || $_POST['title']=='')
		{
			echo "<script>history.back()</script>";
		}
		
		$data['no'] = $_POST['no'];
		$data['r_no'] = $_POST['r_no'];
		$data['title'] = $_POST['title'];
		$data['date'] = $_POST['date'];
		$data['title'] = $_POST['title'];
		$data['content'] = $_POST['content'];
		$data['time'] = $_POST['r_time'];
		$data['path'] = $_POST['path'];

		// 修改內容
		$this->main_model->modify_vedio($data);
	
		$url= $this->index_base_url."show_vedio?no=" . (string) $data['no'];
		header("Location:$url" );		
	}
	
	/**
	 * 瀏覽主播搞 + 內文
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/view_ae
	 */	
	public function view_ae()
	{		
		$this->_check_login();		
		
		$get_view['ae_data'] = $this->main_model->get_view_ae();
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js']  = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		$data['ae_data'] = $get_view['ae_data'];
		$data['now_date'] = strftime("%Y-%m-%d %H:%M:%S");
		
		$this->load->view('template/sky/ae.php',$data);
	}
	
	/**
	 * 一周大事之主播搞
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/week_ae
	 */	
	public function week_ae()
	{		
		$this->_check_login();		
		
		$get_view['week_ae_data'] = $this->main_model->get_week_ae();
		
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js']  = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		$data['week_ae_data'] = $get_view['week_ae_data'];
		
		$this->load->view('template/sky/week_ae.php',$data);
	}
		
	
	/**
	 * 月報表
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/month_report
	 */		
	public function month_report()
	{		
		$this->_check_login();		
		
		$get_view['month_data'] = $this->main_model->get_month_report();
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js'] = $get_view['month_report'] = $get_view['footer'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/normal.php',$data);		
	}
	
	/**
	 * 瀏覽一周大事
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/view_week
	 */
	public function view_week()
	{
		// submit form
		if(isset($_POST['Submit'])){
			
			if($_POST['Submit']== '重新排列'){
				$this->main_model->update_week_sort($_POST);
				
				$url= $this->index_base_url."view_week/?view=".$_POST['view']."";		
				header("Location:$url" );
			}else if($_POST['Submit']=='新增'){ 							
				$this->main_model->update_week_add($_POST);
				
				$url= $this->index_base_url."view_week/?view=1";		
				header("Location:$url" );
			}else if($_POST['Submit']=='刪除'){ 
				$this->main_model->update_week_del($_POST);
				
				$url= $this->index_base_url."view_week/?view=0";		
				header("Location:$url" );
			}
		}
		
		$this->_check_login();		
		(isset($_GET['view'])) ? $get_view['view'] = $_GET['view'] : $get_view['view'] = '';
		
		$get_view['view_week_data'] = $this->main_model->get_view_week($get_view['view']);
		$get_view['num'] = count($get_view['view_week_data']);
	
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();

		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js']  = $get_view['footer'] = $get_view['view_week'] = '';

		// 組view
		$data = $this->view_lib->get_view($get_view);
		
		$this->load->view('template/sky/normal.php',$data);		
	}		
	
	/**
	 * 瀏覽影影帶
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/view_vedio
	 */
	public function view_vedio()
	{
		$this->_check_login();		
		$get_view['session'] = $this->_get_session();
		$get_view['path'] = $this->router->fetch_method();		
		
		(isset($_GET['act'])) ? $act = $_GET['act'] : $act = '';	
		
		$get_view['vedio_data'] = $this->main_model->get_veiw_vedio($act);		
		$get_view['act'] = $act;		

		$get_view['style'] = $get_view['top' ]= $get_view['nav'] = $get_view['menu'] = $get_view['js'] = $get_view['view_vedio'] = $get_view['footer']= '';

		// 組view
		$data = $this->view_lib->get_view($get_view);	
		$this->load->view('template/sky/normal.php',$data);
	}	
	
	/**
	 * 登出
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/logout
	 */		
	public function logout()
	{		
		$array_items = array('ssnUserNo', 
							 'ssnUserName', 
							 'ssnT_Name', 
							 'ssnLevel', 
							 'ssnLoginID'
							);
						 
		$this->session->unset_userdata($array_items);
		
		$this->_check_login();
	}
	
	/**
	 * 更改密碼
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/change_pwd
	 */			
	public function change_pwd()
	{	

		if(isset($_POST['password']))
		{	
			$change_data = array( 'password' => $_POST['password'],
								  'no' => $_POST['no']		
								);
			$this->main_model->change_pwd($change_data);
			$url= $this->index_base_url."view_users";
			header("Location:$url" );			
		}
		
		if(isset($_GET['no']))
		{	
			$get_view['no'] = $_GET['no'];
		}
		
		$get_view['session'] = $this->_get_session();
		
		$get_view['path'] = $this->router->fetch_method();
		$get_view['style'] = $get_view['top'] = $get_view['menu'] = $get_view['js'] = $get_view['change_pwd'] = $get_view['footer'] = '';
		
		// 組view
		$data = $this->view_lib->get_view($get_view);		
		$this->load->view('template/sky/index.php',$data);
	}
	
	/**
	 * 刪除 or 還原 報導資料
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/d_or_undo
	 */			
	public function d_or_undo()
	{			
		if(isset($_GET['no']))
		{	
			$get_view['no'] = $_GET['no'];
			$get_view['act'] = $_GET['act'];
			$this->main_model->delete_undo($get_view);	
		}		
		
		echo "<script>history.back()</script>";		
	}
	
	/**
	 * 刪除 影帶管理
	 *
	 * @author      Easonwei
	 * @link        http://localhost/welcome/d_vedio
	 */			
	public function d_vedio()
	{			
		$get_view['act'] ='';
		if(isset($_GET['no']))
		{	
			$get_view['no'] = $_GET['no'];
			$get_view['act'] = $_GET['act'];
			$this->main_model->delete_vedio($get_view);	
		}
		
		if($get_view['act'] == 0){
			$url= $this->index_base_url."view_vedio/?act=0";
		}else{
			$url= $this->index_base_url."view_vedio/?act=1";
		}
		
		header("Location:$url" );
		return false;
	}		
	
	/**
	 * 權限檢查
	 *
	 * @author      Easonwei
	 * @link        
	 */		
	public function _check_login()
	{		
		$_session = $this->session->all_userdata();
		if(!isset($_session['ssnUserNo'])){
			$url= $this->index_base_url."login";
			header("Location:$url" );
			return false;
		}
		return true; 
	}
	
	/**
	 * 返回首頁
	 *
	 * @author      Easonwei
	 * @link       
	 */
	public function _return_index()
	{		
		$_session = $this->session->all_userdata();
		if(isset($_session['ssnUserNo']))
		{
			$url= base_url();
			header("Location:$url" );
		}
		return; 
	}
	
	/**
	 * 取得 SESSION
	 *
	 * @author      Easonwei
	 * @link       
	 */
	public function _get_session()
	{		
		$_session = $this->session->all_userdata();
		return $_session; 
	}	
}