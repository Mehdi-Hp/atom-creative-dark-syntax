var gulp        = require('gulp');
var gutil       = require('gulp-util');
var rename      = require('gulp-rename');
var concat      = require('gulp-concat');
var uglify      = require('gulp-uglify');
var plumber     = require('gulp-plumber');
var cssmin      = require('gulp-cssmin');
var htmlmin     = require('gulp-htmlmin');
var imagemin    = require('gulp-imagemin');
var pngquant    = require('imagemin-pngquant');
var sass        = require('gulp-sass');

var livereload  = require('gulp-livereload');

var postCSS     = require('gulp-postcss');
var cssnext     = require('cssnext');
var rucksack    = require('rucksack-css');


var sassFile = ['./builds/development/assets/sass/main.scss'];
var sassForWatch = ['./builds/development/assets/sass/*/*.scss'];
var jsSource = ['./builds/development/assets/js/jquery.min.js', './builds/development/assets/js/*.*'];
var htmlSource = ['./builds/development/*.php'];
var imgSource = ['./builds/development/assets/images/*.*'];
var fontSource = ['./builds/development/assets/fonts/*/*.*'];
var server = livereload();


gulp.task('postCSS', function(){
   var processor = [
      cssnext,
      rucksack({
         autoprefixer: false
      })
   ];
   gulp.src(sassFile)
       .pipe(plumber())
       .pipe(sass())
       .pipe(postCSS(processor))
       .pipe(rename('main.css'))
       .pipe(cssmin())
       .pipe(rename({
          suffix: '.min'
       }))
       .pipe(gulp.dest('./builds/production/assets/css/'))
       .pipe(livereload());
});


gulp.task('javascript', function(){
   gulp.src(jsSource)
       .pipe(plumber())
       .pipe(concat('all.js'))
       .pipe(uglify())
       .pipe(rename({
          suffix: '.min'
       }))
       .pipe(gulp.dest('./builds/production/assets/js/'))
       .pipe(livereload());
});

gulp.task('html', function(){
   gulp.src(htmlSource)
       .pipe(plumber())
      //  .pipe(htmlmin({
      //     removeComments: true,
      //     removeCommentsFromCDATA: true,
      //     removeAttributeQuotes: true,
      //     removeRedundantAttributes: true,
      //     useShortDoctype: true,
      //     removeEmptyAttributes: true,
      //     removeScriptTypeAttributes: true,
      //  }))
       .pipe(gulp.dest('./builds/production/'))
       .pipe(livereload());
});

gulp.task('image', function () {
    gulp.src(imgSource)
        .pipe(plumber())
      //   .pipe(imagemin({
      //       progressive: true,
      //       svgoPlugins: [{removeViewBox: false}],
      //       use: [pngquant()]
      //   }))
        .pipe(gulp.dest('./builds/production/assets/images'))
        .pipe(livereload());
});

gulp.task('fonts', function () {
    gulp.src(fontSource)
        .pipe(plumber())
        .pipe(gulp.dest('./builds/production/assets/fonts'))
        .pipe(livereload());
});


gulp.task('watch', function(){
   livereload.listen();
   gulp.watch(sassFile, ['postCSS']);
   gulp.watch(sassForWatch, ['postCSS']);
   gulp.watch(jsSource, ['javascript']);
   gulp.watch(htmlSource, ['html']);
   gulp.watch(imgSource, ['image']);
   gulp.watch(fontSource, ['fonts']);
});

gulp.task('default', [
   'postCSS',
   'javascript',
   'html',
   'image',
   'fonts',
   'watch'
]);
