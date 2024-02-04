<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendedores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold">Editar dados do vendedor </h2>
                    <h3>Use o formulário abaixo para editar os dados do vendedor <b> {{ $seller["name"]  }} </b></h3>
                    <form method="post" action="{{ route('sellers.edit', $seller["id"]) }} " class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="name" :value="__('Nome do vendedor')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $seller['name'])" required autofocus autocomplete="name"
                                          placeholder="Digite aqui o nome do vendedor" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email do vendedor')" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $seller['email'])" required autofocus autocomplete="email" placeholder="Digite aqui o email do vendedor" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

                            @if (session('status') === 'success')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 dark:text-gray-400"
                                >{{ __(session('message')) }}</p>
                            @elseif(session('status') === 'error')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-red-600 dark:text-red-400"
                                >{{ __(session('message')) }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
