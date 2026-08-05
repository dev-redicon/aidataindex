# AI Data Index - Contesto progetto e idee operative

Ultimo aggiornamento: 04-08-2026

Questo file serve come promemoria per future chat operative sul sito `aidataindex.org`.

## Obiettivo del progetto

AI Data Index e un protocollo/convenzione pratica per rendere i contenuti di un sito leggibili, navigabili e interpretabili da AI, agenti, crawler e modelli linguistici.

L'idea centrale e creare un "sito parallelo" per le macchine, composto da file JSON, JSON-LD e Markdown che descrivono struttura, contenuti, relazioni e fonti canoniche del sito umano.

Non va presentato come standard ufficiale gia adottato universalmente. Va presentato come convenzione aperta, semplice, pragmatica e compatibile con standard esistenti.

## Componenti attuali del protocollo

- `/json/index.json`: manifest principale AI Data Index.
- File JSON secondari in `/json/`: liste, sezioni, categorie, pagine, prodotti, news, aziende, ecc.
- JSON-LD e Schema.org: vocabolario semantico consigliato per entita finali.
- `/llms.txt`: discovery file Markdown per LLM e agenti.
- `/robots.txt`: segnali standard piu campi estesi non standard.
- `/json/sitemap-ai.xml`: sitemap dedicata ai file JSON strutturati.
- Link nel `<head>`:
  - `link rel="alternate" type="application/json"`
  - `script type="application/json" id="ai-manifest" data-ai="true"`
- Link nel `<body>` o footer verso il manifest JSON.
- Endpoint opzionale `/json/index.php` per restituire il manifest via API.

## Stato ultimo lavoro - 04-08-2026

Obiettivo completato: uniformare tutti gli esempi JSON pubblici e operativi usando sempre la stessa base comune, senza togliere la possibilita di descrivere contenuti completi delle pagine.

Regola ora adottata:

- ogni esempio JSON deve dichiarare `aiDataIndexVersion`;
- ogni esempio deve dichiarare `format`, con valori `ai-json` o `json-ld`;
- manifest, indici, liste e navigazione usano `format: "ai-json"`;
- entita finali come pagine, servizi, prodotti, articoli, FAQ, local business e persone usano `format: "json-ld"` con Schema.org;
- il manifest principale usa `resources`;
- liste e indici usano `items`;
- collegamenti ai file dati usano `dataUrl`;
- collegamenti alle pagine umane usano `htmlUrl`, `url` o `mainEntityOfPage`;
- identificatori stabili usano `id`, `identifier` o `@id`;
- le entita finali possono contenere descrizione completa, immagini, FAQ, offerte, autore, testo pagina, relazioni, campi localizzati e proprieta Schema.org.

File modificati localmente:

- `index.html`: esempi pubblici uniformati.
- `ai-data-index-agent-setup.md`: template per agenti aggiornati con la base comune.
- `AI_DATA_INDEX_CONTEXT.md`: contesto aggiornato con regola v1.1 e note operative.
- `json/index.json`: convertito in manifest `ai-json` con `resources`.
- `generate-json.php`: aggiornato per generare manifest coerenti con `resources`, `dataUrl`, `htmlUrl`, `discovery`, `lastUpdated`.

Validazioni locali eseguite:

- `jq empty json/index.json`: manifest valido.
- `/Applications/MAMP/bin/php/php8.3.30/bin/php -l generate-json.php`: nessun errore di sintassi.
- simulazione POST del generatore PHP: output JSON valido.
- estrazione e validazione di tutti i blocchi ```json in `AI_DATA_INDEX_CONTEXT.md` e `ai-data-index-agent-setup.md`: tutti validi.

Pubblicazione eseguita via FTPS:

- `index.html`
- `ai-data-index-agent-setup.md`
- `json/index.json`
- `generate-json.php`

Nota importante: il primo tentativo FTP semplice ha restituito `curl: (67) Access denied: 550`. La pubblicazione e riuscita usando FTPS esplicito con `curl --ssl-reqd`.

Verifiche online eseguite dopo upload:

- `https://aidataindex.org/json/index.json`: risponde con nuovo manifest `ai-json`.
- `https://aidataindex.org/ai-data-index-agent-setup.md`: risponde con template aggiornati.
- `https://aidataindex.org/`: contiene i nuovi marker `aiDataIndexVersion`, `format`, `resources`, `items`.
- `https://aidataindex.org/generate-json.php`: risponde HTTP 200.

## Distinzione importante: JSON AI vs JSON-LD Schema.org

Problema emerso: nelle integrazioni attuali i file JSON sono stati creati in modo pratico, spesso con ChatGPT, ma non sempre seguono lo stesso schema. Alcuni sono JSON puri, altri JSON-LD, altri sono ibridi. Per divulgare il sistema serve formalizzare meglio.

Distinguere due livelli:

1. JSON puro AI Data Index
2. JSON-LD compatibile Schema.org

### 1. JSON puro AI Data Index

Serve principalmente alle AI e agli agenti.

Deve essere semplice, stabile, prevedibile e facile da generare automaticamente.

Ogni file JSON AI Data Index dovrebbe partire da una base comune, cosi le AI non devono indovinare ogni volta struttura, formato o collegamenti canonici.

Campi base consigliati:

- `aiDataIndexVersion`: versione della convenzione AI Data Index.
- `format`: `ai-json` oppure `json-ld`.
- `type` oppure `@type`: tipo del documento o dell'entita.
- `id`, `identifier` oppure `@id`: identificatore stabile.
- `name`: nome leggibile.
- `description`: descrizione chiara e naturale.
- `inLanguage`: lingua o lingue del contenuto.
- `dataUrl`: URL del file JSON, soprattutto negli indici e nelle liste.
- `htmlUrl`, `url` oppure `mainEntityOfPage`: URL della pagina umana canonica.
- `lastUpdated` oppure `dateModified`: data di aggiornamento, se disponibile.

Regola pratica:

- usare `resources` nel manifest principale;
- usare `items` nelle liste e negli indici;
- usare Schema.org e campi ricchi nelle entita finali.

Le entita finali possono e dovrebbero contenere tutti i dettagli utili: descrizione completa, immagini, FAQ, testo della pagina, offerte, autore, relazioni, dati localizzati e proprieta specifiche Schema.org.

Esempi di file JSON puro:

- manifest globale;
- liste di sezioni;
- liste categorie;
- indici paginati;
- liste prodotti;
- liste aziende;
- liste blog;
- file di relazione tra entita.

Esempio:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "ai-json",
  "type": "ItemList",
  "id": "trattamenti-estetici",
  "name": "Trattamenti estetici",
  "description": "Lista dei trattamenti estetici disponibili sul sito.",
  "inLanguage": "it-IT",
  "items": [
    {
      "id": "epilazione-laser",
      "type": "Service",
      "name": "Epilazione Laser",
      "description": "Trattamento di epilazione laser.",
      "dataUrl": "https://example.com/json/trattamenti/epilazione-laser.json",
      "htmlUrl": "https://example.com/epilazione-laser/"
    }
  ],
  "lastUpdated": "2026-08-04"
}
```

Nota: il JSON puro AI Data Index puo usare campi propri come `type`, `items`, `dataUrl`, `htmlUrl`, `lastUpdated`, `source`, `relations`. Questi campi vanno documentati nella specifica.

### 2. JSON-LD Schema.org

Serve per compatibilita semantica con Schema.org, Google, motori di ricerca, parser RDF/linked data e strumenti che riconoscono JSON-LD.

Va usato soprattutto sulle entita finali:

- pagina;
- articolo;
- prodotto;
- servizio;
- corso;
- azienda;
- local business;
- FAQ;
- persona;
- organizzazione.

Esempio:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "json-ld",
  "@context": "https://schema.org",
  "@type": "Service",
  "@id": "https://example.com/json/trattamenti/epilazione-laser.json",
  "identifier": "epilazione-laser",
  "name": "Epilazione Laser",
  "description": "Descrizione del trattamento.",
  "mainEntityOfPage": "https://example.com/epilazione-laser/",
  "image": [
    "https://example.com/images/epilazione-laser.jpg"
  ],
  "inLanguage": "it-IT",
  "dateModified": "2026-08-04"
}
```

### Regola proposta per v1.1

Usare JSON puro AI Data Index per manifest, liste, indici e navigazione.

Usare JSON-LD Schema.org per le entita finali o quando si descrive un oggetto semantico preciso.

Ogni file dovrebbe dichiarare chiaramente il proprio formato:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "ai-json",
  "type": "ItemList",
  "id": "example-list",
  "name": "Example list",
  "description": "Short description of this index or list.",
  "inLanguage": "en",
  "items": []
}
```

oppure:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "json-ld",
  "@context": "https://schema.org",
  "@type": "Product",
  "@id": "https://www.example.com/json/products/items/product-000001.json",
  "identifier": "product-000001",
  "name": "Example product",
  "description": "Short product description.",
  "mainEntityOfPage": "https://www.example.com/products/example-product/",
  "inLanguage": "en"
}
```

### Motivo della distinzione

Il JSON puro rende il protocollo piu semplice e stabile per AI e plugin.

Il JSON-LD mantiene compatibilita con Schema.org e con l'ecosistema gia esistente.

Non bisogna scegliere uno contro l'altro: AI Data Index deve usarli entrambi, ma con ruoli chiari.

### Necessita futura

Creare una specifica dei campi minimi obbligatori per ogni tipo di file:

- manifest;
- item list;
- page;
- blog post;
- product;
- service;
- course;
- local business;
- organization;
- contact page.

Questo evitera che ChatGPT o altri generatori producano strutture incoerenti ogni volta.

## Terminologia consigliata

Usare "manifest" per indicare il file centrale `index.json`.

Il manifest non sostituisce i segnali di discovery. E il file centrale verso cui puntano i segnali.

Usare "Discovery Layer" per l'insieme di:

- head link
- script JSON in head
- link body/footer
- llms.txt
- robots.txt
- sitemap-ai.xml
- endpoint API

## Stato rilevamento AI nel 2026

Nel 2026 il rilevamento automatico e migliorato rispetto all'anno precedente, ma non e ancora affidabile con un solo segnale.

`llms.txt` e una convenzione emergente, riconosciuta anche da strumenti come Lighthouse per l'agentic browsing, ma resta opzionale.

Nessun grande provider va descritto come obbligato a leggere automaticamente `llms.txt` o campi custom in `robots.txt`.

Strategia consigliata: mantenere piu segnali ridondanti. Questa ridondanza e una caratteristica del protocollo, non un errore.

## Nota robots.txt

`Sitemap:` e un campo riconosciuto e utile.

I campi:

- `AI-Data`
- `AI-API Data`
- `AI-LLM`

sono estensioni dichiarative non standard. Possono essere utili per AI e agenti, ma non vanno presentati come direttive ufficiali supportate da tutti i crawler.

## Multilingua

Il protocollo attuale non gestisce ancora bene il multilingua. Per la v1.1 va introdotta una convenzione dedicata.

Regola consigliata:

> Per contenuti editoriali, navigazione e tassonomie: manifest separati per lingua.
> Per grandi cataloghi di entita ripetute: file canonici unici con campi localizzati interni.

Formula ancora piu precisa:

> Lingue separate dove cambia l'esperienza del sito. Entita uniche dove cambia solo la traduzione del contenuto.

Struttura base consigliata:

```text
/json/index.json
/json/it/index.json
/json/en/index.json
/json/fr/index.json
```

Il manifest principale resta globale. I manifest lingua contengono la struttura localizzata.

I nomi tecnici di cartelle e file strutturali dovrebbero restare in inglese stabile:

- `pages`
- `categories`
- `articles`
- `products`
- `items`
- `companies`
- `locations`
- `offers`
- `news`

Il contenuto localizzato va espresso nei campi JSON e negli indici localizzati, non nel path tecnico.

Evitare quindi che ogni lingua abbia nomi tecnici diversi, ad esempio `pagine`, `articoli`, `produits`, `categorias`, ecc. Questo rende piu difficile la generazione automatica, il crawling e l'interpretazione da parte di AI, plugin e sviluppatori.

Il manifest globale dovrebbe dichiarare le lingue disponibili e puntare ai manifest localizzati:

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
  "lastUpdated": "2026-08-04"
}
```

Campi consigliati:

- `inLanguage`
- `availableLanguage`
- `languageManifests`
- `workTranslation`
- `translationOfWork`
- `sameAs`
- `mainEntityOfPage`

### Struttura ibrida per cataloghi grandi

Per database grandi non duplicare tutto per ogni lingua. Evitare strutture di questo tipo quando ci sono migliaia di record:

```text
/json/it/products/items/prodotto-001.json
/json/en/products/items/prodotto-001.json
/json/fr/products/items/prodotto-001.json
```

Con 5000 prodotti diventerebbero 15000 file per sole tre lingue, con costi inutili di manutenzione, aggiornamento e crawling.

Per archivi grandi generati da CMS o database, usare nomi file canonici stabili e non dipendenti dalla lingua:

```text
/json/articles/items/post-12345.json
/json/products/items/product-98765.json
/json/companies/items/company-456.json
```

In WordPress questa scelta e molto naturale:

- articoli e pagine: `post-{ID}.json`
- prodotti WooCommerce: `product-{ID}.json`
- categorie o tassonomie: `term-{ID}.json`
- utenti/autori, se esposti: `user-{ID}.json`

Esempio:

```text
/json/articles/items/post-12345.json
/json/products/items/product-98765.json
```

Questa soluzione evita di cambiare URL del dato quando cambia titolo, slug o traduzione. Il nome del file resta un identificatore tecnico; il significato vero sta nei campi JSON.

Preferire invece una struttura ibrida:

```text
/json/
├── index.json
├── it/
│   ├── index.json
│   ├── pages.json
│   ├── categories.json
│   └── products.json
├── en/
│   ├── index.json
│   ├── pages.json
│   ├── categories.json
│   └── products.json
├── fr/
│   ├── index.json
│   ├── pages.json
│   ├── categories.json
│   └── products.json
└── products/
    ├── index.json
    ├── pages/
    │   ├── page-1.json
    │   ├── page-2.json
    │   └── page-50.json
    └── items/
        ├── product-000001.json
        ├── product-000002.json
        └── product-005000.json
```

I file lingua come `/json/it/products.json` e `/json/en/products.json` sono indici localizzati leggeri. Non contengono le schede complete dei prodotti.

Esempio di indice prodotti localizzato:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "ai-json",
  "type": "ItemList",
  "id": "products-it",
  "name": "Prodotti",
  "description": "Indice localizzato dei prodotti disponibili in italiano.",
  "inLanguage": "it",
  "items": [
    {
      "id": "product-000001",
      "type": "Product",
      "name": "Scarpa in pelle nera",
      "description": "Scarpa artigianale in pelle nera.",
      "dataUrl": "https://www.example.com/json/products/items/product-000001.json",
      "htmlUrl": "https://www.example.com/it/prodotti/scarpa-pelle-nera/"
    }
  ],
  "lastUpdated": "2026-08-04"
}
```

Il singolo prodotto resta invece un file canonico unico:

```text
/json/products/items/product-000001.json
```

Esempio di prodotto canonico multilingua:

```json
{
  "aiDataIndexVersion": "1.1",
  "format": "json-ld",
  "@context": "https://schema.org",
  "@type": "Product",
  "@id": "https://www.example.com/json/products/items/product-000001.json",
  "identifier": "product-000001",
  "sku": "PROD-001",
  "name": {
    "it": "Scarpa in pelle nera",
    "en": "Black leather shoe",
    "fr": "Chaussure en cuir noir"
  },
  "description": {
    "it": "Scarpa artigianale in pelle nera.",
    "en": "Handcrafted black leather shoe.",
    "fr": "Chaussure artisanale en cuir noir."
  },
  "url": {
    "it": "https://www.example.com/it/prodotti/scarpa-pelle-nera/",
    "en": "https://www.example.com/en/products/black-leather-shoe/",
    "fr": "https://www.example.com/fr/produits/chaussure-cuir-noir/"
  },
  "image": [
    "https://www.example.com/images/products/product-000001.jpg"
  ],
  "inLanguage": ["it", "en", "fr"]
}
```

Per piccoli siti monolingua o con poche pagine editoriali, il nome file puo seguire la lingua predefinita del sito:

```text
/json/pages/chi-siamo.json
/json/articles/come-scegliere-una-bicicletta.json
```

Questa scelta e accettabile per contenuti limitati e gestiti manualmente. Non va usata come regola principale per archivi grandi, cataloghi, directory o contenuti generati da CMS.

Separare logicamente:

- dati neutrali: ID, SKU, immagini, prezzo, disponibilita, coordinate, categoria tecnica, relazioni;
- dati localizzati: nome, descrizione, slug, URL, FAQ, testi editoriali.

### Caso articoli

Per tanti articoli, usare una logica simile ai prodotti, ma distinguere tra traduzioni fedeli e versioni editoriali diverse.

Se gli articoli sono traduzioni fedeli dello stesso contenuto, usare un file canonico unico con campi localizzati interni:

```text
/json/
├── index.json
├── it/
│   ├── index.json
│   └── articles/
│       ├── index.json
│       ├── pages/
│       │   ├── page-1.json
│       │   └── page-50.json
│       └── categories/
│           ├── tecnologia.json
│           └── finanza.json
├── en/
│   ├── index.json
│   └── articles/
│       ├── index.json
│       ├── pages/
│       └── categories/
└── articles/
    └── items/
        ├── post-12345.json
        ├── post-12346.json
        └── post-50000.json
```

Esempio di articolo canonico multilingua:

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
  "author": {
    "@type": "Person",
    "name": "Author Name"
  },
  "datePublished": "2026-08-04",
  "dateModified": "2026-08-04",
  "mainEntityOfPage": {
    "it": "https://www.example.com/it/articoli/come-preparare-i-dati-ai/",
    "en": "https://www.example.com/en/articles/how-to-prepare-ai-data/"
  },
  "inLanguage": ["it", "en"]
}
```

Se invece gli articoli non sono traduzioni fedeli, ma versioni editoriali diverse per lingua, usare file separati per lingua e collegarli tra loro con `translationOfWork`, `workTranslation` o `sameAs`:

```text
/json/it/articles/items/articolo-001.json
/json/en/articles/items/article-001.json
```

Sintesi operativa:

- articoli tradotti automaticamente o quasi identici: file unico multilingua;
- articoli editorialmente diversi per lingua: file separati per lingua;
- indici, categorie e paginazione: sempre leggeri e localizzati.

### Nota sulla lingua inglese

Non conviene lasciare tutto solo in inglese se il sito e italiano.

Le AI comprendono bene piu lingue, anche se l'inglese resta spesso la lingua piu forte per interoperabilita tecnica. Per un sito italiano e preferibile mantenere la lingua originale e aggiungere l'inglese come lingua di supporto quando possibile.

Soluzione consigliata:

- lingua reale del sito sempre presente;
- inglese opzionale ma consigliato per nomi, descrizioni e riassunti;
- URL HTML coerenti con la lingua effettiva della pagina;
- `mainEntityOfPage` sempre collegato alla pagina umana canonica della lingua corretta.

## Database grandi e paginazione

Per siti come marketplace, directory o portali con migliaia di record, non creare liste monolitiche enormi.

Usare indici leggeri e paginati:

```text
/json/it/products/index.json
/json/it/products/page-1.json
/json/it/products/page-2.json
/json/it/products/page-3.json
```

Ogni pagina lista puo contenere 100, 250 o 500 record sintetici, in base al peso finale del file.

Ogni item della lista dovrebbe contenere almeno:

- ID stabile
- nome
- breve descrizione opzionale
- URL JSON completo
- URL pagina HTML canonica
- lingua
- categoria
- data aggiornamento, se disponibile

## Caso reale usato come riferimento: Compra Diretto

Non lavorare su Compra Diretto in questa fase. Serve solo come caso reale per comprendere e documentare il protocollo.

Manifest reale:

`https://www.compradiretto.it/json/index.json`

Percorsi verificati:

```text
/json/index.json
  -> /json/elenco-prodotti.json
      -> /json/products/olio-extravergine-di-oliva.json
          -> /json/farm-products/olio-evo-stagione-2025.json
          -> /json/news/olio-extravergine-doliva-made-in-Italy-eccellenza-nella-qualita.json

  -> /json/annunci.json
      -> /json/frutta.json
          -> /json/farm-products/fragole-di-montagna.json

  -> /json/attivita.json
      -> /json/aziende-agricole-toscana.json
          -> /json/companies/azienda-agricola-pangea.json

  -> /json/news.json
      -> /json/news-frutta.json
          -> singole news
```

Conclusione del test: la struttura e navigabile fino a categorie, prodotti/tag, annunci, aziende e news.

Relazioni osservate:

- prodotto/tag -> annunci reali
- prodotto/tag -> news correlate
- annuncio -> produttore
- annuncio -> prodotto/tag
- azienda -> dati LocalBusiness
- news -> prodotto/tag

Migliorie da formalizzare nella specifica:

- aggiungere sempre `inLanguage`;
- sostituire campi custom incoerenti come `hasPart_annunci` e `hasPart_news` con campi documentati, ad esempio `relations`, `relatedItems`, `dataUrl` e `htmlUrl`;
- introdurre paginazione per liste grandi;
- distinguere formalmente categoria, tag prodotto, annuncio, produttore e articolo;
- aggiungere `dateModified` o `lastUpdated` nelle liste e nelle entita dove possibile.

## File Markdown per agenti AI

Idea importante: oltre al tool visuale, creare file `.md` che permettano alle AI di generare correttamente un AI Data Index.

Questi file servono a rendere il protocollo "agent-ready".

### Stato attuale 04-08-2026

Creato il file pubblico:

```text
ai-data-index-agent-setup.md
```

URL pubblico previsto:

```text
https://aidataindex.org/ai-data-index-agent-setup.md
```

Scopo del file: essere dato in pasto a Codex, ChatGPT, Gemini, Claude, Perplexity o altri agenti/assistenti AI prima di integrare AI Data Index su un sito. Il file istruisce l'AI sul metodo, chiarisce che AI Data Index e una convenzione aperta e non uno standard ufficiale, poi avvia un setup con domande minime all'utente.

Il file e volutamente platform-neutral:

- se l'AI puo leggere e modificare file, deve lavorare direttamente sul progetto;
- se non puo accedere al filesystem, deve generare contenuti pronti e indicare dove inserirli;
- se puo solo navigare il sito, deve fare audit e produrre un pacchetto operativo;
- se non puo navigare, deve chiedere URL, pagine, sitemap, CMS e contenuti rappresentativi.

Struttura del file:

- ruolo dell'AI agent;
- note di compatibilita tra sistemi AI;
- concetto base di AI Data Index;
- regola `ai-json` vs `json-ld`;
- MVP consigliato per piccoli siti aziendali;
- domande di setup;
- template per manifest, pagine, servizi, `llms.txt`, `robots.txt`, snippet head/body;
- checklist di validazione;
- primo messaggio che l'AI deve fare all'utente.

Modifiche sito correlate:

- aggiunta voce menu `Agent setup (.md)`;
- la voce menu NON scarica direttamente il file;
- la voce menu porta alla sezione `#m_agent_setup`;
- nella sezione e presente una breve spiegazione per utenti non tecnici e poi il link di download del `.md`;
- aggiunta frase nella sezione `#m_agent_setup`: il file e il punto di partenza consigliato per integrazioni assistite da AI, prima di creare, revisionare o aggiornare una implementazione AI Data Index;
- `llms.txt` include il link al file setup;
- `sitemap.xml` include il file setup;
- `json/index.json` include il file setup come `DigitalDocument`.

Pubblicazione:

- caricato via FTP dentro `public_html`, che e la document root reale del sito;
- inizialmente era stato caricato anche nella root FTP, ma quella non e la root pubblica;
- file pubblicati: `index.html`, `ai-data-index-agent-setup.md`, `llms.txt`, `sitemap.xml`, `json/index.json`.

Nota verifica:

- `ai-data-index-agent-setup.md`, `llms.txt`, `sitemap.xml` e i file remoti via FTP sono stati verificati;
- durante gli ultimi controlli il terminale ha avuto DNS intermittente su `aidataindex.org` e `dedi6178.your-server.de`, ma gli upload FTP completati hanno dato esito positivo.

Struttura consigliata:

```text
/spec/
  protocol.md
  multilingual.md
  discovery-layer.md
  database-large-sites.md
  json-schema.md

/templates/
  index-json.md
  page-json.md
  product-json.md
  localbusiness-json.md
  newsarticle-json.md
  llms-txt.md
  robots-snippet.md

/prompts/
  generate-ai-data-index.md
  generate-product-json.md
  audit-ai-data-index.md
```

Priorita consigliata:

1. Scrivere `AI_DATA_INDEX_SPEC.md` o `/spec/protocol.md`.
2. Scrivere `AI_DATA_INDEX_MULTILINGUAL.md` o `/spec/multilingual.md`.
3. Scrivere template canonici.
4. Scrivere prompt operativi per AI.
5. Solo dopo progettare tool visuale e plugin WordPress.

## Tool di generazione

Da discutere piu avanti.

Idea generale:

- tool base online che genera `index.json`, `llms.txt`, `robots.txt`, `sitemap-ai.xml`;
- wizard avanzato che genera pacchetto ZIP;
- output includera anche snippet head/body e template JSON-LD.

## Plugin WordPress

Da discutere piu avanti.

Idea MVP:

- generare `/json/index.json`;
- generare JSON per pagine, articoli, categorie;
- supportare WooCommerce se presente;
- aggiungere discovery layer nel `<head>`;
- esporre `/llms.txt` e `/json/sitemap-ai.xml`;
- usare endpoint virtuali quando non e possibile scrivere fisicamente in root;
- pannello admin per organizzazione, logo, lingue, tipi contenuto, rigenerazione manifest.

## File locali importanti

- `index.html`: sito pubblico attuale.
- `ai-data-index-agent-setup.md`: file pubblico agent-ready da scaricare e dare a Codex, ChatGPT, Gemini, Claude, Perplexity o altri agenti AI per avviare automaticamente un'integrazione AI Data Index.
- `json/index.json`: manifest del sito AI Data Index.
- `llms.txt`: discovery file aggiornato in formato Markdown.
- `robots.txt`: segnali crawler e campi estesi.
- `json/sitemap-ai.xml`: sitemap AI.
- `AI_DATA_INDEX_NOTE.md`: contiene note operative e FTP, NON caricare online.
- `AI_DATA_INDEX_CONTEXT.md`: questo file di contesto.

## Attenzione credenziali

Non caricare online file che contengono password, FTP o note private.

In particolare `AI_DATA_INDEX_NOTE.md` deve restare locale.
