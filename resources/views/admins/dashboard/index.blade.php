@extends('layouts.master_admins')

@section('level_styles_admin')

    <link href="{{ asset('') }}assets/template/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">

    <link href="{{ asset('') }}assets/template/src/assets/css/light/components/list-group.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('') }}assets/template/src/assets/css/light/widgets/modules-widgets.css">

    <link href="{{ asset('') }}assets/template/src/assets/css/dark/components/list-group.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('') }}assets/template/src/assets/css/dark/widgets/modules-widgets.css">

@endsection

@section('title_admin', 'Dashboard')

{{-- @section('breadcrumb_admin')    
<li class="breadcrumb-item active" aria-current="page">Striped</li>
@endsection --}}

@section('content_admin')

    <!-- Analytics -->

    <div style="display: none;" class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h6 class="">Iuran Bulanan</h6>
                <div class="task-action">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="statistics" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-more-horizontal">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </a>

                        <div class="dropdown-menu left" aria-labelledby="statistics" style="will-change: transform;">
                            <a class="dropdown-item" href="javascript:void(0);">View</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-chart">
                <div class="w-chart-section">
                    <div class="w-detail">
                        <p class="w-title">Bulan ini</p>
                        <p class="w-stats">{{ number_format($iuran_bulan) }}</p>
                    </div>
                    <div class="w-chart-render-one">
                        <div id="total-users"></div>
                    </div>
                </div>

                <div class="w-chart-section">
                    <div class="w-detail">
                        <p class="w-title">Hari Ini</p>
                        <p class="w-stats">{{ number_format($iuran_today) }}</p>
                    </div>
                    <div class="w-chart-render-one">
                        <div id="paid-visits"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;" class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-header">
                    <div class="w-info">
                        <h6 class="value">Booking</h6>
                    </div>
                    <div class="task-action">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="expenses"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>


                        </div>
                    </div>
                </div>

                <div class="w-content">

                    <div class="w-info">
                        <p class="value">{{ number_format($booking_today) }} <span>Hari Ini</span> <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-trending-up">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg></p>
                    </div>

                </div>

                <div class="w-progress-stats">
                    <div class="progress">
                        <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 100%"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="">
                        <div class="w-icon">
                            <p>100%</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div style="display: none;" class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-five">
            <div class="widget-content">
                <div class="account-box">

                    <div class="info-box">
                        <div class="icon">
                            <span>
                                <img src="{{ asset('') }}assets/template/src/assets/img/money-bag.png"
                                    alt="money-bag">
                            </span>
                        </div>

                        <div class="balance-info">
                            <h6>Pendapatan Lain Lain</h6>
                            <p>{{ $lain_today }}</p>
                        </div>
                    </div>

                    <div class="card-bottom-section">
                        <div><span class="badge badge-light-success">+ 100% <svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-trending-up">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg></span></div>
                        <a href="javascript:void(0);" class="">Hari Ini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="">Recent Booking</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="th-content">User</div>
                                </th>
                                <th>
                                    <div class="th-content">Facility</div>
                                </th>
                                <th>
                                    <div class="th-content">Invoice</div>
                                </th>
                                <th>
                                    <div class="th-content th-heading">Price</div>
                                </th>
                                <th>
                                    <div class="th-content">Status</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $tr)
                                @php
                                    $users = \App\Models\User::where('id', $tr->user_id);
                                    if ($users->count() > 0) {
                                        $user = $users->first();
                                        $username = $user->name;

                                        if ($user->foto == null || $user->foto == '') {
                                            $src = asset('template/images/profil_icon.png');
                                        } else {
                                            $src = asset('storage/profile/' . $user->foto);
                                        }
                                    } else {
                                        $username = '';
                                        $src = asset('template/images/profil_icon.png');
                                    }

                                    $units = \App\Models\UnitBisnis::where('id', $tr->business_unit_id);
                                    if ($units->count() > 0) {
                                        $unit = $units->first();
                                        $name_unit = $unit->name_unit;
                                    } else {
                                        $name_unit = '';
                                    }

                                @endphp
                                <tr>
                                    <td>
                                        <div class="td-content customer-name"><img src="{{ $src }}"
                                                alt="avatar"><span>{{ $username }}</span></div>
                                    </td>
                                    <td>
                                        <div class="td-content product-brand text-primary">{{ $name_unit }}</div>
                                    </td>
                                    <td>
                                        <div class="td-content product-invoice">{{ $tr->invoice }}</div>
                                    </td>
                                    <td>
                                        <div class="td-content pricing"><span
                                                class="">{{ number_format($tr->total_price) }}</span></div>
                                    </td>
                                    @if ($tr->payment_status == 'PAID')
                                        <td>
                                            <div class="td-content"><span class="badge badge-success">PAID</span></div>
                                        </td>
                                    @elseif($tr->payment_status == 'CANCELLED')
                                        <td>
                                            <div class="td-content"><span class="badge badge-danger">CANCELLED</span>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="td-content"><span class="badge badge-warning">PENDING</span></div>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-three">

            <div class="widget-heading">
                <h5 class="">Recent Payment</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-scroll">
                        <thead>
                            <tr>
                                <th>
                                    <div class="th-content">User</div>
                                </th>
                                <th>
                                    <div class="th-content th-heading">Payment Title</div>
                                </th>
                                <th>
                                    <div class="th-content th-heading">Invoice</div>
                                </th>
                                <th>
                                    <div class="th-content">Amount</div>
                                </th>
                                <th>
                                    <div class="th-content">Status</div>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                                @php
                                    $users = \App\Models\User::where('id', $detail->user_id);
                                    if ($users->count() > 0) {
                                        $user = $users->first();
                                        $username = $user->name;
                                        $blok = $user->blok;
                                        $nomor_rumah = $user->nomor_rumah;
                                        if ($user->foto == null || $user->foto == '') {
                                            $src = asset('template/images/profil_icon.png');
                                        } else {
                                            $src = asset('storage/profile/' . $user->foto);
                                        }
                                    } else {
                                        $username = '';
                                        $blok = '';
                                        $nomor_rumah = '';

                                        $src = asset('template/images/profil_icon.png');
                                    }

                                    $payment = \App\Models\Payment::findorFail($detail->payment_id);

                                @endphp
                                <tr>
                                    <td>
                                        <div class="td-content product-name"><img src="{{ $src }}"
                                                alt="product">
                                            <div class="align-self-center">
                                                <p class="prd-name">{{ $username }}</p>
                                                <p class="prd-category text-primary">
                                                    {{ $blok }}-{{ $nomor_rumah }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-content"><span class="pricing">{{ $payment->payment_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-content"><span
                                                class="discount-pricing">{{ $detail->invoice }}</span></div>
                                    </td>
                                    <td>
                                        <div class="td-content">{{ number_format($detail->amount) }}<br></div>
                                    </td>
                                    @if ($detail->payment_status == 'PAID')
                                        <td>
                                            <div class="td-content"><span class="badge badge-success">PAID</span></div>
                                        </td>
                                    @elseif($detail->payment_status == 'CANCELLED')
                                        <td>
                                            <div class="td-content"><span class="badge badge-danger">CANCELLED</span>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="td-content"><span class="badge badge-warning">PENDING</span></div>
                                        </td>
                                    @endif


                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-three">

            <div class="widget-heading">
                <h5 class="">Unpaid User This Month</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-scroll" id="table-outstanding-payment">
                        <thead>
                            <tr>
                                <th>
                                    <div class="th-content">No</div>
                                </th>
                                <th>
                                    <div class="th-content">Action</div>
                                </th>
                                <th>
                                    <div class="th-content th-heading">User</div>
                                </th>
                                <th>
                                    <div class="th-content th-heading">Blok</div>
                                </th>
                                <th>
                                    <div class="th-content">No</div>
                                </th>
                                <th>
                                    <div class="th-content">Penyelia</div>
                                </th>
                                <th>
                                    <div class="th-content">Saldo Awal</div>
                                </th>
                                <th>
                                    <div class="th-content">Denda</div>
                                </th>
                                <th>
                                    <div class="th-content">Iuran</div>
                                </th>
                                <th>
                                    <div class="th-content">Penyesuaian</div>
                                </th>
                                <th>
                                    <div class="th-content">Next Bill</div>
                                </th>
                                <th>
                                    <div class="th-content">Terakhir Bayar</div>
                                </th>

                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('level_scripts_admin')
    <script src="{{ asset('') }}assets/template/src/plugins/src/apex/apexcharts.min.js"></script>
    <script src="{{ asset('') }}assets/template/src/assets/js/widgets/modules-widgets.js"></script>
@endsection
