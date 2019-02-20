/*
 * REQUIRES
 */
var gulp        = require('gulp'),
    gulpLess    = require('gulp-less'),
    browserSync = require('browser-sync').create();
    
var reload      = browserSync.reload;

var src  = './src/',
    dist = './dist/',
    css = './dist/';

/*
 * Watches 
 */
var htmlWatch  = '**/*.html',
    phpWatch   = '**/*.php',
    cssWatch   = '**/*.css',
    lessWatch  = src + 'less/*.less',
    jsWatch    = '**/*.js',
    cofeeWatch = '**/*.cofee';
  
/*
 * Less
 */
gulp.task('compile-less', function() {  
    return gulp.src( lessWatch )
        .pipe( gulpLess( ) )
        .pipe( gulp.dest('./dist/css/') );
}); 

/* Task to watch less changes */
gulp.task('watch-less', function() {  
    gulp.watch( lessWatch , gulp.series('compile-less') );
});

/*
 * Sass
 */
var sassSrc = '/src/scss/',
    sassDist = '/dist/scss/',
    sassWatch  = '**/*.sass';
    
/*
 * Js
 */
var jsSrc = '/src/js/',
    jsDist = '/dist/js/';

/*
 * Browser sync
 */
gulp.task('browser-sync', function() {
    browserSync.init({
        injectChanges: true,
        watch: true,
        files: "**/*",
        proxy: "wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
});

/*
 * Style
 */
gulp.task('style', function(){
    gulp.src( styleSrc )
        .pipe( sourcemaps.init())
        .pipe( sass({
            errorLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on( 'error', console.error.bind( console ))
        .pipe (autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe( rename({suffix: '.min'}) )
        .pipe( sourcemaps.write('./') )
        .pipe( gulp.dest(styleDist) )
        .pipe( browserSync.stream() );
});

/*
 * Js
 */
gulp.task('js', function(){
    
    jsFiles.map(function( entry ){
        return browserify({
            entries: [jsFolder]
        })
    })
    
    jsFiles.map( styleSrc )
        .pipe( sourcemaps.init())
        .pipe( sass({
            errorLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on( 'error', console.error.bind( console ))
        .pipe (autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe( rename({suffix: '.min'}) )
        .pipe( sourcemaps.write('./') )
        .pipe( gulp.dest(styleDist) )
        .pipe( browserSync.stream() );
})

/*
 * Serve
 */
gulp.task('serve', function() {
    browserSync.init({
        injectChanges: true,
        watch: true,
        files: "**/*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });

    
    //gulp.watch("./src/less/*.less").on("change", reload);
    //gulp.watch("./dist/*.html").on("change", reload);
    
    //gulp.watch( htmlWatch, reload );
    //gulp.watch( phpWatch, reload );
    //gulp.watch( [htmlWatch, phpWatch, cssWatch] ).on("change"); //, browserSync.reload);
    //gulp.watch( "**/*.css" ).on("change", browserSync.reload);
    //gulp.watch( "**/*.html" ).on("change", browserSync.reload);
    //gulp.watch( "**/*.js" ).on("change", browserSync.reload);
});

/*
 * Default
 */
gulp.task('default', gulp.series('serve'));
//gulp.task('default', ['serve']);

/*gulp.task('watch', ['default', 'browserSync'], function(){
    //gulp.watch( "** /*.html" ).on("change", browserSync.reload);
    //gulp.watch( "** /*.js" ).on("change", browserSync.reload);
})*/
