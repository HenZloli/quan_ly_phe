@extends('layouts.app')

@section('title', 'Highlands Coffee')

@section('content')

<style>
    body {
        font-family: 'Helvetica', sans-serif;
    }

    .coffee-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #8b2c23; /* màu nâu đỏ Highlands */
    }

    .product-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .product-card {
        width: 220px;
        padding: 12px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        cursor: pointer;
        transition: 0.2s;
        background: #fff;
        border: 2px solid transparent;
    }

    .product-card:hover {
        transform: scale(1.02);
        border: 2px solid #8b2c23;
    }

    .product-card img {
        width: 100%;
        border-radius: 10px;
    }

    /* POPUP */
    .popup-bg {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.65);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
        backdrop-filter: blur(3px);
    }

    .popup-box {
        background: #fff;
        width: 380px;
        padding: 25px;
        border-radius: 16px;
        animation: fadeIn .25s ease-in-out;
        box-shadow: 0 5px 20px rgba(0,0,0,0.25);
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .label-title {
        font-weight: bold;
        margin-top: 15px;
        color: #8b2c23;
    }

    .size-option {
        display: flex;
        gap: 10px;
        margin: 8px 0;
    }

    .size-option label {
        padding: 8px 14px;
        border: 1px solid #aaa;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
        background: #f7f7f7;
    }

    .size-option label:hover {
        border: 1px solid #8b2c23;
        background: #ffe6e1;
    }

    textarea {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .pay-btn {
        width: 100%;
        background: #8b2c23;
        border: none;
        padding: 14px;
        border-radius: 12px;
        color: #fff;
        font-weight: bold;
        font-size: 16px;
        margin-top: 15px;
        cursor: pointer;
        transition: 0.2s;
    }

    .pay-btn:hover {
        background: #a63129;
    }

    .close-btn {
        margin-top: 10px;
        width: 100%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 12px;
        background: white;
        cursor: pointer;
    }
</style>


<h2 class="coffee-title">☕ Highlands Coffee</h2>

<div class="product-list">

    {{-- Sản phẩm 1 --}}
    <div class="product-card" onclick="openPopup(
        'Cà Phê Phin Sữa',
        'Cà phê phin pha truyền thống, vị đậm đà, ngọt béo chuẩn Highlands.',
        '/images/highlands1.jpg',
        39000
    )">
        <img src="/images/highlands1.jpg">
        <h4 style="margin-top:10px;">Cà Phê Phin Sữa</h4>
        <p><strong>39.000₫</strong></p>
    </div>

    {{-- Sản phẩm 2 --}}
    <div class="product-card" onclick="openPopup(
        'Freeze Trà Xanh',
        'Freeze mát lạnh vị trà xanh, kem béo thơm, best-seller Highlands.',
        '/images/highlands2.jpg',
        49000
    )">
        <img src="/images/highlands2.jpg">
        <h4 style="margin-top:10px;">Freeze Trà Xanh</h4>
        <p><strong>49.000₫</strong></p>
    </div>

    {{-- Sản phẩm 3 --}}
    <div class="product-card" onclick="openPopup(
        'Trà Sen Vàng',
        'Trà sen thơm nhẹ, thêm thạch giòn, thanh mát đúng điệu.',
        '/images/highlands3.jpg',
        45000
    )">
        <img src="/images/highlands3.jpg">
        <h4 style="margin-top:10px;">Trà Sen Vàng</h4>
        <p><strong>45.000₫</strong></p>
    </div>

</div>

{{-- POPUP --}}
<div class="popup-bg" id="popup">

    <div class="popup-box">
        <img id="popupImg" src="" style="width:100%; border-radius:12px; margin-bottom:15px;">

        <h3 id="popupName"></h3>
        <p id="popupDesc"></p>

        <h4 class="label-title">Chọn size</h4>
        <div class="size-option">
            <label><input type="radio" name="size" value="S" checked> S</label>
            <label><input type="radio" name="size" value="M"> M</label>
            <label><input type="radio" name="size" value="L"> L</label>
        </div>

        <h4 class="label-title">Ghi chú</h4>
        <textarea id="note" placeholder="Ít đá, thêm kem, ngọt 50%..."></textarea>

        <button class="pay-btn" onclick="payNow()">Thanh toán</button>
        <button class="close-btn" onclick="closePopup()">Đóng</button>
    </div>

</div>

<script>
    let price = 0;
    let productName = "";

    function openPopup(name, desc, img, productPrice) {
        productName = name;
        price = productPrice;

        document.getElementById('popupName').textContent = name;
        document.getElementById('popupDesc').textContent = desc;
        document.getElementById('popupImg').src = img;

        document.getElementById('popup').style.display = "flex";
    }

    function closePopup() {
        document.getElementById('popup').style.display = "none";
    }

    function payNow() {
        const size = document.querySelector('input[name="size"]:checked').value;
        const note = document.getElementById('note').value;

        alert(
            "Đặt hàng thành công!\n" +
            "Sản phẩm: " + productName + "\n" +
            "Size: " + size + "\n" +
            "Ghi chú: " + note + "\n" +
            "Giá: " + price.toLocaleString() + "₫"
        );
    }
</script>

@endsection
