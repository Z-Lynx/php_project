<template>
    <div class="container">
     <Header />
     <main>
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
      </div>
     </main>
    </div>
   </template>
   
   <script>
   import Header from "../../components/layouts/header/Header.vue"
   import { Avatar } from "@progress/kendo-vue-layout";
   import ImageOne from "../../assets/chair1.jpg"
   import ImageTwo from "../../assets/chair2.jpg"
   import ImageThree from "../../assets/chair1.jpg"
   import ImageFour from "../../assets/knife3.jpg"
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
     Header,
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
   
   .main-container__box-one-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
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
    margin: 2rem 0;
    cursor: pointer;
    overflow: hidden;
   }
   </style>