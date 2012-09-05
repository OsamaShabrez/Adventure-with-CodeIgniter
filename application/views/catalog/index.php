<div class="center_content">
    <div class="center_title_bar">Recent Items</div>
    <?php foreach( $products as $product ): ?>
    <div class="prod_box">
        <div class="top_prod_box"></div>
        <div class="center_prod_box">
            <div class="product_title">
                <a href="<?php echo base_url() ?>product-details/<?php echo $product['id'] . '/' . $product['slug']; ?>.html"><?php echo $product['name']; ?></a>
            </div>
            <div class="product_img">
                <a href="<?php echo base_url() ?>product-details/<?php echo $product['id'] . '/' . $product['slug']; ?>.html">
                    <img  width="150" height="150" class="product_img" border="0" title="" alt="" src="<?php base_url();?><?php echo IMAGEPATH; ?>/products/<?php echo $product['image']; ?>">
                </a>
            </div>
            <div class="prod_price">
                <span class="price"> <?php echo $product['price']; ?></span>
            </div>
            <a class="left_bt" title="header=[Add to cart] body=[&nbsp;] fade=[on]" href="<?php echo base_url() ?>add-to-cart/<?php echo $product['id'] . '/' . $product['slug']; ?>.html">
                <img border="0" class="left_bt" title="" alt="" src="<?php echo base_url(); ?><?php echo IMAGEPATH; ?>/cart.gif">
            </a>
            <a class="prod_details" href="<?php echo base_url() ?>product-details/<?php echo $product['id'] . '/' . $product['slug']; ?>.html">details</a>
        </div>
        <div class="bottom_prod_box"></div>
    </div>
    <?php endforeach; ?>
</div>