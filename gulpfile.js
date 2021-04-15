const gulp         = require('gulp'),
      babel        = require('gulp-babel'),
      sass         = require('gulp-sass'),
      postcss      = require('gulp-postcss'),
      autoprefixer = require('autoprefixer'),
      cssnano      = require('gulp-cssnano'),
      uglify       = require('gulp-uglify'),
      concat       = require('gulp-concat'),
      sourcemaps   = require('gulp-sourcemaps'),
      browserSync  = require('browser-sync').create();

const localURL     = 'https://dev.yournewsite.com';
    
/**
 * Sources & destinations.
 */

const paths = {
    scss: {
        src: './assets/sass/**/*.scss', // Will be used by `src()` and `watch()`.
        dest: './assets/dist/css/'      // Will be used by `dest()`.
    },
    js: {
        src: './assets/js/**/*.js',  // Will be used by `src()` and `watch()`.
        dest: './assets/dist/js/'    // Will be used by `dest()`.
    },
    php: {
        src: '**/*.php'
    }
};


/**
 * Init browser-sync.
 */

function serve(done)
{
    browserSync.init({
        proxy: localURL,
        port: 8080
    });
    done();
}


/**
 * Reload browser-sync.
 */

function reload(done) {
    browserSync.reload();
    done();
}


/*
 * Processing & compiling styles.
 */

function styles()
{
    return gulp.src(paths.scss.src)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([ autoprefixer() ]))
        .pipe(concat('style.min.css'))
        .pipe(cssnano())
        .pipe(sourcemaps.write('./maps')) 
        .pipe(gulp.dest(paths.scss.dest))
        .pipe(browserSync.stream())
    ;
}


/*
 * Processing JS.
 */

function scripts()
{
    return gulp.src([
            // Including jQuery is handled by seb_add_theme_scripts().
            //'./node_modules/slick-carousel/slick/slick.js', // Uncomment import @ bottom of style.scss
            paths.js.src
        ])
        .pipe(sourcemaps.init())
        .pipe(babel({
			presets: ['@babel/preset-env']
		}))
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(paths.js.dest))
        .pipe(browserSync.stream())
    ;
}


/*
 * Watch tasks.
 */

function watchAll()
{
    gulp.watch(paths.scss.src, gulp.series(styles));
    gulp.watch(paths.js.src, gulp.series(scripts));
    gulp.watch(paths.php.src, gulp.series(reload));
}

exports.styles  = styles;
exports.scripts = scripts;
exports.build   = gulp.parallel(styles, scripts);
exports.default = gulp.series(styles, scripts, serve, watchAll);