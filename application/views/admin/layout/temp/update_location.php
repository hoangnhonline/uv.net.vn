    <div class="modal fade" id="modal-edit" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Shop</h4>
                </div>
                <div class="box box-warning">
                    <form action="<?php echo base_url("admin/action/update/shop") ?>" class="form-horizontal" method="post">
                        <div class="box-body ">
                            <input type="hidden" name="id">
                            <input type="hidden" name="condition_id">
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="shop_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Namer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namer" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Status</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="status">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Full Address</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" name="full_address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Phone</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Company</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="company_name" value="" readonly required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Location</label>
                                <div class="col-sm-9">
                                    <a href="<?php echo base_url('admin/map/?id=') ?>" target="_blank" class="btn btn-info btn-flat col-sm-6 pull-right update_location">Update location</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right">Shop type</label>
                                <div class="col-sm-9">
                                    <select name="type_id" class="form-control">
                                        <?php foreach ($shop_type["value"] as $key => $value) {
                                            ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->type; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php foreach ($sidebar as $key => $option) {  ?>
                            <div class="form-group">
                                <label class="controller-label col-sm-3 text-right"><?php echo $option["display_name"]; ?></label>
                                <div class="col-sm-9">
                                    <select name="<?php echo $option['name']; ?>_id" class="form-control">
                                        <?php foreach ($option["value"] as $key => $value) { ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->type; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
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
            function open_modal(shop_id){
                $.ajax({
                    mothod  : "post",
                    url     : API + "get-shop/" + shop_id,
                    success : function(html){
                        try{
                            data = JSON.parse(html);
                            $id.val(shop_id);
                            $update_location.attr("data", shop_id);
                            $shop_name.val(data[0].shop_name);
                            $namer.val(data[0].namer);
                            $full_address.val(data[0].full_address);
                            $company_name.val(data[0].company_name);
                            $phone.val(data[0].phone);
                            if(data[0].status == 1)
                                $status.attr("checked", "checked");
                            $condition_id.val(data[0].condition_id);
                            $type_id.find("option").each(function(){
                                if($(this).attr("value") == data[0].type_id){
                                    $(this).attr("selected", "selected");
                                }
                            });

                            <?php foreach ($sidebar as $key => $option) { ?>
                            $<?php echo $option['name'] ?>_id.find("option").each(function(){
                                if($(this).attr("value") == data[0].<?php echo $option['name'] ?>_id){
                                    $(this).attr("selected", "selected");
                                }
                            });
                            <?php } ?>


                            $modal_edit.modal();
                        } catch (ex) {
                            alert("error");
                        }
                    },
                    fail    : function(html){
                        console.log("error");
                        console.log(html);
                    }
                });
            }
            $modal_edit = $("#modal-edit");
            $id = $modal_edit.find("input[name='id']");
            $shop_name = $modal_edit.find("input[name='shop_name']");
            $namer = $modal_edit.find("input[name='namer']");
            $full_address = $modal_edit.find("input[name='full_address']");
            $company_name = $modal_edit.find("input[id='company_name']");
            $phone = $modal_edit.find("input[name='phone']");
            $type_id = $modal_edit.find("select[name='type_id']");
            $condition_id  = $modal_edit.find("input[name='condition_id']");
            $status  = $modal_edit.find("input[name='status']");
            $update_location = $(".update_location");
            <?php foreach ($sidebar as $key => $option) { ?>
            $<?php echo $option['name'] ?>_id = $modal_edit.find("select[name='<?php echo $option['name'] ?>_id']");
            <?php } ?>
            $("a[id='edit-shop']").on("click", function(){
                var shop_id = $(this).attr("data");
                open_modal(shop_id);
            });
            $update_location.on("click", function(){
                id = $(this).attr("data");
                url = $(this).attr("href") + id;
                var win = window.open(url, '_blank');
                win.focus();
                return false;
            });
            $("#modal-edit form").submit(function() {
                if(info1 !== undefined){
                    localStorage.setItem("info", JSON.stringify(info1));
                }
                return true;
            })
    </script>