var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');

module.exports = function (gulp, options, $) {

  var scriptPath = path.join(conf.paths.src, '/assets/js/');
  var scriptsList = [
    path.join(scriptPath, 'main.js')
  ];

  gulp.task('scripts', function() {
    return gulp.src(scriptsList)
      .pipe($.jshint())
      .pipe($.jshint.reporter('default'))
      .pipe($.concat('main.min.js'))
      .pipe($.uglify())
      .pipe(gulp.dest(path.join(conf.paths.dist, '/js')));
  });

  gulp.task('scripts:watch', ['scripts'], function() {
    return  gulp.src(path.join(conf.paths.dist, '/js'))
      .pipe($.browserSync.reload({ // Reloading with Browser Sync
        stream: true
      }));
  });

}












