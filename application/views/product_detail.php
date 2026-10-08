<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ==========================================================
       Product Detail — page scoped (.pd-page), Poppins only
       Colors come from the existing theme variables
       (--primary, --primary-light, --primary-dark) with fallbacks.
       ========================================================== */
    .pd-page {
        --pd-primary: var(--primary, #ff6b35);
        --pd-primary-light: var(--primary-light, #fff1ea);
        --pd-primary-dark: var(--primary-dark, #e8501a);
        --pd-ink: #0f172a;
        --pd-text: #334155;
        --pd-muted: #64748b;
        --pd-faint: #94a3b8;
        --pd-line: #e2e8f0;
        --pd-line-soft: #f1f5f9;
        --pd-soft: #f8fafc;
        --pd-peach-line: #ffd4c2;
        --pd-radius: 18px;
        --pd-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 8px 24px -8px rgba(15, 23, 42, .08);

        font-family: 'Poppins', sans-serif;
        color: var(--pd-text);
        -webkit-font-smoothing: antialiased;
    }

    .pd-page *,
    .pd-page *::before,
    .pd-page *::after {
        box-sizing: border-box;
    }

    .pd-page h1,
    .pd-page h2,
    .pd-page h3,
    .pd-page h4,
    .pd-page h5,
    .pd-page h6,
    .pd-page p,
    .pd-page span,
    .pd-page a,
    .pd-page button,
    .pd-page label,
    .pd-page small,
    .pd-page div {
        font-family: 'Poppins', sans-serif;
    }

    /* ---------- Page header ---------- */
    .pd-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .pd-header-main {
        min-width: 0;
        flex: 1 1 360px;
    }

    .pd-back {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .35rem .85rem;
        margin-bottom: .75rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--pd-muted);
        background: #fff;
        border: 1px solid var(--pd-line);
        border-radius: 999px;
        text-decoration: none;
        transition: all .2s ease;
    }

    .pd-back:hover {
        color: var(--pd-primary-dark);
        border-color: var(--pd-peach-line);
        background: var(--pd-primary-light);
    }

    .pd-title {
        margin: 0 0 .35rem;
        font-size: clamp(1.25rem, 1rem + 1.4vw, 1.9rem);
        font-weight: 700;
        line-height: 1.3;
        color: var(--pd-ink);
        letter-spacing: -.01em;
        overflow-wrap: anywhere;
    }

    .pd-subtitle {
        margin: 0;
        font-size: .88rem;
        line-height: 1.6;
        color: var(--pd-muted);
    }

    .pd-header-actions {
        display: flex;
        align-items: center;
        gap: .6rem;
        flex-wrap: wrap;
    }

    /* ---------- Buttons ---------- */
    .pd-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: .65rem 1.2rem;
        font-size: .88rem;
        font-weight: 600;
        line-height: 1.2;
        border: 1px solid transparent;
        border-radius: 12px;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
        transition: transform .15s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease, color .2s ease;
    }

    .pd-btn:active {
        transform: translateY(1px);
    }

    .pd-btn-primary {
        color: #fff;
        background: linear-gradient(135deg, var(--pd-primary), var(--pd-primary-dark));
        box-shadow: 0 6px 16px -6px var(--pd-primary);
    }

    .pd-btn-primary:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px -8px var(--pd-primary);
    }

    .pd-btn-danger-outline {
        color: #dc2626;
        background: #fff;
        border-color: #fecaca;
    }

    .pd-btn-danger-outline:hover {
        color: #fff;
        background: #dc2626;
        border-color: #dc2626;
    }

    .pd-btn-light {
        color: var(--pd-text);
        background: var(--pd-soft);
        border-color: var(--pd-line);
    }

    .pd-btn-light:hover {
        color: var(--pd-ink);
        background: #fff;
        border-color: #cbd5e1;
    }

    .pd-btn-block {
        width: 100%;
    }

    /* ---------- Cards ---------- */
    .pd-page .pd-card {
        background: #fff;
        border: 1px solid var(--pd-line);
        border-radius: var(--pd-radius);
        box-shadow: var(--pd-shadow);
        padding: clamp(1rem, .6rem + 1.6vw, 1.75rem);
        margin-bottom: 1.5rem;
    }

    .pd-card-title {
        display: flex;
        align-items: center;
        gap: .65rem;
        margin: 0;
        font-size: 1.02rem;
        font-weight: 700;
        color: var(--pd-ink);
    }

    .pd-card-title .pd-ico {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        font-size: .88rem;
        color: var(--pd-primary-dark);
        background: var(--pd-primary-light);
        border-radius: 10px;
    }

    .pd-card-sub {
        margin: .35rem 0 0;
        font-size: .82rem;
        line-height: 1.6;
        color: var(--pd-muted);
    }

    /* ---------- Hero image ---------- */
    .pd-hero {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: clamp(.75rem, 2vw, 1.5rem);
        margin-bottom: 1.25rem;
        background:
            radial-gradient(circle at 20% 15%, var(--pd-primary-light), transparent 55%),
            var(--pd-soft);
        border: 1px solid var(--pd-line);
        border-radius: 16px;
    }

    .pd-hero-img {
        display: block;
        width: auto;
        max-width: 100%;
        max-height: 440px;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 12px 30px -12px rgba(15, 23, 42, .25);
    }

    .pd-hero-empty {
        width: 100%;
        min-height: 260px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        padding: 1.5rem;
        text-align: center;
        color: var(--pd-faint);
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
    }

    .pd-hero-empty i {
        font-size: 2.4rem;
        margin-bottom: .4rem;
    }

    .pd-hero-empty strong {
        font-size: .95rem;
        font-weight: 600;
        color: var(--pd-muted);
    }

    .pd-hero-empty small {
        font-size: .78rem;
        color: var(--pd-faint);
    }

    /* ---------- Badges ---------- */
    .pd-badges {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .5rem;
        margin-bottom: 1.25rem;
    }

    .pd-chip {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .4rem .85rem;
        font-size: .78rem;
        font-weight: 600;
        line-height: 1.2;
        color: var(--pd-text);
        background: var(--pd-soft);
        border: 1px solid var(--pd-line);
        border-radius: 999px;
        max-width: 100%;
    }

    .pd-chip-accent {
        color: var(--pd-primary-dark);
        background: var(--pd-primary-light);
        border-color: var(--pd-peach-line);
    }

    .pd-page .badge-status {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .4rem .85rem;
        font-size: .78rem;
        font-weight: 600;
        line-height: 1.2;
        border-radius: 999px;
        border: 1px solid transparent;
        text-decoration: none;
        transition: filter .2s ease;
    }

    .pd-page .badge-status:hover {
        filter: brightness(.96);
    }

    .pd-page .badge-status .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .7);
    }

    .pd-page .badge-status.active {
        color: #059669;
        background: #ecfdf5;
        border-color: #a7f3d0;
    }

    .pd-page .badge-status.inactive {
        color: #dc2626;
        background: #fef2f2;
        border-color: #fecaca;
    }

    /* ---------- Description ---------- */
    .pd-desc {
        padding-top: 1.25rem;
        border-top: 1px solid var(--pd-line-soft);
    }

    .pd-section-label {
        margin: 0 0 .6rem;
        font-size: .95rem;
        font-weight: 700;
        color: var(--pd-ink);
    }

    .pd-desc-text {
        font-size: .92rem;
        line-height: 1.8;
        color: var(--pd-text);
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .pd-desc-empty {
        margin: 0;
        font-size: .86rem;
        font-style: italic;
        color: var(--pd-faint);
    }

    /* ---------- Files section ---------- */
    .pd-files-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .75rem 1rem;
        margin-bottom: 1.25rem;
    }

    .pd-files-head>div:first-child {
        min-width: 0;
        flex: 1 1 260px;
    }

    .pd-page .badge-count-pill {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .45rem .95rem;
        font-size: .8rem;
        font-weight: 500;
        color: var(--pd-text);
        background: var(--pd-soft);
        border: 1px solid var(--pd-line);
        border-radius: 999px;
        white-space: nowrap;
    }

    .pd-page .badge-count-pill i {
        color: var(--pd-primary);
    }

    .pd-page .badge-count-pill strong {
        font-weight: 700;
        color: var(--pd-ink);
    }

    .pd-files-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: .85rem;
    }

    .pd-file {
        display: grid;
        grid-template-columns: auto minmax(0, 1fr) auto;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.15rem;
        background: #fff;
        border: 1px solid var(--pd-line);
        border-radius: 14px;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .pd-file:hover {
        border-color: var(--pd-peach-line);
        box-shadow: 0 10px 24px -12px rgba(15, 23, 42, .18);
        transform: translateY(-1px);
    }

    .pd-ext {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 68px;
        padding: .6rem .8rem;
        font-size: .88rem;
        font-weight: 700;
        letter-spacing: .02em;
        color: var(--pd-primary-dark);
        background: var(--pd-primary-light);
        border: 1px solid var(--pd-peach-line);
        border-radius: 12px;
    }

    .pd-file-info {
        min-width: 0;
    }

    .pd-file-name {
        margin: 0 0 .35rem;
        font-size: .9rem;
        font-weight: 600;
        line-height: 1.45;
        color: var(--pd-ink);
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .pd-file-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .4rem .5rem;
        font-size: .76rem;
        color: var(--pd-muted);
    }

    .pd-file-meta .pd-dot {
        width: 3px;
        height: 3px;
        border-radius: 50%;
        background: #cbd5e1;
    }

    .pd-size {
        font-weight: 600;
        color: var(--pd-text);
    }

    .pd-mime {
        padding: .1rem .5rem;
        font-size: .72rem;
        font-weight: 500;
        color: var(--pd-muted);
        background: var(--pd-line-soft);
        border-radius: 6px;
        overflow-wrap: anywhere;
    }

    .pd-file .pd-btn {
        padding: .6rem 1.1rem;
        font-size: .84rem;
    }

    .pd-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: var(--pd-muted);
        background: var(--pd-soft);
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
    }

    .pd-empty i.pd-empty-ico {
        display: block;
        margin-bottom: .75rem;
        font-size: 2.4rem;
        opacity: .5;
    }

    .pd-empty p {
        margin: 0 0 1rem;
        font-size: .9rem;
        font-weight: 600;
    }

    /* ---------- Sidebar ---------- */
    .pd-actions {
        display: grid;
        gap: .6rem;
        margin-top: 1.1rem;
    }

    .pd-meta-head {
        margin-bottom: .5rem;
    }

    .pd-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: .8rem 0;
        font-size: .86rem;
        border-bottom: 1px solid var(--pd-line-soft);
    }

    .pd-meta-row:last-of-type {
        border-bottom: none;
    }

    .pd-meta-label {
        flex: 0 0 auto;
        font-weight: 500;
        color: var(--pd-muted);
    }

    .pd-meta-value {
        min-width: 0;
        font-weight: 600;
        text-align: right;
        color: var(--pd-ink);
        overflow-wrap: anywhere;
    }

    .pd-meta-value .pd-none {
        font-weight: 500;
        font-style: italic;
        color: var(--pd-faint);
    }

    .pd-meta-value.pd-small {
        font-size: .8rem;
    }

    .pd-slug-wrap {
        margin-top: .5rem;
        padding-top: 1rem;
        border-top: 1px solid var(--pd-line-soft);
    }

    .pd-slug-label {
        display: block;
        margin-bottom: .5rem;
        font-size: .75rem;
        font-weight: 600;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: var(--pd-muted);
    }

    .pd-slug {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .6rem;
        padding: .7rem .8rem;
        font-size: .8rem;
        font-weight: 500;
        line-height: 1.5;
        color: var(--pd-text);
        background: var(--pd-soft);
        border: 1px solid var(--pd-line);
        border-radius: 10px;
    }

    .pd-slug span {
        min-width: 0;
        overflow-wrap: anywhere;
        word-break: break-all;
    }

    .pd-copy {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        padding: 0;
        color: var(--pd-muted);
        background: #fff;
        border: 1px solid var(--pd-line);
        border-radius: 8px;
        cursor: pointer;
        transition: all .2s ease;
    }

    .pd-copy:hover {
        color: var(--pd-primary-dark);
        background: var(--pd-primary-light);
        border-color: var(--pd-peach-line);
    }

    .pd-storage {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--pd-primary-light), #fff 70%);
        border: 1px solid var(--pd-peach-line);
        border-radius: var(--pd-radius);
        padding: 1.25rem 1.4rem;
        margin-bottom: 1.5rem;
    }

    .pd-storage-title {
        display: flex;
        align-items: center;
        gap: .55rem;
        margin: 0 0 .4rem;
        font-size: .95rem;
        font-weight: 700;
        color: var(--pd-ink);
    }

    .pd-storage-title i {
        color: var(--pd-primary-dark);
    }

    .pd-storage-note {
        margin: 0 0 .5rem;
        font-size: .8rem;
        line-height: 1.6;
        color: var(--pd-muted);
    }

    .pd-storage-size {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 1.2;
        color: var(--pd-ink);
        font-variant-numeric: tabular-nums;
    }

    /* ---------- Tablet & mobile ---------- */
    @media (max-width: 767.98px) {
        .pd-header {
            align-items: stretch;
            margin-bottom: 1.1rem;
        }

        .pd-header-actions {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .pd-header-actions .pd-btn {
            width: 100%;
        }

        .pd-hero-img {
            max-height: 300px;
        }

        .pd-hero-empty {
            min-height: 200px;
        }

        .pd-file {
            grid-template-columns: auto minmax(0, 1fr);
            align-items: start;
            gap: .85rem;
            padding: .95rem;
        }

        .pd-file .pd-btn {
            grid-column: 1 / -1;
            width: 100%;
        }

        .pd-ext {
            min-width: 58px;
            padding: .5rem .6rem;
            font-size: .8rem;
        }

        .pd-file-name {
            font-size: .84rem;
        }

        .pd-files-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .pd-page .pd-card {
            margin-bottom: 1.1rem;
        }

        .pd-storage {
            margin-bottom: 1.1rem;
        }
    }

    @media (max-width: 380px) {
        .pd-header-actions {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 1200px) {
        .pd-files-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="pd-page">

    <!-- Page Header & Navigation -->
    <div class="pd-header">
        <div class="pd-header-main">
            <a href="<?= base_url('product') ?>" class="pd-back">
                <i class="fa-solid fa-arrow-left"></i> Back to Products
            </a>
            <h3 class="pd-title"><?= html_escape($product->name) ?></h3>
            <p class="pd-subtitle">View full product specifications, catalog preview, and digital download files.</p>
        </div>
        <div class="pd-header-actions">
            <a href="<?= base_url('product/edit/' . $product->id) ?>" class="pd-btn pd-btn-primary">
                <i class="fa-solid fa-pen-to-square"></i> Edit Product
            </a>
            <button type="button"
                class="pd-btn pd-btn-danger-outline"
                onclick="confirmDelete('<?= base_url('product/delete/' . $product->id) ?>', 'Product &quot;<?= addslashes(html_escape($product->name)) ?>&quot;')">
                <i class="fa-solid fa-trash"></i> Delete
            </button>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Column: Visual Showcase, Description & Downloadable Files -->
        <div class="col-12 col-lg-8">

            <!-- 1. Visual Showcase & Description Card -->
            <div class="custom-card pd-card">
                <!-- Product Preview Image -->
                <?php if (!empty($product->image) && file_exists(FCPATH . $product->image)): ?>
                    <div class="pd-hero">
                        <img src="<?= base_url($product->image) ?>" alt="<?= html_escape($product->name) ?>" class="pd-hero-img">
                    </div>
                <?php else: ?>
                    <div class="pd-hero">
                        <div class="pd-hero-empty">
                            <i class="fa-regular fa-image"></i>
                            <strong>No preview image uploaded</strong>
                            <small>You can upload a preview image by editing this product.</small>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Header Badges -->
                <div class="pd-badges">
                    <!-- Status Badge -->
                    <a href="<?= base_url('product/status/' . $product->id) ?>" class="badge-status <?= ((int)$product->status === 1) ? 'active' : 'inactive' ?>" title="Click to toggle status">
                        <span class="status-dot"></span>
                        <span><?= ((int)$product->status === 1) ? 'Active' : 'Inactive' ?></span>
                    </a>

                    <!-- Category Badge -->
                    <?php if (!empty($product->category_name)): ?>
                        <span class="pd-chip">
                            <i class="fa-solid fa-folder text-warning"></i> <?= html_escape($product->category_name) ?>
                        </span>
                    <?php endif; ?>

                    <!-- Subcategory Badge -->
                    <?php if (!empty($product->subcategory_name)): ?>
                        <span class="pd-chip">
                            <i class="fa-solid fa-sitemap text-primary"></i> <?= html_escape($product->subcategory_name) ?>
                        </span>
                    <?php endif; ?>

                    <!-- Attached Files Count -->
                    <span class="pd-chip pd-chip-accent">
                        <i class="fa-solid fa-paperclip"></i> <?= count($product_files) ?> File<?= count($product_files) > 1 ? 's' : '' ?> Attached
                    </span>
                </div>

                <!-- Description -->
                <div class="pd-desc">
                    <h6 class="pd-section-label">Description</h6>
                    <?php if (!empty($product->description)): ?>
                        <div class="pd-desc-text">
                            <?= html_escape($product->description) ?>
                        </div>
                    <?php else: ?>
                        <p class="pd-desc-empty">No description provided for this product.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 2. Downloadable Digital Files Section -->
            <div class="custom-card pd-card">
                <div class="pd-files-head">
                    <div>
                        <h5 class="pd-card-title">
                            <span class="pd-ico"><i class="fa-solid fa-file-arrow-up"></i></span>
                            Downloadable Digital Files
                        </h5>
                        <p class="pd-card-sub">Attached digital formats for CNC laser cutting, vector design, and digital fabrication.</p>
                    </div>
                    <span class="badge-count-pill">
                        <i class="fa-solid fa-layer-group"></i>
                        <span><strong><?= count($product_files) ?></strong> format<?= count($product_files) > 1 ? 's' : '' ?> available</span>
                    </span>
                </div>

                <?php if (!empty($product_files)): ?>
                    <div class="pd-files-list">
                        <?php
                        $total_size_bytes = 0;
                        foreach ($product_files as $f):
                            $total_size_bytes += (int)$f->file_size;
                            $size_formatted = ($f->file_size > 0) ? number_format($f->file_size / 1024, 1) . ' KB' : 'N/A';
                            if ($f->file_size > 1048576) {
                                $size_formatted = number_format($f->file_size / 1048576, 2) . ' MB';
                            }
                        ?>
                            <div class="pd-file">
                                <span class="pd-ext"><?= html_escape($f->extension) ?></span>

                                <div class="pd-file-info">
                                    <h6 class="pd-file-name"><?= html_escape($f->file_name) ?></h6>
                                    <div class="pd-file-meta">
                                        <span><?= html_escape($f->file_type_name) ?></span>
                                        <span class="pd-dot"></span>
                                        <span class="pd-size"><?= $size_formatted ?></span>
                                        <?php if (!empty($f->mime_type)): ?>
                                            <span class="pd-dot"></span>
                                            <span class="pd-mime"><?= html_escape($f->mime_type) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <a href="<?= base_url($f->file_path) ?>" target="_blank" download="<?= html_escape($f->file_name) ?>" class="pd-btn pd-btn-primary">
                                    <i class="fa-solid fa-download"></i> Download File
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="pd-empty">
                        <i class="fa-solid fa-folder-open pd-empty-ico"></i>
                        <p>No digital files attached to this product yet.</p>
                        <a href="<?= base_url('product/edit/' . $product->id) ?>" class="pd-btn pd-btn-light">
                            <i class="fa-solid fa-plus"></i> Attach Files via Edit
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column: Product Metadata, Specifications & Actions -->
        <div class="col-12 col-lg-4">

            <!-- Quick Actions Card -->
            <div class="custom-card pd-card">
                <h5 class="pd-card-title">
                    <span class="pd-ico"><i class="fa-solid fa-bolt"></i></span>Quick Actions
                </h5>

                <div class="pd-actions">
                    <a href="<?= base_url('product/edit/' . $product->id) ?>" class="pd-btn pd-btn-primary pd-btn-block">
                        <i class="fa-solid fa-pen-to-square"></i> Edit This Product
                    </a>

                    <a href="<?= base_url('product/status/' . $product->id) ?>" class="pd-btn pd-btn-light pd-btn-block">
                        <i class="fa-solid fa-power-off <?= ((int)$product->status === 1) ? 'text-danger' : 'text-success' ?>"></i>
                        Set to <?= ((int)$product->status === 1) ? 'Inactive (Hide)' : 'Active (Publish)' ?>
                    </a>

                    <button type="button"
                        class="pd-btn pd-btn-danger-outline pd-btn-block"
                        onclick="confirmDelete('<?= base_url('product/delete/' . $product->id) ?>', 'Product &quot;<?= addslashes(html_escape($product->name)) ?>&quot;')">
                        <i class="fa-solid fa-trash"></i> Delete Product
                    </button>
                </div>
            </div>

            <!-- Product Details / Metadata -->
            <div class="custom-card pd-card">
                <h5 class="pd-card-title pd-meta-head">
                    <span class="pd-ico"><i class="fa-solid fa-circle-info"></i></span>Product Details
                </h5>

                <div class="pd-meta-row">
                    <span class="pd-meta-label">Visibility Status</span>
                    <span class="pd-meta-value">
                        <a href="<?= base_url('product/status/' . $product->id) ?>" class="badge-status <?= ((int)$product->status === 1) ? 'active' : 'inactive' ?>" title="Click to toggle status">
                            <span class="status-dot"></span>
                            <span><?= ((int)$product->status === 1) ? 'Active' : 'Inactive' ?></span>
                        </a>
                    </span>
                </div>

                <div class="pd-meta-row">
                    <span class="pd-meta-label">Category</span>
                    <span class="pd-meta-value">
                        <?= !empty($product->category_name) ? html_escape($product->category_name) : '<span class="pd-none">Uncategorized</span>' ?>
                    </span>
                </div>

                <div class="pd-meta-row">
                    <span class="pd-meta-label">Subcategory</span>
                    <span class="pd-meta-value">
                        <?= !empty($product->subcategory_name) ? html_escape($product->subcategory_name) : '<span class="pd-none">None</span>' ?>
                    </span>
                </div>

                <div class="pd-meta-row">
                    <span class="pd-meta-label">Attached Files</span>
                    <span class="pd-meta-value">
                        <?= count($product_files) ?> format<?= count($product_files) > 1 ? 's' : '' ?>
                    </span>
                </div>

                <div class="pd-meta-row">
                    <span class="pd-meta-label">Created At</span>
                    <span class="pd-meta-value pd-small">
                        <?= date('M d, Y h:i A', strtotime($product->created_at)) ?>
                    </span>
                </div>

                <div class="pd-meta-row">
                    <span class="pd-meta-label">Last Updated</span>
                    <span class="pd-meta-value pd-small">
                        <?= date('M d, Y h:i A', strtotime($product->updated_at)) ?>
                    </span>
                </div>

                <div class="pd-slug-wrap">
                    <label class="pd-slug-label">URL Identifier (Slug)</label>
                    <div class="pd-slug">
                        <span><?= html_escape($product->slug) ?></span>
                        <button type="button" class="pd-copy" aria-label="Copy slug" onclick="navigator.clipboard.writeText('<?= addslashes(html_escape($product->slug)) ?>'); Swal.fire({toast: true, position: 'top-end', icon: 'success', title: 'Slug copied!', showConfirmButton: false, timer: 1500});" title="Copy slug">
                            <i class="fa-solid fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Digital Storage Summary -->
            <?php if (!empty($product_files)): ?>
                <div class="pd-storage">
                    <h6 class="pd-storage-title">
                        <i class="fa-solid fa-hard-drive"></i>Storage Summary
                    </h6>
                    <p class="pd-storage-note">
                        Total payload size across all <?= count($product_files) ?> digital formats:
                    </p>
                    <p class="pd-storage-size">
                        <?php
                        if ($total_size_bytes > 1048576) {
                            echo number_format($total_size_bytes / 1048576, 2) . ' MB';
                        } else {
                            echo number_format($total_size_bytes / 1024, 1) . ' KB';
                        }
                        ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>