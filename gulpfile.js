/**
 * REQUIRES
 */
var gulp         = require('gulp'),
    browserSync  = require('browser-sync').create(),
    childProcess = require("child_process").exec,
    glupLoadPlugins  = require('gulp-load-plugins');
    
var glp = glupLoadPlugins();
    
/**
* Dir
*/
var src  = './src/',
    build= './build/', 
    dist = './dist/';

/**
 * Watches
 */
var htmlWatch  = src+'html/*.html',
    lessWatch  = src+'less/*.less',
    sassWatch  = src+'sass/*.sass',
    coffeeWatch= src+'coffee/*.coffee';    
        
    phpWatch   = './app/**/*.php',
    phpIndexWatch = 'index.php',
    cssWatch   = src + '**/*.css',
    jsWatch    = src + '**/*.js';

var cssDist = dist+'css/',
    jsDist  = dist+'js/';
    
/**
 * Src
 */
var coffeeSrc = src+'coffee/*.coffee',
    lessSrc   = src+'less/*.less';
    
/**
 * build
 */
var cssBuild = build+'css',
    jsBuild  = build+'js'; 

/**
 * Dist
 */
var scriptDist = dist+'js';
  
/**
 * Less
 */
gulp.task('less', function() { 
    gulp.src( lessWatch )
        .pipe( glp.less( ) )
        .pipe( gulp.dest( cssBuild ) );
}); 

/**
 * optimize
 */
gulp.task('op-css', function() { 
    gulp.src( build+'css/*.css' )
        .pipe( glp.uglifycss( ) )
        .pipe( gulp.dest( cssDist ) );
}); 

//add postcss
gulp.task('min-css', function() { 
    gulp.src( build+'css/*.css' )
        .pipe( glp.uglifycss( ) )
        .pipe( gulp.dest( cssDist ) );
}); 

/**
 * Coffee
 */
gulp.task('coffee', function() {
    gulp.src( coffeeSrc )
        .pipe( glp.coffee( {bare: true} ) )
        .pipe( gulp.dest( jsBuild ));
});

/**
 * build
 */
gulp.task('build', gulp.parallel('less', 'coffee'));

/**
 * optimize
 */
gulp.task('op', gulp.parallel('op-css'));

/**
 * minify
 */
gulp.task('min', gulp.parallel('min-css'));


/**
 * browser
 */
gulp.task('browser_sync', function() {
    browserSync({
        injectChanges: true,
        files: "** /*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
});

gulp.task('serve', function() {
    
    /*browserSync.init({
        injectChanges: true,
        //watchEvents : [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ],
        watch: true,
        files: "** /*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });*/
    browser_sync.reload();
    
    gulp.watch( [htmlWatch, cssWatch, phpWatch, jsWatch] ).on( "change", browserSync.reload );
    //gulp.watch( [lessWatch] ).on( "change", gulp.series('less'));
    
    //gulp.watch( phpIndexWatch ).on( "change", gulp.series('php-unit') );

});

gulp.task('default', gulp.series('serve'));