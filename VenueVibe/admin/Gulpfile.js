// Load plugins
var gulp = require('gulp'),
    autoprefixer = require('autoprefixer'),
    concat = require('gulp-concat'),
    cssmin = require('gulp-cssmin'),
    del = require('del'),
    header = require('gulp-header'),
    postcss = require('gulp-postcss'),
    rename = require('gulp-rename'),
    runSequence = require('run-sequence'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify');

// Directories
var dirPath = {
    src: './src',
    dist: './dist',
    assets: '/assets'
};

// Paths
var srcAssets = dirPath.src + dirPath.assets,
    distAssets = dirPath.dist + dirPath.assets;

// Autoprefixer options
var autoprefixerOptions = {
    browsers: [
        'Chrome >= 45',
        'Firefox ESR',
        'Edge >= 12',
        'Explorer >= 10',
        'iOS >= 9',
        'Safari >= 9',
        'Android >= 4.4',
        'Opera >= 30'
    ]
};

// Banner
var pkg = require('./package.json'),
    banner = ['/*!',
    ' * <%= pkg.name %> - v<%= pkg.version %>',
    ' * @author <%= pkg.author %>',
    ' * Copyright (c) <%= new Date().getFullYear() %>',
    ' */',
    ''].join('\n');

// SCSS to CSS task for main styles
gulp.task('css-main', function() {
    return gulp.src(srcAssets + '/scss/main.scss')
        .pipe(sass({outputStyle: 'expanded', precision: 6}).on('error', sass.logError))
        .pipe(postcss([autoprefixer(autoprefixerOptions)]))
        .pipe(header(banner, { pkg : pkg } ))
        .pipe(rename({basename: 'codebase'}))
        .pipe(gulp.dest(srcAssets + '/css/'));
});

// Minify main CSS
gulp.task('css-main-min', function() {
    return gulp.src(srcAssets + '/css/codebase.css')
        .pipe(cssmin({shorthandCompacting: false, restructuring: false}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(srcAssets + '/css/'));
});

// SCSS to CSS task for theme styles
gulp.task('css-themes', function() {
    return gulp.src(srcAssets + '/scss/codebase/themes/*.scss')
        .pipe(sass({outputStyle: 'expanded', precision: 6}).on('error', sass.logError))
        .pipe(postcss([autoprefixer(autoprefixerOptions)]))
        .pipe(cssmin({shorthandCompacting: false, restructuring: false}))
        .pipe(header(banner, { pkg : pkg } ))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(srcAssets + '/css/themes'));
});

// Clean build directory
gulp.task('build-clean', function() {
    return del(dirPath.dist);
});

// Concat/Uglify core JS files and move it to build folder
gulp.task('build-js-core', function() {
    return gulp.src([
            srcAssets + '/js/core/jquery.min.js',
            srcAssets + '/js/core/popper.min.js',
            srcAssets + '/js/core/bootstrap.min.js',
            srcAssets + '/js/core/jquery.slimscroll.min.js',
            srcAssets + '/js/core/jquery.scrollLock.min.js',
            srcAssets + '/js/core/jquery.appear.min.js',
            srcAssets + '/js/core/jquery.countTo.min.js',
            srcAssets + '/js/core/js.cookie.min.js',
            srcAssets + '/js/codebase.js'
        ])
        .pipe(concat('codebase.min.js'))
        .pipe(uglify())
        .pipe(header(banner, { pkg : pkg } ))
        .pipe(gulp.dest(distAssets + '/js'));
});

// Copy folders and files to build folder
gulp.task('build-files-copy', function() {
    return gulp.src([
            srcAssets + '/css/**/*.*',
            srcAssets + '/fonts/**/*.*',
            srcAssets + '/img/favicons/**/*.*',
            srcAssets + '/img/avatars/**/*.*',
            srcAssets + '/js/plugins/**/*.*'
        ], { base: srcAssets } )
        .pipe(gulp.dest(distAssets));
});

// Watch task for .scss files
gulp.task('default', function() {
    gulp.watch(srcAssets + '/scss/**/*.scss', function(){
        runSequence(
            ['css-main', 'css-themes'],
            'css-main-min'
        );
    });
});

// Build task
gulp.task('build', function() {
    runSequence(
        ['css-main', 'css-themes'],
        'css-main-min',
        'build-clean',
        ['build-js-core', 'build-files-copy']
    );
});
