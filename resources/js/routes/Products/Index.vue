<template>
    <div>
      <h1 class="text-xl">Here are our products!</h1>
  
      <section class="text-gray-700 body-font">
        <div class="container px-5 py-10">
          <div class="flex flex-wrap -m-4" v-if="!products.length">
            <div class="lg:w-1/4 md:w-1/2 p-4 w-full mb-4">
              <a class="block relative h-48 rounded overflow-hidden">
                <img
                  alt="ecommerce image"
                  class="object-cover object-center w-full h-full block"
                  src="https://dummyimage.com/420x260"
                  
                />
              </a>
  
              <div class="mt-4">
                <h3
                  class="text-gray-500 text-xs tracking-widest title-font mb-1 uppercase inline-block mr-2"
                >
                  N/A
                </h3>
  
                <h2 class="text-gray-900 title-font text-lg font-medium">
                  Loading...
                </h2>
  
                <p class="mt-1">$0.00</p>
              </div>
            </div>
          </div>
  
          <div class="flex flex-wrap -m-4" v-else>
            <div
              class="lg:w-1/4 md:w-1/2 p-4 w-full mb-4"
              v-for="product in products"
              :key="product.id"
            >
              <router-link
                class="block relative h-48 rounded overflow-hidden"
                :to="{ name: 'products.show', params: { slug: product.slug } }"
              >
                <img
                  alt="ecommerce image"
                  class="object-cover object-center w-full h-full block"
                  :src="product.image"
                />
              </router-link>
  
              <div class="mt-4">
                <h3
                  class="text-gray-500 text-xs tracking-widest title-font mb-1 uppercase inline-block mr-2"
                  v-for="category in product.categories"
                  :key="category.id"
                  v-text="category.name"
                ></h3>
  
                <h2
                  class="text-gray-900 title-font text-lg font-medium"
                  v-text="product.name"
                ></h2>
  
                <p class="mt-1" v-text="formatCurrency(product.price)"></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </template>
  
  <script>
  export default {
    computed: {
      products() {
        return this.$store.state.products;
      },
    },
    methods: {
      addToCart(product) {
        this.$store.commit('addToCart', product);
      },

      formatCurrency(price) {
        return new Intl.NumberFormat('en-US', {
          style: 'currency',
         currency: 'USD',
       }).format(price / 100); // za da se dobie bez .00 
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  