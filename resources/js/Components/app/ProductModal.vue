<script setup>
import { PencilSquareIcon, TrashIcon, CloudArrowUpIcon, XMarkIcon, CheckCircleIcon } from '@heroicons/vue/24/solid'
import {isImage} from '@/helpers.js'
import { useForm } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const props = defineProps({
    product: {
        type: Object,
        required: true
    },
    success: {
        type: String
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
const showSuccessNotification = ref(false)


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

const filteredAttachments = computed(() => {
    return computedAttachments.value.filter(
        attachment => typeof attachment === 'object' && attachment !== null && 'file' in attachment
    )
})

const displayAttachments = computed(() => {
    return filteredAttachments.value.length > 0 ? filteredAttachments.value : computedAttachments.value
})

const emit = defineEmits('hide')


const editor = ClassicEditor

const editorConfig = {
    toolbar: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote']
}

const submit = () => {

    form.attachments = attachmentFiles.value.map(myFile => myFile.file)

    if(props.product.id){
        form._method = 'PUT'
        form.post(route('admin.product.update', props.product), {
        onError: (errors) => {
            formErrors.value.push(errors)
        },
        onSuccess: (response) => {
            emit('hide', response)
            resetForm()
        },
        preserveScroll: true
        })
    } else {
        form.post(route('admin.product.store'), {
        onError: (errors) => {
            formErrors.value.push(errors)
        },
        onSuccess: () => {
            resetForm()
            setTimeout(() => {
                showSuccessNotification.value = false
            }, 8000)
            showSuccessNotification.value = true
        },
        preserveScroll: true
        })
    }
}

const resetForm = () => {
    form.reset()
    attachmentFiles.value = []
}

async function onImageChoose(event){
    attachmentFiles.value = []
    for(const file of event.target.files){

      let myFile = null

    try{
      const fileData = await readFile(file)
      myFile = {
            file,
            src: fileData
        }
    }catch(error){
      setTimeout(() => {
        flashMessage.value = ''
        }, 8000)
        flashMessage.value = error.message
        attachmentFiles.value = []
        event.target.value = null
        return
    }
        attachmentFiles.value.push(myFile)
        if(attachmentFiles.value.length > 4){
              setTimeout(() => {
              flashMessage.value = ''
              }, 8000)
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
        }, 8000)
        flashMessage.value = 'You must select exactly 4 images'
        attachmentFiles.value = []
        event.target.value = null
        return
    } else {
        flashMessage.value = ''
    }
    console.log(attachmentFiles.value)
    event.target.value = null
  }


 async function readFile(file){
    return new Promise((resolve,reject) => {
            if(!isImage(file)){
                reject(new Error('You must select an image (jpeg, jpg, png, webp)'))
                return;
            }
            const reader = new FileReader()
            reader.onload = () => {
                resolve(reader.result)
            }
            reader.onerror = () => {
                reject(new Error('Error reading this file'))
            }
            reader.readAsDataURL(file)
    })
}
</script>
<template>
        <div class="product bg-white p-2 rounded-md my-4"
        :class="[
            product.id ? 'p-2' : 'p-4'
        ]">
            <div v-if="product.id">
                <XMarkIcon @click="$emit('hide')" class="size-6 cursor-pointer justify-self-end"/>
            </div>
          <h2 class="text-[rgb(4,46,255)] font-semibold text-base md:text-xl py-2 capitalize">{{ product.id ? 'Update product' : 'Add new product' }}</h2>
          <div class="new-product-form">
            <div class="flash-message transition-all duration-300 flex justify-between text-white bg-red-500 border-red-700 border rounded-md fixed top-20 w-[600px] p-4 z-10"
            :class="[
              !flashMessage ? '-right-[100%]' : 'right-20'
            ]">{{flashMessage}}
              <XMarkIcon @click="flashMessage = ''" class="size-6 cursor-pointer"/>
            </div>
            <Transition name="slide-fade">
                <div v-show="showSuccessNotification && success" class="flash-message transition-all duration-300 flex gap-2 text-white bg-green-500 border-green-700 border rounded-md fixed right-20 top-20 w-[600px] p-4 z-10">
                  <CheckCircleIcon class="size-6 cursor-pointer"/>
                  <span>{{ success }}</span>
                  <XMarkIcon @click="showSuccessNotification = false" class="size-6 cursor-pointer absolute right-2"/>
                </div>
            </Transition>
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
                    computedAttachments && (computedAttachments.length === 4 || filteredAttachments.length === 4) ? 'border-0' : 'border-dashed'
                ]"
                >
                  <div v-if="computedAttachments && (computedAttachments.length === 4 || filteredAttachments.length === 4)" class="grid grid-cols-4 gap-[38px] relative p-4">
                    <button class="absolute cursor-pointer right-0 -top-3 capitalize text-xs px-4 py-2 bg-[#042EFF] rounded-md text-white">
                        <input type="file" multiple @change="onImageChoose" @click.stop class="absolute  opacity-0 left-0 top-0 right-0 bottom-0">
                        Replace images
                    </button>
                    <div v-for="(myfile, index) in displayAttachments" :key="index" class="border-2 border-[#042EFF] h-40 w-56">
                        <div  class="h-full w-full">
                            <img v-if="myfile" :src="myfile.src ?? myfile" alt="" class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>
                    <div v-if="computedAttachments.length === 0" class="pt-4 relative flex items-center flex-col">
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
                  <input type="text" v-model="form.productAverageRating" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus
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
.slide-fade-enter-active,
.slide-fade-leave-active{
    transition: transform .3s ease, opacity .3s ease;
}
.slide-fade-enter-from{
    transform: translateX(100%);
    opacity: 0;
}
.slide-fade-enter-to{
    transform: translateX(0);
    opacity: 1;
}
.slide-fade-leave-from{
    transform: translateX(0);
    opacity: 1;
}
.slide-fade-leave-to{
    transform: translateX(100%);
    opacity: 1;
}
</style>
