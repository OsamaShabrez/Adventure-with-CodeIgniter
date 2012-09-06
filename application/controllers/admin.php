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

    $data['title'] = ADMINHOMEPAGE;

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/index-template', $data);
    $this->load->view('admin/admin-footer', $data);
  }
  
  public function managePages() {
    $this->load->helper('url');
    $this->load->helper('form');

    $data['title'] = MANAGEPAGES;
    $data['pages'] = $this->db_model->getPage();

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/managePages-template', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function updatePage() {
    $this->load->helper('url');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
    $this->form_validation->set_rules('id', 'id', 'required|numeric|xss_clean');

    if( $this->form_validation->run() === false ) {
        $this->session->set_flashdata( 'iv_message', 'Input validation failed, try again' );
        redirect('/admin/manage-pages');
    } else {
        $id          = $this->input->post('id');
        $description = $this->input->post('description');
        if( $this->db_model->updatePage( $id, $description ) ) {
            $this->session->set_flashdata( 'v_message', 'Update Successfull' );
        } else {
            $this->session->set_flashdata( 'iv_message', 'Something went wrong, please try again' );
        }
        redirect('/admin/manage-pages');
    }
  }

  public function manageProducts() {
    $this->load->helper('url');
    $this->load->helper('form');

    $data['title']      = MANAGEPRODUCTS;
    $data['products']   = $this->db_model->getProduct();
    $data['categories'] = $this->db_model->getCategory();

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/manageProducts-template');
    $this->load->view('admin/admin-footer', $data);
  }

  public function addNewProduct() {
    $this->load->helper('url');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name',        'Name',        'required|xss_clean');
    $this->form_validation->set_rules('price',       'Price',       'required|numeric|xss_clean');
    $this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
    if( $this->form_validation->run() === false ) {
        $this->session->set_flashdata( 'iv_message', 'Input validation failed, try again' );
        $this->session->set_flashdata( 'add_product', true );
        redirect('/admin/manage-products');
    } else {
        $name = $this->input->post('name');
        $category = $this->input->post('category');
        $price = $this->input->post('price');
        $description = $this->input->post('description');

        $config['upload_path'] = UPLOADPATH;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload()) {
            $this->session->set_flashdata( 'iv_message', strip_tags($this->upload->display_errors()));
            $this->session->set_flashdata( 'add_product', true );
            redirect('/admin/manage-products');
        } else {
            $slug = preg_replace("/[^A-Za-z0-9]/", "-", $name );
            $imagedata = $this->upload->data();
            $image = $imagedata['file_name'];
            if ( $this->db_model->addProduct( $name, $price, $image, $description, $slug, $category ) ) {
                $this->session->set_flashdata( 'v_message', 'Product added successfully' );
            } else {
                $this->session->set_flashdata( 'iv_message', 'Something went wrong, try again' );
                $this->session->set_flashdata( 'add_product', true );
            }
            redirect('/admin/manage-products');
        }
    }
  }

  public function addNewCategory() {
    $this->load->helper('url');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('category', 'Category', 'required|xss_clean');
    if( $this->form_validation->run() === false ) {
        $this->session->set_flashdata( 'iv_message', 'Input validation failed, try again');
        $this->session->set_flashdata( 'add_category', true );
        redirect('/admin/manage-products');
    } else {
        $category = $this->input->post('category');
        $slug = preg_replace("/[^A-Za-z0-9]/", "-", $category );
        if ( $this->db_model->addCategory( $category, $slug ) ) {
            $this->session->set_flashdata( 'v_message', 'Category added successfully' );
        } else {
            $this->session->set_flashdata( 'iv_message', 'Something went wrong, try again' );
            $this->session->set_flashdata( 'add_category', true );
        }
        redirect('/admin/manage-products');
    }      
  }

  public function removeProduct( $id ) {
      if( $this->db_model->removeProduct($id) ) {
        $this->session->set_flashdata( 'v_message', 'Product removed successfully' );
        redirect('/admin/manage-products');
      } else {
        $this->session->set_flashdata( 'iv_message', 'Something went wrong, try again' );
        redirect('/admin/manage-products');
      }
  }

  public function removeCategory( $id ) {
      if( $this->db_model->removeCategory($id) ) {
        $this->session->set_flashdata( 'v_message', 'Category removed successfully' );
        redirect('/admin/manage-products');
      } else {
        $this->session->set_flashdata( 'iv_message', 'Something went wrong, try again' );
        redirect('/admin/manage-products');
      }
  }

  public function processProductUpdate() {
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->helper('form');

    $this->form_validation->set_rules('name',        'Name',        'required|xss_clean');
    $this->form_validation->set_rules('price',       'Price',       'required|numeric|xss_clean');
    $this->form_validation->set_rules('description', 'Description', 'required|xss_clean');

    if( $this->form_validation->run() === false ) {
        $this->session->set_flashdata( 'iv_message', 'Input validation failed, try again' );
        redirect('/admin/manage-products');
    } else {
        $id          = $this->input->post('id');
        $name        = $this->input->post('name');
        $price       = $this->input->post('price');
        $description = $this->input->post('description');
        if( $this->db_model->processItemUpdate( $id, $name, $price, $description ) ) {
            $this->session->set_flashdata( 'v_message', 'Update Successfull' );
            redirect('/admin/manage-products');
        } else {
            $this->session->set_flashdata( 'iv_message', 'Something went wrong, please try again' );
            redirect('/admin/manage-products');
        }
    }
  }

  public function manageOrders() {
    $this->load->helper('url');

    $data['title']  = MANAGEORDERS;
    $data['orders'] = $this->db_model->getOrder();
    foreach( $data['orders'] as &$order ) {
        $userinfo = $this->db_model->getUserInfo($order['userId']);
        $order['username'] = $userinfo['name'];
        $order['details'] = $this->db_model->getOrder($order['id']);
        foreach($order['details'] as &$product) {
            $productdetails = $this->db_model->getProduct($product['productid']);
            $product['productname'] = $productdetails['name'];
        }
    }
    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/manageOrders-template', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function processOrder( $id ) {
    $this->db_model->processOrder( $id );
    $this->session->set_flashdata('v_message', 'Order processed successfully');
    redirect('admin/manage-orders');
  }
  public function profile() {
    $this->load->helper('url');

    $data['title'] = MYACCOUNT;
    $data['user']  = $this->db_model->getUserInfo($this->session->userdata('usrid'));

    $this->load->view('admin/admin-header', $data);
    $this->load->view('admin/myAccount-template', $data);
    $this->load->view('admin/admin-footer', $data);
  }

  public function signOut() {
    $this->load->helper('url');

    $this->session->unset_userdata('staff');
    $this->session->unset_userdata('usrid');
    $this->session->set_userdata('loggedIn', false);
    $this->session->set_flashdata('v_message', 'Logged out successfully');

    redirect('page/sign-in');
  }

  public function display($array) {
     $newline = "<br>";
     $output="";
     foreach($array as $key => $value) {
        if (is_array($value) || is_object($value)) {
            $value = "Array()" . $newline . "(<ul>" . $this->display($value) . "</ul>)" . $newline;
        }
        $output .= "[$key] => " . $value . $newline;
     }
     return $output;
    }
}
?>
