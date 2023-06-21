@if(session()->has('success'))
    <div x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl top-24 left-3 text-sm">
                <p>{{ session('success') }}</p>
    </div>
@endif

@if(session()->has('error'))
<div x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="fixed bg-red-500 text-white py-2 px-4 rounded-xl top-24 left-3 text-sm">
                <p>{{ session('error') }}</p>
    </div>
@endif
