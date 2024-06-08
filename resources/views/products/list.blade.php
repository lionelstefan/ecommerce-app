<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 flex" style="align-items:self-end">
            @foreach ($products as $pr)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex-1 mr-2" style="width:50%">

                <x-input-label :value="__('Product Name')" />
                <div class="text-gray-100 mb-4">
                    {{ $pr['name'] }}
                </div>

                <x-input-label :value="__('Product Description')" />
                <div class="text-gray-100 mb-4">
                    {{ $pr['desc'] }}
                </div>

                <x-input-label :value="__('Price')" />
                <div class="text-gray-100 mb-4">
                    {{ $pr['price'] }}
                </div>

                @php
                $json = json_encode($pr);
                @endphp

                <div>
                    <span class="text-gray-100 p-4 text-xl float-right" style="cursor:pointer" onclick="addToCart({{$json}})">
                        <i class="fa-solid fa-cart-plus"></i>
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
        function addToCart(product) {
                axios.post('/api/carts/add', {
                        product: product,
                    })
                    .then(function(response) {
                        if (response.data.success) {
                            toastr.success('Success add to cart!', 'Cart')
                        }

                        if (!response.data.success) {
                            toastr.error(response.data.message, 'Cart')
                        }

                        updateCartCounter();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
    </script>

</x-app-layout>