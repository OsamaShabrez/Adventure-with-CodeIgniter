<?php

class StaticPages extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('db_model');
    $this->load->library('session');
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
        $this->email->to('someone@example.com');

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
    $data['categories'] = $this->db_model->get_category();
    $data['loggedin'] = $this->session->getLoggedIn();

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

    $data['categories'] = $this->db_model->get_category();
    $data['loggedin']   = $this->session->getLoggedIn();

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

    $data['categories'] = $this->db_model->get_category();
    $data['loggedin']   = $this->session->getLoggedIn();

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
            if( $status === 1) {
                $this->session->setLoginStatus( true );
                redirect('admin/index');
            } else {
                $this->session->setLoginStatus( false );
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

    $this->session->logOut();
    $this->session->set_flashdata('v_message', 'Logged out successfully');

    redirect('page/sign-in');
  }

  public function page( $page = false ) {

    if( $page === false ) {
        show_404('staticpages.php -> page(false)');
    }

    $this->load->helper('url');
    $data['categories'] = $this->db_model->get_category();

    if ( ( $data['content'] = $this->db_model->get_page($page) ) == FALSE ) {
        show_404('staticpages.php -> page($data[content])');
    }

    $data['title'] = ucwords(str_replace( "-", " ", $data['content']['title']) ); // Capitalize the first letter
    $data['loggedin'] = false;
    $data['description'] = $data['content']['description'];

    $this->load->view('templates/header', $data);
    $this->load->view('page/staticpage-template', $data);
    $this->load->view('templates/footer', $data);
  }
}
?>
