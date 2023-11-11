<template>
  <div class="container">
    <main>
      <h1 class="font-bold text-lg">Product Detail</h1>
      <div class="border-t border-dashed border-red-500"></div>
      <div class="flex justify-between pt-3">
        <div v-for="(image, index) in singleImage" :key="index" class="flex flex-col items-center">
          <div class="bg-gray-200 rounded p-2">
            <img :src="image.avatar" :eager="true" class="w-full h-full" />
          </div>
          <div class="flex mt-2">
            <div v-for="(subImage, index) in imageList" :key="index" class="bg-gray-200 rounded p-2 ml-2">
              <img :src="subImage.avatar" :eager="true" class="w-full h-full" />
            </div>
          </div>
        </div>
        <div class="flex flex-col ml-4 space-y-6">
          <div>
            <h1 class="text-lg">
              Swiss Made Vegetable <br />
              Cutting Knife
            </h1>
            <p class="text-purple-700 font-bold text-sm"><span class="opacity-70">BY</span> KC COMPANY</p>
          </div>
          <div class="flex items-center justify-between w-2/5 mt-4">
            <div class="bg-purple-200 text-orange-500 font-bold text-lg rounded p-2">$25</div>
            <div>
              <h3 class="text-green-600 font-bold text-sm">Save 12%</h3>
              <p class="text-gray-600 text-sm">Inclusive of all Taxes</p>
            </div>
          </div>
          <p class="text-gray-600 mt-4 leading-6">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem sint fugit quis animi, neque quaerat eaque iure praesentium eum temporibus. Corrupti quod eos vitae voluptatem corporis repellendus natus commodi inventore.</p>
          <div class="w-full flex items-center justify-center">
            <button class="w-full bg-black text-white px-6 py-4">Add to Cart</button>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import ImageOne from "../../assets/logo.png";
import ImageTwo from "../../assets/logo.png";
import ImageThree from "../../assets/logo.png";
import ImageFour from "../../assets/logo.png";
const imageOne = ImageOne;
const imageTwo = ImageTwo;
const imageThree = ImageThree;
const imageFour = ImageFour;
const singleImage = [
  {
    avatar: imageOne,
  },
];
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
  data: function () {
    return {
      singleImage: singleImage,
      imageList: imageList,
    };
  },
};
</script>
