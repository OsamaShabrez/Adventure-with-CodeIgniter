<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="center_content">
<div class="center_title_bar">
    <?php echo $title; ?>
    <div style="float:right;padding: 4px;">
        <input type="button" class="toggle" id="btn-new-product" style="border-radius: 15px;color: #A7A4A4;" value="<?php echo ADDNEWSITE; ?>" />
    </div>
</div>
<div style="clear:both;"></div>
<?php echo validation_errors('<p class="flashmessage_invalid">','</p'); ?>
<?php if ( $this->session->flashdata('v_message') ) : ?>
    <p class="flashmessage_valid" style="margin:10 auto 0;"><?php echo $this->session->flashdata('v_message'); ?></p>
<?php endif; ?>
<?php if ( $this->session->flashdata('iv_message') ) : ?>
    <p class="flashmessage_invalid" style="margin:10 auto 0;"><?php echo $this->session->flashdata('iv_message'); ?></p>
<?php endif; ?>

    <div class="prod_box_big" id="new-product" <?php if( !$this->session->flashdata('add_product')): ?>style="display:none;" <?php endif; ?>>
    <div class="top_prod_box_big"></div>
    <div class="center_prod_box_big" style="text-align: right;">
        <?php echo form_open_multipart('admin/process-new-product'); ?>
            Product Name: <input type="text" id="new-product-name" name="name" style="width:300px;margin:0 25px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;" />
            <div style="clear:both;"></div>
            Product Category: 
            <select id="new-product-category" name="category" style="width:300px;margin:0 25px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
            </select>
            <div style="clear:both;"></div>
            Product Price: <input type="number" id="new-product-price" name="price" style="width:300px;margin:0 25px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;" />
            <div style="clear:both;"></div>
            Product Description: <textarea id="new-product-description" name="description" style="width:300px;height:150px;margin:0 25px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;"></textarea>
            <div style="clear:both;"></div>
            Product Image: <input type="file" name="userfile" size="5" style="width:300px;margin:0 25px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;" />
            <div style="clear:both;"></div><br/>
            <input type="submit" style="color: #A7A4A4;width: 100px;margin: 0 25px;border-radius:25px;" value="Save" />
        </form>
    </div>
    <div class="bottom_prod_box_big"></div>                                
</div>
<div style="clear:both;"></div>

<?php foreach ($products as $product) : ?>
    <div style="background: #eeeeee;width: 250px;margin:5px 5px 5px 20px;padding: 5px; border-radius: 5px;float:left;">
        <strong style="line-height: 2;"><?php echo $product['name']; ?></strong>
        <input type="button" class="toggle" id="btn-<?php echo $product['slug'].'-'.$product['id']; ?>"style="float:right;color: #A7A4A4;border-radius: 15px;" value="<?php echo EDITPRODUCT; ?>" />
        <div id="<?php echo $product['slug'].'-'.$product['id']; ?>" style="display: none;">
            <?php echo form_open('admin/process-update'); ?>
                <div style="clear:both;"></div>
                <p style="float: left;line-height: 1.5;">Name:</p>
                <input type="text" id="name-<?php echo $product['id']; ?>" name="name" value="<?php echo $product['name']; ?>" style="width:180px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;" />
                <div style="clear:both;"></div>
                <p style="float: left;line-height: 1.5;">Price:</p>
                <input type="number" id="price-<?php echo $product['id']; ?>" name="price" value="<?php echo $product['price']; ?>" style="width:180px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;" />
                <!--<image src="<?php echo base_url() . IMAGEPATH . PRODUCTIMAGE . $product['image']; ?>" style="max-width: 230;border: 1px solid #000;" />-->
                <div style="clear:both;"></div>
                <p style="float: left;line-height: 1.5;">Description:</p>
                <textarea id="description-<?php echo $product['id']; ?>" name="description" style="width:180px;height:250px;float:right;background-color: white;color: #999;border: 1px #DFDFDF solid;vertical-align: middle;"><?php echo $product['description']; ?></textarea>
                <div style="clear:both;"></div>
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
                <input type="submit" style="color: #A7A4A4;width: 100px;margin-left: 90px;" value="Update" />
            </form>
        </div>
    </div>
<?php endforeach; ?>
<script type="text/javascript">
    $('.toggle').click(function() {
        $('#' + this.id.replace('btn-','')).toggle("slow");
    });
</script>