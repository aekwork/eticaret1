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
                            <h2 class="fw-bolder">Site Ayarları</h2>
                        </div>
                    </div>
                    <form method="post">
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Site Adı</div>
                                <input name="siteName" id="siteName"
                                       class="form-control form-contorl-lg" value="<?= $settings['siteName']; ?>" required>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Şifremi Unuttum (Whatsapp Telefon Numarası)</div>
                                <input name="whatsapp_number" id="whatsapp_number"
                                       class="form-control form-control-lg"
                                       value="<?= $settings['whatsapp_number']; ?>"
                                       required>
                            </div>
                              <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Bakiye Sayfası HTML</div>
                                <textarea name="balance_page_html" id="balance_page_html"
                                       class="form-control form-control-lg"
                                       rows="10"
                                       required><?= $settings['balance_page_html']; ?></textarea>
                            </div>
                            <div class="d-flex flex-column fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <button type="submit" class="btn btn-lg btn-success w-100">Kaydet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->include('templates/footer.php'); ?>