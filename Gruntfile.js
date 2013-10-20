// Generated on 2013-09-06 using generator-melindrea 0.0.0
'use strict';
var LIVERELOAD_PORT = 35729;
var lrSnippet = require('connect-livereload')({port: LIVERELOAD_PORT});
var mountFolder = function (connect, dir) {
    return connect.static(require('path').resolve(dir));
};

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to recursively match all subfolders:
// 'test/spec/**/*.js'

module.exports = function (grunt) {
    // show elapsed time at the end
    require('time-grunt')(grunt);
    // load all grunt tasks
    require('load-grunt-tasks')(grunt);
    grunt.loadNpmTasks('assemble');

    // configurable paths
    var yeomanConfig = {
        app: 'app/src',
        dist: 'public_html/assets',
        php: 'app'

    };

    grunt.initConfig({
        yeoman: yeomanConfig,
        shell: {                                // Task
            phpdocs: {                      // Target
                command: 'php composer_components/bin/phpdoc.php'
            },
            artisan: {
                options: {
                    stdout: true
                },
                command: 'php artisan serve --port=<%= connect.options.port %> --host=<%= connect.options.host %>'
            }
        },
        watch: {
            js: {
                files: ['<%= yeoman.app %>/assets/scripts/{,*/}*.js'],
                tasks: ['js']
            },
            php: {
                files: ['<%= yeoman.php %>/{,*/}*.php'],
                tasks: ['php']
            },
            compass: {
                files: ['<%= yeoman.app %>/assets/styles/{,*/}*.{scss,sass}'],
                tasks: ['compass:server', 'modernizr']
            },
            styles: {
                files: ['<%= yeoman.app %>/assets/styles/{,*/}*.css'],
                tasks: ['copy:styles']
            },
            templates: {
                files: ['<%= yeoman.app %>/templates/{,*/}*.hbs'],
                tasks: ['assemble:pages']
            },
            livereload: {
                options: {
                    livereload: LIVERELOAD_PORT
                },
                files: [
                    '<%= yeoman.app %>/*.html',
                    '<%= yeoman.app %>/templates/{,*/}*.hbs',
                    '.tmp/assets/styles/{,*/}*.css',
                    '{.tmp,<%= yeoman.app %>}/assets/scripts/{,*/}*.js',
                    '<%= yeoman.app %>/assets/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
                ]
            }
        },
        connect: {
            options: {
                port: 9000,
                // change this to '0.0.0.0' to access the server from outside
                hostname: 'localhost'
            },
            livereload: {
                options: {
                    middleware: function (connect) {
                        return [
                            lrSnippet,
                            mountFolder(connect, '.tmp'),
                            mountFolder(connect, yeomanConfig.app)
                        ];
                    }
                }
            },
            test: {
                options: {
                    middleware: function (connect) {
                        return [
                            mountFolder(connect, '.tmp'),
                            mountFolder(connect, 'test'),
                            mountFolder(connect, yeomanConfig.app)
                        ];
                    }
                }
            },
            dist: {
                options: {
                    middleware: function (connect) {
                        return [
                            mountFolder(connect, yeomanConfig.dist)
                        ];
                    }
                }
            }
        },
        open: {
            server: {
                path: 'http://localhost:<%= connect.options.port %>'
            }
        },
        clean: {
            dist: {
                files: [{
                    dot: true,
                    src: [
                        '.tmp',
                        '<%= yeoman.dist %>/*',
                        '!<%= yeoman.dist %>/.git*'
                    ]
                }]
            },
            server: '.tmp',
            report: 'build'
        },
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                '<%= yeoman.app %>/assets/scripts/{,*/}*.js',
                '!<%= yeoman.app %>/assets/scripts/vendor/*',
                'test/spec/mocha/{,*/}*.js'
            ]
        },
        jsvalidate: {
            files: [
                'Gruntfile.js',
                '<%= yeoman.app %>/assets/scripts/{,*/}*.js',
                '!<%= yeoman.app %>/assets/scripts/vendor/*',
                'test/spec/mocha/{,*/}*.js'
            ]
        },
        mocha: {
            all: {
                options: {
                    run: true,
                    urls: ['http://localhost:<%= connect.options.port %>/index.html']
                }
            }
        },
        compass: {
            options: {
                sassDir: '<%= yeoman.app %>/assets/styles',
                cssDir: '.tmp/assets/styles',
                generatedImagesDir: '.tmp/assets/images/generated',
                imagesDir: '<%= yeoman.app %>/assets/images',
                javascriptsDir: '<%= yeoman.app %>/assets/scripts',
                fontsDir: '<%= yeoman.app %>/assets/fonts',
                importPath: '<%= yeoman.app %>/bower_components',
                httpImagesPath: '/assets/images',
                httpGeneratedImagesPath: '/assets/images/generated',
                httpFontsPath: '/assets/fonts',
                relativeAssets: false,
                require: [
                    'breakpoint',
                    'sass-globbing'
                ]
            },
            dist: {
                options: {
                    generatedImagesDir: '<%= yeoman.dist %>/images/generated'
                }
            },
            server: {
                options: {
                    debugInfo: true
                }
            }
        },
        latex: {
            options: {
                haltOnError: true,
                outputDirectory: 'build'
            },
            report: {
                src: ['report/thesis.tex']
            }
        },
        // not used since Uglify task does concat,
        // but still available if needed
        /*concat: {
            dist: {}
        },*/
        rev: {
            dist: {
                files: {
                    src: [
                        '<%= yeoman.dist %>/scripts/{,*/}*.js',
                        '<%= yeoman.dist %>/styles/{,*/}*.css',
                        '<%= yeoman.dist %>/images/{,*/}*.{png,jpg,jpeg,gif,webp}',
                        '<%= yeoman.dist %>/styles/fonts/{,*/}*.*'
                    ]
                }
            }
        },
        assemble: {
            options: {
                flatten: true,
                layout: 'default.hbs',
                layoutdir: '<%= yeoman.app %>/templates/layouts',
                partials: ['<%= yeoman.app %>/templates/partials/*.hbs'],
            },
            pages: {
                files: {
                    '<%= yeoman.app %>/': [
                        '<%= yeoman.app %>/templates/pages/*.hbs'
                    ]
                }
            }
        },
        useminPrepare: {
            options: {
                dest: '<%= yeoman.dist %>'
            },
            html: '<%= yeoman.app %>/index.html'
        },
        usemin: {
            options: {
                dirs: ['<%= yeoman.dist %>']
            },
            html: ['<%= yeoman.dist %>/{,*/}*.html'],
            css: ['<%= yeoman.dist %>/styles/{,*/}*.css']
        },
        imagemin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/images',
                    src: '{,*/}*.{png,jpg,jpeg}',
                    dest: '<%= yeoman.dist %>/images'
                }]
            }
        },
        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/images',
                    src: '{,*/}*.svg',
                    dest: '<%= yeoman.dist %>/images'
                }]
            }
        },
        cssmin: {
            // This task is pre-configured if you do not wish to use Usemin
            // blocks for your CSS. By default, the Usemin block from your
            // `index.html` will take care of minification, e.g.
            //
            //     <!-- build:css({.tmp,app}) styles/main.css -->
            //
            // dist: {
            //     files: {
            //         '<%= yeoman.dist %>/styles/main.css': [
            //             '.tmp/styles/{,*/}*.css',
            //             '<%= yeoman.app %>/styles/{,*/}*.css'
            //         ]
            //     }
            // }
        },
        htmlmin: {
            dist: {
                options: {
                    /*removeCommentsFromCDATA: true,
                    // https://github.com/yeoman/grunt-usemin/issues/44
                    //collapseWhitespace: true,
                    collapseBooleanAttributes: true,
                    removeAttributeQuotes: true,
                    removeRedundantAttributes: true,
                    useShortDoctype: true,
                    removeEmptyAttributes: true,
                    removeOptionalTags: true*/
                },
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>',
                    src: '*.html',
                    dest: '<%= yeoman.dist %>'
                }]
            }
        },
        // Put files not handled in other tasks here
        copy: {
            dist: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= yeoman.app %>',
                    dest: '<%= yeoman.dist %>',
                    src: [
                        '*.{ico,png,txt}',
                        '.htaccess',
                        'images/{,*/}*.{webp,gif}',
                        'styles/fonts/{,*/}*.*'
                    ]
                }]
            },
            styles: {
                expand: true,
                dot: true,
                cwd: '<%= yeoman.app %>/styles',
                dest: '.tmp/styles/',
                src: '{,*/}*.css'
            }
        },
        bumpup: {
            files: ['package.json', 'component.json', 'composer.json']
        },
        modernizr: {
            devFile: '<%= yeoman.app %>/bower_components/modernizr/modernizr.js',
            outputFile: '<%= yeoman.app %>/bower_components/modernizr/modernizr.dev.js',
            files: [
                '<%= yeoman.app %>/assets/scripts/{,*/}*.js',
                '.tmp/assets/styles/{,*/}*.css',
                '!<%= yeoman.app %>/assets/scripts/vendor/*'
            ],
            uglify: true
        },
        concurrent: {
            server: [
                'compass',
                'copy:styles'
            ],
            php: [
                'shell:artisan',
                'watch'
            ],
            test: [
                'copy:styles'
            ],
            dist: [
                'compass',
                'copy:styles',
                'imagemin',
                'svgmin'
            ]
        },
        phplint: {
            options: {
                swapPath: '/tmp'
            },
            all: [
                '<%= yeoman.php %>/**/*.php'
            ]
        },
        phpcs: {
            application: {
                dir: '<%= yeoman.php %>'
            },
            options: {
                bin: 'composer_components/bin/phpcs',
                standard: 'PSR2',
                ignore: 'database',
                extensions: 'php'
            }
        },
        phpunit: {
            classes: {
                dir: 'test'
            },
            options: {
                bin: 'composer_components/bin/phpunit',
                bootstrap: 'bootstrap/autoload.php',
                staticBackup: false,
                colors: true,
                noGlobalsBackup: false
            }
        }
    });

    grunt.registerTask('server', function (target) {
        if (target === 'dist') {
            return grunt.task.run(['build', 'open', 'connect:dist:keepalive']);
        } else if (target === 'php') {
            return grunt.task.run(['open', 'shell:artisan']);
        }

        grunt.task.run([
            'assemble:pages',
            'clean:server',
            'concurrent:server',
            'connect:livereload',
            'open',
            'watch'
        ]);
    });

    grunt.registerTask('test', [
        'clean:server',
        'concurrent:test',
        'connect:test',
        'mocha',
        'phpunit'
    ]);

    grunt.registerTask('build', [
        'assemble:pages',
        'modernizr',
        'clean:dist',
        'useminPrepare',
        'concurrent:dist',
        'concat',
        'cssmin',
        'uglify',
        'copy:dist',
        'usemin'
    ]);

    grunt.registerTask('js', [
        'newer:jsvalidate',
        'newer:jshint',
        'modernizr'
    ]);

    grunt.registerTask('php', [
        'newer:phplint',
        'newer:phpcs',
        'phpunit'
    ]);

    grunt.registerTask('phpdocs', [
        'shell:phpdocs'
    ]);

    grunt.registerTask('lint', [
        'newer:jsvalidate',
        'newer:jshint',
        'php'
    ]);

    grunt.registerTask('commit', [
        'lint'//,
        //'test'
    ]);

    grunt.registerTask('report', [
        'clean:report',
        'latex:report'
    ]);

    grunt.registerTask('default', [
        'lint',
        'php',
        //'test',
        'build'
    ]);
};
