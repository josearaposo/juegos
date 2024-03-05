<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('desarrolladoras.store') }}">
            @csrf

            <!-- nombre -->
            <div>
                <x-input-label for="nombre" :value="'nombre de la desarrolladora'" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')"
                    required autofocus autocomplete="nombre" {{-- pattern="[A-Z]{2}\d{4}"
                    title="El código de vuelo debe tener el formato 'XXNNNN'" --}} />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <!-- Año -->
            <div>
                <x-input-label for="anyo" :value="'Año del Juego'" />
                <x-text-input id="anyo" class="block mt-1 w-full" type="text" name="anyo" :value="old('anyo')"
                    required autofocus autocomplete="anyo" />
                <x-input-error :messages="$errors->get('anyo')" class="mt-2" />
            </div>


            <!-- Desarrolladoras -->
            <div class="mt-4">
                <x-input-label for="desarrolladora_id" :value="'Desarrolladora'" />
                <select id="desarrolladora_id"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    name="desarrolladora_id" required>
                    @foreach ($desarrolladoras as $desarrolladora)
                        <option value="{{ $desarrolladora->id }}"
                            {{ old('desarrolladora') == $desarrolladora->id ? 'selected' : '' }}>
                            {{ $desarrolladora->nombre }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('desarrolladora_id')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('desarrolladoras.index') }}">
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
