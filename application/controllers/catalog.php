<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

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

  public function addToCart( $id ) {
    $product = $this->db_model->getItem($id);
    foreach ($this->cart->contents() as $items) {
        if( $items['id'] == $product['id'] ) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty'   => $items['qty'] + 1
            );
            $this->cart->update($data);
            $ref = $this->input->server('HTTP_REFERER', TRUE);
            redirect($ref, 'location');
        }
    }
    $data = array(
        'id'      => $product['id'],
        'qty'     => 1,
        'price'   => $product['price'],
        'name'    => $product['name'],
    );
    $this->cart->insert($data); 
    $ref = $this->input->server('HTTP_REFERER', TRUE);
    redirect($ref, 'location');
  }

  public function removeCart( $rowid ) {
    $data = array(
        'rowid' => $rowid,
        'qty'   => 0
    );
    $this->cart->update($data);
    $ref = $this->input->server('HTTP_REFERER', TRUE);
    redirect($ref, 'location');
  }

  public function updateCart() {
    foreach ($this->cart->contents() as $items) {
      $data = array(
        'rowid' => $items['rowid'],
        'qty'   => $this->input->post($items['id'])
      );
      $this->cart->update($data);
    }
    $ref = $this->input->server('HTTP_REFERER', TRUE);
    redirect($ref, 'location');
  }

  public function cart() {
    $this->load->helper('form');

    $data['title'] = 'Shopping Cart Details';
    $data['loggedin'] = $this->session->userdata('loggedIn');
    $data['categories'] = $this->db_model->getCategory();

    $this->load->view('templates/header', $data);
    $this->load->view('cart/viewCart', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view($page = 'index') {
    if ( ! file_exists('application/views/catalog/'.$page.'.php')) {
      // Whoops, we don't have a page for that!
      show_404('view function in catalog.php called');
    }

    $this->load->helper('url');
    $data['categories'] = $this->db_model->getCategory();

    if( $page != 'index' ) {
      $data['title'] = ucwords(str_replace( "-", " ", $page) ); // Capitalize the first letter
    } else {
      $data['title'] = '';
    }

    $data['loggedin'] = $this->session->userdata('loggedIn');

    $data['products'] = $this->db_model->getItem();

    $this->load->view('templates/header', $data);
    $this->load->view('catalog/'.$page, $data);
    $this->load->view('templates/footer', $data);
  }
  
  public function category( $category = false ) {
    if( $category === false ) {
        show_404('category==false function in catalog.php called');
    }

    $this->load->helper('url');

    $data['categories'] = $this->db_model->getCategory();
    $data['products'] = $this->db_model->getItem($category);

    if ( ( $data['content'] = $this->db_model->getCategory($category) ) == FALSE ) {
        show_404('category===content function in catalog.php called');
    }
    $data['title']    = ucwords(str_replace( "-", " ", $data['content']['name']) ); // Capitalize the first letter
    $data['loggedin'] = $this->session->userdata('loggedIn');

    $this->load->view('templates/header', $data);
    $this->load->view('category/showitems', $data);
    $this->load->view('templates/footer', $data);
  }

  public function productDetails( $id ) {
    $this->load->helper('url');

    $data['loggedin'] = $this->session->userdata('loggedIn');
    $data['categories'] = $this->db_model->getCategory();

    $data['product'] = $this->db_model->getItem($id);
    $data['title']    = ucwords(str_replace( "-", " ", $data['product']['name']) ); // Capitalize the first letter

    $this->load->view('templates/header', $data);
    $this->load->view('category/productDeatils-template', $data);
    $this->load->view('templates/footer', $data);
  }
}
?>
