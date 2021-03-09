const path = require('path');
const express = require('express');
const http = require('http');

const app = express();

/* app.use(express.static(path.join(__dirname))); */

/* const PORT = 3000 || process.env.PORT;

app.listen(PORT, () => console.log(`Server running on port ${PORT}`)); */
const PORT = 3000 || process.env.PORT;

const http_server = http.createServer(app).listen(PORT);
console.log(`Server running on port ${PORT}`);