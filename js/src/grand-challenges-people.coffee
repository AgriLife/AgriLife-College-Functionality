$ = jQuery
AgriLife = {} if not AgriLife

AgriLife.People = class People

	get: ->
		$.ajax(
			url: ajaxurl
			data:
				action: 'get_people'
			success: (response) =>
				response = JSON.parse(response)
				@people = _.sortBy(response.people, 'lastname')
				_.each(@people, (person) =>
					template = $('script#people-template').html()
					output = _.template template, person
					$('#people-listing-ul').append(output)
				)
		)

	filter: (term) ->
		$('#people-listing-ul').html('')
		console.log "Filtering by #{term}"
		filtered = _.filter(@people, (person) =>
			_.contains(person.specializations, term)
		)
		_.each(filtered, (person) =>
			template = $('script#people-template').html()
			output = _.template template, person
			$('#people-listing-ul').append(output)
		)

do ( $ = jQuery ) ->
	"use strict"
	$ ->
		people = new AgriLife.People
		people.get()

		$('.gc-selection ul li').click (e) ->
			people.filter($(this).data('challenge'))