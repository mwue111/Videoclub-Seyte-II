<x-layout>
    <x-panel class="mt-4">
        @if(!empty($user->image))
        <div>
            <x-form.image name="avatar" label="" :data="$user->image" :movie="$user->username"></x-form>
        </div>
        @endif

        <div>
            <p>¡Bienvenido/a de vuelta, {{ $user->username }}!</p>
        </div>
    </x-panel>
</x-layout>
