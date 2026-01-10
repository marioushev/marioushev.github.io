// /models/url.js
const mongoose = require("mongoose");

// Define URL Schema
const urlSchema = new mongoose.Schema({
  originalUrl: { type: String, required: true }, // The original URL
  shortUrl: { type: String, required: true }, // The shortened URL code
  date: { type: Date, default: Date.now }, // Timestamp
});

// Create URL model
const Url = mongoose.model("Url", urlSchema);

module.exports = Url;
