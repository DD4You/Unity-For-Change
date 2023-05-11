@extends('dpanel.layouts.app')

@section('title', 'New Campaign')

@section('body_content')

    <div class="bg-white rounded mb-3 shadow flex justify-between items-center">
        <p class="font-medium pl-2 py-1">New Campaign</p>
    </div>

    <div class="bg-white p-3 rounded shadow">
        <x-dpanel::input-error-msg />
        <form action="{{ route('dpanel.campaign.store') }}" method="post" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            @csrf

            <div>
                <label class="font-medium">Category</label>
                <select name="category_id" class="border w-full rounded px-2 py-1 focus:outline-none" required>
                    <option value="">select</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="font-medium">Campaign Name</label>
                <input type="text" name="name" placeholder="Enter Campaign Name" maxlength="150"
                    class="border w-full rounded px-2 py-1 focus:outline-none" required>
            </div>
            <div>
                <label class="font-medium">Campaign Goal (₹)</label>
                <input type="number" name="goal" placeholder="Enter Campaign Goal"
                    class="border w-full rounded px-2 py-1 focus:outline-none" required>
            </div>

            <div class="md:col-span-5">
                <label class="font-medium">Campaign Description</label>
                <textarea name="description" placeholder="Enter Campaign Description"
                    class="border w-full rounded px-2 py-1 focus:outline-none" required></textarea>
            </div>

            <div class="md:col-span-5">
                <button class="bg-gray-800 rounded px-2 py-1 text-white uppercase w-full mt-2 shadow">Save</button>
            </div>
        </form>
    </div>

@endsection
