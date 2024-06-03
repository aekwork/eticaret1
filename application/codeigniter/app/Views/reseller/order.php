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
                <form method="post" enctype="multipart/form-data" action="<?= base_url('order/create'); ?>">
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Kodu</div>
                            <input type="text" name="product_code" id="product_code"
                                   class="form-control form-control-lg"
                                   value="<?= $product_code; ?>" required readonly>
                            <small>Ürün kodu otomatik olarak oluşturulmaktadır.</small>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Resmi</div>
                            <input type="file" name="product_image" id="product_image"
                                   class="form-control form-control-lg" required>
                            <img style="display: none;"
                                 alt="Ürün Resmi"
                                 class="mw-250px mh-100">
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Ölçüsü</div>
                            <select name="product_frame_size" id="product_frame_size"
                                    class="form-control form-contorl-lg" required>
                                <option value="0" disabled selected>Seçiniz</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Ürün Çerçevesi</div>
                            <select name="product_frame_type" id="product_frame_type"
                                    class="form-control form-control-lg"
                                    required>
                                <option value="0" disabled selected>Seçiniz</option>
                                <option value="1">Var</option>
                                <option value="2">Yok</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Çerçeve Rengi</div>
                            <select name="product_frame_color" id="product_frame_color"
                                    class="form-control form-control-lg" required>
                                <option value="0" disabled selected>Seçiniz</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Ülke</div>
                            <select name="recipient_country" id="recipient_country" class="form-control form-control-lg"
                                    required>
                                <option value="0" disabled selected>Seçiniz</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Adı</div>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   name="recipient_name" required>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Adres</div>
                            <textarea rows="5" class="form-control form-control-lg form-control-solid"
                                      name="recipient_address" required></textarea>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Telefon</div>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   name="recipient_phone">
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Alıcı Email</div>
                            <input type="email" class="form-control form-control-lg form-control-solid"
                                   name="recipient_email" required>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">IOSS/VAT Number</div>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   name="recipient_iossvat">
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Hediye Paketi</div>
                            <select name="gift_package" id="gift_package" class="form-control form-control-lg" required>
                                <option value="0" disabled selected>Seçiniz</option>
                                <option value="1">Var</option>
                                <option value="2">Yok</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Hediye Mesajı (.pdf)</div>
                            <input type="file" accept="application/pdf"
                                   class="form-control form-control-lg form-control-solid"
                                   name="gift_message" id="gift_message">
                        </div>
                        <div class="d-block flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="fs-5 fw-bolder form-label mb-3">Fiyat Toplam:</div>
                            <span class="d-inline" id="price_total"></span>
                            <span class="d-inline">$</span>
                        </div>
                        <div id="progress" style="display: none;">
                            <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                                <div class="progress">
                                    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 0%"></div>
                                </div>
                            </div>
                            </div>
                        <div class="d-flex flex-column fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <button type="submit" class="btn btn-lg btn-primary w-100">Satın Al</button>
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
                getProductFrameSizes()

                const product_frame_type_input = document.querySelector('#product_frame_type');
                getProductFrameTypes()

                const product_frame_color_input = document.querySelector('#product_frame_color');
                getProductFrameColors()

                const recipient_country_input = document.querySelector('#recipient_country');
                getRecipientCountries()

                const price_total = document.querySelector('#price_total');
                calculatePriceTotal()

                const gift_package_input = document.querySelector('#gift_package');



                product_frame_size_input.addEventListener(
                    'change',
                    function () {
                        getProductFrameTypes()
                        getProductFrameColors()
                        calculatePriceTotal()
                    }
                )

                product_frame_type_input.addEventListener(
                    'change',
                    function () {
                        getProductFrameColors()
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
                                product_frame_size_input.innerHTML += '<option value="' + product_size.id + '">' + product_size.size + '</option>';
                            })
                        }
                    }
                    xhr.send();
                    getProductFrameColors()
                }

                function getProductFrameTypes() {
                    let xhr = new XMLHttpRequest();
                    let frame_size_id = product_frame_size_input.value;
                    xhr.open('POST', '<?= base_url('api/getProductFrameTypes') ?>', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (
                            this.status === 200
                        ) {
                            let frame_types = JSON.parse(this.responseText);
                            product_frame_type_input.innerHTML = '';
                            product_frame_type_input.innerHTML += '<option value="0" disabled selected>Seçiniz</option>';
                            frame_types.forEach(function (frame_type) {
                                product_frame_type_input.innerHTML += '<option value="' + frame_type.frame_type_id + '">' + (
                                    frame_type.frame_type_id === '1' ? 'Var' : ''
                                ) + (
                                    frame_type.frame_type_id === '2' ? 'Yok' : ''
                                ) + '</option>';
                            })
                        } else if (
                            Array.from(product_frame_type_input.options).some(
                                option => option.selected && option.value === '2'
                            )) {
                            product_frame_type_input.innerHTML = '<option value="0" disabled selected>Seçiniz</option>';
                        }
                    }
                    xhr.send('frame_size_id=' + frame_size_id);
                }

                function getProductFrameColors() {
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
                                product_frame_color_input.innerHTML += '<option value="' + product_color.id + '">' + product_color.color_name + '</option>';
                            })
                        } else if (
                            Array.from(product_frame_type_input.options).some(
                                option => option.selected && option.value === '2'
                            )) {
                            product_frame_color_input.innerHTML = '<option value="0" disabled selected>Seçiniz</option>';
                        }
                    }
                    xhr.send('frame_size_id=' + frame_size_id + '&frame_type_id=' + frame_type_id);
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
                                recipient_country_input.innerHTML += '<option value="' + recipient_country.id + '">' + recipient_country.country_name + '</option>';
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
                        "&gift_package=" + document.querySelector('#gift_package').value
                    );
                }

                const form = document.querySelector('form');
                form.onsubmit = event => {
                    event.preventDefault();
                    let formData = new FormData(form);
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', form.action);
                    xhr.upload.addEventListener('progress', function (event) {
                        if (event.lengthComputable) {
                            let percent = Math.round((event.loaded / event.total) * 100);
                            if (percent === 100) {
                                document.querySelector("#progress-bar").innerHTML = 'Sipariş oluşturuluyor...';
                            }
                            document.querySelector("#progress").style.display = 'block';
                            document.querySelector("#progress-bar").style.width = percent + '%';
                            document.querySelector("#progress-bar").innerHTML = percent + '%';
                        }
                    });
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            window.location.href = '<?= base_url('/my_orders') ?>';
                        }
                    }
                    xhr.send(formData);
                }

            }
        )


    </script>

<?= $this->include('templates/footer.php'); ?>