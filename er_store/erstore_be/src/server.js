const express = require("express");
const cors = require("cors");
// get const project value from file .env
require("dotenv").config();

// setting express server with api json
const app = express();

app.use(
  cors({
    origin: process.env.CLIENT_URL,
    methods: ["GET", "POST", "PUT", "PATCH", "DELETE"],
  })
);

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// router
const initRouter = require('./routes')
initRouter(app);
// connect to database mysql
const connDB = require('./config/connDatabase');
connDB();

// port, listener
const PORT = process.env.PORT || 8080;

const listener = app.listen(PORT, () => {
    console.log('I am comming...'+listener.address().port)
});
