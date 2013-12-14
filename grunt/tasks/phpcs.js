module.exports = function(grunt) {
    'use strict';

    grunt.config('phpcs', {
        application: {
            dir: '<%= directories.php %>'
        },
        tests: {
            dir: '<%= directories.testsPHP %>'
        },
        options: {
            bin: '<%= directories.composerBin %>/phpcs',
            standard: 'PSR2',
            ignore: 'database',
            extensions: 'php'
        },
        newSniffer: {
            dir: '<%= files.php %>',
            options: {
                standard: '../development-tools/PSR2Extended/ruleset.xml',
                warningSeverity: 10
            }
        }
    });

    grunt.loadNpmTasks('grunt-phpcs');
};
