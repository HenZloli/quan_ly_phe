@extends('layouts.app')

@section('title', 'Highlands Coffee')

@section('content')

<style>
    .section-title {
        font-size: 26px;
        font-weight: 700;
        margin-top: 40px;
        margin-bottom: 20px;
        color: #333;
    }
    .hover-zoom img {
        transition: 0.3s;
    }
    .hover-zoom img:hover {
        transform: scale(1.03);
    }
</style>

{{-- BANNER LỚN --}}
<div class="container mt-3">
    <img src="https://www.highlandscoffee.com.vn/vnt_upload/weblink/HCO_7811_GLOBAL_FESTIVE_DC_WEB_BANNER_1920X926.jpg"
         class="img-fluid rounded shadow">
</div>



{{-- ĐỒNG HÀNH CÙNG HIGHLANDS --}}
<div class="container">
    <h3 class="section-title text-center">Đồng Hành Cùng Highlands</h3>
    <div class="row g-4">
        <div class="col-md-4 hover-zoom">
            <img src="{{ asset('images/nhan_vien.png') }}"
                 class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-4 hover-zoom">
            <img src="https://www.highlandscoffee.com.vn/vnt_upload/home/bbimg2.jpg"
                 class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-4 hover-zoom">
            <img src="https://www.highlandscoffee.com.vn/vnt_upload/home/WEB_Banner.png"
                 class="img-fluid rounded shadow-sm">
        </div>
    </div>
</div>

{{-- GỢI Ý THỰC ĐƠN --}}
<div class="container mt-5">
    <div class="row g-4">
        <div class="col-md-6 hover-zoom">
            <img src="https://www.highlandscoffee.com.vn/vnt_upload/home/web_banner_2000x2000.jpg"
                 class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6 hover-zoom">
            <img src="https://www.highlandscoffee.com.vn/vnt_upload/home/web_banner_2000x2000.jpg"
                 class="img-fluid rounded shadow-sm">
        </div>
    </div>
</div>

{{-- CỬA HÀNG GẦN BẠN --}}
<div class="container mt-5">
    <div class="text-center mb-3">
        <h3 class="fw-bold">Cửa Hàng Highlands Gần Bạn</h3>
        <p>Khám phá các cửa hàng Highlands Coffee gần nhất.</p>
    </div>
    <img src="https://www.highlandscoffee.com.vn/vnt_upload/home/1_1.jpg"
         class="img-fluid rounded shadow">
</div>

@endsection
