// https://npmjs.org/package/execSync
// Executes shell commands synchronously
var sh = require('execSync').run;

var shOutput = require('execSync').exec;
var file, command, fileChanged;

// var object = JSON.parse(args[0]);
var object = require('../../hooks/data/update');
// var object = JSON.parse('{{args}}');
for (var i in object) {
    file = object[i].file;
    command = object[i].command;
    fileChanged = (shOutput('git diff HEAD@{1} --stat -- ' + file + ' | wc -l').stdout > 0);

    if (fileChanged) {
        console.log(file + ' has changed, dependencies will be updated.');
        sh(command);
    }
}
process.exit(0);
