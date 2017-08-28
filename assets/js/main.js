var info1 = null;
$(document).ready(function(){

    function ChangeToSlug(str) {
        var slug;

        slug = str.toLowerCase();

        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

        slug = slug.replace(/ /gi, "-");

        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');

        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');

        return slug;
    }
    $(".sidebar-form").submit(function(){
        search_str = $("#search-str").val();
        url = API + "get-controller/search/" + ChangeToSlug(search_str);
        $.ajax({
            method  : "get",
            url     : url,
            success : function(html){
                if(html == "[]")
                    snackbar_show("Không có kết quả nào phù hợp với truy vấn này");
                else {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                    markers = [];
                    addToMap(html);
                }
            }
        });
        return false;
    });
    $("body #standard").each(function () {
        $(this).customselect();
    });


    function view_more(id){



        $.ajax({
            url : API + "get-controller/image/" + id,
            method : "post",
            success: function(html){
                try{
                    data = JSON.parse(html);
                    if(data.length > 0){
                        $("#myModalSearch").modal();
                        $swiper = $(".swiper-wrapper");
                        $swiper.html("");
                        for (var i = data.length - 1; i >= 0; i--) {
                            $div = $('<div class="swiper-slide"> <img src="' + API + data[i] + '"> </div>');
                            $swiper.append($div);
                        }
                        var swiperH = new Swiper('.swiper-container-h', {
                            loop: false,
                            pagination: '.swiper-pagination',
                            paginationClickable: true,
                            slideToClickedSlide:true,
                            nextButton: '.swiper-button-next',
                            prevButton: '.swiper-button-prev',
                            spaceBetween: 30,
                            hashnav: true,
                            hashnavWatchState: true
                        });
                        swiperH.slideTo(0, 1000, false);
                        function resize_event(){
                            window.dispatchEvent(new Event('resize'));
                        }
                        setTimeout(resize_event, 500);
                    }
                    else {
                        alert("Không có hình ảnh nào tại đây");
                    }
                } catch(ex){
                    alert("No thing found");
                }
            }
        });
    }
    function snackbar_show(html) {
        toastr.remove();
        toastr.options.onclick = function(){
            toastr.remove();
        };
        toastr.options.positionClass = "toast-bottom-right";
        toastr.options.newestOnTop =  true;
        toastr["info"]("<div style='padding: 10px; font-size: 16px;'>" + html + "</div>");
    }
    var map;
    var tempIW = null;
    var markers = [];
    var bounds;
    var arr = null;
    var first_selected = false;

    function getPoint(){
        url = API + "get-controller/shop/re/get_marker";
        initialize("");
    }

    function select(info){
        var url = API + "get-controller/select";
        $.ajax({
            url     :   url,
            method  :   "post",
            data    :   {
                select_info: info,
            },
            dataType: "text",  
            cache:false,
            success :   function(html){
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
                markers = [];
                addToMap(html);
            },
            error: function(data){
                console.log("Error line 176 main.js");
            }
        });
    }
    $(".btn-search-max, .btn-search-min").on("click", function(){
        var temp        = "";
        var location    = $("#province select").val();

        if(location !== "none"){
            temp = location;
            location = $("#district select").val();
            if(location !== "none"){
                temp = location;
                location = $("#ward select").val();
                if(location !== "none"){
                    location = "ward_id = " + location;
                }
                else
                    location = "district_id = " + temp;
            }
            else
                location = "province_id = " + temp;
        } else 
            location = "";

        var company = $("#company select").val();
        if(company == "none"){
            company = "";
        } else {
            company = "company_id = " + company;
        }


        if(location.length == 0){
            snackbar_show("Lựa chọn tỉnh trước để tránh dữ liệu tải về quá lớn");
            return;
        }

        info1 = JSON.stringify({
            location    : location,
            company     : company,
        });

        select(info1);
        return false;

    });
    function set_select(b){
        for(var key in select){
            select[key] = b;
        }
    }
    function addToMap(html){
        if(html === "") return;
        var features = [];
        arr = JSON.parse(html);

        function getContent(data) {
            return '<div class="info-box-wrap row">     <div class="col-sm-4">      <img src="assets/images/shop.jpg" />        <a class="btn btn-info" id="view-more" data="' + data.shop_id + '">        More</a>    </div>    <div class="info-box-text-wrap col-sm-8">           <h6 class="address">           ' + data.shop_name + '</h6>         <div class="action-btns">           <i class="fa fa-volume-control-phone">           </i>  <strong>  ' + data.namer + ": " + data.phone + '</strong>  <br>           <i class="fa fa-user">           </i>                    <strong>                    ' + data.fullname + '</strong>                    <br>           <i class="fa fa-map-marker">           </i>              <strong>              ' + data.full_address + '</strong>              <br>        </div>        ' + (edit_link != "" ? '<div class="row">   <a target="_blank" class="pull-right" id="edit-shop" data="' + data.shop_id + '"><i class="fa fa-pencil-square-o"></i></a></div>' : '') + '</div>    </div>';
        }

        bounds = new google.maps.LatLngBounds();

        // set multiple marker
        for (var i = 0; i < arr.length; i++) {
            // init markers
            
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(arr[i].location.split(',')[0]), parseFloat(arr[i].location.split(',')[1])),
                map: map,
                title: arr[i].shop_name,
                icon: {
                    url: "image.php?source=" + map_icon["type"][arr[i].type_id] + "&radius=5",
                    size: new google.maps.Size(50, 50),
                },
                data : arr[i]
            });

            (function(marker, i) {
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow = new google.maps.InfoWindow({
                        content: getContent(marker.data)
                    });
                    if(tempIW)
                        tempIW.close();
                    infowindow.open(map, marker);
                    tempIW = infowindow;

                    google.maps.event.addListener(infowindow, 'domready', function() {
                        $("#view-more").on("click", function() {
                            view_more($(this).attr("data"));
                        });
                        $("a[id='edit-shop']").on("click", function(){
                            var shop_id = $(this).attr("data");
                            open_modal(shop_id);
                        });
                    });
                });

            })(marker, i);

            bounds.extend(marker.position);

            markers.push(marker);
        }

        google.maps.event.addListener(map, 'click', function() {
            if(tempIW)
                tempIW.close();
        });
        $(".condition-active").removeClass("condition-active");
        set_select(true);
        first_selected = false;
        if(markers.length > 0)
            map.fitBounds(bounds);
        snackbar_show(arr.length + " kết quả");
    }
    function initialize(html) {
        var myLatLng = {lat: 21.037528, lng: 105.836028};

        map = new google.maps.Map(document.getElementById('map'), {
            scrollwheel: true,
            zoom: 14,
            center: myLatLng
        });

        addToMap(html);

    }

    function make_select_box(html, type)
    {
        var arr = JSON.parse(html);
        var select = "<select id='standard' name='standard' class='custom-select form-control'><option value='none'>Tất cả</option></select>"
        if(type == 1)
            select = "<select id='standard' name='standard' class='custom-select form-control'><option value='0'>Tất cả</option></select>"
        $select = $(select);
        for(var i = 0; i < arr.length; i++)
        {
            $option = '<option value="' + arr[i].option_key + '">' + arr[i].option_value + '</option>';
            $select.append($option);
        }
        return $select;
    }

    function init_first_select() {

        $("body").contents().find("#province").find("select").on("change", function () {
            $("body").contents().find("#ward ul li[data-value!='none']").remove();
            $("body").contents().find("#ward .custom-select a span").text("Tất Cả");
            $.ajax({
                method: "get",
                url: API + 'get-controller/district/' + $(this).val(),
                success: function (html) {
                    $select = make_select_box(html);

                    $("#district").empty();
                    $("#district").append($select);
                    $("#district").append($('<span><i class="fa fa-caret-right"></i></span>'));
                    $("#district").find("select").customselect();
                    init_second_select();
                }
            });
        });
    }

    function init_second_select() {
        $("body").contents().find("#district").find("select").on("change", function () {
            $.ajax({
                method: "post",
                url: API + 'get-controller/ward/' + $(this).val(),
                //data    : { id: $(this).val() },
                success: function (html) {
                    $select = make_select_box(html);

                    $("#ward").empty();
                    $("#ward").append($select);
                    $("#ward").append($('<span><i class="fa fa-caret-right"></i></span>'));

                    $("#ward").find("select").customselect();

                }
            });
        });
    }

    function fill_select(){
        $("#province").find("select").customselect();
        $("#company").find("select").customselect();

        init_first_select();
        $("#district").find("select").customselect();
        $("#ward").find("select").customselect();
    }
    $(".multi-selection li.condition").on("click", function(){
        if(current_selection != null)
            $(current_selection).removeClass("condition-active");
        if(!first_selected){
            set_select(false);
            first_selected = true;
        }
        $(this).toggleClass("condition-active")
        var val = $(this).attr("data");
        var condition = $(this).attr("condition") + "_id";
        var count = 0;
        select[val] = !select[val];

        bounds = new google.maps.LatLngBounds();

        for(var i = 0; i < markers.length; i++){

            if(select[markers[i].data[condition]]){
                markers[i].setMap(map);
                var url = "image.php?source=" + map_icon["type"][markers[i].data["type_id"]] + "&radius=5";
                markers[i].setIcon(url);

                count++;
                bounds.extend(markers[i].position);
            } else {
                markers[i].setMap(null);
            }
        }
        if(count != 0){
            map.fitBounds(bounds);
            snackbar_show(count + " kết quả");
        } else {
            snackbar_show("không có kết quả nào phù hợp");
        }
    });

    var current_selection = null;
    $(".single-selection li.condition").on("click", function(){
        if(current_selection != null)
            $(current_selection).removeClass("condition-active");

        current_selection = this;
        $(this).addClass("condition-active")
        
        var val = $(this).attr("data");
        var condition = $(this).attr("condition");
        var count = 0;

        var condition_id = condition + "_id";
        bounds = new google.maps.LatLngBounds();
        for(var i = 0; i < markers.length; i++){

            if((select[markers[i].data["type_id"]]) && markers[i].data[condition_id] == val){
                var url = "image.php?source=" + map_icon["type"][markers[i].data["type_id"]] + "&radius=15&colour=" + map_icon[condition][val].substr(1, 6);
                markers[i].setIcon(url);
                markers[i].setMap(map);
                count++;
                bounds.extend(markers[i].position);
            } else {
                markers[i].setMap(null);
            }
        }

        if(count != 0){
            map.fitBounds(bounds);
            snackbar_show(count + " kết quả");
        } else {
            snackbar_show("không có kết quả nào phù hợp");
        }
    });

    fill_select();
    getPoint();
    try {
        prev_info = localStorage.getItem("info");
        if(prev_info !== null){
            info1 = JSON.parse(prev_info);
            select(info1);
            localStorage.clear();
        }

    } catch(ex){
        
    }
    jQuery.ajaxSetup({
      beforeSend: function() {
         $('#loader').show();
      },
      complete: function(){
         $('#loader').hide();
      },
      success: function() {}
    });
});