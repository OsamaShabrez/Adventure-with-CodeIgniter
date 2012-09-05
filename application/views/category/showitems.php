<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="center_content">
    <div class="center_title_bar"><?php echo $title; ?></div>
    <?php if( count($products) == 0) :?>
        <p style="text-align:center;">No products found.</p>
    <?php endif; ?>
    <?php foreach( $products as $product ): ?>
    <div class="prod_box">
        <div class="top_prod_box"></div>
        <div class="center_prod_box">
            <div class="product_title">
                <a href="<?php echo base_url() ?>/product-details/<?php echo $product['slug']; ?>/"><?php echo $product['name']; ?></a>
            </div>
            <div class="product_img">
                <a href="<?php echo base_url() ?>/product-details/<?php echo $product['slug']; ?>/">
                    <img class="product_img" border="0" title="" alt="" src="<?php echo base_url() . IMAGEPATH; ?>/products/<?php echo $product['image']; ?>">
                </a>
            </div>
            <div class="prod_price">
                <span class="price"> <?php echo $product['price']; ?></span>
            </div>
            <a class="left_bt" title="header=[Add to cart] body=[&nbsp;] fade=[on]" href="/ise/?addcart=18">
                <img border="0" class="left_bt" title="" alt="" src="<?php echo base_url() . IMAGEPATH; ?>/cart.gif">
            </a>
            <a class="prod_details" href="product-details.php?productid=18">details</a>
        </div>
        <div class="bottom_prod_box"></div>
    </div>
    <?php endforeach; ?>
</div><!-- end of center content -->
