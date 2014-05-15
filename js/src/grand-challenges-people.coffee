$ = jQuery
AgriLife = {} if not AgriLife

AgriLife.People = class People

	get: ->
		$.ajax(
			url: url.ajax
			data:
				action: 'get_people'
			success: (response) =>
				response = JSON.parse(response)
				@people = _.sortBy(response.people, 'lastname')
				@filter(@getTerm())
		)

	filter: (term) ->
		$('#people-listing-ul').html('')
		filtered = _.filter(@people, (person) =>
			_.contains(person.specializations, term)
		)
		_.each(filtered, (person) =>
			template = $('script#people-template').html()
			output = _.template template, person
			$('#people-listing-ul').append(output)
		)

	getTerm: () ->
		url = document.URL.split('#')[1].toLowerCase()


do ( $ = jQuery ) ->
	"use strict"
	$ ->

		people = new AgriLife.People
		if people.getTerm()? then people.get()

		$('li.challenge').click (e) ->
			people.filter($(this).data('challenge'))

		$('.people-searchform').on 'submit', (e) ->
			e.preventDefault()
			query = $('input[name="p"]').val()
			resultPage = $(this).attr('action')
			console.log query
			window.location.href = resultPage + '#' + query
