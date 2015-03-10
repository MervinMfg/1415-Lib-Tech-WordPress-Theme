module.exports = function(grunt) {
  // VARIABLES
  var headerScripts = [
    '_/js/lib/modernizr-2.7.2.js'
  ];
  var footerScripts = [
    '_/js/lib/jquery-1.11.1.js',
    '_/js/lib/jquery.fitvids-1.1.0.js',
    '_/js/lib/jquery.bxslider.js',
    '_/js/lib/jquery.magnific-popup.js',
    '_/js/lib/jquery.treeview.js',
    '_/js/lib/jquery.isotope.js',
    '_/js/lib/jquery.unveil.js',
    '_/js/lib/GSAP/TweenMax.js',
    '_/js/lib/GSAP/plugins/ScrollToPlugin.js',
    '_/js/lib/froogaloop.js',
    '_/js/lib/clamp-0.5.1.js',
    '_/js/lib/underscore.js',
    '_/js/libtech.main.js',
    '_/js/components/*.js'
  ];
  var snowboardBuilderScripts = [
    '_/js/lib/GSAP/utils/Draggable.js',
    '_/js/lib/GSAP/plugins/ThrowPropsPlugin.js',
    '_/js/libtech.snowboard-builder.js'
  ];
  var snowboardFinderScripts = [
    '_/js/lib/angular/angular.js',
    '_/js/lib/angular/angular-route.js',
    '_/js/lib/angular/angular-cookies.js',
    '_/apps/snowboard-finder/app.js',
    '_/apps/snowboard-finder/gender/gender.js',
    '_/apps/snowboard-finder/size/size.js',
    '_/apps/snowboard-finder/style/style.js',
    '_/apps/snowboard-finder/results/results.js',
    '_/apps/snowboard-finder/results/snowboard.js',
    '_/apps/snowboard-finder/results/snowboard-filters.js',
    '_/apps/snowboard-finder/why/why.js'
  ];
  var jamieLynnScripts = [
    '_/js/lib/jquery-1.11.1.js',
    '_/js/lib/owl.carousel-2.0.0.js',
    '_/js/lib/GSAP/TweenMax.js',
    '_/js/lib/GSAP/plugins/ScrollToPlugin.js',
    '_/js/lib/jquery.scrollmagic-1.3.0.js',
    '_/js/lib/froogaloop.js',
    '_/js/libtech.jamie-lynn.js'
  ];
  // PROJECT CONFIG
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dev: {
        files: {
          '_/compiled/libtech.main.css': '_/css/libtech.main.scss',
          '_/compiled/libtech.snowboardbuilder.css': '_/css/libtech.snowboardbuilder.scss',
          '_/compiled/libtech.snowboardfinder.css': '_/css/libtech.snowboardfinder.scss',
          '_/compiled/libtech.jamielynn.css': '_/css/libtech.jamielynn.scss'
        },
        options: {
          style: 'expanded',
          sourcemap: 'auto',
          trace: true,
          debugInfo: true,
          lineNumbers: true,
          update: true
        }
      },
      prod: {
        files: {
          '_/css/libtech.main.css': '_/css/libtech.main.scss',
          '_/css/libtech.snowboardbuilder.css': '_/css/libtech.snowboardbuilder.scss',
          '_/css/libtech.snowboardfinder.css': '_/css/libtech.snowboardfinder.scss',
          '_/css/libtech.jamielynn.css': '_/css/libtech.jamielynn.scss'
        },
        options: {
          style: 'compact',
          sourcemap: 'none',
          trace: false,
          debugInfo: false,
          lineNumbers: false
        }
      }
    },
    concat: {
      prod: {
        files: {
          '_/js/libtech.header.min.js': headerScripts,
          '_/js/libtech.footer.min.js': footerScripts,
          '_/js/libtech.footer-snowboard-builder.min.js': snowboardBuilderScripts,
          '_/js/libtech.footer-snowboard-finder.min.js': snowboardFinderScripts,
          '_/js/libtech.footer-jamie-lynn.min.js': jamieLynnScripts
        }
      },
    },
    cssmin: {
      prod: {
        options: {
          banner: '/*! <%= pkg.name %> v<%= pkg.version %> | (c) <%= grunt.template.today("yyyy") %> Mervin Mfg. | mervin.com */\n'
        },
        files: {
          '_/css/libtech.main.min.css': ['_/css/libtech.main.css'],
          '_/css/libtech.snowboardbuilder.min.css': ['_/css/libtech.snowboardbuilder.css'],
          '_/css/libtech.snowboardfinder.min.css': ['_/css/libtech.snowboardfinder.css'],
          '_/css/libtech.jamielynn.min.css': ['_/css/libtech.jamielynn.css']
        }
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> v<%= pkg.version %> | (c) <%= grunt.template.today("yyyy") %> Mervin Mfg. | mervin.com */\n'
      },
      prod: {
        files: {
          '_/js/libtech.header.min.js': ['_/js/libtech.header.min.js'],
          '_/js/libtech.footer.min.js': ['_/js/libtech.footer.min.js'],
          '_/js/libtech.footer-snowboard-builder.min.js': ['_/js/libtech.footer-snowboard-builder.min.js'],
          '_/js/libtech.footer-snowboard-finder.min.js': ['_/js/libtech.footer-snowboard-finder.min.js'],
          '_/js/libtech.footer-jamie-lynn.min.js': ['_/js/libtech.footer-jamie-lynn.min.js']
        }
      }
    },
    watch: {
      markup: {
        files: ['*.php', 'page-templates/*.php', '_/inc/**/*.php'],
        options: {
          livereload: true,
        }
      },
      js: {
        files: ['_/js/*.js', '_/js/**/*.js'],
        options: {
          livereload: true
        }
      },
      sass: {
        files: ['_/css/*.scss', '_/css/**/*.scss'],
        tasks: ['sass:dev'],
        options: {
          livereload: true
        }
      }
    }
  });
  // NPM TASKS
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  // GRUNT TASKS
  grunt.registerTask('run', ['sass:dev', 'scriptblock']); //default
  grunt.registerTask('build', ['sass:prod', 'concat', 'cssmin', 'uglify', 'scriptblock']);
  // Automate creation of scriptblock to be loaded in footer
  grunt.registerTask('scriptblock', function() {
    var scriptVersion, scriptHeader, scriptFooter, scriptSnowboardBuilder, scriptSnowboardFinder, scriptJamieLynn, headerFiles, footerFiles, snowboardBuilderFiles, snowboardFinderFiles, jamieLynnFiles;
    // write script version, same as project version
    scriptVersion = "<?php $GLOBALS['SCRIPT_VERSION'] = '" + grunt.file.readJSON('package.json').version + "'; ?>";
    grunt.file.write('_/inc/script-version.php', scriptVersion);
    // write header script
    scriptHeader = scriptFooter = scriptSnowboardBuilder = scriptSnowboardFinder = scriptJamieLynn = '<?php // AUTO-GENERATED BY GRUNT. To change this block edit Gruntfile.js, not this file! ?>\n';
    // generate header script includes
    headerScripts.forEach(function(path) {
      headerFiles = grunt.file.expand(path);
      headerFiles.forEach(function(file) {
        scriptHeader += '\t<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/' + file + '"></script>\n';
      });
      grunt.file.write('_/inc/header-scripts.php', scriptHeader);
    });
    // generate footer script includes
    footerScripts.forEach(function(path) {
      footerFiles = grunt.file.expand(path);
      footerFiles.forEach(function(file) {
        scriptFooter += '\t<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/' + file + '"></script>\n';
      });
      grunt.file.write('_/inc/footer-scripts.php', scriptFooter);
    });
    // generate board builder script includes
    snowboardBuilderScripts.forEach(function(path) {
      snowboardBuilderFiles = grunt.file.expand(path);
      snowboardBuilderFiles.forEach(function(file) {
        scriptSnowboardBuilder += '\t<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/' + file + '"></script>\n';
      });
      grunt.file.write('_/inc/footer-scripts-snowboard-builder.php', scriptSnowboardBuilder);
    });
    // generate board finder script includes
    snowboardFinderScripts.forEach(function(path) {
      snowboardFinderFiles = grunt.file.expand(path);
      snowboardFinderFiles.forEach(function(file) {
        scriptSnowboardFinder += '\t<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/' + file + '"></script>\n';
      });
      grunt.file.write('_/inc/footer-scripts-snowboard-finder.php', scriptSnowboardFinder);
    });
    // generate jamie lynn script includes
    jamieLynnScripts.forEach(function(path) {
      jamieLynnFiles = grunt.file.expand(path);
      jamieLynnFiles.forEach(function(file) {
        scriptJamieLynn += '\t<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/' + file + '"></script>\n';
      });
      grunt.file.write('_/inc/footer-scripts-jamie-lynn.php', scriptJamieLynn);
    });
  });
};
