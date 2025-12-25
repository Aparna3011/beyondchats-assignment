# BeyondChats Assignment – Content Pipeline with AI Enrichment

This project implements a **content ingestion and AI enrichment pipeline** using:

- Laravel (Backend API)
- Node.js (Processing & AI simulation)
- SQLite (Database)

---

## 📌 Features

### Phase 1 – Content Ingestion
- Scrapes blog articles from BeyondChats
- Stores original articles in the database
- Maintains slug-based uniqueness

### Phase 2 – AI Enrichment
- Fetches original articles via API
- Generates AI-enriched summaries and tags (free / simulated)
- Stores enriched versions separately
- Exposes enriched articles via API

---

## 🛠 Tech Stack

- **Backend:** Laravel 11
- **Pipeline:** Node.js (Axios)
- **Database:** SQLite
- **AI:** Free simulated enrichment (no paid APIs)

---

## 📂 Project Structure

```text
beyondchats-assignment/
├── backend-laravel/
│   ├── app/Http/Controllers/ArticleController.php
│   ├── routes/api.php
│   ├── database/migrations/
│   └── database/database.sqlite
│
├── node-pipeline/
│   ├── index.js        # Fetch original articles
│   ├── enrich.js       # AI enrichment & save
│   ├── package.json
│
└── README.md
