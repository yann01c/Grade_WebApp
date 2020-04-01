// Connect to Database
const sqlite3 = require('sqlite3').verbose();

let db = new sqlite3.Database('grade.db', sqlite3.OPEN_READWRITE, (err) => {
    if (err) {
        return console.error(err.message);
    }
    console.log('Connected to the Grade SQlite database');
});

db.run('CREATE TABLE classes(class_id INTEGER PRIMARY KEY, class TEXT NOT NULL, average FLOAT NOT NULL);', function(err) {
    if(err){
        return console.log(err.message);
    }
    console.log('Table created');
    })
    db.close()

// Close Database
//db.close((err) => {
//    if (err) {
//      return console.error(err.message);
//    }
//    console.log('Close the database connection.');
//  });

