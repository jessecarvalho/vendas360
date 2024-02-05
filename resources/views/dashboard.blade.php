<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-md font-semibold">Enviar e-mail para vendedor</h2>
                    <p>Você pode enviar e-mail para um vendedor especifico entre os listados abaixo com todas as vendas que o mesmo fez no dia.</p>
                    <form method="post" action="{{ route('send-report-to-seller', ) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')

                        <div>
                            <x-input-label for="seller_id" :value="__('Vendedor')" />
                            <x-select-input id="seller_id" name="seller_id" class="block w-full" required autofocus autocomplete="seller_id">
                                <option value="">Selecione um vendedor</option>
                                @foreach($sellers as $seller)
                                    <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('seller_id')" />
                        </div>

                        @if (session('status') === 'generate-unique-report-success')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="text-sm text-green-600 dark:text-gray-400"
                            >{{ __(session('message')) }}</p>
                        @elseif(session('status') === 'generate-unique-report-error')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="text-sm text-red-600 dark:text-red-400"
                            >
                                {{ __(session('message')) }}
                            </p>
                        @endif
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Enviar e-mail</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

