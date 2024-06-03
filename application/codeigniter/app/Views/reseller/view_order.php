<?= $this->include('templates/reseller/header.php'); ?>
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
                            <h2 class="fw-bolder">Ürün Bilgileri</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-block flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Sipariş Durumu:</div>
                            <span class="d-inline text-primary" id="order_status"><?= $order['status']; ?></span>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Kodu</div>
                            <input type="text" name="product_code" id="product_code"
                                   class="form-control form-control-lg"
                                   value="<?= $order['product_code']; ?>" required disabled>
                            <small>Ürün kodu otomatik olarak oluşturulmaktadır.</small>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Resmi</div>
                            <img
                                    alt="Ürün Resmi"
                                    class="mw-150px mh-100" src="<?= $order['product_thumbnail']; ?>">
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Ölçüsü</div>
                            <input value="<?= $order['product_frame_size']; ?>" name="product_frame_size"
                                   id="product_frame_size"
                                   class="form-control form-contorl-lg" required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Çerçevesi</div>
                            <input value="<?= $order['product_frame_type']; ?>" name="product_frame_type"
                                   id="product_frame_type"
                                   class="form-control form-control-lg"
                                   required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Çerçeve Rengi</div>
                            <input value="<?= $order['product_frame_color']; ?>" name="product_frame_color"
                                   id="product_frame_color"
                                   class="form-control form-control-lg" required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Ülke</div>
                            <input value="<?= $order['recipient_country']; ?>" name="recipient_country"
                                   id="recipient_country" class="form-control form-control-lg"
                                   required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Adı</div>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="<?= $order['recipient_name']; ?>" name="recipient_name" required disabled>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Adres</div>
                            <textarea rows="5" class="form-control form-control-lg form-control-solid"
                                      name="recipient_address" required><?= $order['recipient_address']; ?></textarea>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Telefon</div>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="<?= $order['recipient_phone']; ?>" name="recipient_phone" required>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Email</div>
                            <input type="email" class="form-control form-control-lg form-control-solid"
                                   value="<?= $order['recipient_email']; ?>" name="recipient_email" required>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">IOSS/VAT Number</div>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="<?= $order['recipient_iossvat']; ?>" name="recipient_iossvat" required>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Hediye Paketi</div>
                            <input value="<?= $order['gift_package']; ?>" name="gift_package" id="gift_package"
                                   class="form-control form-control-lg" disabled required>
                        </div>
                        <div class="d-block flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Fiyat Toplam:</div>
                            <span class="d-inline" id="price_total"><?= $order['total_paid']; ?></span>
                            <span class="d-inline">$</span>
                        </div>
                        <div class="d-block flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Sipariş Notu:</div>
                            <textarea name="order_note" id="order_note" cols="30" rows="10" disabled
                                      class="form-control form-control-lg"><?= $order['note']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include('templates/footer.php'); ?>