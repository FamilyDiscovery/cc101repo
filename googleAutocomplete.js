
    function initialize() {

        var input = /** @type {HTMLInputElement} */(
            document.getElementById('autocomplete'));

        var autocomplete = new google.maps.places.Autocomplete(input);


        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
        });

        var input2 = /** @type {HTMLInputElement} */(
            document.getElementById('autocomplete2'));

        var autocomplete2 = new google.maps.places.Autocomplete(input2);

        google.maps.event.addListener(autocomplete2, 'place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
        });
    }


google.maps.event.addDomListener(window, 'load', initialize);
