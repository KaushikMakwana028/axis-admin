        </main>

        <footer class="text-center py-3 text-muted border-top bg-white" style="font-size: 0.82rem;">
            &copy; <?= date('Y') ?> <strong>AXIS Admin Control Center</strong>. High Performance Indexed Architecture.
        </footer>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Sidebar toggle for mobile devices
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // Global SweetAlert Delete Confirmation
    function confirmDelete(url, itemName = 'this item') {
        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete ${itemName}? This cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff6b35',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Yes, delete it',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
        return false;
    }

    <?php if ($this->session->flashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '<?= addslashes($this->session->flashdata('success')) ?>',
        confirmButtonColor: '#ff6b35',
        timer: 3000,
        timerProgressBar: true
    });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Notice',
        html: '<?= addslashes($this->session->flashdata('error')) ?>',
        confirmButtonColor: '#ff6b35'
    });
    <?php endif; ?>
</script>
</body>
</html>
