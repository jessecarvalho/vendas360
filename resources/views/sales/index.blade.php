<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('sales.create') }}">
                <div class="bg-blue-500 hover:bg-blue-600 text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 dark:text-gray-100 flex items-center gap-4">
                        <img class="invert" src="{{@asset("/icons/plus-solid.svg")}}" alt="Ĩcone de plus (mais)" width="25px">
                        {{ __('Criar nova venda') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold">Vendas cadastrados</h2>
                    <table class="w-full mt-6">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __('Data') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __('Vendedor') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __('Valor') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __('Ações') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @if (count($sales) === 0)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ __('Nenhuma venda cadastrada') }}</div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($sales as $sale)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items
                                        -center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ date("d/m/Y", strtotime($sale->date)) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $sale->seller->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $sale->value }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <a href="{{ route('sales.edit', $sale->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Editar') }}</a>
                                    <form method="post" action="{{ route('sales.destroy', $sale->id) }}" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Excluir') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
