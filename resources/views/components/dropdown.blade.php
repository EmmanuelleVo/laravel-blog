@props(['trigger', 'entries'])

<div x-data="{ show: false }" @click.away="show=false">
    {{-- Trigger --}}
    <div @click="show =! show">
        {{ $trigger }}
    </div>

    {{-- Links / Items --}}
    <div x-show="show" class="py-2 absolute bg-gray-100 w-full mt-2 rounded-xl overflow-auto max-h-52" style="display: none">
        {{ $entries }}
    </div>

</div>
