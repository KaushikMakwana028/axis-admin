<style>
    .product-thumb {
        width: 54px;
        height: 54px;
        border-radius: 10px;
        object-fit: cover;
        border: 1.5px solid #edf2f7;
        background: #f8fafc;
    }
    .product-thumb-placeholder {
        width: 54px;
        height: 54px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-light);
        color: var(--primary);
        font-size: 1.3rem;
    }
    .image-upload-wrapper {
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
        padding: 1.25rem;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
    }
    .image-upload-wrapper:hover {
        border-color: var(--primary);
        background: #fff8f5;
    }
    .image-preview-box {
        width: 100%;
        max-height: 180px;
        object-fit: contain;
        border-radius: 10px;
        display: none;
    }
    .file-row {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.85rem;
        margin-bottom: 0.75rem;
        transition: var(--transition);
    }
    .file-row:hover {
        border-color: #cbd5e1;
        background: #ffffff;
    }
    .badge-file-type {
        font-family: monospace;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 4px 10px;
        border-radius: 6px;
        border: 1px solid #ffd4c2;
        background: var(--primary-light);
        color: var(--primary-dark);
        display: inline-block;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-1"><i class="fa-solid fa-box-open me-2" style="color: var(--primary);"></i>Products</h3>
        <p class="text-muted small mb-0">Manage digital catalog products, preview images, and multiple downloadable file types (.cdr, .dxf, .ai, .zip, etc.).</p>
    </div>
    <a href="<?= base_url('product/add') ?>" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Add Product
    </a>
</div>

<div class="custom-card p-0 overflow-hidden">
    <!-- Modern Toolbar -->
    <div class="table-toolbar">
        <form action="<?= base_url('product') ?>" method="GET" class="d-flex align-items-center gap-2 flex-wrap" style="max-width: 800px; width: 100%;">
            <!-- Category Filter -->
            <select name="category_id" class="form-select form-select-sm filter-select-custom" style="max-width: 190px;" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c->id ?>" <?= (isset($selected_category) && $selected_category == $c->id) ? 'selected' : '' ?>>
                            <?= html_escape($c->name) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- File Type Filter -->
            <select name="file_type_id" class="form-select form-select-sm filter-select-custom" style="max-width: 180px;" onchange="this.form.submit()">
                <option value="">All File Types</option>
                <?php if (!empty($file_types)): ?>
                    <?php foreach ($file_types as $ft): ?>
                        <option value="<?= $ft->id ?>" <?= (isset($selected_file_type) && $selected_file_type == $ft->id) ? 'selected' : '' ?>>
                            <?= html_escape($ft->extension) ?> (<?= html_escape($ft->name) ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- Search input -->
            <div class="search-input-wrapper flex-grow-1" style="min-width: 220px; max-width: 320px;">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" name="search" class="form-control form-control-sm search-input-custom" placeholder="Search products..." value="<?= isset($search) ? html_escape($search) : '' ?>">
            </div>
            <?php if (!empty($search) || !empty($selected_category) || !empty($selected_file_type)): ?>
                <a href="<?= base_url('product') ?>" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 8px;" title="Clear filters">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            <?php endif; ?>
        </form>

        <div class="badge-count-pill">
            <i class="fa-solid fa-box-open text-primary"></i>
            <span>Total: <strong><?= isset($total_rows) ? $total_rows : count($products) ?></strong> products</span>
        </div>
    </div>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th style="width: 75px;">Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Attached File Types</th>
                    <th style="width: 130px;">Status</th>
                    <th style="width: 130px;">Created At</th>
                    <th class="text-end" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $key => $prod): ?>
                        <tr>
                            <!-- Sequential Index -->
                            <td>
                                <span class="table-index-pill"><?= (isset($current_page) ? ($current_page - 1) * $per_page : 0) + $key + 1 ?></span>
                            </td>

                            <!-- Product Thumbnail Image -->
                            <td>
                                <?php if (!empty($prod->image) && file_exists(FCPATH . $prod->image)): ?>
                                    <img src="<?= base_url($prod->image) ?>" alt="<?= html_escape($prod->name) ?>" class="product-thumb">
                                <?php else: ?>
                                    <div class="product-thumb-placeholder">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <!-- Product Name & Description Preview -->
                            <td>
                                <div class="fw-bold text-dark fs-6"><?= html_escape($prod->name) ?></div>
                                <?php if (!empty($prod->description)): ?>
                                    <div class="text-muted small text-truncate mt-1" style="max-width: 280px; font-size: 0.82rem;">
                                        <?= strip_tags($prod->description) ?>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <!-- Category / Subcategory -->
                            <td>
                                <?php if (!empty($prod->category_name)): ?>
                                    <span class="badge" style="background: #f8fafc; color: #334155; border: 1px solid #e2e8f0; font-weight: 600; padding: 5px 10px; border-radius: 6px;">
                                        <i class="fa-solid fa-folder me-1 text-warning"></i><?= html_escape($prod->category_name) ?>
                                    </span>
                                    <?php if (!empty($prod->subcategory_name)): ?>
                                        <div class="small text-muted mt-1" style="font-size: 0.78rem;">
                                            <i class="fa-solid fa-turn-up fa-rotate-90 text-secondary me-1"></i><?= html_escape($prod->subcategory_name) ?>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted small fst-italic">Uncategorized</span>
                                <?php endif; ?>
                            </td>

                            <!-- Attached File Types Badges -->
                            <td>
                                <?php if (!empty($prod->files)): ?>
                                    <div class="d-flex flex-wrap gap-1 align-items-center">
                                        <?php foreach ($prod->files as $f): ?>
                                            <span class="badge-file-type" title="<?= html_escape($f->file_name) ?>">
                                                <?= html_escape($f->extension) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="small text-muted mt-1" style="font-size: 0.76rem;">
                                        <i class="fa-solid fa-paperclip me-1 text-secondary"></i><?= count($prod->files) ?> format<?= count($prod->files) > 1 ? 's' : '' ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted small fst-italic">No files attached</span>
                                <?php endif; ?>
                            </td>

                            <!-- Status Toggle -->
                            <td>
                                <a href="<?= base_url('product/status/' . $prod->id) ?>" class="badge-status <?= ((int)$prod->status === 1) ? 'active' : 'inactive' ?>" title="Click to toggle status">
                                    <span class="status-dot"></span>
                                    <span><?= ((int)$prod->status === 1) ? 'Active' : 'Inactive' ?></span>
                                </a>
                            </td>

                            <!-- Created Date -->
                            <td class="text-muted small">
                                <?= date('M d, Y', strtotime($prod->created_at)) ?>
                            </td>

                            <!-- Actions -->
                            <td class="text-end">
                                <div class="action-btn-group">
                                    <a href="<?= base_url('product/detail/' . $prod->id) ?>" 
                                       class="btn-action btn-action-view" 
                                       title="View Product Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('product/edit/' . $prod->id) ?>" 
                                       class="btn-action btn-action-edit" 
                                       title="Edit Product">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn-action btn-action-delete" 
                                            onclick="confirmDelete('<?= base_url('product/delete/' . $prod->id) ?>', 'Product &quot;<?= addslashes(html_escape($prod->name)) ?>&quot;')"
                                            title="Delete Product">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-box-open d-block fs-2 mb-2 opacity-50"></i>
                            No products found.
                            <div class="mt-2">
                                <a href="<?= base_url('product/add') ?>" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-plus me-1"></i> Create First Product
                                </a>
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
            <strong><?= $total_rows ?></strong> products
        </div>

        <nav aria-label="Product pagination">
            <ul class="pagination pagination-sm mb-0 align-items-center">
                <!-- Previous Button -->
                <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($current_page > 1) ? base_url('product?' . http_build_query(array_merge($_GET, ['page' => $current_page - 1]))) : '#' ?>" aria-label="Previous">
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
                        <a class="page-link" href="<?= base_url('product?' . http_build_query(array_merge($_GET, ['page' => $p]))) ?>"><?= $p ?></a>
                    </li>
                <?php endif; endforeach; ?>

                <!-- Next Button -->
                <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($current_page < $total_pages) ? base_url('product?' . http_build_query(array_merge($_GET, ['page' => $current_page + 1]))) : '#' ?>" aria-label="Next">
                        <i class="fa-solid fa-chevron-right small"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <?php elseif (isset($total_rows) && $total_rows > 0): ?>
    <div class="p-3 border-top bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="text-muted small">
            Showing <strong>1</strong> to <strong><?= $total_rows ?></strong> of <strong><?= $total_rows ?></strong> products
        </div>
    </div>
    <?php endif; ?>
</div>


