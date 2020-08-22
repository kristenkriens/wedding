var gulp  = require('gulp'),
    gutil = require('gulp-util'),
    cheerio = require('gulp-cheerio'),
    sass = require('gulp-sass'),
    cssnano = require('gulp-cssnano'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    imagemin = require('gulp-imagemin'),
    svgstore = require('gulp-svgstore'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber'),
    babel = require('gulp-babel'),
    browserSync = require('browser-sync').create();

// BrowserSync
gulp.task('browsersync', function() {
	browserSync.init({
		proxy: 'http://localhost:8888/wedding'
	});
});

// Compile Sass, Autoprefix and minify
gulp.task('styles', function() {
  return gulp.src('./src/scss/**/*.scss')
    .pipe(plumber(function(error) {
      gutil.log(gutil.colors.red(error.message));
      this.emit('end');
    }))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp.dest('./dist/css/'))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./dist/css/'))
});

// JSHint, concat, and minify JavaScript
gulp.task('scripts', function() {
  return gulp.src('./src/js/*.js')
    .pipe(plumber(function(error) {
      gutil.log(gutil.colors.red(error.message));
      this.emit('end');
    }))
  .pipe(sourcemaps.init())
  .pipe(jshint())
  .pipe(jshint.reporter('jshint-stylish'))
  .pipe(concat('scripts.js'))
  .pipe(gulp.dest('./dist/js'))
  .pipe(rename({suffix: '.min'}))
  .pipe(uglify())
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest('./dist/js'))
});

// Image minify
gulp.task('images', function () {
	return gulp.src('./src/assets/images/**/*.{png,jpg,svg,gif,webp}')
    .pipe(plumber(function(error) {
      gutil.log(gutil.colors.red(error.message));
      this.emit('end');
    }))
		.pipe(imagemin())
		.pipe(gulp.dest('./dist/assets/images'));
});

// SVG sprite
gulp.task('svg', function () {
	return gulp.src('./src/assets/images/svg/*.svg')
    .pipe(plumber(function(error) {
      gutil.log(gutil.colors.red(error.message));
      this.emit('end');
    }))
    .pipe(svgstore({inlineSvg: true}))
    .pipe(cheerio({
      'run': function($, file) {
        $('svg').attr('style', 'display: none');
      },
      'parserOptions': {xmlMode: false},
    }))
		.pipe(gulp.dest('./dist/assets/images/svg/sprite'));
});

// Fonts
gulp.task('fonts', function () {
	return gulp.src('./src/assets/fonts/**/*')
    .pipe(plumber(function(error) {
      gutil.log(gutil.colors.red(error.message));
      this.emit('end');
    }))
		.pipe(gulp.dest('./dist/assets/fonts'));
});

// Configure which files to watch and what tasks to use on file changes
gulp.task('watch', function() {
	gulp.watch('./src/scss/**/*.scss', ['styles']);
	gulp.watch('./src/js/*.js', ['scripts']);
  gulp.watch('./src/assets/images/**/*.{png,jpg,svg,gif,webp}', ['images']);
  gulp.watch('./src/assets/images/svg/*.svg', ['svg']);
  gulp.watch('./src/assets/fonts/**/*', ['fonts']);
	gulp.watch('**/**/**/*.php', browserSync.reload);
});

gulp.task('default', ['styles', 'scripts', 'images', 'svg', 'fonts', 'browsersync', 'watch']);
