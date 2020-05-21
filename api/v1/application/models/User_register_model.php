<?php

defined('BASEPATH') OR exit('No direct script access allowed');



	Class User_register_model extends CI_Model {

		

		public function __construct()

        {

            // Call the CI_Model constructor

            parent::__construct();

        }



        // Check if mail exist or not

		public function check_mail_exists($email){

			$query = $this->db->get_where('users',array('email'=>$email));

			if ($query->num_rows() > 0){

				return true;

			} 

			else {

				return false;

			}

		}
		public function check_otp_exists($email,$otp){

			$query = $this->db->get_where('otp',array('email'=>$email,'otp'=>$otp));

			if ($query->num_rows() > 0){

				return true;

			} 

			else {

				return false;

			}

		}



		//Register user



		public function register_user($userdata){

			$regitration_success=$this->db->insert('users',$userdata);

			if($regitration_success){

				return true;

			}else{

				return false;

			}

		}
        public function profileupdate_user($userdata){

            $this->db->where('email',$userdata['email']);
		    $this->db->update('users',$userdata);
			return true;


		}

        public function register_userotp($user_otp){

			$regitration_success=$this->db->insert('otp',$user_otp);

			if($regitration_success){

				return true;

			}else{

				return false;

			}

		}



		//user login

		public function auth_user($email, $password,$devicetoken){

			//$condition =array('email'=>$email,'password'=>$password);
			$condition =array('email'=>$email);
			$this->db->select('*')->from('users')->where($condition)->limit(1);

			$query = $this->db->get();

			if ($query->num_rows() == 1)

				{
					$data=$query->result();
					$user_id=$data[0]->id;
				    
					$this->db->where('id',$user_id);
					$this->db->update('users',array("devicetoken"=>$devicetoken));
					
					
					/* $condition =array('email'=>$email,'password'=>$password);
					$this->db->select('*')->from('users')->where($condition)->limit(1);
                    $query = $this->db->get(); */
					return $query->result();

			}

			else{

				return false;

			}

		}
	public function auth_user_profile($email){

			//$condition =array('email'=>$email,'password'=>$password);
			$condition =array('email'=>$email);
			$this->db->select('*')->from('users')->where($condition)->limit(1);

			$query = $this->db->get();

			if ($query->num_rows() == 1)

				{
					return $query->result();

			}

			else{

				return false;

			}

		}



		//sticky notes

		public function add_notes($note_data){

			$notes_add = $this->db->insert('quicknotes',$note_data);



			if($notes_add){

				return true;

			}else{

				return false;

			}

		}
        
		//sticky notes

		public function update_notes($note_data,$id){

			
            $this->db->where('id',$id);
            $this->db->update('quicknotes', $note_data);
			
			if ($this->db->affected_rows() > 0){

				return true;

			}else{

				return false;

			}

		}


		//get stickey notes by user Id

		public function get_dashboard($user_id){
				
			
			$date = new DateTime("now");
			$curr_date = $date->format('Y-m-d');
			$curr_date_y_m = $date->format('Y-m');	
				
			$this->db->select('*')->where('user_id', $user_id)->like('due_date', $curr_date_y_m);

			$q = $this->db->get('tasks');

            $result=array();
			if ($q->num_rows() > 0)

				{

				$total=$q->num_rows();
				$this->db->select('*')->where('user_id', $user_id)->where('status', 0)->like('due_date', $curr_date_y_m);;
				$q = $this->db->get('tasks');
				$notcompleted=$q->num_rows();
				
				$this->db->select('*')->where('user_id', $user_id)->where('status',1)->like('due_date', $curr_date_y_m);;
				$q = $this->db->get('tasks');
				$completed=$q->num_rows();
				$result['total']=$total;
				$result['completed']=$completed;
				$result['notcompleted']=$notcompleted;
				
				$percent=($completed/$total)*100;
				$result['percent']=$percent;
				
				return $result;

			}

			else{

				return false;

			}

		}
		public function get_all_notes($user_id){

			$this->db->select('*')->where('user_id', $user_id)->order_by('created_at','desc');

			$q = $this->db->get('quicknotes');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

		}
		
		public function get_all_notes_byid($user_id,$id){

			$this->db->select('*')->where('user_id', $user_id)->where('id', $id)->order_by('created_at','desc');

			$q = $this->db->get('quicknotes');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

		}



		//Add task category by user

		public function add_category($category_data){

			$category_add = $this->db->insert('categories',$category_data);



			if($category_add){

				return true;

			}else{

				return false;

			}

		}



		//get category by user id

		public function get_user_category($user_id){

			$this->db->select('*')->where('user_id', $user_id)->order_by('created_at','desc');

			$q = $this->db->get('categories');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

		}





		//add user task

		public function add_user_task($task_data){

			$add_task = $this->db->insert('tasks', $task_data);

			if($add_task){

				return true;

			}else{

				return false;

			}

		}
		public function update_user_task($task_data,$id){
            
			$this->db->where("id",$id);
			$add_task = $this->db->update('tasks', $task_data);

			if($add_task){

				return true;

			}else{

				return false;

			}

		}



		// get user tasks

		public function get_user_taskbyid($user_id,$id){

			/* $this->db->select('*')->where('user_id', $user_id)->where('type','task')->where('status','0')->where('due_date!=','0000-00-00 00:00:00'); */
			$this->db->select('*')->where('user_id', $user_id)->where('type','task')->where('status','0')->where('id',$id);

			$q = $this->db->get('tasks');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

			

		}
		public function get_user_tasks($user_id){

			/* $this->db->select('*')->where('user_id', $user_id)->where('type','task')->where('status','0')->where('due_date!=','0000-00-00 00:00:00'); */
			$this->db->select('*')->where('user_id', $user_id)->where('type','task')->where('status','0');

			$q = $this->db->get('tasks');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

			

		}
		public function filter_task_post($task_data,$user_id){

		     $task_data=array_diff($task_data, array(''));
			/* $this->db->select('*')->where('user_id', $user_id)->where('type','task')->where('status','0')->where('due_date!=','0000-00-00 00:00:00'); */
			$this->db->select('*')->where('user_id', $user_id)->where('status','0')->where($task_data);

			$q = $this->db->get('tasks');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

			

		}
		public function get_user_tasks_unassign($user_id){

			$this->db->select('*')->where('user_id', $user_id)->where('type','task')->where('status','0')->where('due_date=','0000-00-00 00:00:00');

			$q = $this->db->get('tasks');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

			

		}
		
		public function get_user_todaystask($user_id){

		    //date_default_timezone_set("America/New_York");
			//date_default_timezone_set("Asia/Kolkata");
		     $today_date = date('Y-m-d');
			
			$result=array();
			$sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND `due_date` LIKE '%".$today_date."%' and frequency='unassigned'";
			$q =  $this->db->query($sql);
            $result[]=$q->result();

			 
			  /* $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND `due_date` >=NOW() and frequency='daily' ";
			  $q =  $this->db->query($sql);
              $data=$q->result();
			
			  $result[]=$q->result(); */
			 
			 $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND `due_date` >=NOW() and frequency='daily' ";
			  $q =  $this->db->query($sql);
              $data=$q->result();
			
			  $result[]=$q->result();
			 
			 /*  $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND (`due_date` >=NOW() AND `due_date`  < NOW() + INTERVAL 7 DAY ) and frequency='weekly' ";
			 $q =  $this->db->query($sql);
             $data=$q->result();
			 $result[]=$q->result(); */
			 
			  $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND `due_date` LIKE '%".$today_date."%' and frequency='weekly' ";
			 $q =  $this->db->query($sql);
             $data=$q->result();
			 $result[]=$q->result();
			 
			 
			 /* $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND (`due_date` >=NOW() AND `due_date`  < NOW() + INTERVAL 30 DAY ) and frequency='monthly' ";
			 $q =  $this->db->query($sql);
             $data=$q->result();
			 $result[]=$q->result(); */
			 
			 $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND `due_date` LIKE '%".$today_date."%' and frequency='monthly' ";
			 $q =  $this->db->query($sql);
             $data=$q->result();
			 $result[]=$q->result();
			 
			 
			//$tasks_result = $task_query->result();
            // print_r($result);

			//if ($q->num_rows() > 0)
            if (!empty($result))
				{

				//return $q->result();
				return $result;

			}

			else{

				return false;

			}

			

		}
		
		public function get_user_todaystaskold($user_id){

		     $today_date = date('Y-m-d');
			
			$result=array();
			$sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND `created_at` LIKE '%".$today_date."%' and frequency='unassigned'";
			$q =  $this->db->query($sql);
            $result[]=$q->result();

			 
			 // $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND `due_date` >=NOW() and frequency='daily' ";
			 // $q =  $this->db->query($sql);
             // $data=$q->result();
			
			 // $result[]=$q->result();
			 
			 
			 $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id."  and frequency='daily'";
			 $q =  $this->db->query($sql);
             $data=$q->result();
			
			 $result[]=$q->result();
			 
			 
			  $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND (`due_date` >=NOW() AND `due_date`  < NOW() + INTERVAL 7 DAY ) and frequency='weekly' ";
			 $q =  $this->db->query($sql);
             $data=$q->result();
			 $result[]=$q->result();
			 
			 $sql="SELECT * FROM `tasks` WHERE `user_id` = ".$user_id." AND (`due_date` >=NOW() AND `due_date`  < NOW() + INTERVAL 30 DAY ) and frequency='monthly' ";
			 $q =  $this->db->query($sql);
             $data=$q->result();
			 $result[]=$q->result();
			 
			 
			//$tasks_result = $task_query->result();
            // print_r($result);

			//if ($q->num_rows() > 0)
            if (!empty($result))
				{

				//return $q->result();
				return $result;

			}

			else{

				return false;

			}

			

		}

		public function update_user_tasks($user_id,$id,$start_date,$name,$duration){

		    $data=array("name"=>$name,"duration"=>$duration,"due_date"=>$start_date);
			
		    $this->db->where('id',$id);
            //$this->db->where('user_id',$user_id);
			$this->db->update('tasks', $data);
			//echo $this->db->affected_rows();
			//return true;
			if ($this->db->affected_rows() > 0) {

				return TRUE;

			}

			else{

				return FALSE;

			} 
		}
		public function update_user_task_post_status($id){

		    $data=array("status"=>1);
			
		    $this->db->where('id',$id);
            $this->db->update('tasks', $data);
			if ($this->db->affected_rows() > 0) {

				return TRUE;

			}

			else{

				return FALSE;

			} 
		}
		
		public function delete_user_tasks($user_id,$id){

		    $this->db->where('id', $id);
			$this->db->delete('tasks');
			if ($this->db->affected_rows() > 0) { 
			return TRUE;
			}
			else{
               return FALSE;
			} 
		}
		// get user tasks calender

		public function get_user_tasks_calender($user_id,$type){

			/* //$this->db->select('*')->where('user_id', $user_id)->where('frequency', $type);
            $this->db->select('*')->where('user_id', $user_id)->where('status','0')->where('due_date!=','0000-00-00 00:00:00'); */
			
			$this->db->select('*')->where('user_id', $user_id)->where('status','0');
			$q = $this->db->get('tasks');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

			

		}


		//add user event

		public function add_user_event($event_data){

			$event_success=$this->db->insert('events',$event_data);

			if($event_success){

				return true;

			}else{

				return false;

			}

		}



		// get user tasks

		public function get_user_events($user_id){

			$this->db->select('*')->where('user_id', $user_id);

			$q = $this->db->get('events');

			if ($q->num_rows() > 0)

				{

				return $q->result();

			}

			else{

				return false;

			}

			

		}



		//update app settings

		public function app_setting_update($user_id, $app_setting_data){

			$query = $this->db->get_where('app_settings',array('user_id'=>$user_id));

			if ($query->num_rows() > 0){

				$this->db->where('user_id', $user_id);

				$this->db->update('app_settings', $app_setting_data);

				return true;

			} 

			else {

				$app_settings=$this->db->insert('app_settings',$app_setting_data);

				return true;

			}

			return false;

		}



		//get today todos



		public function today_todos($today_date, $user_id){

			$task_query =  $this->db->query("SELECT * FROM tasks WHERE DATE(created_at) = $today_date && user_id = $user_id");

			$tasks_result = $task_query->result();

			// $condition =array('user_id'=>$user_id,'created_at'=>DATE($today_date));

			// $this->db->select('*')->from('tasks')->where($condition);

			//$query = $this->db->get();

			if ($tasks_result != '')

				{

				return $tasks_result;

			}

			else{

				return false;

			}

		}





		//delete note

		public function delete_note($note_id){

			$this->db->where('id', $note_id);

			$this->db->delete('quicknotes');

			

			if ($this->db->affected_rows() > 0) {

				return true;

			}

			else{

				return false;

			}

		}



		//change password

		public function change_password($user_id, $new_password){

			$this->db->set('password',$new_password);

			$this->db->where('id', $user_id);

			$this->db->update('users');

			if ($this->db->affected_rows() > 0) {

				return true;

			}

			else{

				return false;

			}



		}



		//delete user category



		public function delete_category($cat_id){

			$this->db->where('id', $cat_id);

			$this->db->delete('categories');

			

			if ($this->db->affected_rows() > 0) {

				return true;

			}

			else{

				return false;

			}

		}

		//check if user exsist
		public function check_user($email){
			$query = $this->db->get_where('users',array('email'=>$email));
			if ($query->num_rows() > 0){
				return true;
			} 
			else {
				return false;
			}
		}

    }

