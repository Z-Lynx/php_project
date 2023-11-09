<template>
  <div class="container">
        <div class="row pt-5">
            <div class="col-md-1"></div>
            <!--            display image-->
            <div class="col-md-4 col-12">
                <img :src="product.imageURL" class="img-fluid">
            </div>
            <!--            display product details-->
            <div class="col-md-6 col-12 pt-3 pt-md-0">
                <h4>{{ product.name }}</h4>
                <h6 class="catgory font-italic"> {{category.categoryName}}</h6>
                <h6 class="font-weight-bold"> $ {{product.price}}</h6>
                <p>
                    {{ product.description }}
                </p>
                <div class="features pt-3">
                    <h5><strong>Features</strong></h5>
                    <ul>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                        <li>Officia quas, officiis eius magni error magnam voluptatem</li>
                        <li>nesciunt quod! Earum voluptatibus quaerat dolorem doloribus</li>
                        <li>molestias ipsum ab, ipsa consectetur laboriosam soluta et</li>
                        <li>ut doloremque dolore corrupti, architecto iusto beatae.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
var productDetail = new Vue({
  el: "#app",
  data: {
    productTitle: "Round Neck Vue Logo T-Shirt",
    productPrice: "$20",
    productChecks: [
      "100% cotton on the neckline",
      "certified and safe",
      "ash in color",
      "Smooth in quality"
    ],
    bannerImage: "https://i.imgur.com/Nmuu6Jh.jpg",
    productImages: [
      {
        id: 3435,
        imageUrl: "https://i.imgur.com/Nmuu6Jh.jpg"
      },
      {
        id: 3436,
        imageUrl: "https://i.imgur.com/VFcTYyU.jpg"
      }
    ],
    cart: 0,
    stockAvailability: true,
    activeClass: 0
  },
  methods: {
    addToCart: function () {
      this.cart = this.cart + 1;
    },
    currentThumnail: function (image, index) {
      this.bannerImage = image;
      this.activeClass = index;
    }
  }
});
</script>