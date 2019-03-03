/**
 * REQUIRES
 */
var gulp          = require('gulp'),
    gulp_less     = require('gulp-less'),
    less          = require('less');
    browserSync   = require('browser-sync').create(),
    child_process = require("child_process").exec,
    
    reload        = browserSync.reload;
    
/**
* WATCHES
*/
var src  = './src/',
    dist = './dist/';


var htmlWatch  = '**/*.html',
    phpWatch   = '**/*.php',
    phpIndexWatch = 'index.php',
    cssWatch   = '**/*.css',
    lessWatch  = src + '**/*.less',
    jsWatch    = '**/*.js',
    sassWatch  = '**/*.sass',
    xmlWatch   = '**/*.xml',
    coffeeWatch = '**/*.coffee';

var cssSrc  = src+'css/',
    cssDist = dist+'css/';

var jsSrc  = src+'js/',
    jsDist = dist+'js/';
  
/**
 * Less
 */
gulp.task('compile-gulp-less', function() {  
    return gulp.src( './src/**/*.less' )
        .pipe( gulp_less( ) )
        .pipe( gulp.dest( './dist/css' ) );
}); 

gulp.task('compile-less', function() {  
    return gulp.src( './src/**/*.css' )
        .pipe( less( ) )
        .pipe( gulp.dest( './dist/css' ) );
}); 

/**
 * Php-unit
 */
gulp.task('php-unit', function() {
    child_process("phpunit -c ./config/phpunit.xml", function(error, stdout, stderr) {
        console.log('error'+error);
        console.log("stdout:"+stdout);
        console.log("stderr:"+stdout);
    });
});

/**
 * Php-cs
 */
gulp.task('php-cs', function() {
    //child_process('phpcs -s ./application', function(error,stdout) {
        child_process('phpcs ./application --ignore=./application/log/* --report=xml --report-file=./var/logphpcs.xml', function(error,stdout) {
        console.log('error'+error);
        console.log("stdout:"+stdout);
        console.log("stderr:"+stdout);
    });
});

/**
 * php-md
 */
gulp.task('php-md', function() {
    child_process('phpmd ./application xml ./config/phpmd.xml --reportfile ./var/logphpmd.xml', function(error, stdout) {
        console.log('error:'+error);
        console.log('stdout:'+stdout);
    });
});



/*gulp.task('browser-sync', function() {
    browserSync.init({
        injectChanges: true,
        watch: true,
        files: "** /*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
});*/

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
    
    gulp.watch( [htmlWatch, cssWatch, phpWatch, jsWatch] ).on( "change", browserSync.reload );
    gulp.watch( [lessWatch] ).on( "change", gulp.series('compile-less'));
    
    gulp.watch( phpIndexWatch ).on( "change", gulp.series('php-unit') );
    gulp.watch( phpIndexWatch ).on( 'change', gulp.series('php-cs') );
    gulp.watch( phpIndexWatch ).on( 'change', gulp.series('php-md') );

});

//gulp.task('default', gulp.series('phpunit','serve'));
gulp.task('default', gulp.series('serve'));