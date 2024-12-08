<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agencies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto p-6 text-gray-900">
                    <div class="py-4">
                        <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'create-agency')"
                        >{{ __('Add') }}</x-primary-button>
                    </div>

                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 px-4 py-2">Agency</th>
                                <th class="border border-gray-300 px-4 py-2">Acronym</th>
                                <th class="border border-gray-300 px-4 py-2">Contact Details</th>
                                <th class="border border-gray-300 px-4 py-2">Official Website</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agencies as $agency)
                                <tr class="hover:bg-gray-50"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'create-agency')"
                                >
                                    <td class="border border-gray-300 px-4 py-2">{{ $agency->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $agency->acronym }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $agency->contact }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $agency->website }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('agencies.update', $agency->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        |
                                        <form action="{{ route('agencies.destroy', $agency->id) }}" method="POST" class="inline-block">
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

    <x-modal name="create-agency" focusable>
        <form method="post" action="{{ route('agencies.store') }}" class="space-y-6 p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add an agency') }}
            </h2>

            <div>
                <x-input-label for="name" :value="__('Agency')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" />
                <x-input-error :messages="$errors->updatePassword->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="acronym" :value="__('Acronym')" />
                <x-text-input id="acronym" name="acronym" type="text" class="mt-1 block w-full" autocomplete="acronym" />
                <x-input-error :messages="$errors->updatePassword->get('acronym')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="contact" :value="__('Contact')" />
                <x-text-input id="contact" name="contact" type="text" class="mt-1 block w-full" autocomplete="contact" />
                <x-input-error :messages="$errors->updatePassword->get('contact')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="website" :value="__('Website')" />
                <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" autocomplete="website" />
                <x-input-error :messages="$errors->updatePassword->get('website')" class="mt-2" />
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
</x-app-layout>
