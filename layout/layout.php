<?php include "./config/dbConfig.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="d-flex" id="wrapper">
    <?php include "sidebar.php"; ?>

    <div id="page-content-wrapper" class="flex-grow-1">
        <?php include "header.php"; ?>

        <div class="container-fluid py-4">
            <?php
            $page = $_GET['page'] ?? 'notes';
            $pagePath = "./pages/{$page}.php";
            if (file_exists($pagePath)) {
                include $pagePath;
            } else {
                echo "<h1 class='text-danger'>Page not found!</h1>";
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
