var $;

$ = jQuery;

$(function() {
  var changeCoordinates, coordinatesField, formattedAddress, locationFields, publishButton;
  locationFields = $("#_ac_program-address, #_ac_program-city, #_ac_program-state, #_ac_program-country");
  coordinatesField = $("#_ac_program-coordinates");
  formattedAddress = $("#_ac_program-formatted-address");
  publishButton = $("#publish");
  changeCoordinates = function() {
    var data, dirtyAddress, fieldValues, url;
    fieldValues = {
      street: $("#_ac_program-address").val(),
      city: $("#_ac_program-city").val(),
      state: $("#_ac_program-state").val(),
      country: $("#_ac_program-country").val()
    };
    dirtyAddress = "" + fieldValues.street + ", " + fieldValues.city + ", " + fieldValues.state + ", " + fieldValues.country;
    data = {
      address: dirtyAddress,
      sensor: false
    };
    url = "http://maps.googleapis.com/maps/api/geocode/json";
    return $.get(url, data, function(response) {
      var address, coordinates, respCoords;
      respCoords = response.results[0].geometry.location;
      coordinates = "" + respCoords.lat + ", " + respCoords.lng;
      address = response.results[0].formatted_address;
      coordinatesField.val(coordinates);
      formattedAddress.val(address);
      return publishButton.removeAttr("disabled");
    });
  };
  locationFields.keyup(function() {
    var timer;
    publishButton.attr("disabled", "disabled");
    clearTimeout(timer);
    return timer = setTimeout(changeCoordinates, 4000);
  });
  publishButton.attr("disabled", "disabled");
  return setTimeout(changeCoordinates, 1000);
});

/*
//@ sourceMappingURL=location-fields.js.map
*/