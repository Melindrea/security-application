// Generated on 2013-09-06 using generator-melindrea 0.0.0
'use strict';

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
        // dist: 'public_html/assets',
        dist: 'dist',
        php: 'app'

    };

    grunt.initConfig({
        yeoman: yeomanConfig,
        'gh-pages': {
            options: {
                base: '<%= yeoman.dist %>'
            },
            src: '**/*'
        },
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
                tasks: ['compass:server', 'autoprefixer']
            },
            styles: {
                files: ['<%= yeoman.app %>/assets/styles/{,*/}*.css'],
                tasks: ['copy:styles', 'autoprefixer']
            },
            templates: {
                files: ['<%= yeoman.app %>/templates/pages/{,*/}*.hbs'],
                tasks: ['newer:assemble:pages']
            },
            layouts: {
                files: ['<%= yeoman.app %>/templates/layouts/{,*/}*.hbs'],
                tasks: ['assemble:pages']
            },
            livereload: {
                options: {
                    livereload: '<%= connect.options.livereload %>'
                },
                files: [
                    '<%= yeoman.app %>/*.html',
                    '<%= yeoman.app %>/templates/{,*/}*.hbs',
                    '.tmp/assets/styles/{,*/}*.css',
                    '{.tmp,<%= yeoman.app %>}/assets/scripts/{,*/}*.js',
                    '<%= yeoman.app %>/assets/media/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
                ]
            }
        },
        connect: {
            options: {
                port: 9000,
                livereload: 35729,
                // change this to '0.0.0.0' to access the server from outside
                hostname: 'localhost'
            },
            livereload: {
                options: {
                    open: true,
                    base: [
                        '.tmp',
                        '<%= yeoman.app %>'
                    ]
                }
            },
            test: {
                options: {
                    base: [
                        '.tmp',
                        'test/mocha',
                        '<%= yeoman.app %>'
                    ]
                }
            },
            dist: {
                options: {
                    open: true,
                    base: '<%= yeoman.dist %>'
                }
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
            temporary: '.build/app/storage/{meta,cache,views,logs}/*',
            server: '.tmp',
            report: 'build',
            assets: 'public_html/assets/**/*',
            deploy: {
                files: [{
                    dot: true,
                    src: [
                        '.build',
                        '*.zip'
                    ]
                }]
            }
        },
        compress: {
            deploy: {
                options: {
                    archive: 'deploy.zip',
                    mode: 'zip'
                },
                files: [{
                    expand: true,
                    cwd: '.build',
                    src: ['**'],
                    dest: '/'
                }, {
                    expand: true,
                    src: [
                        'artisan',
                        'bootstrap/**',
                        'composer.json'
                    ],
                    dest: '/'
                }]
            }
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
        jsonlint: {
            data: {
                src: [
                    '<%= yeoman.php %>/metadata/**/*.json'
                ]
            }
        },
        mocha: {
            all: {
                options: {
                    run: true,
                    urls: ['http://<%= connect.test.options.hostname %>:<%= connect.test.options.port %>/index.html']
                }
            }
        },
        compass: {
            options: {
                sassDir: '<%= yeoman.app %>/assets/styles',
                cssDir: '.tmp/assets/styles',
                generatedImagesDir: '.tmp/assets/images/generated',
                imagesDir: '<%= yeoman.app %>/assets/media/images',
                javascriptsDir: '<%= yeoman.app %>/assets/scripts',
                fontsDir: '<%= yeoman.app %>/assets/fonts',
                importPath: '<%= yeoman.app %>/bower_components',
                httpImagesPath: '/assets/media/images',
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
        autoprefixer: {
            options: {
                browsers: ['last 1 version']
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: '.tmp/styles/',
                    src: '{,*/}*.css',
                    dest: '.tmp/styles/'
                }]
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
                        '<%= yeoman.dist %>/assets/scripts/{,*/}*.js',
                        '<%= yeoman.dist %>/assets/styles/{,*/}*.css',
                        // '<%= yeoman.dist %>/assets/media/images/{,*/}*.{png,jpg,jpeg,gif,webp}',
                        '<%= yeoman.dist %>/assets/fonts/{,*/}*.*'
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
            css: ['<%= yeoman.dist %>/assets/styles/{,*/}*.css']
        },
        imagemin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/assets/media/images',
                    src: '{,*/}*.{png,jpg,jpeg}',
                    dest: '<%= yeoman.dist %>/assets/media/images'
                }]
            }
        },
        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/assets/media/images',
                    src: '{,*/}*.svg',
                    dest: '<%= yeoman.dist %>/assets/media/images'
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
                        'assets/media/images/{,*/}*.{webp,gif}',
                        'assets/fonts/{,*/}*.*'
                    ]
                }]
            },
            styles: {
                expand: true,
                dot: true,
                cwd: '<%= yeoman.app %>/assets/styles',
                dest: '.tmp/assets/styles/',
                src: '{,*/}*.css'
            },
            deploy: {
                files: [{
                    expand: true,
                    dot: true,
                    dest: '.build',
                    src: [
                        'app/**',
                        '!app/src/**'
                    ]
                }, {
                    expand: true,
                    dot: true,
                    dest: '.build',
                    src: [
                        'public_html/**'
                    ]
                }]
            },
            assets: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= yeoman.dist %>/assets',
                    dest: 'public_html/assets/',
                    src: '**/*'
                }]
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
                'svgmin',
                'htmlmin'
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
            tests: {
                dir: 'test/phpunit'
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
                dir: 'test/phpunit/tests'
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
            return grunt.task.run(['build', 'connect:dist:keepalive']);
        } else if (target === 'php') {
            return grunt.task.run(['open', 'shell:artisan']);
        }

        grunt.task.run([
            'assemble:pages',
            'clean:server',
            'concurrent:server',
            'autoprefixer',
            'connect:livereload',
            'watch'
        ]);
    });

    grunt.registerTask('test', [
        'clean:server',
        'concurrent:test',
        'autoprefixer',
        'connect:test',
        'mocha',
        'phpunit'
    ]);

    grunt.registerTask('build', function (target) {
        if (target === 'deploy') {
            return grunt.task.run([
                'build:assets',
                // Add task to go through the assets to fix them
                'clean:deploy',
                'copy:deploy',
                'clean:temporary',
                'compress:deploy'
            ]);
        } else if (target === 'assets') {
            return grunt.task.run([
                'build',
                'clean:assets',
                'copy:assets'
            ]);
        }

        grunt.task.run([
            'assemble:pages',
            'modernizr',
            'clean:dist',
            'useminPrepare',
            'concurrent:dist',
            'autoprefixer',
            'concat',
            'cssmin',
            'uglify',
            'copy:dist',
            'rev',
            'usemin'
        ]);
    });

    grunt.registerTask('deploy', [
        'build',
        'gh-pages'
    ]);

    grunt.registerTask('js', [
        'newer:jsvalidate',
        'newer:jshint',
        'modernizr'
    ]);

    grunt.registerTask('php', [
        'phplint',
        'phpcs'
    ]);

    grunt.registerTask('phpdocs', [
        'shell:phpdocs'
    ]);

    grunt.registerTask('lint', [
        'newer:jsvalidate',
        'newer:jshint',
        'php',
        'newer:jsonlint'
    ]);

    grunt.registerTask('commit', [
        'lint',
        'test'
    ]);

    grunt.registerTask('report', [
        'clean:report',
        'latex:report'
    ]);

    grunt.registerTask('default', [
        'lint',
        'test',
        'build'
    ]);
};
