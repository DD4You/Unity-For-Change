@extends('dpanel.layouts.app')

@section('title', 'Campaigns')

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" referrerpolicy="no-referrer">
    </script>
    <script src="//code.highcharts.com/highcharts.js"></script>
    <script src="//code.highcharts.com/highcharts-3d.js"></script>
    <script src="//code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const updateStatus = (id, e) => {
            window.location.href = `${window.location.origin}/dpanel/campaign/update/${id}/${e.value}`;
        }

        const getRaiseFundList = (slug, name) => {
            document.getElementById('bottomSheet-title').innerHTML = `Raised Funds : ${name}`;

            fetch(`${window.location.origin}/dpanel/campaign/${slug}`)
                .then((res) => res.json())
                .then((response) => {
                    let html = '';
                    let chartArr = [];

                    if (response.length) {
                        response.forEach((item, index) => {
                            chartArr.push({
                                'name': item.name,
                                'y': item.amount
                            });
                            html += `<tr>
                                        <td class="pl-3 py-2">${index+1}</td>
                                        <td class="pl-3 py-2">${item.campaign.name}</td>
                                        <td class="pl-3 py-2">${item.name}</td>
                                        <td class="pl-3 py-2">${item.phone_number}</td>
                                        <td class="pl-3 py-2">${item.email_address}</td>
                                        <td class="pl-3 py-2">₹${item.amount}</td>
                                        <td class="px-4 py-2">${moment(item.created_at).format('DD-MM-YYYY')}</td>
                                    </tr>`;
                        });

                        showChart(chartArr);
                    } else {
                        showChart([])
                        html =
                            '<tr><td colspan = "7" class = "pl-3 py-2 text-center"> Data Not Found </td> </tr > ';
                    }

                    document.getElementById('raise-fund-table').innerHTML = html;
                });

            showBottomSheet('bottomSheet');
        }

        const showChart = (data) => {
            console.log('data', data);
            Highcharts.chart('raise-fund-chart', {
                chart: {
                    backgroundColor: '#F9FAFB',
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: "Pie Chart",
                    // style: {
                    // "color": '#ffffff',
                    // }
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name} ({point.percentage:.1f}%)'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: "Donation Amount",
                    data: data
                }]
            });
        }
    </script>
@endpush

@section('body_content')
    <div class="bg-white rounded mb-3 shadow flex justify-between items-center">
        <p class="font-medium pl-2">Campaigns</p>
        <a href="{{ route('dpanel.campaign.create') }}" class="bg-gray-800 text-white px-2 py-1 rounded-r uppercase">New</a>
    </div>

    <x-dpanel::table>
        <x-slot:thead>
            <tr>
                <th scope="col" class="pl-3 py-2 text-left w-12 ">
                    #
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Image
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Category
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Name
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Description
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Goal
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Raised
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Status
                </th>
                <th scope="col" class="pr-3 py-2 text-right font-medium tracking-wider">
                    Action
                </th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse ($campaigns as $item)
                <tr>
                    <td class="pl-3 py-2">
                        {{ $campaigns->perPage() * ($campaigns->currentPage() - 1) + $loop->iteration }}
                    </td>
                    <td class="pl-3 py-2" onclick="getRaiseFundList('{{ $item->slug }}', '{{ $item->name }}')">
                        <img class="w-36 md:w-24 rounded"
                            src="{{ $item->images->isNotEmpty() ? $item->images[0]->original_url : 'https://placehold.jp/600x400.png?text=No%20Image' }}"
                            alt="">
                    </td>
                    <td class="pl-3 py-2">{{ $item->category->name }}</td>
                    <td class="pl-3 py-2" onclick="getRaiseFundList('{{ $item->slug }}', '{{ $item->name }}')">
                        {{ $item->name }}</td>
                    <td class="pl-3 py-2">{{ $item->description }}</td>
                    <td class="pl-3 py-2">₹{{ $item->goal }}</td>
                    <td class="pl-3 py-2" onclick="getRaiseFundList('{{ $item->slug }}', '{{ $item->name }}')">
                        ₹{{ $item->raise_funds_sum_amount ?? 0 }}</td>
                    <td class="pl-3 py-2">
                        <select onchange="updateStatus('{{ $item->slug }}',this)"
                            class="focus:outline-none bg-white shadow rounded-sm">
                            <option value="1" @selected($item->is_active == 1)>Active</option>
                            <option value="0" @selected($item->is_active == 0)>Not Active</option>
                        </select>
                    </td>

                    <td class="px-4 py-2 flex justify-end gap-1">
                        <a href="{{ route('dpanel.campaign.edit', $item->slug) }}"
                            class="ml-1 text-blue-500 bg-blue-100 focus:outline-none border border-blue-500 rounded-full w-6 h-6 flex justify-center items-center">
                            <i class='bx bx-edit'></i>
                        </a>
                    </td>
                </tr>
            @empty
                Data Not Found
            @endforelse

        </x-slot:tbody>

        <x-slot:pagination>
            {{ $campaigns->links('dpanel.layouts.pagination') }}
        </x-slot:pagination>

    </x-dpanel::table>

    <x-dpanel::modal.bottom-sheet sheetId="bottomSheet" bsPosition="T" title="Raised Funds">

        <div id="raise-fund-chart" class="w-full bg-transparent"></div>

        <div class="flex justify-center items-center">
            <div class="w-full flex flex-col">
                <div class="overflow-x-auto mb-2 ">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden border-b border-gray-300 rounded">
                            <table class="min-w-full divide-y divide-gray-400">

                                <thead class="bg-white text-xs whitespace-nowrap">
                                    <tr>
                                        <th scope="col" class="pl-3 py-2 text-left w-12 ">
                                            #
                                        </th>
                                        <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                                            Campaign
                                        </th>
                                        <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                                            Phone
                                        </th>
                                        <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                                            Amount
                                        </th>
                                        <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                                            Date
                                        </th>
                                    </tr>
                                </thead>

                                <tbody id="raise-fund-table"
                                    class="bg-gray-50 divide-y divide-gray-300 text-gray-600 text-sm"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </x-dpanel::modal.bottom-sheet>


    <x-dpanel::modal.bottom-sheet-js hideOnClickOutside="true" />
@endsection
