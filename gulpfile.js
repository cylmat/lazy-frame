/**
 * REQUIRES
 */
var gulp         = require('gulp'),
    browserSync  = require('browser-sync').create(),
    childProcess = require("child_process").exec,
    glupLoadPlugins  = require('gulp-load-plugins');
    
var glp = glupLoadPlugins();
    
/**
* WATCHES
*/
var src  = './src/',
    build= './build', 
    dist = './dist/';


var htmlWatch  = src+'**/*.html',
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
 * Less
 */
gulp.task('less', function() {  
    gulp.src( lessWatch )
        .pipe( glp.less( ) )
        .pipe( gulp.dest( cssBuild ) )
        .pipe( browserSync.reload() );
}); 

gulp.task('minify', function(){
    gulp.src('');
});

/**
 * Php-unit
 *
gulp.task('php-unit', function() {
    child_process("phpunit -c ./config/phpunit.xml", function(error, stdout, stderr) {
        console.log('error'+error);
        console.log("stdout:"+stdout);
        console.log("stderr:"+stdout);
    });
});

/**
 * Php-cs
 *
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
 *
gulp.task('php-md', function() {
    child_process('phpmd ./application xml ./config/phpmd.xml --reportfile ./var/logphpmd.xml', function(error, stdout) {
        console.log('error:'+error);
        console.log('stdout:'+stdout);
    });
});*/



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
    gulp.watch( [lessWatch] ).on( "change", gulp.series('less'));
    
    //gulp.watch( phpIndexWatch ).on( "change", gulp.series('php-unit') );
    //gulp.watch( phpIndexWatch ).on( 'change', gulp.series('php-cs') );
    //gulp.watch( phpIndexWatch ).on( 'change', gulp.series('php-md') );

});

//gulp.task('default', gulp.series('phpunit','serve'));
gulp.task('default', gulp.series('serve'));