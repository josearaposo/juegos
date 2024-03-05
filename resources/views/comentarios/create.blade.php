<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('guardar_comentario', ['comentable' => $comentable, 'tipo' => $tipo, 'videojuego' => $videojuego]) }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-input-label for="contenido" :value="'Contenido del comentario'" />
                <textarea id="contenido" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="contenido" :value="old('url')" required autofocus autocomplete="contenido"></textarea>
                <x-input-error :messages="$errors->get('contenido')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('videojuegos.show', ['videojuego' => $comentable]) }}">
                    <x-secondary-button class="ms-4">
                        Volver
                        </x-primary-button>
                </a>
                <x-primary-button class="ms-4">
                    Insertar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
