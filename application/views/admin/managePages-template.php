<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="center_content">
<div class="center_title_bar"><?php echo $title; ?></div>
<div style="clear:both;"></div>
<?php if ( $this->session->flashdata('v_message') ) : ?>
    <p class="flashmessage_valid" style="margin:10 auto 0;"><?php echo $this->session->flashdata('v_message'); ?></p>
<?php endif; ?>
<?php if ( $this->session->flashdata('iv_message') ) : ?>
    <p class="flashmessage_invalid" style="margin:10 auto 0;"><?php echo $this->session->flashdata('iv_message'); ?></p>
<?php endif; ?>
<?php foreach ($pages as $page) : ?>
    <div class="prod_box_big" id="page-<?php echo $page['id']; ?>">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
            <p class="toggle" id="btn-<?php echo $page['id'];?>"><strong><?php echo $page['title']; ?></strong> <em>(click to expand)</em></p>
            <div id="<?php echo $page['id'];?>" style="display:none;">
                <?php echo form_open('admin/update-page'); ?>
                <textarea name="description" style="width: 530px;height: 250px;"><?php echo $page['description']; ?></textarea>
                <input type="hidden" name="id" value="<?php echo $page['id']; ?>" />
                <input type="submit" style="color: #A7A4A4;width: 100px;margin: 0 25px;border-radius:25px;float: right;" value="Update" />
                </form>
            </div>
        </div>
        <div class="bottom_prod_box_big"></div>                                
    </div>
    <div style="clear:both;"></div>
<?php endforeach; ?>
<script type="text/javascript">
    $('.toggle').click(function() {
        $('#' + this.id.replace('btn-','')).toggle("slow");
    });
</script>