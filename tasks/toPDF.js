var page = require('webpage').create(),
    system = require('system'),
    address, output, size;

if (system.args.length < 3 || system.args.length > 5) {
    console.log('Usage: toPDF.js URL filename [paperwidth*paperheight|paperformat] [zoom]');
    console.log('  paper (pdf output) examples: "5in*7.5in", "10cm*20cm", "A4", "Letter"');
    phantom.exit(1);
} else {
    address = system.args[1];
    output = system.args[2];
    page.viewportSize = { width: 600, height: 600 };
    page.paperSize = {
      format: 'A4', orientation: 'portrait',
      margin: {left: '1.2cm', right: '2.5cm', top: '1.2cm', bottom: '2.2cm'},
      header: {
        height: '1.2cm',
        contents: phantom.callback(function(pageNum, numPages) {
            return pageNum + '/' + numPages;
        })
      },
      footer: {
        height: '0.7cm',
        contents: phantom.callback(function(pageNum, numPages) {
          return '<h3 class="header">Footer</h>';
        })
      }
    };
    // if (system.args.length > 3 && system.args[2].substr(-4) === ".pdf") {
    //     size = system.args[3].split('*');
    //     page.paperSize = size.length === 2 ? { width: size[0], height: size[1], margin: '0px' }
    //                                        : { format: system.args[3], orientation: 'portrait', margin: '1cm' };
    // }
    // if (system.args.length > 4) {
    //     page.zoomFactor = system.args[4];
    // }
    page.open(address, function (status) {
        if (status !== 'success') {
            console.log('Unable to load the address!');
            phantom.exit();
        } else {
            window.setTimeout(function () {
                page.render(output);
                phantom.exit();
            }, 200);
        }
    });
}

// http://stackoverflow.com/questions/17043823/how-to-handle-pdf-pagination-in-phantomjs
// http://stackoverflow.com/questions/17027142/phantomjs-how-to-render-a-multi-page-pdf
// http://stackoverflow.com/questions/16505981/adjust-pdf-options-for-phantomjs
// http://stackoverflow.com/questions/17125955/generate-pdf-files-phantomjs-repeating-header
// http://assemble.io/docs/Pages-Collections.html
//http://tmanstwobits.com/convert-your-web-pages-to-pdf-files-using-phantomjs.html
