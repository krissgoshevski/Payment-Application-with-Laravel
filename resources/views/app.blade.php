<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Vue Stripe Cashier</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="antialiased">
    <div class="container mx-auto">
        <div id="app">
            <header class="text-gray-700 body-font">
                <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                    <a class="flex title-font font-medium items-center text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5-10-5zM2 12l10 5 10-5-10-5-10 5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </svg>
                        <span class="ml-3 text-xl">Shopping Cart</span>
                    </a>

                    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                        <router-link
                            class="mr-5 hover:text-gray-900"
                            :to="{name: 'products.index'}"
                        > Products 
                        </router-link>
                    </nav>
                    <router-link
                        class="inline-flex items-center border-gray-200 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0"
                        :to="{name: 'order.checkout'}"
                    > Checkout
                        <span 
                            class="inline-block ml-1"
                            v-text="'(' + $store.state.cart.length + ')'"> 
                        </span>
                    </router-link>
                </div>
            </header>
            <router-view></router-view>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
