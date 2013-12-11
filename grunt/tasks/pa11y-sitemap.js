/*
 * grunt-pa11y-sitemap
 * http://mariehogebrandt.se/
 *
 * Copyright (c) 2014 Marie Hogebrandt, contributors
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function(grunt) {

    var pa11y = require('pa11y');
    grunt.registerMultiTask('pa11ySitemap', 'Validate files (ish...) for accessibility.', function() {

        // Merge task-specific and/or target-specific options with these defaults.
        var options = this.options({
            path: 'reports/',
            reporter: 'csv',
            standard: 'WCAG2AA',
            debug: false
        });//, urls = require(this.data.urls);

        options.url = 'example.com';

        // grunt.log.writeln(this.target + ': ' + this.data.files);
        // var urlLength = urls.length;
        // for (var i = 0; i < urlLength; i++) {
        //     // grunt.log.writeln(urls[i]);
        //     var temp = options;
        //     temp.url = 'example.com';
        //     // grunt.log.writeln(temp.url);
        //     pa11y.sniff(temp, function (err, results) {
        //         grunt.log.writeln(results);
        //         grunt.log.writeln(err);
        //     });
        // }
        grunt.log.writeln(options.url);
        pa11y.sniff(options, function (err, results) {
            grunt.log.writeln(results);
            grunt.log.writeln(options.url + ' in sniff!');
        });
    });
};
