<?php

use function App\Helpers\getOrderStatus;

?>
<?= $this->include('templates/reseller/header.php'); ?>
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
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title fs-3 fw-bolder">Sipariş Listesi</div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Form-->
                    <div class="card-body py-3">
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
                                    <th class="min-w-150px">Ürün Kodu</th>
                                    <th class="min-w-150px">Eklenme Tarihi</th>
                                    <th class="min-w-120px">Küçük Resim</th>
                                    <th class="min-w-120px">Ölçü</th>
                                    <th class="min-w-120px">Renk</th>
                                    <th class="min-w-120px">Çerçeve</th>
                                    <th class="min-w-120px">Ülke</th>
                                    <th class="min-w-120px">Ücret</th>
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
                                            <a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"><?= date("d/m/Y", strtotime($order['created_at'])); ?></a>
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
                                        <td class="text-dark fw-bolder text-hover-primary fs-6"><?= $order['total_paid']; ?>
                                            $
                                        </td>
                                        <td class="text-dark fw-bolder text-hover-primary fs-6"><?= getOrderStatus($order['status']); ?></td>
                                        <td class="text-end">
                                            <a href="/order/view/<?= $order['order_id']; ?>"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-lg-2hx">
																	<svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                         height="16" fill="currentColor"
                                                                         class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
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
        });   </script>
<?= $this->include('templates/footer.php'); ?>