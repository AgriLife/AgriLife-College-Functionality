var Coals;

Coals = {};

Coals.Model = {};

Coals.Collection = {};

Coals.View = {};

Coals.Part = {};

Coals.Url = {
  Ajax: url.ajax
};

Coals.Model.Map = Backbone.Model.extend({
  defaults: {
    id: '',
    currentLatLng: {},
    mapOptions: {},
    map: {},
    position: {},
    zoom: 2,
    maxZoom: 10,
    minZoom: 2
  },
  initMap: function(position) {
    var currentLatLng, mapOptions;
    this.set('position', position);
    currentLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    this.set('currentLatLng', currentLatLng);
    mapOptions = {
      zoom: this.get('zoom'),
      minZoom: this.get('minZoom'),
      maxZoom: this.get('maxZoom'),
      center: currentLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false
    };
    return this.set('mapOptions', mapOptions);
  }
});

Coals.View.Map = Backbone.View.extend({
  defaults: {
    region: 'us',
    language: 'en'
  },
  id: 'study-abroad-map',
  initialize: function() {
    return this.model.set('map', new google.maps.Map(this.el, this.model.get('mapOptions')));
  },
  render: function() {
    $("#" + this.id).replaceWith(this.el);
    return this;
  }
});

Coals.Model.Location = Backbone.Model.extend({});

Coals.Collection.Location = Backbone.Collection.extend({
  model: Coals.Model.Location,
  url: Coals.Url.Ajax,
  data: {
    action: 'get_locations'
  },
  initialize: function() {
    return this.on('remove', this.hideLocation);
  },
  hideLocation: function(location) {
    return location.trigger('hide');
  }
});

Coals.View.LocationList = Backbone.View.extend({
  initialize: function() {
    this.collection.on('add', this.addMarker, this);
    return this.collection.on('reset', this.addAllMarkers, this);
  },
  addAllMarkers: function() {
    return this.collection.forEach(this.addMarker, this);
  },
  addMarker: function(location) {
    var locationView;
    locationView = new Coals.View.Location({
      model: location
    });
    return locationView.render(this.options.map);
  },
  render: function() {
    return this.addAllMarkers;
  }
});

Coals.View.Location = Backbone.View.extend({
  initialize: function() {
    this.model.on('hide', this.remove, this);
    return this.data = {
      title: this.model.get('title'),
      link: this.model.get('permalink'),
      address: this.model.get('address'),
      imageUrl: this.model.get('image_url'),
      times: this.model.get('times'),
      type: this.model.get('type')
    };
  },
  render: function(map) {
    var coords;
    this.map = map;
    coords = this.model.get('coordinates').split(", ");
    this.markerLatLng = new google.maps.LatLng(coords[0], coords[1]);
    this.marker = new google.maps.Marker({
      position: this.markerLatLng,
      title: this.data.title
    });
    this.marker.setMap(map);
    return this.makeInfoBox();
  },
  makeInfoBox: function() {
    var infoView, locationData, options,
      _this = this;
    locationData = this.data;
    options = {
      closeBoxMargin: "8px",
      boxStyle: {}
    };
    infoView = new Coals.View.InfoBox({
      attributes: locationData
    });
    this.infoContent = infoView.render();
    google.maps.event.addListener(this.marker, 'click', function() {
      options.boxClass = "infoBox";
      if (locationData.imageUrl != null) {
        options.boxStyle.background = "url('" + locationData.imageUrl + "') no-repeat";
        options.boxClass = "infoBox has-image";
      }
      Coals.Part.InfoBox.setContent(_this.infoContent);
      Coals.Part.InfoBox.setOptions(options);
      return Coals.Part.InfoBox.open(_this.map, _this.marker);
    });
    return google.maps.event.addListener(this.map, 'click', function() {
      return Coals.Part.InfoBox.close();
    });
  }
});

Coals.View.InfoBox = Backbone.View.extend({
  className: "location-window",
  template: _.template('<a href="<%= link %>"><h3><%= title %></h3></a>\
		<p><%= address %></p>\
		<p><%= type %></p>\
		<p><strong>Times Offered:</strong>\
		<% _.each(times, function(time) { %> <%= time %><% }); %>\
		</p>'),
  render: function() {
    var content;
    content = this.$el.html(this.template(this.attributes));
    return _.first(content);
  }
});

$(function() {
  Coals.Part.map = new Coals.Model.Map({
    zoom: 2
  });
  Coals.Part.map.initMap({
    coords: {
      latitude: 23.241346,
      longitude: 24.609375
    }
  });
  Coals.Part.mapView = new Coals.View.Map({
    model: Coals.Part.map
  });
  Coals.Part.mapView.render();
  Coals.Part.locationList = new Coals.Collection.Location;
  Coals.Part.InfoBox = new InfoBox;
  Coals.Part.locationListView = new Coals.View.LocationList({
    collection: Coals.Part.locationList,
    map: Coals.Part.map.get('map')
  });
  return Coals.Part.locationList.reset($.parseJSON(data.locations));
});

/*
//@ sourceMappingURL=location-map.js.map
*/