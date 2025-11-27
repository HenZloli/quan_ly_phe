<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sơ đồ bàn - Cafe</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        :root{
            --brown: #6b3e2a;
            --bg1: #f3e9dd;
            --bg2: #f8f5ef;
        }
        html,body{height:100%;}
        body{
            margin:0;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(135deg, var(--bg1), var(--bg2));
        }

        .plan-box{
            background: rgba(255,255,255,0.9);
            border-radius: 42px;
            padding: 36px;
            box-shadow: 0 18px 40px rgba(20,20,30,0.08);
            border: 1px solid rgba(0,0,0,0.06);
            max-width:1100px;
            margin: 40px auto;
        }

        .title-top{
            font-weight:700;
            letter-spacing:1px;
            font-size:14px;
            text-align:center;
            margin-bottom:12px;
        }

        .table-grid{display:grid; grid-template-columns: repeat(3, 1fr); gap:32px;}
        .table-box{
            width:100%;
            height:120px;
            border-radius:18px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:20px;
            transition: transform .18s ease, box-shadow .18s ease;
            cursor: pointer;
        }
        .table-box.available{
            background: #fff;
            border: 2px solid rgba(0,0,0,0.08);
            color:#222;
        }
        .table-box.booked{
            background: var(--brown);
            color:#fff;
            box-shadow: 0 6px 18px rgba(0,0,0,0.14);
            cursor: not-allowed;
        }
        .table-box.available:hover{transform:translateY(-6px)}

        .status-badge{
            display:inline-block;
            margin-top:10px;
            padding:6px 12px;
            border-radius:10px;
            font-weight:600;
            font-size:13px;
        }
        .status-available{background:#fff; border:1px solid rgba(0,0,0,0.06);}
        .status-booked{background:var(--brown); color:#fff;}

        .page-wrap{min-height:calc(100vh - 40px); display:flex; align-items:center;}

        /* Modal styles fixed */
        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }
        
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.45);
            z-index: 1040;
        }
        
        .modal-card{
            position: relative;
            z-index: 1050;
            border-radius:14px;
            box-shadow: 0 18px 40px rgba(20,20,30,0.12);
            overflow:hidden;
            background: white;
            width: 420px;
            max-width: 90vw;
        }
        
        .btn-brown{background:var(--brown); color:#fff;}
        .btn-brown:hover{background:#5b341f}

        @media(max-width:900px){
            .table-grid{grid-template-columns: repeat(2, 1fr); gap:20px}
        }
        @media(max-width:560px){
            .table-grid{grid-template-columns: 1fr;}
            .plan-box{padding:20px}
        }
    </style>

</head>
<body x-data="mapApp()">

<div class="page-wrap">
    <div class="container">
        <div class="plan-box">
            <div class="title-top">SƠ ĐỒ QUÁN</div>
            <div class="table-grid">
                <template x-for="table in tables" :key="table.id">
                    <div class="text-center">
                        <div :class="`table-box ${table.booked ? 'booked' : 'available'}`"
                             @click="open(table)">
                            <div>Bàn <span x-text="table.id"></span></div>
                        </div>
                        <div class="mt-2">
                            <span class="status-badge" :class="table.booked ? 'status-booked' : 'status-available'"
                                  x-text="table.booked ? 'Đã đặt' : 'Chưa đặt'"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<!-- Modal Fixed -->
<template x-if="showModal">
    <div class="modal-container">
        <div class="modal-backdrop" @click="close"></div>
        <div class="modal-card p-4">
            <div class="px-3 py-2">
                <div class="text-center mb-3">
                    <div style="width:72px; height:72px; border-radius:50%; background:transparent; margin:0 auto 8px; display:flex; align-items:center; justify-content:center; border:4px solid rgba(107,62,42,0.12)">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 7h8v5a4 4 0 11-8 0V7z" stroke="#6b3e2a" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h4 class="mb-0" style="font-weight:700">Đặt bàn <span x-text="selectedId"></span></h4>
                </div>

                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input x-model="form.name" required type="text" class="form-control form-control-lg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày đặt</label>
                        <input x-model="form.date" required type="date" 
                               :min="new Date().toISOString().split('T')[0]"
                               class="form-control form-control-lg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input x-model="form.phone" required type="tel" class="form-control form-control-lg" placeholder="09xxxxxxxx">
                    </div>

                    <button type="submit" class="btn btn-brown w-100 mb-2">Xác nhận</button>
                    <button type="button" @click="close" class="btn btn-outline-secondary w-100">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
function mapApp(){
    return {
        tables: [
            {id:1, booked:true},
            {id:2, booked:false},
            {id:3, booked:false},
            {id:4, booked:false},
            {id:5, booked:true},
            {id:6, booked:false},
            {id:7, booked:false},
            {id:8, booked:false},
            {id:9, booked:false}
        ],
        showModal:false,
        selectedId:null,
        form:{name:'', date:'', phone:''},

        open(table){
            if(table.booked) return;
            this.selectedId = table.id;
            this.showModal = true;
        },
        close(){
            this.showModal = false;
            this.selectedId = null;
            this.form = {name:'', date:'', phone:''};
        },
        submit(){
            // Validate phone number
            const phoneRegex = /(0[3|5|7|8|9])+([0-9]{8})\b/;
            if (!phoneRegex.test(this.form.phone)) {
                alert('Số điện thoại không hợp lệ! Vui lòng nhập số điện thoại Việt Nam.');
                return;
            }
            
            let idx = this.tables.findIndex(t => t.id === this.selectedId);
            if(idx !== -1){
                this.tables[idx].booked = true;
                alert(`Đã đặt bàn ${this.selectedId} thành công!`);
            }
            this.close();
        }
    }
}
</script>

</body>
</html>