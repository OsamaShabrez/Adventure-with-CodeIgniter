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
            <?php echo validation_errors('<p class="flashmessage_invalid">','</p>'); ?>
            <?php if ( $this->session->flashdata('v_message') ) : ?>
                <p class="flashmessage_valid"><?php echo $this->session->flashdata('v_message'); ?></p>
            <?php endif; ?>
            <?php if ( $this->session->flashdata('iv_message') ) : ?>
                <p class="flashmessage_invalid"><?php echo $this->session->flashdata('iv_message'); ?></p>
            <?php endif; ?>
                <?php echo form_open('page/sign-in'); ?>
                    <div class="form_row">
                        <label class="contact">Username :</label>
                        <input type="text" maxlength="25" id="username" name="username" value="<?php echo set_value('username'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact">Password :</label>
                        <input type="password" maxlength="25" id="password" name="password" value="" class="contact_input">
                    </div>
                    <div class="form_row">
                            <input type="submit" value="Sign In" class="button"><br>
                    </div>
                    <script type="text/javascript"> 
                        var username = new LiveValidation('username', {onlyOnSubmit: true });
                        username.add( Validate.Presence);
                        username.add( Validate.Length, { maximum: 25 } );
                        var password = new LiveValidation('password', {onlyOnSubmit: true });
                        password.add( Validate.Presence );
                    </script>
                </form>
            </div> 
            <div style="clear:both;"></div>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>