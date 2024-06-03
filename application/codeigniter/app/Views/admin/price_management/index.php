<?= $this->include('templates/admin/header.php'); ?>
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
                        <div class="card-title fs-3 fw-bolder">Fiyat Profilleri</div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Filter-->
                                <a href="/admin/frame-sizes" class="btn btn-sm btn-primary">Boyutları Yönet</a>
                                <a href="/admin/frame-colors" class="btn btn-sm btn-primary" style="margin-left: 3px;">Renkleri
                                    Yönet</a>
                                <a href="/admin/regions" class="btn btn-sm btn-primary" style="margin-left: 3px;">Bölgeleri
                                    Yönet</a>
                                <a href="/admin/price-profiles/add" class="btn btn-sm btn-danger"
                                   style="margin-left: 20px;">Fiyat Profili Ekle</a>
                                <!--end::Filter-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
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
                                    <th class="min-w-50px">ID</th>
                                    <th class="min-w-100px">Profil Adı</th>
                                    <th class="min-w-100px">Kullanan Kullanıcı Sayısı</th>
                                    <th class="min-w-100px text-end">Aksiyonlar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($price_profiles as $price_profile): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input widget-13-check" type="checkbox"
                                                       value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary fs-6"><?= $price_profile['id']; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary fs-6"><?= $price_profile['profile_name']; ?></a>
                                        </td>
                                        <td>
                                            <a class="text-dark fw-bolder text-hover-primary fs-6"><?= $price_profile['usage_count']; ?></a>
                                        </td>
                                        <td class="text-end">
                                            <a href="admin/resellers/list/<?= $price_profile['id']; ?>"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-lg-2hx">
																	<svg xmlns="http://www.w3.org/2000/svg" height="12"
                                                                         width="12"
                                                                         viewBox="0 0 600 600"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path
                                                                                d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/></svg>
																</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <a href="admin/price-management/view/<?= $price_profile['id']; ?>"
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
                                            <a href="admin/price-profiles/edit/<?= $price_profile['id']; ?>"
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
                                            <a data-profile-id="<?= $price_profile['id']; ?>" href="javascript:;"
                                               onclick="deleteProfile(this);"
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

        function deleteProfile(e) {
            var id = $(e).data('profile-id');
            Swal.fire({
                title: 'Emin misin?',
                text: "Profil silindiği zaman bu işlemi geri alamazsın!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, eminim sil!',
                cancelButtonText: 'Hayır, silme!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'admin/price-profiles/delete/' + id,
                        type: 'DELETE',
                        success: function (result) {
                            Swal.fire(
                                'Silindi!',
                                'Profil başarıyla silindi.',
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
    </script>
<?= $this->include('templates/footer.php'); ?>