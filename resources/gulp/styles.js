var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');

module.exports = function (gulp, options, $) {

  gulp.task('styles', function() {
    return gulp.src(path.join(conf.paths.src, '/assets/sass/main.scss')) // Gets all files ending with .scss in scss and children dirs
      .pipe($.sass({ outputStyle: 'compressed' }).on('error', $.sass.logError)) // Passes it through a gulp-sass
      .pipe($.autoprefixer({ browsers: ['last 2 versions', 'IE 9'], cascade: true })) // auto prefix last 2 browser versions and IE9
      .pipe($.rename({suffix: '.min'}))
      .pipe($.cssnano())
      .pipe(gulp.dest(path.join(conf.paths.dist, '/css'))); // Outputs it in the css folder
  });

  gulp.task('styles:watch', ['styles'], function() {
    return  gulp.src(path.join(conf.paths.dist, '/css'))
      .pipe($.browserSync.reload({ // Reloading with Browser Sync
        stream: true
      }));
  });

};
