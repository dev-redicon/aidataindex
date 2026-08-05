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
├── head-links.html
└── body-links.html
```

For very small sites, avoid over-engineering. A single manifest plus a few entity files is enough.

## Project Files

| File / Resource | Function |
| --- | --- |
| `index.json` | Example AI Data Index manifest using `format: "ai-json"` and `resources`. |
| `category.json` | Example AI-readable list using `format: "ai-json"` and `items`. |
| `page.json` | Example final entity file using `format: "json-ld"` and Schema.org. |
| `index.php` | Simple endpoint that returns the JSON manifest. |
| `sitemap-ai.xml` | Dedicated sitemap for AI-readable structured files. |
| `llms.txt` | LLM-oriented discovery file listing the main structured resources. |
| `robots.txt` | Standard crawler rules plus declared, non-standard AI discovery fields. |
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

## Website

Official website:

[https://aidataindex.org](https://aidataindex.org)

## License

This repository uses the license included in [LICENSE](LICENSE).
