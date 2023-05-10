@extends('dpanel.layouts.app')

@section('title', 'Categories')

@push('scripts')
    <script>
        @if ($errors->any())
            let errMsg = '';
            @foreach ($errors->all() as $error)
                errMsg = "{{ $error }}";
            @endforeach
            cuteToast({
                type: "error",
                message: errMsg,
            })
        @endif

        const editCategory = (id, name) => {
            document.getElementById("edit-category").querySelector('form').action =
                `${window.location.origin}/dpanel/category/${id}`;
            document.getElementById('category_name').value = name;
            showBottomSheet('edit-category');
        }
    </script>
@endpush

@section('body_content')

    <div class="bg-white rounded mb-3 shadow flex justify-between items-center">
        <p class="font-medium pl-2">Categories</p>
        <button class="bg-gray-800 text-white px-2 py-1 rounded-r uppercase"
            onclick="showBottomSheet('new-category')">New</button>
    </div>

    <x-dpanel::table>
        <x-slot:thead>
            <tr>
                <th scope="col" class="pl-3 py-2 text-left w-12 ">
                    #
                </th>
                <th scope="col" class="pl-3 py-2 text-left font-medium tracking-wider">
                    Category Name
                </th>

                <th scope="col" class="pr-3 py-2 text-right font-medium tracking-wider">
                    Action
                </th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse ($categories as $item)
                <tr>
                    <td class="pl-3 py-2">
                        {{ $categories->perPage() * ($categories->currentPage() - 1) + $loop->iteration }}
                    </td>
                    <td class="pl-3 py-2">{{ $item->name }}</td>

                    <td class="px-4 py-2 flex justify-end gap-1">
                        <button onclick="editCategory('{{ $item->id }}', '{{ $item->name }}')"
                            class="ml-1 text-blue-500 bg-blue-100 focus:outline-none border border-blue-500 rounded-full w-6 h-6 flex justify-center items-center">
                            <i class='bx bx-edit'></i>
                        </button>
                        <form action="{{ route('dpanel.category.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button
                                class="ml-1 text-red-500 bg-red-100 focus:outline-none border border-red-500 rounded-full w-6 h-6 flex justify-center items-center">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                Data Not Found
            @endforelse

        </x-slot:tbody>

        <x-slot:pagination>
            {{ $categories->links('dpanel.layouts.pagination') }}
        </x-slot:pagination>
    </x-dpanel::table>


    <x-dpanel::modal.bottom-sheet sheetId="new-category" bsPosition="R" title="New Category">
        <div class="flex justify-center">
            <form action="{{ route('dpanel.category.store') }}" method="post" class="bg-white p-3 rounded shadow">
                @csrf

                <div>
                    <label class="font-medium">Category Name</label>
                    <input type="text" name="name" placeholder="Enter Category Name" maxlength="20"
                        class="border w-full rounded px-2 py-1 focus:outline-none" required>
                </div>

                <button class="bg-gray-800 rounded px-2 py-1 text-white uppercase w-full mt-4 shadow">Save</button>

            </form>
        </div>
    </x-dpanel::modal.bottom-sheet>

    <x-dpanel::modal.bottom-sheet sheetId="edit-category" bsPosition="R" title="Edit Category">
        <div class="flex justify-center">
            <form action="" method="post" class="bg-white p-3 rounded shadow">
                @csrf
                @method('PUT')

                <div>
                    <label class="font-medium">Category Name</label>
                    <input type="text" name="name" id="category_name" placeholder="Enter Category Name" maxlength="20"
                        class="border w-full rounded px-2 py-1 focus:outline-none" required>
                </div>

                <button class="bg-gray-800 rounded px-2 py-1 text-white uppercase w-full mt-4 shadow">Update</button>

            </form>
        </div>
    </x-dpanel::modal.bottom-sheet>


    <x-dpanel::modal.bottom-sheet-js hideOnClickOutside="true" />

@endsection
