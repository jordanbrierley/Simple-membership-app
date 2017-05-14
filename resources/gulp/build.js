var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');


module.exports = function (gulp, options, $) {

  gulp.task('default', function(callback) {
    $.runSequence(['styles', 'scripts', 'images', 'browserSync', 'watch'],
      callback
    )
  })
  
  // build task
  gulp.task('build', function(callback) {
    $.runSequence(
      'clean:dist',
      ['styles', 'scripts', 'images'],
      callback
    )
  });

  // Cleaning 
  gulp.task('clean', function() {
    return $.del.sync(conf.paths.dist).then(function(cb) {
      return $.cache.clearAll(cb);
    });
  })

  gulp.task('clean:dist', function() {
    return true;
    // return $.del.sync([path.join(conf.paths.dist,'/**/*'), !path.join(conf.paths.dist,'/img'), !path.join(conf.paths.dist,'/img/**/*')]);
  });

}