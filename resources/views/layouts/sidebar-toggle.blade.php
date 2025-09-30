<button class="toggle-sidebar-btn" id="toggleSidebarBtn">☰</button>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const toggleBtn = document.getElementById('toggleSidebarBtn');

        toggleBtn.addEventListener('click', function () {
            if (window.innerWidth >= 1024) {
                // Do not toggle sidebar on desktop
                return;
            }
            if (sidebar.classList.contains('closed')) {
                sidebar.classList.remove('closed');
                sidebar.classList.add('open');
                mainContent.classList.remove('expanded');
            } else {
                sidebar.classList.remove('open');
                sidebar.classList.add('closed');
                mainContent.classList.add('expanded');
            }
        });
    });
</script>
