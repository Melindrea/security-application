module.exports = function(grunt) {
    'use strict';

    grunt.config('clean', {
        phpdocumentor: '<%= phpdocumentor.dist.target %>',
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
        server: '<%= directories.tmp %>',
        report: 'build',
        assets: '<%= files.assets %>',
        deploy: {
            files: [{
                dot: true,
                src: [
                    '.build',
                    '*.zip'
                ]
            }]
        }
    });

    grunt.loadNpmTasks('grunt-contrib-clean');

};
