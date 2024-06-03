<?= $this->include('templates/admin/header.php'); ?>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><?= $title; ?></h1>
                </div>
            </div>
        </div>

        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div class="container">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="card card-flush pt-3 mb-5 mb-lg-10">
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bolder">Bayi Bilgileri</h2>
                        </div>
                    </div>
                    <form method="post">
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">İsim</div>
                                <input name="name" id="name"
                                       class="form-control form-contorl-lg" value="<?= $user['name']; ?>" required>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Telefon</div>
                                <input name="phone" id="phone"
                                       class="form-control form-control-lg"
                                       value="<?= $user['phone']; ?>"
                                       required>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Email</div>
                                <input name="email" id="email"
                                       value="<?= $user['email']; ?>"
                                       class="form-control form-control-lg" required>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Şifre</div>
                                <input name="password" id="password" type="password"
                                       class="form-control form-control-lg">
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Şifre Onayla</div>
                                <input name="password_confirmation" id="password_confirmation" type="password"
                                       class="form-control form-control-lg">
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Bakiye</div>
                                <input name="balance" id="balance" class="form-control form-control-lg"
                                       value="<?= number_format($user['balance'], 2); ?>"
                                       required>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Fiyat Profili</div>
                                <select name="price_profile_id" id="price_profile_id"
                                        class="form-select form-select-lg fw-bold">
                                    <?php foreach ($price_profiles as $price_profile): ?>
                                        <option value="<?= $price_profile['id']; ?>" <?= $price_profile['id'] == $user['price_profile_id'] ? 'selected' : ''; ?>><?= $price_profile['profile_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex flex-column fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Güncelle</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            phone = document.getElementById('phone').value;
            if (
                /^(\+?\d{1,3})?(\d{10})$/.test(phone) === false
            ) {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Telefon numarası geçersiz.',
                    icon: 'error',
                    confirmButtonText: 'Tamam'
                });
                return false;
            }

            email = document.getElementById('email').value;
            password = document.getElementById('password').value;
            password_confirmation = document.getElementById('password_confirmation').value;

            if (
                email === password
            ) {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Email ve şifre aynı olamaz.',
                    icon: 'error',
                    confirmButtonText: 'Tamam'
                });
                return false;
            }

            balance = document.getElementById('balance').value;
            if (
                /^[+-]?\d+(\.\d+)?([Ee][+-]?\d+)?$/.test(balance) === false
            ) {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Bakiye sayısal bir değer olmalıdır.',
                    icon: 'error',
                    confirmButtonText: 'Tamam'
                });
                return false;
            }

            if (
                password !== password_confirmation
            ) {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Şifreler uyuşmuyor.',
                    icon: 'error',
                    confirmButtonText: 'Tamam'
                });
                return false;
            }

            form.submit();
        });
    </script>
<?= $this->include('templates/footer.php'); ?>