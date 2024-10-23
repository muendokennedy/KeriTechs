<script setup>
import {CloudArrowUpIcon} from '@heroicons/vue/24/solid'
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.post(route('admin.store'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    })
}


</script>

<template>
    <section class="min-h-screen">
      <main class="bg-[#E4E7F3] pt-20 px-[3%] pb-4">
        <div class="sigup-box bg-white p-4 px-8 rounded-md w-[30rem] mx-auto">
          <form @submit.prevent="submit">
            <h2 class="text-center text-xl text-[#042EFF] font-semibold capitalize py-4 border-b-2">signup as an admin</h2>
            <div class="input-box">
              <label for="name" class="capitalize block py-3">Enter name:</label>
              <input type="text" v-model="form.name" id="name" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
            <div class="input-box mb-4">
              <label for="email" class="capitalize block py-3">Enter email:</label>
              <input type="text" v-model="form.email" id="email" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
            <div class="input-admin md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
              <div class="original-info-admin flex items-center justify-center flex-col relative">
                <span class="text-4xl text-[#042EFF]">
                        <input type="file" @change="onImageChoose" @click.stop class="absolute opacity-0 left-0 top-0 right-0 bottom-0">
                        <CloudArrowUpIcon class="size-8"/>
                </span>
                <div class="initial-info">
                  <span for="adminProfile" class="block py-2">Browse image:</span>
                </div>
              </div>
            </div>
            <div class="input-box">
              <label for="password" class="capitalize block py-3">Enter password</label>
              <input type="password" v-model="form.password" id="password" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
            <div class="input-box">
              <label for="password_confirmation" class="capitalize block py-3">confirm your password:</label>
              <input type="password" v-model="form.password_confirmation"  id="password_confirmation" class="p-2 rounded-md border-2 outline-none w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus>
            </div>
            <button type="submit" class="text-white bg-[#042EFF] block w-full px-4 py-3 rounded-md my-6 capitalize hover:bg-[#384857] transition-all duration-300 ease-in-out">signup</button>
            <p class="capitalize"><span>already have an account? </span> <Link :href="route('admin.login')" class="text-[#042eff] hover:underline transition-all duration-300 ease-in-out">login here</Link></p>
          </form>
        </div>
      </main>
    </section>
</template>
