@extends('admin.layouts.app')
@section('title', 'Create User')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white py-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avatar-sm bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-plus fa-lg text-white"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h4 class="mb-1">Create New User</h4>
                        <p class="mb-0 opacity-75">Add a new user to the system with appropriate permissions</p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back to Users
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-5">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger me-3"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="alert-heading mb-2">Please fix the following errors:</h5>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.user.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data" id="userForm">
                    @csrf

                    <div class="row g-4">
                        <!-- Personal Information Section -->
                        <div class="col-12">
                            <div class="section-header mb-4">
                                <h5 class="text-primary mb-2">
                                    <i class="fas fa-user-circle me-2"></i>Personal Information
                                </h5>
                                <p class="text-muted mb-0">Basic user details and credentials</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control shadow-sm" id="name" name="name"
                                       placeholder="John Doe" required value="{{ old('name') }}"
                                       oninput="validateField(this)">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-2 text-primary"></i>Full Name
                                </label>
                                <div class="invalid-feedback">
                                    Please provide a valid name.
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control shadow-sm" id="email" name="email"
                                       placeholder="name@example.com" required value="{{ old('email') }}"
                                       oninput="validateField(this)">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                                </label>
                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>
                                <div class="valid-feedback">
                                    Email looks good!
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input type="password" class="form-control shadow-sm" id="password" name="password"
                                       placeholder="Password" required minlength="8"
                                       oninput="validatePassword()">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2 text-primary"></i>Password
                                </label>
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                    <i class="fas fa-eye-slash toggle-password text-muted"
                                       onclick="togglePassword('password')" style="cursor: pointer;"></i>
                                </span>
                                <div class="invalid-feedback">
                                    Password must be at least 8 characters long.
                                </div>
                                <div class="valid-feedback">
                                    Strong password!
                                </div>
                                <div class="password-strength mt-2">
                                    <div class="progress" style="height: 4px;">
                                        <div class="progress-bar" id="passwordStrength" role="progressbar"
                                             style="width: 0%; transition: width 0.3s ease;"></div>
                                    </div>
                                    <small class="text-muted" id="passwordHint">Minimum 8 characters</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input type="password" class="form-control shadow-sm" id="password_confirmation"
                                       name="password_confirmation" placeholder="Confirm Password" required
                                       oninput="validatePasswordMatch()">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock me-2 text-primary"></i>Confirm Password
                                </label>
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                    <i class="fas fa-eye-slash toggle-password text-muted"
                                       onclick="togglePassword('password_confirmation')" style="cursor: pointer;"></i>
                                </span>
                                <div class="invalid-feedback" id="passwordMatchError">
                                    Passwords do not match.
                                </div>
                                <div class="valid-feedback">
                                    Passwords match!
                                </div>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="col-12">
                            <div class="section-header mb-4 mt-2">
                                <h5 class="text-primary mb-2">
                                    <i class="fas fa-shield-alt me-2"></i>User Role & Permissions
                                </h5>
                                <p class="text-muted mb-0">Assign appropriate access level</p>
                            </div>

                            <div class="form-floating">
                                <select class="form-select shadow-sm" id="role" name="role" required
                                        onchange="showRoleDescription()">
                                    <option value="" disabled selected>Select a role</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Standard User</option>
                                </select>
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-tag me-2 text-primary"></i>User Role
                                </label>
                                <div class="invalid-feedback">
                                    Please select a user role.
                                </div>
                            </div>

                            <div class="role-description mt-3 p-3 bg-light rounded" id="roleDescription" style="display: none;">
                                <h6 class="text-primary mb-2" id="roleTitle">Role Description</h6>
                                <p class="mb-0 text-muted" id="roleText">Select a role to see description</p>
                            </div>
                        </div>

                        <!-- Avatar Upload -->
                        <div class="col-12">
                            <div class="section-header mb-4 mt-2">
                                <h5 class="text-primary mb-2">
                                    <i class="fas fa-camera me-2"></i>Profile Picture
                                </h5>
                                <p class="text-muted mb-0">Upload a profile picture (optional)</p>
                            </div>

                            <div class="avatar-upload-container">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-3 mb-md-0">
                                        <div class="avatar-preview shadow-sm rounded-circle mx-auto"
                                             style="width: 120px; height: 120px; background: #f8f9fa; border: 2px dashed #dee2e6; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                            <i class="fas fa-user fa-3x text-muted" id="avatarPreviewIcon"></i>
                                            <img src="" alt="Avatar Preview" id="avatarPreview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="file-upload-area">
                                            <input type="file" class="form-control shadow-sm" id="avatar" name="avatar"
                                                   accept="image/jpeg,image/png,image/gif" onchange="previewAvatar(this)">
                                            <div class="form-text">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Supported formats: JPEG, PNG, GIF. Max size: 2MB
                                            </div>
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearAvatar()">
                                                    <i class="fas fa-times me-1"></i>Clear
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-12 mt-5">
                            <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                <div>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary px-4">
                                        <i class="fas fa-arrow-left me-2"></i>Cancel
                                    </a>
                                </div>
                                <div>
                                    <button type="reset" class="btn btn-outline-danger me-2 px-4">
                                        <i class="fas fa-redo me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                        <i class="fas fa-user-plus me-2"></i>Create User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.section-header {
    border-left: 4px solid var(--primary-color);
    padding-left: 1rem;
}

.card {
    border-radius: 1rem;
    overflow: hidden;
}

.card-header {
    border-radius: 1rem 1rem 0 0 !important;
}

.form-control, .form-select {
    border-radius: 0.75rem;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(91, 115, 232, 0.1);
    transform: translateY(-2px);
}

.form-floating > label {
    padding-left: 2.5rem;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    color: var(--primary-color);
    transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
}

.toggle-password:hover {
    color: var(--primary-color) !important;
    transform: scale(1.1);
}

.password-strength .progress {
    border-radius: 2px;
}

.avatar-preview {
    transition: all 0.3s ease;
    cursor: pointer;
}

.avatar-preview:hover {
    border-color: var(--primary-color) !important;
    transform: scale(1.05);
}

.file-upload-area {
    position: relative;
}

.btn {
    border-radius: 0.75rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.valid-feedback, .invalid-feedback {
    display: none;
}

.was-validated .form-control:valid ~ .valid-feedback,
.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

.role-description {
    border-left: 4px solid var(--primary-color);
    transition: all 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.3s ease;
}
</style>
@endsection

@push('scripts')
<script>
// Password visibility toggle
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.parentNode.querySelector('.toggle-password');

    if (field.type === "password") {
        field.type = "text";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        field.type = "password";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

// Password strength indicator
function validatePassword() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('passwordStrength');
    const hint = document.getElementById('passwordHint');

    let strength = 0;
    let hints = [];

    if (password.length >= 8) strength += 25;
    if (password.match(/[a-z]/)) strength += 25;
    if (password.match(/[A-Z]/)) strength += 25;
    if (password.match(/[0-9]/)) strength += 25;

    strengthBar.style.width = strength + '%';

    // Update color based on strength
    if (strength < 50) {
        strengthBar.className = 'progress-bar bg-danger';
        hint.textContent = 'Weak password';
        hint.className = 'text-danger';
    } else if (strength < 75) {
        strengthBar.className = 'progress-bar bg-warning';
        hint.textContent = 'Moderate password';
        hint.className = 'text-warning';
    } else {
        strengthBar.className = 'progress-bar bg-success';
        hint.textContent = 'Strong password!';
        hint.className = 'text-success';
    }

    validatePasswordMatch();
}

// Password match validation
function validatePasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const errorElement = document.getElementById('passwordMatchError');

    if (confirmPassword && password !== confirmPassword) {
        errorElement.textContent = 'Passwords do not match.';
        return false;
    } else if (confirmPassword && password === confirmPassword) {
        errorElement.textContent = '';
        return true;
    }
    return false;
}

// Role description
function showRoleDescription() {
    const roleSelect = document.getElementById('role');
    const descriptionDiv = document.getElementById('roleDescription');
    const roleTitle = document.getElementById('roleTitle');
    const roleText = document.getElementById('roleText');

    const descriptions = {
        'admin': {
            title: 'Administrator',
            text: 'Full system access including user management, settings, and all administrative functions.'
        },
        'employee': {
            title: 'Employee',
            text: 'Limited access to specific modules and functions relevant to their job role.'
        },
        'user': {
            title: 'Standard User',
            text: 'Basic access with limited permissions, typically for viewing information only.'
        }
    };

    if (roleSelect.value && descriptions[roleSelect.value]) {
        roleTitle.textContent = descriptions[roleSelect.value].title;
        roleText.textContent = descriptions[roleSelect.value].text;
        descriptionDiv.style.display = 'block';
        descriptionDiv.classList.add('fade-in');
    } else {
        descriptionDiv.style.display = 'none';
    }
}

// Avatar preview
function previewAvatar(input) {
    const preview = document.getElementById('avatarPreview');
    const previewIcon = document.getElementById('avatarPreviewIcon');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            previewIcon.style.display = 'none';
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Clear avatar
function clearAvatar() {
    const input = document.getElementById('avatar');
    const preview = document.getElementById('avatarPreview');
    const previewIcon = document.getElementById('avatarPreviewIcon');

    input.value = '';
    preview.style.display = 'none';
    previewIcon.style.display = 'block';
}

// Field validation with visual feedback
function validateField(field) {
    field.classList.remove('is-valid', 'is-invalid');

    if (field.checkValidity()) {
        field.classList.add('is-valid');
    } else {
        field.classList.add('is-invalid');
    }
}

// Form submission enhancement
document.getElementById('userForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;

    if (this.checkValidity()) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating User...';
        submitBtn.disabled = true;
    } else {
        this.classList.add('was-validated');
        e.preventDefault();
        e.stopPropagation();
    }
});

// Initialize role description if value exists
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    if (roleSelect.value) {
        showRoleDescription();
    }

    // Add floating label enhancement
    const floatingLabels = document.querySelectorAll('.form-floating');
    floatingLabels.forEach(floatingLabel => {
        const input = floatingLabel.querySelector('.form-control, .form-select');
        if (input.value) {
            input.classList.add('has-value');
        }

        input.addEventListener('input', function() {
            if (this.value) {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });
});
</script>
@endpush
