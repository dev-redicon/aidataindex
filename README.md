# 🧠 AI Data Index

**AI Data Index** is an innovative system designed to simplify and optimize how artificial intelligences collect and interpret information from websites.

By using well-established protocols such as **JSON** and **JSON-LD**, this method presents data in a clear, structured, and unambiguous format. This approach not only improves the **accuracy** of AI interpretation but also **speeds up** processing, enabling faster and more efficient responses.

---

## 🚀 What Makes It Innovative

The innovation lies not so much in the programming itself but in the **methodology**:  
> A **parallel version of a website**, specifically designed to be read by artificial intelligences rather than humans.

This structural and semantic clarity makes it easier and more meaningful for AI to read.

![AI Data Index Concept](https://github.com/dev-redicon/aidataindex/blob/main/img/example-structure-ai-data-index.jpg?raw=true)


---

## 📂 Project Structure

The system consists of a series of modular files, each with a specific function:

| File / Resource         | Function |
|--------------------------|----------|
| `index.json`             | Semantic parallel homepage of the website, containing a map of contents and links readable by AI |
| `category.json`          | Structure of categories and tags to help AI understand relationships between contents |
| `page.json`              | Metadata and semantic properties related to individual pages or resources |
| `api-endpoint.php`       | PHP endpoint to dynamically serve JSON data to AIs and agents |
| `llms.txt`               | Placed in the site's root (like `robots.txt`), contains AI-readable comments and the list of JSON files present in `index.json`. |
| `sitemap-ai.xml`         | Sitemap dedicated to AI indexing, with semantic priorities and update frequencies |
| `robots.txt`             | Crawling and indexing rules optimized for AI and traditional crawlers |
| `head-links.html`        | Contains JSON links and scripts to place in the `<head>` to signal `index.json` to AI, facilitating structured data detection |
| `body-links.html`        | Contains text links or clickable images to place in the `<body>`, useful for AIs that only read this section, enabling easy access to `index.json` |

---

## 🧭 Project Status (June 2025)

Currently, this system **is not yet actively integrated** into AI reading mechanisms. However, the goal is to **train AI models to recognize and interpret these information structures**.

Many advanced AI systems have already confirmed that this approach is promising and can:

- **Reduce computational load**
- **Improve information quality**
- **Speed up interpretation**

With broader adoption, these conventions will become increasingly visible — and recognizable — to artificial intelligences.

---

## 🤝 How to Contribute

This repository is open to discussions, testing, and improvements.

You can contribute in several ways:

- Submit suggestions via [Issues](https://github.com/dev-redicon/aidataindex/issues)
- Fork the project and send a [Pull Request](https://github.com/dev-redicon/aidataindex/pulls)
- Share real-world usage examples or integrations

---

## 🌐 Website

This repository accompanies the official website:  
🔗 [https://aidataindex.org](https://aidataindex.org)

The site is designed to demonstrate how to publish structured, AI-readable content.

---

## 📄 License

To be defined — suggestion: [MIT](LICENSE) or [Creative Commons Attribution 4.0](https://creativecommons.org/licenses/by/4.0/)

---
