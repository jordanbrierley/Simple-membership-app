var path = require('path');
var gulp = require('gulp');
var conf = require('./conf');

module.exports = function (gulp, options, $){
  

  gulp.task('watch', function() {
    gulp.watch(path.join(conf.paths.src, '/assets/sass/**/*.scss'), ['styles:watch']);
    // gulp.watch(path.join(conf.paths.src, '**/*.php', browserSync.reload));
    gulp.watch(path.join(conf.paths.src, '/assets/js/**/*.js'), ['scripts:watch']);
    gulp.watch(path.join(conf.paths.src, '/assets/img/**/*'), ['images']);

    // $.livereload.listen();
    // gulp.watch(path.join(conf.paths.views, '/**')).on('change', $.browserSync.reload);
    gulp.watch(path.join(conf.paths.views, '/**')).on('change', $.browserSync.reload);

  });

  

}
