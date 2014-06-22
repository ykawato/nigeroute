
<!doctype html>

<!--[if lt IE 7]><html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="ja" prefix="og: http://ogp.me/ns#" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>にげるーと</title>


    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="icon" href="./favicon.ico">
    <!--[if IE]>
        <link rel="shortcut icon" href="./favicon.ico">
    <![endif]-->


	<link rel="stylesheet" type="text/css" href="./assets/css/jquery.pageslide.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/screen.css">


   

<link rel='stylesheet' id='map-css'  href='./assets/css/style-map.css' type='text/css' media='all' />
<link rel='stylesheet' id='directions-css'  href='./assets/css/directions.css' type='text/css' media='all' />
<link rel='stylesheet' id='jquery.pageslide-css'  href='./assets/css/jquery.pageslide.css' type='text/css' media='all' />
<link rel='stylesheet' id='screen-css'  href='./assets/css/screen.css' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css'  href='./assets/css/bootstrap.css' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-theme-css'  href='./assets/css/bootstrap-theme.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='my_style-css'  href='./assets/css/style-shonan.css' type='text/css' media='all' />
<script type='text/javascript' src='./assets/js/jquery/jquery.js'></script>
<script type='text/javascript' src='//www.google.com/jsapi'></script>
<script type='text/javascript' src='./assets/js/jquery.pageslide.min.js'></script>

	<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false&language=ja"></script>

	<style type="text/css">

        .entry-content img {max-width: 100000%; /* override */}

    </style> 


</head>

<body class="page page-id-943 page-child parent-pageid-941 page-template-default logged-in page-nigeroute">




<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://shonan.livinglocal.jp">湘南エリア情報局</a>
        </div>
        <div class="collapse navbar-collapse">
<ul id="menu-mainmenu" class="nav navbar-nav"><li id="menu-item-945" class="menu-item menu-item-type-post_type menu-item-object-page current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor menu-item-has-children dropdown"><a href="http://shonan.livinglocal.jp/maps/" data-toggle="dropdown" data-target="#" class="dropdown-toggle">地図 <span class="caret"></span></a>
<ul class="dropdown-menu">
	<li id="menu-item-946" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-943 current_page_item active menu-item-946"><a href="http://shonan.livinglocal.jp/maps/nigeroute/">にげるーと</a></li>
	<li id="menu-item-1641" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1641"><a href="http://shonan.livinglocal.jp/venue_search/">お店検索</a></li>
	<li id="menu-item-1068" class="menu-item menu-item-type-taxonomy menu-item-object-event_area menu-item-1068"><a href="http://shonan.livinglocal.jp/area/%e6%97%a5%e6%9c%ac/%e7%a5%9e%e5%a5%88%e5%b7%9d%e7%9c%8c/">神奈川イベントマップ</a></li>
</ul>
</li>
<li id="menu-item-1043" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1043"><a href="http://shonan.livinglocal.jp/post_request/">掲載依頼フォーム</a></li>
</ul>        </div><!--/.nav-collapse -->
    </div>
</div>


    <div class="container" >



<script type="text/javascript" src="//www.google.com/jsapi"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="./assets/js/mymaps.js"></script>

<script>


function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

var markersArray = [];

function getNearestRefuge(){

    $.ajax({
        url: "http://linkdata.org/api/1/rdf1s1511i/refuge_rdf.json",
        type: "POST",
        dataType: "jsonp"

    }).done( function(data){

        // plot these on map
        $.each( data, function( key, array ){
            var this_refuge = new Array;
            

            $.each( array, function (key2, array2){

                if( endsWith( key2, '#title' ) ){
                    this_refuge['title'] = array2[0].value;
                }
                else if( endsWith( key2, '#label' ) ){
                    this_refuge['label'] = array2[0].value;
                }
                else if( endsWith( key2, '#address' ) ){
                    this_refuge['address'] = array2[0].value;
                }
                else if( endsWith( key2, '#lat' ) ){
                    this_refuge['lat'] = array2[0].value;
                }
                else if( endsWith( key2, '#long' ) ){
                    this_refuge['long'] = array2[0].value;
                }
                else if( endsWith( key2, '#altitude' ) ){
                    this_refuge['altitude'] = array2[0].value;
                }
                
                
            })


            if ( this_refuge.altitude < 10) 
                var refugeImage = './assets/images/danger.png';
            else if ( this_refuge.altitude < 20) 
                var refugeImage = './assets/images/warn.png';
            else if ( this_refuge.altitude >= 20) 
                var refugeImage = './assets/images/safe.png';
            
            var myLatlng = new google.maps.LatLng( this_refuge.lat, this_refuge.long);

            
            var content = this_refuge.title + "<br />";
            if( this_refuge.altitude != null )
                content += "（標高 " + Math.round(this_refuge.altitude) + " m）<br /> ";
            content += "<a onclick='calcRoute(" + this_refuge.lat + "," + this_refuge.long + ");'>ここへ行く</a>";

            var openWindowFn;
            var closure = function(content, myLatlng){
                openWindowFn = function()
                {
                    if (infowindow)
                    {
                        infowindow.close();
                    }
                    infowindow = new google.maps.InfoWindow({
                        position:myLatlng,
                        content:content
                    });
                    infowindow.open(map, marker);
                }
            }(content, myLatlng);
            
            var marker = new google.maps.Marker({
                position: myLatlng,
                zIndex:100,
                icon: refugeImage
            });

            google.maps.event.addListener(marker, 'click', openWindowFn);
           
            
            markersArray.push(marker);
            // To add the marker to the map, call setMap();
            marker.setMap(map);

        })
        
    });

}



var dest_lat0, dest_lng0
function calcRoute(dest_lat, dest_lng) {

    dest_lat = dest_lat === undefined ? dest_lat0 : dest_lat;
    dest_lng = dest_lng === undefined ? dest_lng0 : dest_lng;
    

    dest_lat0 = dest_lat;
    dest_lng0 = dest_lng;
    
    // First, remove any existing markers from the map.
    for (var i = 0; i < markerArray.length; i++) {
        markerArray[i].setMap(null);
    }

    // Now, clear the array itself.
    markerArray = [];

    if( currentLocation == undefined )
        getCurrentLocation();
    
    // Retrieve the start and end locations and create
    // a DirectionsRequest using WALKING directions.
    var start = currentLocation;//document.getElementById('start').value;
    var end = new google.maps.LatLng(dest_lat, dest_lng);//document.getElementById('end').value;
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.WALKING
    };


    travelMode = 'walking';   
    switch (travelMode) {
      case "bicycling":
        request.travelMode = google.maps.DirectionsTravelMode.BICYCLING;
        break;
      case "driving":
        request.travelMode = google.maps.DirectionsTravelMode.DRIVING;
        break;
      case "walking":
        request.travelMode = google.maps.DirectionsTravelMode.WALKING;
        break;
    }



    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {



            var warnings = document.getElementById('warnings_panel');
            warnings.innerHTML = '<b>' + response.routes[0].warnings + '</b>';
            directionsDisplay.setDirections(response);

            directionsDisplay.setPanel(document.getElementById('directions'));
            directionsDisplay.setPanel(document.getElementById('directions-panel'));

            showSteps(response);
        }else if (status == google.maps.DirectionsStatus.ZERO_RESULTS) {
            alert("Could not find a route between these points");
        } else {
            alert("Directions request failed");
        }

    });
    
    updateElevation();
    
    
    $('.ui-panel-position-right').html('');
    $('#michijun').show();

    // 標高を表示
    window.setTimeout(showAltitude,1000)
}


function updateElevation() {
    if (markerArray.length > 1) {
        var travelMode = 'walking';

        var latlngs = [];
        for (var i in markers) {
            latlngs.push(markers[i].getPosition())
        }
    }
}

function plotElevation(results) {
//    $('.second.rightopen').click();
}
  
// Remove the green rollover marker when the mouse leaves the chart
function clearMouseMarker() {
    if (mousemarker != null) {
        mousemarker.setMap(null);
        mousemarker = null;
    }
}


var bounds;
var overlayPngs = new Array();
var rows=4;
var cols=4;

function showAltitude(){
    // clear
    while(overlayPngs[0])
    {
        overlayPngs.pop().setMap(null);
    }

    bounds = map.getBounds(); 

    var cell_height = ( bounds.getNorthEast().lat() - bounds.getSouthWest().lat()  ) / rows;
    var cell_width = (bounds.getNorthEast().lng()    - bounds.getSouthWest().lng() ) / cols;

    for (var i_row=0; i_row<rows; i_row++)
    { 
        for (var i_col=0; i_col<rows; i_col++)
        { 
            // get center coordinate
            var cell_lat = bounds.getSouthWest().lat() + cell_height*( rows - (i_row + 0.5) );
            var cell_lng = bounds.getSouthWest().lng() + cell_width*( cols - (i_col + 0.5) );
        
            // get altitude 
            get_altitude(i_row, i_col, cell_lat, cell_lng, bounds);
        }
        
    }

}



function get_altitude(i_row,i_col,cell_lat,cell_lng, bounds){

    var url = "http://cyberjapandata2.gsi.go.jp/general/dem/scripts/getelevation.php?callback=myfunc&lat=" + cell_lat + "&lon=" + cell_lng ;
    $.ajax({
        type: "POST",
        url: url,
        jsonpCallback: 'altdata' + i_row + '_' + i_col,
        contentType: "application/json",
        dataType: 'jsonp'   
    }).done(function(data){
        obj = data;
        
        $('#cell_' + i_row + '-' + i_col).html(' (' + cell_lat + ', ' + cell_lng + ' <br />alt: ' + obj.elevation);

        // overlay
        var cell_height = ( bounds.getNorthEast().lat() - bounds.getSouthWest().lat()  ) / rows;
        var cell_width = (bounds.getNorthEast().lng()    - bounds.getSouthWest().lng() ) / cols;

        var SW_lat = bounds.getSouthWest().lat() + cell_height*( rows - (i_row ) );
        var SW_lng = bounds.getSouthWest().lng() + cell_width*( cols - (i_col ) );
        var NE_lat = bounds.getSouthWest().lat() + cell_height*( rows - (i_row + 1) );
        var NE_lng = bounds.getSouthWest().lng() + cell_width*( cols - (i_col + 1) );

        var imageBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(NE_lat, NE_lng),
            new google.maps.LatLng(SW_lat, SW_lng)
        );

        var overlayOpts = {
            opacity:0.3
        }            

        var oldmap = new google.maps.GroundOverlay("http://shonan.livinglocal.jp/generate_png.php?alt=" + obj.elevation,imageBounds, overlayOpts);
        overlayPngs.push(oldmap);
        overlayPngs[ overlayPngs.length-1 ].setMap(map);

    });
}


google.maps.event.addDomListener(window, 'load', initialize);


</script>



    <header style="height:70px;">
        <table style="width:100%;height:80px;">
            <tr>
            <td style="width:10%;">&nbsp;</td>
            <th style="text-align:center;">
                <img src="http://shonan.livinglocal.jp/assets/images/title_logo.png" alt="title_logo" width="144" height="43">
            </th><td style="width:10%;">
                <a href="http://shonan.livinglocal.jp/nigeroute-howto/">
                <span class="right glyphicon glyphicon-info-sign" style="font-size:26px;"></span>
                </a>
            </td>
            </tr>
        </table>
    </header>


    <header style="height:34px;">

    <div class="row" style="margin-top:0px;" >
        <div class="col-xs-4" style="background-color:red;padding-left:0px;padding-right:0px;">
            <center>
                <img src="http://shonan.livinglocal.jp/assets/images/danger.png" style="width:20px;height:auto;" />
                10m未満
            </center>
        </div>
        <div class="col-xs-4" style="background-color:yellow;padding-left:0px;padding-right:0px;">
            <center>
                <img src="http://shonan.livinglocal.jp/assets/images/warn.png"  style="width:20px;height:auto;" />
                10〜20m
            </center>
        </div>
        <div class="col-xs-4" style="background-color:green;padding-left:0px;padding-right:0px;">
            <center>
                <img src="http://shonan.livinglocal.jp/assets/images/safe.png"  style="width:20px;height:auto;" />
                20m以上
            </center>
        </div>
    </div>

    </header>


    <div style="width:100%;background-color:inherit;">
        <div class="row" style="padding:15px;">
            <div class="col-xs-4">
                <center>
                    <button type="button" id="btnGetCurrentLocation" class="btn btn-success" onclick="getCurrentLocation()">1.現在位置</button>
                </center>

            </div>
            <div class="col-xs-4">
                <center>
                    <button type="button" class="btn btn-success" onclick="getNearestRefuge()">2.避難所</button>
                </center>
            </div>
            <div class="col-xs-4">
                <center>
                    <button type="button" class="btn btn-success" onclick="showAltitude()">3.標高</button>
                </center>
            </div>
        </div>
    </div>

    <div id="map-canvas">

        <p></p>
        
    </div>
    
    

    <div style="width:100%;background-color:inherit;">
    
    <div class="row" id="michijun" style="text-align:center;padding:10px;color:#fff;display:none;">

        <div class="col-xs-6">
            <center>
                <a href="#rightmodal" class="btn btn-success navi_open second rightopen ui-link" style="width:100%;">4.道順の詳細</a>
            </center>
        </div>

        <div class="col-xs-6">
            <center>
                <a onclick="calcRoute();" class="btn btn-success navi_open second rightopen ui-link" style="width:100%;">5.ここから行く</a>
            </center>
        </div>

    </div>
    </div>    
    <footer>
        <p>にげるーと by 湘南Apps!</p>
    </footer>
    

    
    <!--右ナビゲーション-->
    <div id="rightmodal">


        <ul class="rightul">       
            <li class="slide_close"><a href="javascript:$.pageslide.close()" class="glyphicon glyphicon-indent-left">&nbsp;閉じる</a></li>
        </ul>

        <div id='directions-panel'></div>

        <div id="warnings_panel" style="display:none;" ></div>
        
        <ul class="rightul">       
            <li class="slide_close"><a href="javascript:$.pageslide.close()" class="glyphicon glyphicon-indent-left">&nbsp;閉じる</a></li>
        </ul>

    </div>



</div><!-- .container -->

    <script src="./assets/js/jquery.pageslide.min.js"></script>
    <script>
        $(".first").pageslide();
        $(".second").pageslide({direction: "left", modal: true});
    </script>


<script type='text/javascript' src='./assets/js/bootstrap.min.js'></script>


</body>

</html>
