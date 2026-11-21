<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    @notifyCss

    <!-- Custom fonts for this template-->
    <link href="/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Tampilan baru: hanya override visual, struktur & fitur tidak berubah -->
    <style>
        :root {
            --ink: #14213d;
            --muted: #6b7488;
            --line: #e4e8f0;
            --page: #f1f3f8;
            --surface: #ffffff;
            --navy: #14213d;
            --navy-deep: #0d1626;
            --accent: #f59e0b;
            --accent-dark: #d98606;
            --accent-soft: #fff4dc;
            --accent-ink: #8a5200;
            --link: #2b4acb;
            --radius: 16px;
            --font-display: "Space Grotesk", "Manrope", system-ui, sans-serif;
            --shadow: 0 1px 2px rgba(20, 33, 61, .05), 0 10px 26px -10px rgba(20, 33, 61, .16);
        }

        /* ---------- Dasar ---------- */
        html { scroll-behavior: smooth; }

        body,
        #content-wrapper {
            font-family: "Manrope", system-ui, -apple-system, "Segoe UI", sans-serif;
            font-size: .92rem;
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

        #content-wrapper { background: var(--page); }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-display);
            font-weight: 700;
            letter-spacing: -.02em;
            color: var(--ink);
        }

        a { color: var(--link); }
        a:hover { color: var(--navy); }

        :focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        /* ---------- Pita header bermotif grid (di belakang topbar & judul) ---------- */
        #content { position: relative; isolation: isolate; }

        #content::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 14rem;
            z-index: -1;
            border-radius: 0 0 28px 28px;
            background-color: var(--navy);
            background-image:
                radial-gradient(520px 200px at 88% 0, rgba(245, 158, 11, .30), transparent 70%),
                linear-gradient(rgba(255, 255, 255, .055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, .055) 1px, transparent 1px);
            background-size: auto, 32px 32px, 32px 32px;
        }

        /* ---------- Sidebar (navy gelap) ---------- */
        .sidebar.bg-gradient-primary {
            background: var(--navy-deep);
            background-image: none;
            border-right: 1px solid rgba(255, 255, 255, .05);
        }

        .sidebar.sidebar-dark .sidebar-brand {
            height: 4.75rem;
            padding: 0 1.25rem;
            justify-content: flex-start !important;
            color: #fff;
            text-transform: none;
            letter-spacing: -.02em;
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .sidebar.sidebar-dark .sidebar-brand .sidebar-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.4rem;
            height: 2.4rem;
            border-radius: 12px;
            background: var(--accent);
            transform: rotate(-8deg);
            box-shadow: 0 6px 16px -4px rgba(245, 158, 11, .55);
        }

        .sidebar.sidebar-dark .sidebar-brand .sidebar-brand-icon i {
            font-size: 1.1rem;
            color: var(--navy);
        }

        .sidebar.sidebar-dark .sidebar-brand .sidebar-brand-text {
            margin: 0 0 0 .75rem !important;
            color: #fff;
        }

        .sidebar.sidebar-dark hr.sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, .08);
            margin: 0 1.25rem 1rem;
        }

        .sidebar .nav-item { margin: .2rem .8rem; }

        .sidebar.sidebar-dark .nav-item .nav-link {
            position: relative;
            width: auto;
            padding: .75rem .95rem;
            border-radius: 12px;
            color: rgba(255, 255, 255, .62);
            font-weight: 600;
            transition: background-color .15s ease, color .15s ease;
        }

        .sidebar.sidebar-dark .nav-item .nav-link span { font-size: .92rem; }

        .sidebar.sidebar-dark .nav-item .nav-link i {
            color: rgba(255, 255, 255, .4);
            margin-right: .55rem;
            transition: color .15s ease;
        }

        .sidebar.sidebar-dark .nav-item .nav-link:hover {
            background: rgba(255, 255, 255, .06);
            color: #fff;
        }

        .sidebar.sidebar-dark .nav-item .nav-link:hover i { color: var(--accent); }

        .sidebar.sidebar-dark .nav-item.active .nav-link {
            background: rgba(245, 158, 11, .13);
            color: #ffd27a;
        }

        .sidebar.sidebar-dark .nav-item.active .nav-link i { color: var(--accent); }

        .sidebar.sidebar-dark .nav-item.active .nav-link::before {
            content: "";
            position: absolute;
            left: -.8rem;
            top: 22%;
            bottom: 22%;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background: var(--accent);
        }

        .sidebar.toggled .sidebar-brand { justify-content: center !important; padding: 0; }
        .sidebar.toggled .nav-item { margin: .2rem .5rem; }
        .sidebar.toggled .nav-item .nav-link { width: auto; padding: .75rem .5rem; text-align: center; }
        .sidebar.toggled .nav-item .nav-link i { margin-right: 0; }
        .sidebar.toggled .nav-item.active .nav-link::before { left: -.5rem; }

        /* ---------- Topbar (transparan di atas pita navy) ---------- */
        .navbar.topbar,
        .topbar.bg-white {
            height: 4.25rem;
            background-color: transparent !important;
            box-shadow: none !important;
            border-bottom: 0;
            margin-bottom: .75rem !important;
        }

        .topbar .topbar-divider {
            border-right: 1px solid rgba(255, 255, 255, .2);
            height: 1.75rem;
            margin: auto 1rem;
        }

        .topbar .nav-item .nav-link { height: 4.25rem; color: rgba(255, 255, 255, .78); }
        .topbar .nav-item .nav-link:hover { color: #fff; }

        .topbar .img-profile {
            height: 2.4rem;
            width: 2.4rem;
            border: 2px solid var(--accent);
            padding: 2px;
            background: var(--navy);
        }

        .topbar .text-gray-600 { color: #fff !important; font-weight: 600; font-size: .88rem; }

        #sidebarToggleTop { color: #fff; }
        #sidebarToggleTop:hover { background: rgba(255, 255, 255, .12); }

        /* ---------- Dropdown ---------- */
        .dropdown-menu {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 16px 40px -8px rgba(20, 33, 61, .28) !important;
            padding: .4rem;
            font-size: .88rem;
        }

        .dropdown-item {
            border-radius: 9px;
            padding: .6rem .85rem;
            color: var(--ink);
            font-weight: 500;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background: var(--accent-soft);
            color: var(--accent-ink);
        }

        .dropdown-item:hover i { color: var(--accent-dark) !important; }
        .dropdown-divider { border-top-color: var(--line); margin: .35rem 0; }

        /* ---------- Area konten halaman ---------- */
        .container-fluid { padding-left: 2rem; padding-right: 2rem; }

        /* Judul halaman tampil putih di atas pita navy */
        .container-fluid > .d-sm-flex h1,
        .container-fluid > h1,
        .container-fluid > .h3 {
            color: #fff !important;
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -.03em;
        }

        .card,
        .card.shadow {
            border: 0;
            border-radius: var(--radius);
            background: var(--surface);
        }

        .card.shadow { box-shadow: var(--shadow) !important; }

        .card .card-header {
            background: var(--surface);
            border-bottom: 1px solid var(--line);
            padding: 1.15rem 1.5rem;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .card .card-header h6,
        .card .card-header .h6 {
            color: var(--ink) !important;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1.05rem;
        }

        .card-body { padding: 1.5rem; }
        .card-footer { background: var(--surface); border-top: 1px solid var(--line); }

        /* Tabel */
        .table { color: var(--ink); }

        .table thead th {
            background: var(--page);
            color: var(--muted);
            font-weight: 700;
            font-size: .8rem;
            border-top: 0;
            border-bottom: 0;
            padding: .9rem 1rem;
            vertical-align: middle;
        }

        .table thead th:first-child { border-radius: 10px 0 0 10px; }
        .table thead th:last-child { border-radius: 0 10px 10px 0; }

        .table td {
            padding: .95rem 1rem;
            border-top: 1px solid var(--line);
            vertical-align: middle;
        }

        .table-bordered { border: 0; }

        .table-bordered td,
        .table-bordered th {
            border-left: 0;
            border-right: 0;
            border-color: var(--line);
        }

        .table-bordered thead th { border-bottom-width: 0; }

        .table-striped tbody tr:nth-of-type(odd) { background: transparent; }
        .table-hover tbody tr:hover { background: #fffaf0; }

        /* Tombol */
        .btn {
            border-radius: 11px;
            font-weight: 700;
            font-size: .875rem;
            padding: .58rem 1.1rem;
            transition: background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
        }

        .btn-sm { padding: .36rem .8rem; font-size: .8rem; border-radius: 9px; }

        .btn-primary {
            background-color: var(--accent);
            border-color: var(--accent);
            color: var(--navy);
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: var(--accent-dark) !important;
            border-color: var(--accent-dark) !important;
            color: var(--navy) !important;
        }

        .btn:focus { box-shadow: 0 0 0 .2rem rgba(245, 158, 11, .3); }

        .btn-secondary {
            background-color: var(--surface);
            border-color: #d3d9e6;
            color: var(--ink);
        }

        .btn-secondary:hover {
            background-color: var(--page);
            border-color: #bcc4d6;
            color: var(--ink);
        }

        .btn-success { background-color: #10b981; border-color: #10b981; }
        .btn-danger { background-color: #e5484d; border-color: #e5484d; }
        .btn-warning { background-color: #f59e0b; border-color: #f59e0b; color: var(--navy); }
        .btn-info { background-color: #3b82f6; border-color: #3b82f6; }
        .btn-link { color: var(--link); }

        /* Form */
        .form-control,
        .custom-select {
            border: 1px solid #d3d9e6;
            border-radius: 11px;
            padding: .62rem .95rem;
            height: auto;
            font-size: .9rem;
            color: var(--ink);
            background-color: var(--surface);
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .form-control:focus,
        .custom-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 .2rem rgba(245, 158, 11, .2);
        }

        .form-control.bg-light { background-color: var(--page) !important; }
        .form-control::placeholder { color: #98a2b8; }

        label { font-weight: 700; font-size: .85rem; color: var(--ink); }

        /* Badge, alert, pagination */
        .badge { border-radius: 999px; font-weight: 700; padding: .4em .8em; }

        .alert { border: 0; border-left: 4px solid; border-radius: 12px; font-size: .9rem; }
        .alert-success { background: #e6f7f0; border-color: #10b981; color: #0a6b4b; }
        .alert-danger { background: #fdecec; border-color: #e5484d; color: #9b1c21; }
        .alert-warning { background: #fff4dc; border-color: #f59e0b; color: #7a4d06; }
        .alert-info { background: #e8f0fe; border-color: #3b82f6; color: #1d4fa8; }

        .page-link {
            color: var(--ink);
            border-color: var(--line);
            margin: 0 2px;
            border-radius: 9px;
        }

        .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: var(--navy); font-weight: 700; }

        /* ---------- Footer ---------- */
        footer.sticky-footer.bg-white {
            background: transparent !important;
            padding: 1.5rem 0;
            height: auto;
        }

        footer.sticky-footer .copyright { color: var(--muted); font-size: .82rem; }

        /* ---------- Scroll to top ---------- */
        .scroll-to-top {
            background: var(--navy);
            color: var(--accent);
            border-radius: 50%;
            width: 2.7rem;
            height: 2.7rem;
            line-height: 2.7rem;
            right: 1.5rem;
            bottom: 1.5rem;
            box-shadow: 0 10px 24px -6px rgba(20, 33, 61, .5);
            transition: background-color .15s ease, color .15s ease;
        }

        .scroll-to-top:hover { background: var(--accent); color: var(--navy); }

        /* ---------- Modal ---------- */
        .modal-backdrop.show { opacity: .6; background: var(--navy-deep); }

        .modal-content {
            border: 0;
            border-radius: 20px;
            box-shadow: 0 30px 70px -10px rgba(13, 22, 38, .5);
            overflow: hidden;
        }

        .modal-header { border-bottom: 0; padding: 1.5rem 1.7rem .4rem; }
        .modal-title { font-family: var(--font-display); font-weight: 700; font-size: 1.2rem; }
        .modal-header .close { font-weight: 400; color: var(--muted); text-shadow: none; opacity: 1; }
        .modal-header .close:hover { color: var(--ink); }

        .modal-body { padding: .4rem 1.7rem 1.5rem; color: var(--muted); }

        .modal-footer { border-top: 0; padding: 0 1.7rem 1.6rem; background: var(--surface); }

        /* ---------- Scrollbar ---------- */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-thumb { background: #c9d0df; border-radius: 10px; border: 2px solid var(--page); }
        ::-webkit-scrollbar-thumb:hover { background: #aab3c8; }

        @media (max-width: 767.98px) {
            .container-fluid { padding-left: 1rem; padding-right: 1rem; }
            #content::before { height: 12.5rem; border-radius: 0 0 20px 20px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition: none !important; animation: none !important; scroll-behavior: auto !important; }
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/admin/barang">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Data Barang</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/admin/laporan">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Laporan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="/sbadmin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- Content Row -->

                    @yield('content')

                    <!-- Content Row -->
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/sbadmin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sbadmin/js/demo/chart-area-demo.js"></script>
    <script src="/sbadmin/js/demo/chart-pie-demo.js"></script>

    <x-notify::notify />
    @notifyJs
    
</body>

</html>