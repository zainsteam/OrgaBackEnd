<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//include Rest Controller library
require (APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller{

	function __construct($config = 'rest'){
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Headers: Origin, X-Requested-With,Content-Type, Accept, Access-Control-Request-Method");
            header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == "OPTIONS") {
            die();
            }
            parent::__construct();
            $this->load->model('User_register_model');

      }

	public function register_post(){
		$postuserdata = json_decode(file_get_contents("php://input"));
        //print_r($postuserdata);
		//exit;
		$name = $postuserdata->name;
		$email = $postuserdata->email;
		$country = $postuserdata->country;
		$dob = $postuserdata->dob;
		$password = $postuserdata->password;
		$ecn_pass = md5($password);
		
		$userdata = array(
			'name' => $name,
			'email' => $email,
			'country' => $country,
			'dob' => $dob,
			'password' => $ecn_pass
		);

		$check_mail_exists = $this->User_register_model->check_mail_exists($email);

		if($check_mail_exists){

			$response = json_encode("Email already exist.");
		}
		else{
			$register_user = $this->User_register_model->register_user($userdata);
			if($register_user){
				$response = json_encode("Registerd successfully.");
			}
		}

		print_r($response);
		
		//$userdata=json_decode(file_get_contents("php://input"));
		//echo $userdata;
	}
       public function profileupdate_post(){
		$postuserdata = json_decode(file_get_contents("php://input"));
        //print_r($postuserdata);
		//exit;
		$name = $postuserdata->name;
		$email = $postuserdata->email;
		$country = $postuserdata->country;
		$dob = $postuserdata->dob;
		
		
		$userdata = array(
			'name' => $name,
			'email' => $email,
			'country' => $country,
			'dob' => $dob,
			'profile_update_status' =>1
		);

		
			$register_user = $this->User_register_model->profileupdate_user($userdata);
			if($register_user){
				//$response = json_encode("Updated successfully.");

						$authUser = $this->User_register_model->auth_user_profile($email);

							if($authUser == TRUE){
								$userData['status'] = 'success';
								$userData['message'] = 'Updated successfully.';
								$userData['userdetails'] = $authUser[0];
								$response = json_encode($userData);
							}else{
								$userData['status'] = 'failed';
								$userData['message'] = 'Invalid email or Otp.';
								$response = json_encode($userData);
							}
			}
              
		

		print_r($response);
		
		//$userdata=json_decode(file_get_contents("php://input"));
		//echo $userdata;
	}
	
public function reg_post(){
	
	$postuserdata = json_decode(file_get_contents("php://input"));
        //print_r($postuserdata);
		//exit;
		$name = $postuserdata->name;
		$email = $postuserdata->email;
		$country = $postuserdata->country;
		$dob = $postuserdata->dob;
		$password = $postuserdata->password;
		$ecn_pass = md5($password);
		
		$userdata = array(
			'name' => $name,
			'email' => $email,
			'country' => $country,
			'dob' => $dob,
			'password' => $ecn_pass
		);

		$check_mail_exists = $this->User_register_model->check_mail_exists($email);

		if($check_mail_exists){

			$response = json_encode("Email already exist.");
		}
		else{
			$register_user = $this->User_register_model->register_user($userdata);
			if($register_user){
				$response = json_encode("Registerd successfully.");
			}
		}

		print_r($response);
}
public function regotpverify_post(){
	
	$postuserdata = json_decode(file_get_contents("php://input"));
        //print_r($postuserdata);
		//exit;
		$name = $postuserdata->name;
		$email = $postuserdata->email;
		$devicetoken = '';
		$otp = $postuserdata->otp;
		
		$userdata = array(
			'name' => $name,
			'email' => $email
		);

		$check_otp_exists = $this->User_register_model->check_otp_exists($email,$otp);

		if($check_otp_exists){

			
			$register_user = $this->User_register_model->register_user($userdata);
			if($register_user){
				//$response = json_encode("Registerd successfully.");
				/* login*/
				$password='';
				$authUser = $this->User_register_model->auth_user($email, $password,$devicetoken);

				if($authUser == TRUE){
					$userData['status'] = 'success';
					$userData['message'] = 'Registerd successfully.';
					$userData['userdetails'] = $authUser[0];
					$response = json_encode($userData);
				}else{
					$userData['status'] = 'failed';
					$userData['message'] = 'Invalid email or Otp.';
					$response = json_encode($userData);
				}
				
				
				
			}
		}
		else{
			//$response = json_encode("Otp not verified successfully.");
			$userData['status'] = 'failed';
					$userData['message'] = 'Otp not verified successfully.';
					$response = json_encode($userData);
		}

		print_r($response);
}
public function regotp_post(){
	
	$postuserdata = json_decode(file_get_contents("php://input"));
        $email = $postuserdata->email;
        $userdata = array(
		    'email' => $email
		);

		$check_mail_exists = $this->User_register_model->check_mail_exists($email);

		if($check_mail_exists){

			$response = json_encode("Email already exist.");
		}
		else{
			
			$config = Array(        
				 'protocol' => 'smtp',
				 //'smtp_host' => 'ssl://smtp.gmail.com',
				 'smtp_host' => 'mail.tubeaim.com',
				 'smtp_port' => 587,
				 'smtp_user' => 'info@tubeaim.com',
				 'smtp_pass' => 'info@123',
				 
				 'mailtype'  => 'html', 
				 'charset'   => 'utf-8',
				 'wordwrap' => TRUE
				 );
				 $this->load->library('email', $config);
				 $this->email->set_newline("\r\n");
				 
				 $from_email = 'organiceappinfo@gmail.com';
				 $to_email =$email;
				
				 $this->email->from($from_email,'User'); 
				 $this->email->to($to_email);
				 $this->email->subject('Orga-nice user registration otp'); 
                  $six_digit_random_number = mt_rand(100000, 999999);
                     $body='<body>
						  <p>Hi,</p>
                          <br>Please verify your otp:'.$six_digit_random_number.'
                          <br>Thank you for registration with Orga-nice.
                          </br><p>Please Contact Us.</p>
						<br> Take Care</br>
					</body>
					';

              
					
			
				 $this->email->message($body); 
				 $this->email->set_mailtype("html");
				 $this->email->send();
			
			
			
			
			
			
			
			 $user_otp = array(
					'email' => $email,
					'otp' =>$six_digit_random_number 
				);
			$register_otp = $this->User_register_model->register_userotp($user_otp);
			if($register_otp){
				$response = json_encode("Otp successfully sent.");
			}
		}

		print_r($response);
}

public function logotp_post(){
	
	$postuserdata = json_decode(file_get_contents("php://input"));
        $email = $postuserdata->email;
        $userdata = array(
		    'email' => $email
		);

		$check_mail_exists = $this->User_register_model->check_mail_exists($email);

		if($check_mail_exists){

			$config = Array(        
				 'protocol' => 'smtp',
				 //'smtp_host' => 'ssl://smtp.gmail.com',
				 'smtp_host' => 'mail.tubeaim.com',
				 'smtp_port' => 587,
				 'smtp_user' => 'info@tubeaim.com',
				 'smtp_pass' => 'info@123',
				 
				 'mailtype'  => 'html', 
				 'charset'   => 'utf-8',
				 'wordwrap' => TRUE
				 );
				 $this->load->library('email', $config);
				 $this->email->set_newline("\r\n");
				 
				 $from_email = 'organiceappinfo@gmail.com';
				 $to_email =$email;
				
				 $this->email->from($from_email,'User'); 
				 $this->email->to($to_email);
				 $this->email->subject('Orga-nice user login otp'); 
                  $six_digit_random_number = mt_rand(100000, 999999);
                     $body='<body>
						  <p>Hi,</p>
                          <br>Please verify your otp:'.$six_digit_random_number.'
                          <br>Thank you for registration with Orga-nice.
                          </br><p>Please Contact Us.</p>
						<br> Take Care</br>
					</body>
					';

              
					
			
				 $this->email->message($body); 
				 $this->email->set_mailtype("html");
				 $this->email->send();
			$user_otp = array(
					'email' => $email,
					'otp' =>$six_digit_random_number
				);
			$register_otp = $this->User_register_model->register_userotp($user_otp);
			if($register_otp){
				$response = json_encode("Otp successfully sent.");
			}
		}
		else{
			 $response = json_encode("Email-Id Not matched.");
		}

		print_r($response);
}


	public function login_post(){
		// $postlogindata = json_decode(file_get_contents("php://input"));
		// print_r($postlogindata);
		// exit;
		$userData = array();

		$email = $this->post('email');
		//$password =md5($this->post('password'));
		$devicetoken =$this->post('devicetoken');
		$otp =$this->post('otp');
		$password ='';
		
         $check_otp_exists = $this->User_register_model->check_otp_exists($email,$otp);

		if($check_otp_exists){

			
			$authUser = $this->User_register_model->auth_user($email, $password,$devicetoken);

				if($authUser == TRUE){
					$userData['status'] = 'success';
					$userData['message'] = 'You are successfully logged in.';
					$userData['userdetails'] = $authUser[0];
					$response = json_encode($userData);
				}else{
					$userData['status'] = 'failed';
					$userData['message'] = 'Invalid email or Otp.';
					$response = json_encode($userData);
				}
		}
		else{
			$response = json_encode("Otp not verified successfully.");
		}
		
		
		
		print_r($response);
	}

	//add notes
	public function stickynotes_post(){
		$postnotedata = json_decode(file_get_contents("php://input"));
		$user_id = $postnotedata->user_id;
		$notes = $postnotedata->note;
		
		$note_data = array('user_id' => $user_id, 'notes'=> $notes);
		$save_notes = $this->User_register_model->add_notes($note_data);

		if($save_notes == TRUE){
			$userData['status'] = 'success';
			$userData['message'] = 'Your note added successfully.';
			$response = json_encode($userData);
		}else{
			$userData['status'] = 'failed';
			$userData['message'] = 'Unable to add the note.';
			$response = json_encode($userData);
		}
		print_r($response);
	}
	public function stickynotesupdate_post(){
		$postnotedata = json_decode(file_get_contents("php://input"));
		$user_id = $postnotedata->user_id;
		$notes = $postnotedata->note;
		$id = $postnotedata->id;
		//if($id>0)
		//{
		$note_data = array('user_id' => $user_id, 'notes'=> $notes);
		$save_notes = $this->User_register_model->update_notes($note_data,$id);
		$userData['status'] = 'success';
		$userData['message'] = 'Your note updated successfully.';
		$response = json_encode($userData); 
		/* if($save_notes == TRUE){
			$userData['status'] = 'success';
			$userData['message'] = 'Your note updated successfully.';
			$response = json_encode($userData);
		}else{
			$userData['status'] = 'failed';
			$userData['message'] = 'Unable to updated the note.';
			$response = json_encode($userData);
		}

		}
		else
		{
			$userData['status'] = 'failed';
			$userData['message'] = 'Unable to updated the note.';
			$response = json_encode($userData);

		} */
		
		
		print_r($response);
	}

	// get sticky notes
	public function getnotes_post(){
		$userData = array();
		$user_id = $this->post('user_id');
		$all_notes = $this->User_register_model->get_all_notes($user_id);
		if($all_notes == TRUE){
			$userData['status'] = 'success';
			$userData['message'] = 'Lis of all Quick notes are below.';
			$userData['all_notes'] = $all_notes;
			$response = json_encode($userData);
		}else{
			$userData['status'] = 'failed';
			$userData['message'] = 'Unable to fetch Quick notes.';
			$response = json_encode($userData);
		}
		print_r($response);
	}

	public function getnotesbyid_post(){
		$userData = array();
		$user_id = $this->post('user_id');
		$id = $this->post('id');
		$all_notes = $this->User_register_model->get_all_notes_byid($user_id,$id);
		if($all_notes == TRUE){
			$userData['status'] = 'success';
			$userData['message'] = 'Lis of all Quick notes are below.';
			$userData['all_notes'] = $all_notes;
			$response = json_encode($userData);
		}else{
			$userData['status'] = 'failed';
			$userData['message'] = 'Unable to fetch Quick notes.';
			$response = json_encode($userData);
		}
		print_r($response);
	}
	//Add category by users
	public function add_category_post(){
		$categoryData = array();
		$user_id = $this->post('user_id');
		$category_name = $this->post('category_name');

		$category_data = array('user_id' => $user_id, 'category_name'=> $category_name);
		$add_category = $this->User_register_model->add_category($category_data);

		if($add_category == TRUE){
			$categoryData['status'] = 'success';
			$categoryData['message'] = 'Your category added successfully.';
			$response = json_encode($categoryData);
		}else{
			$categoryData['status'] = 'failed';
			$categoryData['message'] = 'Unable to add the category.';
			$response = json_encode($categoryData);
		}
		print_r($response);
	}

	//Get category by user's id
	public function user_category_post(){
		$user_category = [];
		$user_id = $this->post('user_id');
		$get_category = $this->User_register_model->get_user_category($user_id);
		if($get_category == TRUE){
			$user_category['status'] = 'success';
			$user_category['message'] = 'Lis of all categories are below.';
			$user_category['all_category'] = $get_category;
			$response = json_encode($user_category);
		}else{
			$user_category['status'] = 'failed';
			$user_category['message'] = 'Unable to fetch categories.';
			$response = json_encode($user_category);
		}
		print_r($response);
	}

	// add user task
	public function create_task_post(){
		
    	$user_tasks = [];
		$user_id = $this->post('user_id');
		$task_name = $this->post('task_name');
		$task_duration = $this->post('duration');
		$bring_with_you = $this->post('bring_with_you');
		$frequency = $this->post('frequency');
		$if_not_completed = $this->post('if_not_completed');
		$priority = $this->post('priority');
		$category = $this->post('category');
		$color = $this->post('color');
		$sub_tasks = json_encode($this->post('sub_tasks'));
		
		
		$due_date = $this->post('due_date');
		$type = $this->post('type');
		$msg='';
		if($type=='task')
		{
			
			$msg='Your task has been added successfully.';
				if($sub_tasks == null){
						$task_data = array(
						'name' => $task_name,
						'user_id' => $user_id,
						'duration' => $task_duration,
						'bring_with_you' => $bring_with_you,
						'frequency' => $frequency,
						'if_not_completed' => $if_not_completed,
						'priority' => $priority,
						'category' => $category,
						'color' => $color,
						'due_date' => $due_date,
						'type'=>$type
					);
				}else{
				$task_data = array(
						'name' => $task_name,
						'user_id' => $user_id,
						'duration' => $task_duration,
						'bring_with_you' => $bring_with_you,
						'frequency' => $frequency,
						'if_not_completed' => $if_not_completed,
						'priority' => $priority,
						'category' => $category,
						'color' => $color,
						'due_date' => $due_date,
						'sub_tasks' => $sub_tasks,
						'type'=>$type
					);
				}
		}
		if($type=='event')
		{
			$msg='Your event has been added successfully.';
			$reminders = $this->post('reminders');
			$minutes_before = $this->post('minutes_before');
			$repetition = $this->post('repetition');
			
			    $task_data = array(
				'name' => $task_name,
				'user_id' => $user_id,
				'duration' => $task_duration,
				'bring_with_you' => $bring_with_you,
				'frequency' => $frequency,
				'if_not_completed' => $if_not_completed,
				'priority' => $priority,
				'category' => $category,
				'color' => $color,
				'due_date' => $due_date,
				'sub_tasks' => $sub_tasks,
				'type'=>$type,
				'reminders'=>$reminders,
				'minutes_before'=>$minutes_before,
				'repetition'=>$repetition 
			);
			
		}
		

		
		$add_task = $this->User_register_model->add_user_task($task_data);

		if($add_task == TRUE){
			$user_tasks['status'] = 'success';
			$user_tasks['message'] = $msg;
			$response = json_encode($user_tasks);
		}else{
			$user_tasks['status'] = 'failed';
			$user_tasks['message'] = 'Unable to add task.';
			$response = json_encode($user_tasks);
		}
		print_r($response);
	}
	public function filter_task_post(){
		
    	$user_tasks = [];
		$user_id = $this->post('user_id');
		$frequency = $this->post('frequency');
		$priority = $this->post('priority');
		$category = $this->post('category');
		$color = $this->post('color');
		$type = 'task';
		$task_data = array(
						'frequency' => $frequency,
						'priority' => $priority,
						'category' => $category,
						'type'=>$type,
						'color'=>$color
					);
		
		

		
		
        $user_tasks = [];

		     $get_user_tasks = $this->User_register_model->filter_task_post($task_data,$user_id);
        	 
        	 if($get_user_tasks == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Lis of all tasks are below.';
				//$user_task['all_tasks'] = $get_user_tasks;
				 
				foreach($get_user_tasks as $data)
				{
					$frequency=$data->frequency;
					$if_not_completed=$data->if_not_completed;
					
					if($if_not_completed=='nxt_day')
					{
						$data->if_not_completed='Move to Next Day';
					}
					if($if_not_completed=='nxt_week')
					{
						$data->if_not_completed='Move to Next Week';
					}
					
					if($if_not_completed=='nxt_month')
					{
						$data->if_not_completed='Move to Next Month';
					}
					if($if_not_completed=='Delete')
					{
						$data->if_not_completed='Delete';
					}
					
					$frequency=$data->frequency;
					if($frequency=='unassigned')
					{
						$data->frequency='once';
					}
					
				$sub_tasks=$data->sub_tasks;
				$sub_tasks=json_decode($sub_tasks);
				//print_r($data);
				
				$printed='';
				foreach($sub_tasks as $k=>$sub)
				{
					
					$printed[] =$sub->value;
				}
				$data->sub_tasks=$printed;
				//print_r($printed);
					if($frequency=='weekly')
					{
						
						$user_task['all_tasks']['weekly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='daily')
					{
						$user_task['all_tasks']['daily'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='monthly')
					{
						$user_task['all_tasks']['monthly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else
					{
						
						$user_task['all_tasks']['unassigned'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
				}
				
				$response = json_encode($user_task);
			}else{
				$user_task['status'] = 'failed';
				$user_task['all_tasks']['weekly']=array();
				$user_task['all_tasks']['daily']=array();
				$user_task['all_tasks']['monthly']=array();
				$user_task['all_tasks']['unassigned']=array();
				$user_task['message'] = 'Unable to fetch tasks.';
				$response = json_encode($user_task);
			}
        //}
        print_r($response);
	}

		public function update_task_post(){
		
    	$user_tasks = [];
		$id = $this->post('id');
		$user_id = $this->post('user_id');
		$task_name = $this->post('task_name');
		$task_duration = $this->post('duration');
		$bring_with_you = $this->post('bring_with_you');
		$frequency = $this->post('frequency');
		$if_not_completed = $this->post('if_not_completed');
		$priority = $this->post('priority');
		$category = $this->post('category');
		$color = $this->post('color');
		$sub_tasks = json_encode($this->post('sub_tasks'));
		
		
		$due_date = $this->post('due_date');
		$type = $this->post('type');
		$msg='';
		if($type=='task')
		{
			$msg='Your task has been updated successfully.';
			
				if($sub_tasks == null){
						$task_data = array(
						'name' => $task_name,
						'user_id' => $user_id,
						'duration' => $task_duration,
						'bring_with_you' => $bring_with_you,
						'frequency' => $frequency,
						'if_not_completed' => $if_not_completed,
						'priority' => $priority,
						'category' => $category,
						'color' => $color,
						'due_date' => $due_date,
						'type'=>$type
					);
				}else{
				$task_data = array(
						'name' => $task_name,
						'user_id' => $user_id,
						'duration' => $task_duration,
						'bring_with_you' => $bring_with_you,
						'frequency' => $frequency,
						'if_not_completed' => $if_not_completed,
						'priority' => $priority,
						'category' => $category,
						'color' => $color,
						'due_date' => $due_date,
						'sub_tasks' => $sub_tasks,
						'type'=>$type
					);
				}
		}
		if($type=='event')
		{
			$msg='Your task has been updated successfully.';
			$reminders = $this->post('reminders');
			$minutes_before = $this->post('minutes_before');
			$repetition = $this->post('repetition');
			
			    $task_data = array(
				'name' => $task_name,
				'user_id' => $user_id,
				'duration' => $task_duration,
				'bring_with_you' => $bring_with_you,
				'frequency' => $frequency,
				'if_not_completed' => $if_not_completed,
				'priority' => $priority,
				'category' => $category,
				'color' => $color,
				'due_date' => $due_date,
				'sub_tasks' => $sub_tasks,
				'type'=>$type,
				'reminders'=>$reminders,
				'minutes_before'=>$minutes_before,
				'repetition'=>$repetition 
			);
			
		}
		

		
		$add_task = $this->User_register_model->update_user_task($task_data,$id);

		if($add_task == TRUE){
			$user_tasks['status'] = 'success';
			$user_tasks['message'] = $msg;
			$response = json_encode($user_tasks);
		}else{
			$user_tasks['status'] = 'failed';
			$user_tasks['message'] = 'Unable to add task.';
			$response = json_encode($user_tasks);
		}
		print_r($response);
	}

	//get user tasks
	public function get_user_task_post(){
		$user_tasks = [];

		/* $this->form_validation->set_rules('user_id', 'User Id', 'required|numeric|strip_tags');
		if($this->form_validation->run() == FALSE){
            $user_tasks['status'] = 'failed';
			$user_tasks['message'] = validation_errors();
			$response = json_encode($user_tasks);
        }else{ */
        	 $user_id = $this->post('user_id');
        	 $get_user_tasks = $this->User_register_model->get_user_tasks($user_id);
        	 if($get_user_tasks == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Lis of all tasks are below.';
				//$user_task['all_tasks'] = $get_user_tasks;
				 
				foreach($get_user_tasks as $data)
				{
					$frequency=$data->frequency;
					$if_not_completed=$data->if_not_completed;
					
					if($if_not_completed=='nxt_day')
					{
						$data->if_not_completed='Move to Next Day';
					}
					if($if_not_completed=='nxt_week')
					{
						$data->if_not_completed='Move to Next Week';
					}
					
					if($if_not_completed=='nxt_month')
					{
						$data->if_not_completed='Move to Next Month';
					}
					if($if_not_completed=='Delete')
					{
						$data->if_not_completed='Delete';
					}
					
					$frequency=$data->frequency;
					if($frequency=='unassigned')
					{
						$data->frequency='once';
					}
					
				$sub_tasks=$data->sub_tasks;
				$sub_tasks=json_decode($sub_tasks);
				//print_r($data);
				
				$printed=array();
				foreach($sub_tasks as $k=>$sub)
				{
					
					$printed[] =$sub->value;
				}
				$data->sub_tasks=$printed;
				//print_r($printed);
					if($frequency=='weekly')
					{
						
						$user_task['all_tasks']['weekly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='daily')
					{
						$user_task['all_tasks']['daily'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='monthly')
					{
						$user_task['all_tasks']['monthly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else
					{
						
						$user_task['all_tasks']['unassigned'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
				}
				
				$response = json_encode($user_task);
			}else{
				$user_task['status'] = 'failed';
				$user_task['all_tasks']['weekly']=array();
				$user_task['all_tasks']['daily']=array();
				$user_task['all_tasks']['monthly']=array();
				$user_task['all_tasks']['unassigned']=array();
				$user_task['message'] = 'Unable to fetch tasks.';
				$response = json_encode($user_task);
			}
        //}
        print_r($response);
	}
	public function get_user_taskbyid_post(){
		$user_tasks = [];

		/* $this->form_validation->set_rules('user_id', 'User Id', 'required|numeric|strip_tags');
		if($this->form_validation->run() == FALSE){
            $user_tasks['status'] = 'failed';
			$user_tasks['message'] = validation_errors();
			$response = json_encode($user_tasks);
        }else{ */
        	 $user_id = $this->post('user_id');
			 $id = $this->post('id');
        	 $get_user_tasks = $this->User_register_model->get_user_taskbyid($user_id,$id);
        	 if($get_user_tasks == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Lis of all tasks are below.';
				//print_r($get_user_tasks);
				$due_date=$get_user_tasks[0]->due_date;
				$due_date=date("Y-m-d\TH:i:s.000\Z", strtotime($due_date));
				$get_user_tasks[0]->due_date=$due_date;
				
				
				 $sub_tasks=$get_user_tasks[0]->sub_tasks;
				//print_r($sub_tasks[0]);
				$sub_tasks=json_decode($sub_tasks);
				//print_r($sub_tasks);
				$taskarr=array();
				foreach($sub_tasks as $k=>$v)
				
				{
					$taskarr[]=$v->value;
				}
				$get_user_tasks[0]->sub_tasks=$taskarr;
				
				$user_task['all_tasks'] = $get_user_tasks;
				$response = json_encode($user_task);
			}else{
				$user_task['status'] = 'failed';
				$user_task['all_tasks']=array();
				$response = json_encode($user_task);
			}
        //}
        print_r($response);
	}
	public function get_user_task_unassign_post(){
		$user_tasks = [];

		/* $this->form_validation->set_rules('user_id', 'User Id', 'required|numeric|strip_tags');
		if($this->form_validation->run() == FALSE){
            $user_tasks['status'] = 'failed';
			$user_tasks['message'] = validation_errors();
			$response = json_encode($user_tasks);
        }else{ */
        	 $user_id = $this->post('user_id');
        	 $get_user_tasks = $this->User_register_model->get_user_tasks_unassign($user_id);
        	 if($get_user_tasks == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Lis of all tasks are below.';
				//$user_task['all_tasks'] = $get_user_tasks;
				 
				foreach($get_user_tasks as $data)
				{
					$frequency=$data->frequency;
				$sub_tasks=$data->sub_tasks;
				$sub_tasks=json_decode($sub_tasks);
				//print_r($data);
				
				$printed=array();
				foreach($sub_tasks as $k=>$sub)
				{
					
					$printed[] =$sub->value;
				}
				$data->sub_tasks=$printed;
				//print_r($printed);
					if($frequency=='weekly')
					{
						
						$user_task['all_tasks']['weekly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='daily')
					{
						$user_task['all_tasks']['daily'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='monthly')
					{
						$user_task['all_tasks']['monthly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else
					{
						
						$user_task['all_tasks']['unassigned'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
				}
				
				$response = json_encode($user_task);
			}else{
				$user_task['status'] = 'failed';
				$user_task['all_tasks']['weekly']=array();
				$user_task['all_tasks']['daily']=array();
				$user_task['all_tasks']['monthly']=array();
				$user_task['all_tasks']['unassigned']=array();
				$user_task['message'] = 'Unable to fetch tasks.';
				$response = json_encode($user_task);
			}
        //}
        print_r($response);
	}

	public function get_user_todaystask_post(){
		$user_tasks = [];

		/* $this->form_validation->set_rules('user_id', 'User Id', 'required|numeric|strip_tags');
		if($this->form_validation->run() == FALSE){
            $user_tasks['status'] = 'failed';
			$user_tasks['message'] = validation_errors();
			$response = json_encode($user_tasks);
        }else{ */
        	  $user_id = $this->post('user_id'); 
			  $user_task['all_tasks']['weekly']=array();
			  $user_task['all_tasks']['daily']=array();
			    $user_task['all_tasks']['monthly']=array();
			 $user_task['all_tasks']['unassigned']=array();
        	 $get_user_tasks = $this->User_register_model->get_user_todaystask($user_id);
        	 if($get_user_tasks == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Lis of all tasks are below.';
				//$user_task['all_tasks'] = $get_user_tasks;
				//print_r($get_user_tasks);
				
				foreach($get_user_tasks as $dataall)
				{ 
				if(!empty($dataall)){
				foreach($dataall as $data)
				{
					$frequency=$data->frequency;
					$if_not_completed=$data->if_not_completed;
					if($if_not_completed=='nxt_day')
					{
						$data->if_not_completed='Move to Next Day';
					}
					if($if_not_completed=='nxt_week')
					{
						$data->if_not_completed='Move to Next Week';
					}
					
					if($if_not_completed=='nxt_month')
					{
						$data->if_not_completed='Move to Next Month';
					}
					if($if_not_completed=='Delete')
					{
						$data->if_not_completed='Delete';
					}
					$frequency=$data->frequency;
					if($frequency=='unassigned')
					{
						$data->frequency='once';
					}
					
				$sub_tasks=$data->sub_tasks;
				$sub_tasks=json_decode($sub_tasks);
				//print_r($data);
				
				$printed='';
				foreach($sub_tasks as $k=>$sub)
				{
					
					$printed[] =$sub->value;
				}
				$data->sub_tasks=$printed;
				//print_r($printed);
					if($frequency=='weekly')
					{
						
						$user_task['all_tasks']['weekly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='daily')
					{
						$user_task['all_tasks']['daily'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else if($frequency=='monthly')
					{
						$user_task['all_tasks']['monthly'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
					else
					{
						
						$user_task['all_tasks']['unassigned'][]=$data;
						//$user_task['all_tasks']['weekly']['sub_tasks']=$sub;
					}
				}
				}
				else
					
					{
						// $user_task['all_tasks']['weekly']=array();
				// $user_task['all_tasks']['daily']=array();
				// $user_task['all_tasks']['monthly']=array();
				// $user_task['all_tasks']['unassigned']=array();
					}
				}
				//print_r($user_task);
				
				$user_task['time'] = date('Y-m-d');
				$response = json_encode($user_task);
			}else{
				$user_task['time'] = date('Y-m-d');
				$user_task['status'] = 'failed';
				$user_task['all_tasks']['weekly']=array();
				$user_task['all_tasks']['daily']=array();
				$user_task['all_tasks']['monthly']=array();
				$user_task['all_tasks']['unassigned']=array();
				$user_task['message'] = 'Unable to fetch tasks.';
				$response = json_encode($user_task);
			}
        //}
        print_r($response);
	}
	public function update_user_task_post(){
		$user_task = [];
		$user_id = $this->post('user_id');
		$taskdata = $this->post('taskdata');
		
		$start_date = $this->post('start_date');
		$end_date = $this->post('end_date');
		
		 $id=$taskdata['id'];
		 //$start_date=$taskdata['start_date'];
		 //$start_date="Wed Jul 17 2019 07:55:00 GMT+0530 (India Standard Time)";
		 //$old_date_timestamp ='Wed Jul 17 2019 07:55:00 GMT+0530 (India Standard Time)'; //GMT 0530 (India Standard Time) not needed
         //$old_date_timestamp = str_replace('GMT+0530 (India Standard Time)','',$old_date_timestamp);
		  //echo $new_date = date('Y-m-d H:i:s', strtotime($old_date_timestamp));
		 
		 //$start_date=$taskdata['start_date'];
		 $start_date=$start_date;
		 $start_date = str_replace('GMT+0530 (India Standard Time)','',$start_date);
		 $start_date = date('Y-m-d H:i:s', strtotime($start_date));
		 
		 $end_date=$end_date;
		 $end_date = str_replace('GMT+0530 (India Standard Time)','',$end_date);
		 $end_date = date('Y-m-d H:i:s', strtotime($end_date));
		
		$name=$taskdata['text'];
		$date_a = new DateTime($end_date);
		 $date_b = new DateTime($start_date); 

		$interval = date_diff($date_a,$date_b);

		 $duration=$interval->format('%h:%i');
		$result = $this->User_register_model->update_user_tasks($user_id,$id,$start_date,$name,$duration);
		//print_r($result); exit;
		if($result == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Task updated Successfully.';
				$response = json_encode($user_task);
		}
		else
		{
			$user_task['status'] = 'failed';
			//	$user_task['message'] = 'Task not updated Successfully.';
			$user_task['message'] = '';
				$response = json_encode($user_task);
	    }
        
        print_r($response);
		
			/* 		Array
			(
				[id] => 16
				[start_date] => 2019-07-12T18:30:00.000Z
				[end_date] => 2019-07-12T20:00:00.000Z
				[text] => demo
				[_timed] => 1
				[_sday] => 5
				[_eday] => 6
				[_length] => 1
				[_sweek] => 1
				[_sorder] => 0
				[_first_chunk] => 1
				[_last_chunk] => 1
			) */
	}
	
	public function update_user_task_status_post(){
		$user_task = [];
		
		$id = $this->post('id');
		$result = $this->User_register_model->update_user_task_post_status($id);
		
		if($result == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Task updated Successfully.';
				$response = json_encode($user_task);
		}
		else
		{
			$user_task['status'] = 'failed';
			//	$user_task['message'] = 'Task not updated Successfully.';
			$user_task['message'] = '';
				$response = json_encode($user_task);
	    }
        
        print_r($response);
		
			
	}
	public function delete_user_task_post(){
		$user_task = [];
		$user_id = $this->post('user_id');
		$id = $this->post('id');
		
		$result = $this->User_register_model->delete_user_tasks($user_id,$id);
		//print_r($result); exit;
		if($result == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Task Deleted Successfully.';
				$response = json_encode($user_task);
		}
		else
		{
			$user_task['status'] = 'failed';
				//$user_task['message'] = 'Task not Deleted Successfully.';
				$user_task['message'] = '';
				$response = json_encode($user_task);
	    }
        
        print_r($response);
		
	}
	
	public function get_user_task_calender_post(){
		$user_task = [];

		/* $this->form_validation->set_rules('user_id', 'User Id', 'required|numeric|strip_tags');
		if($this->form_validation->run() == FALSE){
            $user_tasks['status'] = 'failed';
			$user_tasks['message'] = validation_errors();
			$response = json_encode($user_tasks);
        }else{ */
        	 $user_id = $this->post('user_id');
			 $type = $this->post('type');
        	 $get_user_tasks = $this->User_register_model->get_user_tasks_calender($user_id,$type);
			 //print_r($get_user_tasks);
        	 if($get_user_tasks == TRUE){
				$user_task['status'] = 'success';
				$user_task['message'] = 'Lis of all tasks are below.';
				//$user_task['all_tasks'] = $get_user_tasks;
				 foreach($get_user_tasks as $data)
				{
					$color=$data->color;
					$type=$data->type;
					if($type=='event')
					{
						$color='orange';
					}
					
					if($color=='')
					{
						$color='purple';
					}
					  $start_date=$data->due_date;
					$duration=$data->duration;
					 if($start_date=='0000-00-00 00:00:00')
					{
					   $start_date1=date('Y-m-d 00:00');
					   $start_date=$start_date1;
					   //$start_date=$start_date1.' 00:00:00';
					    $duration='00:00:00';
					} 
					
					$time    = explode(':', $duration);
                   $minutes_to_add = ($time[0] * 60.0 + $time[1] * 1.0);
					

					$time = new DateTime($start_date);
					$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

					$end_date = $time->format('Y-m-d H:i');
					
					//$date1=date_create($start_date);
					//$date2=date_create($end_date);
					//$diff=date_diff($date1,$date2);
					//echo $diff->format("%R%a");
					//print_r($diff);
					$start_date_1 = new DateTime($start_date);
					$start_date_1 = $start_date_1->format('Y-m-d');
					$end_date_1 = new DateTime($end_date);
					$end_date_1 = $end_date_1->format('Y-m-d');
					
					$start_date_1 = strtotime($start_date_1); // or your date as well
					$end_date_1 = strtotime($end_date_1);
					$datediff =  $end_date_1 -$start_date_1;

					$daydifferent= round($datediff / (60 * 60 * 24));
					//echo "<br>";
                    if($daydifferent>0)
					{
						$time2= explode(':','23:59');
						$start_date1=new DateTime($data->due_date);
						$start_date1 = $start_date1->format('Y-m-d');
						$minutes_to_add2 = ($time2[0] * 60.0 + $time2[1] * 1.0);
					    $time2 = new DateTime($start_date1);
					    $time2->add(new DateInterval('PT' . $minutes_to_add2 . 'M'));
						$end_date1 = $time2->format('Y-m-d H:i');
					
					
					    $time3= explode(':','00:00');
						$start_date2=new DateTime($end_date);
						$start_date2 = $start_date2->format('Y-m-d');
						$minutes_to_add3 = ($time3[0] * 60.0 + $time3[1] * 1.0);
					    $time3 = new DateTime($start_date2);
					    $time3->add(new DateInterval('PT' . $minutes_to_add3 . 'M'));
						$start_date2 = $time3->format('Y-m-d H:i');
					
						$user_task['all_tasks'][]=array("id"=>$data->id,"start_date"=>$start_date2,"end_date"=>$end_date,"text"=>$data->name,"color"=>$color,"textColor"=>"#fff","rec_type"=>"day_1___1,2,3,4,5","event_length"=>"7200");
						$user_task['all_tasks'][]=array("id"=>$data->id,"start_date"=>$data->due_date,"end_date"=>$end_date1,"text"=>$data->name,"color"=>$color,"textColor"=>"#fff","rec_type"=>"day_1___1,2,3,4,5","event_length"=>"7200");
						
					}
					else{
						if($data->due_date=='0000-00-00 00:00:00')
							{
							   $start_date1=date('Y-m-d 00:00');
							   $data->due_date=$start_date1;
							   $end_date=date('Y-m-d 00:00');
							   
							} 
						$user_task['all_tasks'][]=array("id"=>$data->id,'event_pid'=>0,"start_date"=>$data->due_date,"end_date"=>$end_date,"text"=>$data->name,"color"=>$color,"textColor"=>"#fff","rec_type"=>"day_1___","event_length"=>"7200");
					    
						/* for($i=1;$i<=5;$i++)
						{
							$start_date = new DateTime($data->due_date);
							$start_date = $start_date->modify('+1 day')->format('Y-m-d H:i:s');
							$end_date = new DateTime($end_date);
							$end_date = $end_date->modify('+1 day')->format('Y-m-d H:i:s');

							//$start_date=date('Y-m-d H:i:s', strtotime('+1 day', $data->due_date));
							//$end_date=date('Y-m-d H:i:s', strtotime('+1 day', $end_date));
						$user_task['all_tasks'][]=array("id"=>$data->id,'event_pid'=>$data->id,"start_date"=>$start_date,"end_date"=>$end_date,"text"=>$data->name,"color"=>$color,"textColor"=>"#fff","rec_type"=>"day_1___","event_length"=>"7200");
					    } */
					
					}

					//$user_task['all_tasks'][]=array("id"=>$data->id,'event_pid'=>$data->id,"start_date"=>'2019-08-03 10:00:00',"end_date"=>'2019-08-13 00:00:00',"text"=>$data->name,"color"=>$color,"textColor"=>"#fff","rec_type"=>"day_1___","event_length"=>"7200");
				}
				 //$user_task['all_tasks'][]=array("id"=>"52",'event_pid'=>"52","start_date"=>'2019-08-17 19:55:0',"end_date"=>'2019-08-17 22:55:00',"text"=>'ddddddddd',"color"=>'red',"textColor"=>"#fff","rec_type"=>"day_1___","event_length"=>"");
				/* foreach($get_user_tasks as $data)
				{
					$frequency=$data->frequency;
					if($frequency=='weekly')
					{
						$user_task['all_tasks']['weekly'][]=$data;
					}
					else if($frequency=='daily')
					{
						$user_task['all_tasks']['daily'][]=$data;
					}
					else if($frequency=='monthly')
					{
						$user_task['all_tasks']['monthly'][]=$data;
					}
					else
					{
						
						$user_task['all_tasks']['unassigned'][]=$data;
					}
				} */
				
				$response = json_encode($user_task);
			}else{
				$user_task['status'] = 'failed';
				$user_task['message'] = 'Unable to fetch tasks.';
				$response = json_encode($user_task);
			}
        //}
        print_r($response);
	}
	//add user's events
	public function add_event_post(){
		$user_events = [];
		$user_id = $this->post('user_id');
		$event_name = $this->post('event_name');
		$start_date = $this->post('start_date');
		$duration = $this->post('duration');
		$bring_with_you = $this->post('bring_with_you');
		$reminders = $this->post('reminders');
		$minutes_before = $this->post('minutes_before');
		$repetition = $this->post('repetition');

		$event_data = array(
			'user_id' => $user_id,
			'event_name' => $event_name,
			'start_date' => $start_date,
			'duration' => $duration,
			'bring_with_you' => $bring_with_you,
			'reminders' => $reminders,
			'minutes_before' => $minutes_before,
			'repetition' => $repetition,
		);

		$add_event = $this->User_register_model->add_user_event($event_data);

		if($add_event == TRUE){
			$user_events['status'] = 'success';
			$user_events['message'] = 'Your event has been added successfully.';
			$response = json_encode($user_events);
		}else{
			$user_events['status'] = 'failed';
			$user_events['message'] = 'Unable to add event.';
			$response = json_encode($user_events);
		}
		print_r($response);
	}

	//get user's event
	public function get_user_event_post(){
		$user_events = [];
		$user_id = $this->post('user_id');
		$get_user_events = $this->User_register_model->get_user_events($user_id);
    	 if($get_user_events == TRUE){
			$user_events['status'] = 'success';
			$user_events['message'] = 'Lis of all events are below.';
			$user_events['all_tasks'] = $get_user_events;
			$response = json_encode($user_events);
		}else{
			$user_events['status'] = 'failed';
			$user_events['message'] = 'Unable to fetch events.';
			$response = json_encode($user_events);
		}
		print_r($response);
	}

	//App settings
	public function app_settings_post(){
		$app_settings = [];
		$user_id = $this->post('user_id');
		$color = $this->post('color');
		$priority = $this->post('priority');
		$sound_for_reminder = $this->post('sound_for_reminder');
		$due_date = $this->post('due_date');

		$app_setting_data = array(
			'user_id' => $user_id,
			'color' => $color,
			'priority' => $priority,
			'sound_for_reminder' => $sound_for_reminder,
			'due_date' => $due_date,
		);

		$app_setting_update = $this->User_register_model->app_setting_update($user_id, $app_setting_data);

		if($app_setting_update == TRUE){
			$app_settings['status'] = 'success';
			$app_settings['message'] = 'Your app settings has been updated successfully.';
			$response = json_encode($app_settings);
		}else{
			$app_settings['status'] = 'failed';
			$app_settings['message'] = 'Unable to update event settings.';
			$response = json_encode($app_settings);
		}
		print_r($response);
	}

	// get today's to-dos

	public function get_more_todos_post(){
		$todays_todos = [];
		$today_date = date('Y-m-d');
		$user_id = $this->post('user_id');
		$today_todos = $this->User_register_model->today_todos($today_date, $user_id);
		if($today_todos == TRUE){
			$todays_todos['status'] = 'success';
			$todays_todos['message'] = 'Lis of all tasks for today are.';
			$todays_todos['all_tasks'] = $today_todos;
			$response = json_encode($todays_todos);
		}else{
			$todays_todos['status'] = 'failed';
			$todays_todos['message'] = 'You have no tasks for today.';
			$response = json_encode($todays_todos);
		}
		print_r($response);
	}

	//delete notes

	public function delete_note_post(){
		$delete_note = [];
		$note_id = $this->post('id');

		$delete = $this->User_register_model->delete_note($note_id);
		if($delete == TRUE){
			$delete_note['status'] = 'success';
			$delete_note['message'] = 'Your notes has been deleted successfully.';
			$response = json_encode($delete_note);
		}else{
			$delete_note['status'] = 'failed';
			$delete_note['message'] = 'Unable to delete notes.';
			$response = json_encode($delete_note);
		}
		print_r($response);
	}

	//Change password

	public function change_password_post(){
		$password_change = [];
		$user_id = $this->post('user_id');
		$encrypt_old_password = $this->post('encrypt_old_password');
		$entered_old_password = md5($this->post('entered_old_password'));
		$new_password = md5($this->post('new_password'));

		if($encrypt_old_password == $entered_old_password){
			$change_pass = $this->User_register_model->change_password($user_id, $new_password);
			if($change_pass == TRUE){
				$password_change['status'] = 'success';
				$password_change['message'] = 'Your password has been change successfully.';
				$response = json_encode($password_change);
			}else{
				$password_change['status'] = 'failed';
				$password_change['message'] = 'Unable to change password.';
				$response = json_encode($password_change);
			}
		}else{
			$password_change['status'] = 'failed';
			$password_change['message'] = 'Your current password is wrong.';
			$response = json_encode($password_change);
		}
		print_r($response);
	}

	//delete user category
	public function delete_category_post(){
		$delete_cat = [];
		$cat_id = $this->post('cat_id');
		$delete = $this->User_register_model->delete_category($cat_id);
		if($delete == TRUE){
			$delete_cat['status'] = 'success';
			$delete_cat['message'] = 'Your category has been deleted successfully.';
			$response = json_encode($delete_cat);
		}else{
			$delete_cat['status'] = 'failed';
			$delete_cat['message'] = 'Unable to delete category.';
			$response = json_encode($delete_cat);
		}
		print_r($response);
	}

	//password reset
	public function forgot_password_post(){
		$forgot_pass = [];
		$email = $this->post('email');
		$check_user = $this->User_register_model->check_user($email);

		if($check_user == false){
			$forgot_pass['status'] = 'failed';
			$forgot_pass['message'] = 'This email is not registered with Orga-nice.';
			$response = json_encode($forgot_pass);
		}else{
			$six_digit_otp = mt_rand(100000, 999999);

			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$config['newline'] = '\r\n';
			$this->load->library('email');
			$this->email->set_mailtype("html");
			$body = 'Your OTP to reset password is '.$six_digit_otp;
			$this->email->from('info@orga-nice-app.com', 'Orga-nice');

			$this->email->to($email);

			$this->email->subject('Your password reset OTP for Orga-nice App.');

			$this->email->message($body);

			$sendmail=$this->email->send();

			if($sendmail){
				$forgot_pass['status'] = 'success';
				$forgot_pass['message'] = 'Please check your email for OTP.';
				$forgot_pass['otp'] = $six_digit_otp;
				$forgot_pass['user_email'] = $email;
				$response = json_encode($forgot_pass);
			}else{
				$forgot_pass['status'] = 'failed';
				$forgot_pass['message'] = 'Unable to send OTP. Please try after some time.';
				$response = json_encode($forgot_pass);
			}
		}

		print_r($response);
	}
	
	public function dashboard_post(){
		$userData = array();
		$user_id = $this->post('user_id');
		$all = $this->User_register_model->get_dashboard($user_id);
		if($all == TRUE){
			$userData['status'] = 'success';
			$userData['message'] = 'Data featched successfully';
			$userData['dashboard'] = $all;
			$response = json_encode($userData);
		}else{
			$userData['status'] = 'failed';
			$userData['message'] = 'No result found.';
			$response = json_encode($userData);
		}
		print_r($response);
		
	}
}
