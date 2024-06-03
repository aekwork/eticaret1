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
                            <h2 class="fw-bolder">Fiyat Profili</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row mb-10">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Fiyat Profili Adı</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="profile_name" class="form-control form-control-lg form-control-solid" placeholder="Fiyat profili adı" value="<?= $priceProfile['profile_name']; ?>">
                                </div>
                            </div>

                            <div class="d-flex pt-15">
                                <div class="me-5">
                                    <a href="/admin/price-management" class="btn btn-lg btn-danger btn-active-primary">İptal</a>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-lg btn-primary">Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include('templates/footer.php'); ?>