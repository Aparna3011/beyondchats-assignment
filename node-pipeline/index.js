const axios = require("axios");

async function fetchOriginalArticles() {
  try {
    const response = await axios.get(
      "http://127.0.0.1:8000/api/articles/original"
    );

    console.log("Fetched articles count:", response.data.length);
    response.data.forEach((a, i) => {
      console.log(`\nArticle ${i + 1}`);
      console.log("Title:", a.title);
      console.log("Slug:", a.slug);
    });
  } catch (error) {
    console.error("Failed:", error.response?.status);
  }
}

fetchOriginalArticles();
