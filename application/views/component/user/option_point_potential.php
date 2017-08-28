
<ul class="treeview-menu">
    <li><a href="#" data="-1" condition="potential"><div><img src="<?php echo base_url('assets/images/map-icons/shop-icon.png'); ?>"></div> <span>Tất cả</span></a></li>
    <?php 
    foreach ($options as $key => $value) { ?>

    <li><a href="#" style="border-left-color: <?php echo $value->color; ?>" data="<?php echo $value->id; ?>" condition="potential"><?php echo $value->type; ?></a></li>

    <?php }
    ?>
</ul>
