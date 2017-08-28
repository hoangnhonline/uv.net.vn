<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Epoint Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Epoint</a></li>
            <li><a href="">Dashboard</a></li>
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
                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-company-add">Add </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form class="box-body" action="#" method="post">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <th width="30px">ID</th>
                                <th style="text-align: left; padding: 8px">Company</th>
                                <th style="text-align: left; padding: 8px">Phone</th>
                                <th style="text-align: left; padding: 8px">Address</th>
                                <th style="text-align: left; padding: 8px">FTP Username</th>
                                <th style="text-align: left; padding: 8px">FTP Password</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php foreach ($companys as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value->id; ?></td>
                                    <td><?php echo $value->company_name; ?></td>
                                    <td><?php echo $value->phone; ?></td>
                                    <td><?php echo $value->address; ?></td>
                                    <td><?php echo $value->ftp_name; ?></td>
                                    <td><?php echo $value->ftp_pass; ?></td>

                                    <td class="text-center" width="60px">
                                        <div class="tools">
                                            <a title="Edit" id="edit_company" data="<?php echo $value->id; ?>"><i class="fa fa-edit"></i></a>
                                            <a title="Delete" href="#delete" table="company" data="<?php echo $value->id; ?>"><i class="fa fa-trash"></i></a>
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



<div class="modal fade" id="modal-company-add" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Company</h4>
            </div>
            <div class="box box-warning">
                <form action="<?php echo base_url("admin/action/add/company") ?>" class="form-horizontal" method="post">
                    <div class="box-body ">
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Company</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Ftp name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ftp_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Ftp pass</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ftp_pass" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Phone</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Manager's Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fullname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Manager's Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Manager's Mail</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Manager's Password</label>
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

<div class="modal fade" id="modal-company-edit" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Company</h4>
            </div>
            <div class="box box-warning">
                <form action="<?php echo base_url("admin/action/update/company") ?>" class="form-horizontal" method="post">
                    <div class="box-body ">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Company</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company_name" value="UIT">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Ftp name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ftp_name" value="ftp.google.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Ftp pass</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="ftp_pass" value="12345678">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Phone</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" name="phone" value="0123456789">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="controller-label col-sm-3 text-right">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" value="Thu Duc">
                            </div>
                        </div>
                        <div class="form-group" name="manager_id">
                            <label class="controller-label col-sm-3 text-right">Manager</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="manager_id" id="list-user">
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
        $modal_edit = $("#modal-company-edit");
        $list_user = $("#list-user");
        $company_id = $modal_edit.find("input[type='hidden']");
        $company_name = $modal_edit.find("input[name='company_name']");
        $ftp_name = $modal_edit.find("input[name='ftp_name']");
        $ftp_pass = $modal_edit.find("input[name='ftp_pass']");
        $phone = $modal_edit.find("input[name='phone']");
        $address = $modal_edit.find("input[name='address']");

        $("a[id='edit_company']").on("click", function(){
            var id = $(this).attr("data");
            $.ajax({
                method      :   "post",
                url        :   API + "get-company/" + id,
                success     :   function(html){
                    try{
                        data = JSON.parse(html);
                        $list_user.html("");


                        for(var i = 0; i < data.users.length; i++){
                            $user = $("<option></option>");
                            $user.text(data.users[i].fullname);
                            $user.val(data.users[i].id);
                            try{
                                if(data.users[i].id == data.company_info[0].manager_id){
                                    $user.attr("selected", "selected");
                                }
                            } catch (ex) {
                                console.log("company dont have manager");
                            }
                            $list_user.append($user);
                        }
                        try {

                            $company_id.val(id);
                            $company_name.val(data.company_info[0].company_name);
                            $ftp_name.val(data.company_info[0].ftp_name);
                            $ftp_pass.val(data.company_info[0].ftp_pass);
                            $phone.val(data.company_info[0].phone);
                            $address.val(data.company_info[0].address);
                        } catch (ex) {
                            console.log("company not found");
                        }


                        $modal_edit.modal();
                    } catch(ex){
                        console.log("error. try again");
                    }
                },
                fail        :   function(html){
                    console.log("Error: " + html);
                }
            })
        });
    });
</script>