<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Secondary Indicators') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto space-y-6 p-6 text-gray-900">
                    <table class="auto border-collapse overflow-x-auto border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Indicator</th>
                                <th rowspan="2" class="border border-gray-300 px-4 py-2">Major Final Output</th>
                                <th colspan="6" class="border border-gray-300 px-4 py-2">Target</th>
                                <th colspan="6" class="border border-gray-300 px-4 py-2">Accomplished</th>
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
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
