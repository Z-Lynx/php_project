<template>
  <div class="container">
    <!-- Đường kẻ chấm vuông -->
    <div class="divide-y divide-green-300">
      <!-- Tiêu đề -->
      <h1 class="text-3xl font-bold">Product Detail</h1>
    </div>
    <!-- Đường kẻ ngang -->
    <hr />

    <!-- Phân chia thành hai phần -->
    <div class="flex justify-between pt-5">
      <!-- Phần hiển thị thông tin sản phẩm -->
      <div class="flex flex-1">
        <div>
          <!-- Hình ảnh sản phẩm -->
          <div class="margin mr-3 h-200 mx-300">
            <img src="@/assets/sp.png" alt="Product" />
          </div>

          <!-- Tên sản phẩm -->
          <div class="prd ml-5 pl-10 text-4xl">Bàn phím alice</div>

          <!-- Giá sản phẩm -->
          <div class="prd ml-5 pl-10 text-4xl text-black">$100</div>
        </div>
      </div>

      <!-- Phần hiển thị chi tiết thanh toán -->
      <div class="flex flex-2">
        <div>
          <!-- Tiêu đề Payment Detail -->
          <h2 class="text-black text-2xl font-bold mb-2 ">Payment Detail</h2>

          <!-- Các thông tin thanh toán -->
          <div>
            <div class="flex justify-between items-center mx-15 mb-5 text-gray-500">
              <span>Subtotal:</span>
              <span>$100.00</span>
            </div>
            <div class="flex justify-between items-center mx-15 mb-5 text-gray-500">
              <span>Discount:</span>
              <span>-$10.00</span>
            </div>
            <div class="flex justify-between items-center mx-15 mb-5 text-gray-500">
              <span>Shipment:</span>
              <span>$5.00</span>
            </div>

            <!-- Đường kẻ ngang -->
            <div class="h-px mx-1 border-t border-gray-400 w-full"></div>

            <!-- Tổng cộng -->
            <div class="flex justify-between items-center mx-15 mb-10 text-gray-500" style="color: #000000">
              <span>Grand Total:</span>
              <span>$95.00</span>
            </div>
          </div>
        </div>

        <!-- thông tin người dùng -->
        <div>
          <h2 class="text-black text-2xl font-bold mb-20 -ml-44 mt-52 ">Enter your details</h2>

          <!--trường nhập liệu -->
          <div class="flex items-center w-full -mx-44 -mt-12">
            <input type="text" class="flex-grow border border-solid border-black p-1 rounded flex items-center w-full " id="fullName" placeholder="Full Name" />
            <span class="delete-icon cursor-pointer p-1 bg-white rounded-full inline-flex justify-center items-center -ml-4 ">x</span>
          </div>

          <div class="flex items-center w-full -mx-44 mt-3 ">
            <input type="text" class="flex-grow border border-solid border-black p-1 rounded flex items-center w-full " id="phonenumber" placeholder="Phone Number" />
            <span class="delete-icon cursor-pointer p-1 bg-white rounded-full inline-flex justify-center items-center -ml-4 ">x</span>
          </div>

          <div class="flex items-center w-full -mx-44 mt-3">
            <input class="flex-grow border border-solid border-black p-2 rounded flex items-center w-full" type="text" id="streetAddress" placeholder="Street Name and House Number" />
            <span class="delete-icon cursor-pointer p-1 bg-white rounded-full inline-flex justify-center items-center -ml-4 ">x</span>
          </div>
          <div style="display: flex">
            <div class="flex items-center w-full -mx-44 mt-3">
              <input type="text" class="flex-grow border border-solid border-black p-1 rounded flex items-center w-full" id="city" placeholder="City" list="cityList" />
              <span class="delete-icon cursor-pointer p-2 bg-white rounded-full inline-flex justify-center items-center -ml-8">x</span>
            </div>

            <div class="SG flex items-center w-2/3 mr-44 ml-56 mt-3 ">
              <select id="select region" class="iflex-grow border border-solid border-black p-1 rounded flex items-center w-full">
                <option value="Region 1">Hà Nội</option>
                <option value="Region 2">Đà Nẵng</option>
                <option value="Region 3">Đà Lạt</option>
              </select>
            </div>
          </div>

          <div class="flex items-center w-full -mx-44 mt-3">
            <input type="text" class="input-field border border-solid border-black p-1 rounded flex items-center w-full" id="postalCode" placeholder="Postal Code" />
            <span class="delete-icon cursor-pointer p-1 bg-white rounded-full inline-flex justify-center items-center -ml-4 ">x</span>
          </div>

          <!-- Checkbox -->
          <div class="flex items-center">
  <input type="checkbox" id="recipient" class="checkbox-input bg-black -mx-44 w-5 h-5 mt-3 ">
  <label for="recipient" class="checkbox-label text-gray-600 mx-44 mt-3 ">I am the recipient of my order</label>
</div>


          <div class="flex items-center w-full -mx-44 mt-3">
            <input type="text" class="input-field border border-solid border-black p-1 rounded flex items-center w-full" id="recipientName" placeholder="Recipient Name" />
            <span class="delete-icon cursor-pointer p-1 bg-white rounded-full inline-flex justify-center items-center -ml-4 ">x</span>
          </div>
          <div class="flex items-center w-full -mx-44 mt-3">
            <input type="text" class="input-field border border-solid border-black p-1 rounded flex items-center w-full" id="recipientPhoneNumber" placeholder="Phone Number" />
            <span class="delete-icon cursor-pointer p-1 bg-white rounded-full inline-flex justify-center items-center -ml-4 ">x</span>
          </div>

          <!-- Các nút điều hướng -->
          <div class="flex mt-5 mb-10 h-10 -ml-24 ">
            <button class="hidden md:block  rounded-lg bg-[#ea8b71] text-white text-16 px-9 border border-solid hover:bg-white hover:text-[#ea8b71]">Back</button>
            <div class="mx-1"></div>
            <button class="hidden md:block  rounded-lg bg-[#ea8b71] text-white text-16 px-9 border border-solid hover:bg-white hover:text-[#ea8b71]">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup></script>

<style>


</style>

