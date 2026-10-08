<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-1"><i class="fa-solid fa-shapes me-2" style="color: var(--primary);"></i>Categories</h3>
        <p class="text-muted small mb-0">Manage catalog categories cleanly. URLs are automatically generated from category names.</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="fa-solid fa-plus me-1"></i> Add Category
    </button>
</div>

<div class="custom-card p-0 overflow-hidden">
    <!-- Modern Toolbar -->
    <div class="table-toolbar">
        <form action="<?= base_url('category') ?>" method="GET" class="d-flex align-items-center gap-2" style="max-width: 360px; width: 100%;">
            <div class="search-input-wrapper flex-grow-1">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" name="search" class="form-control form-control-sm search-input-custom" placeholder="Search categories..." value="<?= isset($search) ? html_escape($search) : '' ?>">
            </div>
            <?php if (!empty($search)): ?>
                <a href="<?= base_url('category') ?>" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 8px;" title="Clear search">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            <?php endif; ?>
        </form>

        <div class="badge-count-pill">
            <i class="fa-solid fa-shapes text-primary"></i>
            <span>Total: <strong><?= isset($total_rows) ? $total_rows : count($categories) ?></strong> categories</span>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Category Name</th>
                    <th>Subcategories</th>
                    <th style="width: 130px;">Status</th>
                    <th style="width: 140px;">Created At</th>
                    <th class="text-end" style="width: 110px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $key => $cat): ?>
                        <tr>
                            <td>
                                <span class="table-index-pill"><?= (isset($current_page) ? ($current_page - 1) * $per_page : 0) + $key + 1 ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-3" style="width: 34px; height: 34px; background: var(--primary-light); color: var(--primary);">
                                        <i class="fa-solid fa-folder fs-6"></i>
                                    </span>
                                    <span class="fw-bold text-dark fs-6"><?= html_escape($cat->name) ?></span>
                                </div>
                            </td>
                            <td>
                                <a href="<?= base_url('sub_category?category_id=' . $cat->id) ?>" class="text-decoration-none badge rounded-pill" style="background: #f8fafc; color: #475569; font-weight: 600; padding: 6px 14px; border: 1px solid #e2e8f0; transition: all 0.2s ease;">
                                    <i class="fa-solid fa-sitemap me-1 text-primary"></i> <?= isset($cat->subcategory_count) ? $cat->subcategory_count : 0 ?> Subcategories
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('category/status/' . $cat->id) ?>" class="badge-status <?= ((int)$cat->status === 1) ? 'active' : 'inactive' ?>" title="Click to toggle status">
                                    <span class="status-dot"></span>
                                    <span><?= ((int)$cat->status === 1) ? 'Active' : 'Inactive' ?></span>
                                </a>
                            </td>
                            <td class="text-muted small">
                                <?= date('M d, Y', strtotime($cat->created_at)) ?>
                            </td>
                            <td class="text-end">
                                <div class="action-btn-group">
                                    <button type="button" 
                                            class="btn-action btn-action-edit editCategoryBtn" 
                                            data-id="<?= $cat->id ?>" 
                                            data-name="<?= html_escape($cat->name) ?>" 
                                            data-status="<?= $cat->status ?>"
                                            title="Edit Category">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" 
                                            class="btn-action btn-action-delete" 
                                            onclick="confirmDelete('<?= base_url('category/delete/' . $cat->id) ?>', 'Category &quot;<?= addslashes(html_escape($cat->name)) ?>&quot;')"
                                            title="Delete Category">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-shapes d-block fs-2 mb-2 opacity-50"></i>
                            No categories found.
                            <div class="mt-2">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                    <i class="fa-solid fa-plus me-1"></i> Create First Category
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    <?php if (isset($total_pages) && $total_pages > 1): ?>
    <div class="p-3 border-top bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="text-muted small">
            Showing <strong><?= ($total_rows > 0) ? (($current_page - 1) * $per_page + 1) : 0 ?></strong> to 
            <strong><?= min($current_page * $per_page, $total_rows) ?></strong> of 
            <strong><?= $total_rows ?></strong> categories
        </div>

        <nav aria-label="Category pagination">
            <ul class="pagination pagination-sm mb-0 align-items-center">
                <!-- Previous Button -->
                <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($current_page > 1) ? base_url('category?' . http_build_query(array_merge($_GET, ['page' => $current_page - 1]))) : '#' ?>" aria-label="Previous">
                        <i class="fa-solid fa-chevron-left small"></i>
                    </a>
                </li>

                <!-- Page numbers according to user specifications -->
                <?php
                $pages = [];
                if ($total_pages <= 5) {
                    $pages = range(1, $total_pages);
                } elseif ($current_page <= 3) {
                    $pages = [1, 2, 3, '...', $total_pages];
                } elseif ($current_page >= $total_pages - 2) {
                    $pages = [1, '...', $total_pages - 2, $total_pages - 1, $total_pages];
                } else {
                    $pages = [1, '...', $current_page - 1, $current_page, $current_page + 1, '...', $total_pages];
                }

                foreach ($pages as $p):
                    if ($p === '...'):
                ?>
                    <li class="page-item disabled"><span class="page-link border-0 text-muted px-2">...</span></li>
                <?php else: ?>
                    <li class="page-item <?= ($p == $current_page) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= base_url('category?' . http_build_query(array_merge($_GET, ['page' => $p]))) ?>"><?= $p ?></a>
                    </li>
                <?php endif; endforeach; ?>

                <!-- Next Button -->
                <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($current_page < $total_pages) ? base_url('category?' . http_build_query(array_merge($_GET, ['page' => $current_page + 1]))) : '#' ?>" aria-label="Next">
                        <i class="fa-solid fa-chevron-right small"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <?php elseif (isset($total_rows) && $total_rows > 0): ?>
    <div class="p-3 border-top bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="text-muted small">
            Showing <strong>1</strong> to <strong><?= $total_rows ?></strong> of <strong><?= $total_rows ?></strong> categories
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- ================= ADD CATEGORY MODAL ================= -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--primary-gradient); padding: 1.25rem 1.5rem;">
                <h5 class="modal-title fw-bold" id="addCategoryModalLabel">
                    <i class="fa-solid fa-folder-plus me-2"></i>Add New Category
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('category/save') ?>" method="POST" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="addCategoryName" class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="addCategoryName" name="name" placeholder="e.g. Electronics, Fashion, Home Decor" required autofocus>
                    </div>

                    <div class="mb-2">
                        <label for="addCategoryStatus" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="addCategoryStatus" name="status" required>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-check me-1"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= EDIT CATEGORY MODAL ================= -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--primary-gradient); padding: 1.25rem 1.5rem;">
                <h5 class="modal-title fw-bold" id="editCategoryModalLabel">
                    <i class="fa-solid fa-pen-to-square me-2"></i>Edit Category
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('category/save') ?>" method="POST" autocomplete="off">
                <input type="hidden" name="category_id" id="editCategoryId">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editCategoryName" name="name" required>
                    </div>

                    <div class="mb-2">
                        <label for="editCategoryStatus" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="editCategoryStatus" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-check me-1"></i> Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Edit Button Click to Populate Edit Modal
        const editButtons = document.querySelectorAll('.editCategoryBtn');
        const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        const editIdInput = document.getElementById('editCategoryId');
        const editNameInput = document.getElementById('editCategoryName');
        const editStatusInput = document.getElementById('editCategoryStatus');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                editIdInput.value = this.dataset.id;
                editNameInput.value = this.dataset.name;
                editStatusInput.value = this.dataset.status;
                editModal.show();
            });
        });

        // Check if URL has ?action=add to auto-open Add Modal
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'add') {
            const addModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
            addModal.show();
        }
    });
</script>
