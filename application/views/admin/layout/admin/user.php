<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Epoint</a></li>
            <li><a href="">user</a></li>
        </ol>
    </section>

    
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="container-fluid">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <div class="box-footer col-sm-12">
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-add">Add </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form class="box-body" action="#" method="post">
                        <table id="table" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>User name</th>
                                    <th>Full name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Company</th>
                                    <th>Create time</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value->username; ?></td>
                                    <td><?php echo $value->fullname; ?></td>
                                    <td><?php echo $value->email; ?></td>
                                    <td><?php echo $value->phone; ?></td>
                                    <td><?php echo $this->config->item($value->type, 'ADMIN_TYPE'); ?></td>
                                    <td><?php echo ($value->company_id != 0) ? $value->company_name : "Epoint's Operator"; ?></td>
                                    <td><?php echo $value->create_time; ?></td>
                                    <td class="text-center" width="60px">
                                        <div class="tools">
                                            <a title="Edit" id="edit-user" data="<?php echo $value->id; ?>"><i class="fa fa-edit"></i></a>
                                            <a title="Delete" href="#delete" table="user" data="<?php echo $value->id; ?>"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modal-add" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="box box-warning">
                <form action="<?php echo base_url("admin/action/add/user") ?>" class="form-horizontal" method="post">
                    <div class="box-body ">
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fullname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Username</label>
                            <div class="col-sm-9 has-warning">
                                <input type="text" class="form-control" name="username" placeholder="admin" required>
                                <p class="help-block">Username exits</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Phone</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Type</label>
                            <div class="col-sm-9">
                                <select name="type" class="form-control" required>
                                    <option value="<?php echo SALE; ?>">SALE</option>
                                    <option value="<?php echo VIEW; ?>">VIEW</option>
                                    <option value="<?php echo OPERATOR; ?>">OPERATOR</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="company">
                            <label class="controller-label col-sm-3 text-right">Company</label>
                            <div class="col-sm-9">
                                <select name="company_id" class="form-control">
                                    <?php foreach ($companies as $key => $value) {
                                        ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->company_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" required>
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
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="box box-warning">
                <form action="<?php echo base_url("admin/action/update/user") ?>" class="form-horizontal" method="post">
                    <div class="box-body ">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fullname" value="Nguyen Van Nam" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="google@gmail.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Phone</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" name="phone" value="01267767777" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password">
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

        $("#modal-add select[name='type']").change(function(){
            if($(this).val() == <?php echo OPERATOR; ?> || $(this).val() == <?php echo VIEW; ?>){
                $("#modal-add #company").hide();
                $("#modal-add select[name='company_id']").val("0");
            } else {
                $("#modal-add #company").show();
            }
        });
        $("p.help-block").hide();


        $id = $("#modal-edit input[name='id']");
        $fullname = $("#modal-edit input[name='fullname']");
        $password = $("#modal-edit input[name='password']");
        $phone = $("#modal-edit input[name='phone']");
        $email = $("#modal-edit input[name='email']");
        $modal_edit = $("#modal-edit");

        $("a[id='edit-user']").on("click", function(){
            var user_id = $(this).attr("data");
            console.log(user_id);
            $id.val(user_id);
            $.ajax({
                method : "post",
                url    :  API + "get-user/" + user_id,
                success: function(html){
                    try{
                        data = JSON.parse(html);

                        $fullname.val(data.user_info[0].fullname);
                        $email.val(data.user_info[0].email);
                        $phone.val(data.user_info[0].phone);
                        $password.val("");


                        $modal_edit.modal();
                    } catch (ex) {
                        console.log("user not found");
                    }


                },
                fail   : function(html){
                    alert("Has error, please try again");
                }
            });
        })
    });


</script>