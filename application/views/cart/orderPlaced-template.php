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
    <?php if( count($this->cart->contents()) === 0 ):
        redirect('cart');
    else: ?>
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
            <?php foreach ($this->cart->contents() as $items): ?>
            <tr>
                <td>&nbsp;<?php echo $items['name']; ?></td>
                <td style="text-align: center;"><?php echo $items['qty']; ?></td>
                <td style="text-align: center;">PKR <?php echo $items['price']; ?></td>
                <td style="text-align: center;padding: 0px;"><?php echo $items['qty']*$items['price']; ?> RS</td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
            <td style="text-align: right; font-variant: small-caps; font-weight: bold; color: #099;" colspan="2">Total Payable:&nbsp;&nbsp;&nbsp;</td>
            <td style="padding: 0 30px 0 0;text-align: right;"><?php echo $this->cart->total(); ?> RS</td>
            </tr>
        </tbody>
    </table>
    <div style="margin: 0px auto;text-align: center;"><a title="header=[Order Placed] body=[&nbsp;] fade=[on]" style="text-decoration: none; color: #ff0000; font-weight: bold; font-size: 14px; font-variant: small-caps;"><img width="48" height="48" border="0" title="" alt="" src="<?php echo base_url(); ?>images/shoppingcart-full.png"><br>Order Placed - Wait for our agent to approach you shortly</a></div>
    <?php $this->cart->destroy(); endif; ?>
    </div>
<div class="bottom_prod_box_big"></div>                                
</div>
</div>