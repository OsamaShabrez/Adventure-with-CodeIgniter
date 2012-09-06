<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="center_content">
    <div class="center_title_bar"><?php echo $title; ?></div>
    <div style="clear:both;"></div>

<div class="prod_box_big">
<div class="top_prod_box_big"></div>
<div class="center_prod_box_big">
    <?php if( count($this->cart->contents()) === 0 ) : ?>
    <p style="font-size: 14px; font-variant: small-caps; padding: 5px; font-weight: bold;text-align: center;">Your Shopping Cart is Empty</p>
    <br/>
    <p style="font-size: 12px; font-variant: small-caps; padding: 10px 30px 10px 10px;text-align: justify;">If you pressed the Shopping Cart button without having added any items to your cart, please return to our product pages and add items by clicking the Add to Cart button next to the item you wish to purchase. You will then be able to view items in your cart.</p>
    <br/>
    <div style="margin: 0px auto;text-align: center;"><a title="" style="text-decoration: none; color: #ff0000; font-weight: bold; font-size: 14px; font-variant: small-caps;" href="<?php echo base_url(); ?>"><img width="48" height="48" border="0" title="" alt="" src="<?php echo base_url(); ?>images/shoppingcart-empty.png"><br>Continue Shopping</a></div>
    <?php else: ?>
    <table summary="Shopping Cart Details" id="hor-minimalist-b">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Sub.Total</th>
            </tr>
        </thead>
        <tbody>
            <?php echo form_open('update-cart'); ?>
            <?php foreach ($this->cart->contents() as $items): ?>
            <tr>
                <td><a href="<?php echo base_url(); ?>remove-cart/<?php echo $items['rowid'];?>.html"><img src="images/d.png"></a> &nbsp;<?php echo $items['name']; ?></td>
                <td><input type="text" onblur="clickrecall(this,'1')" onclick="clickclear(this, '1')" style="margin-left: 5px; text-align: right;" name="<?php echo $items['id']; ?>" maxlength="3" size="3" value="<?php echo $items['qty']; ?>"></td>
                <td style="text-align: center;"><?php echo $items['price']; ?></td>
                <td style="text-align: center;padding: 0px;"><?php echo $items['qty']*$items['price']; ?> RS</td>
            </tr>
            <?php endforeach; ?>
            <tr>
            <td style="font-variant: small-caps; color: #099; font-weight: bold;">
                <input type="submit" value="    Update" style="cursor: pointer;font-variant: inherit; font-weight: inherit; color: inherit; background-image: url('<?php echo base_url(); ?>images/checked.png'); background-repeat: no-repeat; border: hidden; background-color: inherit;">
            </td>
            <td style="text-align: right; font-variant: small-caps; font-weight: bold; color: #099;" colspan="2">Total Payable:&nbsp;&nbsp;&nbsp;</td>
            <td style="padding: 0 30px 0 0;text-align: right;"><?php echo $this->cart->total(); ?> RS</td>
            </tr>
            </form>
        </tbody>
    </table>
    <div style="margin: 0px auto;text-align: center;"><a title="header=[Checkout] body=[&nbsp;] fade=[on]" style="text-decoration: none; color: #ff0000; font-weight: bold; font-size: 14px; font-variant: small-caps;" href="process-order.html"><img width="48" height="48" border="0" title="" alt="" src="<?php echo base_url(); ?>images/shoppingcart-full.png"><br>Check Out</a></div>
    <?php endif; ?>
    </div>
<div class="bottom_prod_box_big"></div>                                
</div>
</div>