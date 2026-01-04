</div> <!-- End page-content-wrapper -->
</div> <!-- End wrapper -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    // Toggle sidebar
    const menuToggle = document.getElementById('menu-toggle');
    const wrapper = document.getElementById('wrapper');

    if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            wrapper.classList.toggle('toggled');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            const sidebar = document.getElementById('sidebar-wrapper');
            const menuToggle = document.getElementById('menu-toggle');

            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                wrapper.classList.remove('toggled');
            }
        }
    });

    // Auto-expand active menu group and set active state
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const sidebarLinks = document.querySelectorAll('#sidebar-wrapper .list-group-item[href]');

        sidebarLinks.forEach(link => {
            const href = link.getAttribute('href');

            // Check if current path matches this link
            if (currentPath.includes(href) && href !== '/sigma/dashboard') {
                // Add active class to the link
                link.classList.add('active');

                // Find parent collapse menu if exists
                const parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    // Show the parent collapse menu
                    const bsCollapse = new bootstrap.Collapse(parentCollapse, {
                        toggle: false
                    });
                    bsCollapse.show();

                    // Update the chevron icon
                    const collapseToggle = document.querySelector(`[href="#${parentCollapse.id}"]`);
                    if (collapseToggle) {
                        collapseToggle.classList.remove('collapsed');
                    }
                }
            } else if (currentPath === '/sigma/dashboard' && href === '/sigma/dashboard') {
                link.classList.add('active');
            }
        });
    });
</script>
</body>

</html>