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
      <div style="flex: 1">
        <div>
          <!-- Hình ảnh sản phẩm -->
          <div style="margin-right: 10px">
            <img src="@/assets/sp.png" alt="Product" />
          </div>

          <!-- Tên sản phẩm -->
          <div class="prd">Bàn phím alice</div>

          <!-- Giá sản phẩm -->
          <div class="prd" style="color: chocolate">$100</div>
        </div>
      </div>

      <!-- Phần hiển thị chi tiết thanh toán -->
      <div style="flex: 1">
        <div>
          <!-- Tiêu đề Payment Detail -->
          <h2 class="PM">Payment Detail</h2>

          <!-- Các thông tin thanh toán -->
          <div>
            <div class="PMD">
              <span>Subtotal:</span>
              <span>$100.00</span>
            </div>
            <div class="PMD">
              <span>Discount:</span>
              <span>-$10.00</span>
            </div>
            <div class="PMD">
              <span>Shipment:</span>
              <span>$5.00</span>
            </div>

            <!-- Đường kẻ ngang -->
            <div class="line"></div>

            <!-- Tổng cộng -->
            <div class="PMD" style="color: #000000">
              <span>Grand Total:</span>
              <span>$95.00</span>
            </div>
          </div>
        </div>

        <!-- thông tin người dùng -->
        <div>
          <h2 class="ET">Enter your details</h2>

          <!--trường nhập liệu -->
          <div class="input-container">
            <input type="text" class="input-field" id="fullName" placeholder="Full Name" />
            <span class="delete-icon">x</span>
          </div>

          <div class="input-container">
            <input type="text" class="input-field" id="phonenumber" placeholder="Phone Number" />
            <span class="delete-icon">x</span>
          </div>

          <div class="input-container">
            <input class="input-field" type="text" id="streetAddress" placeholder="Street Name and House Number" />
            <span class="delete-icon">x</span>
          </div>
          <div style="display: flex">
            <div class="input-container" style="width: 40%">
              <input type="text" class="input-field" id="city" placeholder="City" list="cityList" />
              <span class="delete-icon">x</span>
            </div>

            <div class="SG">
              <select id="select region" class="input-field">
                <option value="Region 1">Hà Nội</option>
                <option value="Region 2">Đà Nẵng</option>
                <option value="Region 3">Đà Lạt</option>
              </select>
            </div>
          </div>

          <div class="input-container">
            <input type="text" class="input-field" id="postalCode" placeholder="Postal Code" />
            <span class="delete-icon">x</span>
          </div>

          <!-- Checkbox -->
          <div>
            <input type="checkbox" id="recipient" class="checkbox-input" />
            <label for="recipient" class="checkbox-label">I am the recipient of my order</label>
          </div>

          <div class="input-container">
            <input type="text" class="input-field" id="recipientName" placeholder="Recipient Name" />
            <span class="delete-icon">x</span>
          </div>
          <div class="input-container">
            <input type="text" class="input-field" id="recipientPhoneNumber" placeholder="Phone Number" />
            <span class="delete-icon">x</span>
          </div>

          <!-- Các nút điều hướng -->
          <div class="buttons">
            <button>Back</button>
            <button>Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup></script>

<style src="@/styles/custom-styles.css"></style>
