# Get things organized, fool!
Coals = {}
Coals.Model = {}
Coals.Collection = {}
Coals.View = {}
Coals.Part = {}

# The Map model
Coals.Model.Map = Backbone.Model.extend
	defaults:
		id: ''
		currentLatLng: {}
		mapOptions: {}
		map: {}
		position: {}
		zoom: 2
		maxZoom: 10
		minZoom: 2

	initMap: (position) ->
		this.set 'position', position
		currentLatLng = new google.maps.LatLng position.coords.latitude, position.coords.longitude
		this.set 'currentLatLng', currentLatLng

		mapOptions = 
			zoom: this.get('zoom')
			minZoom: this.get('minZoom')
			maxZoom: this.get('maxZoom')
			center: currentLatLng
			mapTypeId: google.maps.MapTypeId.ROADMAP
			mapTypeControl: false

		this.set 'mapOptions', mapOptions

# The map view. This is what's called to render the map.
Coals.View.Map = Backbone.View.extend
	defaults:
		region: 'us'
		language: 'en'

	id: 'study-abroad-map'

	initialize: ->
		this.model.set 'map', new google.maps.Map this.el, this.model.get('mapOptions')

	render: ->
		$("#" + this.id).replaceWith this.el
		return this

# The location model
Coals.Model.Location = Backbone.Model.extend {}

# The location collection. This is what contains all of the
# locations and corresponding data when fetched.
Coals.Collection.Location = Backbone.Collection.extend
	model: Coals.Model.Location
	url: url.ajax

	initialize: ->
		this.on 'remove', this.hideLocation

	hideLocation: (location) ->
		location.trigger 'hide'

# The location collection-view. Takes care of the iteration over
# the location collection
Coals.View.LocationList = Backbone.View.extend
	initialize: ->
		this.collection.on 'add', this.addMarker, this
		this.collection.on 'reset', this.addAllMarkers, this

	addAllMarkers: ->
		this.collection.forEach this.addMarker, this

	addMarker: (location) ->
		locationView = new Coals.View.Location
			model: location
		locationView.render this.options.map

	render: ->
		this.addAllMarkers

# The individual view for each location.
Coals.View.Location = Backbone.View.extend
	initialize: ->
		this.model.on 'hide', this.remove, this

		# The data to pass along to the InfoBox
		this.data =
			title: this.model.get 'title'
			link: this.model.get 'permalink'
			address: this.model.get 'address'
			imageUrl: this.model.get 'image_url'
			times: this.model.get 'times'
			type: this.model.get 'type'

	render: (map)->
		@map = map
		coords = @model.get('coordinates').split(", ")
		@markerLatLng = new google.maps.LatLng coords[0], coords[1]
		@marker = new google.maps.Marker
			position: @markerLatLng
			title: @data.title

		@marker.setMap map
		@makeInfoBox()

	makeInfoBox: ->
		locationData = @data
		options =
			closeBoxMargin: "8px"
			boxStyle: {}


		infoView = new Coals.View.InfoBox
			attributes: locationData

		@infoContent = infoView.render()

		# Using the global Coals.InfoBox for each marker.
		# This allows InfoBoxes to self-close.
		# Rewrites the InfoBox content on each click
		google.maps.event.addListener @marker, 'click', =>
			# Reset the InfoBox class
			options.boxClass = "infoBox"

			# Set the background image and add a class if it exists
			if locationData.imageUrl?
				options.boxStyle.background = "url('#{locationData.imageUrl}') no-repeat"
				options.boxClass = "infoBox has-image"

			Coals.Part.InfoBox.setContent( @infoContent )
			Coals.Part.InfoBox.setOptions( options )
			Coals.Part.InfoBox.open @map, @marker

		# Close info window if the map is clicked
		google.maps.event.addListener @map, 'click', =>
			Coals.Part.InfoBox.close()

Coals.View.InfoBox = Backbone.View.extend
	className: "location-window"
	template: _.template '<a href="<%= link %>"><h3><%= title %></h3></a>
		<p><%= address %></p>
		<p><%= type %></p>
		<p><strong>Times Offered:</strong>
		<% _.each(times, function(time) { %> <%= time %><% }); %>
		</p>'

	render: ->
		content = this.$el.html(this.template(this.attributes))
		# Since this.$el.html() spits out an array, we need to pick out the element
		_.first content

# Now to make it all happen
$ ->
	# Setup the map
	Coals.Part.map = new Coals.Model.Map
		zoom: 2

	# Initialize the map model
	Coals.Part.map.initMap
		coords:
			latitude: 23.241346
			longitude: 24.609375

	# Setup the map view
	Coals.Part.mapView = new Coals.View.Map
		model: Coals.Part.map

	# Show the map on the page!
	Coals.Part.mapView.render()

	# Setup the location collection and get locations from the server
	Coals.Part.locationList = new Coals.Collection.Location()
	Coals.Part.locationList.fetch
		data:
			action: 'get_locations' # Custom AJAX action identifier in WP

	# Initialize the global InfoBox
	Coals.Part.InfoBox = new InfoBox()

	# Setup the location collection-view.
	# This renders each location as a marker on the map
	# Any non-core attribute will be accessible through this.options.<name>
	Coals.Part.locationListView = new Coals.View.LocationList
		collection: Coals.Part.locationList # Gotta feed our collection into the view
		map: Coals.Part.map.get 'map' # Pass along the map object
