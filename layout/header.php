<div class="border-bottom d-flex justify-content-between w-100 h-100 p-4">
    <div class="d-flex my-auto ms-2">
        <button class="btn btn-light border-dark d-none d-md-block" type="button"  id="toggleSidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <button class="btn btn-light border-dark d-sm-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" >
            <i class="fa-solid fa-bars"></i>
        </button>
        <a class="navbar-brand ms-2 fw-bold fs-5" href="#">Note_Application</a>
    </div>
    <div class="d-flex">
        <p class="fs-5 my-auto me-3">Hello Peter</p>
        <i class="fa-solid fa-circle-user fs-3 my-auto"></i>
    </div>
    <div class="offcanvas offcanvas-start d-lg-none d-md-none d-block w-50"
         tabindex="-1"
         id="offcanvasExample"
         aria-labelledby="offcanvasExampleLabel"
         data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="navbar navbar-expand-lg navbar-dark bg-white flex-column min-vh-100" id="sidebar">
                <div class="flex-column mt-3 me-auto ms-3">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link d-flex align-items-center gap-2 text-dark ps-2 nav-item-link"
                               href="index.php?page=about"
                               title="About Me"
                               data-bs-toggle="tooltip"
                               data-bs-placement="right">
                                <i class="fa-solid fa-user fs-4"></i>
                                <span class="menu-text">About Me</span>
                            </a>

                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link d-flex align-items-center gap-2 text-dark ps-2 nav-item-link"
                               href="index.php?page=notes"
                               title="Notes"
                               data-bs-toggle="tooltip"
                               data-bs-placement="right">
                                <i class="fa-solid fa-book fs-4"></i>
                                <span class="menu-text">Notes</span>
                            </a>

                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>