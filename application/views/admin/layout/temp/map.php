<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCUH_5LKkKhglGrWjvxIVtpyzvrJ2mDyyk&sensor=false"></script>

	<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Shop
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url("admin") ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url("admin/shop") ?>">Shop</a></li>
                <li class="active">Edit location</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box" id="shop">
                        <!-- /.box-header -->
						  	<input id="lat" type="hidden" name="lat" val="40.713956" />
						  	<input id="long" type="hidden" name="long" val="74.006653" />
						  	<div id="map_canvas" style="width: 100%;height: 100%;min-height: 400px;position: relative;overflow: hidden;"></div>
						  	<br>
						  	<div class="row form-group">
						  		<div class="col-sm-6 col-sm-offset-1">
						  			<label name="shop_name" class="control-label col-sm-4">Ten cua hang</label>
						  			<label name="full_address" class="control-label col-sm-8">Dia chi</label>
						  		</div>
							  	<div class="col-sm-3">
							  		<a href="#prev" class="btn btn-default col-xs-2"><span><i class="fa fa-angle-double-left"></i></span></a>
							  		<div class="col-xs-8">
							  			<input type="number" min="0" class="form-control" name="shop_id">
							  		</div>
							  		<a href="#next" class="btn btn-default col-xs-2"><span><i class="fa fa-angle-double-right"></i></span></a>
							  	</div>
							  	<div class="col-sm-1">
							  		<a href="#save" class="btn btn-danger">Save</a>
							  	</div>
						  	</div>
						  	<br>
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
	<div id="loader"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ?>"></div>

<script type="text/javascript">
	var map;
	var marker;
    function initialize() {
      var myLatlng = new google.maps.LatLng(40.713956, -74.006653);

      var myOptions = {
        zoom: 12,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

      marker = new google.maps.Marker({
        draggable: true,
        position: myLatlng,
        map: map,
        title: "Your location"
      });

      google.maps.event.addListener(marker, 'dragend', function(event) {


        document.getElementById("lat").value = event.latLng.lat();
        document.getElementById("long").value = event.latLng.lng();
      });
    }
    google.maps.event.addDomListener(window, "load", initialize());


    $(document).ready(function(){
    	$shop = $("#shop");
    	$lat = $shop.find("input[name='lat']");
    	$long = $shop.find("input[name='long']");
    	$shop_name = $shop.find("label[name='shop_name']");
    	$full_address = $shop.find("label[name='full_address']");
    	$shop_id = $("input[name='shop_id']");
    	var current_id = 0;

    	$("a[href='#prev']").on("click", function(){
    		val = parseInt($shop_id.val()) - 1;
    		$shop_id.val(val > 0 ? val : 1);
    		change_shop(val);
    		return false;
    	});
    	$("a[href='#next']").on("click", function(){
    		val = parseInt($shop_id.val()) + 1;
    		$shop_id.val(val);
    		change_shop(val);
    		return false;
    	});
    	function change_shop(id){
    		current_id = id;
    		url = API + "get-shop/" + current_id;
    		$('#loader').show();
    		$.ajax({
    			method 	: "post",
    			url 	: url,
    			success	: function(html){
                    try{
                        data = JSON.parse(html);

                        $shop_name.html(data[0].shop_name);
                        $full_address.html(data[0].full_address);
                        try{
                        	if(data[0].location){
                        		var location = data[0].location.split(",");
                        		var lat = parseFloat(location[0]);
                                $lat.val(lat);
                        		var long = parseFloat(location[1]);
                                $long.val(long);
                        		lat_lng = new google.maps.LatLng(lat, long);
                        		marker.setPosition(lat_lng);
                        		map.panTo(lat_lng);
                        	};
                        } catch(ex){
                        	console.log(ex);
                        }
                        $('#loader').hide();
                    } catch (ex) {
                        $shop_name.html("Error, check database please!!");
                        $full_address.html("");
                        current_id = 0;
                        $shop_id.val(0);
                        $('#loader').hide();
                    }
    			},
    			fail 	: function(html){
    				console.log(html);
    			}
    		})
    	}
    	$shop_id.on("change", function(){
    		val = parseInt($shop_id.val())
    		change_shop(val);
    	});
    	$("a[href='#save']").on("click", function(){
            if(current_id < 1) {
                alert("Error");
                return false;
            }
    		data = {
                lat : $lat.val(),
                long : $long.val(),
                id  : current_id
    		}
            $.ajax({
                url     :   '<?php echo base_url("admin/action/update/location") ?>',  
                method  :   "post",
                data    :   data,
                success :   function(html){
                    alert("Updated");                },
                fail    :   function(html){
                    alert("Error");
                }
            });
    		return false;
    	});

    	<?php
    		if(isset($_GET["id"])){
    			if(is_numeric($_GET["id"]) && $_GET["id"] > 0){
    				?>
                    $shop_id.val(<?php echo $_GET["id"]; ?>);
    				change_shop(<?php echo $_GET["id"]?>);
    				<?php
    			}
    		}
    	?>
    });
</script>