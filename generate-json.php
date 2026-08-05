<?php
session_start();

if (isset($_POST['reset'])) {
    unset($_SESSION['json_output']);
    unset($_SESSION['form_data']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && !isset($_POST['download'])) {
    $_SESSION['form_data'] = $_POST;

    $base_url = rtrim($_POST['url'], '/');
    $site_id = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $_POST['name']), '-')) ?: 'website';

    $json = [
        "aiDataIndexVersion" => "1.1",
        "format" => "ai-json",
        "type" => "WebSiteManifest",
        "id" => $site_id . "-manifest",
        "name" => $_POST['name'],
        "url" => $_POST['url'],
        "description" => $_POST['description'],
        "publisher" => [
            "@type" => "Organization",
            "name" => $_POST['name'],
            "url" => $_POST['url'],
            "logo" => [
                "@type" => "ImageObject",
                "url" => $_POST['logo_url']
            ]
        ],
        "inLanguage" => $_POST['in_language'],
        "resources" => [],
        "discovery" => [
            "llmsTxt" => $base_url . "/llms.txt",
            "robotsTxt" => $base_url . "/robots.txt",
            "aiSitemap" => $base_url . "/json/sitemap-ai.xml",
            "apiEndpoint" => $base_url . "/json/index.php"
        ],
        "lastUpdated" => date('Y-m-d')
    ];

    if (!empty($_POST['resource_name'])) {
        foreach ($_POST['resource_name'] as $index => $name) {
            $parsed_url = parse_url($_POST['resource_url'][$index]);
            $path = $parsed_url['path'] ?? '';
            $filename = basename($path);
            $filename_no_ext = preg_replace('/\.[^.]+$/', '', $filename);
            $json_url = $base_url . '/json/' . $filename_no_ext . '.json';
            $resource_id = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $filename_no_ext), '-')) ?: 'resource-' . ($index + 1);

            $json['resources'][] = [
                "id" => $resource_id,
                "type" => "WebPage",
                "name" => $name,
                "description" => $_POST['resource_description'][$index],
                "dataUrl" => $json_url,
                "htmlUrl" => $_POST['resource_url'][$index]
            ];
        }
    }

    $_SESSION['json_output'] = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['download']) && isset($_SESSION['json_output'])) {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="index.json"');
    echo $_SESSION['json_output'];
    exit;
}

$form_data = $_SESSION['form_data'] ?? [];
$json_output = $_SESSION['json_output'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generate AI Data Index JSON</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
<h1>Generate AI Data Index JSON</h1>
</header>
<main>
<section>
<?php if (!$json_output): ?>
<h2>General Website Information</h2>
<form method="post">
<label>Website Name:<br><input type="text" name="name" required value="<?= htmlspecialchars($form_data['name'] ?? '') ?>"></label><br><br>
<label>Website URL:<br><input type="url" name="url" required value="<?= htmlspecialchars($form_data['url'] ?? '') ?>"></label><br><br>
<label>Description:<br><textarea name="description" rows="3" required><?= htmlspecialchars($form_data['description'] ?? '') ?></textarea></label><br><br>
<label>Logo URL:<br><input type="url" name="logo_url" required value="<?= htmlspecialchars($form_data['logo_url'] ?? '') ?>"></label><br><br>
<label>Language:<br><input type="text" name="in_language" required value="<?= htmlspecialchars($form_data['in_language'] ?? 'en') ?>"></label><br><br>
<hr>
<h2>Resources</h2>
<p>Add the sections you want to include (e.g., About Us, Services, Contacts).</p>
<div id="resource-container">
<?php
$resource_names = $form_data['resource_name'] ?? [''];
foreach ($resource_names as $index => $val): ?>
<div class="resource-item">
<label>Section Name:<br><input type="text" name="resource_name[]" required value="<?= htmlspecialchars($val) ?>"></label><br>
<label>Section Description:<br><textarea name="resource_description[]" rows="2" required><?= htmlspecialchars($form_data['resource_description'][$index] ?? '') ?></textarea></label><br>
<label>Section HTML URL:<br><input type="url" name="resource_url[]" required value="<?= htmlspecialchars($form_data['resource_url'][$index] ?? '') ?>"></label><br><br>
</div>
<?php endforeach; ?>
</div>
<button type="button" onclick="addResource()">+ Add Another Section</button><br><br>
<button type="submit">Generate JSON</button>
</form>
<?php else: ?>
<h2>Generated JSON Preview</h2>
<pre><?= htmlspecialchars($json_output) ?></pre>
<form method="post">
<input type="hidden" name="download" value="1">
<button type="submit">Download index.json</button>
</form>
<form method="post">
<button type="submit" name="reset" value="1">Back</button>
</form>
<?php endif; ?>
</section>
</main>
<script>
function addResource() {
    const container = document.getElementById('resource-container');
    const div = document.createElement('div');
    div.className = 'resource-item';
    div.innerHTML = `
    <label>Section Name:<br><input type="text" name="resource_name[]" required></label><br>
    <label>Section Description:<br><textarea name="resource_description[]" rows="2" required></textarea></label><br>
    <label>Section HTML URL:<br><input type="url" name="resource_url[]" required></label><br><br>
    `;
    container.appendChild(div);
}
</script>
<footer>
<section class="footerDev">
<p>Developed for AI Data Index generation utility - Red Icon SA</p>
</section>
</footer>
</body>
</html>
