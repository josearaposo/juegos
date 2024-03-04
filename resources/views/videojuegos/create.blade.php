<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('vuelos.store') }}">
            @csrf

            <!-- codigo -->
            <div>
                <x-input-label for="codigo" :value="'Codigo del Vuelo'" />
                <x-text-input id="codigo" class="block mt-1 w-full" type="text" name="codigo" :value="old('codigo')"
                    required autofocus autocomplete="codigo" />
                <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
            </div>



            <!-- Aeropuertos -->
            <div class="mt-4">
                <x-input-label for="aero_origen" :value="'Aeropuerto de salida'" />
                <select id="aero_origen"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    name="aero_origen" required>
                    @foreach ($aeropuertos as $aeropuerto)
                        <option value="{{ $aeropuerto->id }}"
                            {{ old('aero_origen') == $aeropuerto->id ? 'selected' : '' }}>
                            {{ $aeropuerto->codigo }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('aero_origen')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="aero_destino" :value="'Aeropuerto de llegada'" />
                <select id="aero_destino"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    name="aero_destino" required>
                    @foreach ($aeropuertos as $aeropuerto)
                        <option value="{{ $aeropuerto->id }}"
                            {{ old('aero_destino') == $aeropuerto->id ? 'selected' : '' }}>
                            {{ $aeropuerto->codigo }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('aero_destino')" class="mt-2" />
            </div>

            <!-- compañias -->
            <div class="mt-4">
                <x-input-label for="companya_id" :value="'Compañia'" />
                <select id="companya_id"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    name="companya_id" required>
                    @foreach ($companyas as $companya)
                        <option value="{{ $companya->id }}" {{ old('companya_id') == $companya->id ? 'selected' : '' }}>
                            {{ $companya->nombre }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('companya_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="hora_salida" :value="'Fecha de Salida'" />

                <input for="hora_salida" type="datetime-local" id="hora_salida" name="hora_salida">
                <x-input-error :messages="$errors->get('hora_salida')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="hora_llegada" :value="'Fecha de Llegada'" />

                <input  for="hora_llegada" type="datetime-local" id="hora_llegada" name="hora_llegada">
                <x-input-error :messages="$errors->get('hora_llegada')" class="mt-2" />
            </div>


            <div>
                <x-input-label for="plazas" :value="'Plazas'" />
                <x-text-input id="plazas" class="block mt-1 w-full" type="text" name="plazas" :value="old('plazas')"
                    required autofocus autocomplete="plazas" />
                <x-input-error :messages="$errors->get('plazas')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="precio" :value="'Precio'" />
                <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" :value="old('precio')"
                    required autofocus autocomplete="precio" />
                <x-input-error :messages="$errors->get('precio')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('vuelos.index') }}">
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
