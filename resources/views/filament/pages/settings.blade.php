<x-filament::page>
    <form wire:submit.prevent="save" class="bg-[#2B2B2B] p-6 rounded-xl text-white space-y-6">
        {{ $this->form }}
    </form>
</x-filament::page>
