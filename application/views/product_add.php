<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ==========================================================
       Add Product — page scoped (.ap-page), Poppins only
       Colors come from the existing theme variables
       (--primary, --primary-light, --primary-dark) with fallbacks.
       ========================================================== */
    .ap-page {
        --ap-primary: var(--primary, #ff6b35);
        --ap-primary-light: var(--primary-light, #fff1ea);
        --ap-primary-dark: var(--primary-dark, #e8501a);
        --ap-ink: #0f172a;
        --ap-text: #334155;
        --ap-muted: #64748b;
        --ap-faint: #94a3b8;
        --ap-line: #e2e8f0;
        --ap-line-soft: #f1f5f9;
        --ap-soft: #f8fafc;
        --ap-peach-line: #ffd4c2;
        --ap-ring: color-mix(in srgb, var(--ap-primary) 16%, transparent);
        --ap-radius: 18px;
        --ap-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 8px 24px -8px rgba(15, 23, 42, .08);

        font-family: 'Poppins', sans-serif;
        color: var(--ap-text);
        -webkit-font-smoothing: antialiased;
    }

    .ap-page *,
    .ap-page *::before,
    .ap-page *::after {
        box-sizing: border-box;
    }

    .ap-page h1,
    .ap-page h2,
    .ap-page h3,
    .ap-page h4,
    .ap-page h5,
    .ap-page h6,
    .ap-page p,
    .ap-page span,
    .ap-page a,
    .ap-page button,
    .ap-page label,
    .ap-page small,
    .ap-page div,
    .ap-page input,
    .ap-page select,
    .ap-page textarea {
        font-family: 'Poppins', sans-serif;
    }

    /* ---------- Page header ---------- */
    .ap-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .ap-header-main {
        min-width: 0;
        flex: 1 1 380px;
    }

    .ap-back {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .35rem .85rem;
        margin-bottom: .75rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--ap-muted);
        background: #fff;
        border: 1px solid var(--ap-line);
        border-radius: 999px;
        text-decoration: none;
        transition: all .2s ease;
    }

    .ap-back:hover {
        color: var(--ap-primary-dark);
        background: var(--ap-primary-light);
        border-color: var(--ap-peach-line);
    }

    .ap-title {
        margin: 0 0 .35rem;
        font-size: clamp(1.3rem, 1rem + 1.4vw, 1.9rem);
        font-weight: 700;
        line-height: 1.3;
        letter-spacing: -.01em;
        color: var(--ap-ink);
    }

    .ap-subtitle {
        margin: 0;
        font-size: .88rem;
        line-height: 1.6;
        color: var(--ap-muted);
    }

    .ap-header-actions {
        display: flex;
        align-items: center;
        gap: .6rem;
        flex-wrap: wrap;
    }

    /* ---------- Buttons ---------- */
    .ap-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: .65rem 1.25rem;
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

    .ap-btn:active {
        transform: translateY(1px);
    }

    .ap-btn-primary {
        color: #fff;
        background: linear-gradient(135deg, var(--ap-primary), var(--ap-primary-dark));
        box-shadow: 0 6px 16px -6px var(--ap-primary);
    }

    .ap-btn-primary:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px -8px var(--ap-primary);
    }

    .ap-btn-light {
        color: var(--ap-text);
        background: #fff;
        border-color: var(--ap-line);
    }

    .ap-btn-light:hover {
        color: var(--ap-ink);
        background: var(--ap-soft);
        border-color: #cbd5e1;
    }

    .ap-btn-outline {
        color: var(--ap-primary-dark);
        background: #fff;
        border-color: var(--ap-peach-line);
    }

    .ap-btn-outline:hover {
        color: #fff;
        background: var(--ap-primary);
        border-color: var(--ap-primary);
    }

    .ap-btn-danger-soft {
        color: #dc2626;
        background: #fff;
        border-color: #fecaca;
    }

    .ap-btn-danger-soft:hover {
        color: #fff;
        background: #dc2626;
        border-color: #dc2626;
    }

    .ap-btn-sm {
        padding: .5rem .95rem;
        font-size: .8rem;
        border-radius: 10px;
    }

    .ap-btn-block {
        width: 100%;
    }

    /* ---------- Cards ---------- */
    .ap-page .ap-card {
        background: #fff;
        border: 1px solid var(--ap-line);
        border-radius: var(--ap-radius);
        box-shadow: var(--ap-shadow);
        padding: clamp(1rem, .6rem + 1.6vw, 1.75rem);
        margin-bottom: 1.5rem;
    }

    .ap-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .75rem 1rem;
        margin-bottom: 1.25rem;
    }

    .ap-card-head>div:first-child {
        min-width: 0;
        flex: 1 1 240px;
    }

    .ap-card-title {
        display: flex;
        align-items: center;
        gap: .65rem;
        margin: 0;
        font-size: 1.02rem;
        font-weight: 700;
        color: var(--ap-ink);
    }

    .ap-ico {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        font-size: .88rem;
        color: var(--ap-primary-dark);
        background: var(--ap-primary-light);
        border-radius: 10px;
    }

    .ap-card-sub {
        margin: .35rem 0 0;
        font-size: .82rem;
        line-height: 1.6;
        color: var(--ap-muted);
    }

    .ap-tag {
        display: inline-flex;
        align-items: center;
        padding: .35rem .8rem;
        font-size: .74rem;
        font-weight: 600;
        color: var(--ap-muted);
        background: var(--ap-soft);
        border: 1px solid var(--ap-line);
        border-radius: 999px;
        white-space: nowrap;
    }

    /* ---------- Form fields ---------- */
    .ap-field {
        margin-bottom: 1.15rem;
    }

    .ap-field:last-child {
        margin-bottom: 0;
    }

    .ap-page .form-label {
        display: block;
        margin-bottom: .45rem;
        font-size: .82rem;
        font-weight: 600;
        color: var(--ap-ink);
    }

    .ap-req {
        color: #ef4444;
        margin-left: 2px;
    }

    .ap-page .form-control,
    .ap-page .form-select {
        width: 100%;
        padding: .72rem .95rem;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--ap-ink);
        background-color: #fff;
        border: 1px solid var(--ap-line);
        border-radius: 12px;
        box-shadow: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .ap-page .form-select {
        padding-right: 2.4rem;
    }

    .ap-page .form-control::placeholder {
        color: var(--ap-faint);
        font-weight: 400;
    }

    .ap-page .form-control:hover,
    .ap-page .form-select:hover {
        border-color: #cbd5e1;
    }

    .ap-page .form-control:focus,
    .ap-page .form-select:focus {
        outline: 0;
        border-color: var(--ap-primary);
        box-shadow: 0 0 0 4px var(--ap-ring);
    }

    .ap-page textarea.form-control {
        resize: vertical;
        min-height: 120px;
        line-height: 1.7;
    }

    .ap-hint {
        margin-top: .4rem;
        font-size: .76rem;
        color: var(--ap-faint);
    }

    .ap-input-icon {
        position: relative;
    }

    .ap-input-icon>i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: .9rem;
        color: var(--ap-faint);
        pointer-events: none;
        transition: color .2s ease;
    }

    .ap-input-icon .form-control {
        padding-left: 2.6rem;
    }

    .ap-input-icon:focus-within>i {
        color: var(--ap-primary);
    }

    /* ---------- Image upload ---------- */
    .upload-zone {
        position: relative;
        padding: clamp(1.5rem, 4vw, 2.5rem) 1.25rem;
        text-align: center;
        cursor: pointer;
        background:
            radial-gradient(circle at 50% 0%, var(--ap-primary-light), transparent 65%),
            var(--ap-soft);
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .upload-zone:hover,
    .upload-zone.is-dragover {
        border-color: var(--ap-primary);
        box-shadow: 0 0 0 4px var(--ap-ring);
    }

    .ap-upload-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        margin-bottom: .9rem;
        font-size: 1.6rem;
        color: var(--ap-primary-dark);
        background: #fff;
        border: 1px solid var(--ap-peach-line);
        border-radius: 50%;
        box-shadow: 0 8px 20px -10px var(--ap-primary);
    }

    .ap-upload-title {
        margin: 0 0 .3rem;
        font-size: .98rem;
        font-weight: 600;
        color: var(--ap-ink);
    }

    .ap-upload-note {
        margin: 0;
        font-size: .8rem;
        color: var(--ap-muted);
    }

    .preview-image-container {
        display: none;
        position: relative;
        text-align: center;
    }

    .preview-image {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        max-height: 260px;
        object-fit: contain;
        background: #fff;
        border: 1px solid var(--ap-line);
        border-radius: 12px;
        box-shadow: 0 12px 28px -14px rgba(15, 23, 42, .3);
    }

    .preview-image-container .ap-btn {
        margin-top: 1rem;
    }

    /* ---------- File rows ---------- */
    #fileRowsContainer {
        display: grid;
        gap: .85rem;
    }

    .file-attachment-row {
        padding: 1rem 1.1rem;
        background: var(--ap-soft);
        border: 1px solid var(--ap-line);
        border-radius: 14px;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .file-attachment-row:hover,
    .file-attachment-row:focus-within {
        background: #fff;
        border-color: var(--ap-peach-line);
        box-shadow: 0 10px 24px -14px rgba(15, 23, 42, .2);
    }

    .ap-file-grid {
        display: grid;
        grid-template-columns: minmax(0, 4fr) minmax(0, 7fr) auto;
        align-items: end;
        gap: .85rem;
    }

    .ap-file-col {
        min-width: 0;
    }

    .ap-file-grid .form-label {
        margin-bottom: .4rem;
        font-size: .76rem;
    }

    .ap-file-grid .form-control,
    .ap-file-grid .form-select {
        padding: .6rem .85rem;
        font-size: .84rem;
    }

    .ap-page input[type="file"].form-control {
        padding: .4rem .5rem;
    }

    .ap-page input[type="file"]::file-selector-button {
        margin-right: .75rem;
        padding: .4rem .9rem;
        font-family: 'Poppins', sans-serif;
        font-size: .78rem;
        font-weight: 600;
        color: var(--ap-primary-dark);
        background: var(--ap-primary-light);
        border: 1px solid var(--ap-peach-line);
        border-radius: 8px;
        cursor: pointer;
        transition: background .2s ease, color .2s ease;
    }

    .ap-page input[type="file"]::file-selector-button:hover {
        color: #fff;
        background: var(--ap-primary);
    }

    .ap-remove-text {
        display: none;
    }

    /* ---------- Publish card ---------- */
    .ap-publish {
        background: linear-gradient(135deg, var(--ap-primary-light), #fff 75%);
        border: 1px solid var(--ap-peach-line);
        border-radius: var(--ap-radius);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .ap-publish-grid {
        display: grid;
        gap: .6rem;
    }

    /* ---------- Tablet & mobile ---------- */
    @media (max-width: 767.98px) {
        .ap-header {
            align-items: stretch;
            margin-bottom: 1.1rem;
        }

        .ap-header-actions {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .ap-header-actions .ap-btn {
            width: 100%;
        }

        .ap-page .ap-card {
            margin-bottom: 1.1rem;
        }

        .ap-publish {
            margin-bottom: 1.1rem;
        }

        .ap-card-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .ap-card-head .ap-btn {
            width: 100%;
        }

        .ap-file-grid {
            grid-template-columns: 1fr;
            align-items: stretch;
        }

        .ap-remove-col .ap-btn {
            width: 100%;
        }

        .ap-remove-text {
            display: inline;
        }

        .preview-image {
            max-height: 220px;
        }
    }

    /* ==========================================================
       Good-looking File Upload Loader Modal Styles
       ========================================================== */
    .upload-loader-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.78);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.25rem;
        animation: fadeInOverlay .25s ease-out;
    }
    @keyframes fadeInOverlay {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .upload-loader-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.15);
        width: 100%;
        max-width: 490px;
        padding: 2.25rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        animation: cardPopUp .35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    @keyframes cardPopUp {
        from { transform: scale(0.9) translateY(20px); opacity: 0; }
        to { transform: scale(1) translateY(0); opacity: 1; }
    }
    .upload-graphic-wrapper {
        position: relative;
        width: 76px;
        height: 76px;
        margin: 0 auto 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .upload-ring-glow {
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--ap-primary, #ff6b35), #ff9066);
        opacity: 0.35;
        filter: blur(10px);
        animation: ringPulse 2s infinite ease-in-out;
    }
    @keyframes ringPulse {
        0%, 100% { transform: scale(1); opacity: 0.3; }
        50% { transform: scale(1.15); opacity: 0.55; }
    }
    .upload-icon-circle {
        position: relative;
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--ap-primary, #ff6b35) 0%, var(--ap-primary-dark, #e8501a) 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.85rem;
        box-shadow: 0 10px 25px -4px rgba(255, 107, 53, 0.5);
    }
    .upload-bounce-icon {
        animation: cloudBounce 1.8s infinite ease-in-out;
    }
    @keyframes cloudBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .upload-pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #10b981;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulseLive 1.8s infinite;
    }
    @keyframes pulseLive {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .upload-live-badge {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #059669;
    }
    .upload-loader-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.3;
    }
    .upload-count-pill {
        background: var(--ap-primary-light, #fff1ea);
        color: var(--ap-primary, #ff6b35);
        padding: 3px 12px;
        border-radius: 30px;
        border: 1px solid var(--ap-peach-line, #ffd4c2);
        display: inline-block;
    }
    .upload-loader-sub {
        font-size: 0.82rem;
        color: #64748b;
        line-height: 1.5;
    }
    .upload-progress-track {
        height: 11px;
        border-radius: 12px;
        background: #f1f5f9;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        position: relative;
    }
    .upload-progress-fill {
        height: 100%;
        border-radius: 12px;
        background: linear-gradient(90deg, var(--ap-primary, #ff6b35) 0%, #ff8c5a 50%, var(--ap-primary, #ff6b35) 100%);
        background-size: 200% 100%;
        animation: progressFlow 2s linear infinite;
        transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 0 10px rgba(255, 107, 53, 0.4);
    }
    @keyframes progressFlow {
        0% { background-position: 0% 0%; }
        100% { background-position: 200% 0%; }
    }
    .upload-files-tray {
        max-height: 160px;
        overflow-y: auto;
        background: #f8fafc;
        border: 1px solid #edf2f7;
        border-radius: 14px;
        padding: 0.65rem;
        text-align: left;
    }
    .upload-file-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        padding: 0.5rem 0.65rem;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #f1f5f9;
        margin-bottom: 0.4rem;
        font-size: 0.82rem;
    }
    .upload-file-item:last-child {
        margin-bottom: 0;
    }
    .upload-status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.55rem 1.15rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 30px;
        width: 100%;
    }
    .file-picked-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 3px 9px;
        border-radius: 8px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        font-size: 0.75rem;
        font-weight: 500;
        margin-top: 5px;
    }
    .live-files-summary-bar {
        background: linear-gradient(135deg, #ffffff 0%, #fffbf8 100%);
        border: 1px solid #ffd4c2;
        border-radius: 14px;
        padding: 0.75rem 1rem;
        box-shadow: 0 2px 10px rgba(255, 107, 53, 0.05);
    }
    .format-pill-ai { background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; }
    .format-pill-cdr { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .format-pill-dxf { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .format-pill-eps { background: #faf5ff; color: #9333ea; border: 1px solid #e9d5ff; }
    .format-pill-pdf { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .format-pill-svg { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .format-pill-zip { background: #fefce8; color: #ca8a04; border: 1px solid #fef08a; }
    .format-pill-default { background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; }

    @media (max-width: 380px) {
        .ap-header-actions {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="ap-page">

    <!-- Page Header -->
    <div class="ap-header">
        <div class="ap-header-main">
            <a href="<?= base_url('product') ?>" class="ap-back">
                <i class="fa-solid fa-arrow-left"></i> Back to Products
            </a>
            <h3 class="ap-title">Add New Product</h3>
            <p class="ap-subtitle">Create a digital catalog product, upload preview image, and attach downloadable file types.</p>
        </div>
        <div class="ap-header-actions">
            <a href="<?= base_url('product') ?>" class="ap-btn ap-btn-light">Cancel</a>
            <button type="submit" form="addProductForm" class="ap-btn ap-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Save Product
            </button>
        </div>
    </div>

    <form action="<?= base_url('product/save') ?>" method="POST" enctype="multipart/form-data" autocomplete="off" id="addProductForm">
        <div class="row g-4">
            <!-- Left Column: Media & Primary Details -->
            <div class="col-12 col-lg-8">

                <!-- 1. Product Image Upload (Prominently Placed Above) -->
                <div class="custom-card ap-card">
                    <div class="ap-card-head">
                        <div>
                            <h5 class="ap-card-title">
                                <span class="ap-ico"><i class="fa-solid fa-image"></i></span>Product Preview Image
                            </h5>
                        </div>
                        <span class="ap-tag">Catalog Thumbnail</span>
                    </div>

                    <div class="upload-zone" id="uploadDropzone" onclick="document.getElementById('productImageInput').click();">
                        <div id="uploadPrompt">
                            <span class="ap-upload-badge"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                            <h6 class="ap-upload-title">Click or drag image here to upload</h6>
                            <p class="ap-upload-note">PNG, JPG, WEBP, or GIF &bull; Max 10MB</p>
                        </div>

                        <div class="preview-image-container" id="previewContainer">
                            <img src="" alt="Preview" class="preview-image" id="previewImage">
                            <div>
                                <button type="button" class="ap-btn ap-btn-sm ap-btn-danger-soft" id="removeImageBtn" onclick="event.stopPropagation(); removeSelectedImage();">
                                    <i class="fa-solid fa-trash"></i> Change Image
                                </button>
                            </div>
                        </div>

                        <input type="file" id="productImageInput" name="image" accept="image/*" class="d-none">
                    </div>
                </div>

                <!-- 2. Basic Information Card -->
                <div class="custom-card ap-card">
                    <div class="ap-card-head">
                        <div>
                            <h5 class="ap-card-title">
                                <span class="ap-ico"><i class="fa-solid fa-info-circle"></i></span>Basic Information
                            </h5>
                        </div>
                    </div>

                    <div class="ap-field">
                        <label for="productName" class="form-label">Product Name <span class="ap-req">*</span></label>
                        <div class="ap-input-icon">
                            <i class="fa-solid fa-tag"></i>
                            <input type="text" class="form-control" id="productName" name="name" placeholder="e.g. Mandala Laser Cutting Wall Art Vector Design" required autofocus>
                        </div>
                    </div>

                    <div class="ap-field">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="4" placeholder="Enter product description, cut thickness, dimensions, machine compatibility..."></textarea>
                    </div>
                </div>

                <!-- 3. Digital Files & Multiple File Types Card -->
                <div class="custom-card ap-card">
                    <div class="ap-card-head">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                <h5 class="ap-card-title mb-0">
                                    <span class="ap-ico"><i class="fa-solid fa-file-arrow-up"></i></span>Downloadable Digital Files
                                </h5>
                                <span id="digitalFilesCountBadge" class="badge rounded-pill bg-light text-muted border px-2 py-1" style="font-size: 0.74rem;">
                                    <i class="fa-solid fa-paperclip me-1"></i> 0 Files Attached
                                </span>
                            </div>
                            <p class="ap-card-sub mb-0">Attach multiple file formats (.cdr, .dxf, .ai, .svg, .zip, etc.) for this product.</p>
                        </div>
                        <button type="button" class="ap-btn ap-btn-sm ap-btn-outline" id="addFileRowBtn">
                            <i class="fa-solid fa-plus"></i> Add Another File Type
                        </button>
                    </div>

                    <!-- Live Files Summary Alert (shown dynamically when files are selected) -->
                    <div id="liveFilesSummaryBar" class="live-files-summary-bar mb-3 d-none align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="upload-pulse-dot"></span>
                            <span class="fw-bold text-dark small" id="liveSummaryCount">0 Files Selected</span>
                            <span class="text-muted small">&bull; Total Payload: <strong id="liveSummarySize" class="text-dark">0 KB</strong></span>
                        </div>
                        <div class="d-flex align-items-center gap-1 flex-wrap" id="liveSummaryChips">
                            <!-- Format pills injected via JS -->
                        </div>
                    </div>

                    <div id="fileRowsContainer">
                        <!-- Default Initial File Row -->
                        <div class="file-attachment-row">
                            <div class="ap-file-grid">
                                <div class="ap-file-col">
                                    <label class="form-label">File Type <span class="ap-req">*</span></label>
                                    <select class="form-select file-type-select" name="file_types[]" required>
                                        <option value="">-- Choose File Type --</option>
                                        <?php if (!empty($file_types)): ?>
                                            <?php foreach ($file_types as $ft): ?>
                                                <?php $cleanExt = strtolower(ltrim($ft->extension, '.')); ?>
                                                <option value="<?= $ft->id ?>" data-ext="<?= $cleanExt ?>" data-name="<?= html_escape($ft->name) ?>">
                                                    <?= html_escape($ft->extension) ?> - <?= html_escape($ft->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="ap-file-col">
                                    <label class="form-label">Digital File <span class="ap-req">*</span></label>
                                    <input type="file" class="form-control digital-file-input" name="files[]" required>
                                </div>
                                <div class="ap-remove-col">
                                    <button type="button" class="ap-btn ap-btn-danger-soft remove-file-btn" title="Remove this file">
                                        <i class="fa-solid fa-trash"></i><span class="ap-remove-text">Remove</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Taxonomy, Status & Actions -->
            <div class="col-12 col-lg-4">

                <!-- Taxonomy Card -->
                <div class="custom-card ap-card">
                    <div class="ap-card-head">
                        <div>
                            <h5 class="ap-card-title">
                                <span class="ap-ico"><i class="fa-solid fa-folder-tree"></i></span>Catalog Category
                            </h5>
                        </div>
                    </div>

                    <div class="ap-field">
                        <label for="categorySelect" class="form-label">Primary Category</label>
                        <select class="form-select" id="categorySelect" name="category_id">
                            <option value="">-- Select Category --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat->id ?>"><?= html_escape($cat->name) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="ap-field">
                        <label for="subcategorySelect" class="form-label">Subcategory</label>
                        <select class="form-select" id="subcategorySelect" name="subcategory_id">
                            <option value="">-- Select Subcategory --</option>
                        </select>
                        <div class="ap-hint">Auto-filtered by category.</div>
                    </div>
                </div>

                <!-- Status & Visibility Card -->
                <div class="custom-card ap-card">
                    <div class="ap-card-head">
                        <div>
                            <h5 class="ap-card-title">
                                <span class="ap-ico"><i class="fa-solid fa-toggle-on"></i></span>Visibility &amp; Status
                            </h5>
                        </div>
                    </div>

                    <div class="ap-field">
                        <label for="productStatus" class="form-label">Status <span class="ap-req">*</span></label>
                        <select class="form-select" id="productStatus" name="status" required>
                            <option value="1" selected>Active (Visible in Catalog)</option>
                            <option value="0">Inactive (Hidden)</option>
                        </select>
                    </div>
                </div>

                <!-- Publish Card -->
                <div class="ap-publish">
                    <div id="publishFilesSummary" class="text-muted small mb-2 text-center d-none">
                        <i class="fa-solid fa-cloud-arrow-up text-primary me-1"></i>
                        <span id="publishFilesCountText" class="fw-semibold">0 files ready to upload</span>
                    </div>
                    <div class="ap-publish-grid">
                        <button type="submit" class="ap-btn ap-btn-primary ap-btn-block" id="saveProductBtn">
                            <i class="fa-solid fa-floppy-disk"></i> Save &amp; Publish Product
                        </button>
                        <a href="<?= base_url('product') ?>" class="ap-btn ap-btn-light ap-btn-block">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Upload Progress Modal Overlay -->
    <div id="uploadLoaderModal" class="upload-loader-overlay" style="display: none;">
        <div class="upload-loader-card">
            <!-- Floating Brand Icon Graphic -->
            <div class="upload-graphic-wrapper">
                <div class="upload-ring-glow"></div>
                <div class="upload-icon-circle">
                    <i class="fa-solid fa-cloud-arrow-up upload-bounce-icon"></i>
                </div>
            </div>

            <!-- Title & Dynamic Counter -->
            <div class="upload-header-area">
                <div class="d-inline-flex align-items-center gap-2 mb-2">
                    <span class="upload-pulse-dot"></span>
                    <span class="upload-live-badge" id="loaderLiveStatusText">Uploading Assets</span>
                </div>
                <h4 class="upload-loader-title mb-1">
                    Adding <span id="loaderFileCountBadge" class="upload-count-pill">0 Files</span>
                </h4>
                <p class="upload-loader-sub mb-3" id="loaderSubtext">
                    Transferring digital vector files to server...
                </p>
            </div>

            <!-- Progress Bar & Meta -->
            <div class="upload-progress-wrapper mb-3">
                <div class="upload-progress-track">
                    <div id="uploadProgressBar" class="upload-progress-fill" style="width: 0%;"></div>
                </div>
                <div class="upload-progress-meta mt-2 d-flex justify-content-between align-items-center">
                    <span id="uploadPercentText" class="fw-bold" style="color: var(--ap-primary, #ff6b35); font-size: 0.95rem;">0%</span>
                    <span id="uploadBytesText" class="text-muted small">0 KB / 0 KB</span>
                </div>
            </div>

            <!-- Files List Breakdown Tray -->
            <div class="upload-tray-header d-flex justify-content-between align-items-center mb-2 px-1">
                <span class="small fw-bold text-muted text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Attached Files Breakdown</span>
                <span class="badge bg-light text-dark border" id="loaderFilesListCountBadge" style="font-size: 0.72rem;">0 Files</span>
            </div>
            <div class="upload-files-tray mb-3" id="loaderFilesList">
                <!-- Dynamically populated via JS -->
            </div>

            <!-- Bottom Status Message -->
            <div class="upload-status-pill">
                <span class="spinner-border spinner-border-sm me-2" id="loaderSpinner" style="color: var(--ap-primary, #ff6b35); width: 14px; height: 14px;"></span>
                <span id="loaderStatusText" class="small fw-medium text-dark">Uploading digital assets... Please keep this page open.</span>
            </div>
        </div>
    </div>
</div>

<script>
    // Registered File Types Options HTML for Dynamic Repeater Rows
    const FILE_TYPES_OPTIONS = `
        <option value="">-- Choose File Type --</option>
        <?php if (!empty($file_types)): ?>
            <?php foreach ($file_types as $ft): ?>
                <?php $cleanExt = strtolower(ltrim($ft->extension, '.')); ?>
                <option value="<?= $ft->id ?>" data-ext="<?= $cleanExt ?>" data-name="<?= html_escape($ft->name) ?>">
                    <?= html_escape($ft->extension) ?> - <?= html_escape($ft->name) ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    `;

    // Helper: format bytes into readable units (KB, MB)
    function formatBytes(bytes, decimals = 1) {
        if (!bytes || bytes <= 0) return '0 B';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Helper: gather all currently selected files (product image + digital files)
    function getSelectedFilesInfo() {
        const files = [];

        // Check thumbnail image
        const imgInput = document.getElementById('productImageInput');
        if (imgInput && imgInput.files && imgInput.files[0]) {
            const f = imgInput.files[0];
            const ext = f.name.split('.').pop().toUpperCase();
            files.push({
                name: f.name,
                size: f.size,
                ext: ext,
                type: 'Product Thumbnail',
                isImage: true
            });
        }

        // Check digital files
        const rows = document.querySelectorAll('.file-attachment-row');
        rows.forEach(row => {
            const fileInput = row.querySelector('.digital-file-input');
            const select = row.querySelector('.file-type-select');
            if (fileInput && fileInput.files && fileInput.files[0]) {
                const f = fileInput.files[0];
                const opt = select ? select.selectedOptions[0] : null;
                const ext = opt?.dataset?.ext ? opt.dataset.ext.toUpperCase() : f.name.split('.').pop().toUpperCase();
                const typeName = opt?.dataset?.name || 'Digital Format';
                files.push({
                    name: f.name,
                    size: f.size,
                    ext: ext,
                    type: typeName,
                    isImage: false
                });
            }
        });

        return files;
    }

    // Helper: update live files summary bar & counter badge in real-time
    function updateLiveFilesSummary() {
        const files = getSelectedFilesInfo();
        const count = files.length;
        const totalBytes = files.reduce((acc, f) => acc + f.size, 0);

        // 1. Digital Files Header Badge
        const badge = document.getElementById('digitalFilesCountBadge');
        if (badge) {
            if (count > 0) {
                badge.className = 'badge rounded-pill text-white px-3 py-1';
                badge.style.background = 'linear-gradient(135deg, var(--ap-primary, #ff6b35), var(--ap-primary-dark, #e8501a))';
                badge.innerHTML = `<i class="fa-solid fa-paperclip me-1"></i> ${count} File${count > 1 ? 's' : ''} Attached (${formatBytes(totalBytes)})`;
            } else {
                badge.className = 'badge rounded-pill bg-light text-muted border px-2 py-1';
                badge.style.background = '';
                badge.innerHTML = `<i class="fa-solid fa-paperclip me-1"></i> 0 Files Attached`;
            }
        }

        // 2. Live Summary Bar above rows
        const liveBar = document.getElementById('liveFilesSummaryBar');
        if (liveBar) {
            if (count > 0) {
                liveBar.classList.remove('d-none');
                liveBar.classList.add('d-flex');
                document.getElementById('liveSummaryCount').textContent = `${count} File${count > 1 ? 's' : ''} Ready`;
                document.getElementById('liveSummarySize').textContent = formatBytes(totalBytes);

                const chipsContainer = document.getElementById('liveSummaryChips');
                if (chipsContainer) {
                    chipsContainer.innerHTML = files.map(f => {
                        const extLower = f.ext.toLowerCase();
                        let pillClass = 'format-pill-default';
                        if (extLower === 'ai') pillClass = 'format-pill-ai';
                        else if (extLower === 'cdr') pillClass = 'format-pill-cdr';
                        else if (extLower === 'dxf') pillClass = 'format-pill-dxf';
                        else if (extLower === 'eps') pillClass = 'format-pill-eps';
                        else if (extLower === 'pdf') pillClass = 'format-pill-pdf';
                        else if (extLower === 'svg') pillClass = 'format-pill-svg';
                        else if (extLower === 'zip') pillClass = 'format-pill-zip';

                        return `<span class="format-pill ${pillClass}">
                            ${f.isImage ? '<i class="fa-solid fa-image me-1"></i>' : ''}.${extLower}
                        </span>`;
                    }).join(' ');
                }
            } else {
                liveBar.classList.add('d-none');
                liveBar.classList.remove('d-flex');
            }
        }

        // 3. Publish Card Summary
        const pubBox = document.getElementById('publishFilesSummary');
        if (pubBox) {
            if (count > 0) {
                pubBox.classList.remove('d-none');
                document.getElementById('publishFilesCountText').textContent = `${count} file${count > 1 ? 's' : ''} ready to upload (${formatBytes(totalBytes)})`;
            } else {
                pubBox.classList.add('d-none');
            }
        }
    }

    // Attach sync, validation, and chip listeners to a file attachment row
    function setupFileRowEvents(row) {
        const select = row.querySelector('.file-type-select');
        const fileInput = row.querySelector('.digital-file-input');
        const fileCol = row.querySelector('.ap-file-col:nth-child(2)');

        if (!select || !fileInput) return;

        function updateRowChip(file, ext) {
            let chip = fileCol.querySelector('.file-picked-chip');
            if (file) {
                if (!chip) {
                    chip = document.createElement('div');
                    chip.className = 'file-picked-chip';
                    fileCol.appendChild(chip);
                }
                chip.innerHTML = `
                    <i class="fa-solid fa-circle-check text-success"></i>
                    <span class="text-truncate" style="max-width: 220px;">${htmlEscape(file.name)}</span>
                    <span class="text-muted fw-normal">(${formatBytes(file.size)})</span>
                    <span class="badge bg-white text-dark border ms-1">.${ext.toLowerCase()}</span>
                `;
            } else {
                if (chip) chip.remove();
            }
        }

        function htmlEscape(str) {
            return String(str).replace(/[&<>"']/g, s => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            })[s]);
        }

        // 1. When file type dropdown changes:
        select.addEventListener('change', function() {
            const selectedOpt = this.selectedOptions[0];
            const ext = selectedOpt?.dataset?.ext ? selectedOpt.dataset.ext.toLowerCase() : '';

            if (ext) {
                fileInput.setAttribute('accept', '.' + ext);
            } else {
                fileInput.removeAttribute('accept');
            }

            // If file already chosen, validate it
            if (fileInput.files && fileInput.files[0]) {
                const fileName = fileInput.files[0].name;
                const fileExt = fileName.split('.').pop().toLowerCase();
                if (ext && fileExt !== ext) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Type Mismatch',
                        html: `Selected format is <strong>.${ext}</strong> (${selectedOpt.dataset.name}), but your uploaded file is <strong>.${fileExt}</strong> ('${fileName}').<br><br>Please select a matching <strong>.${ext}</strong> file.`,
                        confirmButtonColor: '#ff6b35'
                    });
                    fileInput.value = '';
                    updateRowChip(null);
                } else {
                    updateRowChip(fileInput.files[0], ext);
                }
            }
            updateLiveFilesSummary();
        });

        // 2. When file input changes:
        fileInput.addEventListener('change', function() {
            if (!this.files || !this.files[0]) {
                updateRowChip(null);
                updateLiveFilesSummary();
                return;
            }

            const file = this.files[0];
            const fileName = file.name;
            const fileExt = fileName.split('.').pop().toLowerCase();
            const selectedOpt = select.selectedOptions[0];
            const expectedExt = selectedOpt?.dataset?.ext ? selectedOpt.dataset.ext.toLowerCase() : '';

            if (expectedExt) {
                if (fileExt !== expectedExt) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Format',
                        html: `You selected <strong>.${expectedExt}</strong> format, but chosen file is '<strong>${fileName}</strong>' (.${fileExt}).<br><br>Please choose a valid <strong>.${expectedExt}</strong> file.`,
                        confirmButtonColor: '#ff6b35'
                    });
                    this.value = '';
                    updateRowChip(null);
                    updateLiveFilesSummary();
                    return;
                }
                updateRowChip(file, expectedExt);
            } else {
                // Auto-detect format from file extension and auto-select dropdown
                const matchingOption = Array.from(select.options).find(opt => opt.dataset.ext === fileExt);
                if (matchingOption) {
                    select.value = matchingOption.value;
                    this.setAttribute('accept', '.' + fileExt);
                    updateRowChip(file, fileExt);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2500
                    });
                    Toast.fire({
                        icon: 'info',
                        title: `Auto-selected .${fileExt} format`
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Unsupported File Format',
                        html: `The file extension <strong>.${fileExt}</strong> is not among the allowed File Types.`,
                        confirmButtonColor: '#ff6b35'
                    });
                    this.value = '';
                    updateRowChip(null);
                }
            }
            updateLiveFilesSummary();
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Setup initial file row
        const initialRow = document.querySelector('.file-attachment-row');
        if (initialRow) {
            setupFileRowEvents(initialRow);
        }

        // Chained Category -> Subcategory dropdown
        const categorySelect = document.getElementById('categorySelect');
        const subcategorySelect = document.getElementById('subcategorySelect');

        if (categorySelect && subcategorySelect) {
            categorySelect.addEventListener('change', function() {
                const categoryId = this.value;
                subcategorySelect.innerHTML = '<option value="">-- Loading... --</option>';

                if (categoryId) {
                    fetch('<?= base_url("product/get_subcategories/") ?>' + categoryId)
                        .then(res => res.json())
                        .then(data => {
                            let options = '<option value="">-- Select Subcategory --</option>';
                            if (data.status && data.subcategories && data.subcategories.length > 0) {
                                data.subcategories.forEach(sub => {
                                    options += `<option value="${sub.id}">${sub.name}</option>`;
                                });
                            }
                            subcategorySelect.innerHTML = options;
                        })
                        .catch(() => {
                            subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
                        });
                } else {
                    subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
                }
            });
        }

        // Live Image Preview Handler
        const imageInput = document.getElementById('productImageInput');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const uploadPrompt = document.getElementById('uploadPrompt');

        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        previewImage.src = ev.target.result;
                        previewContainer.style.display = 'block';
                        uploadPrompt.style.display = 'none';
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
                updateLiveFilesSummary();
            });
        }

        // Drag & drop support for the image zone
        const dropzone = document.getElementById('uploadDropzone');
        if (dropzone && imageInput) {
            ['dragenter', 'dragover'].forEach(evt => {
                dropzone.addEventListener(evt, function(e) {
                    e.preventDefault();
                    dropzone.classList.add('is-dragover');
                });
            });
            ['dragleave', 'drop'].forEach(evt => {
                dropzone.addEventListener(evt, function(e) {
                    e.preventDefault();
                    dropzone.classList.remove('is-dragover');
                });
            });
            dropzone.addEventListener('drop', function(e) {
                const droppedFile = e.dataTransfer && e.dataTransfer.files ? e.dataTransfer.files[0] : null;
                if (droppedFile && droppedFile.type.indexOf('image/') === 0) {
                    const dt = new DataTransfer();
                    dt.items.add(droppedFile);
                    imageInput.files = dt.files;
                    imageInput.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }
            });
        }

        // Add Dynamic File Attachment Row
        const addFileRowBtn = document.getElementById('addFileRowBtn');
        const fileRowsContainer = document.getElementById('fileRowsContainer');

        if (addFileRowBtn && fileRowsContainer) {
            addFileRowBtn.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'file-attachment-row';
                newRow.innerHTML = `
                    <div class="ap-file-grid">
                        <div class="ap-file-col">
                            <label class="form-label">File Type <span class="ap-req">*</span></label>
                            <select class="form-select file-type-select" name="file_types[]" required>
                                ${FILE_TYPES_OPTIONS}
                            </select>
                        </div>
                        <div class="ap-file-col">
                            <label class="form-label">Digital File <span class="ap-req">*</span></label>
                            <input type="file" class="form-control digital-file-input" name="files[]" required>
                        </div>
                        <div class="ap-remove-col">
                            <button type="button" class="ap-btn ap-btn-danger-soft remove-file-btn" title="Remove this file">
                                <i class="fa-solid fa-trash"></i><span class="ap-remove-text">Remove</span>
                            </button>
                        </div>
                    </div>
                `;
                fileRowsContainer.appendChild(newRow);
                setupFileRowEvents(newRow);
                updateLiveFilesSummary();
            });

            // Delegate removal of file row
            document.addEventListener('click', function(e) {
                const removeBtn = e.target.closest('.remove-file-btn');
                if (removeBtn) {
                    const row = removeBtn.closest('.file-attachment-row');
                    if (row) {
                        row.remove();
                        updateLiveFilesSummary();
                    }
                }
            });
        }

        // Form Submit Handler with Good-Looking Upload Loader & Real Progress
        const addForm = document.getElementById('addProductForm');
        if (addForm) {
            addForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // 1. Validate Extension Mismatches
                const rows = document.querySelectorAll('.file-attachment-row');
                for (let row of rows) {
                    const select = row.querySelector('.file-type-select');
                    const fileInput = row.querySelector('.digital-file-input');
                    if (select && fileInput && fileInput.files && fileInput.files[0]) {
                        const ext = select.selectedOptions[0]?.dataset?.ext?.toLowerCase();
                        const fileExt = fileInput.files[0].name.split('.').pop().toLowerCase();
                        if (ext && fileExt !== ext) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Extension Mismatch',
                                html: `File '<strong>${fileInput.files[0].name}</strong>' does not match selected format <strong>.${ext}</strong>. Please upload the matching file.`,
                                confirmButtonColor: '#ff6b35'
                            });
                            return false;
                        }
                    }
                }

                // 2. HTML5 Constraint Validation Check
                if (!addForm.checkValidity()) {
                    addForm.reportValidity();
                    return false;
                }

                // 3. Calculate selected files and sizes
                const files = getSelectedFilesInfo();
                const totalFiles = files.length;
                const totalBytes = files.reduce((acc, f) => acc + f.size, 0);

                // 4. Setup and open upload loader modal
                const loaderModal = document.getElementById('uploadLoaderModal');
                const fileCountBadge = document.getElementById('loaderFileCountBadge');
                const subtext = document.getElementById('loaderSubtext');
                const progressBar = document.getElementById('uploadProgressBar');
                const percentText = document.getElementById('uploadPercentText');
                const bytesText = document.getElementById('uploadBytesText');
                const tray = document.getElementById('loaderFilesList');
                const listCountBadge = document.getElementById('loaderFilesListCountBadge');
                const statusText = document.getElementById('loaderStatusText');
                const liveStatusBadge = document.getElementById('loaderLiveStatusText');

                if (totalFiles > 0) {
                    fileCountBadge.textContent = `${totalFiles} File${totalFiles > 1 ? 's' : ''}`;
                    listCountBadge.textContent = `${totalFiles} File${totalFiles > 1 ? 's' : ''}`;
                    subtext.textContent = `Uploading ${totalFiles} file${totalFiles > 1 ? 's' : ''} (${formatBytes(totalBytes)} total) to secure storage`;

                    // Render file items inside the tray
                    tray.innerHTML = files.map((f, idx) => {
                        const extLower = f.ext.toLowerCase();
                        let pillClass = 'format-pill-default';
                        if (extLower === 'ai') pillClass = 'format-pill-ai';
                        else if (extLower === 'cdr') pillClass = 'format-pill-cdr';
                        else if (extLower === 'dxf') pillClass = 'format-pill-dxf';
                        else if (extLower === 'eps') pillClass = 'format-pill-eps';
                        else if (extLower === 'pdf') pillClass = 'format-pill-pdf';
                        else if (extLower === 'svg') pillClass = 'format-pill-svg';
                        else if (extLower === 'zip') pillClass = 'format-pill-zip';

                        return `
                            <div class="upload-file-item">
                                <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1">
                                    <span class="format-pill ${pillClass}">.${extLower}</span>
                                    <div class="text-truncate">
                                        <div class="fw-semibold text-dark text-truncate" style="font-size: 0.8rem;">${htmlEscape(f.name)}</div>
                                        <div class="text-muted" style="font-size: 0.72rem;">${htmlEscape(f.type)} &bull; ${formatBytes(f.size)}</div>
                                    </div>
                                </div>
                                <div class="file-item-status" data-idx="${idx}">
                                    <span class="spinner-border spinner-border-sm text-primary" style="width: 14px; height: 14px;"></span>
                                </div>
                            </div>
                        `;
                    }).join('');
                } else {
                    fileCountBadge.textContent = `Product Details`;
                    listCountBadge.textContent = `0 Files`;
                    subtext.textContent = `Saving product catalog record to database...`;
                    tray.innerHTML = `<div class="text-center py-2 text-muted small"><i class="fa-solid fa-cube me-1"></i> Saving product information</div>`;
                }

                // Show modal & prevent navigation
                loaderModal.style.display = 'flex';
                progressBar.style.width = '0%';
                percentText.textContent = '0%';
                bytesText.textContent = `0 B / ${formatBytes(totalBytes)}`;
                statusText.textContent = totalFiles > 0 ? 'Connecting & transferring files to server...' : 'Saving product data...';

                window.onbeforeunload = function() {
                    return 'Files are currently being uploaded. Are you sure you want to exit?';
                };

                // 5. Submit form using XMLHttpRequest for real-time upload progress
                const xhr = new XMLHttpRequest();
                xhr.open('POST', addForm.action, true);

                if (xhr.upload && totalBytes > 0) {
                    xhr.upload.addEventListener('progress', function(ev) {
                        if (ev.lengthComputable) {
                            const percent = Math.min(99, Math.round((ev.loaded / ev.total) * 100));
                            progressBar.style.width = percent + '%';
                            percentText.textContent = percent + '%';
                            bytesText.textContent = `${formatBytes(ev.loaded)} / ${formatBytes(ev.total)}`;

                            if (percent > 0) {
                                statusText.textContent = `Uploading files (${percent}%)... Please do not close this window.`;
                            }
                        }
                    });

                    xhr.upload.addEventListener('load', function() {
                        // All bytes uploaded to server, now processing
                        progressBar.style.width = '100%';
                        percentText.textContent = '100%';
                        bytesText.textContent = `${formatBytes(totalBytes)} / ${formatBytes(totalBytes)}`;
                        statusText.textContent = 'Upload complete! Validating formats and finalizing database entries...';
                        liveStatusBadge.textContent = 'Processing';
                        liveStatusBadge.style.color = '#3b82f6';

                        // Mark all file status icons as uploaded
                        document.querySelectorAll('.file-item-status').forEach(el => {
                            el.innerHTML = '<i class="fa-solid fa-circle-check text-success fs-6"></i>';
                        });
                    });
                } else {
                    progressBar.style.width = '80%';
                    percentText.textContent = '80%';
                }

                xhr.addEventListener('load', function() {
                    window.onbeforeunload = null;
                    if (xhr.status >= 200 && xhr.status < 400) {
                        progressBar.style.width = '100%';
                        percentText.textContent = '100%';
                        statusText.textContent = 'Success! Product created successfully. Redirecting...';
                        liveStatusBadge.textContent = 'Completed';
                        liveStatusBadge.style.color = '#10b981';

                        setTimeout(function() {
                            window.location.href = xhr.responseURL || '<?= base_url("product") ?>';
                        }, 650);
                    } else {
                        loaderModal.style.display = 'none';
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: 'An unexpected server error occurred. Please try again.',
                            confirmButtonColor: '#ff6b35'
                        });
                    }
                });

                xhr.addEventListener('error', function() {
                    window.onbeforeunload = null;
                    loaderModal.style.display = 'none';
                    Swal.fire({
                        icon: 'error',
                        title: 'Network Error',
                        text: 'Upload connection failed. Please check your network and try again.',
                        confirmButtonColor: '#ff6b35'
                    });
                });

                const formData = new FormData(addForm);
                xhr.send(formData);
            });
        }
    });

    function htmlEscape(str) {
        return String(str).replace(/[&<>"']/g, s => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        })[s]);
    }

    function removeSelectedImage() {
        const imageInput = document.getElementById('productImageInput');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const uploadPrompt = document.getElementById('uploadPrompt');

        imageInput.value = '';
        previewImage.src = '';
        previewContainer.style.display = 'none';
        uploadPrompt.style.display = 'block';
        updateLiveFilesSummary();
    }
</script>