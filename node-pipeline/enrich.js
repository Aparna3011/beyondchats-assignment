import axios from "axios";
import dotenv from "dotenv";

dotenv.config();

const LARAVEL_API = "http://127.0.0.1:8000/api";

// ⚠️ FREE AI MOCK (no paid LLM)
function fakeAI(content) {
  return {
    summary: content.substring(0, 400) + "...",
    tags: ["chatbot", "ai", "automation"],
  };
}

async function enrichArticles() {
  try {
    // 1️⃣ Fetch original articles
    const res = await axios.get(`${LARAVEL_API}/articles/original`);
    const articles = res.data;

    console.log(`Found ${articles.length} articles\n`);

    for (const article of articles) {
      // 2️⃣ Generate AI output (FREE)
      const ai = fakeAI(article.content);

      const payload = {
        article_id: article.id,
        title: article.title,
        slug: article.slug,
        summary: ai.summary,
        tags: ai.tags,
      };

      // 3️⃣ Save enriched article
      await axios.post(`${LARAVEL_API}/articles/enriched`, payload);

      console.log(`✅ Enriched & saved: ${article.title}`);
    }

    console.log("\n🎉 Phase 2 Step 2 completed successfully!");
  } catch (error) {
    console.error("❌ Error:", error.response?.data || error.message);
  }
}

enrichArticles();
