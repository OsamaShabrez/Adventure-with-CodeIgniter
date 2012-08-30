                    <div class="right_content">
                        <div class="shopping_cart">
                        <div class="cart_title">Shopping cart</div>
                        <div class="cart_details">
                            <?php echo $_SESSION['totalitems']; ?> item(s) in cart<br />
                            <span class="border_cart"></span>
                            Total: <span class="price"><?php echo $_SESSION['price']; ?> PKR</span>
                        </div>
                        <div class="cart_icon"><a href="check-out.php" title="header=[View Cart] body=[&nbsp;] fade=[on]"><img src="<?php echo base_url(); ?>images/shoppingcart.png" alt="" title="" width="48" height="48" border="0" /></a></div>
                    </div>
                    <div class="title_box">Manufacturers</div>
                    <ul class="left_menu">
			<?php
                            if(isset($_GET['family']) && isset($_GET['Fid'])) {
                                $query = "SELECT Distinct Brand.BrandName, Brand.BrandID FROM ((ProductFamily INNER JOIN ProductCategory ON ProductFamily.FamilyID = ProductCategory.FamilyID) INNER JOIN ProductSubCategory ON ProductCategory.CategoryID = ProductSubCategory.CategoryID) INNER JOIN (Brand INNER JOIN Product ON Brand.BrandID = Product.BrandID) ON ProductSubCategory.SubCategoryID = Product.ProductSubCategory WHERE ProductFamily.FamilyID='{$_GET['Fid']}' ORDER BY Brand.BrandName ASC";
                            } else if(isset($_GET['category']) && isset($_GET['Cid'])) {
                                $query = "SELECT Distinct Brand.BrandName, Brand.BrandID FROM ((ProductFamily INNER JOIN ProductCategory ON ProductFamily.FamilyID = ProductCategory.FamilyID) INNER JOIN ProductSubCategory ON ProductCategory.CategoryID = ProductSubCategory.CategoryID) INNER JOIN (Brand INNER JOIN Product ON Brand.BrandID = Product.BrandID) ON ProductSubCategory.SubCategoryID = Product.ProductSubCategory WHERE ProductCategory.CategoryID='{$_GET['Cid']}' ORDER BY Brand.BrandName ASC";
                            } else if(isset($_GET['subcategory']) && isset($_GET['Sid'])) {
                                $query = "SELECT Distinct Brand.BrandName, Brand.BrandID FROM ((ProductFamily INNER JOIN ProductCategory ON ProductFamily.FamilyID = ProductCategory.FamilyID) INNER JOIN ProductSubCategory ON ProductCategory.CategoryID = ProductSubCategory.CategoryID) INNER JOIN (Brand INNER JOIN Product ON Brand.BrandID = Product.BrandID) ON ProductSubCategory.SubCategoryID = Product.ProductSubCategory WHERE ProductSubCategory.SubCategoryID='{$_GET['Sid']}' ORDER BY Brand.BrandName ASC";
                            } else {
                                $query = "SELECT BrandID,BrandName FROM brand ORDER BY BrandName ASC";
                            }$resultset = mysql_query($query);
			    $odd_even = false;
			    while($row = mysql_fetch_array($resultset)) {
				if($odd_even) {
				    echo "<li class='even'><a href='index.php?Bid={$row['BrandID']}&&brand=" . urlencode($row['BrandName']) . "'>{$row['BrandName']}</a></li>";
				    $odd_even = false;
				} else {
				    echo "<li class='odd'><a href='index.php?Bid={$row['BrandID']}&&brand=" . urlencode($row['BrandName']) . "'>{$row['BrandName']}</a></li>";
				    $odd_even = true;
				}
			    }
			?>
                    </ul>      
                    <div class="banner_adds">                            
                        <a href="#"><img src="<?php echo base_url(); ?>images/bann1.jpg" alt="" title="" border="0" /></a>
                    </div>
                </div><!-- end of right content -->   
            </div><!-- end of main content -->
            <div class="footer">
                <div class="left_footer">
                    <img src="<?php echo base_url(); ?>images/footer_logo.png" alt="" title="" width="170" height="49"/>
                </div>
                <div class="center_footer">
                    <a href="<?php echo base_url(); ?>">Home</a>
                    <a href="privacy-policy/">Privacy-Policy</a>
                    <a href="how-to-order/">How to Order</a>
                    <a href="shipping-returns/">Shipping</a>
                    <a href="contact-us/">contact us</a>
                    <br/><br/>
                    <a style="text-decoration:none;">E-Value Mart. All Rights Reserved 2010</a><br />
                </div>
                <div class="right_footer">
                <br/>
                    <a style="text-decoration:none;">Designed By:</a><a>Muhammad Osama Shabrez</a>
                </div>
            </div>                 
        </div> <!-- end of main_container -->
    </body>
</html>