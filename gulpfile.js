/**
 * REQUIRES
 */
var gulp         = require('gulp'),
    browserSync  = require('browser-sync').create(),
    childProcess = require("child_process").exec,
    glupLoadPlu  = require('gulp-load-plugins'),
    jshintXMLReporter = require('gulp-jshint-xml-file-reporter'),

    jshint = require('gulp-jshint'),
    jshintStylishFile = require('jshint-stylish-file'),

    junitFormatter = require('stylelint-junit-formatter'),
    stylelint = require('gulp-stylelint'),
    jest = require('gulp-jest').default;

/*
sudo chown -R $USER:$(id -gn $USER) ~/.npm

 * generator-express
 * generator-webapp
 * generator-modern-frontend
 * generator-starterkit
 
 PHP server (wamp alternative) : "gulp-connect-php"
 */

    
var glp = glupLoadPlu();
const stylish = require('jshint-stylish');
    
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
 * Clean
 */
gulp.task('clean', function(){
    gulp.src( build+'**/*' )
        .pipe(glp.rm( ));
    
    gulp.src( dist+'**/*' )
        .pipe(glp.rm( ));
});
  
/**
 * Css
 */
gulp.task('css', function() { 
    //BUILD
    gulp.src( lessWatch )
        .pipe( glp.less( ) )
        .pipe( glp.autoprefixer() )
        .pipe( gulp.dest( cssBuild ) );

    //VALID
    /*gulp.src( cssBuild+'*.css' )
        .pipe( stylelint({
            reportOutputDir: './var/'
           /* reporters: [
                {formatter: 'string', save: 'csslintreport.txt'}//,
                //{formatter: 'json', save: 'report.json'},
                //{formatter: myStylelintFormatter, save: 'my-custom-report.txt'}
            ]*
        }));*/
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

/*
 * stylelint
 */
gulp.task('stylelint', function(){
    gulp.src(build+cssDir+cssFiles)
        .pipe(stylelint({
            reporters: [
                {formatter: 'verbose', console: true, save: 'var/css_reports/stylelint.txt'}
            ]
        }));
});

/**
 * Javascript
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
 * JSHint
 */
gulp.task('jshint', function() {
  return gulp.src('./build/js/*.js')
    .pipe(glp.jshint())
    .pipe(glp.jshint.reporter(jshintXMLReporter))
    .on('end', jshintXMLReporter.writeFile({
            format: 'checkstyle',
            filePath: './var/jshint.xml'
        }));
      
});

/*gulp.task('jshint', function() {
    gulp.src( [src+jsDir+jsFiles, src+jsDir+jsFiles] )
        .pipe(jshint())
        .pipe(jshint.reporter( 
            jshintStylishFile, 
            {beep: true, output: 'var/js_reports/jshint.txt' }
        ));
});*/

/**
 * Jest
 */
gulp.task('jest', function() {
  return gulp.src('./tests/scripts/outhere.test.js')
     .pipe( jest({
            "outputFile": "./var/testingjest.out.xml"
          }) )
     .pipe( gulp.dest( './var/jest.test' ));
});

/*
 * gulp.task('jest', function() {
    gulp.src(tests+jsDir+jsFiles)
        .pipe( jest() );
});
 */

/**
 * Build task
 */
exports.build = gulp.series(gulp.parallel('css', 'js'));


/**
 * browser
 */
gulp.task('browser-sync-init', function() {
    browserSync.init({
        injectChanges: true,
        files: "** /*",
        proxy: "http://wordpress:8888",
        host: "wordpress",
        browser: "firefox"
    });
});

/*
 * watch
 */
gulp.task('watch', function(){
    gulp.watch( src+lessDir+lessFiles ).on( 'change', gulp.series('css'));
});

gulp.task('serve', gulp.parallel('watch', 'browser-sync-init'), function() {
    gulp.watch( [htmlWatch, cssWatch, phpWatch, jsWatch] ).on( "change", browserSync.reload );

});

/*
 * gulp.task('serve', gulp.parallel('watch','browser-sync-init'), function(){
    gulp.watch( '** /*.php' ).on( 'change', browsersync.reload );
    gulp.watch( build+cssDir+cssFiles ).on( 'change', browsersync.reload );
});
 */

//gulp.task('default', gulp.series('serve'));
exports.default = gulp.series('serve');