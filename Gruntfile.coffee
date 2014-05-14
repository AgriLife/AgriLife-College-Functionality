module.exports = (grunt) ->
	@initConfig
		pkg : @file.readJSON('package.json')
		watch:
			files: ['**/**.coffee', '**/*.scss']
			tasks: ['default']
		coffee :
			compile:
				expand: true
				flatten: true
				cwd: 'js/src/'
				src: ['*.coffee']
				dest: 'js/'
				ext: '.js'
		compass:
			dist:
				options:
					config: 'config.rb'
					specify: ['css/src/*.scss']
	@loadNpmTasks 'grunt-contrib-coffee'
	@loadNpmTasks 'grunt-contrib-compass'
	@loadNpmTasks 'grunt-contrib-watch'

	@registerTask 'default', ['coffee', 'compass']

	@event.on 'watch', (action, filepath) =>
		@log.writeln('File changed')