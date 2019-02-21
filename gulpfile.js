var gulp        = require('gulp'),
    browserSync = require('browser-sync').create(),
    reload      = browserSync.reload;

var htmlWatch  = '**/*.html',
    phpWatch   = '**/*.php',
    cssWatch   = '**/*.css',
    jsWatch   = '**/*.js',
    sassWatch  = '**/*.sass',
    cofeeWatch = '**/*.cofee';
    
var jsSrc = 'src/js/',
    jsDist = 'dist/js/';

gulp.task('browser-sync', function() {
    browserSync.init({
        injectChanges: true,
        watch: true,
        files: "**/*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
});

gulp.task('serve', function() {
    browserSync.init({
        injectChanges: true,
        watch: true,
        files: "**/*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
    
    //gulp.watch( htmlWatch, reload );
    //gulp.watch( phpWatch, reload );
    gulp.watch( [htmlWatch, phpWatch, cssWatch] ).on("change", browserSync.reload);
    //gulp.watch( "**/*.css" ).on("change", browserSync.reload);
    //gulp.watch( "**/*.html" ).on("change", browserSync.reload);
    //gulp.watch( "**/*.js" ).on("change", browserSync.reload);
});

gulp.task('default', gulp.series('serve'));