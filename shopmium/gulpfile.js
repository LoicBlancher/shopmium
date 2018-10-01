/*jslint node: true */
"use strict";

var $          = require('gulp-load-plugins')();
var argv       = require('yargs').argv;
var gulp       = require('gulp');
var merge      = require('merge-stream');
var sequence   = require('run-sequence');
var dateFormat = require('dateformat');
var del        = require('del');
var cleanCSS   = require('gulp-clean-css');
var ftp        = require( 'vinyl-ftp' );
var fs         = require('fs');

// Initial variables
var outputPath = 'dist/js';
var modulesPath = 'node_modules/';

// Check for --production flag
var isProduction = !!(argv.production),
    copiying = !!(argv.copy);

// Browsers to target when prefixing CSS.
var COMPATIBILITY = [
  'last 2 versions',
  'ie >= 9',
  'Android >= 2.3'
];

// File paths to various assets are defined here.
var PATHS = {
  sass: [
  ],
  javascript: [
    // jQuery
    // modulesPath + 'jquery/dist/jquery.js',
    // // Slick.js
    // modulesPath + 'slick-carousel/slick/slick.js',
    // // Bootstrap
    // modulesPath + 'bootstrap/js/transition.js',
    // modulesPath + 'bootstrap/js/tab.js',
    // modulesPath + 'bootstrap/js/collapse.js',
    // modulesPath + 'bootstrap/js/modal.js',
    // // AOS animate on scroll
    // modulesPath + 'aos/dist/aos.js',

    // Motion UI
    // 'assets/components/motion-ui/motion-ui.js',

    // Include your own custom scripts (located in the custom folder)
    'assets/js/**.js'
  ],
  pkg: [
    '**/*',
    '!**/node_modules/**',
    '!assets/js/**',
    '!**/scss/**',
    '!**/gulpfile.js',
    '!**/package.json',
    '!**/package-lock.json',
    '!**/packaged/*',
  ],
  // Copy paths object declare
  copy: {}
};
// fonts
// -----
// move slick fonts to dist/fonst/ directory
// PATHS.copy[modulesPath + 'slick-carousel/slick/fonts/**'] = outputPath + '/fonts/';
// move font awesome web fonts to dist/font directory
// PATHS.copy[modulesPath + '@fortawesome/fontawesome-free/webfonts/fa-brands-**'] = outputPath + '/fonts/';
// PATHS.copy[modulesPath + '@fortawesome/fontawesome-free/webfonts/fa-solid-**'] = outputPath + '/fonts/';
// PATHS.copy[modulesPath + '@fortawesome/fontawesome-free/webfonts/fa-regular-**'] = outputPath + '/fonts/';

// images
// ------
//move slick's images to dist/image
// PATHS.copy[modulesPath +'slick-carousel/slick/**.{png,gif}'] = outputPath +'/image/';

// Compile Sass into CSS
// In production, the CSS is compressed
gulp.task('sass', function() {
  return gulp.src('assets/scss/app.scss')
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      includePaths: PATHS.sass
    }))
    .on('error', $.notify.onError({
        message: "<%= error.message %>",
        title: "Sass Error"
    }))
    .pipe($.autoprefixer({
      browsers: COMPATIBILITY
    }))
    // Minify CSS if run with --production flag
    .pipe($.if(isProduction, cleanCSS()))
    .pipe($.if(!isProduction, $.sourcemaps.write('.')))
    .pipe(gulp.dest('dist/css'));
});

// Lint all JS files in custom directory
gulp.task('lint', function() {
  return gulp.src('assets/js/**.js')
    .pipe($.jshint())
    .pipe($.notify(function (file) {
      if (file.jshint.success) {
        return false;
      }

      var errors = file.jshint.results.map(function (data) {
        if (data.error) {
          return "(" + data.error.line + ':' + data.error.character + ') ' + data.error.reason;
        }
      }).join("\n");
      return file.relative + " (" + file.jshint.results.length + " errors)\n" + errors;
    }));
});

// Combine JavaScript into one file
// In production, the file is minified
gulp.task('javascript', function() {
  var uglify = $.uglify()
    .on('error', $.notify.onError({
      message: "<%= error.message %>",
      title: "Uglify JS Error"
    }));

  return gulp.src(PATHS.javascript)
    .pipe($.sourcemaps.init())
    // .pipe($.babel())
    .pipe($.concat('build.js', {
      newLine:'\n;'
    }))
    .pipe($.if(isProduction, uglify))
    .pipe($.if(!isProduction, $.sourcemaps.write()))
    .pipe(gulp.dest(outputPath));
});

// Copy files
// ----------
gulp.task('copy', function () {
  if(copiying || isProduction) {
    var stream = merge();

    for (var fileCopy in PATHS.copy) {
      stream.add( gulp.src(fileCopy).pipe(gulp.dest(PATHS.copy[fileCopy])) );
    }

    return stream.isEmpty() ? null : stream;
  }
});

// Package task
gulp.task('package', ['build'], function() {
  var time = dateFormat(new Date(), "yyyy-mm-dd_HH-MM");
  var pkg = JSON.parse(fs.readFileSync('./package.json'));
  var title = pkg.name + '_' + time + '.zip';

  return gulp.src(PATHS.pkg)
    .pipe($.zip(title))
    .pipe(gulp.dest('packaged'));
});

// Build task
// Runs copy then runs sass & javascript in parallel
gulp.task('build', ['clean'], function(done) {
  sequence('copy',
          ['sass', 'javascript'/*, 'lint'*/], 'deploy',
          done);
});

// Clean task
gulp.task('clean', function(done) {
  sequence(['clean:javascript', 'clean:css'],
            done);
});

// Clean JS
gulp.task('clean:javascript', function() {
  return del([
      'dist/js/build.js'
    ]);
});

// Clean CSS
gulp.task('clean:css', function() {
  return del([
      'dist/css/app.css',
      'dist/css/app.css.map'
    ]);
});

// Deploy to ftp server
gulp.task( 'deploy', function () {
  var ftpCredentials = JSON.parse(fs.readFileSync('./config.json')).ftp_credentials;
      ftpCredentials['log'] = $.util.log;
  var ftpConn = ftp.create(ftpCredentials);
  var globs = [
      '**/*',
      '!**/node_modules/**',
      '!**/dist/css/**',
      '!**/dist/js/**',
      // '!**/js/**',
      // '!**/sass/**',
      // '!**/gulpfile.js',
      // '!**/package.json',
      '!**/config.json',
      // '!**/package-lock.json',
      '!**/packaged/*'
  ];
  // using base = '.' will transfer everything to /public_html correctly
  // turn off buffering in gulp.src for best performance
  return gulp.src( globs, { base: '.', buffer: false } )
      .pipe( ftpConn.newerOrDifferentSize( '/' ) ) // only upload newer files
      .pipe( ftpConn.dest( '/' ) );
});

// Default gulp task
// Run build task and watch for file changes
gulp.task('default', ['build'], function() {
  // Log file changes to console
  function logFileChange(event) {
    var fileName = require('path').relative(__dirname, event.path);
    console.log('[' + 'WATCH'.green + '] ' + fileName.magenta + ' was ' + event.type + ', running tasks...');
  }

  // Less Watch
  gulp.watch(['assets/scss/**/*.scss'], ['clean:css', 'sass'])
    .on('change', function(event) {
      logFileChange(event);
    });

  // JS Watch
  gulp.watch(['assets/js/**/*.js'], ['clean:javascript', 'javascript'/*, 'lint'*/])
    .on('change', function(event) {
      logFileChange(event);
    });
});
