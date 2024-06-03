<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?= site_url(); ?>">
    <title><?= $siteName; ?><?= $title ? ' - ' . $title : null; ?></title>
    <meta name="description"
          content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free."/>
    <meta name="keywords"
          content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme"/>
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Keenthemes | Metronic"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
</head>
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
             data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
             data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
             data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <a href="">
                    <img alt="Logo" src="assets/media/logos/logo-1-dark.svg" class="h-25px logo"/>
                </a>
                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                     data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                     data-kt-toggle-name="aside-minimize">
                    <span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<path opacity="0.5"
                                          d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                          fill="black"/>
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                          fill="black"/>
								</svg>
							</span>
                </div>
            </div>
            <div class="aside-menu flex-column-fluid">
                <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                     data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                     data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                     data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                         id="#kt_aside_menu" data-kt-menu="true">
                        <div class="menu-item">
                            <div class="menu-content pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Sayfalar</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link active" href="">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black"/>
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
												</svg>
											</span>
										</span>
                                <span class="menu-title">Ana Sayfa</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <div class="menu-content pt-8 pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1"></span>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                         <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z"
                                                                  fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            <path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z"
                                                                  fill="#000000"/>
                                                        </g>
                                                </svg>
											</span>
										</span>
										<span class="menu-title">Ürünler</span>
										<span class="menu-arrow"></span>
									</span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item menu-accordion">
											<span class="menu-link">
												<span class="menu-title"><a href="order"
                                                                            class="menu-link">Sipariş Ver</a></span>
                                            </span>
                                    <span class="menu-link">
												<span class="menu-title"><a href="my_orders" class="menu-link">Siparişlerim</a></span>
											</span>
                                </div>
                            </div>
                        </div>
                                                <div class="menu-item">
                            <a class="menu-link" href="/balance">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
  <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
  <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
</svg>
											</span>
										</span>
                                <span class="menu-title">Bakiyem</span>
                            </a>
                        </div>

                        <!--                        <div class="menu-item">-->
                        <!--                            <div class="menu-content pt-8 pb-2">-->
                        <!--                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Crafted</span>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">-->
                        <!--									<span class="menu-link">-->
                        <!--										<span class="menu-icon">-->
                        <!--											<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                        <!--											<span class="svg-icon svg-icon-2">-->
                        <!--												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"-->
                        <!--                                                     viewBox="0 0 24 24" fill="none">-->
                        <!--													<path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"-->
                        <!--                                                          fill="black"/>-->
                        <!--													<path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"-->
                        <!--                                                          fill="black"/>-->
                        <!--													<path opacity="0.3"-->
                        <!--                                                          d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"-->
                        <!--                                                          fill="black"/>-->
                        <!--												</svg>-->
                        <!--											</span>-->
                        <!--                                            end::Svg Icon-->
                        <!--										</span>-->
                        <!--										<span class="menu-title">Pages</span>-->
                        <!--										<span class="menu-arrow"></span>-->
                        <!--									</span>-->
                        <!--                            <div class="menu-sub menu-sub-accordion menu-active-bg">-->
                        <!--                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">-->
                        <!--											<span class="menu-link">-->
                        <!--												<span class="menu-bullet">-->
                        <!--													<span class="bullet bullet-dot"></span>-->
                        <!--												</span>-->
                        <!--												<span class="menu-title">Profile</span>-->
                        <!--												<span class="menu-arrow"></span>-->
                        <!--											</span>-->
                        <!--                                    <div class="menu-sub menu-sub-accordion menu-active-bg">-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/profile/overview.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Overview</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/profile/projects.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Projects</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/profile/campaigns.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Campaigns</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/profile/documents.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Documents</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/profile/connections.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Connections</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/profile/activity.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Activity</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">-->
                        <!--											<span class="menu-link">-->
                        <!--												<span class="menu-bullet">-->
                        <!--													<span class="bullet bullet-dot"></span>-->
                        <!--												</span>-->
                        <!--												<span class="menu-title">Projects</span>-->
                        <!--												<span class="menu-arrow"></span>-->
                        <!--											</span>-->
                        <!--                                    <div class="menu-sub menu-sub-accordion menu-active-bg">-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/list.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">My Projects</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/project.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">View Project</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/targets.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Targets</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/budget.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Budget</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/users.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Users</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/files.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Files</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/activity.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Activity</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="menu-item">-->
                        <!--                                            <a class="menu-link" href="../../demo1/dist/pages/projects/settings.html">-->
                        <!--														<span class="menu-bullet">-->
                        <!--															<span class="bullet bullet-dot"></span>-->
                        <!--														</span>-->
                        <!--                                                <span class="menu-title">Settings</span>-->
                        <!--                                            </a>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <div id="kt_header" style="" class="header align-items-stretch">
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                             id="kt_aside_mobile_toggle">
                            <span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                                  fill="black"/>
											<path opacity="0.3"
                                                  d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                                  fill="black"/>
										</svg>
									</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="/" class="d-lg-none">
                            <img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-30px"/>
                        </a>
                    </div>
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                        </div>
                        <div class="d-flex align-items-stretch flex-shrink-0">
                            <div class="d-flex align-items-stretch flex-shrink-0">
                                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                         data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                         data-kt-menu-placement="bottom-end">
                                        <img src="assets/media/avatars/blank.png" alt="user"/>
                                    </div>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                         data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="assets/media/avatars/blank.png"/>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5"><?= $user['name']; ?></div>
                                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?= $user['email']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator my-2"></div>
                                        <div class="menu-item px-5">
                                            <a href="/change-password" class="menu-link px-5">Şifre Değiştir</a>
                                        </div>
                                        <div class="separator my-2"></div>
                                        <div class="menu-item px-5">
                                            <a href="/logout" class="menu-link px-5">Çıkış Yap</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                         id="kt_header_menu_mobile_toggle">
                                        <span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                                              fill="black"/>
														<path opacity="0.3"
                                                              d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                                              fill="black"/>
													</svg>
												</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
