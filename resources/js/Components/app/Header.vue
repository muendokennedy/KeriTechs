<script setup>
import { ref } from 'vue'
import { Bars3BottomLeftIcon } from '@heroicons/vue/24/solid'

const show = ref(false)

</script>

<template>
      <header class="fixed z-10 top-0 right-0 left-0 bg-[#68A4FE] shadow-[0_6px_12px_rgba(56,72,87,0.5)]">
      <section class="flex justify-between items-center px-[4%] mx-auto lg:max-w-[1500px] outline-1 outline-black">
        <div class="text-2xl font-semibold sm:font-extrabold text-white">KeriTech</div>
        <div class="py-4">
         <Bars3BottomLeftIcon @click="show = !show"  class="humbuger-btn size-8 text-white font-extrabold cursor-pointer text-3xl"></Bars3BottomLeftIcon>
        </div>
        <Transition class="mobile-menu-navigation-bar">
            <div v-if="show" class="bg-[#68A4FE] absolute top-[4rem] right-0  z-50 h-screen">
                <a href="index.html" class="block py-4 px-6  text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">Home</a>
                <a href="about.html" class="block py-4 px-6  text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">About</a>
                <a href="products.html" class="block py-4 px-6  text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">Products</a>
                <a href="contact.html" class="block py-4 px-6  text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">contact</a>
                <a href="cart.html" class="cart-link  flex items-center text-white capitalize ease-in-ou gap-8 px-6 mt-4">cart<span class="cart-btn"><i class="fa-solid fa-cart-shopping"></i><span class="count">0</span></span></a>
            </div>
        </Transition>
        <nav class="primary-navigation-bar flex items-center justify-between">
          <a href="index.html" class="py-4 px-3 text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">Home</a>
          <a href="about.html" class="py-4 px-3 text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">About</a>
          <a href="products.html" class="py-4 px-3 text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">Products</a>
          <a href="contact.html" class="py-4 px-3 text-white capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">contact</a>
          <a href="cart.html" class="cart-link flex items-center px-3 text-white capitalize ease-in-out">cart<span class="cart-btn"><i class="fa-solid fa-cart-shopping"></i><span class="count">0</span></span></a>
        </nav>
      </section>
    </header>
</template>
<style scoped>
.v-enter-from, .v-leave-to{
    right: -100%;
}
.v-enter-active, .v-leave-active {
  transition: all 0.5s ease;
}
</style>
