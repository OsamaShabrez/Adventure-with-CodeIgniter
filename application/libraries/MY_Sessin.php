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
class MY_Sessin {
    //put your code here

    public function __construct() {
        parent::__construct();
    }
    
    public function getLoggedIn() {
        return $this->userdata('loggedIn');
    }
    
    public function setLoginStatus( $status ) {
        $this->set_userdata('loggedIn', true);
        if ( $status ) {
            $this->set_userdata('staff', true);
        } else {
            $this->set_userdata('staff', false);
        }
    }
    
    public function logOut() {
        $this->unset_userdata('staff');
        $this->set_userdata('loggedIn', false);
    }
    
    public function setFlashMessage() {
        $this->set_flashdata('item');
    }
    
    public function getFlashMessage( $key ) {
        $this->flashdata( $key );
    }
}

?>
