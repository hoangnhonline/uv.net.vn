
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Group
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Group</a></li>
                <li class="active">List group</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="col-md-12">
                            <h3><a href="#add-group" class="btn btn-success btn-flat pull-right">ADD</a></h3>
                            <br>
                            <br>
                        </div>
                        <!-- /.box-header -->
                        <table id="table" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($groups as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value->id; ?></td>
                                    <td><?php echo $value->name; ?></td>
                                    <td class="text-center" width="60px">
                                        <div class="tools">
                                            <a title="Edit" href="#edit-group" name="<?php echo $value->name; ?>" data="<?php echo $value->id; ?>"><i class="fa fa-edit"></i></a>
                                            <a title="View detail"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-add" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add group</h4>
                </div>
                <div class="box box-warning">
                    <form action="<?php echo base_url("admin/action/add/group") ?>" class="form-horizontal" method="post">
                        <div class="box-body ">
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Khu vuc A" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Managers</label>
                                <div class="col-sm-9">
                                    <select name="manager_id" class="form-control">

                                        <?php foreach ($users as $key => $value) {
                                            ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->fullname; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                        <div class="box-footer">
                            <button type="button" class="col-xs-2 btn btn-default pull-right" data-dismiss="modal">Close</button>
                            <button type="submit" class="col-xs-2 btn btn-primary pull-right">Add</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit group</h4>
                </div>
                <div class="box box-warning">
                    <form action="<?php echo base_url("admin/action/update/group") ?>" class="form-horizontal" method="post">
                        <input type="hidden" name="id">
                        <div class="box-body ">
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Khu vuc A" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Managers</label>
                                <div class="col-sm-9">
                                    <select name="manager_id" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                        <div class="box-footer">
                            <button type="button" class="col-xs-2 btn btn-default pull-right" data-dismiss="modal">Close</button>
                            <button type="submit" class="col-xs-2 btn btn-primary pull-right">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("a[href='#add-group']").on("click", function(){
            $("#modal-add").modal();
            return false;
        }); 
        $("a[href='#edit-group']").on("click", function(){
            $modal_edit = $("#modal-edit");
            group_id = $(this).attr("data");
            $select = $modal_edit.find("select");
            $select.html("");
            ($modal_edit.find("input[name='name']")).val($(this).attr("name"));
            ($modal_edit.find("input[name='id']")).val(group_id);

            $.ajax({
                mothod  : "post",
                url     : API + "get-group/" + group_id,
                success : function(html){
                    try{
                        data = JSON.parse(html);
                        for (var i = 0; i < data.length; i++) {
                            $option = $("<option></option>");
                            $option.attr("value", data[i].user_id);
                            $option.text(data[i].fullname);
                            if(data[i].user_id == data[i].manager_id)
                                $option.attr("selected", "selected");
                            $select.append($option);
                        }
                    } catch (ex) {
                        console.log("shop not found");
                    }
                },
                fail    : function(html){
                    console.log("error");
                    console.log(html);
                }
            });
            
            $modal_edit.modal();
            return false;
        });
    });
</script>