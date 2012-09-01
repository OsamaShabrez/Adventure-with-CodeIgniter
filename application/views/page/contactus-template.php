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
                <?php echo form_open('page/processcontactform'); ?>
                    <div class="form_row">
                        <label style="text-align: center; width: inherit;"></label>
                        <label class="contact"><strong><span>*</span></strong>Name :</label>
                        <input type="text" maxlength="25" value="" name="names" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Email :</label>
                        <input type="text" maxlength="25" name="email" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact">Title :</label>
                        <input type="text" maxlength="25" name="email" class="contact_input">
                    </div>
                    <div class="form_row">
                        <label class="contact"><strong><span>*</span></strong>Message :</label>
                        <textarea name="message" class="contact_textarea"></textarea>
                    </div>
                    <div class="form_row">
                            <input type="submit" value="Send!" class="button"><br>
                    </div>      
                </form>
                <p id="error"><?php echo validation_errors(); ?></p>
            </div> 
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>