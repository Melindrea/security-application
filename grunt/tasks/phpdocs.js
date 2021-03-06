module.exports = function(grunt) {
    'use strict';

    grunt.config('phpdocumentor', {
        dist: {
            bin: '<%= directories.composerBin %>/phpdoc.php',
            directory: '<%= directories.php %>',
            target: '<%= directories.docs %>/phpdocs',
            ignore: [
                '<%= directories.php %>/database/*'
            ]
        }
    });

    grunt.registerTask('phpdocs', [
        'clean:phpdocumentor',
        'phpdocumentor'
    ]);
};
