<?= $this->include('templates/admin/header.php'); ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                    <?= $title; ?>
                </h1>
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
                        <h2 class="fw-bolder">Fiyatlandırma</h2>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row mb-10">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Çerçeve Boyutu</label>
                            <div class="col-lg-8 fv-row">
                                <select name="product_frame_size" id="product_frame_size"
                                    class="form-control form-control-lg" required>
                                    <option disabled selected>Seçiniz</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-10">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Çerçeve Durumu</label>
                            <div class="col-lg-8 fv-row">
                                <select name="product_frame_type" id="product_frame_type"
                                    class="form-control form-control-lg" required>
                                    <option disabled selected>Seçiniz</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-10">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Çerçeve Rengi</label>
                            <div class="col-lg-8 fv-row">
                                <select name="product_frame_color" id="product_frame_color"
                                    class="form-control form-control-lg" required>
                                    <option disabled selected>Seçiniz</option>
                                </select>
                            </div>
                        </div>
                        <div class="row-mb-10 d-flex">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Fiyat</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="price" id="price" class="form-control form-control-lg"
                                    placeholder="Fiyat" value="0" required>
                            </div>
                        </div>

                        <div class="d-flex pt-15">
                            <div class="me-5">
                                <a href="/admin/price-management/view/<?= $price_profile_id ?>"
                                    class="btn btn-lg btn-danger btn-active-primary">İptal</a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary">Kaydet</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <h2 class="fw-bolder">Fiyat Önizleme</h2>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Bölge</label>
                        <div class="col-lg-8 fv-row">
                            <select name="region" id="region" class="form-control form-control-lg" required>
                                <option value="0" disabled selected>Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10 d-flex">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Hediye Paketi</label>
                        <div class="col-lg-8 fv-row">
                            <select name="gift_package" id="gift_package" class="form-control form-control-lg" required>
                                <option value="0" disabled selected>Seçiniz</option>
                                <option value="1" price="5">Var</option>
                                <option value="2" price="0">Yok</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-mb-10 d-flex">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Fiyat</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="price_preview" id="price_preview"
                                class="form-control form-control-lg disabled" placeholder="Fiyat" value="0" required
                                disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener(
        "DOMContentLoaded",
        function () {

            const region_input = document.querySelector('#region');
            getRegions();

            const product_frame_size_input = document.querySelector('#product_frame_size');
            getProductFrameSizes()

            const product_frame_type_input = document.querySelector('#product_frame_type');
            getProductFrameTypes()

            const product_frame_color_input = document.querySelector('#product_frame_color');
            getProductFrameColors()

            const price_input = document.querySelector('#price');

            const price_total = document.querySelector('#price_preview');
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
                }
            )
            
            product_frame_color_input.addEventListener(
                 'change',
                 function () {
                     calculatePriceTotal()
                 }
             )
            
            region_input.addEventListener(
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

             price_input.addEventListener('input', function() {
                calculatePriceTotal();
            });

            function getProductFrameSizes() {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= base_url('api/getAllProductFrameSizes') ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (this.status === 200) {
                        let product_sizes = JSON.parse(this.responseText);
                        product_frame_size_input.innerHTML = '';
                        product_frame_size_input.innerHTML += '<option disabled selected>Seçiniz</option>';
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
                xhr.open('POST', '<?= base_url('api/getAllProductFrameTypes') ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (
                        this.status === 200
                    ) {
                        let frame_types = JSON.parse(this.responseText);
                        product_frame_type_input.innerHTML = '';
                        product_frame_type_input.innerHTML += '<option disabled selected>Seçiniz</option>';
                        frame_types.forEach(function (frame_type) {
                            product_frame_type_input.innerHTML += '<option value="' + frame_type.frame_type_id + '">' + (
                                frame_type.frame_type_id === 1 ? 'Var' : ''
                            ) + (
                                    frame_type.frame_type_id === 2 ? 'Yok' : ''
                                ) + '</option>';
                        })
                    } else if (
                        Array.from(product_frame_type_input.options).some(
                            option => option.selected && option.value === '2'
                        )) {
                        product_frame_type_input.innerHTML = '<option disabled selected>Seçiniz</option>';
                    }
                }
                xhr.send();
            }

            function getProductFrameColors() {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= base_url('api/getAllProductFrameColors') ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (
                        Array.from(product_frame_type_input.options).some(
                            option => option.selected && option.value == 0
                        )
                    ) {
                        product_frame_color_input.innerHTML = '<option disabled selected>Seçiniz</option>';
                    } else if (
                        Array.from(product_frame_type_input.options).some(
                            option => option.selected && option.value == 2
                        )
                    ) {
                        product_frame_color_input.innerHTML = '<option value="0" disabled selected>Çerçeve Rengi Yok</option>';
                    } else if (
                        this.status === 200
                    ) {
                        let product_colors = JSON.parse(this.responseText);
                        product_frame_color_input.innerHTML = '';
                        product_frame_color_input.innerHTML += '<option disabled selected>Seçiniz</option>';
                        product_colors.forEach(function (product_color) {
                            product_frame_color_input.innerHTML += '<option value="' + product_color.id + '">' + product_color.color_name + '</option>';
                        })
                    }
                }
                xhr.send();
            }

            function calculatePriceTotal() {
                let customPrice = document.querySelector("#price").value;
                let regionPrice = document.querySelector("#region").selectedOptions[0].getAttribute('price');
                let giftPackage = document.querySelector("#gift_package").selectedOptions[0].getAttribute('price');
                let priceTotal = Number(customPrice) + Number(regionPrice) + Number(giftPackage);
                price_total.value = priceTotal;
            }

            function getRegions() {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= base_url('api/getRegions') ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (this.status === 200) {
                        let regions = JSON.parse(this.responseText);
                        region_input.innerHTML = '';
                        region_input.innerHTML += '<option value="0" disabled selected>Seçiniz</option>';
                        regions.forEach(function (region) {
                            region_input.innerHTML += '<option value="' + region.id + '" price="'+ region.price +'">' + region.name + '</option>';
                        })
                    }
                }
                xhr.send();
            }
        }
    )


</script>

<?= $this->include('templates/footer.php'); ?>