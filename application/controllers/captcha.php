<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Controller {

	public $errors;
	public $messages;

	public function index()
	{
		$this->load->helper('captcha');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');


		if(isset($_POST) && isset($_POST['fname'])){
			
			//Form Validation
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('fname', 'Name', 'required');
			$this->form_validation->set_rules('captcha', 'Human Validation Code', 'required|matches[cword]');
			$this->form_validation->set_rules('cword', 'Number in the image', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				//$this->errors[] = "Validation Fail";
			}
			else
			{
				$this->messages[] = "Validation Success.";
			}

		}

		//Generate Random Number for captcha
		$rand_numer = rand(1000, 9999);

		//Initiate Captcha
		$vals = array(
			'word' => $rand_numer,
		    'img_path'	=> FCPATH.'/images/captcha/',
		    'img_url'	=> base_url().'/images/captcha/',
		    // 'font_path'	=> './path/to/fonts/texb.ttf',
		    'img_width'	=> 150,
		    'img_height' => 30,
		    'expiration' => 7200
	    );

		//Generate Captcha
		$cap = create_captcha($vals);

		
		$this->data['captcha_image'] = $cap['image'];
		$this->data['captcha_word'] = $cap['word'];
		$this->data['errors'] = $this->errors;
		$this->data['messages'] = $this->messages;
		

		$this->load->view('captcha_form', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */