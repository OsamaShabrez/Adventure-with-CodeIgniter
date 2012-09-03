<?php

class Db_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function get_catalog( $pagination = FALSE ) {
    if( $pagination === FALSE ) {
      $query = $this->db->get( 'items' );
      return $query->result_array();
    }
    $query = $this->db->get_where( 'items', $pagination * 2, ($pagination + 1) * 2 );
    $this->db->order_by("id", "desc");
    return $query->result_array();
  }
  
  public function get_page( $slug = false ) {
    $query = $this->db->get_where('static_pages', array('slug' => $slug));
    return $query->row_array();
  }
  
  public function get_category( $slug = false ) {
    if( $slug === FALSE ) {
        $query = $this->db->get('type');
        return $query->result_array();
    }
    $query = $this->db->get_where('type', array('slug' => $slug));
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
}

?>