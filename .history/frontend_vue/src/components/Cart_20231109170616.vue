<template>
    <div class="sub-container__box-two--bottom">
      <div>
        <h3 class="cart-count">
          Your Cart <span class="cart-count-span">1</span>
        </h3>
        <div class="sub-container__box-two--flex">
          <div v-for="(cardImage, index) in singleImage" :key="index" class="image-box">
            <avatar :type="'image'" class="main-container__box-one-top">
              <img :src="cardImage.avatar" :eager="true"/>
            </avatar>
            <!-- <img src="../../assets/chair1.jpg" alt="" /> -->
          </div>
          <div>
            <h3>
              Swiss Made Vegetable <br />
              Cutting Knife
            </h3>
            <div class="quantity">
              <p>QTY : 1</p>
              |
              <div class="cart-dollars"><sup class="superscript">$</sup>25</div>
            </div>
          </div>
        </div>
        <div class="cart-group-buttons">
          <k-button class="ghost">View cart</k-button>
          <k-button class="filled">Checkout</k-button>
        </div>
      </div>
    </div>
  </template>
  <script>
  import { Button } from "@progress/kendo-vue-buttons";
  import { Avatar } from "@progress/kendo-vue-layout";
  import ImageFive from ""
  const imageFive = ImageFive;
    const singleImage = [
       {
        avatar: imageFive,
      },
    ]
  export default {
     name: "Cart",
     components: {
      "k-button": Button,
       avatar: Avatar,
    },
      data: function(){
      return {
        singleImage: singleImage,
      }
    }
  };
  </script>
  <style scoped>
  .sub-container__box-two--bottom {
    background: #fff;
    box-shadow: -1px 1px 4px -2px rgb(0 0 0 / 65%);
    border-radius: 10px;
    padding: 1.5rem 2rem;
    margin: 2rem auto;
    min-width: 400px;
  }
  .sub-container__box-two--flex {
    display: flex;
    justify-content: space-between;
  }
  .cart-count {
    padding-bottom: 2rem;
  }
  .cart-count-span {
    background-color: #e5e0ed;
    color: #673ab7;
    font-weight: 700;
    font-size: 1rem;
    border-radius: 7px;
    height: 100%;
    padding: 0.2rem 0.9rem;
    margin-left: 0.5rem;
  }
  .image-box {
    background-color: #f1f0f0;
    height: 80px;
    width: 80px;
    border-radius: 10px;
    overflow: hidden;
    padding: 0.5rem;
  }
  .image-box img {
    width: 100%;
    height: 100%;
  }
  .quantity {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 50%;
  }
  .quantity p {
    font-size: 0.8rem;
    font-weight: 700;
    color: #939191;
  }
  .cart-dollars {
    font-size: 1.2rem;
    color: #673ab7;
    font-weight: 700;
  }
  .superscript {
    color: #939191;
    font-size: 0.9rem;
  }
  .cart-group-buttons {
    padding-top: 2rem;
    display: flex;
    justify-content: space-between;
  }
  .ghost {
    background: transparent;
    border: 1px solid #ddd;
    border-radius: 10px;
    color: #939191;
    font-weight: 600;
    padding: 0.9rem 1rem;
    cursor: pointer;
  }
  .ghost:hover {
    background-color: rgb(209, 209, 209);
  }
  .filled {
    background-color: #673ab7;
    border-radius: 10px;
    color: #fff;
    font-weight: 600;
    padding: 0.9rem 1rem;
    cursor: pointer;
    outline: none;
    border: 1px solid #673ab7;
  }
  .filled:hover {
    background-color: #6430be;
  }
  
  </style>