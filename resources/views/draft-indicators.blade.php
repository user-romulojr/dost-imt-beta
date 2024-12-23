<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Draft Indicators') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto p-6 text-gray-900">
                    <div class="py-4">
                        <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'create-indicator')"
                        >{{ __('Add Indicator') }}</x-primary-button>
                    </div>

                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 px-4 py-2">Indicator</th>
                                <th class="border border-gray-300 px-4 py-2">End Year</th>
                                <th class="border border-gray-300 px-4 py-2">Operational Definition</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $indicator)
                                <tr class="hover:bg-gray-50"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'create-indicator')"
                                >
                                    <td class="border border-gray-300 px-4 py-2">{{ $indicator->title }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $indicator->end_year }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $indicator->operational_definition }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('agencies.update', $indicator->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        |
                                        <form action="{{ route('agencies.destroy', $indicator->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-indicator" focusable>
        <form method="post" action="{{ route('draft_indicators.store') }}" class="space-y-6 p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add an indicator') }}
            </h2>

            <div>
                <x-input-label for="title" :value="__('Indicator')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="title"/>
                <x-input-error :messages="$errors->updatePassword->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="end_year" :value="__('End Year')" />
                <x-text-input id="end_year" name="end_year" type="text" class="mt-1 block w-full" autocomplete="end_year" />
                <x-input-error :messages="$errors->updatePassword->get('end_year')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="operational_definition" :value="__('Operational Definition')" />
                <x-text-input id="operational_definition" name="operational_definition" type="text" class="mt-1 block w-full" autocomplete="operational_definition" />
                <x-input-error :messages="$errors->updatePassword->get('operational_definition')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- UNDER CONSTRUCTION !-->
    <x-modal-alt name="create-mfo" focusable>
        <form method="post" :action="`{{ route('mfo.store', ':id') }}`.replace(':id', objectId)" class="space-y-6 p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add an MFO') }}
            </h2>

            <div>
                <x-input-label for="title" :value="__('Major Final Output')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="title"/>
                <x-input-error :messages="$errors->updatePassword->get('title')" class="mt-2" />
            </div>

            @foreach ($years as $year)
            <div>

                <x-input-label for="{{ $year }}" value="{{ $year }} Target" />
                <x-text-input id="{{ $year }}" name="{{ $year }}" type="text" class="mt-1 block w-full" autocomplete="{{ $year }}"/>
                <x-input-error :messages="$errors->updatePassword->get('title')" class="mt-2" />
            </div>
            @endforeach

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
