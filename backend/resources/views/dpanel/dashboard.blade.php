@extends('dpanel.layouts.app')

@section('title', 'Dashboard')

@push('css')
    <x-dpanel::chart.js>
        <script src="//code.highcharts.com/modules/cylinder.js"></script> {{-- For Funnel & Pyramid Chart --}}
        <script src="//code.highcharts.com/modules/funnel3d.js"></script> {{-- For Funnel & Pyramid Chart --}}
        <script src="//code.highcharts.com/modules/pyramid3d.js"></script> {{-- For Pyramid Chart --}}
        <script src="https://code.highcharts.com/modules/networkgraph.js"></script> {{-- For Graph Tree Chart --}}
    </x-dpanel::chart.js>
@endpush

@section('body_content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-violet-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Heading 1</p>
                <small class="text-gray-400">0</small>
            </div>
        </div>

        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-yellow-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Heading 2</p>
                <small class="text-gray-400">0</small>
            </div>
        </div>
        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-green-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Heading 3</p>
                <small class="text-gray-400">0</small>
            </div>
        </div>
        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-red-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Heading 4</p>
                <small class="text-gray-400">0</small>
            </div>
        </div>
        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-orange-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Heading 5</p>
                <small class="text-gray-400">0</small>
            </div>
        </div>

    </div>

    {{-- Charts --}}

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        @php
            $columnName1 = $chart['column']['name'];
            $columnData1 = $chart['column']['data'];
            $donutData1 = $chart['donut']['data'];
            $pieData1 = $chart['pie']['data'];
            $pyramidData1 = $chart['pyramid']['data'];
            $funnelData1 = $chart['pyramid']['data'];
            $treeData1 = $chart['tree']['data'];
        @endphp
        <x-dpanel::chart.column chartId="column1" chartTitle="Column Test Chart" chartTooltip="Data"
            chartAxisTitleY="Optional Y Axis Title" :chartData="$columnData1" :chartNames="$columnName1" />

        <x-dpanel::chart.donut chartId="donut1" chartTitle="Donut Test Chart" :chartData="$donutData1" chartName="Total Data" />

        <x-dpanel::chart.pie chartId="pie1" chartTitle="Pie Test Chart" chartName="Share" :chartData="$pieData1" />
        <x-dpanel::chart.pyramid chartId="pyramid1" chartTitle="Pyramid Test Chart" chartName="Total Click"
            :chartData="$pyramidData1" />
        <x-dpanel::chart.funnel chartId="funnel1" chartTitle="Funnel Test Chart" chartName="Total Click"
            :chartData="$funnelData1" />

        <x-dpanel::chart.graph-tree chartId="graphTree1" chartTitle="Graph Tree Test Chart"
            chartRootItem="{{ array_keys($chart['tree']['data'][0])[0] }}" :chartData="$treeData1" />


    </div>
    {{-- Charts End --}}

    {{-- Bottom Sheet --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <div onclick="showBottomSheet('bottomSheet')"
            class="bg-white rounded-md text-center shadow-lg w-full cursor-pointer">
            <p class="font-medium py-2">Open Bottom Sheet</p>
        </div>

        <div onclick="showBottomSheet('bottomSheet-T')"
            class="bg-white rounded-md text-center shadow-lg w-full cursor-pointer">
            <p class="font-medium py-2">Open Bottom Sheet (Top)</p>
        </div>

        <div onclick="showBottomSheet('bottomSheet-L')"
            class="bg-white rounded-md text-center shadow-lg w-full cursor-pointer">
            <p class="font-medium py-2">Open Bottom Sheet (Left)</p>
        </div>

        <div onclick="showBottomSheet('bottomSheet-R')"
            class="bg-white rounded-md text-center shadow-lg w-full cursor-pointer">
            <p class="font-medium py-2">Open Bottom Sheet (Right)</p>
        </div>

    </div>

    <x-dpanel::modal.bottom-sheet sheetId="bottomSheet" title="Bottom Sheet">
        <div class="flex justify-center items-center min-h-[30vh] md:min-h-[50vh]">
            <h1 class="text-2xl">Default Bottom Sheet</h1>
        </div>
    </x-dpanel::modal.bottom-sheet>

    <x-dpanel::modal.bottom-sheet sheetId="bottomSheet-T" bsPosition="T" title="Bottom Sheet">
        <div class="flex justify-center items-center min-h-[30vh] md:min-h-[50vh]">
            <h1 class="text-2xl">Bottom Sheet Top</h1>
        </div>
    </x-dpanel::modal.bottom-sheet>

    <x-dpanel::modal.bottom-sheet sheetId="bottomSheet-L" bsPosition="L" title="Bottom Sheet">
        <div class="flex justify-center items-center min-h-[30vh] md:min-h-[50vh]">
            <h1 class="text-2xl">Bottom Sheet Left</h1>
        </div>
    </x-dpanel::modal.bottom-sheet>

    <x-dpanel::modal.bottom-sheet sheetId="bottomSheet-R" bsPosition="R" title="Bottom Sheet">
        <div class="flex justify-center items-center min-h-[30vh] md:min-h-[50vh]">
            <h1 class="text-2xl">Bottom Sheet Right</h1>
        </div>
    </x-dpanel::modal.bottom-sheet>


    <x-dpanel::modal.bottom-sheet-js hideOnClickOutside="true" />
    {{-- Bottom Sheet End --}}


    {{-- Table --}}
    <section class="mt-4">
        <x-dpanel::table>
            <x-slot:thead>
                <tr>
                    <th scope="col" class="pl-3 py-2 text-left w-12 ">
                        #
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        First Name
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Last Name
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Phone Number
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Email Address
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Date Of Birth
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Full Address
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Register Date
                    </th>

                    <th scope="col" class="pl-3 py-2 text-center font-medium tracking-wider">
                        Action
                    </th>
                </tr>
            </x-slot:thead>

            <x-slot:tbody>
                @foreach (range(1, 10) as $item)
                    <tr>
                        <td class="pl-3 py-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="pl-3 py-2">Vinay</td>
                        <td class="pl-3 py-2">Rajput</td>
                        <td class="pl-3 py-2">70079XXXXX</td>
                        <td class="pl-3 py-2">vinay@dd4you.in</td>
                        <td class="pl-3 py-2">01-01-2000</td>
                        <td class="pl-3 py-2">HN, City, State, India, (Pincode)</td>
                        <td class="px-4 py-2">22-02-2023</td>
                        <td class="px-4 py-2 flex justify-center">
                            <a href="#"
                                class="ml-1 text-blue-500 bg-blue-100 focus:outline-none border border-blue-500 rounded-full w-6 h-6 flex justify-center items-center">
                                <i class='bx bx-edit'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </x-slot:tbody>

            <x-slot:pagination>
                {{-- Pagination --}}
            </x-slot:pagination>
        </x-dpanel::table>
    </section>

    {{-- Table End --}}

@endsection
