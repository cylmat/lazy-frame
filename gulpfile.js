/*
 * REQUIRES
 */
var gulp          = require('gulp'),
    gulpLess      = require('gulp-less'),
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

var src  = './src/',
    dist = './dist/',
    css = './dist/';

var jsSrc  = 'src/js/',
    jsDist = 'dist/js/';

gulp.task('phpunit', function() {
    child_process("phpunit", function(error, stdout) {
        console.log(error+stdout);
    });
});  
  
/*
 * Less
 */
gulp.task('compile-less', function() {  
    return gulp.src( lessWatch )
        .pipe( gulpLess( ) )
        .pipe( gulp.dest('./dist/css/') );
}); 

gulp.task('phpunit', function() {
    child_process("phpunit", function(error, stdout) {
        console.log(error+stdout);
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
    
    //gulp.series('browser-sync');
    //gulp.watch( htmlWatch, reload );
    //gulp.watch( phpWatch, reload );
    gulp.watch( [htmlWatch, cssWatch, phpWatch, jsWatch] ).on( "change", browserSync.reload );
    gulp.watch( phpWatch ).on( "change", gulp.series('phpunit') );

    //gulp.watch("./src/less/*.less").on("change", reload);
    //gulp.watch("./dist/*.html").on("change", reload);
    
    //gulp.watch( htmlWatch, reload );
    //gulp.watch( phpWatch, reload );
    //gulp.watch( [htmlWatch, phpWatch, cssWatch] ).on("change"); //, browserSync.reload);
});

//gulp.task('default', gulp.series('phpunit','serve'));
gulp.task('default', gulp.series('serve'));