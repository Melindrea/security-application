module.exports = function(grunt) {
    'use strict';

    grunt.config('githooks', {
        stage: {
            options: {
                template: 'grunt/hooks/stage.js.hbs'
            },
            'pre-commit': 'commit'
        },
        update: {
            options: {
                template: 'grunt/hooks/update.js.hbs'
            },
            'post-merge': true,
            'post-checkout': true
        }
    });

    grunt.loadNpmTasks('grunt-githooks');

};
