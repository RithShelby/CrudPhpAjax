<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />
    <style>
        #sidebarContainer {
            transition: all 0.3s ease;
        }

        #sidebar {
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .menu-text {
            opacity: 1;
            transition: opacity 0.3s ease, max-width 0.3s ease, padding 0.3s ease;
            white-space: nowrap;
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            max-width: 0;
            padding-left: 0 !important;
            padding-right: 0 !important;
            pointer-events: none;
        }

        .sidebar .nav-link {
            padding-right: 100px;
            transition: padding 0.3s ease;
        }

        /* Optional: control overall width */
        .sidebar.collapsed {
            width: 70px !important;
        }
    </style>

</head>
<body>
<div class="container-fluid-0 overflow-x-hidden">
    <div class="row">
        <?php include "header.php"; ?>
    </div>
    <div class="row bg-light">
        <div class="col-lg-2 col-md-4" id="sidebarContainer">
            <?php include "sidebar.php"; ?>
        </div>
        <div class="col-lg-10 col-md-8">
            <div class="row ">
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
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#toggleSidebar').click(function () {
        const sidebarContainer = $('#sidebarContainer');
        const sidebar = $('#sidebar');
        const isCollapsed = sidebar.hasClass('collapsed');

        // Toggle sidebar classes
        sidebarContainer.toggleClass('col-lg-2 col-md-4 col-lg-1 col-md-1');
        sidebar.toggleClass('collapsed');

        // Delay to match transition and avoid janky behavior
        setTimeout(() => {
            if (!isCollapsed) {
                // Sidebar is collapsing — enable tooltips
                $('[data-bs-toggle="tooltip"]').tooltip('enable');
            } else {
                // Sidebar is expanding — disable tooltips
                $('[data-bs-toggle="tooltip"]').tooltip('disable');
            }
        }, 300); // Match with your CSS transition time
    });
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
        if (!$('#sidebar').hasClass('collapsed')) {
            $('[data-bs-toggle="tooltip"]').tooltip('disable');
        }
    });

    const toggleSidebar = document.getElementById("toggleSidebar");

    toggleSidebar.addEventListener("click", function (e) {
        if (window.innerWidth >= 576) {
            e.preventDefault(); // Prevent toggling
        }
    });
    // $(function () {
    //     $('[data-bs-toggle="tooltip"]').tooltip();
    // });
</script>
</body>
</html>