<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Samples extends CI_Controller {

	var $data;

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function batch_insert()
	{
		date_default_timezone_set('Asia/Colombo');

		$this->load->model('friends_model');

		$user_id = -1;

		//var_dump($_POST);
		
		//User select
		if(isset($_POST['select_user_id']) && $_POST['select_user_id'])
		{
			$user_id = $_POST['select_user_id'];
			//$this->data['friends'] = $this->friends_model->get($_POST['select_user_id']);
		}elseif(isset($_GET['user_id'])){
			$user_id = $_GET['user_id'];
		}

		//Edit or Insert Friends
		if(isset($_POST['user_id']) && $_POST['user_id']){
			//Prepare Data for insertion
			foreach ($_POST['new'] as $index=>$new_friend) {
				if(strlen($new_friend['name'])>2){
					$friends[$index]['user_id'] 	= $_POST['user_id'];
					$friends[$index]['name'] 		= $new_friend['name'];
					$friends[$index]['email'] 	= $new_friend['email'];
					$friends[$index]['telephone'] = $new_friend['tele'];

					$friends[$index]['status'] 	= 1;
					$friends[$index]['date_created'] = date('Y-m-d H:i:s');
					$friends[$index]['date_modified'] = date('Y-m-d H:i:s');
				}
			}
			//Insert Batch Data
			//var_dump($friends);
			if(isset($friends)){
				$this->friends_model->insert($friends);
			}

			//Prepare data for update
			if(isset($_POST['edit'])){
				foreach ($_POST['edit'] as $index=>$edit_friend) {
					$edit_friends[$index]['id'] 		= $edit_friend['id'];
					$edit_friends[$index]['name'] 		= $edit_friend['name'];
					$edit_friends[$index]['email'] 		= $edit_friend['email'];
					$edit_friends[$index]['telephone'] 	= $edit_friend['tele'];

					// $friends[$index]['status'] 	= 1;
					// $friends[$index]['date_created'] = date('Y-m-d H:i:s');
					$edit_friends[$index]['date_modified'] = date('Y-m-d H:i:s');
				}
				$this->friends_model->update($edit_friends);
				//var_dump($edit_friends);
			}

			//Set user id
			$user_id = $_POST['user_id'];
			
		}

		//Deleting a friend record
		if(isset($_GET['action']) && $_GET['action']=='del')
		{
			$user_id = $_GET['user_id'];
			$this->friends_model->remove($_GET['fid']);
			redirect('samples/batch_insert/?user_id='.$user_id);
		}

		//Set user id
		$this->data['user_id'] = $user_id;
		//Get current friends if exists
		$this->data['friends'] = $this->friends_model->get($user_id);

		$this->load->view('batch_insert_form', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */