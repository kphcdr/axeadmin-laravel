/**
 axestatic std 构建
*/

var pkg = require('./package.json');
var inds = pkg.independents;

var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var replace = require('gulp-replace');
var header = require('gulp-header');
var del = require('del');
var gulpif = require('gulp-if');
var minimist = require('minimist');

//获取参数
var argv = require('minimist')(process.argv.slice(2), {
  default: {
    ver: 'all' 
  }
})

//注释
,note = [
  '/** <%= pkg.name %>-v<%= pkg.version %> <%= pkg.license %> License By <%= pkg.homepage %> */\n <%= js %>'
  ,{pkg: pkg, js: ';'}
]

,destDir = './dist' //构建的目标目录
,releaseDir = './release/axestatic/'+ pkg.name +'-v' + pkg.version //发行版本目录

//任务
,task = {
  //压缩 JS
  minjs: function(){
    var src = [
      './src/axestatic/**/*.js'
      ,'!./src/axestatic/json/**/*.js'
      ,'!./src/axestatic/layui/**/*.js'
      ,'!./src/axestatic/config.js'
      ,'!./src/axestatic/lib/extend/echarts.js'
    ];
    
    return gulp.src(src).pipe(uglify())
     .pipe(header.apply(null, note))
    .pipe(gulp.dest(destDir + '/axestatic'));
  }
  
  //压缩 CSS
  ,mincss: function(){
    var src = [
      './src/axestatic/**/*.css'
      ,'!./src/axestatic/layui/**/*.css'
    ]
     ,noteNew = JSON.parse(JSON.stringify(note));
     
     
    noteNew[1].js = '';
    
    return gulp.src(src).pipe(minify({
      compatibility: 'ie7'
    })).pipe(header.apply(null, noteNew))
    .pipe(gulp.dest(destDir + '/axestatic'));
  }
  
  //复制文件夹
  ,mv: function(){    
    gulp.src('./src/axestatic/json/**/*')
    .pipe(gulp.dest(destDir + '/axestatic/json'));
    
    gulp.src('./src/axestatic/lib/extend/echarts.js')
    .pipe(gulp.dest(destDir + '/axestatic/lib/extend'));
    
    gulp.src('./src/axestatic/config.js')
    .pipe(gulp.dest(destDir + '/axestatic'));
    
    gulp.src('./src/axestatic/tpl/**/*')
    .pipe(gulp.dest(destDir + '/axestatic/tpl'));
    
    gulp.src('./src/axestatic/style/res/**/*')
    .pipe(gulp.dest(destDir + '/axestatic/style/res'));

    gulp.src('./src/axestatic/style/res/*')
    .pipe(gulp.dest(destDir + '/axestatic/style/res'));

    gulp.src('./src/axestatic/layui/*')
        .pipe(gulp.dest(destDir + '/axestatic/layui/'));
    gulp.src('./src/axestatic/layui/**/*')
        .pipe(gulp.dest(destDir + '/axestatic/layui/'));
    // return gulp.src('./src/views/**/*')
    // .pipe(gulp.dest(destDir + '/views'));
  }
};


//清理
gulp.task('clear', function(cb) {
  return del(['./dist/*'], cb);
});

gulp.task('minjs', task.minjs);
gulp.task('mincss', task.mincss);
gulp.task('mv', task.mv);
gulp.task('layui', task.layui);

gulp.task('src', function(){ //命令：gulp src
  return gulp.src('./dev-std/**/*')
  .pipe(gulp.dest('./src'));
});

//构建核心源文件
gulp.task('default', ['clear', 'src'], function(){ //命令：gulp
  for(var key in task){
    task[key]();
  }
});