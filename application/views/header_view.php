<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? html_escape($title) . ' - AXIS Admin' : 'AXIS Administration' ?></title>
    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary: #ff6b35;
            --primary-dark: #e85a2a;
            --primary-light: #fff1ec;
            --primary-gradient: linear-gradient(135deg, #ff6b35 0%, #ff8c5a 100%);
            --sidebar-width: 250px;
            --header-height: 64px;
            --body-bg: #f8fafc;
            --card-shadow: 0 4px 20px -2px rgba(17, 24, 39, 0.05);
            --transition: all 0.2s ease-in-out;
        }

        /* SweetAlert Theme Customization */
        .swal2-popup {
            border-radius: 18px !important;
            font-family: "Poppins", sans-serif !important;
            padding: 1.75rem !important;
        }
        .swal2-title {
            font-weight: 700 !important;
            color: #1e293b !important;
            font-size: 1.35rem !important;
        }
        .swal2-styled.swal2-confirm {
            background: var(--primary-gradient) !important;
            box-shadow: 0 4px 14px rgba(255, 107, 53, 0.35) !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            padding: 0.6rem 1.4rem !important;
        }
        .swal2-styled.swal2-cancel {
            background: #64748b !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            padding: 0.6rem 1.4rem !important;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--body-bg);
            color: #334155;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #edf2f7;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        .sidebar-brand {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-bottom: 1px solid #edf2f7;
            text-decoration: none;
        }

        .brand-badge {
            background: var(--primary-gradient);
            color: #fff;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(255, 107, 53, 0.35);
            margin-right: 0.75rem;
        }

        .brand-title {
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #1e293b;
            line-height: 1.1;
        }

        .brand-subtitle {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--primary);
        }

        .sidebar-menu {
            padding: 1.25rem 0.85rem;
            flex: 1;
            overflow-y: auto;
        }

        .menu-header {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
            color: #94a3b8;
            padding: 0.75rem 0.85rem 0.35rem;
        }

        .nav-item {
            list-style: none;
            margin-bottom: 4px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.92rem;
            transition: var(--transition);
        }

        .nav-link-custom i {
            font-size: 1.15rem;
            width: 28px;
            margin-right: 0.5rem;
            color: #94a3b8;
            transition: var(--transition);
        }

        .nav-link-custom:hover {
            color: var(--primary);
            background: var(--primary-light);
        }

        .nav-link-custom:hover i {
            color: var(--primary);
        }

        .nav-link-custom.active {
            color: #ffffff;
            background: var(--primary-gradient);
            box-shadow: 0 4px 14px rgba(255, 107, 53, 0.35);
        }

        .nav-link-custom.active i {
            color: #ffffff;
        }

        /* Main Content Wrapper */
        #content-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        /* Modern Topbar */
        #topbar {
            height: var(--header-height);
            background: #ffffff;
            border-bottom: 1px solid #edf2f7;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .header-breadcrumb {
            display: flex;
            align-items: center;
            font-size: 0.92rem;
        }

        .header-breadcrumb .parent-crumb {
            color: #94a3b8;
            font-weight: 500;
        }

        .header-breadcrumb .separator {
            color: #cbd5e1;
            margin: 0 0.5rem;
            font-weight: 400;
        }

        .header-breadcrumb .active-crumb {
            color: #1e293b;
            font-weight: 700;
        }

        .user-dropdown-toggle {
            padding: 4px 8px;
            border-radius: 50px;
            transition: var(--transition);
        }

        .user-dropdown-toggle:hover {
            background: #f8fafc;
        }

        .header-avatar {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border: 1.5px solid #edf2f7;
        }

        .header-avatar-initials {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(255, 107, 53, 0.25);
        }

        /* Common Elements & Buttons */
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.55rem 1.25rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.25);
            transition: var(--transition);
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background: var(--primary-dark) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(255, 107, 53, 0.35);
        }

        .btn-outline-primary {
            border: 1.5px solid var(--primary);
            color: var(--primary);
            font-weight: 600;
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
            transition: var(--transition);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        /* Modern Status Badge with Glow Dot */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            user-select: none;
            line-height: 1.2;
        }
        .badge-status.active, .badge-status-active {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #10b98133;
        }
        .badge-status.active:hover, a:hover .badge-status.active {
            background-color: #d1fae5;
            color: #047857;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(16, 185, 129, 0.2);
        }
        .badge-status.inactive, .badge-status-inactive {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #ef444433;
        }
        .badge-status.inactive:hover, a:hover .badge-status.inactive {
            background-color: #fee2e2;
            color: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(239, 68, 68, 0.2);
        }
        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }
        .badge-status.active .status-dot {
            background-color: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25);
        }
        .badge-status.inactive .status-dot {
            background-color: #ef4444;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.25);
        }

        /* Modern Discrete Action Buttons */
        .action-btn-group {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            justify-content: flex-end;
            white-space: nowrap;
        }
        .btn-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            border: 1px solid transparent;
            font-size: 0.88rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            background: transparent;
            padding: 0;
            cursor: pointer;
        }
        .btn-action-view {
            background-color: #f0f9ff;
            color: #0284c7;
            border-color: #bae6fd;
        }
        .btn-action-view:hover {
            background-color: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
        }
        .btn-action-edit {
            background-color: var(--primary-light);
            color: var(--primary);
            border-color: #ffd4c2;
        }
        .btn-action-edit:hover {
            background-color: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 107, 53, 0.25);
        }
        .btn-action-delete {
            background-color: #fef2f2;
            color: #ef4444;
            border-color: #fecaca;
        }
        .btn-action-delete:hover {
            background-color: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.25);
        }

        /* Modern Sequential Table Index */
        .table-index-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 28px;
            height: 26px;
            padding: 0 6px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: monospace;
        }

        /* Modern Table Toolbar */
        .table-toolbar {
            padding: 1.15rem 1.4rem;
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.85rem;
        }
        .search-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-input-wrapper i.search-icon {
            position: absolute;
            left: 13px;
            color: #94a3b8;
            font-size: 0.88rem;
            pointer-events: none;
            z-index: 2;
        }
        .search-input-custom {
            padding-left: 36px !important;
            padding-right: 32px;
            border-radius: 10px !important;
            border: 1.5px solid #e2e8f0;
            font-size: 0.88rem;
            transition: var(--transition);
            background: #f8fafc;
        }
        .search-input-custom:focus {
            background: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        }
        .filter-select-custom {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.88rem;
            padding: 0.42rem 2.2rem 0.42rem 0.85rem;
            background-color: #f8fafc;
            transition: var(--transition);
        }
        .filter-select-custom:focus {
            background-color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        }
        .badge-count-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 500;
        }
        .badge-count-pill strong {
            color: #0f172a;
            font-weight: 700;
        }

        /* Modern Pagination Styling */
        .pagination .page-link {
            color: #475569;
            border-color: #e2e8f0;
            font-weight: 600;
            font-size: 0.86rem;
            padding: 0.38rem 0.72rem;
            border-radius: 8px;
            margin: 0 2px;
            transition: var(--transition);
        }
        .pagination .page-link:hover {
            color: var(--primary);
            background-color: var(--primary-light);
            border-color: #ffd4c2;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary-gradient);
            border-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(255, 107, 53, 0.35);
        }
        .pagination .page-item.disabled .page-link {
            color: #94a3b8;
            background-color: transparent;
            border-color: transparent;
        }

        /* Content Container */
        .main-content {
            padding: 2rem;
            flex: 1;
        }
        .custom-card {
            background: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 1.75rem;
            margin-bottom: 1.75rem;
        }

        /* Tables */
        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-custom th {
            font-size: 0.74rem;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            font-weight: 700;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.9rem 1.25rem;
            background: #f8fafc;
            white-space: nowrap;
        }
        .table-custom td {
            padding: 0.95rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 0.92rem;
            background: #ffffff;
        }
        .table-custom tr:hover td {
            background-color: #fafbfc;
        }
        .table-custom tr:last-child td {
            border-bottom: none;
        }

        @media (max-width: 991px) {
            #sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content-wrapper {
                margin-left: 0;
            }
            #topbar {
                padding: 0 1rem;
            }
            .main-content {
                padding: 1.25rem 1rem;
            }
        }
    </style>
</head>
<body>

<div id="wrapper">
    <!-- Sidebar -->
    <aside id="sidebar">
        <a href="<?= base_url('dashboard') ?>" class="sidebar-brand">
            <span class="brand-badge"><i class="fa-solid fa-layer-group"></i></span>
            <div>
                <div class="brand-title">AXIS</div>
                <div class="brand-subtitle">Control Center</div>
            </div>
        </a>

        <div class="sidebar-menu">
            <div class="menu-header">Overview</div>
            <ul class="p-0 m-0">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link-custom <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'active' : '' ?>">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>

            <div class="menu-header mt-3">Catalog Management</div>
            <ul class="p-0 m-0">
                <li class="nav-item">
                    <a href="<?= base_url('category') ?>" class="nav-link-custom <?= ($this->uri->segment(1) == 'category') ? 'active' : '' ?>">
                        <i class="fa-solid fa-shapes"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sub_category') ?>" class="nav-link-custom <?= ($this->uri->segment(1) == 'sub_category' || $this->uri->segment(1) == 'subcategory') ? 'active' : '' ?>">
                        <i class="fa-solid fa-sitemap"></i>
                        <span>Subcategories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('file_type') ?>" class="nav-link-custom <?= ($this->uri->segment(1) == 'file_type' || $this->uri->segment(1) == 'file-type') ? 'active' : '' ?>">
                        <i class="fa-solid fa-file-code"></i>
                        <span>File Types</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('product') ?>" class="nav-link-custom <?= ($this->uri->segment(1) == 'product') ? 'active' : '' ?>">
                        <i class="fa-solid fa-box-open"></i>
                        <span>Products</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>

    <!-- Main Content Wrapper -->
    <div id="content-wrapper">
        <!-- Modern Sleek Header -->
        <header id="topbar">
            <!-- Left: Mobile Toggle & Clean Breadcrumb -->
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light border d-lg-none" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="header-breadcrumb">
                    <span class="parent-crumb">Admin</span>
                    <span class="separator">/</span>
                    <span class="active-crumb"><?= isset($title) ? html_escape($title) : 'Dashboard' ?></span>
                </div>
            </div>

            <!-- Right: Profile Dropdown Widget (Matching Mockup) -->
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <div class="d-flex align-items-center gap-2 user-dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; user-select: none;">
                        <?php if (!empty($this->session->userdata('admin_profile_image')) && file_exists(FCPATH . $this->session->userdata('admin_profile_image'))): ?>
                            <img src="<?= base_url($this->session->userdata('admin_profile_image')) ?>" alt="Avatar" class="rounded-circle header-avatar">
                        <?php else: ?>
                            <div class="header-avatar-initials">
                                <?= strtoupper(substr($this->session->userdata('admin_name') ? $this->session->userdata('admin_name') : 'A', 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <span class="fw-semibold text-dark d-none d-sm-inline-block" style="font-size: 0.92rem;"><?= html_escape($this->session->userdata('admin_name') ? $this->session->userdata('admin_name') : 'Admin') ?></span>
                        <i class="fa-solid fa-chevron-down text-muted ms-1" style="font-size: 11px;"></i>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 p-2" style="border-radius: 12px; min-width: 210px;">
                        <li class="px-3 py-2 border-bottom mb-1 bg-light rounded">
                            <div class="fw-bold text-dark small"><?= html_escape($this->session->userdata('admin_name') ? $this->session->userdata('admin_name') : 'Admin') ?></div>
                            <div class="text-muted text-truncate" style="font-size: 0.75rem;"><?= html_escape($this->session->userdata('admin_email')) ?></div>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 rounded d-flex align-items-center gap-2 text-secondary <?= ($this->uri->segment(1) == 'profile') ? 'fw-bold text-dark bg-light' : '' ?>" href="<?= base_url('profile') ?>">
                                <i class="fa-solid fa-user-gear text-muted" style="width: 18px;"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <a class="dropdown-item py-2 rounded text-danger d-flex align-items-center gap-2" href="<?= base_url('logout') ?>">
                                <i class="fa-solid fa-right-from-bracket text-danger" style="width: 18px;"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="main-content">