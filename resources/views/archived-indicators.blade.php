<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archived Indicators') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto p-6 text-gray-900">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 px-4 py-2">Indicator</th>
                                <th class="border border-gray-300 px-4 py-2">Type</th>
                                <th class="border border-gray-300 px-4 py-2">End Year</th>
                                <th class="border border-gray-300 px-4 py-2">Operational Definition</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $indicator)
                                <tr class="hover:bg-gray-50"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal-create-mfo', { id: {{ $indicator->id }} });"
                                >
                                    <td class="border border-gray-300 px-4 py-2">{{ $indicator->title }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $indicator->type == 0 ? '-' : ($indicator->type == 1 ? "Primary" : "Secondary") }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $indicator->end_year }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $indicator->operational_definition }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- UNDER CONSTRUCTION !-->
    <x-modal-alt name="create-mfo" focusable>
        <form method="post" :action="`{{ route('archived_indicators.update', ':id') }}`.replace(':id', objectId)" class="space-y-6 p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Adjust End Year') }}
            </h2>

            <div>
                <x-input-label for="end_year" :value="__('Edit End Year')" />
                <x-text-input id="end_year" name="end_year" type="text" class="mt-1 block w-full" autocomplete="end_year"/>
                <x-input-error :messages="$errors->updatePassword->get('end_year')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <x-secondary-button x-on:click="open = false">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
