<?php

class Db_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function getItem( $catId = false ) {
    if( $catId === false ) {
      $query = $this->db->get( 'products' );
      return $query->result_array();
    } if (is_numeric($catId)) {
        $query = $this->db->get_where('products', array('id' => $catId));
        return $query->row_array();
    } else {
        $this->db->select('p.id, p.name, p.price, p.image, p.description, p.slug, p.catId');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id = p.catId');
        $this->db->where('c.slug = ', $catId);
        $query = $this->db->get();
        return $query->result_array();
    }
  }
  
  public function getPage( $slug = false ) {
    if( $slug === FALSE ) {
        $query = $this->db->get("static_pages");
        return $query->result_array();
    }
    $query = $this->db->get_where('static_pages', array('slug' => $slug));
    return $query->row_array();
  }

  public function updatePage( $id, $description) {
    $data = array('description' => $description);
    $this->db->where('id', $id);
    if( $this->db->update('static_pages', $data) ) return true;
    return false;
  }

  public function getCategory( $slug = false ) {
    $this->db->order_by("name", "ASC"); 
    if( $slug === FALSE ) {
        $query = $this->db->get('category');
        return $query->result_array();
    }
    $query = $this->db->get_where('category', array('slug' => $slug));
    return $query->row_array();
  }
  
  public function userSignIn( $username, $password ) {
    $query = $this->db->get_where('users', array('username' => $username, 'password' => $password) );

    if ( !$query->num_rows() ) {
        return false;
    }
    $query = $query->row();
    if ($query->staff == true) return 1;
    return $query;
  }

  public function createUser( $name, $email, $username, $password, $contact) {
    $data = array(
        'username' => $username,
        'password' => $password,
        'name'  => $name,
        'email' => $email,
        'contactno' => $contact,
        'staff' => STAFFACCOUNT
    );
    if( $this->db->insert('users', $data) ) return true;
    return false;
  }

  public function addProduct( $name, $price, $image, $description, $slug, $caetgory) {
    $data = array('name'        => $name,
                  'price'       => $price,
                  'image'       => $image,
                  'description' => $description,
                  'slug'        => $slug,
                  'catId'       => $caetgory);
    if( $this->db->insert('products', $data) ) return true;
    return false;
  }

  public function addCategory( $category, $slug ) {
    $data = array('name' => $category,
                  'slug' => $slug);
    if( $this->db->insert('category', $data) ) return true;
    return false;
  }

  public function processItemUpdate( $id, $name, $price, $description ) {
    $data = array('name'        => $name,
                  'price'       => $price,
                  'description' => $description);
    $this->db->where('id', $id);
    if( $this->db->update('products', $data) ) return true;
    return false;
  }
  
  public function removeProduct( $id ) {
    $this->db->where('id', $id);
    if( $this->db->delete('products') ) return true;
    return false;
  }

  public function removeCategory( $id ) {
    $this->db->where('id', $id);
    if( $this->db->delete('category') ) return true;
    return false;
  }

  public function addOrder( $userid, $date, $total, $status ) {
    $data = array (
        'date'       => $date,
        'totalamount' => $total,
        'userId'     => $userid,
        'status'     => $status
    );
    if( $this->db->insert('orders', $data) ) return $this->db->insert_id();
    return false;
  }
  
  public function addOrderMeta( $orderId, $pId, $qty, $price) {
    $data = array(
        'orderid'   => $orderId,
        'productid' => $pId,
        'quantity'  => $qty,
        'unitPrice' => $price
    );
    if( $this->db->insert('ordersmeta', $data) ) return true;
    return false;
  }
}

?>