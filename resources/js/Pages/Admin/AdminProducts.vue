<script setup>

</script>

<template>
        <input type="checkbox" id="menu-bar" class="hidden">
    <div class="side-bar fixed left-0 min-h-screen w-[15rem] bg-[#042EFF] py-4 flex flex-col justify-between">
      <div class="sidebar-primary-box">
        <h2 class="side-bar-title text-white font-bold text-2xl text-center capitalize my-4">moTech</h2>
        <ul class="my-8 text-white px-4 space-y-2 capitalize">
          <li><a href="index.html"><i class="fa-solid fa-house px-4 py-2 text-xl"></i><span>dashboard</span></a></li>
          <li><a href="analytics.html"><i class="fa-solid fa-chart-simple px-4 py-2 text-xl"></i><span>analytics</span></a></li>
          <li><a href="products.html"><i class="fa-solid fa-box px-4 py-2 text-xl"></i><span>products</span></a></li>
          <li><a href="orders.html"><i class="fa-solid fa-list px-4 py-2 text-xl"></i><span>orders</span></a></li>
          <li><a href="stock.html"><i class="fa-solid fa-database px-4 py-2 text-xl"></i><span>stock</span></a></li>
          <li><a href="clientinfo.html"><i class="fa-solid fa-user px-4 py-2 text-xl"></i><span>client info</span></a></li>
          <li><a href="settings.html"><i class="fa-solid fa-gear px-4 py-2 text-xl"></i><span>settings</span></a></li>
        </ul>
      </div>
      <div class="side-bar-bottom my-4 text-white px-4 space-y-2 capitalize">
        <ul>
          <li><a href="logout.html"><i class="fa-solid fa-right-from-bracket px-4 py-2 text-xl"></i><span>log out</span></a></li>
        </ul>
      </div>
    </div>
    <section class="ml-[15rem] w-[calc(100% - 15rem)] main-content min-h-screen">
      <header class="w-[calc(100% - 15rem)] main-header flex justify-between gap-2 px-2 py-2 items-center pr-4 fixed top-0 left-[15rem] right-0 z-20 bg-white">
        <div class="flex items-center">
          <label for="menu-bar" class="cursor-pointer menu-bar"><i class="fa-solid fa-bars text-2xl font-bold p-2"></i></label>
          <h2 class="capitalize text-lg sm:text-xl font-semibold text-[#042EFF]">dashboard</h2>
        </div>
        <div class="header-search  w-1/3 lg:w-1/2 hidden lg:flex items-center relative">
          <input type="search" name="search-term" id="search-term" placeholder="search here..." class="border-2 rounded-md px-4 py-3 w-full outline-none pr-[70px] focus:border-[#042EFF] transition-all duration-300 ease-in-out">
          <label for="search-term" class="rounded-r-md absolute right-2 inline-block px-4 py-1 text-white bg-[#042EFF] cursor-pointer"><i class="fa-solid fa-search text-xl font-bold"></i></label>
        </div>
        <div class="profile-section sm:ml-auto lg:ml-0 border-2 flex items-center rounded-md w-36 sm:w-64 justify-between">
          <div class="profile-pic h-[48px] w-[70px] p-1">
            <img src="/images/man4.jpeg" alt="profile image" class="w-full h-full object-cover rounded-l-md">
          </div>
          <span class="sm:pr-2 text-xs sm:text-base">Kennedy Munyao</span>
        </div>
      </header>
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
                      <button type="button" class="bg-[#FFCF10] edit-button py-3 px-8 capitalize rounded-md">edit <i class="fa-solid fa-edit pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-trash pl-2"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] edit-button py-3 px-8 capitalize rounded-md">edit <i class="fa-solid fa-edit pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-trash pl-2"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] edit-button py-3 px-8 capitalize rounded-md">edit <i class="fa-solid fa-edit pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-trash pl-2"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] edit-button py-3 px-8 capitalize rounded-md">edit <i class="fa-solid fa-edit pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-trash pl-2"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] edit-button py-3 px-8 capitalize rounded-md">edit <i class="fa-solid fa-edit pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-trash pl-2"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] edit-button py-3 px-8 capitalize rounded-md">edit <i class="fa-solid fa-edit pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-trash pl-2"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="border-2 py-2 px-2">Reiciendis et vel illo quod delectus non sequi est. Ut magni consectetur. Facilis est omnis accusantium neque omnis. Quo qui omnis culpa omnis.</td>
                  <td class="border-2 py-2 px-6 w-1/2">
                    <div class="flex w-full justify-between">
                      <button type="button" class="bg-[#FFCF10] edit-button py-3 px-8 capitalize rounded-md">edit <i class="fa-solid fa-edit pl-2"></i></button>
                      <button type="button" class="bg-[#FF4004] py-3 px-8 capitalize rounded-md">remove <i class="fa-solid fa-trash pl-2"></i></button>
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
                <div class="input-box1 md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
                  <div class="original-info1 flex items-center justify-center flex-col">
                    <div class="icon pt-4">
                      <label for="productImage1" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
                    </div>
                    <div class="initial-info">
                      <label for="productImage1" class="block py-2">Browse image:</label>
                    </div>
                  </div>
                </div>
                  <input type="file" name="productImage1" id="productImage1" class="file1" hidden>
                <div class="input-box2 md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
                  <div class="original-info2 flex items-center justify-center flex-col">
                    <div class="icon pt-4">
                      <label for="productImage2" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
                    </div>
                    <div class="initial-info">
                      <label for="productImage2" class="block py-2">Browse image:</label>
                    </div>
                  </div>
                </div>
                  <input type="file" name="productImage2" id="productImage2" class="file2" hidden>
                <div class="input-box3 md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
                  <div class="original-info3 flex items-center justify-center flex-col">
                    <div class="icon pt-4">
                      <label for="productImage3" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
                    </div>
                    <div class="initial-info">
                      <label for="productImage3" class="block py-2">Browse image:</label>
                    </div>
                  </div>
                </div>
                  <input type="file" name="productImage3" id="productImage3" class="file3" hidden>
                <div class="input-box4 md:basis-[23%]  file-box flex items-center justify-center flex-col  border-dashed border-2 border-[#042EFF]">
                  <div class="original-info4 flex items-center justify-center flex-col">
                    <div class="icon pt-4">
                      <label for="productImage4" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
                    </div>
                    <div class="initial-info">
                      <label for="productImage4" class="block py-2">Browse image:</label>
                    </div>
                  </div>
                </div>
                  <input type="file" name="productImage4" id="productImage4" class="file4" hidden>
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
                  <label for="product-description" class="block py-3">Type the product description:</label>
                  <textarea name="productDescription" id="product-description" cols="30" rows="10" class="px-2 py-2 rounded-md outline-none border-2 w-full focus:border-[#042EFF] transition-all duration-300 ease-in-out" autofocus></textarea>
                </div>
              </div>
              <button type="submit" class="capitalize px-4 py-2 bg-[#042EFF] rounded-md text-white my-4">add product</button>
            </form>
          </div>
        </div>
      </main>
    </section>
    <div class="edit-product bg-white p-4 rounded-md my-4 absolute z-10 top-10 left-24 sm:left-32 lg:left-40 w-3/4 md:w-4/5">
      <div class="close flex justify-end px-3"><i class="fa-solid fa-times text-2xl p-2 cursor-pointer"></i></div>
      <h2 class="text-[rgb(4,46,255)] text-base md:text-xl font-semibold py-4 capitalize">Edit this product</h2>
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
                  <label for="productImage1-edit" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
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
                  <label for="productImage2-edit" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
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
                  <label for="productImage3-edit" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
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
                  <label for="productImage4-edit" class="fa-solid fa-cloud-upload-alt text-4xl text-[#042EFF]"></label>
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
</template>
