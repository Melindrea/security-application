module.exports = function(grunt) {
    'use strict';

    grunt.config('compress', {
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
    });

    grunt.loadNpmTasks('grunt-contrib-compress');

};
