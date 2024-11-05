<script setup>
import { PencilSquareIcon, TrashIcon, CloudArrowUpIcon, XMarkIcon } from '@heroicons/vue/24/solid'
import {isImage} from '@/helpers.js'
import { useForm } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const props = defineProps({
    product: {
        type: Object,
        required: true
    }
})

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

const attachmentFiles = ref([])
const formErrors = ref([])
const flashMessage = ref('')

watch(() => props.product, () => {
    form.productCategory = props.product.productCategory || '',
    form.productName = props.product.productName || '',
    form.productSpecifications = props.product.productSpecifications || '',
    form.productInitialPrice = props.product.productInitialPrice || '',
    form.productDiscountPrice = props.product.productDiscountPrice || '',
    form.brandName = props.product.brandName || '',
    form.productAverageRating = props.product.productAverageRating || '',
    form.productWarranty = props.product.productWarranty || '',
    form.productDescription = props.product.productDescription || ''
}, { immediate: true})

const computedAttachments = computed(() => {
    return [...attachmentFiles.value, ...(props.product.attachments || [])]
})


const editor = ClassicEditor

const editorConfig = {
    toolbar: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote']
}

const submit = () => {

    form.attachments = attachmentFiles.value.map(myFile => myFile.file)

    if(props.product.id){
        form._method = 'PUT'
        form.post(route('admin.product.update'), {
        onError: (errors) => {
            formErrors.value.push(errors)
            console.log(formErrors.value[0].productName)
        },
        preserveScroll: true
        })
    } else {
        form.post(route('admin.product.store'), {
        onError: (errors) => {
            formErrors.value.push(errors)
            console.log(formErrors.value[0].productName)
        },
        preserveScroll: true
        })
    }
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
              setTimeout(() => {
              flashMessage.value = ''
              }, 4000)
              flashMessage.value = 'You must select exactly 4 images'
            attachmentFiles.value = []
            event.target.value = null
            return
        } else{
            flashMessage.value = ''
        }
    }
    if(attachmentFiles.value.length < 4){
        setTimeout(() => {
        flashMessage.value = ''
        }, 4000)
        flashMessage.value = 'You must select exactly 4 images'
        attachmentFiles.value = []
        event.target.value = null
        return
    } else {
        flashMessage.value = ''
    }
    console.log(attachmentFiles.value)
    console.log(computedAttachments.value)
    event.target.value = null
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
        <div class="product bg-white p-2 rounded-md my-4">
          <h2 class="text-[rgb(4,46,255)] font-semibold text-base md:text-xl py-2 capitalize">add new product</h2>
          <div class="new-product-form">
            <div class="flash-message transition-all duration-300 flex justify-between text-white bg-red-500 border-red-700 border rounded-md fixed top-20 w-[600px] p-4 z-10"
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
                {{  }}
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
                    computedAttachments && computedAttachments.length === 4 ? 'border-0' : 'border-dashed'
                ]"
                >
                  <div v-if="computedAttachments && computedAttachments.length === 4" class="grid grid-cols-4 gap-[38px] relative p-4">
                    <button class="absolute cursor-pointer right-0 -top-3 capitalize text-xs px-4 py-2 bg-[#042EFF] rounded-md text-white">
                        <input type="file" multiple @change="onImageChoose" @click.stop class="absolute  opacity-0 left-0 top-0 right-0 bottom-0">
                        Replace images
                    </button>
                    <div v-for="(myfile, index) in computedAttachments" :key="index" class="border-2 border-[#042EFF] h-40 w-56">
                        <div  class="h-full w-full">
                            <img :src="myfile.src ?? myfile" alt="" class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>
                    <div v-if="computedAttachments.length === 0 || computedAttachments.length > 4" class="pt-4 relative flex items-center flex-col">
                        <span class="text-4xl text-[#042EFF]">
                            <input type="file" multiple @change="onImageChoose" @click.stop class="absolute opacity-0 left-0 top-0 right-0 bottom-0">
                            <CloudArrowUpIcon class="size-8"/>
                        </span>
                        <div class="initial-info">
                          <span  class="block py-2 text-center">Browse image(You must attach 4 images of the product):</span>
                        </div>
                    </div>
                </div>
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
          <pre>{{ form.productCategory }}</pre>
              <div class="form-row">
                <div class="input-box">
                  <label for="product-description" class="block py-3">Type the product description(End the first sentence with pipe(|) then period(.)):</label>
                  <ckeditor :editor="editor" v-model="form.productDescription" :config="editorConfig"   :class="[
                    formErrors[0]?.productWarranty ? 'border-red-500' : ''
                  ]" ></ckeditor>
                  <p v-if="formErrors[0]?.productDescription" class="text-red-500">{{ formErrors[0]?.productDescription }}</p>
                </div>
              </div>
              <button type="submit" class="capitalize px-4 py-2 bg-[#042EFF] rounded-md text-white my-4">add product</button>
            </form>
          </div>
        </div>
</template>
<style scoped>

</style>
