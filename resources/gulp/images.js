var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');

module.exports = function (gulp, options, $) {

  gulp.task('images', function() {
    return gulp.src(path.join(conf.paths.src, '/assets/img/**/*'))
      .pipe($.cache($.imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
      .pipe(gulp.dest(path.join(conf.paths.dist, '/img')))
  });

}