<script setup>
import AdminSidebar from '@/Components/app/AdminSidebar.vue'
import AdminHeader from '@/Components/app/AdminHeader.vue'
import { ref } from 'vue'
import { PencilSquareIcon, TrashIcon, CloudArrowUpIcon, XMarkIcon } from '@heroicons/vue/24/solid'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {isImage} from '@/helpers.js'
import { useForm} from '@inertiajs/vue3'

const props = defineProps({
  product: {
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
const formErrors = ref([])
const flashMessage = ref('')

const form = useForm({
    productCategory: '',
    productName: '',
    productSpecifications: '',
    productInitialPrice: '',
    productDiscountPrice: '',
    brandName: '',
    productAverageRating: '',
    productWarranty: '',
    productDescription: '',
    attachments: [],
    _method: 'POST'
})

function closeModal() {
  isOpen.value = false
}
function openModal() {
  isOpen.value = true
}
const attachmentFiles = ref([])
const attachmentErrors = ref([])

const editor = ClassicEditor

const editorConfig = {
    toolbar: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote']
}

const submit = () => {

form.attachments = attachmentFiles.value.map(myFile => myFile.file)

form.post(route('admin.product.store'), {
  onError: (errors) => {
    formErrors.value.push(errors)
    console.log(formErrors.value[0].productName)
  },
  preserveScroll: true
})

}

async function onImageChoose(event){
    attachmentFiles.value = []
    for(const file of event.target.files){

        const myFile = {
            file,
            src: await readFile(file)
        }
        attachmentFiles.value.push(myFile)
        if(attachmentFiles.value.length > 4){
            attachmentErrors.value.push('You must select exactly 4 images')
              setTimeout(() => {
              flashMessage.value = ''
              }, 4000)
              flashMessage.value = 'You must select exactly 4 images'
            attachmentFiles.value = []
            event.target.files = null
            return
        } else{
            attachmentErrors.value = []
            flashMessage.value = ''
            event.target.files = null
        }
    }
    if(attachmentFiles.value.length < 4){
        attachmentErrors.value.push('You must select exactly 4 images')
        setTimeout(() => {
        flashMessage.value = ''
        }, 4000)
        flashMessage.value = 'You must select exactly 4 images'
        attachmentFiles.value = []
        event.target.files = null
        return
    } else {
        attachmentErrors.value = []
        flashMessage.value = ''
        event.target.files = null
    }
    event.target.files = null
  }


 async function readFile(file){
    return new Promise((res,rej) => {
        if(isImage({mime: file.type})){
            const reader = new FileReader()
            reader.onload = () => {
                res(reader.result)
            }
            reader.onerror = rej
            reader.readAsDataURL(file)
        } else {
            res(null)
        }
    })
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
                <tr>
                  <td class="border-2 py-2 px-2 text-center">Laptop</td>
                  <td class="border-2 py-2 px-2 text-center">Dell latitude 5320</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img src="/images/dell latitude 5320.png" alt="A dell laptop" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">$1500</td>
                  <td class="border-2 py-2 px-2 text-center">$1000</td>
                  <td class="border-2 py-2 px-2 text-center">Dell</td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2 text-center">Laptop</td>
                  <td class="border-2 py-2 px-2 text-center">HP laptop 15 ci7</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img src="/images/hp laptop 15 ci7.png" alt="An HP  laptop" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">$800</td>
                  <td class="border-2 py-2 px-2 text-center">$600</td>
                  <td class="border-2 py-2 px-2 text-center">HP</td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2 text-center">Phone</td>
                  <td class="border-2 py-2 px-2 text-center">Iphone 14</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img src="/images/iphone14.png" alt="An iphone14" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">$1100</td>
                  <td class="border-2 py-2 px-2 text-center">$1102</td>
                  <td class="border-2 py-2 px-2 text-center">Apple</td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2 text-center">Phone</td>
                  <td class="border-2 py-2 px-2 text-center">Iphone 12</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img src="/images/iphone12.png" alt="An Iphone12" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">$1000</td>
                  <td class="border-2 py-2 px-2 text-center">$900</td>
                  <td class="border-2 py-2 px-2 text-center">Apple</td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2 text-center">Laptop</td>
                  <td class="border-2 py-2 px-2 text-center">HP laptop 15 ci7</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img src="/images/hp laptop 15 ci7.png" alt="An HP  laptop" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">$800</td>
                  <td class="border-2 py-2 px-2 text-center">$600</td>
                  <td class="border-2 py-2 px-2 text-center">HP</td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2 text-center">Phone</td>
                  <td class="border-2 py-2 px-2 text-center">Iphone 14</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img src="/images/iphone14.png" alt="An iphone14" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">$1100</td>
                  <td class="border-2 py-2 px-2 text-center">$1102</td>
                  <td class="border-2 py-2 px-2 text-center">Apple</td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2 text-center">Phone</td>
                  <td class="border-2 py-2 px-2 text-center">Iphone 12</td>
                  <td class="border-2 py-2 px-2 text-center md:px-4 md:translate-x-4 lg:translate-x-8"><img src="/images/iphone12.png" alt="An Iphone12" class="h-14 w-auto"></td>
                  <td class="border-2 py-2 px-2 text-center">$1000</td>
                  <td class="border-2 py-2 px-2 text-center">$900</td>
                  <td class="border-2 py-2 px-2 text-center">Apple</td>
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
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                      <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                        <button type="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                        <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                        <button type="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                        <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                        <button type="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                        <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                        <button type="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                        <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                        <button type="button" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                        <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                        <button type="button" @click="openModal" class="bg-[#FFCF10] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">edit <PencilSquareIcon class="size-6"/> </button>
                        <button type="button" class="bg-[#FF4004] inline-flex items-center gap-2 edit-button py-3 px-8 capitalize rounded-md">remove <TrashIcon class="size-6"/> </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
        <div class="new-product bg-white p-4 rounded-md my-4">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-base md:text-xl py-4 capitalize">add new product</h2>
          <div class="new-product-form">
            <div class="flash-message transition-all duration-300 flex justify-between text-white bg-red-500 border-red-700 border rounded-md fixed top-20 right-12 w-[600px] p-4 z-10"
            :class="[
              !flashMessage ? '-right-[100%]' : 'right-20'
            ]">{{flashMessage}}
              <XMarkIcon class="size-6 cursor-pointer"/>
            </div>
            <form @submit.prevent="submit">
              <div class="form-row w-full flex flex-col md:flex-row justify-between">
                <div class="input-box md:basis-[48%]">
                  <label for="category" class="block py-3">Select Category:</label>
                  <select v-model="form.productCategory" id="category" class="border-2 outline-none rounded-md px-4 py-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.productCategory ? 'border-red-500' : ''
                  ]">
                    <option value="None">None</option>
                    <option value="Phone">Phone</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Smartwatch">Smartwatch</option>
                    <option value="Television">Television</option>
                  </select>
                  <p v-if="formErrors[0]?.productCategory" class="text-red-500">{{ formErrors[0]?.productCategory }}</p>
                </div>
                <div class="input-box md:basis-[48%]">
                  <label for="productName" class="block py-3">Enter Product name:</label>
                  <input type="text" v-model="form.productName" id="productName" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.productName ? 'border-red-500' : ''
                  ]">
                  <p v-if="formErrors[0]?.productName" class="text-red-500">{{ formErrors[0]?.productName }}</p>
                </div>
              </div>
              <div class="form-row w-full flex flex-col md:flex-row justify-between">
                <div class="input-box md:basis-[48%]">
                  <label for="specs" class="block py-3">Enter product specifications (CSV):</label>
                  <input type="text" v-model="form.productSpecifications" id="specs" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.productSpecifications ? 'border-red-500' : ''
                  ]">
                  <p v-if="formErrors[0]?.productSpecifications" class="text-red-500">{{ formErrors[0]?.productSpecifications }}</p>
                </div>
                <div class="input-box md:basis-[48%]">
                  <label for="initialPrice" class="block py-3">Enter the initial price:</label>
                  <input type="number" v-model="form.productInitialPrice" id="initialPrice" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.productInitialPrice ? 'border-red-500' : ''
                  ]">
                  <p v-if="formErrors[0]?.productInitialPrice" class="text-red-500">{{ formErrors[0]?.productInitialPrice }}</p>
                </div>
              </div>
              <div class="my-4">
                <div class="border-dashed border-2 border-[#042EFF]"
                :class="[
                    attachmentFiles && attachmentFiles.length === 4 ? 'border-0' : 'border-dashed',
                    attachmentErrors.length ? 'border-red-600' : 'border-[#042EFF]'
                ]"
                >
                  <div v-if="attachmentFiles && attachmentFiles.length === 4" class="grid grid-cols-4 gap-[38px] relative p-4">
                    <button class="absolute cursor-pointer right-0 -top-3 capitalize text-xs px-4 py-2 bg-[#042EFF] rounded-md text-white">
                        <input type="file" multiple @change="onImageChoose" @click.stop class="absolute  opacity-0 left-0 top-0 right-0 bottom-0">
                        Replace images
                    </button>
                    <div v-for="(myfile, index) in attachmentFiles" :key="index" class="border-2 border-[#042EFF] h-40 w-56">
                        <div  class="h-full w-full">
                            <img :src="myfile.src" alt="" class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>
                    <div v-if="attachmentFiles.length === 0 || attachmentFiles.length > 4" class="pt-4 relative flex items-center flex-col">
                        <span class="text-4xl text-[#042EFF]">
                            <input type="file" multiple @change="onImageChoose" @click.stop class="absolute opacity-0 left-0 top-0 right-0 bottom-0">
                            <CloudArrowUpIcon class="size-8"/>
                        </span>
                        <div class="initial-info">
                          <span  class="block py-2 text-center">Browse image(You must attach 4 images of the product):</span>
                        </div>
                    </div>
                </div>
                <!-- <div v-if="attachmentErrors" class="mt-1 text-sm text-red-500">{{ attachmentErrors[0] }}</div> -->
                <p v-if="formErrors[0]?.attachments" class="text-red-500">{{ formErrors[0]?.attachments }}</p>
              </div>
              <div class="form-row w-full flex flex-col md:flex-row justify-between">
                <div class="input-box md:basis-[48%]">
                  <label for="discountPrice" class="block py-3">Enter the discounted price:</label>
                  <input type="number" v-model="form.productDiscountPrice" id="discountPrice" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.productDiscountPrice ? 'border-red-500' : ''
                  ]">
                  <p v-if="formErrors[0]?.productDiscountPrice" class="text-red-500">{{ formErrors[0]?.productDiscountPrice }}</p>
                </div>
                <div class="input-box md:basis-[48%]">
                  <label for="brandName" class="block py-3">Enter the brand name:</label>
                  <input type="text" v-model="form.brandName" id="brandName" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.brandName ? 'border-red-500' : ''
                  ]">
                  <p v-if="formErrors[0]?.brandName" class="text-red-500">{{ formErrors[0]?.brandName }}</p>
                </div>
              </div>
              <div class="form-row w-full flex flex-col md:flex-row justify-between">
                <div class="input-box md:basis-[48%]">
                  <label for="discountPrice" class="block py-3">Enter product average rating:</label>
                  <input type="number" v-model="form.productAverageRating" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.productAverageRating ? 'border-red-500' : ''
                  ]">
                  <p v-if="formErrors[0]?.productAverageRating" class="text-red-500">{{ formErrors[0]?.productAverageRating }}</p>
                </div>
                <div class="input-box md:basis-[48%]">
                  <label for="brandName" class="block py-3">Enter the product warranty:</label>
                  <input type="text" v-model="form.productWarranty" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
                  :class="[
                    formErrors[0]?.productWarranty ? 'border-red-500' : ''
                  ]">
                  <p v-if="formErrors[0]?.productWarranty" class="text-red-500">{{ formErrors[0]?.productWarranty }}</p>
                </div>
              </div>
              <div class="form-row">
                <div class="input-box">
                  <label for="product-description" class="block py-3">Type the product description(End the first sentence with pipe(|) then period(.)):</label>
                  <ckeditor :editor="editor" v-model="form.productDescription" :config="editorConfig"   :class="[
                    formErrors[0]?.productWarranty ? 'border-red-500' : ''
                  ]" ></ckeditor>
                  <!--<textarea name="productDescription" id="product-description" cols="30" rows="10" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus></textarea>---->
                  <p v-if="formErrors[0]?.productDescription" class="text-red-500">{{ formErrors[0]?.productDescription }}</p>
                </div>
              </div>
              <button type="submit" class="capitalize px-4 py-2 bg-[#042EFF] rounded-md text-white my-4">add product</button>
            </form>
          </div>
        </div>
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
              <DialogTitle
                as="h3"
                class="text-[rgb(4,46,255)] text-base md:text-xl font-semibold py-4 capitalize"
              >
                Edit this product
              </DialogTitle>
              <div>
                <div class="edit-product-form">
        <form action="#">
          <div class="form-row w-full flex flex-col md:flex-row justify-between">
            <div class="input-box md:basis-[48%]">
              <label for="category" class="block py-3">Select Category:</label>
              <select name="category" id="category" class="border-2 outline-none rounded-md px-4 py-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
                <option value="None">None</option>
                <option value="Phone">Phone</option>
                <option value="Laptop">Laptop</option>
                <option value="Smartwatch">Smartwatch</option>
                <option value="Television">Television</option>
              </select>
            </div>
            <div class="input-box md:basis-[48%]">
              <label for="productName" class="block py-3">Enter Product name:</label>
              <input type="text" name="productName" id="productName" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
          </div>
          <div class="form-row w-full flex flex-col md:flex-row justify-between">
            <div class="input-box md:basis-[48%]">
              <label for="specs" class="block py-3">Enter product specifications (CSV):</label>
              <input type="text" name="specs" id="specs" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
            <div class="input-box md:basis-[48%]">
              <label for="initialPrice" class="block py-3">Enter the initial price:</label>
              <input type="number" name="initialPrice" id="initialPrice" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
          </div>
          <div class="form-row w-full flex flex-col md:flex-row gap-2 justify-between my-4">
            <div class="input-box1-edit md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
              <div class="original-info1-edit flex items-center justify-center flex-col">
                <div class="icon pt-4">
                  <label for="productImage2" class="text-4xl text-[#042EFF]">
                        <CloudArrowUpIcon class="size-8"/>
                  </label>
                </div>
                <div class="initial-info">
                  <label for="productImage1-edit" class="block py-2">Browse image:</label>
                </div>
              </div>
            </div>
              <input type="file" name="productImage1" id="productImage1-edit" class="file1-edit" hidden>
            <div class="input-box2-edit md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
              <div class="original-info2-edit flex items-center justify-center flex-col">
                <div class="icon pt-4">
                  <label for="productImage2" class="text-4xl text-[#042EFF]">
                        <CloudArrowUpIcon class="size-8"/>
                  </label>
                </div>
                <div class="initial-info">
                  <label for="productImage2-edit" class="block py-2">Browse image:</label>
                </div>
              </div>
            </div>
              <input type="file" name="productImage2" id="productImage2-edit" class="file2-edit" hidden>
            <div class="input-box3-edit md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
              <div class="original-info3-edit flex items-center justify-center flex-col">
                <div class="icon pt-4">
                  <label for="productImage2" class="text-4xl text-[#042EFF]">
                        <CloudArrowUpIcon class="size-8"/>
                  </label>
                </div>
                <div class="initial-info">
                  <label for="productImage3-edit" class="block py-2">Browse image:</label>
                </div>
              </div>
            </div>
              <input type="file" name="productImage3" id="productImage3-edit" class="file3-edit" hidden>
            <div class="input-box4-edit md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
              <div class="original-info4-edit flex items-center justify-center flex-col">
                <div class="icon pt-4">
                  <label for="productImage2" class="text-4xl text-[#042EFF]">
                        <CloudArrowUpIcon class="size-8"/>
                  </label>
                </div>
                <div class="initial-info">
                  <label for="productImage4-edit" class="block py-2">Browse image:</label>
                </div>
              </div>
            </div>
              <input type="file" name="productImage4" id="productImage4-edit" class="file4-edit" hidden>
          </div>
          <div class="form-row w-full flex flex-col md:flex-row justify-between">
            <div class="input-box md:basis-[48%]">
              <label for="discountPrice" class="block py-3">Enter the discounted price:</label>
              <input type="number" name="discountPrice" id="discountPrice" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
            <div class="input-box md:basis-[48%]">
              <label for="brandName" class="block py-3">Enter the brand name:</label>
              <input type="text" name="brandName" id="brandName" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
          </div>
          <div class="form-row">
            <div class="input-box">
              <label for="product-description-edit" class="block py-3">Type the product description:</label>
              <textarea name="productDescription" id="product-description-edit" cols="30" rows="10" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus></textarea>
            </div>
          </div>
          <button type="submit" class="capitalize px-4 py-2 bg-[#042EFF] rounded-md text-white my-4">edit product</button>
        </form>
      </div>
              </div>

              <div class="mt-4">
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="closeModal"
                >
                  Got it, thanks!
                </button>
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
