<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="center_content">
    <div class="center_title_bar"><?php echo $title; ?>: <?php echo $user['name']; ?></div>
    <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
            Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $user['name']; ?><br/>
            Username:&nbsp;&nbsp;&nbsp;<?php echo $user['username'];?><br/>
            Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $user['email']; ?><br/>
            Contact No: <?php echo $user['contactno']; ?><br/>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>
