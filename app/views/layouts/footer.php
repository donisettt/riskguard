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
</script>
</body>

</html>