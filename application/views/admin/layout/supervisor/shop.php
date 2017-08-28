
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Shop
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">List Shop</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <form class="box-body" action="#" method="post">
                            <table id="table" class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Namer</th>
                                        <th>Street</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($shops as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value->shop_name; ?></td>
                                        <td><?php echo $value->phone; ?></td>
                                        <td><?php echo $value->namer; ?></td>
                                        <td><?php echo $value->street; ?></td>
                                        <td><?php echo $value->address; ?></td>
                                        <td><input type="checkbox" style="width: 20px; height: 20px;" class="" <?php if ($value->status == 1) echo "checked" ?>></td>
                                        <td class="text-center" width="60px">
                                            <div class="tools">
                                                <a title="Edit" id="edit-shop" data="<?php echo $value->id; ?>"><i class="fa fa-edit"></i></a>
                                                <a title="Delete" href="#delete" table="shop" data="<?php echo $value->id; ?>"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
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
    <?php $this->view("admin/layout/temp/update_location"); ?>