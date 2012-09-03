<?php
class Admin extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('db_model');
    $this->load->library('session');
    $this->load->helper('url');

    if( $this->session->userdata('loggedIn') === false || $this->session->userdata('staff') === false ) {
        redirect();
    }
  }

  public function index() {
    $this->load->helper('url');

    $data['title'] = 'Admin Panel';

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/index-template', $data);
    $this->load->view('admin/admin-footer', $data);
  }
  
  public function checkStatus() {
    $this->load->helper('url');

    $data['title'] = 'Admin Panel';

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/index-template', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function lognOut() {
    $this->load->helper('url');

    $this->session->unset_userdata('staff');
    $this->session->set_userdata('loggedIn', false);
    $this->session->set_flashdata('v_message', 'Logged out successfully');

    redirect('page/sign-in');
  }
}
?>
