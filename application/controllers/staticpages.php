<?php

class StaticPages extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('db_model');
    $this->load->library('session');
  }

  public function processContactForm() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name',    'Name',    'trim|required|min_length[5]|max_length[70]|xss_clean');
    $this->form_validation->set_rules('email',   'Email',   'required|valid_email');
    $this->form_validation->set_rules('title',   'Title',   'xss_clean');
    $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[5]|max_length[70]|xss_clean');

    if( $this->form_validation->run() === false ) {
        $this->showContactForm();
    } else {
        $this->showContactForm();
    }
  }

  public function showContactForm() {
    $data['title'] = 'Contact Us';

    $this->load->library('form_validation');
    
    $this->load->helper('url');
    $data['categories'] = $this->db_model->get_category();
    $data['loggedin'] = $this->session->getLoggedIn();

    $this->load->view('templates/header', $data);
    $this->load->view('page/contactus-template', $data);
    $this->load->view('templates/footer', $data);
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
