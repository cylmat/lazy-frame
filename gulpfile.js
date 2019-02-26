/**
 * REQUIRES
 */
var gulp          = require('gulp'),
    gulpLess      = require('gulp-less'),
    browserSync   = require('browser-sync').create(),
    child_process = require("child_process").exec,
    
    reload        = browserSync.reload;
    
/**
* WATCHES
*/
var htmlWatch  = '**/*.html',
    phpWatch   = '**/*.php',
    cssWatch   = '**/*.css',
    lessWatch  = '**/*.less',
    jsWatch    = '**/*.js',
    sassWatch  = '**/*.sass',
    xmlWatch   = '**/*.xml',
    cofeeWatch = '**/*.cofee';

var src  = './src/',
    dist = './dist/';

var cssSrc  = src+'js/',
    cssDist = dist+'js/';

var jsSrc  = src+'js/',
    jsDist = dist+'js/';
  
/**
 * Less
 */
gulp.task('compile-less', function() {  
    return gulp.src( lessWatch )
        .pipe( gulpLess( ) )
        .pipe( gulp.dest('./dist/css/') );
}); 

/**
 * Php-unit
 */
gulp.task('php-unit', function() {
    child_process("phpunit", function(error, stdout, stderr) {
        console.log('error'+error);
        console.log("stdout:"+stdout);
        console.log("stderr:"+stdout);
    });
});

/**
 * Php-cs
 */
gulp.task('php-cs', function(){
    child_process('./vendor/bin/phpcs -s --report=xml --report-file=./var/phpcs.xml ./application', function(error,stdout) {
        console.log('error'+error);
        console.log("stdout:"+stdout);
        console.log("stderr:"+stdout);
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
        files: "** /*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
    
    gulp.watch( [htmlWatch, cssWatch, phpWatch, lessWatch, jsWatch] ).on( "change", browserSync.reload );
    
    gulp.watch( phpWatch ).on( "change", gulp.series('php-unit') );
    gulp.watch( phpWatch ).on( 'change', gulp.series('php-cs') );

});

//gulp.task('default', gulp.series('phpunit','serve'));
gulp.task('default', gulp.series('serve'));