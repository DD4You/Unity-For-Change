@extends('dpanel.layouts.app')

@section('title', 'Campaigns')

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
                        <select onchange="updateStatus('{{ $item->id }}',this)"
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
@endsection
