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
        <div class="post flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container d-flex">
                <div style="width: 40%; margin-bottom: 5px;">
                    <label for="start_date">Başlangıç Tarihi:</label>
                    <input type="date" id="start_date" name="start_date" style="width: 100%;">
                </div>
                <div style="width: 40%; margin-bottom: 5px; margin-left: 5px;">
                    <label for="end_date">Bitiş Tarihi:</label>
                    <input type="date" id="end_date" name="end_date" style="width: 100%;">
                </div>
                <div style="width: 20%; margin-top: 10px; margin-left: 25px;">
                    <button type="button" onclick="filter()" class="btn btn-primary" id="filter">Filtrele</button>
                </div>
            </div>
            <!-- balance -->
            <div class="container d-flex">
                <div class="card w-33" style="margin-right:6vw;">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="align-items-center justify-content-between flex-wrap">
                                    <div class="d-block">
                                        <h3>Toplam Mevcut Kullanıcı Bakiyesi</h3>
                                    </div>
                                    <div class="d-block">
                                        <p class="text-dark fw-bolder fs-3 my-1 d-flex">
                                            <svg fill="#000000" height="30" width="30"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 490.2 490.2" xml:space="preserve">
<g>
    <g>
        <path d="M368.4,245.1c0,12.9-10.5,23.4-23.4,23.4s-23.4-10.5-23.4-23.4s10.5-23.4,23.4-23.4S368.4,232.2,368.4,245.1z M76.1,245.1
			c0,12.9,10.5,23.4,23.4,23.4s23.4-10.5,23.4-23.4s-10.5-23.4-23.4-23.4S76.1,232.2,76.1,245.1z M38.5,382.7h268v-32.9H78.1
			c0.4-2.3,0.7-4.7,0.7-7.2c0-21.5-17.5-39-39-39c-2.3,0-4.6,0.2-6.8,0.6V185.9c2.2,0.4,4.5,0.6,6.8,0.6c21.5,0,39-17.5,39-39
			c0-2.5-0.2-4.8-0.7-7.2h286.1c-0.8,3-1.2,6.2-1.2,9.5c0,21.5,17.5,39,39,39c3.3,0,6.6-0.4,9.6-1.2v79.9h32.9V146
			c0-21.2-17.3-38.5-38.5-38.5H38.5C17.3,107.5,0,124.8,0,146v198.2C0,365.4,17.3,382.7,38.5,382.7z M321.6,355.1
			c-2.7,0-4.9,2.2-4.9,4.9v17.8c0,2.7,2.2,4.9,4.9,4.9h118c2.7,0,4.9-2.2,4.9-4.9V360c0-2.7-2.2-4.9-4.9-4.9H321.6z M467.4,339.1
			v-17.8c0-2.7-2.2-4.9-4.9-4.9h-118c-2.7,0-4.9,2.2-4.9,4.9v17.8c0,2.7,2.2,4.9,4.9,4.9h118C465.2,344,467.4,341.8,467.4,339.1z
			 M485.3,277.7h-118c-2.7,0-4.9,2.2-4.9,4.9v17.8c0,2.7,2.2,4.9,4.9,4.9h118c2.7,0,4.9-2.2,4.9-4.9v-17.8
			C490.2,279.9,488,277.7,485.3,277.7z M222.3,160.7c46.6,0,84.4,37.8,84.4,84.4s-37.8,84.4-84.4,84.4s-84.4-37.8-84.4-84.4
			S175.6,160.7,222.3,160.7z M229.7,182.4h-9.6c-1.5,0-2.6,1.2-2.6,2.6v11.5c-7.3,1.1-13.3,3.7-17.8,8.1c-5,4.8-7.5,10.9-7.5,18.4
			c0,8.2,2.4,14.5,7.1,18.7c4.7,4.2,12.3,8.4,22.6,12.6c4.3,1.8,7.2,3.7,8.9,5.6c1.7,1.9,2.5,4.6,2.5,8.1c0,3-0.8,5.4-2.4,7.3
			c-1.6,1.8-4,2.8-7.2,2.8c-3.8,0-6.9-1.2-9.2-3.6c-1.9-2-3.1-5-3.4-9c-0.1-1.6-1.5-2.8-3.1-2.7l-15.8,0.3c-1.7,0-3.1,1.5-3.1,3.2
			c0.4,8.4,3.1,14.8,8.1,19.4c5.4,4.9,12.2,7.9,20.3,8.8v10.8c0,1.5,1.2,2.6,2.6,2.6h9.6c1.5,0,2.6-1.2,2.6-2.6v-11.2
			c6.5-1.2,11.8-3.8,15.9-7.7c4.8-4.7,7.2-10.8,7.2-18.5c0-8-2.4-14.2-7.2-18.6c-4.8-4.3-12.3-8.7-22.5-13c-4.4-1.9-7.4-3.8-9-5.7
			s-2.4-4.4-2.4-7.4s0.7-5.4,2.2-7.4c1.5-1.9,3.8-2.9,6.9-2.9c3.1,0,5.5,1.2,7.4,3.5c1.5,1.9,2.4,4.5,2.7,8c0.1,1.6,1.6,2.7,3.1,2.7
			l15.8-0.2c1.7,0,3.2-1.5,3.1-3.2c-0.4-6.9-2.6-12.7-6.7-17.4c-4.2-4.9-9.7-8-16.6-9.4V185C232.3,183.5,231.1,182.4,229.7,182.4z"
        />
    </g>
</g>
</svg>
                                            <span style="margin-left: 0.2vw;"><?= $balance; ?> $</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-33" style="margin-right:6vw;">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="align-items-center justify-content-between flex-wrap">
                                    <div class="d-block mt-1">
                                        <h3>Toplam Mevcut Sipariş Sayısı</h3>
                                    </div>
                                    <div class="d-block">
                                        <p class="text-dark fw-bolder fs-3 my-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 fill="currentColor" class="bi bi-credit-card-2-front-fill"
                                                 viewBox="0 0 16 16">
                                                <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm1 0v14h14V1H1zm2 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V3zm1 0v2h8V3H4z"/>
                                            </svg>
                                            <?= $total_order_count; ?> adet
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-33">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="align-items-center justify-content-between flex-wrap">
                                    <div class="d-block mt-1">
                                        <h3>Toplam Kullanıcı Sayısı</h3>
                                    </div>
                                    <div class="d-block">
                                        <p class="text-dark fw-bolder fs-3 my-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                                            </svg>
                                            <?= $total_user_count; ?> Kullanıcı
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard welcome message -->
            <div class="container">
                <div class="card card-custom gutter-b mt-5">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="align-items-center justify-content-between flex-wrap">
                                    <div class="d-block">
                                        <h3>Hoşgeldiniz!</h3>
                                    </div>
                                    <div class="d-block">
                                        <p>Solda bulunan seçeneklerden istediğiniz işlemi yapabilirsiniz.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Post-->
        </div>
        <!--end::Content-->
    </div>
    <script>
        const start_date_input = document.querySelector('#start_date');
        const end_date_input = document.querySelector('#end_date');

        function filter(){
            const start_date = start_date_input.value;
            const end_date = end_date_input.value;

            if (start_date !== '' && end_date !== '') {
                window.location.href = `/admin/dashboard?start_date=${start_date}&end_date=${end_date}`;
            } else if (start_date !== '') {
                window.location.href = `/admin/dashboard?start_date=${start_date}`;
            } else if (end_date !== '') {
                window.location.href = `/admin/dashboard?end_date=${end_date}`;
            } else {
                window.location.href = `/admin/dashboard`;
            }
        }
    </script>
<?= $this->include('templates/footer.php'); ?>