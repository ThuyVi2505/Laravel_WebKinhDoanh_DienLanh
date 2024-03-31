const { Sequelize } = require('sequelize');
// require('dotenv').config();

const sequelize = new Sequelize(process.env.DB_NAME, process.env.DB_USERNAME, process.env.DB_PASSWORD, {
  host: process.env.DB_HOST,
  dialect: process.env.DB_CONNECTION,
  logging: false
});

const connectDatabase = async () => {
    try {
        await sequelize.authenticate();
        console.log('Connection to the DB successfully.');
    } catch (error) {
        console.error('Unable to connect to the database:', error);
    }
};

module.exports = connectDatabase;
// npx sequelize-cli model:generate --name Brand --attributes b_name:string,b_slug:string,thumnail:string,b_content:text,created_at:Date, updated_at:Date