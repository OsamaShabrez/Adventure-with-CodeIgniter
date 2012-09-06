                    <div class="right_content">
                        <div class="shopping_cart">
                        <div class="cart_title">Shopping cart</div>
                        <div class="cart_details">
                            <?php echo $this->cart->total_items(); ?> item(s) in cart<br />
                            <span class="border_cart"></span>
                            Total: <span class="price"><?php echo $this->cart->total();?> PKR</span>
                        </div>
                        <div class="cart_icon"><a href="<?php echo base_url(); ?>cart.html" title="header=[View Cart] body=[&nbsp;] fade=[on]"><img src="<?php echo base_url(); ?><?php echo IMAGEPATH; ?>/shoppingcart.png" alt="" title="" width="48" height="48" border="0" /></a></div>
                    </div>
                </div><!-- end of right content -->   
            </div><!-- end of main content -->
            <div class="footer">
                <div class="left_footer">
                    <img src="<?php echo base_url(); ?><?php echo IMAGEPATH; ?>/footer_logo.png" alt="" title="" width="170" height="49"/>
                </div>
                <div class="center_footer">
                    <br/><a style="text-decoration:none;"><?php echo SITENAME; ?>. All Rights Reserved 2010</a><br />
                </div>
            </div>                 
        </div> <!-- end of main_container -->
    </body>
</html>