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

    $data['title'] = 'Status Check';
    
    $data['status'] = array(
        'Orders Status'
    );

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/status-template', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function manageProducts() {
    $this->load->helper('url');

    $data['title'] = 'Manage Products';

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function manageStock() {
    $this->load->helper('url');

    $data['title'] = 'Manage Stock';

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function manageOrders() {
    $this->load->helper('url');

    $data['title'] = 'Manage Orders';

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function profile() {
    $this->load->helper('url');

    $data['title'] = 'Edit Profile';

    $this->load->view('admin/admin-header', $data);
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
