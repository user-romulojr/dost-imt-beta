<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Draft Indicators') }}
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
                                <th rowspan="2" class="border border-gray-300 px-4 py-2" >Indicator</th>
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Major Final Output</th>
                                <th colspan="6" class="border border-gray-300 px-4 py-2">Target</th>
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Remarks</th>
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                            <tr>
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
                                                <td rowspan={{ $mfoCount+1 }} class="border border-gray-300 px-4 py-2">{{ $indicator->title }}</td>
                                        @endif

                                        <td class="border border-gray-300 px-4 py-2">{{ $majorFinalOutput->title }}</td>

                                        @foreach ($years as $year)
                                            <td class="border border-gray-300 px-4 py-2">
                                                @if ($successIndicators->contains('year', $year))
                                                    {{ $successIndicators->firstWhere('year', $year)->target }}
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="border border-gray-300 px-4 py-2">{{ $indicator->remarks }}</td>
                                        <td class="border border-gray-300 px-4 py-2"></td>
                                    </tr>
                                @endforeach

                                <!-- CASE WHERE THERE ARE NO MFO ADDED TO THE INDICATOR YET !-->
                                <tr>
                                    @if ($mfoCount == 0)
                                        <td class="border border-gray-300 px-4 py-2">{{ $indicator->title }}</td>
                                    @endif
                                    <td colspan="9" class="border border-gray-300 px-4 py-2">
                                        <x-primary-button
                                            x-data="{ indicatorID : '{{ $indicator->id }}', }"
                                            x-on:click.prevent="$dispatch('open-modal', 'create-mfo')"
                                        >{{ __('Add MFO') }}</x-primary-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
