var Coals;

Coals = {};

Coals.Model = {};

Coals.Collection = {};

Coals.View = {};

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
  url: url.ajax
});

Coals.View.LocationList = Backbone.View.extend({
  initialize: function() {
    return this.collection.on('add', this.addMarker, this);
  },
  render: function() {
    return this.collection.forEach(this.addMarker, this);
  },
  addMarker: function(location) {
    var locationView;
    locationView = new Coals.View.Location({
      model: location
    });
    return locationView.render(this.options.map);
  }
});

Coals.View.Location = Backbone.View.extend({
  render: function(map) {
    var coords, marker, markerLatLng;
    coords = this.model.get('coordinates').split(", ");
    markerLatLng = new google.maps.LatLng(coords[0], coords[1]);
    marker = new google.maps.Marker({
      position: markerLatLng,
      title: this.model.get('title')
    });
    return marker.setMap(map);
  }
});

$(function() {
  var locationList, locationListView, map, mapView;
  map = new Coals.Model.Map({
    zoom: 2
  });
  map.initMap({
    coords: {
      latitude: 23.241346,
      longitude: 24.609375
    }
  });
  mapView = new Coals.View.Map({
    model: map
  });
  mapView.render();
  locationList = new Coals.Collection.Location;
  locationList.fetch({
    data: {
      action: 'get_locations'
    }
  });
  return locationListView = new Coals.View.LocationList({
    collection: locationList,
    map: map.get('map')
  });
});

/*
//@ sourceMappingURL=location-map.js.map
*/