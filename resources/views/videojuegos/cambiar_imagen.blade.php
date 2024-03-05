<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('videojuegos.guardar_imagen', ['videojuego' => $videojuego]) }}" enctype="multipart/form-data">
            @csrf

            <!-- Imagen -->
            <div>
                <x-input-label for="imagen" :value="'Imagen del Juego'" />
                <x-text-input id="imagen" class="block mt-1 w-full"
                    type="file" name="imagen" :value="old('imagen')" required
                    autofocus autocomplete="imagen" />
                <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('videojuegos.index') }}">
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
