// /routes/urlRoutes.js
const express = require("express");
const router = express.Router();
const Url = require("../models/url"); // Reference to the model

// Helper function to generate random short code
function generateHash() {
  return Math.random().toString(36).substring(2, 8);
}

// Route to shorten URL
router.post("/shorten", async (req, res) => {
  const { originalUrl } = req.body;
  const shortUrl = generateHash();

  try {
    // Save the original URL and short code to MongoDB
    const newUrl = new Url({ originalUrl, shortUrl });
    await newUrl.save();

    // Return the shortened URL to the client
    res.json({ shortUrl: `http://localhost:3000/${shortUrl}`, originalUrl });
  } catch (error) {
    res.status(500).json({ error: "Internal Server Error" });
  }
});

// Route to redirect short URL to original URL
router.get("/:shortUrl", async (req, res) => {
  const { shortUrl } = req.params;

  try {
    const urlDoc = await Url.findOne({ shortUrl });
    if (urlDoc) {
      res.redirect(urlDoc.originalUrl);
    } else {
      res.status(404).json({ error: "URL Not Found" });
    }
  } catch (error) {
    res.status(500).json({ error: "Internal Server Error" });
  }
});

module.exports = router;
