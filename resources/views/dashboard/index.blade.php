@extends('layout.app')

@section('content')

<div class="container my-3">
    <div class="row">
        <div class="col-xl-4">
            <!--begin::Stats Widget 25-->
            <div class="card card-custom bg-light-success card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-success">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $pelanggans->count() }}</span>
                    <span class="font-weight-bold text-muted font-size-sm">Data Pelanggan</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 25-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 26-->
            <div class="card card-custom bg-light-danger card-stretch gutter-b">
                <!--begin::ody-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-danger">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $produks->count() }}</span>
                    <span class="font-weight-bold text-muted font-size-sm">Data Produk</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 26-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 27-->
            <div class="card card-custom bg-light-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-info">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3" />
                                <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $penjualans->count() }}</span>
                    <span class="font-weight-bold text-muted font-size-sm">Data Penjualan</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 27-->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Charts Widget 3-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header h-auto border-0">
                    <div class="card-title py-5">
                        <h3 class="card-label">
                            <span class="d-block text-dark font-weight-bolder">Grafik Penjualan Produk</span>
                            <span class="d-block text-muted mt-2 font-size-sm">Produk terjual perhari</span>
                        </h3>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body" style="position: relative;">
                    <div id="kt_charts_widget_3_chart" style="min-height: 365px;">
                    </div>
                    <div class="resize-triggers">
                        <div class="expand-trigger">
                            <div style="width: 457px; height: 418px;"></div>
                        </div>
                        <div class="contract-trigger"></div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Charts Widget 3-->
        </div>
    </div>
</div>
<script>
    // Mengonversi data PHP ke JSON
    let chartsprodukterjual = @json($chartsprodukterjual);
    let chartstanggalterjual = @json($chartstanggalterjual);
</script>
@endsection