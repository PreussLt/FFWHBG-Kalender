if (process.argv.length === 3) {
    console.error('Expected at least two argument!');
    process.exit(1);
}else {

    // Ical & FS moudle Pleas run npm install node-ical in current folder
    const ical = require('node-ical');
    const fs = require('fs');

    // Get Strings from Parameters
    const filename = process.argv[2];
    const calLink = process.argv[3];

    // Leave empty for default
    const options = "";
    let data_json = "";

    ical.fromURL(calLink, options, function (err, data) {
        if (err) console.log(err);
        data_json += JSON.stringify(data);
        fs.writeFile(filename, data_json, function (err) {
            if (err) throw err;
            console.log('complete');
            return data_json;

        });
    });
}


