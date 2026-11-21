<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Redesign login (override SB Admin 2) -->
    <style>
        :root {
            --brand-1: #4f46e5;
            --brand-2: #06b6d4;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
        }

        body.bg-gradient-primary {
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(900px 500px at 10% 0%, rgba(6, 182, 212, .35), transparent 60%),
                radial-gradient(800px 500px at 100% 100%, rgba(167, 139, 250, .35), transparent 60%),
                linear-gradient(135deg, #1e1b4b 0%, #312e81 55%, #0e7490 100%);
            background-attachment: fixed;
        }

        /* kartu utama */
        .card.o-hidden {
            border-radius: 28px;
            box-shadow: 0 30px 80px -20px rgba(2, 6, 23, .6) !important;
        }

        /* panel gambar */
        .bg-login-image {
            background: linear-gradient(160deg, #4f46e5 0%, #6366f1 45%, #06b6d4 100%) !important;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
        }

        .bg-login-image br { display: none; }

        .bg-login-image img {
            width: 90%;
            max-width: 440px;
            filter: drop-shadow(0 20px 30px rgba(15, 23, 42, .35));
        }

        /* panel form */
        .col-lg-6 > .p-5 {
            padding: 3.5rem 3.25rem !important;
        }

        .col-lg-6 > .p-5 h1.h4 {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: .08em;
            color: var(--ink) !important;
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2.25rem !important;
        }

        .col-lg-6 > .p-5 h1.h4::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 56px;
            height: 4px;
            border-radius: 4px;
            transform: translateX(-50%);
            background: linear-gradient(90deg, var(--brand-1), var(--brand-2));
        }

        /* input */
        .form-control-user {
            height: 3.4rem;
            padding: .75rem 1.5rem;
            border-radius: 14px;
            border: 1.5px solid var(--line);
            background: #f8fafc;
            color: var(--ink);
            font-size: .95rem;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-control-user:focus {
            background: #fff;
            border-color: var(--brand-1);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, .15);
            outline: none;
        }

        .form-group { margin-bottom: 1.1rem; }

        /* tombol */
        .btn-user {
            height: 3.4rem;
            border: 0;
            border-radius: 14px;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: .06em;
            background: linear-gradient(90deg, var(--brand-1), var(--brand-2));
            box-shadow: 0 14px 28px -10px rgba(79, 70, 229, .7);
            transition: transform .15s, box-shadow .15s, filter .15s;
        }

        .btn-user:hover,
        .btn-user:focus {
            transform: translateY(-2px);
            filter: brightness(1.06);
            box-shadow: 0 18px 32px -10px rgba(79, 70, 229, .8);
        }

        .btn-user:active { transform: translateY(0); }

        @media (max-width: 575.98px) {
            .col-lg-6 > .p-5 { padding: 2.25rem 1.5rem !important; }
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <br/>
                                <img src="/sbadmin/logo.svg" width="70%" alt="Ilustrasi inventaris">
                            </div>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN INVENTARIS</h1>
                                    </div>

                                    {{-- form login --}}
                                    <form class="user" action="/login" method="POST">                                        
                                        @csrf

                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    {{-- --------------------------- --}}

                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>