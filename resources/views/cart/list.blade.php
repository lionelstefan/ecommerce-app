<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 flex" style="align-items:self-end">
            @foreach ($cart as $c)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex-1 mr-2" style="width:50%">

                <x-input-label :value="__('Product Name')" />
                <div class="text-gray-100 mb-4">
                    {{ $c['name'] }}
                </div>

                <x-input-label :value="__('Product Description')" />
                <div class="text-gray-100 mb-4">
                    {{ $c['desc'] }}
                </div>

                <x-input-label :value="__('Price')" />
                <div class="text-gray-100 mb-4">
                    {{ $c['price'] }}
                </div>

                <div>
                    <span class="text-gray-100 p-4 text-xl float-right" style="cursor:pointer" onclick="removeFromCart({{$c['id']}})">
                        <i class="fa-solid fa-trash"></i>
                    </span>
                </div>
            </div>
            @endforeach

        </div>
        @if (count($cart) > 0)
        <div class="max-w-7xl mt-4 mx-auto sm:px-6 lg:px-8 space-y-6" style="align-items:self-end">
            <form method="post" action="{{ route('orders.make') }}" class="mt-6 space-y-6">
                @csrf
                <div class="flex items-center gap-4 float-right">
                    <x-primary-button>{{ __('Checkout') }}</x-primary-button>
                </div>
            </form>
        </div>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
        function removeFromCart(productId) {
            axios.post('/api/carts/remove', {
                    productId: productId,
                })
                .then(function(response) {
                    if (response.data.success) {
                        toastr.success('Success remove product!', 'Cart')
                    }

                    updateCartCounter();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>

</x-app-layout>