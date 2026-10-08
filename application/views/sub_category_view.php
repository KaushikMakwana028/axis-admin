<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-1"><i class="fa-solid fa-sitemap me-2" style="color: var(--primary);"></i>Subcategories</h3>
        <p class="text-muted small mb-0">Manage child categories linked to primary parent categories.</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal">
        <i class="fa-solid fa-plus me-1"></i> Add Subcategory
    </button>
</div>

<div class="custom-card p-0 overflow-hidden">
    <!-- Modern Toolbar -->
    <div class="table-toolbar">
        <form action="<?= base_url('sub_category') ?>" method="GET" class="d-flex align-items-center gap-2 flex-wrap" style="max-width: 650px; width: 100%;">
            <!-- Category Filter Dropdown -->
            <select name="category_id" class="form-select form-select-sm filter-select-custom" style="max-width: 200px;" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c->id ?>" <?= (isset($selected_category) && $selected_category == $c->id) ? 'selected' : '' ?>>
                            <?= html_escape($c->name) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- Search input -->
            <div class="search-input-wrapper flex-grow-1" style="min-width: 220px; max-width: 320px;">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" name="search" class="form-control form-control-sm search-input-custom" placeholder="Search subcategories..." value="<?= isset($search) ? html_escape($search) : '' ?>">
            </div>
            <?php if (!empty($search) || !empty($selected_category)): ?>
                <a href="<?= base_url('sub_category') ?>" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 8px;" title="Clear filters">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            <?php endif; ?>
        </form>

        <div class="badge-count-pill">
            <i class="fa-solid fa-sitemap text-primary"></i>
            <span>Total: <strong><?= isset($total_rows) ? $total_rows : count($subcategories) ?></strong> subcategories</span>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Subcategory Name</th>
                    <th>Parent Category</th>
                    <th style="width: 130px;">Status</th>
                    <th style="width: 140px;">Created At</th>
                    <th class="text-end" style="width: 110px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($subcategories)): ?>
                    <?php foreach ($subcategories as $key => $sub): ?>
                        <tr>
                            <td>
                                <span class="table-index-pill"><?= (isset($current_page) ? ($current_page - 1) * $per_page : 0) + $key + 1 ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-3" style="width: 34px; height: 34px; background: #fff5eb; color: var(--primary);">
                                        <i class="fa-solid fa-sitemap fs-6"></i>
                                    </span>
                                    <span class="fw-bold text-dark fs-6"><?= html_escape($sub->name) ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #f8fafc; color: #334155; border: 1px solid #e2e8f0; font-weight: 600; padding: 6px 14px; border-radius: 8px;">
                                    <i class="fa-solid fa-folder me-1 text-warning"></i> <?= html_escape($sub->category_name) ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('sub_category/status/' . $sub->id) ?>" class="badge-status <?= ((int)$sub->status === 1) ? 'active' : 'inactive' ?>" title="Click to toggle status">
                                    <span class="status-dot"></span>
                                    <span><?= ((int)$sub->status === 1) ? 'Active' : 'Inactive' ?></span>
                                </a>
                            </td>
                            <td class="text-muted small">
                                <?= date('M d, Y', strtotime($sub->created_at)) ?>
                            </td>
                            <td class="text-end">
                                <div class="action-btn-group">
                                    <button type="button" 
                                            class="btn-action btn-action-edit editSubcategoryBtn" 
                                            data-id="<?= $sub->id ?>" 
                                            data-category-id="<?= $sub->category_id ?>"
                                            data-name="<?= html_escape($sub->name) ?>" 
                                            data-status="<?= $sub->status ?>"
                                            title="Edit Subcategory">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" 
                                            class="btn-action btn-action-delete" 
                                            onclick="confirmDelete('<?= base_url('sub_category/delete/' . $sub->id) ?>', 'Subcategory &quot;<?= addslashes(html_escape($sub->name)) ?>&quot;')"
                                            title="Delete Subcategory">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-sitemap d-block fs-2 mb-2 opacity-50"></i>
                            No subcategories found.
                            <div class="mt-2">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal">
                                    <i class="fa-solid fa-plus me-1"></i> Create First Subcategory
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
            <strong><?= $total_rows ?></strong> subcategories
        </div>

        <nav aria-label="Subcategory pagination">
            <ul class="pagination pagination-sm mb-0 align-items-center">
                <!-- Previous Button -->
                <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($current_page > 1) ? base_url('sub_category?' . http_build_query(array_merge($_GET, ['page' => $current_page - 1]))) : '#' ?>" aria-label="Previous">
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
                        <a class="page-link" href="<?= base_url('sub_category?' . http_build_query(array_merge($_GET, ['page' => $p]))) ?>"><?= $p ?></a>
                    </li>
                <?php endif; endforeach; ?>

                <!-- Next Button -->
                <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($current_page < $total_pages) ? base_url('sub_category?' . http_build_query(array_merge($_GET, ['page' => $current_page + 1]))) : '#' ?>" aria-label="Next">
                        <i class="fa-solid fa-chevron-right small"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <?php elseif (isset($total_rows) && $total_rows > 0): ?>
    <div class="p-3 border-top bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="text-muted small">
            Showing <strong>1</strong> to <strong><?= $total_rows ?></strong> of <strong><?= $total_rows ?></strong> subcategories
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- ================= ADD SUBCATEGORY MODAL ================= -->
<div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--primary-gradient); padding: 1.25rem 1.5rem;">
                <h5 class="modal-title fw-bold" id="addSubcategoryModalLabel">
                    <i class="fa-solid fa-folder-plus me-2"></i>Add New Subcategory
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('sub_category/save') ?>" method="POST" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="addParentCategory" class="form-label fw-bold">Parent Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="addParentCategory" name="category_id" required>
                            <option value="">-- Select Parent Category --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat->id ?>"><?= html_escape($cat->name) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="addSubcategoryName" class="form-label fw-bold">Subcategory Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="addSubcategoryName" name="name" placeholder="e.g. Smart Phones, Laptops, T-Shirts" required>
                    </div>

                    <div class="mb-2">
                        <label for="addSubcategoryStatus" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="addSubcategoryStatus" name="status" required>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-check me-1"></i> Save Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= EDIT SUBCATEGORY MODAL ================= -->
<div class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--primary-gradient); padding: 1.25rem 1.5rem;">
                <h5 class="modal-title fw-bold" id="editSubcategoryModalLabel">
                    <i class="fa-solid fa-pen-to-square me-2"></i>Edit Subcategory
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('sub_category/save') ?>" method="POST" autocomplete="off">
                <input type="hidden" name="subcategory_id" id="editSubcategoryId">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="editParentCategory" class="form-label fw-bold">Parent Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="editParentCategory" name="category_id" required>
                            <option value="">-- Select Parent Category --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat->id ?>"><?= html_escape($cat->name) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editSubcategoryName" class="form-label fw-bold">Subcategory Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editSubcategoryName" name="name" required>
                    </div>

                    <div class="mb-2">
                        <label for="editSubcategoryStatus" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="editSubcategoryStatus" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-check me-1"></i> Update Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.editSubcategoryBtn');
        const editModal = new bootstrap.Modal(document.getElementById('editSubcategoryModal'));
        const editIdInput = document.getElementById('editSubcategoryId');
        const editCatInput = document.getElementById('editParentCategory');
        const editNameInput = document.getElementById('editSubcategoryName');
        const editStatusInput = document.getElementById('editSubcategoryStatus');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                editIdInput.value = this.dataset.id;
                editCatInput.value = this.dataset.categoryId;
                editNameInput.value = this.dataset.name;
                editStatusInput.value = this.dataset.status;
                editModal.show();
            });
        });

        // Check if URL has ?action=add to auto-open Add Modal
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'add') {
            const addModal = new bootstrap.Modal(document.getElementById('addSubcategoryModal'));
            addModal.show();
        }
    });
</script>
