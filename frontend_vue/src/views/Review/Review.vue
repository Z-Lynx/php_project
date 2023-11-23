<template>
  <div class="container">
    <div class="divide-y divide-green-300">
      <h1 class="text-3xl font-bold">Product Detail</h1>
    </div>
    <hr />
  </div>

  <div class="flex justify-between pt-5">
    <!-- Phần bên trái -->
    <div class="flex-1 flex flex-col ml-40">
      <!-- Nội dung của cột dọc -->
      <button @click="handleImageChange('/src/assets/avatar.jpg')" class="margin mr-3 h-200 mx-300 w-20 mb-2">
        <img src="/src/assets/avatar.jpg" alt="Product" />
      </button>
      <button @click="handleImageChange('/src/assets/avatar1.jpg')" class="margin mr-3 h-200 mx-300 w-20 mb-2">
        <img src="/src/assets/avatar1.jpg" alt="Product" />
      </button>
    </div>

    <!-- Phần giữa -->
    <div class="flex-1 -ml-[750px] -mr-96">
      <div class="margin w-[345px]">
        <img :src="image_src" alt="Product" class="w-full h-full" />
      </div>
    </div>

    <!-- Phần bên phải -->
    <div class="flex-1 justify-between items-center -ml-[80px] mb-5">
      <span class="text-Black font-bold uppercase text-xl block">Mai thúy nhựa 3 kết nối USB Type-C, Bluetooth, Wireless </span>
      <div class="flex space-x-2">
        <span class="block font-bold uppercase text-xl text-[#ea8b71]">$96</span>
        <div class="line-through">
          <span class="block font-bold uppercase text-xl text-[#ea8b71]">$130</span>
        </div>
      </div>
      <hr class="my-2 border-t border-gray-400 w-3/4" />
      <!-- Đường kẻ ngang -->

      <ul class="list-disc pl-4">
        <li><strong>Model:</strong> Bàn phím cơ công thái học AKKO ACR Pro Alice Plus (68 nút)</li>
        <li><strong>Màu sắc:</strong> Spray Painted White (thêm một bước sơn trắng)</li>
        <li><strong>Kết nối:</strong> USB Type C to Type A (dây có thể tháo rời), hỗ trợ cả kết nối USB Type-C to Type-C</li>
        <li><strong>Kích thước:</strong> 380 x 150 x 21mm | Trọng lượng ~ 0.84 kg</li>
        <li><strong>Cấu trúc:</strong> Gasket Mount, case CNC + Acrylic</li>
        <li><strong>Hỗ trợ:</strong> LED RGB, hotswap 5 pin</li>
        <li><strong>Plate:</strong> Polycarbonate (PC)</li>
        <li><strong>PCB:</strong> Dày 1.2mm, có PCB foam làm bằng poron, Foam case EVA, có switch pad (silicon)</li>
        <li><strong>Phím sử dụng:</strong> AKKO Double-Shot TPU Plate-mount Stab</li>
        <li><strong>Hỗ trợ:</strong> NKRO / Multimedia / Macro / Khóa phím windows</li>
        <li><strong>Keycap:</strong> ASA profile – Blue on White | PBT Double-Shot</li>
        <li><strong>Loại switch:</strong> AKKO CS switch – Crystal</li>
        <li><strong>Tương thích:</strong> Windows / MacOS / Linux</li>
      </ul>

      <div class="flex mt-5 mb-10 h-10">
        <button class="hidden md:block rounded-lg font-semibold text-white text-16 px-9 border border-solid bg-[#928383] hover:bg-[#ea8b71] hover:text-[#928383]">Add to Cart</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="flex text-gray-400">
      <h1 class="text-xl mr-5">Description</h1>
      <h1 class="text-xl">Reviews</h1>
    </div>
    <hr class="my-2 border-t border-gray-400 w-3/4" />
    <!-- Đường kẻ ngang -->
    <hr />
  </div>

  <div class="mt-5 ml-40">
    <h3 class="text-lg font-semibold mb-4">Customer Feedback</h3>

    <!-- Biểu đồ phản hồi -->
    <div class="flex items-center">
      <!-- Khung bên trái -->
      <div class="w-1/6">
        <div class="border border-solid border-gray-400 p-6 rounded">
          <div class="text-6xl text-blue-500 font-bold mb-2 ml-7">4.8</div>

          <div class="text-4xl font-bold mb-1 ml-7 text-[#ea8b71]">*****</div>
          <div class="text-xl ml-auto -mt-2 text-gray-500">product rating</div>
        </div>
      </div>

      <!-- Khung bên phải -->
      <div class="w-2/3 ml-5">
        <div class="border border-solid border-gray-400 p-4 rounded">
          <!-- Biểu đồ phần trăm và dấu * -->
          <div class="flex items-center mb-1">
            <div class="w-3/4 relative bg-[#ddd] h-4 rounded overflow-hidden">
              <div class="absolute inset-0 bg-[#555] h-full" style="width: 70%"></div>
            </div>
            <div class="w-1/4"></div>
            <div class="ml-2">*****</div>
            <div class="ml-2">70%</div>
          </div>
          <div class="flex items-center mb-1">
            <div class="w-3/4 relative bg-[#bbb] h-4 rounded overflow-hidden">
              <div class="absolute inset-0 bg-[#555] h-full" style="width: 15%"></div>
            </div>
            <div class="w-1/4"></div>
            <div class="ml-2">****</div>
            <div class="ml-2">15%</div>
          </div>
          <div class="flex items-center mb-1">
            <div class="w-3/4 relative bg-[#999] h-4 rounded overflow-hidden">
              <div class="absolute inset-0 bg-[#555] h-full" style="width: 10%"></div>
            </div>
            <div class="w-1/4"></div>
            <div class="ml-2">***</div>
            <div class="ml-2">10%</div>
          </div>
          <div class="flex items-center mb-1">
            <div class="w-3/4 relative bg-[#777] h-4 rounded overflow-hidden">
              <div class="absolute inset-0 bg-[#555] h-full" style="width: 3%"></div>
            </div>
            <div class="w-1/4"></div>
            <div class="ml-2">**</div>
            <div class="ml-2">3%</div>
          </div>
          <div class="flex items-center mb-1">
            <div class="w-3/4 relative bg-[#6a6a6a] h-4 rounded overflow-hidden">
              <div class="absolute inset-0 bg-[#555] h-full" style="width: 2%"></div>
            </div>
            <div class="w-1/4"></div>
            <div class="ml-2">*</div>
            <div class="ml-2">3%</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="mt-9 text-3xl font-bold">Reviews</div>
    <!-- Đoạn mã đánh giá của người dùng -->
    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
      <div class="flex items-center">
        <img src="@/assets/avatar.jpg" alt="User Avatar" class="w-14 h-14 rounded-full mr-2" />
        <div class="flex flex-col">
          <p class="font-semibold text-gray-800">SK TELECOM T1</p>
          <p class="text-gray-600 text-sm">12 tháng trước</p>
          <span class="text-yellow-500 text-xl">*</span>
        </div>
      </div>
      <p class="mt-2 ml-16 text-gray-700">Phím lởm mất mẹ cúp</p>
      <div class="flex items-center mt-2">
        <!-- Nút Thích và Trả lời -->
        <div class="flex items-center ml-16">
          <button class="text-blue-500 hover:underline mr-2">Like</button>
          <button class="text-gray-500 hover:underline">Replay</button>
        </div>
      </div>

      <div class="bg-gray-100 p-4 rounded-lg shadow-md">
        <div class="flex items-center">
          <img src="@/assets/avatar1.jpg" alt="User Avatar" class="w-14 h-14 rounded-full mr-2" />
          <div class="flex flex-col">
            <p class="font-semibold text-gray-800">DRX</p>
            <p class="text-gray-600 text-sm">12 tháng trước</p>
            <span class="text-yellow-500 text-xl">*****</span>
          </div>
        </div>
        <p class="mt-2 ml-16 text-gray-700">cHÚNG TÔI K XÀI THẰNG Ở TRÊN XÀI</p>
        <div class="flex items-center mt-2">
          <!-- Nút Thích và Trả lời -->
          <div class="flex items-center ml-16">
            <button class="text-blue-500 hover:underline mr-2">Like</button>
            <button class="text-gray-500 hover:underline">Replay</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
const image_src = ref("/src/assets/sp.png");

const handleImageChange = (url) => {
  image_src.value = url;
};
</script>
<style></style>
