<!doctype html>
<html lang="nl">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twente Milieu iCal Generator</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      :root {
        --primary: #2c5530;
        --primary-light: #4a7c4f;
        --primary-dark: #1e3a21;
        --accent: #6b9f73;
        --text: #1a1a1a;
        --text-light: #666;
        --border: #d1d5db;
        --bg-light: #f9fafb;
        --bg-white: #ffffff;
        --success: #10b981;
        --error: #ef4444;
        --error-bg: #fef2f2;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: var(--bg-light);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        color: var(--text);
        line-height: 1.6;
      }

      .container {
        background: var(--bg-white);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        padding: 48px;
        max-width: 560px;
        width: 100%;
        border: 1px solid var(--border);
      }

      .header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 24px;
        border-bottom: 2px solid var(--bg-light);
      }

      h1 {
        color: var(--text);
        margin-bottom: 8px;
        font-size: 32px;
        font-weight: 700;
        letter-spacing: -0.5px;
      }

      .subtitle {
        color: var(--text-light);
        font-size: 15px;
        font-weight: 400;
      }

      .form-group {
        margin-bottom: 24px;
      }

      label {
        display: block;
        margin-bottom: 8px;
        color: var(--text);
        font-weight: 600;
        font-size: 14px;
        letter-spacing: 0.2px;
      }

      input[type="text"] {
        width: 100%;
        padding: 14px 16px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.2s;
        background: var(--bg-white);
        color: var(--text);
      }

      input[type="text"]:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(44, 85, 48, 0.1);
      }

      input[type="text"]::placeholder {
        color: #9ca3af;
      }

      button {
        width: 100%;
        padding: 16px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 8px;
        letter-spacing: 0.3px;
      }

      button:hover {
        background: var(--primary-light);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      button:active {
        transform: scale(0.98);
      }

      .result-box {
        background: var(--bg-light);
        border: 1.5px solid var(--border);
        border-left: 4px solid var(--success);
        border-radius: 8px;
        padding: 24px;
        margin-top: 32px;
      }

      .result-box h2 {
        color: var(--text);
        font-size: 20px;
        margin-bottom: 12px;
        font-weight: 600;
      }

      .result-box p {
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 16px;
        line-height: 1.6;
      }

      .url-container {
        position: relative;
        margin-top: 16px;
      }

      .url-link {
        display: block;
        word-break: break-all;
        background: var(--bg-white);
        padding: 14px 16px;
        border-radius: 6px;
        border: 1.5px solid var(--border);
        color: var(--primary);
        text-decoration: none;
        font-family: 'SF Mono', 'Monaco', 'Cascadia Code', 'Roboto Mono', monospace;
        font-size: 13px;
        transition: all 0.2s;
        line-height: 1.5;
      }

      .url-link:hover {
        background: var(--bg-light);
        border-color: var(--primary);
        text-decoration: none;
      }

      .copy-btn {
        margin-top: 12px;
        padding: 10px 16px;
        background: var(--bg-white);
        border: 1.5px solid var(--border);
        border-radius: 6px;
        color: var(--text);
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        width: auto;
      }

      .copy-btn:hover {
        background: var(--bg-light);
        border-color: var(--primary);
        color: var(--primary);
      }

      .error-box {
        background: var(--error-bg);
        border: 1.5px solid #fecaca;
        border-left: 4px solid var(--error);
        border-radius: 8px;
        padding: 24px;
        margin-top: 32px;
      }

      .error-box h2 {
        color: var(--error);
        font-size: 20px;
        margin-bottom: 12px;
        font-weight: 600;
      }

      .error-box p {
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 16px;
        line-height: 1.6;
      }

      .back-link {
        display: inline-flex;
        align-items: center;
        margin-top: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.2s;
      }

      .back-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
      }

      .icon {
        display: none;
      }

      @media (max-width: 640px) {
        .container {
          padding: 32px 24px;
        }

        h1 {
          font-size: 28px;
        }
      }
    </style>
  </head>

  <body>

    <div class="container">
      <?php
        $postcode = $_GET['postcode'] ?? null;
        $huisnummer = $_GET['huisnummer'] ?? null;

        if ( $postcode && $huisnummer ) {
          require 'classes/twente_milieu.php';
          try {
            $afvalkalender = new TwenteMilieu($postcode, $huisnummer);
            
            // Build URL properly with HTTPS (always use HTTPS for production)
            // New format: /ical/<postcode>/<huisnummer>
            $host = $_SERVER['SERVER_NAME'] ?? $_SERVER['HTTP_HOST'];
            $path = dirname($_SERVER['SCRIPT_NAME']);
            // Remove trailing slash and ensure single slash
            $path = rtrim($path, '/');
            $url = 'https://' . $host . ($path !== '/' && $path !== '.' ? $path : '') . '/ical/';
            $url .= urlencode($afvalkalender->safePostcode()) . '/';
            $url .= urlencode($afvalkalender->safeHuisnummer());
      ?>

            <div class="header">
              <h1>iCal Link Gereed</h1>
              <p class="subtitle">Je afvalkalender feed is klaar voor gebruik</p>
            </div>

            <div class="result-box">
              <h2>Voeg toe aan je agenda</h2>
              <p>Kopieer de onderstaande link en voeg deze toe aan je favoriete kalender applicatie zoals Google Calendar, Apple Calendar of Outlook.</p>
              <div class="url-container">
                <a href="<?php echo htmlspecialchars($url); ?>" class="url-link" target="_blank" id="ical-url"><?php echo htmlspecialchars($url); ?></a>
                <button type="button" class="copy-btn" onclick="copyToClipboard(event)">Kopieer link</button>
              </div>
            </div>

            <script>
              function copyToClipboard(event) {
                const url = document.getElementById('ical-url').textContent;
                navigator.clipboard.writeText(url).then(function() {
                  const btn = event.target;
                  const originalText = btn.textContent;
                  btn.textContent = 'Gekopieerd!';
                  btn.style.background = 'var(--success)';
                  btn.style.color = 'white';
                  btn.style.borderColor = 'var(--success)';
                  setTimeout(function() {
                    btn.textContent = originalText;
                    btn.style.background = '';
                    btn.style.color = '';
                    btn.style.borderColor = '';
                  }, 2000);
                }).catch(function(err) {
                  console.error('Failed to copy:', err);
                });
              }
            </script>

          <?php } catch ( Exception $e ) { ?>

            <div class="header">
              <h1>Fout opgetreden</h1>
              <p class="subtitle">Er is iets misgegaan met je invoer</p>
            </div>

            <div class="error-box">
              <h2>Ongeldige invoer</h2>
              <p><?php echo htmlspecialchars($e->getMessage()); ?></p>
              <a href="index.php" class="back-link">← Terug naar formulier</a>
            </div>

          <?php } ?>

        <?php } else { ?>

          <div class="header">
            <h1>Twente Milieu iCal Generator</h1>
            <p class="subtitle">Genereer een iCal feed voor je afvalkalender</p>
          </div>

          <form method="get" action="">
            <div class="form-group">
              <label for="postcode">Postcode</label>
              <input type="text" id="postcode" name="postcode" value="<?php echo htmlspecialchars($postcode ?? ''); ?>" placeholder="1234AB" required pattern="[0-9]{4}[A-Za-z]{2}" title="Voer een geldige postcode in (bijv. 1234AB)">
            </div>
            <div class="form-group">
              <label for="huisnummer">Huisnummer</label>
              <input type="text" id="huisnummer" name="huisnummer" value="<?php echo htmlspecialchars($huisnummer ?? ''); ?>" placeholder="123" required pattern="[0-9]+" title="Voer een geldig huisnummer in">
            </div>
            <button type="submit">Genereer iCal link</button>
          </form>

        <?php } ?>
    </div>

  </body>

</html>
