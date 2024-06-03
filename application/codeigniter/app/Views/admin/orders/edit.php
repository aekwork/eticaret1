<?php

use function App\Helpers\getOrderStatus;

?>
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
                            <h2 class="fw-bolder">Ürün Bilgileri</h2>
                        </div>
                    </div>
                    <form method="post">
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Ürün Kodu</div>
                                <input type="text" name="product_code" id="product_code"
                                       class="form-control form-control-lg form-control-solid"
                                       value="<?= $order['product_code']; ?>" required readonly>
                                <small>Ürün kodu otomatik olarak oluşturulmaktadır.</small>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Ürün Resmi</div>
                                <img alt="Ürün Resmi" class="mw-250px mh-100" src="<?= $order['product_image']; ?>">
                                <input type="file" name="product_image" id="product_image"
                                       class="form-control form-control-lg mt-2">
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Ürün Ölçüsü</div>
                                <select name="product_frame_size" id="product_frame_size"
                                        class="form-control form-contorl-lg" required>
                                    <option value="0" disabled selected><?= $order['product_frame_size']; ?></option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Ürün Çerçevesi</div>
                                <select name="product_frame_type" id="product_frame_type"
                                        class="form-control form-control-lg" data-is-loaded="false"
                                        required>
                                    <option value="1" <?= $order['product_frame_type'] == 'Var' ? 'selected' : '' ?>>Var
                                    </option>
                                    <option value="2" <?= $order['product_frame_type'] == 'Yok' ? 'selected' : '' ?>>Yok
                                    </option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Çerçeve Rengi</div>
                                <select name="product_frame_color" id="product_frame_color"
                                        class="form-control form-control-lg" required>
                                    <option value="0" disabled selected><?= $order['product_frame_color'] ?></option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Alıcı Ülke</div>
                                <select name="recipient_country" id="recipient_country"
                                        class="form-control form-control-lg"
                                        required>
                                    <option value="0" disabled selected><?= $order['recipient_country']; ?></option>
                                </select>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Alıcı Adı</div>
                                <input type="text" class="form-control form-control-lg"
                                       value="<?= $order['recipient_name']; ?>" name="recipient_name" required>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Alıcı Adres</div>
                                <textarea rows="5" class="form-control form-control-lg"
                                          name="recipient_address"
                                          required><?= $order['recipient_address']; ?></textarea>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Alıcı Telefon</div>
                                <input type="text" class="form-control form-control-lg"
                                       value="<?= $order['recipient_phone']; ?>" name="recipient_phone">
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Alıcı Email</div>
                                <input type="email" class="form-control form-control-lg"
                                       value="<?= $order['recipient_email']; ?>" name="recipient_email" required>
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">IOSS/VAT Number</div>
                                <input type="text" class="form-control form-control-lg"
                                       value="<?= $order['recipient_iossvat']; ?>" name="recipient_iossvat">
                            </div>
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Hediye Paketi</div>
                                <select name="gift_package" id="gift_package" class="form-control form-control-lg"
                                        required>
                                    <option value="1" <?= $order['gift_package'] == 'Var' ? 'selected' : ''; ?>>Var
                                    </option>
                                    <option value="2" <?= $order['gift_package'] == 'Yok' ? 'selected' : ''; ?>>Yok
                                    </option>
                                </select>
                            </div>
                            <div class="d-block flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Fiyat Toplam:</div>
                                <span class="d-inline" id="price_total"><?= $order['total_paid']; ?></span>
                                <span class="d-inline">$</span>
                            </div>
                            <div class="d-block flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Sipariş Durumu:</div>
                                <select name="status" id="status" class="form-control form-control-lg" required>
                                    <?php
                                    foreach ($status_codes as $status_code): ?>
                                        <option value="<?= $status_code['id']; ?>" <?= $order['status'] == $status_code['name'] ? 'selected' : ''; ?>><?= getOrderStatus($status_code['id']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-block flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="fs-5 fw-bolder form-label mb-3">Sipariş Notu:</div>
                                <textarea name="order_note" id="order_note" cols="30" rows="10"
                                          class="form-control form-control-lg"><?= $order['note']; ?></textarea>
                            </div>
                            <div class="d-flex flex-column fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <button type="submit" class="btn btn-lg btn-success w-100">Güncelle</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener(
            "DOMContentLoaded",
            function () {
                var valueIsChanged = false;
                let waitTime = 1000;
                const timer = () => {
                    getProductFrameTypes()
                    calculatePriceTotal()
                    waitTime += 1000;
                    setTimeout(timer, waitTime);
                }

                setTimeout(timer, waitTime);
                const product_image_input = document.querySelector('#product_image');
                product_image_input.addEventListener(
                    'change',
                    function () {
                        let product_image = document.querySelector('#product_image + img');
                        product_image.style.display = 'block';
                        product_image.src = URL.createObjectURL(this.files[0]);
                    }
                )

                const product_frame_size_input = document.querySelector('#product_frame_size');
                const product_frame_type_input = document.querySelector('#product_frame_type');
                const product_frame_color_input = document.querySelector('#product_frame_color');
                const recipient_country_input = document.querySelector('#recipient_country');
                const price_total = document.querySelector('#price_total');
                const gift_package_input = document.querySelector('#gift_package');

                getProductFrameSizes()
                getProductFrameTypes()
                getProductFrameColors()
                getRecipientCountries()
                calculatePriceTotal()


                product_frame_size_input.addEventListener(
                    'change',
                    function () {
                        getProductFrameTypes()
                        getProductFrameColors(true)
                        calculatePriceTotal()
                    }
                )

                product_frame_type_input.addEventListener(
                    'change',
                    function () {
                        getProductFrameColors(true)
                        calculatePriceTotal()
                    }
                )

                product_frame_color_input.addEventListener(
                    'change',
                    function () {
                        calculatePriceTotal()
                    }
                )

                recipient_country_input.addEventListener(
                    'change',
                    function () {
                        calculatePriceTotal()
                    }
                )

                gift_package_input.addEventListener(
                    'change',
                    function () {
                        calculatePriceTotal()
                    }
                )

                function getProductFrameSizes() {
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '<?= base_url('api/getProductFrameSizes') ?>', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (this.status === 200) {
                            let product_sizes = JSON.parse(this.responseText);
                            product_frame_size_input.innerHTML = '';
                            product_frame_size_input.innerHTML += '<option value=0 disabled selected>Seçiniz</option>';
                            product_sizes.forEach(function (product_size) {
                                product_frame_size_input.innerHTML += '<option ' + (product_size.size === "<?= $order['product_frame_size']; ?>" ? 'selected ' : '') + 'value="' + product_size.id + '">' + product_size.size + '</option>';
                            })
                        }
                    }
                    xhr.send("user_id=<?= $order['user_id']; ?>");
                    getProductFrameTypes()
                }

                function getProductFrameTypes() {
                    let xhr = new XMLHttpRequest();
                    let isLoaded = true;
                    if (product_frame_type_input.value === '0') {
                        isLoaded = false;
                    }
                    let frame_size_id = product_frame_size_input.value;
                    xhr.open('POST', '<?= base_url('api/getProductFrameTypes') ?>', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (
                            this.status === 200 && !isLoaded
                        ) {
                            let frame_types = JSON.parse(this.responseText);

                            product_frame_type_input.innerHTML = '';
                            product_frame_type_input.innerHTML += '<option value="0" disabled selected>Seçiniz</option>';
                            frame_types.forEach(function (frame_type) {
                                product_frame_type_input.innerHTML += '<option ' + (
                                        frame_type.frame_type_id === '1' && 'Var' === '<?= $order['product_frame_type']; ?>' ? 'selected ' : ''
                                    ) + (
                                        frame_type.frame_type_id === '2' && 'Yok' === '<?= $order['product_frame_type']; ?>' ? 'selected ' : ''
                                    )
                                    + ' value="' + frame_type.frame_type_id + '">' + (
                                        frame_type.frame_type_id === '1' ? 'Var' : ''
                                    ) + (
                                        frame_type.frame_type_id === '2' ? 'Yok' : ''
                                    ) + '</option>';
                            })

                        } else if (
                            Array.from(product_frame_type_input.options).some(
                                option => option.selected && option.value === '2'
                            )) {
                            product_frame_color_input.innerHTML = '<option value="0" selected disabled>Çerçeve Rengi Yok</option>';
                        }
                    }
                    xhr.send('frame_size_id=' + frame_size_id + '&user_id=<?= $order['user_id']; ?>');
                    getProductFrameColors()
                }

                function getProductFrameColors(changeValue) {
                    if (changeValue !== undefined) {
                        valueIsChanged = changeValue;
                    }
                    let xhr = new XMLHttpRequest();
                    let frame_size_id = product_frame_size_input.value;
                    let frame_type_id = document.querySelector('#product_frame_type').value;
                    xhr.open('POST', '<?= base_url('api/getProductFrameColors') ?>', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (
                            this.status === 200 &&
                            Array.from(product_frame_type_input.options).some(
                                option => option.selected && option.value === '1'
                            )) {
                            let product_colors = JSON.parse(this.responseText);
                            product_frame_color_input.innerHTML = '';
                            product_frame_color_input.innerHTML += '<option value="0" disabled selected>Seçiniz</option>';
                            product_colors.forEach(function (product_color) {
                                product_frame_color_input.innerHTML += '<option ' + (product_color.color_name === '<?=  $order['product_frame_color']; ?>' && !valueIsChanged ? 'selected ' : '') + 'value="' + product_color.id + '">' + product_color.color_name + '</option>';
                            })
                        } else if (
                            Array.from(product_frame_type_input.options).some(
                                option => option.selected && option.value === '2'
                            )) {
                            product_frame_color_input.innerHTML = '<option value="0" selected disabled>Çerçeve Rengi Yok</option>';
                        }
                    }
                    xhr.send('frame_size_id=' + frame_size_id + '&frame_type_id=' + frame_type_id + '&user_id=<?= $order['user_id']; ?>');
                }

                function getRecipientCountries() {
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '<?= base_url('api/getRecipientCountries') ?>', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (this.status === 200) {
                            let recipient_countries = JSON.parse(this.responseText);
                            recipient_country_input.innerHTML = '';
                            recipient_country_input.innerHTML += '<option value=0 disabled selected>Seçiniz</option>';
                            recipient_countries.forEach(function (recipient_country) {
                                recipient_country_input.innerHTML += '<option ' + (recipient_country.country_name === "<?= $order['recipient_country']; ?>" ? 'selected ' : '') + ' value="' + recipient_country.id + '">' + recipient_country.country_name + '</option>';
                            })
                        }
                    }
                    xhr.send();
                }

                function calculatePriceTotal() {
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '<?= base_url('api/calculatePriceTotal') ?>', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (this.status === 200) {
                            price_total.innerHTML = this.responseText;
                        }
                    }
                    xhr.send("product_frame_size=" + product_frame_size_input.value +
                        "&product_frame_type=" + product_frame_type_input.value +
                        "&product_frame_color=" + product_frame_color_input.value +
                        "&recipient_country=" + recipient_country_input.value +
                        "&gift_package=" + document.querySelector('#gift_package').value +
                        "&user_id=<?= $order['user_id']; ?>"
                    );
                }
            }
        )


    </script>
<?= $this->include('templates/footer.php'); ?>