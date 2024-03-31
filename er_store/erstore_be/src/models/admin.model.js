"use strict";
const { Model } = require("sequelize");
module.exports = (sequelize, DataTypes) => {
  class Admin extends Model {
    static associate(models) {
      // define association here
    }
  }
  Admin.init(
    {
      fullname: DataTypes.STRING,
      email: DataTypes.STRING,
      password: DataTypes.STRING,
      phone_number: DataTypes.STRING,
      avatar: DataTypes.STRING,
      role_id: DataTypes.INTEGER,
    },
    {
      sequelize,
      modelName: "Admin",
    }
  );
  return Admin;
};
