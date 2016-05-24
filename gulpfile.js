/**
 * Gulp Tasks Setup
 * URI: https://github.com/maxkostinevich/wp-plugin-starter-kit
 *
 * Author: Max Kostienvich
 * Author URI: https://maxkostinevich.com
 */
/** CONFIG **/
var pluginConfig = {
    'CONF Plugin Name': 'WP Starter Plugin', // User friendly plugin name
    'CONF_Plugin_Link': 'http://github.com/maxkostinevich/wp-plugin-starer-kit', // Plugin homepage URL
    'CONF_Plugin_Author': 'Max Kostinevich', // Use your own name or your company name
    'CONF_Author_Link': 'http://maxkostinevich.com', // Use your own website
    'CONF_Plugin_Copyright': '2016 Max Kostinevich', // Use your own name or your company name
    'plugin-name': 'wp-starter-plugin', // Plugin slug
    'Plugin_Name': 'WP_Starter_Plugin', // Classes prefix
    'plugin_name': 'wp_starter_plugin' // plugin identifier
};
var mainFiles = [
    // include common file types
    './**/*', '!gulpfile.js', '!package.json', '!README.md', '!.gitignore', '!build', '!build/**', '!.git', '!.git/**', '!node_modules', '!node_modules/**', '!.assets', '!.assets/**',
    //          '!bower_components'
    //          '!bower_components/**'
];
var buildInclude = ['**', '!gulpfile.js', '!package.json', '!README.md', '!.gitignore', '!build', '!build/**', '!.git', '!.git/**', '!node_modules', '!node_modules/**',
    //      '!bower_components'
    //      '!bower_components/**'
];
/** PLUGINS **/
var
//utils
    gulp = require('gulp'),
    gulpif = require('gulp-if'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify'),
    del = require('del'),
    runSequence = require('run-sequence').use(gulp),
    // production & deployment
    zip = require('gulp-zip'),
    // file manipulation
    ignore = require('gulp-ignore'),
    rename = require('gulp-rename'),
    regex_rename = require('gulp-regex-rename'),
    replace = require('gulp-replace'),
    deletefile = require('gulp-delete-file'),
    //css
    minifyCss = require('gulp-minify-css'),
    // scripts
    uglify = require('gulp-uglify');
/** TASKS **/
/* UTILS */
// Scaffold plugin
gulp.task('bootstrap', function(callback) {
    runSequence('bootstrap:renameOriginals', 'bootstrap:deleteOriginals', callback);
});
// Rename original files and replace plugin constants
gulp.task('bootstrap:renameOriginals', function() {
    return gulp.src(mainFiles).pipe(replace('CONF Plugin Name', pluginConfig['CONF Plugin Name'])).pipe(replace('CONF_Plugin_Link', pluginConfig['CONF_Plugin_Link'])).pipe(replace('CONF_Plugin_Author', pluginConfig['CONF_Plugin_Author'])).pipe(replace('CONF_Author_Link', pluginConfig['CONF_Author_Link'])).pipe(replace('CONF_Plugin_Copyright', pluginConfig['CONF_Plugin_Copyright'])).pipe(replace('plugin-name', pluginConfig['plugin-name'])).pipe(replace('Plugin_Name', pluginConfig['Plugin_Name'])).pipe(replace('plugin_name', pluginConfig['plugin_name'])).pipe(regex_rename(/plugin-name/, pluginConfig['plugin-name'])).pipe(gulp.dest('./')).pipe(notify({
        message: 'Plugin has been successfully bootstrapped',
        onLast: true
    }));
});
// Delete original files (since regex_rename won't delete source files)
gulp.task('bootstrap:deleteOriginals', function() {
    return gulp.src(mainFiles).pipe(deletefile({
        reg: /plugin-name/,
        deleteMatch: true
    })).pipe(gulp.dest('./'));
});
// Clean Up Production Folders
gulp.task('clean', function() {
    return del(['build/**/*', 'build/**/.keep']);
});
/* BUILDING TASKS */
// Build Project
gulp.task('build', function(callback) {
    runSequence('clean', 'build:plugin', 'build:archive', callback);
});
// Build Plugin
gulp.task('build:plugin', function() {
    return gulp.src(mainFiles).pipe(gulpif('*.js', uglify())).pipe(gulpif('*.css', minifyCss())).pipe(gulp.dest('build/' + pluginConfig['plugin-name'])).pipe(notify({
        message: 'Build task has been finished',
        onLast: true
    }));
});
//
gulp.task('build:archive', function() {
    return gulp.src('build/' + pluginConfig['plugin-name'] + '/**/', {
        base: "./build"
    }).pipe(zip(pluginConfig['plugin-name'] + '.zip')).pipe(gulp.dest('./build')).pipe(notify({
        message: 'Plugin has been archived successfully',
        onLast: true
    }));
});
// Default task
gulp.task('default', ['build']);