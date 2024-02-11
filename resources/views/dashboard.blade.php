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
                    <h2 class="text-md font-semibold">Alterar configurações de administração</h2>
                    <p>Use o formulário abaixo para alterar as configurações administrativas</p>
                    @if(!$admin)
                        <p class="mt-6 mb-2 text-red-500">Não há informações de administração cadastradas no momento. Para funcionamento adequado do sistema, cadastre as informações assim que possível.</p>
                    @endif
                    <form action="{{ route("update-admin-info") }}" method="post">
                        @method('put')
                        @csrf
                        <div class="mt-6 space y-6 gap-2">
                            <div class="my-2">
                                <x-input-label for="admin_name" :value="__('Nome do administrador')" />
                                <x-text-input id="admin_name" class="block w-full" type="text" name="name" :value="old('name', isset($admin) ? $admin['name'] : '')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('admin_name')" />
                            </div>
                            <div class="my-2">
                                <x-input-label for="admin_email" :value="__('E-mail do administrador')" />
                                <x-text-input id="admin_email" class="block w-full" type="email" name="email" :value="old(' email', isset($admin) ? $admin['email'] : '')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('admin_email')" />
                            </div>
                            <div class="my-2">
                                <x-input-label for="admin_commission" :value="__('Comissão definida (%)')" />
                                <x-text-input min="0" max="99" id="admin_commission" class="block w-full" type="number" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}"  name="commission" :value="old('commission',  isset($admin) ? $admin['commission'] : '')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('admin_commission')" />
                            </div>
                            @if (session('status') === 'update-admin-info-success')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="text-sm text-green-600 dark:text-gray-400"
                                >{{ __(session('message')) }}</p>
                            @elseif(session('status') === 'update-admin-info-error')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="text-sm text-red-600 dark:text-red-400"
                                >
                                    {{ __(session('message')) }}
                                </p>
                            @endif
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-md font-semibold">Enviar e-mail para vendedor</h2>
                    <p>Você pode enviar e-mail para um vendedor especifico entre os listados abaixo com todas as vendas que o mesmo fez no dia.</p>
                    @if($sellers->isEmpty())
                        <p class="mt-6 mb-2">Não há vendedores cadastrados no momento.</p>
                        <a clas href="{{ route('sellers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md ">Cadastrar vendedor</a>
                    @else
                        <form method="post" action="{{ route('send-report-to-seller', ) }}" class="mt-6 space-y-2">
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
                    @endif

                </div>
            </div>
        </div>
    </div>


</x-app-layout>

