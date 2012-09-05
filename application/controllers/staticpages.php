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
        $this->email->to('contact@osamashabrez.com');

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
        $this->load->view('page/contactus-template', $data);
        $this->load->view('templates/footer', $data);
    } else {
        $this->processContactForm();
    }
  }

  public function signIn() {
    $data['title'] = 'Sign In';

    $this->load->library('form_validation');
    $this->load->helper('form');

    $this->load->helper('url');

    $data['categories'] = $this->db_model->getCategory();
    $data['loggedin']   = $this->session->userdata('loggedIn');

    $this->form_validation->set_rules('username',    'Username',    'trim|required|xss_clean');
    $this->form_validation->set_rules('password',    'Password',    'trim|required|xss_clean');

    if( $this->form_validation->run() === false ) {
        $this->load->view('templates/header', $data);
        $this->load->view('page/signin-template', $data);
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
                redirect('');
            }
        }
    }
  }

  public function signUp() {
    echo 'SignUp';
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
