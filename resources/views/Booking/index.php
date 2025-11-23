<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sơ đồ bàn</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100" x-data="tableApp()">
<!-- TITLE -->
<h1 class="text-3xl font-bold text-center mt-6 mb-6">Danh sách bàn</h1>
<!-- FULL SCREEN TABLE MAP -->
<div class="w-full h-screen flex items-center justify-center">

    <div class="grid grid-cols-3 gap-10">
        <template x-for="table in tables" :key="table.id">

            <div @click="openForm(table)"
                 class="p-10 rounded-2xl shadow-lg cursor-pointer text-center font-bold text-2xl"
                 :class="table.booked ? 'bg-red-300 cursor-not-allowed' : 'bg-green-200 hover:bg-green-300'">

                Bàn <span x-text="table.id"></span>

                <div class="text-sm mt-2"
                     x-text="table.booked ? 'Đã đặt' : 'Còn trống'"></div>
            </div>

        </template>

    </div>
</div>

<!-- POPUP FORM -->
<div x-show="showModal" 
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
     x-transition>

    <div class="bg-white p-8 rounded-xl shadow-xl w-96"
         @click.outside="closeForm">

        <h2 class="text-xl font-semibold mb-4 text-center">
            Đặt bàn <span x-text="selectedTable"></span>
        </h2>

        <form @submit.prevent="submitBooking">

            <div class="mb-4">
                <label class="font-medium">Tên</label>
                <input type="text" x-model="form.name"
                       class="w-full border rounded-lg p-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="font-medium">Ngày đặt</label>
                <input type="date" x-model="form.date"
                       class="w-full border rounded-lg p-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="font-medium">Số điện thoại</label>
                <input type="text" x-model="form.phone"
                       class="w-full border rounded-lg p-2 mt-1" required>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white w-full py-2 rounded-lg hover:bg-blue-700">
                Xác nhận
            </button>

            <button type="button" @click="closeForm"
                    class="mt-3 w-full py-2 border rounded-lg hover:bg-gray-100">
                Hủy
            </button>

        </form>

    </div>
</div>

<script>
function tableApp() {
    return {

        tables: [
            { id: 1, booked: false },
            { id: 2, booked: true },
            { id: 3, booked: false },
            { id: 4, booked: false },
            { id: 5, booked: true },
            { id: 6, booked: false },
            { id: 7, booked: false },
            { id: 8, booked: true },
            { id: 9, booked: false },
        ],

        showModal: false,
        selectedTable: null,

        form: {
            name: '',
            date: '',
            phone: ''
        },

        openForm(table) {
            if (table.booked) return;
            this.selectedTable = table.id;
            this.showModal = true;
        },

        closeForm() {
            this.showModal = false;
        },

        submitBooking() {
            alert("Đặt bàn thành công!");
            this.closeForm();
        }
    };
}
</script>

</body>
</html>
