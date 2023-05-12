@extends('dpanel.layouts.app')

@section('title', 'Edit Campaign')

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('plugins/ijaboCropTool.min.js') }}"></script>
    <script>
        const showUploadedImage = (id, url) => {
            let html = `<div class="relative">
                        <div class="flex items-center justify-center bg-white rounded-md shadow-md p-1 cursor-pointer">
                            <img src="${url}" class="rounded-md aspect-[3/2] object-cover">
                        </div>
                        <span onclick="deleteImage('${id}')"
                            class="absolute top-1 right-1 cursor-pointer w-7 h-7 flex items-center justify-center bg-white hover:bg-red-500 bg-opacity-25 hover:bg-opacity-100 text-red-500 hover:text-white duration-300 shadow rounded-full">
                            <i class='bx bx-trash text-xl'></i>
                        </span>
                    </div>`;
            document.getElementById('image_container').lastElementChild.insertAdjacentHTML("beforebegin", html);
        }

        const deleteImage = (id) => {
            fetch(`${window.location.origin}/dpanel/campaign-image/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": '{{ csrf_token() }}'
                    },
                })
                .then((res) => {
                    if (res.ok) {
                        return res.json();
                    }
                    cuteToast({
                        type: "error",
                        message: res.statusText,
                    });
                }).then((data) => {
                    cuteToast({
                        type: "success",
                        message: data.msg,
                    }).then(() => {
                        window.location.reload();
                    })
                });
        }

        // Upload Image
        $('#addMoreImg').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 3 / 2,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: "{{ route('dpanel.campaign-image.store', ['id' => $campaign->id]) }}",
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(response, element, status) {
                if (status == 1) {
                    cuteToast({
                        type: "success",
                        message: response.message,
                    });
                    showUploadedImage(response.id, response.url);
                } else {
                    cuteToast({
                        type: "error",
                        message: "Failed! Please try again.",
                    });
                }
            },
            onError: function(message, element, status) {
                cuteToast({
                    type: "error",
                    message: message,
                });
            }
        });
        // Upload Image End
    </script>
@endpush

@section('body_content')

    <div class="bg-white rounded mb-3 shadow flex justify-between items-center">
        <p class="font-medium pl-2 py-1">Edit Campaign</p>
    </div>

    <div class="bg-white p-3 rounded shadow">
        <x-dpanel::input-error-msg />
        <form action="{{ route('dpanel.campaign.update', $campaign) }}" method="post"
            class="grid grid-cols-1 md:grid-cols-5 gap-3">
            @csrf
            @method('PUT')

            <div>
                <label class="font-medium">Category</label>
                <select name="category_id" class="border w-full rounded px-2 py-1 focus:outline-none" required>
                    <option value="">select</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @selected($item->id == $campaign->category_id)>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="font-medium">Campaign Name</label>
                <input type="text" name="name" value="{{ $campaign->name }}" placeholder="Enter Campaign Name"
                    maxlength="150" class="border w-full rounded px-2 py-1 focus:outline-none" required>
            </div>
            <div>
                <label class="font-medium">Campaign Goal (₹)</label>
                <input type="number" name="goal" placeholder="Enter Campaign Goal" value="{{ $campaign->goal }}"
                    class="border w-full rounded px-2 py-1 focus:outline-none" required>
            </div>

            <div class="md:col-span-5">
                <label class="font-medium">Campaign Description</label>
                <textarea name="description" placeholder="Enter Campaign Description"
                    class="border w-full rounded px-2 py-1 focus:outline-none" required>{{ $campaign->description }}</textarea>
            </div>

            {{-- Campaign Images --}}
            <section class="md:col-span-5">
                <h2 class="mb-1 pt-2 text-lg font-medium text-gray-900">Campaign Images</h2>

                <div id="image_container" class="grid grid-cols-1 md:grid-cols-5 gap-3">

                    @foreach ($campaign->media as $image)
                        <div class="relative">
                            <div class="flex items-center justify-center bg-white rounded-md shadow-md p-1 cursor-pointer">
                                <img src="{{ $image->original_url }}" class="rounded-md aspect-[3/2] object-cover">
                            </div>
                            <span onclick="deleteImage('{{ $image->id }}')"
                                class="absolute top-1 right-1 cursor-pointer w-7 h-7 flex items-center justify-center bg-white hover:bg-red-500 bg-opacity-25 hover:bg-opacity-100 text-red-500 hover:text-white duration-300 shadow rounded-full">
                                <i class='bx bx-trash text-xl'></i>
                            </span>
                        </div>
                    @endforeach

                    <div class="relative">
                        <label for="addMoreImg"
                            class="flex items-center justify-center bg-white rounded-md shadow-md p-1 cursor-pointer">
                            <input id="addMoreImg" type="file" name="image" accept="image/*" class="hidden">
                            <img src="https://placehold.jp/600x400.png?text=Add%20Image"
                                class="rounded-md aspect-[3/2] object-cover">
                        </label>
                    </div>

                </div>
            </section>
            {{-- Campaign Images End --}}

            <div class="md:col-span-5">
                <button class="bg-gray-800 rounded px-2 py-1 text-white uppercase w-full mt-2 shadow">Update</button>
            </div>
        </form>
    </div>

@endsection
