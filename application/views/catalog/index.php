<div class="center_content">
    <div class="center_title_bar">Recent Items</div>
    <?php foreach( $catalog as $item ): ?>
    <div class="prod_box">
        <div class="top_prod_box"></div>
        <div class="center_prod_box">
            <div class="product_title">
                <a href="<?php base_url() ?>/product-details/<?php echo $item['slug']; ?>/"><?php echo $item['name']; ?></a>
            </div>
            <div class="product_img">
                <a href="<?php base_url() ?>/product-details/<?php echo $item['slug']; ?>/">
                    <img class="product_img" border="0" title="" alt="" src="<?php base_url();?>images/products/<?php echo $item['image']; ?>">
                </a>
            </div>
            <div class="prod_price">
                <span class="price"> <?php echo $item['price']; ?></span>
            </div>
            <a class="left_bt" title="header=[Add to cart] body=[&nbsp;] fade=[on]" href="/ise/?addcart=18">
                <img border="0" class="left_bt" title="" alt="" src="images/cart.gif">
            </a>
            <a class="prod_details" href="product-details.php?productid=18">details</a>
        </div>
        <div class="bottom_prod_box"></div>
    </div>
    <?php endforeach; ?>
</div>