<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content = "initial-scale=1.0, user-scalable=no">
    <meta charset = "utf-8">
    <title>Showing elevation along a path</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map
        {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body
        {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <script src = "https://www.google.com/jsapi"></script>
    <script
        src = "https://code.jquery.com/jquery-3.1.1.min.js"
        integrity = "sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin = "anonymous"></script>

    <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name = "viewport" content = "width=device-width, initial-scale=1, maximum-scale=1">
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
    <!--[if lt IE 9]>
    <script src = "//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src = "https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDH2y8b0SM5NLLOSyI35DI8b2dbfedAZn0"></script>

    <link href = "css/highGround.css" rel = "stylesheet">
</head>
<body>
<div class = "navbar navbar-custom navbar-fixed-top">
    <div class = "navbar-collapse collapse">
        <ul class = "nav navbar-nav">
            <li class = "active"><a href = "highGround">Priority Queue</a></li>
            <li><a href = "navigationContent">High Ground</a></li>
        </ul>
    </div>
</div>
<div>
    <div style = 'height: 150px;'>
        <h2>High Ground</h2>
        <h3>Identifies Highest Elevations in Flooded Area</h3>
        <h4>This corresponds with the locations that flood victims are being navigated via the High Ground phone application</h4>
    </div>
    <div id = "map" style = "height:600px;"></div>
    <div id = "elevation_chart"></div>


    <!-- Begin Script -->
    <script>
        // Load the Visualization API and the columnchart package.
        google.load('visualization', '1', {packages : ['columnchart']});
        function initMap(){
            // The following path marks a path from Mt. Whitney, the highest point in the
            // continental United States to Badwater, Death Valley, the lowest point.
            var path     = getCoords();
// Create an ElevationService.
            var elevator = new google.maps.ElevationService;
            var map      = new google.maps.Map(document.getElementById('map'), {
                zoom : 13,
                center : path[0],
                mapTypeId : 'terrain'
            });
            displayLocationElevation(path, elevator, map)
        }
        function displayLocationElevation(locations, elevator, map){
            // Initiate the location request
            elevator.getElevationForLocations({
                                                  'locations' : locations
                                              }, function(results, status){
                if(status === 'OK'){
                    // Retrieve the first result
                    if(results[0]){
                        $.each(results, function(k, v){
                            this.coords = locations[k];
                        });
                        results.sort(
                            function(x, y){
                                return y.elevation - x.elevation;
                            }
                        );
                        var highest = {elevation : -1};
                        for(i = 0; i < 3; i++){
                            var marker = new google.maps.Marker({
                                position : results[i].coords,
                                map : map,
                                title : 'possible locations'
                            });
                            console.log(results[i]);
                        }
                        $.each(results, function(k, v){
                            if(highest.elevation <= this.elevation){
                                highest = this;
                            }
                        });
                    } else{
                    }
                } else{
                }
            });
        }
        function getCoords(){
            pos           = {};
            pos.lat       = 29.967996;
            pos.lng       = -90.094889;
            var locations = [];
            for(i = -5; i <= 5; i++){
                for(j = -5; j <= 5; j++){
                    var point = {};
                    point.lat = pos.lat + (i / 500);
                    point.lng = pos.lng + (j / 500);
                    locations.push(point);
                }
            }
            return locations;
        }
    </script>
    <script async defer
            src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBUAsqkAKHsdjxzzhzHf5tB37sWpBg1kko&callback=initMap">
    </script>
</div>
</body>
</html>