const express = require("express");
const router = express.Router();

router.get('/', (req, res) => {
  return res.send("đây là toàn bộ danh sách thương hiệu");
});

module.exports = router;
