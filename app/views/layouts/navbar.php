<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left fs-4 me-3" id="menu-toggle" style="cursor:pointer"></i>
    </div>

    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>
                Hi, <?= $_SESSION['name']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="/uas_risk_project/logout">
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>