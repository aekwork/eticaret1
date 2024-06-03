<?php

use function App\Helpers\getOrderStatus;

?>
<?= $this->include('templates/admin/header.php'); ?>
    <style type="text/css" media="print">
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
    </style>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><?= $title; ?></h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <!-- Dashboard welcome message -->
            <div class="container">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title fs-3 fw-bolder">Sipariş Listesi<?= !is_null($user_id) ? ' (#' . $user_id . ' idli kullanıcının siparişleri)' : ''; ?></div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="<?= base_url('/admin/order-status-codes') ?>" style="margin-right: 10px;"
                               class="btn btn-primary">Sipariş Durum Kodları</a>
                            <button onclick="printDiv('kt_post')" class="btn btn-primary">Tabloyu Yazdır</button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-header">
                        <!-- date filter -->
                        <div style="width: 40%;">
                            <label for="start_date">Başlangıç Tarihi:</label>
                            <input type="date" id="start_date" name="start_date" style="width: 100%;">
                        </div>
                        <div style="width: 35%; margin-left: 5%;">
                            <label for="end_date">Bitiş Tarihi:</label>
                            <input type="date" id="end_date" name="end_date" style="width: 100%;">
                        </div>
                        <div style="width: 15%; margin-top:10px; margin-left: 5%;">
                            <button type="button" onclick="filter()" class="btn btn-primary" id="filter">Filtrele
                            </button>
                        </div>
                    </div>
                    <div class="card-header">
                        <!-- tabs -->
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <?php foreach ($status_codes as $status_code): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-active-dark <?= $status_code['id'] == $statusCode ? 'active' : ''; ?>"
                                       aria-current="page"
                                       href="<?= base_url('/admin/orders?status_code=' . $status_code['id'] . (!is_null($user_id) ? '&user_id=' . $user_id : '')) ?>"><?= $status_code['name']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Form-->
                    <div class="card-body py-3">
                        <style>
                            table {
                                border-collapse: collapse !important;
                            }

                            th, td {
                                border: 1px groove #aeb8bf !important;
                                padding: 2px !important;
                            }
                        </style>
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="products"
                                   class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="w-25px">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                   data-kt-check="true" data-kt-check-target=".widget-13-check">
                                        </div>
                                    </th>
                                    <th class="min-w-20px" style="max-width: 20px;">Kod</th>
                                    <th class="min-w-50px" style="max-width: 50px;">Tarih</th>
                                    <th class="min-w-100px">Thumbnail</th>
                                    <th class="min-w-120px">Ölçü</th>
                                    <th class="min-w-120px">Renk</th>
                                    <th class="min-w-120px">Çerçeve</th>
                                    <th class="min-w-120px">Ülke</th>
                                    <th class="min-w-120px">Fiyat</th>
                                    <th class="min-w-120px">Hediye Paketi</th>
                                    <th class="min-w-120px">Sipariş Durumu</th>
                                    <th class="min-w-100px text-end">Aksiyonlar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input widget-13-check" type="checkbox"
                                                       value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary fs-6"><?= $order['product_code']; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary fs-6"><?= date('Y/m/d H:i', strtotime($order['created_at'])); ?></a>
                                        </td>
                                        <td>
                                            <img src="<?= site_url($order['product_thumbnail']); ?>"
                                                 style="max-height: 130px;" class="img-fluid">
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?= $order['product_frame_size']; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?= $order['product_frame_color']; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?= $order['product_frame_type']; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?= $order['recipient_country']; ?></a>
                                        </td>
                                        <td class="text-dark fw-bolder text-hover-primary fs-6"><?= number_format($order['total_paid'], 2); ?>
                                            $
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?= ($order['gift_package'] == '1') ? 'Var' : 'Yok'; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?= getOrderStatus($order['status']); ?></a>
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= $order['product_image']; ?>" download="download"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-lg-2hx">
																	<svg xmlns="http://www.w3.org/2000/svg" height="12"
                                                                         width="12" viewBox="0 0 700 700"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path
                                                                                d="M256 464a208 208 0 1 1 0-416 208 208 0 1 1 0 416zM256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM376.9 294.6c4.5-4.2 7.1-10.1 7.1-16.3c0-12.3-10-22.3-22.3-22.3H304V160c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32v96H150.3C138 256 128 266 128 278.3c0 6.2 2.6 12.1 7.1 16.3l107.1 99.9c3.8 3.5 8.7 5.5 13.8 5.5s10.1-2 13.8-5.5l107.1-99.9z"/></svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <?php if (!empty($order['gift_message'])): ?>
                                                <a href="<?= $order['gift_message']; ?>" download="download"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                    <span class="svg-icon svg-icon-lg-2hx">
<svg xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 700 700"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path
            d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>																</span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                            <?php endif; ?>
                                            <a href="admin/orders/view/<?= $order['order_id']; ?>"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-lg-2hx">
																	<svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                         height="12" fill="currentColor"
                                                                         class="bi bi-eye-fill" viewBox="0 0 20 20">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <a href="admin/orders/edit/<?= $order['order_id']; ?>"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-lg-2hx">
																<svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                     height="12" fill="currentColor"
                                                                     class="bi bi-pencil-fill" viewBox="0 0 20 20">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
</svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <a data-order-id="<?= $order['order_id']; ?>" href="javascript:;"
                                               onclick="deleteUser(this);"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-lg-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                 fill="currentColor" class="bi bi-x-lg" viewBox="0 0 20 20">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
</svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end:Form-->
                </div>
            </div>
            <!--end::Post-->
        </div>
        <!--end::Content-->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    <script>
        $('#products').dataTable({
            "searching": true
        });

        function deleteUser(e) {
            var id = $(e).data('order-id');
            Swal.fire({
                title: 'Emin misin?',
                text: "Sipariş silindiği zaman bu işlemi geri alamazsın!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, eminim sil!',
                cancelButtonText: 'Hayır, silme!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'admin/orders/delete/' + id,
                        type: 'DELETE',
                        success: function (result) {
                            Swal.fire(
                                'Silindi!',
                                'Sipariş başarıyla silindi.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            })
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function (item) {
                    tmp = item.split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }

        function filter() {
            const start_date = $('#start_date').val();
            const end_date = $('#end_date').val();
            const status_code = findGetParameter('status_code');
            const user_id = findGetParameter('user_id');

            if (start_date !== '' && end_date !== '') {
                window.location.href = `/admin/orders?start_date=${start_date}&end_date=${end_date}` + (status_code ? `&status_code=${status_code}` : '') + (user_id ? `&user_id=${user_id}` : '');
            } else if (start_date !== '') {
                window.location.href = `/admin/orders?start_date=${start_date}` + (status_code ? `&status_code=${status_code}` : '') + (user_id ? `&user_id=${user_id}` : '');
            } else if (end_date !== '') {
                window.location.href = `/admin/orders?end_date=${end_date}` + (status_code ? `&status_code=${status_code}` : '') + (user_id ? `&user_id=${user_id}` : '');
            } else {
                window.location.href = `/admin/orders` + (status_code ? `?status_code=${status_code}` : '') + (user_id ? `&user_id=${user_id}` : '');
            }
        }

    </script>
<?= $this->include('templates/footer.php'); ?>