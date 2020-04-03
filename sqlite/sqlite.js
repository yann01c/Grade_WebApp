// Connect to Database
const sqlite3 = require('sqlite3').verbose();

let db = new sqlite3.Database('webapp.db', sqlite3.OPEN_READWRITE, (err) => {
    if (err) {
        return console.error(err.message);
    }
    console.log('Connected to the Grade SQlite database');
});


db.run('CREATE TABLE IF NOT EXISTS class (class_id INTEGER PRIMARY KEY, class varchar(255) NOT NULL);', function(err) {
    if(err){
        return console.log(err.message);
    }
    console.log('Table class created');
    });
    db.close();

db.run('INSERT INTO grade (grade) VALUES ($grade)', function(err, row) {
    if (err) {
        return console.error(err.message);
    }
    console.log('GRADE Inserted in Table Grade');
    });
    db.close();


// Close Database
//db.close((err) => {
//    if (err) {
//      return console.error(err.message);
//    }
//    console.log('Close the database connection.');
//  });

