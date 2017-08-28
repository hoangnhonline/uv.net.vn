
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Shop
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Shop</a></li>
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Namer</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($shops as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value->id; ?></td>
                                        <td><?php echo $value->shop_name; ?></td>
                                        <td><?php echo $value->namer; ?></td>
                                        <td><?php echo $value->phone; ?></td>
                                        <td><?php echo $value->full_address; ?></td>
                                        <td>
                                            <center>
                                                <input type="checkbox" style="width: 20px; height: 20px;" class="minimal" <?php if ($value->status == 1) echo "checked" ?>>
                                            </center>
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
