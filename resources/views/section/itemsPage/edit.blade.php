<x-navigationBar></x-navigationBar>

<div class="flex flex-col w-full">

    <div class="md:ml-24 pt-4 pb-4 border-b border-gray-300">
        <div class=" flex w-full items-center justify-between h-7">
            <div class="flex justify-start">
                <div class="hidden md:flex">
                    <a href="{{ route('section.items') }}">
                        <button class="flex bg-slate-900 px-4 py-2 text-white rounded-md font-semibold mr-3 shadow-sm shadow-slate-500" style="font-size: 10px;">
                            BACK
                        </button>
                    </a>
                </div>

                <div class="ml-20 md:ml-14 text-xl text-gray-500">
                    Edit Item
                </div>
            </div>



            <form action="{{ route('itemsPage.destroy', $itemsPage->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class=" bg-red-600 px-4 py-2 text-white rounded-md mr-5 font-semibold shadow-sm shadow-slate-500" style="font-size: 10px;">DELETE</button>
            </form>

        </div>

    </div>

    <div class="ml-5 mr-5 pl-12 pr-12 mb-7 pb-9 pt-8 md:ml-28 md:mr-14 mt-10 bg-zinc-200 rounded-xl overflow-hidden shadow-lg block  border-b-2 border-r-2 border-slate-400">

        <div class="flex center justify-center mb-10">
            <p class=" text-gray-500 text-3xl font-medium">EDIT ITEM</p>
        </div>

        <form action="{{ route('itemsPage.update', $itemsPage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-row mb-10">
                <div class="flex flex-col md:flex-col justify-between mb-3 ml-10">
                    <div class=" mb-5 md:mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="w-96 ml-5 px-4 py-1 border border-gray-400 rounded-md focus:outline-none focus:ring-1 focus:ring-black focus:border-black mt-2 mr-20" value="{{ $itemsPage->name }}">
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5 md:mb-3">
                        <label>Category</label>
                        <input type="text" name="category" class="w-96 px-4 py-1 border border-gray-400 rounded-md focus:outline-none focus:ring-1 focus:ring-black focus:border-black mt-2" value="{{ $itemsPage->category }}">
                        @error('category')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col md:flex-row md:justify-start mb-3">
                        <div>
                            <label>Quantity</label>
                            <input type="number" name="quantity" min="1" max="9999" step="1" value="{{ $itemsPage->quantity }}"
                                   class=" w-16 px-3 py-1 border border-gray-400 rounded-md mt-2 mr-28 ml-1 mb-5">
                            @error('quantity')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label>Price</label>
                            <input type="number" name="price" min="0" step="0.01" value="{{ $itemsPage->price }}"
                                   class="w-40 px-3 py-1 border border-gray-400 rounded-md mt-2 ml-1 remove-spinner mb-5">
                            @error('price')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <style>
                            /* Remove spinner for price input only */
                            input.remove-spinner::-webkit-outer-spin-button,
                            input.remove-spinner::-webkit-inner-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                            }

                            input.remove-spinner {
                                -moz-appearance: textfield;
                            }
                        </style>

                    </div>

                </div>

                <div class="">
                    <label class="flex mb-3">Uploaded Product Image</label>
                    <!-- Display current image if available -->
                    <div class="w-80 h-44 overflow-hidden">
                        @if ($itemsPage->image_path)
                            <img src='{{ asset($itemsPage->image_path) }}' alt="Current Image" class=" w-80" width="100" class="w-full h-full object-cover rounded-lg shadow-lg">
                        @endif
                    </div>
                </div>
            </div>



            <div class="flex center justify-end">
                <div>
                    <button type="submit" class=" bg-green-600 px-4 py-2 text-white rounded-md mr-1 font-semibold shadow-sm shadow-slate-500" style="font-size: 10px;">UPDATE ITEM</button>
                </div>


                <div>
                    <button type="button" onclick="window.location.href='{{ route('section.items') }}'" class="bg-slate-500 px-4 py-2 text-white rounded-md mr-1 font-semibold shadow-sm shadow-slate-500" style="font-size: 10px;">
                        BACK
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
