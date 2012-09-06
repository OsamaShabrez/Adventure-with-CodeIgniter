<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="center_content">
    <div class="center_title_bar"><?php echo $title; ?></div>
    <div class="prod_box_big">
        <div class="top_prod_box_big">
        </div>
        <div class="center_prod_box_big">
            <div class="contact_form">
            <?php echo validation_errors('<p class="flashmessage_invalid">','</p'); ?>
            <?php if ( $this->session->flashdata('message') ) : ?>
                <p class="flashmessage_valid"><?php echo $this->session->flashdata('message'); ?></p>
            <?php endif; ?>
                <?php echo form_open('page/process-singup'); ?>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Name :</label>
                        <input type="text" maxlength="25" id="name" name="name" value="<?php echo set_value('name'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Email :</label>
                        <input type="text" maxlength="25" id="email" name="email" value="<?php echo set_value('email'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Username :</label>
                        <input type="text" maxlength="25" id="username" name="username" value="<?php echo set_value('title'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Cell No :</label>
                        <input type="text" maxlength="25" id="contact" name="contact" value="<?php echo set_value('title'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                            <input type="submit" value="Send!" class="button"><br>
                    </div>
                    <script type="text/javascript"> 
                        var name     = new LiveValidation('name');
                        name.add( Validate.Presence);
                        name.add( Validate.Length, { maximum: 100 } );
                        var email    = new LiveValidation('email');
                        email.add( Validate.Email );
                        email.add( Validate.Presence );
                        var username = new LiveValidation('username');
                        username.add( Validate.Presence);
                        var contact  = new LiveValidation('contact');
                        contact.add( Validate.Presence );
                    </script>
                </form>
            </div> 
            <div style="clear:both;"></div>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>