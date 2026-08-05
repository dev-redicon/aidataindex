# AI Data Index Agent Setup

Use this file to instruct an AI coding agent or AI assistant, such as Codex, ChatGPT, Gemini, Claude, Perplexity, or another LLM-based software agent, to create an AI Data Index integration for a website.

This is an operational setup file, not a formal web standard. AI Data Index is a practical open convention for publishing a machine-readable version of a website through JSON, JSON-LD, Schema.org, llms.txt, robots.txt, a dedicated AI sitemap, and explicit discovery links.

The instructions are intentionally platform-neutral. If a specific agent cannot edit files directly, it should still use this document to ask the setup questions, generate the file contents, and explain where each file should be placed.

## Role for the AI Agent

You are helping the user integrate AI Data Index into an existing website.

Your job is to:

1. Understand the website structure.
2. Ask the user the minimum useful setup questions.
3. Generate or update the AI-readable files.
4. Add the discovery signals.
5. Validate that the files are reachable and internally coherent.
6. Explain clearly what was created and what the user should upload or deploy.

Speak with the user in the same language used by the user, unless they ask otherwise.

Do not describe AI Data Index as an officially adopted universal standard. Describe it as a practical open convention compatible with existing structured data practices.

## Compatibility Notes for AI Systems

Follow these rules to remain compatible with different AI tools and agents:

- Do not rely on a Codex-only, ChatGPT-only, Gemini-only, or Claude-only workflow.
- If you can inspect and edit the project files, do so directly.
- If you cannot access the filesystem, generate ready-to-use file contents and clear placement instructions.
- If you can browse the website but not edit it, audit the current website and produce an implementation package.
- If you cannot browse the website, ask the user for URLs, page text, sitemap links, CMS details, and representative page examples.
- Keep filenames, JSON keys, and discovery paths simple and predictable.
- Prefer valid JSON, JSON-LD, Markdown, XML, and HTML snippets over tool-specific commands.
- Ask concise questions before generating final files, but avoid asking for information that can be discovered from the website or local project.

## Core Concept

AI Data Index creates a parallel machine-readable layer for a website.

The human website remains unchanged. The AI-readable layer is usually placed in:

```text
/json/
```

The main entry point is:

```text
/json/index.json
```

Other discovery signals point to that manifest:

```text
/llms.txt
/robots.txt
/json/sitemap-ai.xml
/json/index.php
head link rel="alternate"
head script id="ai-manifest"
body or footer link to /json/index.json
```

Use redundancy intentionally. In 2026, a single AI discovery signal is not reliable enough.

## Format Rule

Use two levels:

1. `ai-json` for manifests, indexes, lists, navigation, categories, paginated archives, and relationships.
2. `json-ld` with Schema.org for final entities such as pages, articles, services, products, local businesses, organizations, people, FAQs, and contact pages.

Every new JSON file should declare its format when possible:

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
  "@id": "https://www.example.com/json/services/service-name.json",
  "identifier": "service-name",
  "name": "Service name",
  "description": "Clear service description.",
  "mainEntityOfPage": "https://www.example.com/services/service-name/",
  "inLanguage": "en"
}
```

Use the same baseline fields across all examples and generated files whenever they apply:

- `aiDataIndexVersion`
- `format`
- `type` or `@type`
- `id`, `identifier`, or `@id`
- `name`
- `description`
- `inLanguage`
- `dataUrl` for JSON file URLs in manifests, indexes, and lists
- `htmlUrl`, `url`, or `mainEntityOfPage` for canonical human pages
- `lastUpdated` or `dateModified` when available

Use `resources` in the main manifest and `items` in lists or indexes. Final entity files may include rich page content such as full descriptions, images, FAQ blocks, offers, authors, body text, localized fields, and Schema.org-specific properties.

## Recommended MVP for Small Business Websites

For a small company website, create a simple structure first:

```text
/json/
  index.json
  pages/
    home.json
    about.json
    services.json
    contacts.json
  sitemap-ai.xml
/llms.txt
/robots.txt
```

If the website has individual services, add:

```text
/json/services/
  index.json
  service-name-1.json
  service-name-2.json
```

If the website has articles, add:

```text
/json/articles/
  index.json
  article-name-1.json
  article-name-2.json
```

For a very small site, do not over-engineer pagination, multilingual manifests, or database-like structures unless they are needed.

## Setup Questions

Before creating files, ask the user these questions. Keep them concise and adapt them to the website.

### 1. Website Identity

Ask:

- What is the website URL?
- What is the official website or company name?
- What does the website offer in one clear paragraph?
- What is the primary language of the website?
- Is the website monolingual or multilingual?

### 2. Website Type

Ask the user to choose the closest type:

- Company website
- Professional website
- Local business
- Ecommerce
- Blog or magazine
- Directory or marketplace
- Course or training website
- Portfolio
- Other

Use this answer to choose the main Schema.org types.

Examples:

- Company website: `Organization`, `WebSite`, `WebPage`, `Service`
- Local business: `LocalBusiness`, `PostalAddress`, `Service`, `ContactPage`
- Ecommerce: `Product`, `Offer`, `ItemList`
- Blog: `Blog`, `BlogPosting`, `Article`, `Person`
- Directory: `ItemList`, `LocalBusiness`, `Organization`

### 3. Pages to Include

Ask:

- Which pages should be included in the AI Data Index?
- Are there pages that must be excluded?
- Should the AI index include only public pages?

For a small site, suggest this default list:

- Home
- About
- Services
- Individual service pages
- Products, if present
- Blog articles, if present
- FAQ, if present
- Contacts
- Legal pages only if useful

### 4. Services, Products, or Articles

Ask only the relevant questions:

- Does the site have service pages?
- Does the site have product pages?
- Does the site have blog/news articles?
- Are these pages managed manually, by a CMS, or by a database?
- Are there many items, or only a small number?

If there are many records, use stable IDs and paginated indexes.

If there are only a few pages, use readable filenames.

### 5. Company and Contact Data

Ask:

- Official company or professional name?
- Logo URL?
- Email?
- Phone?
- Address?
- Service area?
- Social profiles or sameAs links?
- Opening hours, if relevant?

For local businesses, prefer Schema.org `LocalBusiness` or a more specific subtype when appropriate.

### 6. Multilingual Setup

If the site is multilingual, ask:

- Which languages are available?
- Are translations faithful versions of the same content?
- Do different languages have different pages, categories, or editorial structures?

Use this rule:

Separate languages where the website experience changes. Use canonical shared entity files where only the translation of the same object changes.

Recommended structure:

```text
/json/index.json
/json/it/index.json
/json/en/index.json
```

For large catalogs, use canonical shared entity files:

```text
/json/products/items/product-123.json
```

with localized fields inside the JSON.

### 7. Deployment Constraints

Ask:

- Can files be uploaded to the website root?
- Can files be uploaded to `/json/`?
- Can the HTML `<head>` be edited?
- Can `robots.txt` be edited?
- Can `llms.txt` be added to the root?
- Is this a static site, WordPress, another CMS, or a custom application?

If files cannot be written physically, suggest virtual routes or endpoints.

## Files to Generate

Create or update these files when possible:

```text
/json/index.json
/json/sitemap-ai.xml
/llms.txt
/robots.txt
```

Optionally create:

```text
/json/index.php
```

Only create `/json/index.php` when PHP is available or useful.

Create one JSON or JSON-LD file for each important page or entity.

## Main Manifest Template

Use this as a starting point:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "ai-json",
  "type": "WebSiteManifest",
  "id": "website-manifest",
  "name": "Example Website",
  "url": "https://www.example.com/",
  "description": "Clear natural description of the website.",
  "inLanguage": "en",
  "publisher": {
    "@type": "Organization",
    "name": "Example Organization",
    "url": "https://www.example.com/"
  },
  "resources": [
    {
      "id": "home",
      "type": "WebPage",
      "name": "Home",
      "description": "Short summary of the home page.",
      "dataUrl": "https://www.example.com/json/pages/home.json",
      "htmlUrl": "https://www.example.com/"
    }
  ],
  "discovery": {
    "llmsTxt": "https://www.example.com/llms.txt",
    "robotsTxt": "https://www.example.com/robots.txt",
    "aiSitemap": "https://www.example.com/json/sitemap-ai.xml",
    "apiEndpoint": "https://www.example.com/json/index.php"
  },
  "lastUpdated": "YYYY-MM-DD"
}
```

## Page JSON-LD Template

Use JSON-LD for final pages:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "json-ld",
  "@context": "https://schema.org",
  "@type": "WebPage",
  "@id": "https://www.example.com/json/pages/about.json",
  "identifier": "about",
  "name": "About",
  "description": "Clear page summary.",
  "mainEntityOfPage": "https://www.example.com/about/",
  "image": [
    "https://www.example.com/images/about.jpg"
  ],
  "mainContent": "Optional full or summarized page content for AI interpretation.",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Example FAQ question?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Example FAQ answer."
      }
    }
  ],
  "inLanguage": "en",
  "dateModified": "YYYY-MM-DD"
}
```

## Service JSON-LD Template

Use this for a service page:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "json-ld",
  "@context": "https://schema.org",
  "@type": "Service",
  "@id": "https://www.example.com/json/services/service-name.json",
  "identifier": "service-name",
  "name": "Service name",
  "description": "Clear service description.",
  "provider": {
    "@type": "Organization",
    "name": "Example Organization",
    "url": "https://www.example.com/"
  },
  "areaServed": "Service area",
  "mainEntityOfPage": "https://www.example.com/services/service-name/",
  "inLanguage": "en",
  "dateModified": "YYYY-MM-DD"
}
```

## llms.txt Template

```text
# Example Website

> AI-readable index of the website's structured content.

## Structured Data

- [AI Data Index manifest](https://www.example.com/json/index.json): Main machine-readable manifest for the website.
- [AI sitemap](https://www.example.com/json/sitemap-ai.xml): Sitemap of AI-readable structured files.

## Website

- [Homepage](https://www.example.com/): Human-readable website.
```

## robots.txt Snippet

Use standard fields first. Treat custom AI fields as non-standard discovery hints.

```text
User-agent: *
Allow: /

Sitemap: https://www.example.com/sitemap.xml
Sitemap: https://www.example.com/json/sitemap-ai.xml

# AI-specific structured data entry points (non-standard extension fields)
AI-Data: https://www.example.com/json/index.json
AI-API Data: https://www.example.com/json/index.php
AI-LLM: https://www.example.com/llms.txt
```

## Head Discovery Snippet

Add this in the HTML `<head>` when possible:

```html
<link rel="alternate" type="application/json" href="https://www.example.com/json/index.json" title="AI Manifest v1.1">
<script type="application/json" id="ai-manifest" data-ai="true">
  {
    "manifest_url": "https://www.example.com/json/index.json"
  }
</script>
```

## Body Discovery Link

Add a visible or footer link when appropriate:

```html
<a href="https://www.example.com/json/index.json" target="_blank" rel="noopener">AI Data Index</a>
```

## Validation Checklist

Before finishing, verify:

- `/json/index.json` returns valid JSON.
- Every `dataUrl` in the manifest is reachable or intentionally planned.
- Every final entity has a canonical human page through `mainEntityOfPage`, `htmlUrl`, or `url`.
- `llms.txt` points to the manifest.
- `robots.txt` includes the AI sitemap and manifest hints.
- `json/sitemap-ai.xml` lists the structured files.
- The website HTML includes the head discovery links where possible.
- The footer or body includes a direct link to the manifest when useful.
- Private notes, credentials, drafts, and local files are not uploaded.

## Output the AI Agent Should Provide

After setup, provide:

1. A list of files created or changed.
2. The public URLs that should be reachable after upload.
3. Any assumptions made.
4. Any missing information.
5. A short next-step checklist for the user.

## First Message to the User

When an AI agent or AI assistant reads this file, it should start with this:

```text
I can help you create an AI Data Index for this website. I will first collect the minimum setup information, then I will generate the JSON, JSON-LD, llms.txt, robots.txt, sitemap-ai.xml, and discovery snippets needed for the integration.

Please answer these questions:

1. What is the website URL?
2. What is the official company or website name?
3. What does the website offer in one paragraph?
4. What language or languages does the website use?
5. What type of website is it: company, local business, ecommerce, blog, directory, course, portfolio, or other?
6. Which pages, services, products, or articles should be included?
7. Can files be uploaded to the website root and to /json/?
8. Can the HTML head and robots.txt be edited?
```
