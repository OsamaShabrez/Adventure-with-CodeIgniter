<?php

class StaticPages extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('db_model');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->library('cart');

    if( $this->session->userdata('loggedIn') === true && $this->session->userdata('staff') === true ) {
        redirect('admin/index');
    }
  }

  private function generatePassword( ) {
    $length=9;
    $alphanumeric = 'aeuyBDGHJLMNPQRSTVWXZAEUY23456789';
    $specialchars = '!^*()@#$%><';
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                    $password .= $specialchars[(rand() % strlen($specialchars))];
                    $alt = 0;
            } else {
                    $password .= $alphanumeric[(rand() % strlen($alphanumeric))];
                    $alt = 1;
            }
    }
    return $password;
  }

  private function processContactForm() {
    $this->load->library('form_validation');
    $this->load->helper('form');

    $this->form_validation->set_rules('name',    'Name',    'trim|required|xss_clean');
    $this->form_validation->set_rules('email',   'Email',   'required|valid_email');
    $this->form_validation->set_rules('title',   'Title',   'xss_clean');
    $this->form_validation->set_rules('message', 'Message', 'required|xss_clean');

    $this->load->helper('url');

    if( $this->form_validation->run() === false ) {
        redirect('/page/contact-us', $this->showContactForm());
    } else {
        $this->load->library('email');

        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to(EMAILRECEIVER);

        if ( ( $subject = $this->input->post('title') ) === "" )
            $subject = 'New feedback from ' . $this->input->post('name');

        $this->email->subject( $subject );
        $this->email->message( $this->input->post('message') );

        $this->email->send();

        $this->session->set_flashdata('message', 'Hi ' . $this->input->post('name') . ', Your query/feedback has been sent successfully');
        redirect( 'page/contact-us' );
    }
  }

  public function showContactForm() {
    $data['title'] = 'Contact Us';

    $this->load->library('form_validation');
    $this->load->helper('form');
    
    $this->load->helper('url');
    $data['categories'] = $this->db_model->getCategory();
    $data['loggedin'] = $this->session->userdata('loggedIn');

    $this->form_validation->set_rules('name',    'Name',    'trim|required|xss_clean');
    $this->form_validation->set_rules('email',   'Email',   'required|valid_email');
    $this->form_validation->set_rules('title',   'Title',   'xss_clean');
    $this->form_validation->set_rules('message', 'Message', 'required|xss_clean');

    if ($this->form_validation->run() === false ) {
        $this->load->view('templates/header', $data);
        $this->load->view('page/contactUs-template', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $this->processContactForm();
    }
  }

  public function processSingup() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name',    'Name',    'trim|required|xss_clean');
    $this->form_validation->set_rules('email',   'Email',   'required|valid_email');
    $this->form_validation->set_rules('username','Username','xss_clean');
    $this->form_validation->set_rules('contact', 'Contact', 'required|xss_clean');

    $this->load->helper('url');
    
    if( $this->form_validation->run() === false ) {
        redirect('/page/sign-up', $this->showContactForm());
    } else {
        $name           = $this->input->post('name');
        $email          = $this->input->post('email');
        $username       = $this->input->post('username');
        $contact        = $this->input->post('contact');
        $password       = $this->generatePassword();
        $hashedpassword = md5( $password . sha1($password) );

        $this->load->library('email');

        $this->email->from(EMAILSENDER, EMAILSENDERNAME);
        $this->email->to($email);
        $subject = 'GreenTel account password information';

        $this->email->subject( $subject );
        $this->email->message("Hi {$name}\r\nYou account details are:\r\nusername: {$username}\r\npassword: {$password}\r\n\r\nThankyou.");

        $this->email->send();
        if( $this->db_model->createUser( $name, $email, $username, $hashedpassword, $contact) ) {
          $this->session->set_flashdata('v_message', 'Please check your email inbox for password details');
          redirect('page/sign-in');
        } else {
          $this->session->set_flashdata('iv_message', 'Something went wrong, please try again');
          redirect('page/sign-up');
        }
    }
  }

  public function signIn() {
    $data['title'] = SIGNIN;

    $this->load->library('form_validation');
    $this->load->helper('form');

    $this->load->helper('url');

    $data['categories'] = $this->db_model->getCategory();
    $data['loggedin']   = $this->session->userdata('loggedIn');

    $this->form_validation->set_rules('username',    'Username',    'trim|required|xss_clean');
    $this->form_validation->set_rules('password',    'Password',    'trim|required|xss_clean');

    if( $this->form_validation->run() === false ) {
        $this->load->view('templates/header', $data);
        $this->load->view('page/signIn-template', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $this->processSignIn();
    }
  }

  private function processSignIn() {
    $this->load->library('form_validation');
    $this->load->helper('form');

    $this->load->helper('url');

    $data['categories'] = $this->db_model->getCategory();
    $data['loggedin']   = $this->session->userdata('loggedIn');

    $this->form_validation->set_rules('username',    'Username',    'trim|required|xss_clean');
    $this->form_validation->set_rules('password',    'Password',    'trim|required|xss_clean');

    if( $this->form_validation->run() === false ) {
        $this->session->set_flashdata('iv_message', 'Invalid Username/Password');
        redirect( 'page/sing-in' );
    } else {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $password = md5( $password . sha1($password) );
        if ( ( $status = $this->db_model->userSignIn($username, $password) ) === false ) {
            $this->session->set_flashdata('iv_message', 'Invalid username/password');
            redirect( 'page/sign-in' );
        } else {
            $this->session->set_userdata('loggedIn', true);
            if( $status === 1) {
                $this->session->set_userdata('staff', true);
                redirect('admin/index');
            } else {
                $this->session->set_userdata('staff', false);
                $this->session->set_userdata('usrid', $status->id);
                redirect(base_url());
            }
        }
    }
  }

  public function signUp() {
    $this->load->helper('form');

    $this->load->helper('url');

    $data['categories'] = $this->db_model->getCategory();
    $data['loggedin']   = $this->session->userdata('loggedIn');
    $data['title'] = SIGNUP;

    $this->load->view('templates/header', $data);
    $this->load->view('page/signUp-template', $data);
    $this->load->view('templates/footer', $data);
  }

  public function signOut() {
    $this->load->helper('url');

    $this->session->unset_userdata('staff');
    $this->session->set_userdata('loggedIn', false);
    $this->session->set_flashdata('v_message', 'Logged out successfully');

    redirect('page/sign-in');
  }

  public function page( $page = false ) {

    if( $page === false ) {
        show_404('staticpages.php -> page(false)');
    }

    $this->load->helper('url');
    $data['categories'] = $this->db_model->getCategory();

    if ( ( $data['content'] = $this->db_model->getPage($page) ) == FALSE ) {
        show_404('staticpages.php -> page($data[content])');
    }

    $data['title'] = ucwords(str_replace( "-", " ", $data['content']['title']) ); // Capitalize the first letter
    $data['loggedin'] = $this->session->userdata('loggedIn');
    $data['description'] = $data['content']['description'];

    $this->load->view('templates/header', $data);
    $this->load->view('page/staticpage-template', $data);
    $this->load->view('templates/footer', $data);
  }
}
?>
