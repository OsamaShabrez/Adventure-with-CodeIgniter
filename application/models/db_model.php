<?php

class Db_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function getItem( $pagination = FALSE ) {
    if( $pagination === FALSE ) {
      $query = $this->db->get( 'products' );
      return $query->result_array();
    }
    $query = $this->db->get_where( 'products', $pagination * 2, ($pagination + 1) * 2 );
    $this->db->order_by("id", "desc");
    return $query->result_array();
  }
  
  public function getPage( $slug = false ) {
    if( $slug === FALSE ) {
        $query = $this->db->get('static_pages');
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
    return 0;
  }

  public function addProduct( $name, $price, $image, $description, $slug, $caetgory) {
    $data = array('name'        => $name,
                  'price'       => $price,
                  'image'       => $image,
                  'description' => $description,
                  'slug'        => $slug,
                  'type_id'     => $caetgory);
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
}

?>