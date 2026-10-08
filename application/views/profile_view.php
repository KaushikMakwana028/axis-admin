<style>
    /* Profile Specific Styles */
    .profile-card {
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 16px;
        box-shadow: 0 4px 20px -2px rgba(17, 24, 39, 0.05);
        overflow: hidden;
    }

    .profile-top-accent {
        height: 4px;
        background: var(--primary-gradient);
    }

    .avatar-wrapper {
        position: relative;
        display: inline-block;
        margin: 0 auto;
    }

    .profile-avatar-img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ff7a45;
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.15);
        background: #ffffff;
    }

    .avatar-camera-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 38px;
        height: 38px;
        background: #ffffff;
        border-radius: 50%;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        cursor: pointer;
        border: 2px solid #ffffff;
        transition: var(--transition);
    }

    .avatar-camera-btn:hover {
        background: var(--primary);
        color: #ffffff;
        transform: scale(1.08);
    }

    .role-pill-badge {
        display: inline-block;
        padding: 4px 16px;
        border-radius: 50px;
        border: 1px solid #ffd4c2;
        background: #fff8f5;
        color: var(--primary-dark);
        font-weight: 600;
        font-size: 0.82rem;
        letter-spacing: 0.2px;
    }

    /* Tabs Styling */
    .profile-nav-tabs {
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        padding-bottom: 0;
    }

    .profile-nav-tabs .nav-link {
        border: none;
        background: transparent;
        color: #475569;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.75rem 0.5rem 1rem;
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        text-decoration: none;
    }

    .profile-nav-tabs .nav-link:hover {
        color: var(--primary);
    }

    .profile-nav-tabs .nav-link.active {
        color: var(--primary);
        font-weight: 700;
    }

    .profile-nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 4px;
    }

    /* Form Fields */
    .profile-form .input-group-text {
        background-color: #f8fafc;
        border-color: #e2e8f0;
        color: #64748b;
        font-size: 0.95rem;
        padding: 0.65rem 0.95rem;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .profile-form .form-control,
    .profile-form .form-select {
        border-color: #e2e8f0;
        font-size: 0.92rem;
        padding: 0.65rem 0.95rem;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        color: #1e293b;
    }

    .profile-form .form-control:focus,
    .profile-form .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
    }

    .profile-form label {
        font-weight: 600;
        font-size: 0.88rem;
        color: #1e293b;
        margin-bottom: 0.45rem;
    }

    .btn-save-profile {
        background: var(--primary-gradient);
        border: none;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.65rem 1.6rem;
        border-radius: 10px;
        box-shadow: 0 4px 14px rgba(255, 107, 53, 0.35);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .btn-save-profile:hover {
        background: var(--primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(255, 107, 53, 0.4);
    }

    .info-list-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.15rem;
        font-size: 0.92rem;
    }

    .info-list-item i {
        font-size: 1.05rem;
        width: 22px;
        margin-top: 3px;
        color: #64748b;
    }
</style>

<!-- Page Header -->
<div class="mb-4">
    <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px; font-size: 1.75rem;">Profile Settings</h2>
    <p class="text-muted mb-0" style="font-size: 0.92rem;">Manage your personal information and account security.</p>
</div>

<div class="row g-4">
    <!-- Left Column: Profile Card -->
    <div class="col-12 col-lg-4">
        <div class="profile-card">
            <!-- Top Gradient Accent Stripe -->
            <div class="profile-top-accent"></div>

            <div class="p-4 text-center">
                <!-- Avatar with Camera Overlay Button -->
                <div class="avatar-wrapper mb-3">
                    <?php if (!empty($admin->profile_image) && file_exists(FCPATH . $admin->profile_image)): ?>
                        <img src="<?= base_url($admin->profile_image) ?>" alt="<?= html_escape($admin->name) ?>" class="profile-avatar-img" id="avatarPreview">
                    <?php else: ?>
                        <div class="profile-avatar-img d-flex align-items-center justify-content-center text-white fw-bold fs-1" id="avatarPreviewPlaceholder" style="background: var(--primary-gradient);">
                            <?= strtoupper(substr($admin->name ? $admin->name : 'A', 0, 1)) ?>
                        </div>
                        <img src="" alt="Preview" class="profile-avatar-img d-none" id="avatarPreview">
                    <?php endif; ?>

                    <!-- Camera Trigger Button -->
                    <label for="profile_image_file" class="avatar-camera-btn" title="Click to upload profile photo">
                        <i class="fa-solid fa-camera"></i>
                    </label>
                </div>

                <!-- Admin Name & Email -->
                <h4 class="fw-bold text-dark mb-1" id="displayProfileName"><?= html_escape($admin->name) ?></h4>
                <div class="text-muted small mb-2" id="displayProfileEmail"><?= html_escape($admin->email) ?></div>

                <!-- Role Pill Badge -->
                <div class="mb-3">
                    <span class="role-pill-badge">Admin Account</span>
                </div>

                <hr class="my-4" style="border-color: #f1f5f9; opacity: 1;">

                <!-- User Details Summary List -->
                <div class="text-start">
                    <div class="info-list-item">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <span class="fw-bold text-dark">Phone:</span>
                            <span class="text-muted ms-1" id="displayProfilePhone"><?= !empty($admin->phone) ? html_escape($admin->phone) : 'Not specified' ?></span>
                        </div>
                    </div>

                    <div class="info-list-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div>
                            <span class="fw-bold text-dark">Role:</span>
                            <span class="badge ms-1" style="border: 1px dashed var(--primary); background: var(--primary-light); color: var(--primary-dark); font-weight: 600; font-size: 0.78rem; border-radius: 6px; padding: 4px 9px;">Administrator</span>
                        </div>
                    </div>

                    <div class="info-list-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <div class="fw-bold text-dark">Address:</div>
                            <div class="text-muted small mt-1" id="displayProfileAddress"><?= !empty($admin->address) ? nl2br(html_escape($admin->address)) : 'No address provided' ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Settings Tabs Card -->
    <div class="col-12 col-lg-8">
        <div class="profile-card p-4">
            <!-- Navigation Tabs -->
            <ul class="nav profile-nav-tabs" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="edit-profile-tab" data-bs-toggle="tab" data-bs-target="#edit-profile-pane" type="button" role="tab" aria-controls="edit-profile-pane" aria-selected="true">
                        <i class="fa-solid fa-user-pen"></i>
                        <span>Edit Profile</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security-pane" type="button" role="tab" aria-controls="security-pane" aria-selected="false">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Password & Security</span>
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="profileTabContent">
                <!-- Tab 1: Edit Profile -->
                <div class="tab-pane fade show active" id="edit-profile-pane" role="tabpanel" aria-labelledby="edit-profile-tab">
                    <form action="<?= base_url('profile') ?>" method="POST" enctype="multipart/form-data" class="profile-form" id="profileForm">
                        <input type="hidden" name="form_type" value="profile">

                        <!-- Hidden File Input Triggered by Camera Button -->
                        <input type="file" id="profile_image_file" name="profile_image" accept="image/*" class="d-none">

                        <div class="row g-3">
                            <!-- Full Name -->
                            <div class="col-12 col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= html_escape(set_value('name', $admin->name)) ?>" placeholder="Enter full name" required>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= html_escape(set_value('email', $admin->email)) ?>" placeholder="Enter email address" required>
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-12 col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= html_escape(set_value('phone', $admin->phone)) ?>" placeholder="e.g. 9876543210">
                                </div>
                            </div>

                            <!-- Account Role / Status -->
                            <div class="col-12 col-md-6">
                                <label for="account_role" class="form-label">Role Access</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-shield-halved"></i></span>
                                    <input type="text" class="form-control bg-light text-dark fw-medium" id="account_role" value="Administrator" readonly>
                                </div>
                            </div>

                            <!-- Street Address -->
                            <div class="col-12">
                                <label for="address" class="form-label">Street Address</label>
                                <div class="input-group">
                                    <span class="input-group-text align-items-start pt-2"><i class="fa-solid fa-location-dot"></i></span>
                                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter street address..."><?= html_escape(set_value('address', $admin->address)) ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4 pt-2">
                            <button type="submit" class="btn btn-save-profile">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tab 2: Password & Security -->
                <div class="tab-pane fade" id="security-pane" role="tabpanel" aria-labelledby="security-tab">
                    <form action="<?= base_url('profile') ?>" method="POST" class="profile-form" id="passwordForm">
                        <input type="hidden" name="form_type" value="password">

                        <div class="row g-3">
                            <!-- Current Password -->
                            <div class="col-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password" required>
                                    <button class="btn btn-outline-secondary border-start-0 toggle-pass" type="button" data-target="current_password">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="col-12 col-md-6">
                                <label for="new_password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="At least 6 characters" minlength="6" required>
                                    <button class="btn btn-outline-secondary border-start-0 toggle-pass" type="button" data-target="new_password">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-12 col-md-6">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-check-double"></i></span>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter new password" minlength="6" required>
                                    <button class="btn btn-outline-secondary border-start-0 toggle-pass" type="button" data-target="confirm_password">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4 pt-2">
                            <button type="submit" class="btn btn-save-profile">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span>Update Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Live Avatar Image Preview
        const fileInput = document.getElementById('profile_image_file');
        const avatarPreview = document.getElementById('avatarPreview');
        const placeholder = document.getElementById('avatarPreviewPlaceholder');

        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                if (e.target.files && e.target.files[0]) {
                    const file = e.target.files[0];
                    if (!file.type.match('image.*')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid File',
                            text: 'Please select an image file (PNG, JPG, WEBP).',
                            confirmButtonColor: '#ff6b35'
                        });
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        if (placeholder) {
                            placeholder.classList.add('d-none');
                        }
                        if (avatarPreview) {
                            avatarPreview.src = event.target.result;
                            avatarPreview.classList.remove('d-none');
                        }

                        // Helpful toast
                        Swal.fire({
                            icon: 'info',
                            title: 'Photo Selected',
                            text: "Click 'Save Changes' to apply your new profile photo.",
                            timer: 2500,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Toggle Password Visibility
        const toggleButtons = document.querySelectorAll('.toggle-pass');
        toggleButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (targetInput) {
                    if (targetInput.type === 'password') {
                        targetInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        targetInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                }
            });
        });

        <?php if ($this->session->flashdata('error') && (strpos(strtolower($this->session->flashdata('error')), 'password') !== false)): ?>
        // Switch to password tab if password error occurred
        const securityTab = document.getElementById('security-tab');
        if (securityTab) {
            const tabInstance = new bootstrap.Tab(securityTab);
            tabInstance.show();
        }
        <?php endif; ?>
    });
</script>
