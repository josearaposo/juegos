<x-app-layout>
    <div class="relative overflow-x-auto w-3/4 mx-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Distribuidora
                    </th>
{{--                     <th scope="col" class="px-6 py-3">
                        <a href="{{ route('desarrolladora.index', ['order' => 'desarrolladora', 'order_dir' => order_dir($order == 'desarrolladora', $order_dir)]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Desarrolladora {{ order_dir_arrow($order == 'desarrolladora', $order_dir) }}
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('desarrolladora.index', ['order' => 'distribuidora', 'order_dir' => order_dir($order == 'distribuidora', $order_dir)]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Distribuidora {{ order_dir_arrow($order == 'distribuidora', $order_dir) }}
                        </a>
                    </th> --}}


                </tr>
            </thead>
            <tbody>
                @foreach ($desarrolladoras as $desarrolladora)
               {{--  {{ dd($desarrolladora) }} --}}
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('desarrolladoras.show', $desarrolladora) }}">
                                {{$desarrolladora->nombre }}
                            </a>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="text-blue-500 blue" href="{{ route('desarrolladoras.show', $desarrolladora) }}">
                                {{$desarrolladora->distribuidora->nombre}}
                            </a>
                        </th>

{{--                         <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($desarrolladora->existeImagen())
                                <img src="{{ asset($desarrolladora->imagen_url) }}" />
                            @endif
                        </th> --}}

{{--                         <td class="px-6 py-4">
                            <a href="{{ route('desarrolladora.edit', ['desarrolladora' => $desarrolladora]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <x-primary-button>
                                    Editar
                                </x-primary-button>
                            </a>
                        </td> --}}
                        <td class="px-6 py-4">
                            <a href="{{ route('desarrolladora.cambiar_imagen', ['desarrolladora' => $desarrolladora]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <x-primary-button>
                                    Cambiar imagen
                                </x-primary-button>
                            </a>
                        </td>
{{--                         <td class="px-6 py-4">
                            <form action="{{ route('desarrolladora.destroy', ['desarrolladora' => $desarrolladora]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="bg-red-500">
                                    Borrar
                                </x-primary-button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('desarrolladoras.create') }}" class="flex justify-center mt-4 mb-4">
            <x-primary-button class="bg-green-500 mb-2">Insertar una nuevo desarrolladora</x-primary-button>
        </form>
    </div>
</x-app-layout>
