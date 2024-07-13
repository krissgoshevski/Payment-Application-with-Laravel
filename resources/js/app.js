import { createApp } from 'vue';
import { createStore } from 'vuex';
import { createRouter, createWebHistory } from 'vue-router';
import axios from 'axios';
import routes from './routes.js';

// Create the Vuex store
const store = createStore({
    state: {
        products: [],
        cart: [],
        order: {}
    },
    mutations: {
        updateProducts(state, products) {
            state.products = products;
        },
        addToCart(state, product) {
            let productInCartIndex = state.cart.findIndex(item => item.slug == product.slug);
            if (productInCartIndex != -1) {
                state.cart[productInCartIndex].quantity++;
                return;
            }
            product.quantity = 1;
            state.cart.push(product);
        },
        removeFromCart(state, index) {
            state.cart.splice(index, 1);
        },
        updateOrder(state, order) {
            state.order = order;
        },
        updateCart(state, cart) {
            state.cart = cart;
        }
    },
    actions: {
        getProducts({ commit }) {
            axios.get('/products')
                .then((response) => {
                    commit('updateProducts', response.data);
                })
                .catch((error) => console.error(error));
        },
        clearCart({ commit }) {
            commit('updateCart', []);
        }
    }
});

// Create the router
const router = createRouter({
    history: createWebHistory(),
    routes
});

// Create the Vue app
const app = createApp({
    created() {
        this.$store.dispatch('getProducts')
            .then(() => {})
            .catch((error) => console.error(error));
    }
});

app.use(store);
app.use(router);
app.mount('#app');
