<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-3" style="min-height: 70px;">
    <div class="d-flex align-items-center">
        <button class="btn btn-link text-decoration-none p-0 me-3" id="menu-toggle" style="cursor: pointer;">
            <i class="fas fa-bars fs-4" style="color: #009d63; transition: all 0.3s;"></i>
        </button>
    </div>

    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                style="color: #2d3436; gap: 8px;">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-light"
                    style="width: 38px; height: 38px; border: 2px solid #009d63;">
                    <i class="fas fa-user" style="color: #009d63;"></i>
                </div>
                <span class="d-none d-md-inline">Hi, <?= $_SESSION['name']; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-profile shadow-sm">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-circle me-2"></i>
                        Profil Saya
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="/sigma/logout">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<style>
    /* Menu Toggle */
    #menu-toggle:hover i {
        transform: scale(1.1);
        color: #007a4d !important;
    }

    /* Dropdown Profile Styling */
    .dropdown-profile {
        min-width: 200px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 0;
        margin-top: 0.5rem !important;
    }

    .dropdown-profile .dropdown-item {
        padding: 0.625rem 1.25rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        border-radius: 0;
    }

    .dropdown-profile .dropdown-item:hover {
        background-color: #f1f5f9;
        padding-left: 1.5rem;
    }

    .dropdown-profile .dropdown-item i {
        width: 18px;
        text-align: center;
        color: #009d63;
    }

    .dropdown-profile .dropdown-item.text-danger i {
        color: #dc2626;
    }

    .dropdown-profile .dropdown-divider {
        margin: 0.5rem 0;
        opacity: 0.1;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .navbar {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .dropdown-profile {
            position: absolute;
            right: 1rem;
            left: auto;
            min-width: 180px;
        }

        .nav-link.dropdown-toggle {
            padding: 0 !important;
        }
    }
</style>