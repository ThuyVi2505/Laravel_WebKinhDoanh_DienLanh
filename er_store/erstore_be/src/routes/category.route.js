const express = require("express");
const router = express.Router();

router.get("/", (req, res) => {
  res.send("Đây là danh sách loại sản phẩm");
});

module.exports = router;
