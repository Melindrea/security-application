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
    var composer = require('./composer');
    var directoriesConfig = {
        composer: composer.config['vendor-dir'] || 'vendor',
        composerBin: composer.config['bin-dir'] || 'vendor/bin',
        docs: 'docs',
        testsPHP: 'test/phpunit',
        testsJS: 'test/mocha',
        php: 'app',
        tmp: '.tmp',
        flatBuild: {
            base: 'app/src',
            js: 'app/src/assets/scripts'
        },
        assets: 'public_html/assets',
        ember: {
            templates: 'app/src/templates/ember',
            scripts: 'app/src/assets/scripts/ember-app'
        }
    };

    grunt.initConfig({
        pkg: require('./package'),
        composer: composer,
        yeoman: yeomanConfig,
        directories: directoriesConfig,
        files: {
            js: [
                'Gruntfile.js',
                'grunt/{,*/}*.js',
                '<%= directories.flatBuild.js %>/{,*/}*.js',
                '!<%= directories.flatBuild.js %>/vendor/*',
                '!<%= directories.ember.scripts %>/*',
                '<%= directories.testsJS %>/{,*/}*.js'

            ],
            json: [
                '*.json',
                'app/metadata/**/*.json'
            ],
            php: '<%= directories.php %>/**/*.php',
            assets: 'public_html/assets/**/*',
            ember: {
                templates: '<%= directories.ember.templates %>/**/*.hbs',
                scripts: '<%= directories.ember.scripts %>/{,*/}*.js'
            }
        },
        'gh-pages': {
            options: {
                base: '<%= yeoman.dist %>'
            },
            src: '**/*'
        },
        watch: {
            emberTemplates: {
                files: ['<%= files.ember.templates %>'],
                tasks: ['emberTemplates']
            },
            neuter: {
                files: ['<%= files.ember.scripts %>'],
                tasks: ['neuter']
            },
            js: {
                files: ['<%= directories.flatBuild.js %>/{,*/}*.js'],
                tasks: ['js']
            },
            php: {
                files: ['<%= files.php %>'],
                tasks: ['php']
            },
            compass: {
                files: ['<%= directories.flatBuild.base %>/assets/styles/{,*/}*.{scss,sass}'],
                tasks: ['compass:server', 'autoprefixer']
            },
            styles: {
                files: ['<%= directories.flatBuild.base %>/assets/styles/{,*/}*.css'],
                tasks: ['copy:styles', 'autoprefixer']
            },
            templates: {
                files: ['<%= directories.flatBuild.base %>/templates/pages/{,*/}*.hbs'],
                tasks: ['newer:assemble:pages']
            },
            layouts: {
                files: ['<%= directories.flatBuild.base %>/templates/layouts/{,*/}*.hbs'],
                tasks: ['assemble:pages']
            },
            livereload: {
                options: {
                    livereload: '<%= connect.options.livereload %>'
                },
                files: [
                    '<%= directories.flatBuild.base %>/*.html',
                    '<%= directories.flatBuild.base %>/templates/{,*/}*.hbs',
                    '.tmp/assets/styles/{,*/}*.css',
                    '{.tmp,<%= directories.flatBuild.base %>}/assets/scripts/{,*/}*.js',
                    '<%= directories.flatBuild.base %>/assets/media/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
                ]
            }
        },
        pa11ySitemap: {
            options: {
                reporter: 'json'
            },
            all: {
                urls: '../app/metadata/sitemap'
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
                    hostname: 'localhost',
                    open: true,
                    base: [
                        '.tmp',
                        '<%= directories.flatBuild.base %>'
                    ]
                }
            },
            test: {
                options: {
                    base: [
                        '.tmp',
                        'test/mocha',
                        '<%= directories.flatBuild.base %>'
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
                sassDir: '<%= directories.flatBuild.base %>/assets/styles',
                cssDir: '.tmp/assets/styles',
                generatedImagesDir: '.tmp/assets/images/generated',
                imagesDir: '<%= directories.flatBuild.base %>/assets/media/images',
                javascriptsDir: '<%= directories.flatBuild.js %>',
                fontsDir: '<%= directories.flatBuild.base %>/assets/fonts',
                importPath: '<%= directories.flatBuild.base %>/bower_components',
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
                layoutdir: '<%= directories.flatBuild.base %>/templates/layouts',
                partials: ['<%= directories.flatBuild.base %>/templates/partials/*.hbs'],
                helpers: '<%= directories.flatBuild.base %>/templates/helpers/*.js',
                pkg: '<%= pkg %>',
                data: '<%= directories.flatBuild.base %>/data/*.json',
            },
            pages: {
                files: {
                    '<%= directories.flatBuild.base %>/': [
                        '<%= directories.flatBuild.base %>/templates/pages/*.hbs'
                    ]
                }
            }
        },
        useminPrepare: {
            options: {
                dest: '<%= yeoman.dist %>'
            },
            html: '<%= directories.flatBuild.base %>/index.html'
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
                    cwd: '<%= directories.flatBuild.base %>/assets/media/images',
                    src: '{,*/}*.{png,jpg,jpeg}',
                    dest: '<%= yeoman.dist %>/assets/media/images'
                }]
            }
        },
        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= directories.flatBuild.base %>/assets/media/images',
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
            //             '<%= directories.flatBuild.base %>/styles/{,*/}*.css'
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
                    cwd: '<%= directories.flatBuild.base %>',
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
                    cwd: '<%= directories.flatBuild.base %>',
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
                cwd: '<%= directories.flatBuild.base %>/assets/styles',
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
            files: ['package.json', 'component.json', 'composer.json', 'bower.json']
        },
        modernizr: {
            devFile: '<%= directories.flatBuild.base %>/bower_components/modernizr/modernizr.js',
            outputFile: '<%= directories.flatBuild.base %>/bower_components/modernizr/modernizr.dev.js',
            files: [
                '<%= directories.flatBuild.js %>/{,*/}*.js',
                '.tmp/assets/styles/{,*/}*.css',
                '!<%= directories.flatBuild.js %>/vendor/*'
            ],
            uglify: true
        },
        concurrent: {
            server: [
                'emberTemplates',
                'compass',
                'copy:styles'
            ],
            php: [
                'shell:artisan',
                'watch'
            ],
            test: [
                'emberTemplates',
                'compass',
                'copy:styles'
            ],
            dist: [
                'emberTemplates',
                'compass',
                'copy:styles',
                'imagemin',
                'svgmin',
                'htmlmin'
            ]
        },
        emberTemplates: {
            options: {
                templateName: function (sourceFile) {
                    var templatePath = directoriesConfig.ember.templates + '/';
                    return sourceFile.replace(templatePath, '');
                }
            },
            dist: {
                files: {
                    '.tmp/scripts/compiled-templates.js': '<%= files.ember.templates %>'
                }
            }
        },
        neuter: {
            app: {
                options: {
                    filepathTransform: function (filepath) {
                        return directoriesConfig.ember.scripts + '/' + filepath;
                    }
                },
                src: '<%= directories.ember.scripts %>/app.js',
                dest: '.tmp/scripts/combined-app.js'
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
            'neuter:app',
            'connect:livereload',
            'watch'
        ]);
    });

    grunt.registerTask('test', [
        'clean:server',
        'concurrent:test',
        'autoprefixer',
        'connect:test',
        'neuter:app',
        'mocha'//,
        // 'phpunit'
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
            'neuter:app',
            'concat',
            'cssmin',
            'uglify',
            'copy:dist',
            'rev',
            'usemin'
        ]);
    });

    grunt.loadTasks('grunt/tasks');
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
        'phpcs:application',
        'phpcs:tests'
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
