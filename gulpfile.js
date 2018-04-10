var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    postcss      = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    minify       = require('gulp-minifier'),
    concat       = require('gulp-concat'),
    sourcemaps   = require('gulp-sourcemaps');
    //flatten      = require('gulp-flatten');


/*
 * Processing & compiling styles.
 */

gulp.task('styles', function() {
    return gulp.src('./assets/sass/*.scss')
        .pipe(sourcemaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(postcss([ autoprefixer({ browsers: ['> 1%'] }) ]))
            .pipe(minify({
                minify: true,
                collapseWhitespace: true,
                conservativeCollapse: true,
                minifyJS: true,
                minifyCSS: true
            }))
            .pipe(concat('style.min.css'))
            //.pipe(flatten()) // Ignore directory hierarchy.
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./assets/dist/css'))
});


/*
 * Processing JS.
 */

gulp.task('scripts', function() {
    return gulp.src([
            './assets/js/jquery-3.2.1.min.js',
            './assets/js/seb.js'
        ])
        .pipe(minify({
            minify: true,
            collapseWhitespace: true,
            conservativeCollapse: true,
            minifyJS: true,
            minifyCSS: true
        }))
        .pipe(concat('scripts.min.js'))
        .pipe(gulp.dest('./assets/dist/js'))
});


/*
 * Watch tasks.
 */

gulp.task('default', function()
{
    gulp.watch("assets/sass/*.scss", ['styles']);
    gulp.watch("assets/js/*.js", ['scripts']);
});
