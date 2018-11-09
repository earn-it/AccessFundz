<!-- Default JS (DO NOT TOUCH) -->

  <br clear="all" />
  <div style="padding-bottom: 50px;">
  <span style='visibility: hidden;'>Access Fundz 2017.</style>
  </div>
  <script src="../code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="../ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>
  <script src="lib/js/hogan.min.js"></script>
  <script src="lib/js/typeahead.min.js"></script>
  <script src="lib/js/typeahead-example.js"></script>
  
  <!-- Adjustable JS -->
  <script src="lib/js/soft-widgets.js"></script>
  <script src="lib/js/flot/jquery.flot.js"></script>
  <script src="lib/js/flot/jquery.flot.selection.js"></script>
  <script src="lib/js/icheck.js"></script>
  <script type='text/javascript' src='https://www.google.com/jsapi'></script> 
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJEVoE5Ix-7HPh0OJWDLV0LgnaFAVslmE&amp;sensor=true"></script> 
  <script>
   
   $(function() {
    $( ".sortable" ).sortable({
     placeholder: "sort-highlight"
    });
    $( ".sortable" ).disableSelection();
   });
   
   var  maptwo;

   function getChartWindow(mrk){
    var contentString = '<div style="width:200px;color:#448fba;border-bottom:1px solid #DDD; font-size:14px; ">Chart Window</div><div style="width:200px;margin-top:10px;"><iframe style="width:200px;height:180px;border:0;margin:0;padding:0;overflow:hidden;" src="maps_iframe.html"></iframe></div>';
    var infowindow = new google.maps.InfoWindow({ content: contentString, maxWidth: 200  });
    infowindow.open(maptwo,mrk);
   }
   
   function initializetwo() {   
    var mapOptionstwo = {          
     center: new google.maps.LatLng(35.2269, -80.8433),          
     zoom: 12       
    };  
    
    maptwo = new google.maps.Map(document.getElementById("map-canvastwo"), mapOptionstwo);
    
    for(var i=0; i < 20; i++){
     var ran1 = Math.random()/7; if(Math.random() > 0.5) { ran1 = ran1*(0-1); }
     var ran2 = Math.random()/7; if(Math.random() > 0.5) { ran2 = ran2*(0-1); }

     var myLatlng = new google.maps.LatLng(35.2269 + ran1, -80.8433 + ran2);
     var image = 'lib/img/map-icons/chart-2.png';
     var marker = new google.maps.Marker({ position: myLatlng, map: maptwo, icon: image});
     
     google.maps.event.addListener(marker, 'click', function() {  getChartWindow(this);  });
     
    }    
   }
   google.maps.event.addDomListener(window, 'load', initializetwo);

   function drawFlot(){

    var data = [{
     label: "Volume", bars: { show: true, barWidth: 0.5 }, points: {show: false},
     data: [[0, 187654], [2, 252342], [4, 323456], [6, 34154], [8, 125550], [10, 425413]]
    }, {
     label: "Users", bars: { show: true, barWidth: 0.5 }, points: {show: false}, yaxis: 2,
     data: [[0.5, 13.4], [2.5, 12.2], [4.5, 10.6], [6.5, 87], [8.5, 41], [10.5, 38]]
    }, {
     label: "Normalization", lines: { show: true }, points: {show: true},  yaxis: 3,
     data: [[0.5, 50], [2.5, 55], [4.5, 48], [6.5, 41], [8.5, 57], [10.5, 37]]
    }];

    var options = {
     series: {

     },
     colors: [ '#E48784', '#7BAEDA', '#F2BA68'],
     legend: {
      noColumns: 2
     },
     xaxis: { min:-0.5, max:11.5,
      ticks: [
       [ 0.5, "iPhone 3" ],
       [ 2.5, "iPhone 3GS" ], 
       [ 4.5, "iPhone 4" ],
       [ 6.5, "iPhone 4S" ], 
       [ 8.5, "iPhone 5" ],
       [ 10.5, "iPhone 5S" ]
      ]
     },
     yaxes: [{ min: 0 }, {position: "right", alignTicksWithAxis: 1 }, {show: false, min:0, max:100}],
     selection: {
      mode: "x"
     }
    };

    var placeholder = $("#placeholder");

    placeholder.bind("plotselected", function (event, ranges) {

     $("#selection").text(ranges.xaxis.from.toFixed(1) + " to " + ranges.xaxis.to.toFixed(1));

     var zoom = $("#zoom").attr("checked");

     if (zoom) {
      plot = $.plot(placeholder, data, $.extend(true, {}, options, {
       xaxis: {
        min: ranges.xaxis.from,
        max: ranges.xaxis.to
       }
      }));
     }
    });

    placeholder.bind("plotunselected", function (event) {
     $("#selection").text("");
    });

    var plot = $.plot(placeholder, data, options);

    $("#clearSelection").click(function () {
     plot.clearSelection();
    });

    plot.setSelection({
      xaxis: {
       from: 3.5,
       to: 5.5
      }
     });

    // Add the Flot version string to the footer

   }

   $( window ).resize(function() {
    drawFlot();
   });
   
   $(document).ready(function() { 
    $('.flat-checkbox').iCheck({
     checkboxClass: 'icheckbox_flat-purple',
     radioClass: 'iradio_flat-purple'
    });
    drawFlot();
   });
   
   google.load('visualization', '1', {'packages': ['geomap']});
     google.setOnLoadCallback(drawMapThree);

   function drawMapThree() {
     var data = google.visualization.arrayToDataTable([
    ['State', 'Population'],
    ['US-AL', 4779736],
    ['US-AK', 710231],
    ['US-AZ', 6392017],
    ['US-AR', 2915918],
    ['US-CA', 37253956],
    ['US-CO', 5029196],
    ['US-CT', 3574097],
    ['US-DE', 897934],
    ['US-FL', 18801310],
    ['US-GA', 9687653],
    ['US-HI', 1360301],
    ['US-ID', 1567582],
    ['US-IL', 12830632],
    ['US-IN', 6483802],
    ['US-IA', 3046355],
    ['US-KS', 2853118],
    ['US-KY', 4339367],
    ['US-LA', 4533372],
    ['US-ME', 1328361],
    ['US-MD', 5773552],
    ['US-MA', 6547629],
    ['US-MI', 9883640],
    ['US-MN', 5303925],
    ['US-MS', 2967297],
    ['US-MO', 5988927],
    ['US-MT', 989415],
    ['US-NE', 1826341],
    ['US-NV', 2700551],
    ['US-NH', 1316470],
    ['US-NJ', 8791894],
    ['US-NM', 2059179],
    ['US-NY', 19378102],
    ['US-NC', 9535483],
    ['US-ND', 672591],
    ['US-OH', 11536504],
    ['US-OK', 3751351],
    ['US-OR', 3831074],
    ['US-PA', 12702379],
    ['US-RI', 1052567],
    ['US-SC', 4625364],
    ['US-SD', 814180],
    ['US-TN', 6346105],
    ['US-TX', 25145561],
    ['US-UT', 2763885],
    ['US-VT', 625741],
    ['US-VA', 8001024],
    ['US-WA', 6724540],
    ['US-WV', 1852994],
    ['US-WI', 5686986],
    ['US-WY', 563626]
     ]);

     var options = {};
     options['region'] = 'US';
     options['dataMode'] = 'regions';
     options['colors'] = [0xB4D1EA, 0x7BAEDA, 0x357ebd];

     var container = document.getElementById('map-canvasthree');
     var geomap = new google.visualization.GeoMap(container);
     geomap.draw(data, options);
    };
  
  </script>

 </body>


</html>