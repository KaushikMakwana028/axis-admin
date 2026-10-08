<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AXIS</title>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #ff6b35;
            --primary-dark: #e85a2a;
            --primary-light: #fff1ec;
            --primary-gradient: linear-gradient(135deg, #ff6b35 0%, #ff8c5a 100%);
        }

        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            color: #334155;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        .login-header {
            background: var(--primary-light);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 107, 53, 0.15);
        }

        .brand-badge {
            background: var(--primary-gradient);
            color: #ffffff;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 10px 20px rgba(255, 107, 53, 0.35);
            margin-bottom: 1rem;
        }

        .login-body {
            padding: 2.25rem 2rem;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 0.4rem;
        }

        .input-group-text {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #94a3b8;
        }

        .form-control {
            border-color: #e2e8f0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.15);
        }

        .btn-submit {
            background: var(--primary-gradient);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 0.85rem;
            font-size: 1rem;
            border-radius: 10px;
            width: 100%;
            box-shadow: 0 6px 18px rgba(255, 107, 53, 0.35);
            transition: all 0.25s ease;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(255, 107, 53, 0.45);
        }

        .credential-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            font-size: 0.82rem;
            color: #475569;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <div class="brand-badge">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <h3 class="fw-bold mb-1" style="color: #1e293b; letter-spacing: -0.5px;">AXIS Admin Portal</h3>
        <p class="text-muted small mb-0">Sign in with your email credentials to manage your store</p>
    </div>

    <div class="login-body">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="font-size: 0.88rem;">
                <i class="fa-solid fa-triangle-exclamation me-1"></i>
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="font-size: 0.88rem;">
                <i class="fa-solid fa-circle-check me-1"></i>
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST" autocomplete="off">
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" value="<?= html_escape(set_value('email')) ?>" placeholder="name@domain.com" required autofocus>
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter your password" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In to Admin Panel
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toggleBtn = document.getElementById('togglePassword');
    const pwdInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                pwdInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    }
</script>
</body>
</html>
