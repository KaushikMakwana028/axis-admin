<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ==========================================================
       Dashboard — page scoped (.db-page), Poppins only
       Colors come from the existing theme variables
       (--primary, --primary-light, --primary-dark) with fallbacks.
       ========================================================== */
    .db-page {
        --db-primary: var(--primary, #ff6b35);
        --db-primary-light: var(--primary-light, #fff1ea);
        --db-primary-dark: var(--primary-dark, #e8501a);
        --db-ink: #0f172a;
        --db-text: #334155;
        --db-muted: #64748b;
        --db-faint: #94a3b8;
        --db-line: #e2e8f0;
        --db-line-soft: #f1f5f9;
        --db-soft: #f8fafc;
        --db-peach-line: #ffd4c2;
        --db-purple: #8b5cf6;
        --db-green: #10b981;
        --db-blue: #3b82f6;
        --db-radius: 18px;
        --db-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 8px 24px -10px rgba(15, 23, 42, .08);

        font-family: 'Poppins', sans-serif;
        color: var(--db-text);
        -webkit-font-smoothing: antialiased;
    }

    .db-page *,
    .db-page *::before,
    .db-page *::after {
        box-sizing: border-box;
    }

    .db-page h1,
    .db-page h2,
    .db-page h3,
    .db-page h4,
    .db-page h5,
    .db-page h6,
    .db-page p,
    .db-page span,
    .db-page a,
    .db-page button,
    .db-page div,
    .db-page th,
    .db-page td,
    .db-page small,
    .db-page strong {
        font-family: 'Poppins', sans-serif;
    }

    /* ---------- Buttons ---------- */
    .db-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: .65rem 1.2rem;
        font-size: .84rem;
        font-weight: 600;
        line-height: 1.2;
        border: 1px solid transparent;
        border-radius: 12px;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
        transition: transform .15s ease, box-shadow .2s ease, background .2s ease, border-color .2s ease, color .2s ease;
    }

    .db-btn:active {
        transform: translateY(1px);
    }

    .db-btn-primary {
        color: #fff;
        background: linear-gradient(135deg, var(--db-primary), var(--db-primary-dark));
        box-shadow: 0 6px 16px -6px var(--db-primary);
    }

    .db-btn-primary:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px -8px var(--db-primary);
    }

    .db-btn-outline {
        color: var(--db-primary-dark);
        background: #fff;
        border-color: var(--db-peach-line);
    }

    .db-btn-outline:hover {
        color: #fff;
        background: var(--db-primary);
        border-color: var(--db-primary);
    }

    .db-btn-light {
        color: var(--db-text);
        background: #fff;
        border-color: var(--db-line);
    }

    .db-btn-light:hover {
        color: var(--db-ink);
        background: var(--db-soft);
        border-color: #cbd5e1;
    }

    .db-btn-light i {
        color: var(--db-primary);
    }

    .db-btn-sm {
        padding: .45rem .9rem;
        font-size: .78rem;
        border-radius: 10px;
    }

    /* ---------- Hero ---------- */
    .db-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(1.1rem, .7rem + 1.6vw, 1.75rem);
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #fff7f2 100%);
        border: 1px solid #ffe2d4;
        border-radius: 22px;
        box-shadow: 0 8px 30px -12px rgba(255, 107, 53, .18);
    }

    .db-hero::after {
        content: '';
        position: absolute;
        top: -60px;
        right: -50px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(255, 107, 53, .16) 0%, rgba(255, 107, 53, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .db-hero-inner {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.1rem 1.5rem;
    }

    .db-hero-main {
        min-width: 0;
        flex: 1 1 380px;
    }

    .db-live {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: .6rem;
        padding: .3rem .75rem;
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #059669;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 999px;
    }

    .db-pulse {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, .7);
        animation: db-pulse 1.8s infinite;
    }

    @keyframes db-pulse {
        0% {
            transform: scale(.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, .7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
        }

        100% {
            transform: scale(.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }

    .db-hero-title {
        margin: 0 0 .4rem;
        font-size: clamp(1.35rem, 1rem + 1.6vw, 2rem);
        font-weight: 700;
        line-height: 1.25;
        letter-spacing: -.02em;
        color: var(--db-ink);
        overflow-wrap: anywhere;
    }

    .db-hero-sub {
        margin: 0;
        max-width: 560px;
        font-size: .86rem;
        line-height: 1.65;
        color: var(--db-muted);
    }

    .db-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
    }

    /* ---------- Metric cards ---------- */
    .db-metric {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.3rem;
        background: #fff;
        border: 1px solid var(--db-line);
        border-radius: var(--db-radius);
        box-shadow: var(--db-shadow);
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .db-metric:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 18px 32px -14px rgba(15, 23, 42, .18);
    }

    .db-metric-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .75rem;
    }

    .db-metric-label {
        display: block;
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--db-muted);
    }

    .db-metric-value {
        margin-top: .35rem;
        font-size: clamp(1.6rem, 1.2rem + 1vw, 2.1rem);
        font-weight: 700;
        line-height: 1.15;
        letter-spacing: -.02em;
        color: var(--db-ink);
        font-variant-numeric: tabular-nums;
        overflow-wrap: anywhere;
    }

    .db-metric-ico {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
        border-radius: 15px;
    }

    .db-metric-chips {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .45rem;
        margin-top: .85rem;
        min-height: 28px;
    }

    .db-metric-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .4rem .75rem;
        margin-top: 1rem;
        padding-top: .9rem;
        border-top: 1px solid var(--db-line-soft);
    }

    .db-link {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .8rem;
        font-weight: 600;
        text-decoration: none;
        transition: gap .2s ease;
    }

    .db-link:hover {
        gap: .6rem;
    }

    .db-foot-note {
        font-size: .76rem;
        color: var(--db-muted);
        text-decoration: none;
        white-space: nowrap;
    }

    a.db-foot-note:hover {
        color: var(--db-ink);
    }

    .db-chip {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .28rem .7rem;
        font-size: .72rem;
        font-weight: 600;
        line-height: 1.3;
        border: 1px solid transparent;
        border-radius: 999px;
    }

    .db-chip-purple {
        color: #7e22ce;
        background: #f3e8ff;
        border-color: #e9d5ff;
    }

    .db-chip-green {
        color: #15803d;
        background: #dcfce7;
        border-color: #bbf7d0;
    }

    .db-chip-blue {
        color: #1d4ed8;
        background: #dbeafe;
        border-color: #bfdbfe;
    }

    .db-chip-note {
        padding: 0;
        font-weight: 500;
        color: var(--db-muted);
    }

    /* ---------- Panels (chart & table cards) ---------- */
    .db-panel {
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--db-line);
        border-radius: var(--db-radius);
        box-shadow: var(--db-shadow);
    }

    .db-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .75rem 1rem;
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid var(--db-line-soft);
    }

    .db-panel-head-main {
        min-width: 0;
        flex: 1 1 220px;
    }

    .db-panel-title {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .6rem;
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: var(--db-ink);
    }

    .db-panel-ico {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        font-size: .88rem;
        border-radius: 10px;
    }

    .db-panel-sub {
        margin: .3rem 0 0;
        font-size: .78rem;
        line-height: 1.5;
        color: var(--db-muted);
    }

    .db-panel-tools {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .db-panel-body {
        flex: 1;
        padding: 1.25rem 1.4rem;
        position: relative;
    }

    .db-tag {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .3rem .7rem;
        font-size: .72rem;
        font-weight: 600;
        color: var(--db-text);
        background: var(--db-soft);
        border: 1px solid var(--db-line);
        border-radius: 999px;
        white-space: nowrap;
    }

    .db-chart-lg {
        position: relative;
        width: 100%;
        height: 290px;
    }

    .db-chart-sm {
        position: relative;
        width: 100%;
        height: 220px;
    }

    .db-legend {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: .5rem;
        margin-top: 1.1rem;
        padding-top: 1.1rem;
        border-top: 1px solid var(--db-line-soft);
    }

    .legend-badge {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .3rem .75rem;
        font-size: .76rem;
        font-weight: 600;
        color: var(--db-text);
        background: var(--db-soft);
        border: 1px solid var(--db-line-soft);
        border-radius: 999px;
    }

    .legend-badge .text-muted {
        font-weight: 500;
        color: var(--db-muted) !important;
    }

    .legend-color-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .db-empty {
        padding: 2.5rem 1rem;
        text-align: center;
        color: var(--db-muted);
    }

    .db-empty>i {
        display: block;
        margin-bottom: .75rem;
        font-size: 2.2rem;
        opacity: .35;
    }

    .db-empty p {
        margin: 0 0 .6rem;
        font-size: .88rem;
        font-weight: 500;
    }

    .db-empty a.db-inline {
        font-size: .82rem;
        font-weight: 600;
        color: var(--db-primary);
        text-decoration: none;
    }

    /* ---------- Tables ---------- */
    .db-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .db-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .db-table thead th {
        padding: .8rem 1.1rem;
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: var(--db-muted);
        background: var(--db-soft);
        border-bottom: 1px solid var(--db-line);
        white-space: nowrap;
    }

    .db-table tbody td {
        padding: .9rem 1.1rem;
        font-size: .85rem;
        vertical-align: middle;
        color: var(--db-text);
        background: #fff;
        border-bottom: 1px solid var(--db-line-soft);
        transition: background .15s ease;
    }

    .db-table tbody tr:last-child td {
        border-bottom: none;
    }

    .db-table tbody tr:hover td {
        background: #fffaf7;
    }

    .db-table .db-center {
        text-align: center;
    }

    .db-table .db-right {
        text-align: right;
    }

    .db-idx {
        font-size: .8rem;
        font-weight: 600;
        color: var(--db-faint);
    }

    .db-name {
        font-size: .88rem;
        font-weight: 600;
        color: var(--db-ink);
    }

    .db-prod {
        display: flex;
        align-items: center;
        gap: .85rem;
        min-width: 0;
    }

    .product-thumb-sm {
        width: 48px;
        height: 48px;
        flex: 0 0 auto;
        object-fit: cover;
        background: var(--db-soft);
        border: 1px solid var(--db-line);
        border-radius: 12px;
    }

    .product-thumb-sm-placeholder {
        width: 48px;
        height: 48px;
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        color: var(--db-faint);
        background: var(--db-line-soft);
        border: 1px solid var(--db-line);
        border-radius: 12px;
    }

    .db-prod-info {
        min-width: 0;
    }

    .db-prod-link {
        display: block;
        font-size: .88rem;
        font-weight: 600;
        line-height: 1.4;
        color: var(--db-ink);
        text-decoration: none;
        overflow-wrap: anywhere;
        transition: color .2s ease;
    }

    .db-prod-link:hover {
        color: var(--db-primary-dark);
    }

    .db-prod-date {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        margin-top: .15rem;
        font-size: .72rem;
        color: var(--db-faint);
    }

    .db-cat {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: .35rem;
    }

    .db-sub {
        font-size: .74rem;
        color: var(--db-muted);
    }

    .db-sub i {
        margin-right: .35rem;
    }

    .db-formats {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .3rem;
    }

    .format-pill {
        display: inline-flex;
        align-items: center;
        padding: .22rem .55rem;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .02em;
        border-radius: 7px;
    }

    .format-pill-ai {
        background: #fff1f2;
        color: #e11d48;
        border: 1px solid #fecdd3;
    }

    .format-pill-cdr {
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }

    .format-pill-dxf {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    .format-pill-eps {
        background: #faf5ff;
        color: #9333ea;
        border: 1px solid #e9d5ff;
    }

    .format-pill-pdf {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .format-pill-svg {
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .format-pill-default {
        background: var(--db-soft);
        color: #475569;
        border: 1px solid var(--db-line);
    }

    .db-fcount {
        font-size: .72rem;
        font-weight: 500;
        color: var(--db-faint);
    }

    .db-none {
        font-size: .8rem;
        font-style: italic;
        color: var(--db-faint);
    }

    .db-page .badge-status-active,
    .db-page .badge-status-inactive {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .36rem .8rem;
        font-size: .74rem;
        font-weight: 600;
        line-height: 1.2;
        border: 1px solid transparent;
        border-radius: 999px;
        white-space: nowrap;
    }

    .db-page .badge-status-active {
        color: #059669;
        background: #ecfdf5;
        border-color: #a7f3d0;
    }

    .db-page .badge-status-inactive {
        color: #dc2626;
        background: #fef2f2;
        border-color: #fecaca;
    }

    .db-page .badge-status-active .status-dot,
    .db-page .badge-status-inactive .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .7);
    }

    .db-page .badge-status-active .status-dot {
        background: #10b981;
    }

    .db-page .badge-status-inactive .status-dot {
        background: #ef4444;
    }

    .db-acts {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .4rem;
        width: 36px;
        height: 36px;
        padding: 0;
        font-size: .85rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid var(--db-line);
        border-radius: 10px;
        cursor: pointer;
        transition: all .2s ease;
    }

    .btn-action-view {
        color: #2563eb;
        background: #eff6ff;
        border-color: #bfdbfe;
    }

    .btn-action-view:hover {
        color: #fff;
        background: #2563eb;
        border-color: #2563eb;
    }

    .btn-action-edit {
        color: var(--db-primary-dark);
        background: var(--db-primary-light);
        border-color: var(--db-peach-line);
    }

    .btn-action-edit:hover {
        color: #fff;
        background: var(--db-primary);
        border-color: var(--db-primary);
    }

    .db-act-text {
        display: none;
    }

    /* ---------- Tablet & mobile ---------- */
    @media (max-width: 991.98px) {

        .db-table thead th,
        .db-table tbody td {
            padding-left: .8rem;
            padding-right: .8rem;
        }

        .db-chart-lg {
            height: 260px;
        }
    }

    @media (max-width: 767.98px) {
        .db-hero {
            margin-bottom: 1.1rem;
            border-radius: 18px;
        }

        .db-hero-actions {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        }

        .db-hero-actions .db-btn {
            width: 100%;
        }

        .db-metric {
            padding: 1.1rem;
        }

        .db-metric-ico {
            width: 46px;
            height: 46px;
            font-size: 1.1rem;
            border-radius: 14px;
        }

        .db-panel-head {
            padding: 1rem;
        }

        .db-panel-body {
            padding: 1rem;
        }

        .db-panel-tools {
            width: 100%;
        }

        .db-panel-tools .db-btn {
            flex: 1 1 auto;
        }

        .db-chart-lg {
            height: 240px;
        }

        .db-chart-sm {
            height: 200px;
        }

        /* table → cards */
        .db-table-wrap {
            overflow: visible;
        }

        .db-table,
        .db-table tbody {
            display: block;
        }

        .db-table thead {
            display: none;
        }

        .db-table tbody {
            display: grid;
            gap: .75rem;
            padding: .75rem;
            background: var(--db-soft);
        }

        .db-table tbody tr {
            display: block;
            padding: .3rem 1rem .6rem;
            background: #fff;
            border: 1px solid var(--db-line);
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .04);
        }

        .db-table tbody tr:hover td {
            background: transparent;
        }

        .db-table tbody td {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: .65rem 0;
            text-align: right;
            border-bottom: 1px dashed var(--db-line);
        }

        .db-table tbody tr:last-child td {
            border-bottom: 1px dashed var(--db-line);
        }

        .db-table tbody td[data-label]::before {
            content: attr(data-label);
            flex: 0 0 auto;
            font-size: .66rem;
            font-weight: 600;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--db-faint);
            text-align: left;
        }

        .db-table tbody td.db-td-index {
            display: none;
        }

        .db-table tbody td.db-td-main {
            display: block;
            padding-top: .85rem;
            text-align: left;
            border-bottom: 1px solid var(--db-line-soft);
        }

        .db-table tbody td.db-td-actions {
            display: block;
            border-bottom: none;
            padding: .75rem 0 .2rem;
        }

        .db-table tbody tr:last-child td.db-td-actions {
            border-bottom: none;
        }

        .db-table .db-acts {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
        }

        .db-table .btn-action {
            width: 100%;
            height: 40px;
        }

        .db-act-text {
            display: inline;
        }

        .db-table .db-cat {
            align-items: flex-end;
        }

        .db-table .db-formats {
            justify-content: flex-end;
        }

        .db-table tbody td.db-td-empty {
            display: block;
            text-align: center;
            border-bottom: none;
        }

        .db-table tbody tr:has(.db-td-empty) {
            padding: 0;
        }
    }

    @media (max-width: 575.98px) {
        .db-hero-actions {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="db-page">

    <!-- Hero / Welcome Header -->
    <div class="db-hero">
        <div class="db-hero-inner">
            <div class="db-hero-main">
                <span class="db-live"><span class="db-pulse"></span>Live Admin Control Center</span>
                <h2 class="db-hero-title">
                    Welcome back, <?= html_escape($this->session->userdata('admin_name')) ?>!
                </h2>
                <p class="db-hero-sub">
                    Real-time overview of your digital vector catalog, design formats, and taxonomy performance.
                </p>
            </div>
            <div class="db-hero-actions">
                <a href="<?= base_url('product/add') ?>" class="db-btn db-btn-primary">
                    <i class="fa-solid fa-plus"></i> Add Product
                </a>
                <a href="<?= base_url('category?action=add') ?>" class="db-btn db-btn-outline">
                    <i class="fa-solid fa-shapes"></i> Add Category
                </a>
                <a href="<?= base_url('file_type') ?>" class="db-btn db-btn-light">
                    <i class="fa-solid fa-file-code"></i> File Formats
                </a>
            </div>
        </div>
    </div>

    <!-- Top Metrics Row -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Products Metric -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="db-metric">
                <div>
                    <div class="db-metric-top">
                        <div>
                            <span class="db-metric-label">Catalog Portfolio</span>
                            <div class="db-metric-value"><?= number_format($total_products) ?></div>
                        </div>
                        <div class="db-metric-ico" style="background: var(--db-primary-light); color: var(--db-primary);">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                    </div>
                    <div class="db-metric-chips">
                        <span class="badge-status-active">
                            <span class="status-dot"></span> <?= $active_products ?> Active
                        </span>
                        <?php if ($inactive_products > 0): ?>
                            <span class="badge-status-inactive">
                                <span class="status-dot"></span> <?= $inactive_products ?> Inactive
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="db-metric-foot">
                    <a href="<?= base_url('product') ?>" class="db-link" style="color: var(--db-primary);">
                        Manage Products <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <span class="db-foot-note"><?= $total_products > 0 ? round(($active_products / $total_products) * 100) : 0 ?>% Live</span>
                </div>
            </div>
        </div>

        <!-- 2. Digital Formats Metric -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="db-metric">
                <div>
                    <div class="db-metric-top">
                        <div>
                            <span class="db-metric-label">Digital Formats</span>
                            <div class="db-metric-value"><?= number_format($total_file_types) ?></div>
                        </div>
                        <div class="db-metric-ico" style="background: #faf5ff; color: #8b5cf6;">
                            <i class="fa-solid fa-file-code"></i>
                        </div>
                    </div>
                    <div class="db-metric-chips">
                        <span class="db-chip db-chip-purple">
                            <i class="fa-solid fa-paperclip"></i> <?= number_format($total_files) ?> Attached Files
                        </span>
                    </div>
                </div>
                <div class="db-metric-foot">
                    <a href="<?= base_url('file_type') ?>" class="db-link" style="color: #8b5cf6;">
                        Manage File Types <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <span class="db-foot-note"><?= $active_file_types ?> Active</span>
                </div>
            </div>
        </div>

        <!-- 3. Categories & Subcategories Metric -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="db-metric">
                <div>
                    <div class="db-metric-top">
                        <div>
                            <span class="db-metric-label">Taxonomy Tree</span>
                            <div class="db-metric-value"><?= number_format($total_categories) ?></div>
                        </div>
                        <div class="db-metric-ico" style="background: #ecfdf5; color: #10b981;">
                            <i class="fa-solid fa-shapes"></i>
                        </div>
                    </div>
                    <div class="db-metric-chips">
                        <span class="db-chip db-chip-green">
                            <?= $total_subcategories ?> Subcategories
                        </span>
                        <span class="db-chip db-chip-note"><?= $active_categories ?> Active</span>
                    </div>
                </div>
                <div class="db-metric-foot">
                    <a href="<?= base_url('category') ?>" class="db-link" style="color: #059669;">
                        Explore Taxonomy <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="<?= base_url('sub_category') ?>" class="db-foot-note">
                        Subcats <i class="fa-solid fa-angle-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- 4. Digital Storage Payload Metric -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="db-metric">
                <div>
                    <div class="db-metric-top">
                        <div>
                            <span class="db-metric-label">Digital Storage</span>
                            <div class="db-metric-value"><?= $total_storage_formatted ?></div>
                        </div>
                        <div class="db-metric-ico" style="background: #eff6ff; color: #3b82f6;">
                            <i class="fa-solid fa-hard-drive"></i>
                        </div>
                    </div>
                    <div class="db-metric-chips">
                        <span class="db-chip db-chip-blue">
                            <i class="fa-solid fa-cloud-arrow-up"></i> <?= number_format($total_files) ?> Assets Uploaded
                        </span>
                    </div>
                </div>
                <div class="db-metric-foot">
                    <a href="<?= base_url('product') ?>" class="db-link" style="color: #2563eb;">
                        View Catalog Assets <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <span class="db-foot-note">CAD &amp; Vector</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Chart 1: Products per Category Distribution -->
        <div class="col-12 col-lg-7">
            <div class="db-panel">
                <div class="db-panel-head">
                    <div class="db-panel-head-main">
                        <h5 class="db-panel-title">
                            <span class="db-panel-ico" style="background: var(--db-primary-light); color: var(--db-primary-dark);"><i class="fa-solid fa-chart-column"></i></span>
                            Category Density
                        </h5>
                        <p class="db-panel-sub">Number of active products organized by category</p>
                    </div>
                    <div class="db-panel-tools">
                        <span class="db-tag">Top <?= count($cat_labels) ?> Categories</span>
                        <a href="<?= base_url('category') ?>" class="db-btn db-btn-light db-btn-sm">View All</a>
                    </div>
                </div>
                <div class="db-panel-body">
                    <?php if (!empty($cat_labels)): ?>
                        <div class="db-chart-lg">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    <?php else: ?>
                        <div class="db-empty">
                            <i class="fa-solid fa-chart-bar"></i>
                            <p>No category data recorded yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Chart 2: Digital File Formats Distribution -->
        <div class="col-12 col-lg-5">
            <div class="db-panel">
                <div class="db-panel-head">
                    <div class="db-panel-head-main">
                        <h5 class="db-panel-title">
                            <span class="db-panel-ico" style="background: #f3e8ff; color: #8b5cf6;"><i class="fa-solid fa-chart-pie"></i></span>
                            Digital Formats Share
                        </h5>
                        <p class="db-panel-sub">Breakdown of uploaded files by format</p>
                    </div>
                    <span class="db-tag"><?= $total_files ?> Total Files</span>
                </div>
                <div class="db-panel-body">
                    <?php if (!empty($format_counts) && array_sum($format_counts) > 0): ?>
                        <div class="db-chart-sm">
                            <canvas id="formatChart"></canvas>
                        </div>

                        <!-- Formats Mini Badges Legend -->
                        <div class="db-legend">
                            <?php
                            $palette = ['#ff6b35', '#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#06b6d4', '#ec4899', '#64748b'];
                            foreach ($top_formats as $idx => $fmt):
                                $clr = $palette[$idx % count($palette)];
                            ?>
                                <div class="legend-badge">
                                    <span class="legend-color-dot" style="background-color: <?= $clr ?>;"></span>
                                    <span><?= strtoupper(ltrim($fmt->extension, '.')) ?></span>
                                    <span class="text-muted">(<?= $fmt->file_count ?>)</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="db-empty">
                            <i class="fa-solid fa-chart-pie"></i>
                            <p>No digital files uploaded to products yet.</p>
                            <a href="<?= base_url('product') ?>" class="db-inline">Attach files in Product Management</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Recently Added Products Table -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="db-panel">
                <div class="db-panel-head">
                    <div class="db-panel-head-main">
                        <h5 class="db-panel-title">
                            <span class="db-panel-ico" style="background: var(--db-primary-light); color: var(--db-primary-dark);"><i class="fa-solid fa-box-open"></i></span>
                            Recently Added Products
                            <span class="db-tag">Last 5</span>
                        </h5>
                    </div>
                    <div class="db-panel-tools">
                        <a href="<?= base_url('product/add') ?>" class="db-btn db-btn-primary db-btn-sm">
                            <i class="fa-solid fa-plus"></i> Add Product
                        </a>
                        <a href="<?= base_url('product') ?>" class="db-btn db-btn-light db-btn-sm">
                            View All Products
                        </a>
                    </div>
                </div>

                <div class="db-table-wrap">
                    <table class="db-table">
                        <thead>
                            <tr>
                                <th style="width: 55px;" class="db-center">#</th>
                                <th>Product</th>
                                <th>Category &amp; Subcategory</th>
                                <th>Attached Formats</th>
                                <th>Status</th>
                                <th class="db-right" style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_products)): ?>
                                <?php foreach ($recent_products as $key => $prod): ?>
                                    <tr>
                                        <td class="db-center db-td-index"><span class="db-idx">#<?= $key + 1 ?></span></td>
                                        <td class="db-td-main">
                                            <div class="db-prod">
                                                <?php if (!empty($prod->image) && file_exists(FCPATH . $prod->image)): ?>
                                                    <img src="<?= base_url($prod->image) ?>" alt="<?= html_escape($prod->name) ?>" class="product-thumb-sm">
                                                <?php else: ?>
                                                    <div class="product-thumb-sm-placeholder">
                                                        <i class="fa-solid fa-cube"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="db-prod-info">
                                                    <a href="<?= base_url('product/detail/' . $prod->id) ?>" class="db-prod-link">
                                                        <?= html_escape($prod->name) ?>
                                                    </a>
                                                    <span class="db-prod-date">
                                                        <i class="fa-regular fa-clock"></i><?= date('M d, Y', strtotime($prod->created_at)) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Category">
                                            <div class="db-cat">
                                                <span class="db-tag">
                                                    <i class="fa-solid fa-folder text-warning"></i> <?= html_escape($prod->category_name ?? 'Unassigned') ?>
                                                </span>
                                                <?php if (!empty($prod->subcategory_name)): ?>
                                                    <span class="db-sub">
                                                        <i class="fa-solid fa-turn-up fa-rotate-90"></i><?= html_escape($prod->subcategory_name) ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td data-label="Formats">
                                            <?php if (!empty($prod->files)): ?>
                                                <div class="db-formats">
                                                    <?php foreach ($prod->files as $file):
                                                        $ext = strtolower(ltrim($file->extension ?? '', '.'));
                                                        $pill_class = 'format-pill-default';
                                                        if ($ext === 'ai') $pill_class = 'format-pill-ai';
                                                        elseif ($ext === 'cdr') $pill_class = 'format-pill-cdr';
                                                        elseif ($ext === 'dxf') $pill_class = 'format-pill-dxf';
                                                        elseif ($ext === 'eps') $pill_class = 'format-pill-eps';
                                                        elseif ($ext === 'pdf') $pill_class = 'format-pill-pdf';
                                                        elseif ($ext === 'svg') $pill_class = 'format-pill-svg';
                                                    ?>
                                                        <span class="format-pill <?= $pill_class ?>" title="<?= html_escape($file->file_name) ?>">
                                                            .<?= strtoupper($ext) ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                    <span class="db-fcount">(<?= count($prod->files) ?>)</span>
                                                </div>
                                            <?php else: ?>
                                                <span class="db-none">No files attached</span>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Status">
                                            <?php if ((int)$prod->status === 1): ?>
                                                <span class="badge-status-active">
                                                    <span class="status-dot"></span> Active
                                                </span>
                                            <?php else: ?>
                                                <span class="badge-status-inactive">
                                                    <span class="status-dot"></span> Inactive
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="db-right db-td-actions">
                                            <div class="db-acts">
                                                <a href="<?= base_url('product/detail/' . $prod->id) ?>" class="btn-action btn-action-view" title="View Full Details">
                                                    <i class="fa-solid fa-eye"></i><span class="db-act-text">View</span>
                                                </a>
                                                <a href="<?= base_url('product/edit/' . $prod->id) ?>" class="btn-action btn-action-edit" title="Edit Product">
                                                    <i class="fa-solid fa-pen-to-square"></i><span class="db-act-text">Edit</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="db-empty db-td-empty">
                                        <i class="fa-solid fa-box-open"></i>
                                        <p>No products found in catalog.</p>
                                        <a href="<?= base_url('product/add') ?>" class="db-btn db-btn-primary db-btn-sm">
                                            <i class="fa-solid fa-plus"></i> Add First Product
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Taxonomy Row (Categories & Subcategories) -->
    <div class="row g-4">
        <!-- Recent Categories -->
        <div class="col-12 col-lg-6">
            <div class="db-panel">
                <div class="db-panel-head">
                    <div class="db-panel-head-main">
                        <h5 class="db-panel-title">
                            <span class="db-panel-ico" style="background: #ecfdf5; color: #059669;"><i class="fa-solid fa-shapes"></i></span>
                            Recent Categories
                        </h5>
                    </div>
                    <div class="db-panel-tools">
                        <a href="<?= base_url('category?action=add') ?>" class="db-btn db-btn-outline db-btn-sm">
                            <i class="fa-solid fa-plus"></i> New
                        </a>
                        <a href="<?= base_url('category') ?>" class="db-btn db-btn-light db-btn-sm">
                            View All
                        </a>
                    </div>
                </div>

                <div class="db-table-wrap">
                    <table class="db-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="db-center">#</th>
                                <th>Category Name</th>
                                <th>Products Linked</th>
                                <th>Status</th>
                                <th class="db-right" style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_categories)): ?>
                                <?php foreach ($recent_categories as $key => $cat): ?>
                                    <tr>
                                        <td class="db-center db-td-index"><span class="db-idx">#<?= $key + 1 ?></span></td>
                                        <td class="db-td-main">
                                            <div class="db-name"><?= html_escape($cat->name) ?></div>
                                        </td>
                                        <td data-label="Products">
                                            <span class="db-tag">
                                                <i class="fa-solid fa-box text-primary"></i> <?= (int)$cat->product_count ?> product<?= ((int)$cat->product_count === 1) ? '' : 's' ?>
                                            </span>
                                        </td>
                                        <td data-label="Status">
                                            <?php if ((int)$cat->status === 1): ?>
                                                <span class="badge-status-active">
                                                    <span class="status-dot"></span> Active
                                                </span>
                                            <?php else: ?>
                                                <span class="badge-status-inactive">
                                                    <span class="status-dot"></span> Inactive
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="db-right db-td-actions">
                                            <div class="db-acts">
                                                <a href="<?= base_url('category') ?>" class="btn-action btn-action-view" title="Manage in Categories">
                                                    <i class="fa-solid fa-arrow-right"></i><span class="db-act-text">Manage</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="db-empty db-td-empty">
                                        <i class="fa-solid fa-folder-open"></i>
                                        <p>No categories added yet.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Subcategories -->
        <div class="col-12 col-lg-6">
            <div class="db-panel">
                <div class="db-panel-head">
                    <div class="db-panel-head-main">
                        <h5 class="db-panel-title">
                            <span class="db-panel-ico" style="background: #eff6ff; color: #2563eb;"><i class="fa-solid fa-sitemap"></i></span>
                            Recent Subcategories
                        </h5>
                    </div>
                    <div class="db-panel-tools">
                        <a href="<?= base_url('sub_category?action=add') ?>" class="db-btn db-btn-outline db-btn-sm">
                            <i class="fa-solid fa-plus"></i> New
                        </a>
                        <a href="<?= base_url('sub_category') ?>" class="db-btn db-btn-light db-btn-sm">
                            View All
                        </a>
                    </div>
                </div>

                <div class="db-table-wrap">
                    <table class="db-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="db-center">#</th>
                                <th>Subcategory</th>
                                <th>Parent Category</th>
                                <th>Status</th>
                                <th class="db-right" style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_subcategories)): ?>
                                <?php foreach ($recent_subcategories as $key => $sub): ?>
                                    <tr>
                                        <td class="db-center db-td-index"><span class="db-idx">#<?= $key + 1 ?></span></td>
                                        <td class="db-td-main">
                                            <div class="db-name"><?= html_escape($sub->name) ?></div>
                                        </td>
                                        <td data-label="Parent">
                                            <span class="db-tag">
                                                <?= html_escape($sub->category_name) ?>
                                            </span>
                                        </td>
                                        <td data-label="Status">
                                            <?php if ((int)$sub->status === 1): ?>
                                                <span class="badge-status-active">
                                                    <span class="status-dot"></span> Active
                                                </span>
                                            <?php else: ?>
                                                <span class="badge-status-inactive">
                                                    <span class="status-dot"></span> Inactive
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="db-right db-td-actions">
                                            <div class="db-acts">
                                                <a href="<?= base_url('sub_category') ?>" class="btn-action btn-action-view" title="Manage in Subcategories">
                                                    <i class="fa-solid fa-arrow-right"></i><span class="db-act-text">Manage</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="db-empty db-td-empty">
                                        <i class="fa-solid fa-folder-open"></i>
                                        <p>No subcategories added yet.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Configuration -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Shared chart font and styling defaults
        Chart.defaults.font.family = "'Poppins', sans-serif";
        Chart.defaults.color = '#64748b';

        // 1. Category Density Bar Chart
        const catCanvas = document.getElementById('categoryChart');
        if (catCanvas) {
            const catLabels = <?= json_encode($cat_labels) ?>;
            const catCounts = <?= json_encode($cat_counts) ?>;

            const ctxCat = catCanvas.getContext('2d');

            // Linear gradient for theme orange
            const orangeGradient = ctxCat.createLinearGradient(0, 0, 0, 260);
            orangeGradient.addColorStop(0, '#ff6b35');
            orangeGradient.addColorStop(1, '#ff9066');

            new Chart(ctxCat, {
                type: 'bar',
                data: {
                    labels: catLabels,
                    datasets: [{
                        label: 'Products',
                        data: catCounts,
                        backgroundColor: orangeGradient,
                        borderColor: '#ff6b35',
                        borderWidth: 1,
                        borderRadius: 8,
                        maxBarThickness: 36
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: {
                                size: 13,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 10,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Products';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    weight: '500'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: '#f1f5f9'
                            }
                        }
                    }
                }
            });
        }

        // 2. Digital Formats Share Doughnut Chart
        const formatCanvas = document.getElementById('formatChart');
        if (formatCanvas) {
            const formatLabels = <?= json_encode($format_labels) ?>;
            const formatCounts = <?= json_encode($format_counts) ?>;

            const formatColors = [
                '#ff6b35', // Theme Orange
                '#3b82f6', // Blue
                '#10b981', // Green
                '#8b5cf6', // Purple
                '#f59e0b', // Amber
                '#06b6d4', // Cyan
                '#ec4899', // Pink
                '#64748b' // Slate
            ];

            // Center label showing the total number of files inside the doughnut
            const centerTextPlugin = {
                id: 'centerText',
                afterDraw: function(chart) {
                    const meta = chart.getDatasetMeta(0);
                    if (!meta || !meta.data || !meta.data.length) return;
                    const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    const x = meta.data[0].x;
                    const y = meta.data[0].y;
                    const ctx = chart.ctx;
                    ctx.save();
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillStyle = '#0f172a';
                    ctx.font = "700 26px 'Poppins', sans-serif";
                    ctx.fillText(total, x, y - 8);
                    ctx.fillStyle = '#94a3b8';
                    ctx.font = "500 11px 'Poppins', sans-serif";
                    ctx.fillText('FILES', x, y + 14);
                    ctx.restore();
                }
            };

            new Chart(formatCanvas.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: formatLabels,
                    datasets: [{
                        data: formatCounts,
                        backgroundColor: formatColors.slice(0, formatLabels.length),
                        borderColor: '#ffffff',
                        borderWidth: 2,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: {
                                size: 13,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const val = context.parsed;
                                    const pct = total > 0 ? Math.round((val / total) * 100) : 0;
                                    return ' ' + val + ' files (' + pct + '%)';
                                }
                            }
                        }
                    }
                },
                plugins: [centerTextPlugin]
            });
        }
    });
</script>