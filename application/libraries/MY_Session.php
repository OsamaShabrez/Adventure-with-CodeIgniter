<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserWrapper
 *
 * @author lordosama
 */
class MY_Session extends CI_Session {
    //put your code here

    public function __construct() {
        parent::__construct();
        parent::set_userdata('1','2');
        $this->set_userdata('loggedIn', false);
    }
    
    public function getLoggedIn() {
        return $this->userdata('loggedIn');
    }
    
    public function setFlashMessage() {
        $this->set_flashdata('item');
    }
    
    public function getFlashMessage( $key ) {
        $this->flashdata( $key );
    }
}

?>
