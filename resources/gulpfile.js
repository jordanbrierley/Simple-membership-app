var path = require('path');
var gulp = require('gulp');


var options = {
  pattern: 'gulp/**/*.js',
};

var loadPlugins = require('gulp-load-plugins')({
  pattern: ['*']
});

require('load-gulp-tasks')(gulp, options, loadPlugins);