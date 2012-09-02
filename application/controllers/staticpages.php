<?php

class StaticPages extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('db_model');
    $this->load->library('session');
  }

  public function processContactForm() {
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
    echo 'SignIn';
  }

  public function signUp() {
    echo 'SignUp';
  }

  public function signOut() {
    echo 'SignOut';
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
