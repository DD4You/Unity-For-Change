@extends('dpanel.layouts.app')

@section('title', 'Dashboard')

@section('body_content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-violet-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Total Category</p>
                <small class="text-gray-400">{{ $total['category'] }}</small>
            </div>
        </div>

        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-yellow-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Total Campaign</p>
                <small class="text-gray-400">{{ $total['campaign'] }}</small>
            </div>
        </div>
        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-green-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Total Active Campaign</p>
                <small class="text-gray-400">{{ $total['activeCampaign'] }}</small>
            </div>
        </div>
        <div class="bg-white rounded-md flex shadow-lg w-full overflow-hidden">
            <span class="p-3 bg-red-500 flex items-center">
                <i class='bx bx-message-alt-detail text-3xl text-white'></i>
            </span>
            <div class="p-3">
                <p class="font-medium">Total Raised Fund</p>
                <small class="text-gray-400">0</small>
            </div>
        </div>

    </div>


    {{-- Table --}}
    <section class="mt-4">
        <x-dpanel::table>
            <x-slot:thead>
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
                        Phone Number
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Email Address
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Amount
                    </th>
                    <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                        Date
                    </th>

                </tr>
            </x-slot:thead>

            <x-slot:tbody>
                @foreach ($raiseFund as $item)
                    <tr>
                        <td class="pl-3 py-2">
                            {{ $raiseFund->perPage() * ($raiseFund->currentPage() - 1) + $loop->iteration }}
                        </td>
                        <td class="pl-3 py-2">{{ $item->campaign->name }}</td>
                        <td class="pl-3 py-2">{{ $item->name }}</td>
                        <td class="pl-3 py-2">{{ $item->phone }}</td>
                        <td class="pl-3 py-2">{{ $item->email }}</td>
                        <td class="pl-3 py-2">{{ $item->amount }}</td>
                        <td class="pl-3 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach

            </x-slot:tbody>

            <x-slot:pagination>
                {{ $raiseFund->links('dpanel.layouts.pagination') }}
            </x-slot:pagination>
        </x-dpanel::table>
    </section>

    {{-- Table End --}}

@endsection
