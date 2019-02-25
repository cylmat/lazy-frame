<<<<<<< HEAD
var gulp          = require('gulp'),
    browserSync   = require('browser-sync').create(),
    reload        = browserSync.reload,
    child_process = require("child_process").exec;

var htmlWatch  = '**/*.html',
    phpWatch   = '**/*.php',
    cssWatch   = '**/*.css',
    jsWatch    = '**/*.js',
    sassWatch  = '**/*.sass',
    xmlWatch   = '**/*.xml',
    cofeeWatch = '**/*.cofee';
    
var jsSrc  = 'src/js/',
    jsDist = 'dist/js/';

gulp.task('phpunit', function() {
    child_process("phpunit", function(error, stdout) {
        console.log(error+stdout);
    });
});
=======
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
>>>>>>> 637553fe1b0b6be442726d1c409b8e7c79820573

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
<<<<<<< HEAD
        files: "** /*",
        proxy: "http://wordpress:8888",
=======
        files: "**/*",
        proxy: "wordpress:8888",
>>>>>>> 637553fe1b0b6be442726d1c409b8e7c79820573
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
        //watchEvents : [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ],
        watch: true,
        files: "**/*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
<<<<<<< HEAD
    
    //gulp.series('browser-sync');
    
    //gulp.watch( htmlWatch, reload );
    //gulp.watch( phpWatch, reload );
    gulp.watch( [htmlWatch, cssWatch, phpWatch, jsWatch] ).on( "change", browserSync.reload );
    
    gulp.watch( phpWatch ).on( "change", gulp.series('phpunit') );
=======

    
    //gulp.watch("./src/less/*.less").on("change", reload);
    //gulp.watch("./dist/*.html").on("change", reload);
    
    //gulp.watch( htmlWatch, reload );
    //gulp.watch( phpWatch, reload );
    //gulp.watch( [htmlWatch, phpWatch, cssWatch] ).on("change"); //, browserSync.reload);
>>>>>>> 637553fe1b0b6be442726d1c409b8e7c79820573
    //gulp.watch( "**/*.css" ).on("change", browserSync.reload);
    //gulp.watch( "**/*.html" ).on("change", browserSync.reload);
    //gulp.watch( "**/*.js" ).on("change", browserSync.reload);
});

<<<<<<< HEAD
//gulp.task('default', gulp.series('phpunit','serve'));
gulp.task('default', gulp.series('serve'));
=======
/*
 * Default
 */
gulp.task('default', gulp.series('serve'));
//gulp.task('default', ['serve']);

/*gulp.task('watch', ['default', 'browserSync'], function(){
    //gulp.watch( "** /*.html" ).on("change", browserSync.reload);
    //gulp.watch( "** /*.js" ).on("change", browserSync.reload);
})*/
>>>>>>> 637553fe1b0b6be442726d1c409b8e7c79820573
