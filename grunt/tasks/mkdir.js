module.exports = function(grunt) {
    'use strict';

    grunt.config('mkdir', {
        phpmd: {
            options: {
                create: ['<%= directories.docs %>/phpmd']
            },
        }
    });

    grunt.loadNpmTasks('grunt-mkdir');

};
