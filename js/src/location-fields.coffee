$ = jQuery
$ ->

	# Save DOM elements for easy retrieval
	locationFields = $("#_ac_program-address, #_ac_program-city, #_ac_program-state, #_ac_program-country")
	coordinatesField = $("#_ac_program-coordinates")
	formattedAddress = $("#_ac_program-formatted-address")
	publishButton = $("#publish")

	# Changes the coordinates and formatted address in hidden fields
	# Calls Google Maps Geocoding service
	changeCoordinates = ->

		# Get the values of each address field
		fieldValues =
			street: $("#_ac_program-address").val()
			city: $("#_ac_program-city").val()
			state: $("#_ac_program-state").val()
			country: $("#_ac_program-country").val()

		# Concatenate the address fields in an un-formatted string
		dirtyAddress = "#{fieldValues.street}, #{fieldValues.city}, #{fieldValues.state}, #{fieldValues.country}"

		# Parameters to be sent to Google
		data = 
			address: dirtyAddress
			sensor: false

		# The URL for the Geocoding service
		url = "http://maps.googleapis.com/maps/api/geocode/json"

		# Call the Geocoding service
		$.get url, data, (response) ->
			respCoords = response.results[0].geometry.location
			coordinates = "#{respCoords.lat}, #{respCoords.lng}"
			address = response.results[0].formatted_address

			# Change the hidden field values
			coordinatesField.val(coordinates)
			formattedAddress.val(address)

			# Re-enable the publish button
			publishButton.removeAttr("disabled")	


	# Call changeCoordinates when an address field is changed
	locationFields.keyup ->
		publishButton.attr("disabled", "disabled")
		clearTimeout timer
		timer = setTimeout changeCoordinates, 4000

	# Go ahead and call changeCoordinates once when the page is loaded.
	# Should set the hidden fields when a submission is reviewed.
	# Also disables the publish button until the AJAX call is complete
	publishButton.attr("disabled", "disabled")
	setTimeout changeCoordinates, 1000

