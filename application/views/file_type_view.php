<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ==========================================================
       File Types — page scoped (.ft-page / .ft-modal), Poppins only
       Colors come from the existing theme variables
       (--primary, --primary-light, --primary-dark, --primary-gradient)
       with fallbacks.
       ========================================================== */
    .ft-page,
    .ft-modal {
        --ft-primary: var(--primary, #ff6b35);
        --ft-primary-light: var(--primary-light, #fff1ea);
        --ft-primary-dark: var(--primary-dark, #e8501a);
        --ft-gradient: var(--primary-gradient, linear-gradient(135deg, #ff6b35, #ff8a5c));
        --ft-ink: #0f172a;
        --ft-text: #334155;
        --ft-muted: #64748b;
        --ft-faint: #94a3b8;
        --ft-line: #e2e8f0;
        --ft-line-soft: #f1f5f9;
        --ft-soft: #f8fafc;
        --ft-peach-line: #ffd4c2;
        --ft-danger: #dc2626;
        --ft-ring: color-mix(in srgb, var(--ft-primary) 16%, transparent);
        --ft-radius: 18px;
        --ft-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 8px 24px -8px rgba(15, 23, 42, .08);

        font-family: 'Poppins', sans-serif;
        color: var(--ft-text);
        -webkit-font-smoothing: antialiased;
    }

    .ft-page *,
    .ft-page *::before,
    .ft-page *::after,
    .ft-modal *,
    .ft-modal *::before,
    .ft-modal *::after {
        box-sizing: border-box;
    }

    .ft-page h1,
    .ft-page h2,
    .ft-page h3,
    .ft-page h4,
    .ft-page h5,
    .ft-page h6,
    .ft-page p,
    .ft-page span,
    .ft-page a,
    .ft-page button,
    .ft-page label,
    .ft-page div,
    .ft-page input,
    .ft-page select,
    .ft-page th,
    .ft-page td,
    .ft-page small,
    .ft-modal h5,
    .ft-modal p,
    .ft-modal span,
    .ft-modal a,
    .ft-modal button,
    .ft-modal label,
    .ft-modal div,
    .ft-modal input,
    .ft-modal select,
    .ft-modal small,
    .ft-modal strong {
        font-family: 'Poppins', sans-serif;
    }

    /* ---------- Page header ---------- */
    .ft-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .ft-header-main {
        display: flex;
        align-items: center;
        gap: 1rem;
        min-width: 0;
        flex: 1 1 360px;
    }

    .ft-header-ico {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        font-size: 1.3rem;
        color: #fff;
        background: var(--ft-gradient);
        border-radius: 16px;
        box-shadow: 0 10px 20px -10px var(--ft-primary);
    }

    .ft-title {
        margin: 0 0 .25rem;
        font-size: clamp(1.3rem, 1rem + 1.3vw, 1.8rem);
        font-weight: 700;
        line-height: 1.3;
        letter-spacing: -.01em;
        color: var(--ft-ink);
    }

    .ft-subtitle {
        margin: 0;
        font-size: .86rem;
        line-height: 1.6;
        color: var(--ft-muted);
    }

    /* ---------- Buttons ---------- */
    .ft-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: .7rem 1.35rem;
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

    .ft-btn:active {
        transform: translateY(1px);
    }

    .ft-btn-primary {
        color: #fff;
        background: linear-gradient(135deg, var(--ft-primary), var(--ft-primary-dark));
        box-shadow: 0 6px 16px -6px var(--ft-primary);
    }

    .ft-btn-primary:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px -8px var(--ft-primary);
    }

    .ft-btn-light {
        color: var(--ft-text);
        background: #fff;
        border-color: var(--ft-line);
    }

    .ft-btn-light:hover {
        color: var(--ft-ink);
        background: var(--ft-soft);
        border-color: #cbd5e1;
    }

    .ft-btn-sm {
        padding: .5rem 1rem;
        font-size: .8rem;
        border-radius: 10px;
    }

    /* ---------- Main card & toolbar ---------- */
    .ft-card {
        background: #fff;
        border: 1px solid var(--ft-line);
        border-radius: var(--ft-radius);
        box-shadow: var(--ft-shadow);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .ft-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .85rem 1rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--ft-line-soft);
    }

    .ft-search {
        display: flex;
        align-items: center;
        gap: .5rem;
        flex: 1 1 320px;
        max-width: 420px;
        margin: 0;
    }

    .ft-search-wrap {
        position: relative;
        flex: 1 1 auto;
    }

    .ft-search-wrap>i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: .85rem;
        color: var(--ft-faint);
        pointer-events: none;
        transition: color .2s ease;
    }

    .ft-search-wrap:focus-within>i {
        color: var(--ft-primary);
    }

    .ft-search-input {
        width: 100%;
        padding: .62rem 1rem .62rem 2.5rem;
        font-size: .86rem;
        color: var(--ft-ink);
        background: var(--ft-soft);
        border: 1px solid var(--ft-line);
        border-radius: 12px;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .ft-search-input::placeholder {
        color: var(--ft-faint);
    }

    .ft-search-input:focus {
        outline: 0;
        background: #fff;
        border-color: var(--ft-primary);
        box-shadow: 0 0 0 4px var(--ft-ring);
    }

    .ft-clear {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        color: var(--ft-danger);
        background: #fff;
        border: 1px solid #fecaca;
        border-radius: 12px;
        text-decoration: none;
        transition: all .2s ease;
    }

    .ft-clear:hover {
        color: #fff;
        background: var(--ft-danger);
        border-color: var(--ft-danger);
    }

    .ft-count {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .5rem 1rem;
        font-size: .8rem;
        font-weight: 500;
        color: var(--ft-text);
        background: var(--ft-soft);
        border: 1px solid var(--ft-line);
        border-radius: 999px;
        white-space: nowrap;
    }

    .ft-count i {
        color: var(--ft-primary);
    }

    .ft-count strong {
        font-weight: 700;
        color: var(--ft-ink);
    }

    /* ---------- Table ---------- */
    .ft-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .ft-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .ft-table thead th {
        padding: .85rem 1.1rem;
        font-size: .7rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--ft-muted);
        background: var(--ft-soft);
        border-bottom: 1px solid var(--ft-line);
        white-space: nowrap;
    }

    .ft-table tbody td {
        padding: .95rem 1.1rem;
        font-size: .86rem;
        vertical-align: middle;
        color: var(--ft-text);
        border-bottom: 1px solid var(--ft-line-soft);
        background: #fff;
        transition: background .15s ease;
    }

    .ft-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ft-table tbody tr:hover td {
        background: #fffaf7;
    }

    .ft-table .ft-right {
        text-align: right;
    }

    .ft-index {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 30px;
        height: 30px;
        padding: 0 .4rem;
        font-size: .76rem;
        font-weight: 600;
        color: var(--ft-muted);
        background: var(--ft-line-soft);
        border-radius: 8px;
    }

    .ft-ext {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .45rem .85rem;
        font-size: .86rem;
        font-weight: 700;
        color: var(--ft-primary-dark);
        background: var(--ft-primary-light);
        border: 1px solid var(--ft-peach-line);
        border-radius: 10px;
    }

    .ft-ext i {
        font-size: .8rem;
        opacity: .75;
    }

    .ft-name {
        font-size: .92rem;
        font-weight: 600;
        color: var(--ft-ink);
    }

    .ft-mime {
        display: inline-block;
        padding: .3rem .65rem;
        font-size: .74rem;
        font-weight: 500;
        color: var(--ft-muted);
        background: var(--ft-soft);
        border: 1px solid var(--ft-line);
        border-radius: 8px;
        overflow-wrap: anywhere;
    }

    .ft-auto {
        font-size: .8rem;
        font-style: italic;
        color: var(--ft-faint);
    }

    .ft-date {
        font-size: .8rem;
        color: var(--ft-muted);
        white-space: nowrap;
    }

    .ft-page .badge-status {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .4rem .85rem;
        font-size: .76rem;
        font-weight: 600;
        line-height: 1.2;
        border: 1px solid transparent;
        border-radius: 999px;
        text-decoration: none;
        transition: filter .2s ease;
    }

    .ft-page .badge-status:hover {
        filter: brightness(.96);
    }

    .ft-page .badge-status .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .7);
    }

    .ft-page .badge-status.active {
        color: #059669;
        background: #ecfdf5;
        border-color: #a7f3d0;
    }

    .ft-page .badge-status.inactive {
        color: #dc2626;
        background: #fef2f2;
        border-color: #fecaca;
    }

    .ft-actions {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
    }

    .ft-act {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        padding: 0;
        font-size: .85rem;
        background: #fff;
        border: 1px solid var(--ft-line);
        border-radius: 10px;
        cursor: pointer;
        transition: all .2s ease;
    }

    .ft-act-edit {
        color: var(--ft-primary-dark);
        border-color: var(--ft-peach-line);
        background: var(--ft-primary-light);
    }

    .ft-act-edit:hover {
        color: #fff;
        background: var(--ft-primary);
        border-color: var(--ft-primary);
    }

    .ft-act-delete {
        color: var(--ft-danger);
        border-color: #fecaca;
        background: #fef2f2;
    }

    .ft-act-delete:hover {
        color: #fff;
        background: var(--ft-danger);
        border-color: var(--ft-danger);
    }

    .ft-empty-td {
        padding: 3rem 1rem !important;
        text-align: center;
        color: var(--ft-muted);
    }

    .ft-empty-td>i {
        display: block;
        margin-bottom: .75rem;
        font-size: 2.2rem;
        opacity: .5;
    }

    .ft-empty-td p {
        margin: 0 0 1rem;
        font-size: .9rem;
        font-weight: 500;
    }

    /* ---------- Pagination footer ---------- */
    .ft-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .75rem 1rem;
        padding: 1rem 1.25rem;
        background: #fff;
        border-top: 1px solid var(--ft-line-soft);
    }

    .ft-foot-text {
        font-size: .8rem;
        color: var(--ft-muted);
    }

    .ft-foot-text strong {
        font-weight: 600;
        color: var(--ft-ink);
    }

    .ft-page .pagination {
        gap: .3rem;
        margin: 0;
        flex-wrap: wrap;
    }

    .ft-page .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 .6rem;
        font-size: .82rem;
        font-weight: 600;
        color: var(--ft-text);
        background: #fff;
        border: 1px solid var(--ft-line);
        border-radius: 10px !important;
        box-shadow: none;
        transition: all .2s ease;
    }

    .ft-page .page-link:hover {
        color: var(--ft-primary-dark);
        background: var(--ft-primary-light);
        border-color: var(--ft-peach-line);
    }

    .ft-page .page-item.active .page-link {
        color: #fff;
        background: linear-gradient(135deg, var(--ft-primary), var(--ft-primary-dark));
        border-color: transparent;
        box-shadow: 0 6px 14px -6px var(--ft-primary);
    }

    .ft-page .page-item.disabled .page-link {
        color: var(--ft-faint);
        background: var(--ft-soft);
        border-color: var(--ft-line);
    }

    /* ==========================================================
       Modals (add / edit)
       ========================================================== */
    .ft-modal .modal-content {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 30px 60px -20px rgba(15, 23, 42, .35);
    }

    .ft-modal-head {
        display: flex;
        align-items: center;
        gap: .9rem;
        padding: 1.15rem 1.4rem;
        color: #fff;
        background: var(--ft-gradient);
        border: 0;
    }

    .ft-modal-ico {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        font-size: 1.05rem;
        color: #fff;
        background: rgba(255, 255, 255, .22);
        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 14px;
    }

    .ft-modal-titles {
        min-width: 0;
        flex: 1 1 auto;
    }

    .ft-modal-titles .modal-title {
        margin: 0;
        font-size: 1.08rem;
        font-weight: 700;
        line-height: 1.3;
        color: #fff;
    }

    .ft-modal-titles p {
        margin: .1rem 0 0;
        font-size: .78rem;
        font-weight: 400;
        color: rgba(255, 255, 255, .88);
    }

    .ft-modal-head .btn-close {
        margin: 0;
        flex: 0 0 auto;
        opacity: .9;
    }

    .ft-modal .modal-body {
        padding: 1.4rem;
    }

    .ft-modal .modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .6rem;
        padding: 1rem 1.4rem;
        background: var(--ft-soft);
        border-top: 1px solid var(--ft-line);
    }

    .ft-modal .modal-footer>* {
        margin: 0;
    }

    .ft-chips-label {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: .55rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--ft-ink);
    }

    .ft-chips-label i {
        color: #f59e0b;
    }

    .ft-chips {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        max-height: 150px;
        overflow-y: auto;
        padding: .7rem;
        margin-bottom: 1.25rem;
        background: var(--ft-soft);
        border: 1px solid var(--ft-line);
        border-radius: 14px;
    }

    .suggestion-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .35rem .8rem;
        font-size: .78rem;
        font-weight: 500;
        color: var(--ft-text);
        background: #fff;
        border: 1px solid var(--ft-line);
        border-radius: 999px;
        cursor: pointer;
        user-select: none;
        transition: all .18s ease;
    }

    .suggestion-chip:hover {
        color: var(--ft-primary-dark);
        background: var(--ft-primary-light);
        border-color: var(--ft-peach-line);
        transform: translateY(-1px);
    }

    .suggestion-chip .badge-ext {
        font-weight: 700;
        color: var(--ft-primary);
    }

    .ft-modal .form-label {
        display: block;
        margin-bottom: .45rem;
        font-size: .82rem;
        font-weight: 600;
        color: var(--ft-ink);
    }

    .ft-req {
        color: #ef4444;
        margin-left: 2px;
    }

    .ft-opt {
        font-weight: 400;
        color: var(--ft-faint);
    }

    .ft-modal .form-control,
    .ft-modal .form-select {
        width: 100%;
        padding: .72rem .95rem;
        font-size: .9rem;
        line-height: 1.5;
        color: var(--ft-ink);
        background-color: #fff;
        border: 1px solid var(--ft-line);
        border-radius: 12px;
        box-shadow: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .ft-modal .form-select {
        padding-right: 2.4rem;
    }

    .ft-modal .form-control::placeholder {
        color: var(--ft-faint);
    }

    .ft-modal .form-control:hover,
    .ft-modal .form-select:hover {
        border-color: #cbd5e1;
    }

    .ft-modal .form-control:focus,
    .ft-modal .form-select:focus {
        outline: 0;
        border-color: var(--ft-primary);
        box-shadow: 0 0 0 4px var(--ft-ring);
    }

    .ft-input-icon {
        position: relative;
    }

    .ft-input-icon>i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: .88rem;
        color: var(--ft-faint);
        pointer-events: none;
        transition: color .2s ease;
    }

    .ft-input-icon .form-control {
        padding-left: 2.6rem;
    }

    .ft-input-icon:focus-within>i {
        color: var(--ft-primary);
    }

    .ft-hint {
        margin-top: .4rem;
        font-size: .75rem;
        color: var(--ft-faint);
    }

    /* Live autocomplete dropdown */
    .live-suggestions-box {
        position: absolute;
        top: calc(100% - 1.4rem);
        left: calc(var(--bs-gutter-x, 1.5rem) * .5);
        right: calc(var(--bs-gutter-x, 1.5rem) * .5);
        display: none;
        max-height: 230px;
        overflow-y: auto;
        background: #fff;
        border: 1px solid var(--ft-line);
        border-radius: 12px;
        box-shadow: 0 18px 36px -12px rgba(15, 23, 42, .25);
        z-index: 1060;
    }

    .live-suggestion-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        padding: .65rem .95rem;
        font-size: .84rem;
        cursor: pointer;
        border-bottom: 1px solid var(--ft-line-soft);
        transition: background .15s ease;
    }

    .live-suggestion-item:last-child {
        border-bottom: none;
    }

    .live-suggestion-item:hover,
    .live-suggestion-item.active {
        background: var(--ft-primary-light);
        color: var(--ft-primary-dark);
    }

    .ft-sug-main {
        min-width: 0;
        display: flex;
        align-items: baseline;
        flex-wrap: wrap;
        gap: .1rem .5rem;
    }

    .ft-sug-ext {
        font-weight: 700;
        color: var(--ft-primary);
    }

    .ft-sug-name {
        color: var(--ft-ink);
        overflow-wrap: anywhere;
    }

    .ft-sug-cat {
        flex: 0 0 auto;
        padding: .15rem .55rem;
        font-size: .68rem;
        font-weight: 600;
        color: var(--ft-muted);
        background: var(--ft-soft);
        border: 1px solid var(--ft-line);
        border-radius: 999px;
    }

    /* ---------- Tablet & mobile ---------- */
    @media (max-width: 991.98px) {

        .ft-table thead th,
        .ft-table tbody td {
            padding-left: .8rem;
            padding-right: .8rem;
        }
    }

    @media (max-width: 767.98px) {
        .ft-header {
            margin-bottom: 1.1rem;
        }

        .ft-header>.ft-btn {
            width: 100%;
        }

        .ft-header-ico {
            width: 46px;
            height: 46px;
            font-size: 1.1rem;
            border-radius: 14px;
        }

        .ft-toolbar {
            padding: .9rem;
        }

        .ft-search {
            flex: 1 1 100%;
            max-width: none;
        }

        .ft-count {
            width: 100%;
            justify-content: center;
        }

        /* table → cards */
        .ft-table-wrap {
            overflow: visible;
        }

        .ft-table,
        .ft-table tbody {
            display: block;
        }

        .ft-table thead {
            display: none;
        }

        .ft-table tbody {
            padding: .75rem;
            display: grid;
            gap: .75rem;
            background: var(--ft-soft);
        }

        .ft-table tbody tr {
            display: block;
            padding: .35rem 1rem .5rem;
            background: #fff;
            border: 1px solid var(--ft-line);
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .04);
        }

        .ft-table tbody tr:hover td {
            background: transparent;
        }

        .ft-table tbody td {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: .65rem 0;
            border-bottom: 1px dashed var(--ft-line);
            text-align: right;
        }

        .ft-table tbody td[data-label]::before {
            content: attr(data-label);
            flex: 0 0 auto;
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--ft-faint);
            text-align: left;
        }

        .ft-table tbody td.ft-td-index {
            display: none;
        }

        .ft-table tbody td.ft-td-actions {
            border-bottom: none;
            padding-bottom: .35rem;
        }

        .ft-table tbody td.ft-td-actions .ft-actions {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .ft-table tbody td.ft-td-actions .ft-act {
            width: 100%;
        }

        .ft-table tbody td.ft-td-actions::before {
            display: none;
        }

        .ft-table tbody tr:last-child td {
            border-bottom: 1px dashed var(--ft-line);
        }

        .ft-table tbody tr:last-child td.ft-td-actions {
            border-bottom: none;
        }

        .ft-table tbody td.ft-td-empty {
            display: block;
            border-bottom: none;
        }

        .ft-table tbody tr:has(.ft-empty-td) {
            padding: 0;
        }

        .ft-foot {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
            padding: 1rem .9rem;
        }

        .ft-page .pagination {
            justify-content: center;
        }
    }

    @media (max-width: 575.98px) {
        .ft-modal .modal-dialog {
            margin: .75rem;
        }

        .ft-modal-head {
            padding: 1rem;
        }

        .ft-modal .modal-body {
            padding: 1.1rem 1rem;
        }

        .ft-modal .modal-footer {
            flex-direction: column-reverse;
            align-items: stretch;
            padding: .9rem 1rem;
        }

        .ft-modal .modal-footer .ft-btn {
            width: 100%;
        }

        .ft-chips {
            max-height: 128px;
        }

        .live-suggestions-box {
            max-height: 200px;
        }
    }
</style>

<div class="ft-page">

    <!-- Page Header -->
    <div class="ft-header">
        <div class="ft-header-main">
            <span class="ft-header-ico"><i class="fa-solid fa-file-code"></i></span>
            <div>
                <h3 class="ft-title">File Types</h3>
                <p class="ft-subtitle">Manage allowed design, vector, 3D, and media file formats (.png, .jpg, .zip, .cdr, .dxf, .ai, etc.).</p>
            </div>
        </div>
        <button type="button" class="ft-btn ft-btn-primary" data-bs-toggle="modal" data-bs-target="#addFileTypeModal">
            <i class="fa-solid fa-plus"></i> Add File Type
        </button>
    </div>

    <div class="custom-card ft-card">
        <!-- Modern Toolbar -->
        <div class="ft-toolbar">
            <form action="<?= base_url('file_type') ?>" method="GET" class="ft-search">
                <div class="ft-search-wrap">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" class="ft-search-input" placeholder="Search by name, .cdr, .dxf, .png..." value="<?= isset($search) ? html_escape($search) : '' ?>">
                </div>
                <?php if (!empty($search)): ?>
                    <a href="<?= base_url('file_type') ?>" class="ft-clear" title="Clear search">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                <?php endif; ?>
            </form>

            <div class="ft-count">
                <i class="fa-solid fa-file-code"></i>
                <span>Total: <strong><?= isset($total_rows) ? $total_rows : count($file_types) ?></strong> file types</span>
            </div>
        </div>

        <!-- File Types Table -->
        <div class="ft-table-wrap">
            <table class="ft-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th style="width: 150px;">File Extension</th>
                        <th>File Type Name</th>
                        <th>MIME Type</th>
                        <th style="width: 130px;">Status</th>
                        <th style="width: 140px;">Created At</th>
                        <th class="ft-right" style="width: 110px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($file_types)): ?>
                        <?php foreach ($file_types as $key => $ft): ?>
                            <tr>
                                <td class="ft-td-index" data-label="#">
                                    <span class="ft-index"><?= (isset($current_page) ? ($current_page - 1) * $per_page : 0) + $key + 1 ?></span>
                                </td>
                                <td data-label="Extension">
                                    <span class="ft-ext">
                                        <i class="fa-solid fa-file-lines"></i><?= html_escape($ft->extension) ?>
                                    </span>
                                </td>
                                <td data-label="Name">
                                    <div class="ft-name"><?= html_escape($ft->name) ?></div>
                                </td>
                                <td data-label="MIME Type">
                                    <?php if (!empty($ft->mime_type)): ?>
                                        <span class="ft-mime"><?= html_escape($ft->mime_type) ?></span>
                                    <?php else: ?>
                                        <span class="ft-auto">Auto</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Status">
                                    <a href="<?= base_url('file_type/status/' . $ft->id) ?>" class="badge-status <?= ((int)$ft->status === 1) ? 'active' : 'inactive' ?>" title="Click to toggle status">
                                        <span class="status-dot"></span>
                                        <span><?= ((int)$ft->status === 1) ? 'Active' : 'Inactive' ?></span>
                                    </a>
                                </td>
                                <td data-label="Created">
                                    <span class="ft-date"><?= date('M d, Y', strtotime($ft->created_at)) ?></span>
                                </td>
                                <td class="ft-right ft-td-actions">
                                    <div class="ft-actions">
                                        <button type="button"
                                            class="ft-act ft-act-edit editFileTypeBtn"
                                            data-id="<?= $ft->id ?>"
                                            data-name="<?= html_escape($ft->name) ?>"
                                            data-extension="<?= html_escape($ft->extension) ?>"
                                            data-mime-type="<?= html_escape($ft->mime_type) ?>"
                                            data-status="<?= $ft->status ?>"
                                            title="Edit File Type">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button"
                                            class="ft-act ft-act-delete"
                                            onclick="confirmDelete('<?= base_url('file_type/delete/' . $ft->id) ?>', 'File Type &quot;<?= addslashes(html_escape($ft->extension)) ?>&quot;')"
                                            title="Delete File Type">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="ft-empty-td ft-td-empty">
                                <i class="fa-solid fa-file-circle-question"></i>
                                <p>No file types configured yet.</p>
                                <button type="button" class="ft-btn ft-btn-sm ft-btn-primary" data-bs-toggle="modal" data-bs-target="#addFileTypeModal">
                                    <i class="fa-solid fa-plus"></i> Add First File Type
                                </button>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <?php if (isset($total_pages) && $total_pages > 1): ?>
            <div class="ft-foot">
                <div class="ft-foot-text">
                    Showing <strong><?= ($total_rows > 0) ? (($current_page - 1) * $per_page + 1) : 0 ?></strong> to
                    <strong><?= min($current_page * $per_page, $total_rows) ?></strong> of
                    <strong><?= $total_rows ?></strong> file types
                </div>

                <nav aria-label="File types pagination">
                    <ul class="pagination pagination-sm mb-0 align-items-center">
                        <!-- Previous Button -->
                        <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= ($current_page > 1) ? base_url('file_type?' . http_build_query(array_merge($_GET, ['page' => $current_page - 1]))) : '#' ?>" aria-label="Previous">
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
                                    <a class="page-link" href="<?= base_url('file_type?' . http_build_query(array_merge($_GET, ['page' => $p]))) ?>"><?= $p ?></a>
                                </li>
                        <?php endif;
                        endforeach; ?>

                        <!-- Next Button -->
                        <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= ($current_page < $total_pages) ? base_url('file_type?' . http_build_query(array_merge($_GET, ['page' => $current_page + 1]))) : '#' ?>" aria-label="Next">
                                <i class="fa-solid fa-chevron-right small"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php elseif (isset($total_rows) && $total_rows > 0): ?>
            <div class="ft-foot">
                <div class="ft-foot-text">
                    Showing <strong>1</strong> to <strong><?= $total_rows ?></strong> of <strong><?= $total_rows ?></strong> file types
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- ================= ADD FILE TYPE MODAL ================= -->
<div class="modal fade ft-modal" id="addFileTypeModal" tabindex="-1" aria-labelledby="addFileTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header ft-modal-head">
                <span class="ft-modal-ico"><i class="fa-solid fa-file-circle-plus"></i></span>
                <div class="ft-modal-titles">
                    <h5 class="modal-title" id="addFileTypeModalLabel">Add New File Type</h5>
                    <p>Pick a suggestion or enter the details manually.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('file_type/save') ?>" method="POST" autocomplete="off" id="addFileTypeForm" class="d-flex flex-column" style="min-height: 0;">
                <div class="modal-body">
                    <!-- Quick Suggestions Chips Header -->
                    <div class="ft-chips-label">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>Popular Suggestions (Click to Auto-fill):
                    </div>
                    <div class="ft-chips" id="addQuickChips">
                        <!-- Populated via JavaScript with .cdr, .dxf, .ai, .png, etc. -->
                    </div>

                    <div class="row g-3">
                        <!-- File Extension with Live Autocomplete -->
                        <div class="col-12 col-md-6 position-relative">
                            <label for="addExtension" class="form-label">File Extension <span class="ft-req">*</span></label>
                            <div class="ft-input-icon">
                                <i class="fa-solid fa-file"></i>
                                <input type="text" class="form-control" id="addExtension" name="extension" placeholder="e.g. .cdr, .dxf, .ai, .png, .zip" required autofocus>
                            </div>
                            <div class="ft-hint">Dot is optional (e.g. cdr or .cdr).</div>
                            <!-- Live suggestions dropdown -->
                            <div class="live-suggestions-box" id="addExtensionSuggestions"></div>
                        </div>

                        <!-- File Type Name -->
                        <div class="col-12 col-md-6 position-relative">
                            <label for="addName" class="form-label">File Type Name <span class="ft-req">*</span></label>
                            <div class="ft-input-icon">
                                <i class="fa-solid fa-tag"></i>
                                <input type="text" class="form-control" id="addName" name="name" placeholder="e.g. CorelDRAW Drawing, AutoCAD DXF" required>
                            </div>
                            <div class="ft-hint">Descriptive title for display.</div>
                            <!-- Live suggestions dropdown -->
                            <div class="live-suggestions-box" id="addNameSuggestions"></div>
                        </div>

                        <!-- MIME Type (Optional) -->
                        <div class="col-12 col-md-6">
                            <label for="addMimeType" class="form-label">MIME Type <span class="ft-opt">(Optional)</span></label>
                            <div class="ft-input-icon">
                                <i class="fa-solid fa-code"></i>
                                <input type="text" class="form-control" id="addMimeType" name="mime_type" placeholder="e.g. application/cdr, image/png">
                            </div>
                            <div class="ft-hint">Browser content-type identification.</div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-6">
                            <label for="addStatus" class="form-label">Status <span class="ft-req">*</span></label>
                            <select class="form-select" id="addStatus" name="status" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ft-btn ft-btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="ft-btn ft-btn-primary">
                        <i class="fa-solid fa-check"></i> Save File Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= EDIT FILE TYPE MODAL ================= -->
<div class="modal fade ft-modal" id="editFileTypeModal" tabindex="-1" aria-labelledby="editFileTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header ft-modal-head">
                <span class="ft-modal-ico"><i class="fa-solid fa-pen-to-square"></i></span>
                <div class="ft-modal-titles">
                    <h5 class="modal-title" id="editFileTypeModalLabel">Edit File Type</h5>
                    <p>Update the extension, name, MIME type or status.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('file_type/save') ?>" method="POST" autocomplete="off" id="editFileTypeForm" class="d-flex flex-column" style="min-height: 0;">
                <input type="hidden" name="file_type_id" id="editFileTypeId">
                <div class="modal-body">
                    <!-- Quick Suggestions Chips Header -->
                    <div class="ft-chips-label">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>Quick Suggestions:
                    </div>
                    <div class="ft-chips" id="editQuickChips">
                        <!-- Populated via JavaScript -->
                    </div>

                    <div class="row g-3">
                        <!-- File Extension with Live Autocomplete -->
                        <div class="col-12 col-md-6 position-relative">
                            <label for="editExtension" class="form-label">File Extension <span class="ft-req">*</span></label>
                            <div class="ft-input-icon">
                                <i class="fa-solid fa-file"></i>
                                <input type="text" class="form-control" id="editExtension" name="extension" required>
                            </div>
                            <div class="live-suggestions-box" id="editExtensionSuggestions"></div>
                        </div>

                        <!-- File Type Name -->
                        <div class="col-12 col-md-6 position-relative">
                            <label for="editName" class="form-label">File Type Name <span class="ft-req">*</span></label>
                            <div class="ft-input-icon">
                                <i class="fa-solid fa-tag"></i>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                            <div class="live-suggestions-box" id="editNameSuggestions"></div>
                        </div>

                        <!-- MIME Type (Optional) -->
                        <div class="col-12 col-md-6">
                            <label for="editMimeType" class="form-label">MIME Type <span class="ft-opt">(Optional)</span></label>
                            <div class="ft-input-icon">
                                <i class="fa-solid fa-code"></i>
                                <input type="text" class="form-control" id="editMimeType" name="mime_type">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-6">
                            <label for="editStatus" class="form-label">Status <span class="ft-req">*</span></label>
                            <select class="form-select" id="editStatus" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ft-btn ft-btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="ft-btn ft-btn-primary">
                        <i class="fa-solid fa-check"></i> Update File Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Comprehensive Dictionary of File Types (Vector, Cutting, Raster, CAD, 3D, Archives)
    const FILE_TYPES_DIRECTORY = [
        // Vector & Cutting / CNC Files
        {
            ext: '.cdr',
            name: 'CorelDRAW Vector Drawing',
            mime: 'application/cdr',
            category: 'Vector'
        },
        {
            ext: '.dxf',
            name: 'AutoCAD DXF (Laser / CNC)',
            mime: 'image/vnd.dxf',
            category: 'CAD / CNC'
        },
        {
            ext: '.ai',
            name: 'Adobe Illustrator Artwork',
            mime: 'application/illustrator',
            category: 'Vector'
        },
        {
            ext: '.svg',
            name: 'Scalable Vector Graphics',
            mime: 'image/svg+xml',
            category: 'Vector'
        },
        {
            ext: '.eps',
            name: 'Encapsulated PostScript',
            mime: 'application/postscript',
            category: 'Vector'
        },
        {
            ext: '.dwg',
            name: 'AutoCAD Drawing Database',
            mime: 'image/vnd.dwg',
            category: 'CAD / CNC'
        },
        {
            ext: '.plt',
            name: 'HPGL Plotter File',
            mime: 'application/x-hpgl',
            category: 'Plotter'
        },
        {
            ext: '.art',
            name: 'ArtCAM Model',
            mime: 'application/octet-stream',
            category: 'CNC'
        },
        {
            ext: '.nc',
            name: 'G-Code CNC Numerical Control',
            mime: 'text/x-gcode',
            category: 'CNC'
        },

        // Images & Graphics
        {
            ext: '.png',
            name: 'Portable Network Graphics (PNG)',
            mime: 'image/png',
            category: 'Image'
        },
        {
            ext: '.jpg',
            name: 'JPEG Image',
            mime: 'image/jpeg',
            category: 'Image'
        },
        {
            ext: '.jpeg',
            name: 'JPEG High Quality Image',
            mime: 'image/jpeg',
            category: 'Image'
        },
        {
            ext: '.webp',
            name: 'WebP Modern Image Format',
            mime: 'image/webp',
            category: 'Image'
        },
        {
            ext: '.psd',
            name: 'Adobe Photoshop Document',
            mime: 'image/vnd.adobe.photoshop',
            category: 'Image'
        },
        {
            ext: '.bmp',
            name: 'Bitmap Image',
            mime: 'image/bmp',
            category: 'Image'
        },
        {
            ext: '.tiff',
            name: 'Tagged Image File (TIFF)',
            mime: 'image/tiff',
            category: 'Image'
        },
        {
            ext: '.gif',
            name: 'Graphics Interchange Format (GIF)',
            mime: 'image/gif',
            category: 'Image'
        },

        // 3D & Fabrication
        {
            ext: '.stl',
            name: 'Stereolithography 3D (3D Print/CNC)',
            mime: 'model/stl',
            category: '3D'
        },
        {
            ext: '.obj',
            name: 'Wavefront 3D Object',
            mime: 'model/obj',
            category: '3D'
        },
        {
            ext: '.step',
            name: 'STEP 3D CAD Exchange',
            mime: 'application/step',
            category: '3D'
        },
        {
            ext: '.stp',
            name: 'STEP 3D Standard Model',
            mime: 'application/step',
            category: '3D'
        },
        {
            ext: '.iges',
            name: 'IGES 3D Surface Model',
            mime: 'model/iges',
            category: '3D'
        },

        // Archives & Documents
        {
            ext: '.zip',
            name: 'ZIP Compressed Archive',
            mime: 'application/zip',
            category: 'Archive'
        },
        {
            ext: '.rar',
            name: 'RAR Compressed Archive',
            mime: 'application/vnd.rar',
            category: 'Archive'
        },
        {
            ext: '.7z',
            name: '7-Zip Compressed Archive',
            mime: 'application/x-7z-compressed',
            category: 'Archive'
        },
        {
            ext: '.pdf',
            name: 'Portable Document Format (PDF)',
            mime: 'application/pdf',
            category: 'Document'
        },
        {
            ext: '.tar',
            name: 'Tarball Archive',
            mime: 'application/x-tar',
            category: 'Archive'
        }
    ];

    document.addEventListener('DOMContentLoaded', function() {
        // Render Quick Chips in Add and Edit modals
        function renderChips(containerId, formPrefix) {
            const container = document.getElementById(containerId);
            if (!container) return;

            const popular = ['.cdr', '.dxf', '.ai', '.png', '.jpg', '.jpeg', '.zip', '.svg', '.eps', '.pdf', '.dwg', '.stl', '.psd', '.webp', '.7z'];
            let html = '';
            popular.forEach(ext => {
                const item = FILE_TYPES_DIRECTORY.find(f => f.ext === ext);
                if (item) {
                    html += `
                        <div class="suggestion-chip" title="${item.name}" data-ext="${item.ext}" data-name="${item.name}" data-mime="${item.mime}" data-prefix="${formPrefix}">
                            <span class="badge-ext">${item.ext}</span>
                            <span>${item.name.split(' ')[0]}</span>
                        </div>
                    `;
                }
            });
            container.innerHTML = html;
        }

        renderChips('addQuickChips', 'add');
        renderChips('editQuickChips', 'edit');

        // Chip click handler: Auto-fill form
        document.addEventListener('click', function(e) {
            const chip = e.target.closest('.suggestion-chip');
            if (chip) {
                const prefix = chip.dataset.prefix;
                const extInput = document.getElementById(prefix + 'Extension');
                const nameInput = document.getElementById(prefix + 'Name');
                const mimeInput = document.getElementById(prefix + 'MimeType');

                if (extInput) extInput.value = chip.dataset.ext;
                if (nameInput) nameInput.value = chip.dataset.name;
                if (mimeInput) mimeInput.value = chip.dataset.mime;

                // Close suggestions box
                const extBox = document.getElementById(prefix + 'ExtensionSuggestions');
                const nameBox = document.getElementById(prefix + 'NameSuggestions');
                if (extBox) extBox.style.display = 'none';
                if (nameBox) nameBox.style.display = 'none';
            }
        });

        // Setup Live Autocomplete for an input
        function setupAutocomplete(inputId, boxId, formPrefix, searchProp) {
            const input = document.getElementById(inputId);
            const box = document.getElementById(boxId);
            if (!input || !box) return;

            input.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim().replace(/^\./, '');
                if (!query) {
                    box.style.display = 'none';
                    return;
                }

                // Filter matches
                const matches = FILE_TYPES_DIRECTORY.filter(f => {
                    const cleanExt = f.ext.replace(/^\./, '').toLowerCase();
                    const cleanName = f.name.toLowerCase();
                    return cleanExt.includes(query) || cleanName.includes(query);
                });

                if (matches.length === 0) {
                    box.style.display = 'none';
                    return;
                }

                let itemsHtml = '';
                matches.forEach(item => {
                    itemsHtml += `
                        <div class="live-suggestion-item" data-ext="${item.ext}" data-name="${item.name}" data-mime="${item.mime}" data-prefix="${formPrefix}">
                            <div class="ft-sug-main">
                                <strong class="ft-sug-ext">${item.ext}</strong>
                                <span class="ft-sug-name">${item.name}</span>
                            </div>
                            <span class="ft-sug-cat">${item.category}</span>
                        </div>
                    `;
                });

                box.innerHTML = itemsHtml;
                box.style.display = 'block';
            });

            // Click outside to close
            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !box.contains(e.target)) {
                    box.style.display = 'none';
                }
            });

            // Click on suggestion item
            box.addEventListener('click', function(e) {
                const item = e.target.closest('.live-suggestion-item');
                if (item) {
                    const extInput = document.getElementById(formPrefix + 'Extension');
                    const nameInput = document.getElementById(formPrefix + 'Name');
                    const mimeInput = document.getElementById(formPrefix + 'MimeType');

                    if (extInput) extInput.value = item.dataset.ext;
                    if (nameInput) nameInput.value = item.dataset.name;
                    if (mimeInput) mimeInput.value = item.dataset.mime;

                    box.style.display = 'none';
                }
            });
        }

        // Setup autocomplete for Add modal
        setupAutocomplete('addExtension', 'addExtensionSuggestions', 'add', 'ext');
        setupAutocomplete('addName', 'addNameSuggestions', 'add', 'name');

        // Setup autocomplete for Edit modal
        setupAutocomplete('editExtension', 'editExtensionSuggestions', 'edit', 'ext');
        setupAutocomplete('editName', 'editNameSuggestions', 'edit', 'name');

        // Populate Edit Modal
        const editButtons = document.querySelectorAll('.editFileTypeBtn');
        const editModal = new bootstrap.Modal(document.getElementById('editFileTypeModal'));
        const editIdInput = document.getElementById('editFileTypeId');
        const editExtInput = document.getElementById('editExtension');
        const editNameInput = document.getElementById('editName');
        const editMimeInput = document.getElementById('editMimeType');
        const editStatusInput = document.getElementById('editStatus');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                editIdInput.value = this.dataset.id;
                editExtInput.value = this.dataset.extension;
                editNameInput.value = this.dataset.name;
                editMimeInput.value = this.dataset.mimeType || '';
                editStatusInput.value = this.dataset.status;
                editModal.show();
            });
        });
    });
</script>