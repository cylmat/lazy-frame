var gulp        = require('gulp'),
    browserSync = require('browser-sync').create(),
    reload      = browserSync.reload;

var htmlWatch = '**/*.html';
var phpWatch = '**/*.php';

/*gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "http://wordpress:8888"
    });
});*/

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
    gulp.watch( "**/*.php" ).on("change", browserSync.reload);
    gulp.watch( "**/*.css" ).on("change", browserSync.reload);
    gulp.watch( "**/*.html" ).on("change", browserSync.reload);
    gulp.watch( "**/*.js" ).on("change", browserSync.reload);
});

gulp.task('default', gulp.series('serve'));