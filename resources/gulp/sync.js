var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');

module.exports = function(gulp, options, $) {
  // Start browserSync server
  gulp.task('browserSync', function() {
    $.browserSync({
      proxy: conf.proxy
    })
  });
}