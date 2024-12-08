<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluate Indicators') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto space-y-6 p-6 text-gray-900">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Indicator</th>
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Major Final Output</th>
                                <th colspan="6" class="border border-gray-300 px-4 py-2">Target</th>
                                <th colspan="6" class="border border-gray-300 px-4 py-2">Accomplished</th>
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                            <tr>
                                @foreach ($years as $year)
                                    <th class="border border-gray-300 px-4 py-2">{{ $year }}</th>
                                @endforeach
                                @foreach ($years as $year)
                                    <th class="border border-gray-300 px-4 py-2">{{ $year }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $indicator)
                                @php
                                    $mfoCount = $indicator->majorFinalOutputs()->count();
                                    $counter = 0;
                                @endphp

                                @foreach ($indicator->majorFinalOutputs as $majorFinalOutput)
                                    @php
                                        $counter++;
                                        $successIndicators = $majorFinalOutput->successIndicators;
                                    @endphp
                                    <tr>
                                        @if ($counter == 1)
                                                <td rowspan={{ $mfoCount }} class="border border-gray-300 px-4 py-2">{{ $indicator->title }}</td>
                                        @endif

                                        <td class="border border-gray-300 px-4 py-2">{{ $majorFinalOutput->title }}</td>

                                        @foreach ($years as $year)
                                            <td class="border border-gray-300 px-4 py-2">
                                                @if ($successIndicators->contains('year', $year))
                                                    {{ $successIndicators->firstWhere('year', $year)->target }}
                                                @endif
                                            </td>
                                        @endforeach
                                        @foreach ($years as $year)
                                            <td class="border border-gray-300 px-4 py-2">
                                                @if ($successIndicators->contains('year', $year))
                                                    {{ $successIndicators->firstWhere('year', $year)->accomplished }}
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="border border-gray-300 px-4 py-2">
                                            <x-primary-button
                                                x-data
                                                x-on:click.prevent="$dispatch('open-modal-evaluate-mfo', { id: {{ $majorFinalOutput->id }} });"
                                            >{{ __('Evaluate') }}</x-primary-button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-modal-alt name="evaluate-mfo" focusable>
        <form method="post" :action="`{{ route('evaluate_indicators.store', ':id') }}`.replace(':id', objectId)" class="space-y-6 p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Evaluate MFO') }}
            </h2>

            <p>Object ID: <span x-text="objectId ?? 'None'"></span></p>

            @foreach ($years as $year)
            <div>
                <x-input-label for="{{ $year }}" value="{{ $year }} Accomplished" />
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
