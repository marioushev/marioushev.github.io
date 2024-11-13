const express = require("express");
const shortid = require("shortid"); // For generating short hashes
const db = require("./firebase"); // Import your Firebase config

const app = express();
app.use(express.json());

// POST request to shorten URL
app.post("/api/shorten", async (req, res) => {
  const { originalUrl } = req.body;
  const shortUrlId = shortid.generate(); // Generate a short URL ID

  // Store in Firestore
  try {
    await db.collection("urls").doc(shortUrlId).set({
      originalUrl: originalUrl,
      shortUrlId: shortUrlId,
      createdAt: new Date(),
    });

    res.json({ shortUrl: `http://localhost:3000/${shortUrlId}` });
  } catch (error) {
    console.error("Error saving to Firestore:", error);
    res.status(500).json({ error: "Failed to shorten URL" });
  }
});

// GET request to redirect to original URL
app.get("/:shortUrlId", async (req, res) => {
  const shortUrlId = req.params.shortUrlId;

  // Retrieve the original URL from Firestore
  try {
    const doc = await db.collection("urls").doc(shortUrlId).get();

    if (doc.exists) {
      const { originalUrl } = doc.data();
      res.redirect(originalUrl); // Redirect to the original URL
    } else {
      res.status(404).json({ error: "Short URL not found" });
    }
  } catch (error) {
    console.error("Error retrieving from Firestore:", error);
    res.status(500).json({ error: "Failed to retrieve URL" });
  }
});

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
