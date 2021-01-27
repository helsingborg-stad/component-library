//
//  GULPFILE.JS
//  Author: Nikolas Ramstedt (nikolas.ramstedt@helsingborg.se)
//
//  Commands:
//  "gulp"          -   Build and watch task combined
//  "gulp build"    -   Build assets
//  "gulp watch"    -   Watch for file changes and build changed files
//

const gulp          = require('gulp');
const sass          = require('gulp-sass');
const concat        = require('gulp-concat');
const uglify        = require('gulp-uglify');
const cleanCSS      = require('gulp-clean-css');
const rename        = require('gulp-rename');
const autoprefixer  = require('gulp-autoprefixer');
const plumber       = require('gulp-plumber');
const rev           = require('gulp-rev');
const revDel        = require('rev-del');
const runSequence   = require('run-sequence');
const jshint        = require('gulp-jshint');
const sourcemaps    = require('gulp-sourcemaps');
const notifier      = require('node-notifier');


// ==========================================================================
// Default Task
// ==========================================================================

gulp.task('default', function(callback) {
    runSequence('build', 'watch', callback);
});

// ==========================================================================
// Build Tasks
// ==========================================================================

gulp.task('build', function(callback) {
    runSequence('clean:dist', ['sass', 'scripts'], 'revision', callback);
});

gulp.task('build:sass', function(callback) {
    runSequence('sass', 'revision', callback);
});

gulp.task('build:scripts', function(callback) {
    runSequence('scripts', 'revision', callback);
});

// ==========================================================================
// Watch Task
// ==========================================================================
gulp.task('watch', function() {
    gulp.watch('source/js/**/*.js', ['build:scripts']);
    gulp.watch('source/sass/**/*.scss', ['build:sass']);
});

// ==========================================================================
// SASS Task
// ==========================================================================
gulp.task('sass', function() {
    return gulp.src('source/sass/component-library.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', function(err) {
            console.log(err.message);
            notifier.notify({
              'title': 'SASS Compile Error',
              'message': err.message
            });
        }))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('dist/css'))
        .pipe(cleanCSS({debug: true}))
        .pipe(gulp.dest('dist/.tmp/css'));
});

// ==========================================================================
// Scripts Task
// ==========================================================================
gulp.task('scripts', function() {
    return gulp.src([
            'source/js/**/*.js',
        ])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(jshint())
        .pipe(jshint.reporter('fail').on('error', function(err) {
            this.pipe(jshint.reporter('default'));
            notifier.notify({
              'title': 'JS Compile Error',
              'message': err.message
            });
        }))
        .pipe(concat('component-library.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('dist/js'))
        .pipe(uglify().on('error', function(err) {
            return;
        }))
        .pipe(gulp.dest('dist/.tmp/js'));
});

// ==========================================================================
// Revision Task
// ==========================================================================

gulp.task("revision", function(){
    return gulp.src(["./dist/.tmp/**/*"])
      .pipe(rev())
      .pipe(gulp.dest('./dist'))
      .pipe(rev.manifest('rev-manifest.json', {merge: true}))
      .pipe(revDel({ dest: './dist' }))
      .pipe(gulp.dest('./dist'));
});

// ==========================================================================
// Clean Task
// ==========================================================================
gulp.task('clean:dist', function () {
    return del.sync('dist');
});
