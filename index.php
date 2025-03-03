<!doctype hmtl>
<html lang="en">
    <head>
        <title>Web Scraper HN 😊🇦🇺</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">HN Webscraper</span>
      </a>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center py-3">Hacker News Dataset</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include 'templates/table.php'; ?>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php include 'templates/data/line-graph-primary.php'; ?>
            </div>
            <div class="col-md-6">
                <?php include 'templates/data/line-graph-secondary.php'; ?>
            </div>
        </div>
    </div>

    </body>
</html>
