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
                <div class="card card-flush pt-3 mb-5 mb-lg-10">
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bolder">Kullanıcı Bilgileri</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">ID</div>
                            <input type="text" name="id" id="id"
                                   class="form-control form-control-lg"
                                   value="<?= $user['id']; ?>" required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">İsim</div>
                            <input value="<?= $user['name']; ?>" name="name" id="name"
                                   class="form-control form-contorl-lg" required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Telefon</div>
                            <input value="<?= $user['phone']; ?>" name="phone" id="phone"
                                   class="form-control form-control-lg"
                                   required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Email</div>
                            <input value="<?= $user['email']; ?>" name="email" id="email"
                                   class="form-control form-control-lg" required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Bakiye</div>
                            <input value="<?= number_format($user['balance'], 2); ?>$" name="balance" id="balance"
                                   class="form-control form-control-lg"
                                   required disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include('templates/footer.php'); ?>