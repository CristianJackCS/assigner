<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Page Assigner</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="header_title">
    <h1>Product Page Assigner</h1>
  </div>

  <div class="form_container_pg_assigner">
    <form id="assignForm" action="process.php" method="post" enctype="multipart/form-data">
      <!-- File upload (full width) -->
      <div class="field span-2">
        <label for="file">Upload Excel:</label>
        <input type="file" id="file" name="file" accept=".xlsx,.csv" required>
      </div>

      <!-- SECTION: Page settings -->
      <fieldset class="section span-2">
        <legend>Page settings</legend>
        <div class="section-grid">
          <div class="field">
            <label for="pages">Set the number of pages:</label>
            <input type="number" id="pages" name="pages" value="10" min="1">
          </div>

          <div class="field">
            <label for="per_page">
              Products/page <span class="small-hint">do not modify this value</span>:
            </label>
            <input type="number" id="per_page" name="per_page" value="30" min="1" readonly>
          </div>

          <div class="field">
            <label for="min_stock">Include products with stock of min:</label>
            <input type="number" id="min_stock" name="min_stock" value="1" min="0">
          </div>
        </div>
      </fieldset>

      <!-- SECTION: Preferred brands -->
      <fieldset class="section span-2">
        <legend>Preferred brands</legend>
        <div class="section-grid">
          <div class="field checkbox span-2">
            <input type="checkbox" id="prefer_mode" name="prefer_mode" checked>
            <label for="prefer_mode">Enable preferred brands</label>
          </div>

          <div class="field">
            <label for="preferred_ratio">Preferred brands ratio:</label>
            <input type="number" step="0.05" id="preferred_ratio" name="preferred_ratio" value="0.7" min="0" max="1">
          </div>

          <div class="field">
            <label for="preferred_cap">Preferred brands recurrence per page:</label>
            <input type="number" id="preferred_cap" name="preferred_cap" value="2" min="0">
          </div>
        </div>
      </fieldset>

      <div class="actions span-2">
        <button type="submit">Generate</button>
      </div>
    </form>
  </div>
</body>
</html>
