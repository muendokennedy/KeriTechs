<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import ProductModal from '@/Components/app/ProductModal.vue'
import {ref} from 'vue'
import { PencilSquareIcon, TrashIcon, CloudArrowUpIcon, XMarkIcon } from '@heroicons/vue/24/solid'
import {isImage} from '@/helpers.js'
import { useForm} from '@inertiajs/vue3'

const props = defineProps({
  products: {
    type: Array,
    required: true
  }
})


import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'

const isOpen = ref(false)
const editProduct = ref({})

function closeModal() {
  isOpen.value = false
  onModalhide()
}
function openModal(product) {
  isOpen.value = true
  editProduct.value = product
  console.log(editProduct.value)
}


const onModalhide = () => {
    editProduct.value = {
        id: null,
        productCategory: '',
        productName: '',
        productSpecifications: '',
        productInitialPrice: '',
        productDiscountPrice: '',
        brandName: '',
        productAverageRating: '',
        productWarranty: '',
        productDescription: '',
    }
}

</script>

<template>
    <AdminSidebar/>
    <section class="ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
    <AdminHeader/>
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="recent-sales bg-white p-4 rounded-md">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-lg md:text-xl py-4 capitalize">Products in stock</h2>
          <div class="table-container overflow-x-auto">
            <table class="w-[45rem] md:w-full border-2 my-4">
              <thead>
                <tr>
                  <th class="border-2 py-4 px-2">Category</th>
                  <th class="border-2 py-4 px-2">Name</th>
                  <th class="border-2 py-4 px-2">Image</th>
                  <th class="border-2 py-4 px-2">Price</th>
                  <th class="border-2 py-4 px-2">Discounted price</th>
                  <th class="border-2 py-4 px-2">Brand</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, index) in products" :key="index">
                  <td class="border-2 py-2 px-2 text-center">{{ product.productCategory }}</td>
                  <td class="border-2 py-2 px-2 text-center">{{ product.productName }}</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img :src="product.productFirstImage" :alt="product.productName" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">${{ product.productInitialPrice }}</td>
                  <td class="border-2 py-2 px-2 text-center">${{ product.productDiscountPrice }}</td>
                  <td class="border-2 py-2 px-2 text-center">{{ product.brandName }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="table-container overflow-x-auto">
            <table class="w-[45rem] lg:w-[90%] border-2 mt-8">
              <thead>
                <tr>
                  <th class="border-2 py-4">Product Description</th>
                  <th class="border-2 py-4">Manage</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, index) in products" :key="index">
                  <td class="border-2 py-2 px-2" v-html="product.productDescription"></td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button @click="openModal(product)" type="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                      <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <ProductModal :product="editProduct"/>
        </main>
    </section>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-50">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black/25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="w-full ml-48 transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <div>

                <ProductModal :product="editProduct"/>

              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
    <div class="edit-product bg-white p-4 rounded-md my-4 absolute z-10 top-10 left-24 sm:left-32 lg:left-40 w-3/4 md:w-4/5">
      <div class="close flex justify-end px-3"><i class="fa-solid fa-times text-2xl p-2 cursor-pointer"></i></div>
      <h2 class="text-[rgb(4,46,255)] text-base md:text-xl font-semibold py-4 capitalize">Edit this product</h2>
    </div>
</template>
