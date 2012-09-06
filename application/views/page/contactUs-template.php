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
                <?php echo form_open('page/contact-us'); ?>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Name :</label>
                        <input type="text" maxlength="25" id="name" name="name" value="<?php echo set_value('name'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Email :</label>
                        <input type="text" maxlength="25" id="email" name="email" value="<?php echo set_value('email'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact">Title :</label>
                        <input type="text" maxlength="25" id="title" name="title" value="<?php echo set_value('title'); ?>" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Message :</label>
                        <textarea name="message" id="message" class="contact_textarea"><?php echo set_value('title'); ?></textarea>
                    </div>
                    <div class="form_row">
                            <input type="submit" value="Send!" class="button"><br>
                    </div>
                    <script type="text/javascript"> 
                        var name = new LiveValidation('name', {onlyOnSubmit: true });
                        name.add( Validate.Presence);
                        name.add( Validate.Length, { maximum: 25 } );
                        var email = new LiveValidation('email', {onlyOnSubmit: true });
                        email.add( Validate.Email );
                        email.add( Validate.Presence );
                        var message = new LiveValidation('message', {onlyOnSubmit: true });
                        message.add( Validate.Presence);
                    </script>
                </form>
            </div> 
            <div style="clear:both;"></div>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>