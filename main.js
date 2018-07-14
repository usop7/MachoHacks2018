var http = require('http');
var mysql = require('mysql');

var db = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '121212',
  database : 'MachoHacks2018'
});

var app = http.createServer(function (request, response) {
    var html;
    var url = request.url;
    if(request.url == '/favicon.ico'){
        return response.writeHead(404);
    } else {
        response.writeHead(200, {'Content-Type': 'text/html'});
    }
  
    db.connect();

    db.query('SELECT * FROM chain WHERE id = 1', function(error, blocks) {
        html = `
        <!doctype html>
        <html>
        <head>
            <title>BCIT Transcript Verification</title>
            <meta charset="utf-8">
        </head>
        <body>
            <h1>BCIT Transcript Verification</h1>
            <h2>Transcript</h2>
            <p>${blocks[0].data}</p>
        </body>
        </html>
        `;
        `<a href="/create">create</a>`;

        
        response.write(html);
        response.end();

    });

});

app.listen(8080);