# AI Data Index

**AI Data Index** is a practical open convention for publishing a machine-readable layer beside a human website.

It uses JSON, JSON-LD, Schema.org, `llms.txt`, `robots.txt`, a dedicated AI sitemap, and explicit discovery links to help AI systems, agents, crawlers, and language models understand website content with less ambiguity than raw HTML scraping.

AI Data Index is not an officially adopted universal web standard. It should be presented as a simple, open, implementation-friendly convention that remains compatible with existing structured data practices.

## Core Idea

The core idea is a parallel version of a website, designed to be read by machines rather than humans.

The human website stays unchanged. The AI-readable layer is usually placed in:

```text
/json/
```

The main entry point is:

```text
/json/index.json
```

Because AI discovery is still fragmented, AI Data Index recommends redundant signals:

```text
/json/index.json
/json/index.php
/json/sitemap-ai.xml
/llms.txt
/robots.txt
head link rel="alternate"
head script id="ai-manifest"
body or footer link to /json/index.json
```

## Format Rule

AI Data Index uses two levels:

1. `ai-json` for manifests, indexes, lists, navigation, categories, paginated archives, and relationships.
2. `json-ld` with Schema.org for final entities such as pages, articles, services, products, local businesses, organizations, people, FAQs, and contact pages.

Every JSON file should declare its format when possible:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "ai-json",
  "type": "WebSiteManifest",
  "id": "website-manifest",
  "name": "Example Website",
  "description": "Global AI Data Index manifest for the website.",
  "inLanguage": "en"
}
```

or:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "json-ld",
  "@context": "https://schema.org",
  "@type": "Service",
  "@id": "https://www.example.com/json/services/example-service.json",
  "identifier": "example-service",
  "name": "Example service",
  "description": "Clear service description.",
  "mainEntityOfPage": "https://www.example.com/services/example-service/",
  "inLanguage": "en"
}
```

## Recommended File Structure

For a small website, start with:

```text
/ (root or public_html)
├── json/
│   ├── index.json
│   ├── index.php
│   ├── sitemap-ai.xml
│   ├── pages/
│   │   ├── home.json
│   │   ├── about.json
│   │   └── contacts.json
│   └── services/
│       ├── index.json
│       ├── service-one.json
│       └── service-two.json
├── llms.txt
├── robots.txt
├── ai-data-index-agent-setup.md
├── head-links.html
└── body-links.html
```

For very small sites, avoid over-engineering. A single manifest plus a few entity files is enough.

## Multilingual Websites

For multilingual websites, AI Data Index should distinguish between a global manifest and language-specific manifests.

The global manifest, usually `/json/index.json`, describes the website as a whole and lists the available languages. Each language manifest, such as `/json/it/index.json` or `/json/en/index.json`, describes the localized structure for that language.

Use separate language manifests where the website experience changes, such as navigation, pages, categories, and editorial paths. Use canonical shared entity files where only the translation of the same object changes, especially for large catalogs or large archives.

Technical folder and file names should preferably use stable, language-neutral terms, commonly in English, such as `pages`, `categories`, `articles`, `products`, and `items`. Localized content should be expressed inside JSON fields and localized indexes, not in the technical path.

```text
/json/
├── index.json
├── it/
│   ├── index.json
│   ├── pages.json
│   ├── categories.json
│   └── articles/
│       ├── index.json
│       └── pages/
├── en/
│   ├── index.json
│   ├── pages.json
│   ├── categories.json
│   └── articles/
│       ├── index.json
│       └── pages/
└── articles/
    └── items/
        ├── article-001.json
        ├── article-002.json
        └── article-5000.json
```

In this structure, localized folders contain lightweight indexes for discovery and navigation. The canonical article files remain in one shared folder and may contain all translations of the same article when those translations represent the same work.

The main manifest can expose the available languages and point to localized manifests:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "ai-json",
  "type": "WebSiteManifest",
  "id": "website-manifest",
  "name": "Example Website",
  "description": "Global AI Data Index manifest for the website.",
  "url": "https://www.example.com/",
  "inLanguage": ["it", "en", "fr"],
  "availableLanguage": ["it", "en", "fr"],
  "languageManifests": [
    {
      "inLanguage": "it",
      "url": "https://www.example.com/json/it/index.json"
    },
    {
      "inLanguage": "en",
      "url": "https://www.example.com/json/en/index.json"
    },
    {
      "inLanguage": "fr",
      "url": "https://www.example.com/json/fr/index.json"
    }
  ],
  "lastUpdated": "YYYY-MM-DD"
}
```

For large archives generated by a CMS or database, canonical file names should be stable and language-neutral. In WordPress, for example, a post can use `post-12345.json` and a WooCommerce product can use `product-98765.json`. This avoids changing the data URL when a title, slug, or translation changes.

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "json-ld",
  "@context": "https://schema.org",
  "@type": "Article",
  "@id": "https://www.example.com/json/articles/items/post-12345.json",
  "identifier": "post-12345",
  "wpId": 12345,
  "name": {
    "it": "Come preparare i dati per l'intelligenza artificiale",
    "en": "How to prepare data for artificial intelligence"
  },
  "headline": {
    "it": "Come preparare i dati per l'intelligenza artificiale",
    "en": "How to prepare data for artificial intelligence"
  },
  "description": {
    "it": "Una guida pratica per rendere i contenuti piu comprensibili alle AI.",
    "en": "A practical guide to making content easier for AI systems to understand."
  },
  "articleBody": {
    "it": "Testo completo dell'articolo in italiano...",
    "en": "Full article text in English..."
  },
  "mainEntityOfPage": {
    "it": "https://www.example.com/it/articoli/come-preparare-i-dati-ai/",
    "en": "https://www.example.com/en/articles/how-to-prepare-ai-data/"
  },
  "inLanguage": ["it", "en"]
}
```

If translated articles are faithful versions of the same work, a single multilingual canonical file is usually the cleanest solution. If each language version is editorially different, create separate files and connect them through properties such as `translationOfWork`, `workTranslation`, `sameAs`, and `mainEntityOfPage`.

For small websites or a limited number of editorial pages, using file names based on the default language of the website is acceptable, for example `/json/pages/chi-siamo.json` on an Italian website. For large archives, stable IDs are preferable.

For a website written in Italian, it is not necessary to replace the original content with English. The original language should remain present and aligned with the human page. English can be added as a useful support language for names, descriptions, summaries, and interoperability.

## Project Files

| File / Resource | Function |
| --- | --- |
| `index.json` | Example AI Data Index manifest using `format: "ai-json"` and `resources`. |
| `category.json` | Example AI-readable list using `format: "ai-json"` and `items`. |
| `page.json` | Example final entity file using `format: "json-ld"` and Schema.org. |
| `multilingual-page.json` | Example multilingual canonical entity file with localized fields. |
| `index.php` | Simple endpoint that returns the JSON manifest. |
| `sitemap-ai.xml` | Dedicated sitemap for AI-readable structured files. |
| `llms.txt` | LLM-oriented discovery file listing the main structured resources. |
| `robots.txt` | Standard crawler rules plus declared, non-standard AI discovery fields. |
| `ai-data-index-agent-setup.md` | Platform-neutral setup instructions for AI assistants and coding agents. |
| `head-links.html` | Example discovery links to add in the HTML `<head>`. |
| `body-links.html` | Example visible footer/body link to the AI manifest. |

## Baseline Fields

Use these fields consistently whenever they apply:

- `aiDataIndexVersion`
- `format`
- `type` or `@type`
- `id`, `identifier`, or `@id`
- `name`
- `description`
- `inLanguage`
- `dataUrl` for JSON file URLs in manifests, indexes, and lists
- `htmlUrl`, `url`, or `mainEntityOfPage` for canonical human pages
- `lastUpdated` or `dateModified`

Use `resources` in the main manifest and `items` in lists or indexes.

Final entity files may include rich content such as descriptions, images, FAQs, offers, authors, body text, localized fields, and Schema.org-specific properties.

## Robots.txt Note

`Sitemap:` is a widely recognized robots.txt field.

Fields such as `AI-Data`, `AI-API-Data`, and `AI-LLM` are declarative, non-standard discovery fields. They may be useful to AI agents and custom crawlers, but they should not be described as official directives supported by all crawlers.

## Agent Setup File

The file [ai-data-index-agent-setup.md](ai-data-index-agent-setup.md) is made for AI assistants and coding agents such as Codex, ChatGPT, Gemini, Claude, and similar tools.

Give it to an AI before starting an integration. It explains the AI Data Index method, asks the right setup questions, and guides the creation of JSON, JSON-LD, `llms.txt`, `robots.txt`, `sitemap-ai.xml`, and discovery snippets.

## Website

Official website:

[https://aidataindex.org](https://aidataindex.org)

## License

This repository uses the license included in [LICENSE](LICENSE).
