<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4" style="min-height: 70px;">
    <div class="d-flex align-items-center">
        <button class="btn btn-link text-decoration-none p-0 me-3" id="menu-toggle" style="cursor: pointer;">
            <i class="fas fa-bars fs-4" style="color: #009d63; transition: all 0.3s;"></i>
        </button>
    </div>

    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold"
                role="button"
                data-bs-toggle="dropdown"
                style="color: #2d3436; gap: 8px;">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-light"
                    style="width: 38px; height: 38px; border: 2px solid #009d63;">
                    <i class="fas fa-user" style="color: #009d63;"></i>
                </div>
                <span class="d-none d-md-inline">Hi, <?= $_SESSION['name']; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width: 200px; border-radius: 10px;">
                <li>
                    <a class="dropdown-item py-2" href="#" style="border-radius: 8px;">
                        <i class="fas fa-user-circle me-2" style="color: #009d63;"></i>
                        Profil Saya
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider my-2">
                </li>
                <li>
                    <a class="dropdown-item text-danger py-2" href="/sigma/logout" style="border-radius: 8px;">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<style>
    #menu-toggle:hover i {
        transform: scale(1.1);
        color: #007a4d !important;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .dropdown-menu {
        margin-top: 0.5rem;
    }
</style>