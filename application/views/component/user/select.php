
<select id='standard' name='standard' class='custom-select form-control'>
    <option value='none'>Tất cả</option>
    <?php 
    foreach ($selects as $value) {
    	?>
    <option value="<?php echo $value->option_key; ?>"><?php echo $value->option_value; ?></option>

    	<?php
    }

    ?>
</select>
<span><i class="fa fa-caret-right"></i></span>