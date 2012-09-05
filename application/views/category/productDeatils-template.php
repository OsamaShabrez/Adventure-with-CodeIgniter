<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="center_content">
    <div class="center_title_bar"><?php echo $product['name']; ?></div>
    <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">            
            <div class="product_img_big">
                <img border="0" width="150" height="150" title="" alt="" src="<?php echo base_url() . IMAGEPATH; ?>/products/<?php echo $product['image']; ?>">
            </div>
            <div class="details_big_box">
                <div class="product_title_big"><?php echo $product['name']; ?></div>
                <div class="specifications">
                    Availability: <span class="blue">In stock</span><br>
                    <div class="prod_price_big"><span class="price">PKR <?php echo $product['price']; ?></span></div>
                    <a class="addtocart" href="/ise/product-details.php?productid=18&amp;addcart=18">add to cart</a>
                </div>
            </div>                        
        </div>
        <div class="bottom_prod_box_big"></div>                                
    </div>
</div><!-- end of center content -->
