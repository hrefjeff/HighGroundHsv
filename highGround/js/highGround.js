$(function(){

    var pinDetailsTemplate = $("#pinDetailsTemplate").html();
    var sendMessageTemplate = $("#sendMessageTemplate").html();

    $(document).on('click', "button[name = 'sendMessage']", send_message);
    $(document).on('click', "button[name = 'viewImages']", showImages);

    myMap();

    /**
     *
     */
    function myMap(){
        var mapProp    = {
            center : new google.maps.LatLng(29.950513, -90.074139),
            zoom : 15
        };
        var map        = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
        var queueItems = $('.queueItem');
        $.each(queueItems, function(key, value){
            var lat      = parseFloat($(value).find("input[name = 'lat']").val());
            var lng      = parseFloat($(value).find("input[name = 'lng']").val());
            var myLatlng = {lat : lat, lng : lng};
            var marker   = new google.maps.Marker({
                position : myLatlng,
                map : map
            });
            marker.addListener('click', function(){
                showPopUp(marker.position.lat(), marker.position.lng());
            });
        });
    }

    /**
     *
     * @param latLng
     * @param map
     */
    function placeMarker(latLng, map){
        var marker = new google.maps.Marker({
            position : latLng,
            map : map
        });
    }

    /**
     * 
     * @param lat
     * @param lng
     */
    function showPopUp(lat, lng){
        var data = {};
        data.p   = 'getPopUpData';
        data.lat = lat;
        data.lng = lng;
        $.post("highGround", data)
         .done(function(json){
             var data = $.parseJSON(json);
             if(data.error){
                 addStatusMessageToContainer($("#page_modal_container"), data.error_message, "red", false);
             } else{
                 var rendered    = Mustache.render(pinDetailsTemplate, data.data);
                 var container   = $("#pageModalContainer");
                 container.html(rendered);
                 container.dialog({
                                      modal : true,
                                      position : {my : "center", at : "center", of : window},
                                      dialogClass : "styled_modal",
                                      width : 520,
                                      title : 'Lat: ' + lat + ', Lng: ' + lng
                                  });
             }
         })
         .fail(function(){
             addStatusMessageToContainer($("#page_modal_container"), "Unable to process request. Please try again.", "red", false);
         });
    }

    /**
     *
     */
    function send_message(){
        debugger;
        var rendered    = Mustache.render(sendMessageTemplate);
        var container   = $("#pageModalContainer");
        container.html(rendered);
        container.dialog({
                             modal : true,
                             position : {my : "center", at : "center", of : window},
                             dialogClass : "styled_modal",
                             width : 520,
                             title : 'Send Message'
                         });
    }

    function showImages(self){
        self = $(this);
        var imageContainer = self.closest("div").find("div[name = 'pinImages']");
        imageContainer.show();
    }

});

