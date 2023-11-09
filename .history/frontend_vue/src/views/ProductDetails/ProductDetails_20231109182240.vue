<template>
    <div class="container">
     <main>
      <h1 style="font-weight: 700; font-size: larger;">Product Detail</h1>
      <div style="border-top: 1px dashed red;"></div>
      <div class="main-container">
       <div v-for="(image, index) in singleImage" :key="index" class="main-container__box-one">
        <avatar :type="'image'" class="main-container__box-one-top">
         <img :src="image.avatar" :eager="true"/>
        </avatar>
        <div class="main-container__box-one-bottom">
         <div v-for="(subImage, index) in imageList" :key="index" class="main-container__box-one-bottom--innerbox">
          <avatar :type="'image'" class="main-container__box-one-top">
           <img :src="subImage.avatar" :eager="true"/>
          </avatar>
         </div>
        </div>
       </div>
       <div class="main-container__box-two">
        <div class="main-container__box-two--title">
         <h1>
          Swiss Made Vegetable <br />
          Cutting Knife
         </h1>
         <p class="author"><span class="author-span">BY</span> KC COMPANY</p>
        </div>
        <div class="sub-container__box-two">
         <div class="sub-container__box-two--price">
          <div class="dollars"><sup class="superscript">$</sup>25</div>
          <div class="percent">
           <h3>Save 12%</h3>
           <p>Inclusive of all Taxes</p>
          </div>
         </div>
         <p class="desc">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem sint
          fugit quis animi, neque quaerat eaque iure praesentium eum
          temporibus. Corrupti quod eos vitae voluptatem corporis
          repellendus natus commodi inventore.
         </p>
         <div>
          <k-button class="filled bg-[#D9D9D9] ">Add to Cart</k-button>
         </div>
        </div>
        <!-- <Cart /> -->
         
       </div>
      </div>
     </main>
    </div>
   </template>
   <script>
   import { Button } from "@progress/kendo-vue-buttons";
   import Cart from "../../components/Cart.vue"
   import { Avatar } from "@progress/kendo-vue-layout";
   import ImageOne from "../../assets/logo.png"
   import ImageTwo from "../../assets/logo.png"
   import ImageThree from "../../assets/logo.png"
   import ImageFour from "../../assets/logo.png"
   const imageOne = ImageOne;
   const imageTwo = ImageTwo;
   const imageThree = ImageThree;
   const imageFour = ImageFour;
    const singleImage = [
      {
      avatar: imageOne,
     },
    ]
    const imageList = [
    {
     avatar: imageTwo,
    },
    {
     avatar: imageThree,
    },
    {
     avatar: imageFour,
    },
   ];
   export default {
    name: "Product",
    components: {
     Cart,
     "k-button": Button,
      avatar: Avatar,
    },
    data: function(){
     return {
      singleImage: singleImage,
      imageList: imageList,
     }
    }
   };
   </script>
   <style scoped>
   * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
   }
   .container {
    background: #fff;
    font-family: "Montserrat", sans-serif;
    max-width: 1200px;
    margin: 0 auto;
   }
   .main-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 0 2rem;
   }
   .main-container__box-one {
    width: 100%;
    height: 100%;
   }
   .main-container__box-one-top {
    background: #f1f0f0;
    border-radius: 10px;
    overflow: hidden;
    padding: 0.5rem;
   }
   .main-container__box-one-top img {
    width: 100%;
    height: 100%;
   }
   .k-avatar-solid.k-avatar-primary {
    border-color: transparent;
    background-color: #f1f0f0;
    height: 100%;
    width: 100%;
   }
   .main-container__box-one-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 2rem 0;
   }
   .main-container__box-one-bottom--innerbox img {
    width: 100%;
    height: 100%;
   }
   .main-container__box-one-bottom--innerbox:nth-of-type(2) {
    border: 2px solid #673ab7;
   }
   .main-container__box-one-bottom div {
    background: #f1f0f0;
    height: 130px;
    width: 150px;
    border-radius: 10px;
    cursor: pointer;
    overflow: hidden;
   }
   .main-container__box-two {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    width: 100%;
    margin-left: 2rem;
   }
   .main-container__box-two--title h1 {
    font-size: 1.9rem;
   }
   .author {
    margin: 1rem 0;
    color: #673ab7;
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 2px;
   }
   .author-span {
    opacity: 0.7;
    color: rgb(184, 183, 183);
   }
   .sub-container__box-two--price {
    display: flex;
    justify-content: space-between;
    width: 45%;
    margin: 1rem 0;
   }
   .dollars {
    background-color: #e5e0ed;
    color: #673ab7;
    font-weight: 700;
    font-size: 1.5rem;
    padding: 0.5rem 0.8rem;
    border-radius: 7px;
    height: 100%;
   }
   .percent h3 {
    font-size: 1.1rem;
    color: #39d939;
    font-weight: 700;
   }
   .percent p {
    font-size: 0.9rem;
    color: #939191;
    font-weight: 400;
    margin: 0.5rem 0;
   }
   .desc {
    color: #939191;
    padding: 1rem 0;
    font-weight: 400;
    line-height: 2;
   }
   .filled {
    background-color: #D9D9D9;
    border-radius: 10px;
    color: #fff;
    font-weight: 600;
    padding: 0.9rem 1rem;
    cursor: pointer;
    outline: none;
    /* border: 1px solid #673ab7; */
   }
   .filled:hover {
    background-color: #D9D9D9;
    opacity: ;
   }
   </style>