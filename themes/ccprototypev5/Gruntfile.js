module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options:  {
          sourcemap:  'none',
          style:      'expanded'
        },
        files:  {
          'css/cc-style.css':  'css/cc-style.scss'
        }
      }
    },
    postcss: {
      options: {
        processors: [
          require('autoprefixer')(),
          require('cssnano')()
        ]
      },
      dist: {
        src:  'css/cc-style.css',
        dest: 'css/cc-style-dist.css'
      }
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: ['js/libraries/*.js', 'js/theme/*.js'],
        dest: 'js/cc-script.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          'js/cc-script-dist.js': ['<%= concat.dist.dest %>']
        }
      }
    },
    'sftp-deploy': {
      build: {
        auth: {
          host: '',
          port: 2222,
          authKey: {
            username:   '',
            password:   ''
          }
        },
        cache: 'sftpCache.json',
        src: ['..'],
        dest: 'wp-content/themes',
        exclusions: ['node_modules', '.sass-cache', 'Gruntfile.js'],
        serverSep: '/',
        localSep: '/',
        concurrency: 4,
        progress: true
      }
    },
    copy: {
      main: {
        expand: true,
        src:  '*',
        dest: 'Z:/(PROJECT DIRECTORY NAME)/www-(THEMENAME)/wp-content/themes/ccprototypev5'
      }
    },
    watch: {
      sass: {
        files:  ['css/partials/*.scss', 'css/partials/**/*.scss', 'css/cc-style.scss'],
        tasks:  ['css']
      },
      js: {
        files:  ['js/libraries/*.js', 'js/theme/*.js'],
        tasks:  ['js']
      },
      /*
      other: {
        files:  ['*.php', 'classes/**', 'fonts/**', 'images/**', 'includes/**'],
        tasks:  ['other']
      }
      */
    },
    concurrent: {
      task1: ['watch', 'task-interval'],
      options: {
        logConcurrentOutput: true
      }
    },
    'task-interval': {
      dist: {
        options: {
          taskIntervals: [
            {interval: 1000 * 60 * 5, tasks: ['copy', 'sftp-deploy']}
          ]
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-sftp-deploy');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-task-interval');
  grunt.loadNpmTasks('grunt-concurrent');

  grunt.registerTask('default', ['sass', 'postcss', 'concat', 'uglify']);
  grunt.registerTask('css', ['sass', 'postcss']);
  grunt.registerTask('js', ['concat', 'uglify']);
  grunt.registerTask('cc-monitor', 'concurrent:task1');
  grunt.registerTask('cc-deploy', ['copy', 'sftp-deploy']);


};