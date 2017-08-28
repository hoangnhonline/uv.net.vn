<ul class="sidebar-menu">
	<li><a href="#" data="-1" condition="type"><div><img src="<?php echo base_url('assets/images/map-icons/shop-icon.png'); ?>"></div> <span>Tất cả</span></a></li>
    <?php 
    foreach ($options as $key => $value) { ?>

    <li><a href="#" data="<?php echo $value->id; ?>" condition="type"><div><img src="<?php echo base_url($value->icon_url) ?>"></div> <span><?php echo $value->type; ?></span></a></li>

    <?php }
    ?>
</ul>