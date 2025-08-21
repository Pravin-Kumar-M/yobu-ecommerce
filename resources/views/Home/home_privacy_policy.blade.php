<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <div class="container my-5">
        <h2 class="mb-4">Privacy & Security Settings</h2>

        <!-- Privacy Policy Summary -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Privacy Policy</h5>
            </div>
            <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                <p>
                    We respect your privacy and are committed to protecting your personal information.
                    Your data will only be used to provide and improve our services. We never share your
                    information with third parties without your consent unless required by law.
                </p>
                <a href="#" class="btn btn-link p-0">Read Full Privacy Policy</a>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Security Settings</h5>
            </div>
            <div class="card-body">
                <form id="securitySettingsForm">
                    <!-- Change Password -->
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" required>
                        <div class="form-text">
                            Password must be at least 8 characters, include uppercase, number, and special character.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                    </div>

                    <hr>

                    <!-- Two-Factor Authentication Toggle -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                        <label class="form-check-label" for="twoFactorAuth">Enable Two-Factor Authentication (2FA)</label>
                    </div>

                    <hr>

                    <!-- Data Sharing Preferences -->
                    <h6>Data Sharing Preferences</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="shareUsageData" checked>
                        <label class="form-check-label" for="shareUsageData">
                            Allow anonymous usage data collection to improve our service
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="shareMarketingData">
                        <label class="form-check-label" for="shareMarketingData">
                            Allow sharing data with marketing partners
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success mt-4">Save Settings</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Password confirmation validation
        const form = document.getElementById('securitySettingsForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;

            if (newPass !== confirmPass) {
                alert("New password and confirmation don't match, love! 💔");
                return;
            }

            // Optional: Add password strength validation here

            alert("Your privacy and security settings have been saved securely. 🔐");
            // Add your logic to submit form securely (e.g., API call)
        });
    </script>



    @include ('Home.home_footer')


</body>

</html>