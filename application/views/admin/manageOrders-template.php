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
<?php foreach ($orders as $order) : ?>
    <div class="prod_box_big" id="page-<?php echo $order['id']; ?>">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
            <p class="toggle" id="btn-<?php echo $order['id'];?>"><strong>Order No. <?php echo $order['id']; ?> / <?php echo $order['totalamount'] ?> RS</strong> <em>(click to expand)</em></p>
                <?php if($order['status']): ?>
            <a style="text-align:center;display: block;color: #009999;text-decoration: none;">
                    Processed
                <?php else: ?>
            <a style="text-align:center;display: block;color: #009999;text-decoration: none;" href="process-order/<?php echo $order['id'];?>.html">
                    Mark Processed
                <?php endif; ?>
            </a>
            <div id="<?php echo $order['id'];?>" style="display:none;">
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
                        <?php foreach ($order['details'] as $items): ?>
                        <tr>
                            <td>&nbsp;<?php echo $items['productname']; ?></td>
                            <td style="text-align: center;"><?php echo $items['quantity']; ?></td>
                            <td style="text-align: center;">PKR <?php echo $items['unitPrice']; ?></td>
                            <td style="text-align: center;padding: 0px;"><?php echo $items['quantity']*$items['unitPrice']; ?> RS</td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                        <td style="font-variant: small-caps; font-weight: bold; color: #099;padding: 0 0 0 10px;text-align: left;"><?php echo $order['username'] ?></td>
                        <td style="text-align: right; font-variant: small-caps; font-weight: bold; color: #099;" colspan="2">Total Payable:&nbsp;&nbsp;&nbsp;</td>
                        <td style="padding: 0 30px 0 0;text-align: right;"><?php echo $order['totalamount'] ?> RS</td>
                        </tr>
                    </tbody>
                </table>
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