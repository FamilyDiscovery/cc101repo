
    function initialize() {

        var input0 = /** @type {HTMLInputElement} */(
            document.getElementById('autocomplete0'));

        var autocomplete0 = new google.maps.places.Autocomplete(input0);

        google.maps.event.addListener(autocomplete0, 'place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
        });

        var input1 = /** @type {HTMLInputElement} */(
            document.getElementById('autocomplete1'));

        var autocomplete1 = new google.maps.places.Autocomplete(input1);

        google.maps.event.addListener(autocomplete1, 'place_changed', function () {
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

        var input3 = /** @type {HTMLInputElement} */(
            document.getElementById('autocomplete3'));

        var autocomplete3 = new google.maps.places.Autocomplete(input3);

        google.maps.event.addListener(autocomplete3, 'place_changed', function () {
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
