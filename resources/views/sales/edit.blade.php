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
                    <h2 class="text-xl font-semibold">Cadastre uma nova venda</h2>
                    <h3>Use o formulário abaixo para cadastrar uma nova venda</h3>
                    <form method="post" action="{{ route('sales.edit', $sale->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="value" :value="__('Valor da venda')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" :value="old('value', $sale['value'])" required autofocus autocomplete="value"
                                          placeholder="Digite aqui o valor do venda" />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div>
                            <x-input-label for="date" :value="__('Data da venda')" />
                            <x-text-input id="date" name="date" type="text" class="mt-1 block
                            w-full" :value="old('date', date('d/m/Y', strtotime($sale['date'])))" required autocomplete="date"
                                          placeholder="Digite aqui a data da venda" />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>

                        <div>
                            <x-input-label for="seller_id" :value="__('Vendedor')" />
                            <x-select-input id="seller_id" name="seller_id" class="mt-1 block
                            w-full" required autofocus autocomplete="seller_id">
                                <option value="{{$sale->seller_id}}">Selecione um vendedor</option>
                                @foreach($sellers as $seller)
                                    <option {{ $sale->seller_id == $seller->id ? "selected" : ""  }} value="{{ $seller->id }}">{{ $seller->name }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('seller_id')" />
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
