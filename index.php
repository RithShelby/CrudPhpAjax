<!-- index.php -->
<?php
include "./config/dbConfig.php";

$page = isset($_GET['page']) && file_exists("./pages/{$_GET['page']}.php")
    ? "./pages/{$_GET['page']}.php"
    : "./pages/notes.php";

include "./layout/layout.php";

?>
