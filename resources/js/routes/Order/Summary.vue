<template>
   <div class="w-full">
    <div class="lg:w-2/3 w-full mx-auto mt-8 overflow-auto">

        <h2 
            class="text-sm title-font text-gray-500 tracking-widest"
            v-text="'Transaction ID: ' + order.transaction_id"
            >
          
        </h2>
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">Item</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Price</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in cart" :key="item.id">
            <td class="p-4" v-text="item.name"></td>
            <td class="p-4" v-text="item.quantity"></td>
            <td class="p-4" v-text="cartLineTotal(item)"></td>
            <td class="w-10 text-right">
              <button
                class="flex ml-auto text-sm text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600"
                @click="$store.commit('removeFromCart', index)">
                Remove
              </button>
            </td>
          </tr>
          <tr>
            <td class="p-4 font-bold">Total Amount</td>
            <td class="p-4 font-bold" v-text="cartQuantity"></td>
            <td class="p-4 font-bold" v-text="cartTotal"></td>
            <td class="w-10 text-right"></td>
          </tr>
        </tbody>
      </table>
      </div>
   </div>
  </template>
  
  <script>
  export default {
    name: 'Summary',
    methods: {
        orderLineTotal(item) {
          let price = (item.price * item.pivot.quantity);
          price = (price/100);

          return price.toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
      });

        }
    },  
    
  computed: {
    order() {
      return this.$store.state.order;
    },
    orderQuantity() {
      return this.order.products.reduce((acc, item) => acc + item.pivot.quantity, 0);
    },
    orderTotal() {
      let price = this.order.products.reduce((acc, item) => acc + (item.price * item.pivot.quantity), 0);
      price = price / 100;
      return price.toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
      });
    },
  }
  }
  </script>
  
  <style scoped>
  /* Your styles here */
  </style>
  