<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Configuration
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Configuration</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->


        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title pull-left col-xs-12">Criteria</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="row">
                            <ul class="custom-ul">
                                <?php foreach ($conditions as $key => $value) { ?>

                                    <li class="li-color">
                                        <span class="col-xs-8"><?php echo $value->display_name; ?></span>
                                        <span class="col-order badge"><?php echo $value->col_order; ?></span>
                                        <span class="pull-right">
                                        <a href="#" id="edit-condition"
                                           display_name="<?php echo $value->display_name; ?>"
                                           data="<?php echo $value->id; ?>"
                                           col_order="<?php echo $value->col_order; ?>"><i class="fa fa-edit"></i></a>
                                        <a href="#" id="delete-condition" data="<?php echo $value->id; ?>"><i class="fa fa-trash"></i></a>
                                    </span>
                                    </li>

                                <?php } ?>
                            </ul>
                        </div>
                        <div class="row">
                            <form class="form-horizontal" action="<?php echo base_url("admin/action/add/condition") ?>"
                                  method="post">
                                <div class="box-body">
                                    <label class="col-sm-2 pull-left control-label text-right">Criteria: </label>
                                    <div class="col-sm-10 col-sm-offset-1 pull-right form-group">
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="type" placeholder="" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" min="1" class="form-control" name="col_order" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>
                    </div>
                </div>

                <?php foreach ($sidebar as $key => $option) {
                ?>
                <div class="col-md-6">
                    <!-- Horizontal Form -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title pull-left col-xs-12"><?php echo $option["display_name"]; ?>    </h3>
                            
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="row">
                            <ul class="custom-ul">
                                <?php foreach ($option["value"] as $key => $value) { ?>

                                    <li class="li-color"
                                        data="<?php echo $option['name']; ?>-<?php echo $value->id; ?>"
                                        style="border-left-color: <?php echo $value->color; ?>">
                                        <span class="col-xs-8"><?php echo $value->type; ?></span>
                                        <span class="col-order badge"><?php echo $value->col_order; ?></span>
                                        <span class="pull-right">
                                    <a href="#" col_order="<?php echo $value->col_order; ?>"
                                       color="<?php echo $value->color; ?>" id="edit-select"
                                       table="<?php echo $option['name']; ?>" data="<?php echo $value->id; ?>"><i
                                            class="fa fa-edit"></i></a>

                                    <a href="#" id="delete-select"
                                       table="<?php echo $option['name']; ?>" data="<?php echo $value->id; ?>"><i class="fa fa-trash"></i></a>
                                </span>
                                    </li>

                                <?php } ?>
                            </ul>
                        </div>
                        <div class="row">
                            <a href="#" id="edit-select" col_order="" color=""
                               table="<?php echo $option['name']; ?>" class="col-xs-3 btn btn-info col-xs-offset-8">Add</a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-md-4">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $shop_type["display_name"]; ?></h3>
                    </div>
                    <div class="row">

                        <ul class="custom-ul">
                            <?php foreach ($shop_type["value"] as $key => $value) { ?>
                                <li class="li-color">
                                    <a href="#" style="border-color: green;" class="col-xs-8">
                                    <span>
                                        <img src="<?php echo base_url($value->icon_url); ?>">
                                    </span>
                                        <?php echo $value->type; ?>
                                    </a>
                                    <span class="col-order badge"><?php echo $value->col_order; ?></span>
                                    <span class="pull-right">
                                    <a href="#" id="edit-shop-type" data="<?php echo $value->id; ?>"
                                       col_order="<?php echo $value->col_order; ?>"
                                       display_name="<?php echo $value->type; ?>" icon_url="<?php echo $value->icon_url; ?>"><i class="fa fa-edit"></i></a>
                                    <a href="#" id="check-status" data="<?php echo $value->id; ?>">
                                        <?php if($value->status == 1) { ?>
                                        <i class="fa fa-circle"></i>
                                        <?php } else { ?>
                                        <i class="fa fa-circle-o"></i>
                                        <?php } ?>
                                    </a>
                                </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <form class="form-horizontal" action="<?php echo base_url('admin/action/add/type'); ?>"
                          enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Shop name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="type" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4">Order</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="col_order" min="0" step="1"
                                           value="0" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4">Icon</label>
                                <div class="col-sm-8">
                                    <input type="file" name="icon_url" class="filestyle form-control" data-input="false" accept="image/*" style="max-width: 100px;" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info">Add</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>


<?php $this->view("component/admin/js_library.php"); ?>
<script src="<?php echo base_url('assets/lte/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>


<div class="modal fade" id="modal-edit-condition" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Criteria</h4>
            </div>
            <div class="modal-body box box-warning">
                <form class="form-horizontal" action="<?php echo base_url("admin/action/update/condition") ?>"
                      method="post">
                    <div class="box-body">
                        <input type="hidden" name="id">
                        <label class="col-sm-2 pull-left control-label text-right">Criteria: </label>
                        <div class="col-sm-10 col-sm-offset-1 pull-right form-group">

                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="display_name" placeholder="" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="number" min="1" class="form-control" name="col_order" required>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-select-condition" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body box  box-warning">
                <form class="form-horizontal" action="<?php echo base_url("admin/action/update/select") ?>"
                      method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="table" value="">
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="type" placeholder="" required>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" min="1" class="form-control" name="col_order" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="color" name="color" class="form-control my-colorpicker1" required>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-shop-type" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Criteria</h4>
            </div>
            <div class="modal-body box box-warning">
                <form class="form-horizontal" action="<?php echo base_url('admin/action/update/type'); ?>"
                      enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="box-body">
                        <input type="hidden" name="id"/>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Shop name</label>
                            <div class="col-sm-9">
                                <input type="text" name="type" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Order</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="col_order" min="0" step="1" value="0"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Icon</label>
                            <div class="col-sm-9">
                                <div class="col-md-6">
                                    <img src="" id="icon" style="max-width: 100px;" />
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="icon_url" class="filestyle form-control" data-input="false" onchange="readURL(this)" accept="image/*" 
                                           >
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info col-md-offset-10">Update</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <!-- /.box-body -->

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/bootstrap-filestyle.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        modal_edit_select = $("#edit-select-condition");
        modal_title = $(modal_edit_select).find(".modal-title");

        modal_type = $(modal_edit_select).find("input[name='type']");
        modal_id = $(modal_edit_select).find("input[name='id']");
        modal_table = $(modal_edit_select).find("input[name='table']");
        modal_color = $(modal_edit_select).find("input[name='color']");
        modal_col_order = $(modal_edit_select).find("input[name='col_order']");


        $("a[id='edit-select']").on("click", function () {
            var table = $(this).attr("table");
            var id = $(this).attr("data");
            var color = $(this).attr("color");
            var col_order = $(this).attr("col_order");

            $li = $(".li-color[data='" + table + "-" + id + "']");
            var type = $li.find("span:first").text().trim();

            $(modal_id).val(id);
            $(modal_title).html((id ? "Edit " : "Add "));
            $(modal_type).val(type);
            $(modal_table).val(table);
            $(modal_color).val(color);
            $(modal_col_order).val(col_order);

            $(modal_edit_select).modal();
        });


        modal_edit_condition = $("#modal-edit-condition");
        condition_id = $(modal_edit_condition).find("input[name='id']");
        condition_display_name = $(modal_edit_condition).find("input[name='display_name']");
        condition_col_order = $(modal_edit_condition).find("input[name='col_order']");


        $("a[id='edit-condition']").on("click", function () {
            condition_id.val($(this).attr("data"));
            condition_col_order.val($(this).attr("col_order"));
            condition_display_name.val($(this).attr("display_name").trim());

            $(modal_edit_condition).modal();
        });


        modal_edit_shop_type = $("#modal-edit-shop-type");
        shop_type_id = $(modal_edit_shop_type).find("input[name='id']");
        shop_type_name = $(modal_edit_shop_type).find("input[name='type']");
        shop_type_col_order = $(modal_edit_shop_type).find("input[name='col_order']");
        shop_type_icon_url = $(modal_edit_shop_type).find("img[id='icon']");

        $("a[id='edit-shop-type']").on('click', function () {
            var id = $(this).attr("data");
            var name = $(this).attr("display_name");
            var col_order = $(this).attr("col_order");
            var icon_url = $(this).attr("icon_url");

            $(shop_type_id).val(id);
            $(shop_type_name).val(name);
            $(shop_type_col_order).val(col_order);
            $(shop_type_icon_url).attr('src', "<?php echo base_url(); ?>" + icon_url);

            modal_edit_shop_type.modal();
        });


        $("a[id='delete-select']").on("click", function(){
            if(prompt("delete (y / n) ?") != "y") return false;
            $form = $('<form></form>');
            $form.attr("action", "<?php echo base_url("admin/action/delete/select"); ?>");
            $form.attr("method", "post");
            $form.append($("<input name='table' value='" + $(this).attr("table") + "'>"));
            $form.append($("<input name='id' value='" + $(this).attr("data") + "'>"));
            $form.submit();
            return false;
        });
        $("a[id='delete-condition']").on("click", function(){
            if(prompt("delete (y / n) ?") != "y") return false;
            $form = $('<form></form>');
            $form.attr("action", "<?php echo base_url("admin/action/delete/condition"); ?>");
            $form.attr("method", "post");
            $form.append($("<input name='id' value='" + $(this).attr("data") + "'>"));
            $form.submit();
            return false;
        });
        $("a[id='check-status']").on("click", function(){
            $form = $('<form></form>');
            $form.attr("action", "<?php echo base_url("admin/action/check/status"); ?>");
            $form.attr("method", "post");
            $form.append($("<input name='id' value='" + $(this).attr("data") + "'>"));
            $form.submit();
            return false;
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#icon')
                    .attr('src', e.target.result)
                    .width("100%")
                    .height("100%");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


</script>
