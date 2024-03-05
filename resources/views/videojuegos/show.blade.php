<x-app-layout>
    <div class="relative overflow-x-auto w-auto mx-8 mshadow-md sm:rounded-lg">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
{{--             @if ($videojuego->existeImagen())
                <img src="{{ asset($videojuego->imagen_url) }}" />
            @endif --}}
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $videojuego->titulo }}
            </h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ $videojuego->anyo }}
            </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Precio: {{ $videojuego->desarrolladora->nombre}}
            </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ $videojuego->desarrolladora->distribuidora->nombre }}
            </p>

            <button type="button"
            class="px-4 py-2 text-sm font-medium text-orange-600 bg-white border border-gray-200 rounded-t-lg md:rounded-tr-none md:rounded-l-lg hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-2 focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-primary-500 dark:focus:text-white">
     <a href="{{route('hacer_comentario', ['comentable' => $videojuego, 'tipo' =>  'Videojuego', 'videojuego' => $videojuego])}}">
        Hacer comentarios
    </a>
    </button>

            <a href="{{ route('videojuegos.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Volver
            </a>
        </div>
        {{ $videojuego->mostrar_comentarios()}}
    </div>
</x-app-layout>
