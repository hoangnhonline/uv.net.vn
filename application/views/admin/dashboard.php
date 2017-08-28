<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <title>Dashboard</title>
    <?php $this->view("component/admin/css_library.php"); ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/lte/dist/css/skins/skin-blue.min.css'); ?>">
</head>
<body class="skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

    <?php $this->view("component/admin/header.php");?>

    <?php $this->view($component . "left_sidebar.php"); ?>

    <?php echo $main_content; ?>

    <?php $this->view("component/admin/footer.php"); ?>
    <?php $this->view("component/admin/right_sidebar.php"); ?>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- AdminLTE App -->
<?php $this->view("component/admin/js_library.php"); ?>
<form  id="form-delete" method="post" style="display: none;" action="<?php echo base_url("admin/action/delete/"); ?>">
	<input type="hidden" name="id">
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("a[href='#delete']").on("click", function(){
			if(prompt("Delete? (y or n)") == "y") ;
			else return false;
			table = $(this).attr("table");
			id = $(this).attr("data");
			$form_delete = $("#form-delete");
			$form_delete.attr("action", $form_delete.attr("action") + table);
			$form_delete.find("input").val(id);

			$form_delete.submit();

			return false;
		});
	});
</script>
</body>
</html>
