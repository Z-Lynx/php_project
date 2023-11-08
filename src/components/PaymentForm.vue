<template>
  <div>
    <h1>Payment Information</h1>
    <form @submit.prevent="processPayment">
      <div>
        <label for="cardNumber">Card Number:</label>
        <input type="text" id="cardNumber" v-model="cardNumber" />
      </div>
      <div>
        <label for="expiryDate">Expiry Date:</label>
        <input type="text" id="expiryDate" v-model="expiryDate" />
      </div>
      <div>
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" v-model="cvv" />
      </div>
      <button type="submit">Pay Now</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cardNumber: '',
      expiryDate: '',
      cvv: ''
    };
  },
  methods: {
    processPayment() {
      // Xử lý thanh toán ở đây
      console.log('Thông tin thanh toán:', this.cardNumber, this.expiryDate, this.cvv);
    }
  }
};
</script>

<style scoped>
/* CSS cho component này (tùy chọn) */
</style>
