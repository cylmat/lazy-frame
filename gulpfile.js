/**
 * REQUIRES
 */
var gulp         = require('gulp'),
    browserSync  = require('browser-sync').create(),
    childProcess = require("child_process").exec,
    glupLoadPlu  = require('gulp-load-plugins'),
    stylelint    = require('gulp-stylelint') ;
    
var glp = glupLoadPlu();
    
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
var cssBuild = build+'css/',
    jsBuild  = build+'js/'; 

/**
 * Dist
 */
var cssDist = dist+'css/';
var scriptDist = dist+'js/';

/**
 * remove
 */
gulp.task('clean', function(){
    gulp.src( build+'**/*' )
        .pipe(glp.rm( ));
    
    gulp.src( dist+'**/*' )
        .pipe(glp.rm( ));
});
  
/**
 * Less
 */
gulp.task('css', function() { 
    //BUILD
    gulp.src( lessWatch )
        .pipe( glp.less( ) )
        .pipe( glp.autoprefixer() )
        .pipe( gulp.dest( cssBuild ) );

    //VALID
    gulp.src( cssBuild+'*.css' )
        .pipe( stylelint({
            reportOutputDir: './var/'
           /* reporters: [
                {formatter: 'string', save: 'csslintreport.txt'}//,
                //{formatter: 'json', save: 'report.json'},
                //{formatter: myStylelintFormatter, save: 'my-custom-report.txt'}
            ]*/
        }));
        /*.pipe( glp.rename( function(a){
            a.extname = '.valid';
        }))*/
        //.pipe( gulp.dest(build+'cssvalid') );

    //MIN
    gulp.src( cssBuild+'*.css' )
        .pipe( glp.uglifycss( ) )
        .pipe( glp.rename({suffix: '.min'}))
        .pipe( gulp.dest( cssDist ) );
}); 

/**
 * Coffee
 */
gulp.task('js', function() {
    gulp.src( coffeeSrc )
        .pipe( glp.coffee( {bare: true} ) )
        .pipe( gulp.dest( jsBuild ))

        .pipe( glp.uglify() )
        .pipe( glp.rename( {'suffix': '.min'} ))
        .pipe( gulp.dest( jsDist ));
});

/**
 * build
 */
/*gulp.task('build', gulp.series('clean'), function(){
    gulp.series('less', 'coffee');
});*/

exports.build = gulp.series(gulp.parallel('css', 'js'));


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

//gulp.task('default', gulp.series('serve'));
exports.default = gulp.series('serve');