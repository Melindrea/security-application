jQuery(function ($) {
    'use strict';
    // Images
    $('.js-thumbnail a').magnificPopup({
        type: 'image',
        disableOn: 250,
        image: {
            titleSrc: function(item) {
                return item.el.next('figcaption').text();
            }
        }
    });

    // Gallery
    $('.js-gallery').each(function() { // the containers for all your galleries
        $(this).find('a').magnificPopup({
            type: 'image',
            disableOn: 250,
            gallery: {
                enabled: true
            },
            image: {
                titleSrc: function(item) {
                    return item.el.next('figcaption').text();
                }
            }
        });
    });

    // Set figcaptions as hidden
    $('.js-thumbnail figcaption').attr('hidden', true);
});
