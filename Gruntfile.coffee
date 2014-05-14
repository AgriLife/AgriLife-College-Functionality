module.exports = (grunt) ->
  @initConfig
    pkg: @file.readJSON('package.json')
    watch:
      files: ['**/**.coffee', '**/*.scss']
      tasks: ['default']
    coffee:
      compile:
        options:
          bare: true
          sourceMap: true
        files:
          'js/location-map.js': 'js/src/location-map.coffee'
          'js/location-fields.js': 'js/src/location-fields.coffee'
    compass:
      dist:
        options:
          config: 'config.rb'
          specify: ['css/src/location-map.scss', 'css/src/location-single.scss']
    jshint:
      files: [
        'js/*.js'
      ]
      options:
        globals:
          jQuery: true
          console: true
          module: true
          document: true
        force: true
    csslint:
      options:
        'star-property-hack': false
        'duplicate-properties': false
        'unique-headings': false
        'ids': false
        'display-property-grouping': false
        'floats': false
        'outline-none': false
        force: true
      src: ['css/*.css']

  @loadNpmTasks 'grunt-contrib-coffee'
  @loadNpmTasks 'grunt-contrib-compass'
  @loadNpmTasks 'grunt-contrib-jshint'
  @loadNpmTasks 'grunt-contrib-csslint'
  @loadNpmTasks 'grunt-contrib-cssmin'
  @loadNpmTasks 'grunt-contrib-watch'

  @registerTask 'default', ['coffee', 'compass']
  @registerTask 'package', ['default', 'cssmin', 'csslint']

  @event.on 'watch', (action, filepath) =>
    @log.writeln('#{filepath} has #{action}')