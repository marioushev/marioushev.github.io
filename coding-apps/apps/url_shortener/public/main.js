// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyB96FPjckghUMn-4FrEXzwatO1gJWQETTA",
  authDomain: "urlshort-9e88e.firebaseapp.com",
  projectId: "urlshort-9e88e",
  storageBucket: "urlshort-9e88e.appspot.com",
  messagingSenderId: "857115556679",
  appId: "1:857115556679:web:06065474cc854add6aaa62",
  measurementId: "G-SD2JVMFCEK",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

// Function to generate random string
function getRandomString() {
  return Math.random().toString(36).substring(2, 8);
}

// Function to shorten URL
async function shortenUrl() {
  const originalUrl = document.getElementById("urlinput").value;
  const shortUrlId = getRandomString();

  try {
    // Save the original and short URL in Firestore
    await db.collection("urls").doc(shortUrlId).set({
      originalUrl: originalUrl,
      shortUrlId: shortUrlId,
    });

    // Display the shortened URL
    const shortUrl = `http://localhost:3000/${shortUrlId}`; // Modify this to your hosting URL
    document.getElementById(
      "shortened-url"
    ).innerText = `Shortened URL: ${shortUrl}`;
  } catch (error) {
    console.error("Error shortening URL:", error);
  }
}
