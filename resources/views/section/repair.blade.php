<x-navigationBar></x-navigationBar>

<div class="flex flex-col w-full">
    <!-- Success Message -->
    @if(session('status'))
        <div id="success-message" class="p-4 fixed top-16 left-1/2 rounded-md transform -translate-x-1/2 z-50 opacity-0 pointer-events-none transition-opacity duration-300
            {{ session('status') == 'Item deleted' ? 'bg-red-500 text-white' : 'bg-green-200 text-green-900' }}"
            role="alert">
            {{ session('status') }}
        </div>
    @endif

    <script>
        window.onload = () => {
            const successMessage = document.getElementById('success-message');
            successMessage.classList.remove('opacity-0', 'pointer-events-none');
            successMessage.classList.add('opacity-100', 'pointer-events-auto');

            setTimeout(() => {
                successMessage.classList.remove('opacity-100', 'pointer-events-auto');
                successMessage.classList.add('opacity-0', 'pointer-events-none');
            }, 3000); // 3000ms = 3 seconds
        };
    </script>

    <!-- Table and Search Section -->
    <div class="flex flex-wrap items-center justify-start pt-4 ml-16 pb-3 md:ml-16 md:pt-2 md:pb-2 md:h-14 md:border-b md:border-gray-300">
        <div class="flex flex-wrap sm:flex-nowrap w-full items-center justify-between space-y-4 sm:space-y-0">
            <!-- Items Label and Search Bar -->
            <div class="flex border-b border-gray-300 pb-2 md:flex-grow md:mr-28 sm:w-auto md:items-center md:justify-start md:border-none space-x-4">
                <div class="ml-2 md:ml-20 md:mr-28 text-xl sm:text-2xl text-gray-500">Items</div>
                <form action="{{ route('section.repair') }}" method="GET">
                    <div class="flex bg-gray-300 px-3 py-1 ml-1 w-80 shadow-inner shadow-gray-300">
                        <input type="text" name="query" id="search-input" placeholder="Search" class="w-full text-base sm:text-lg border-none outline-none bg-transparent pr-12">
                        <div class=" fixed top-2 ml-64 bg-slate-500 h-9 w-14">
                            <button type="submit" class=" px-3 md:px-4 py-2 text-white rounded-md text-xs sm:text-sm" style="font-size: 10px;">
                                <img src="{{ asset('imgs/search.png') }}" alt="back to items" class=" w-4 mt-1">
                            </button>
                        </div>
                    </div>
                </form>

                <form action="{{ route('section.repair') }}" method="GET">
                    <div id="suggestions" class="absolute top-11 bg-gray-300 border border-gray-300 z-50 hidden" style="width: 269px; left: 334px">

                    </div>
                </form>


            </div>
            <div class="w-full md:w-auto flex pb-2 justify-end mr-4 pr-3">
                <a href="{{ route('section.repairPage.create') }}">
                    <button class="bg-slate-800 px-3 md:px-4 py-2 text-white rounded-md text-xs sm:text-sm" style="font-size: 10px;">ADD ITEM</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="ml-5 mb-7 mr-5 md:ml-28 md:mr-14 mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-xs sm:text-sm md:text-base text-gray-600 uppercase font-medium h-10">
                        <th class="w-10 px-3 py-2 border border-gray-300">ID</th>
                        <th class="px-3 py-2 border border-gray-300">Client Name</th>
                        <th class="px-3 py-2 border border-gray-300">Contact Number</th>
                        <th class="w-20 px-3 py-2 border border-gray-300">Address</th>
                        <th class="px-3 py-2 border border-gray-300">Service</th>
                        <th class="px-3 py-2 border border-gray-300">Service Provider</th>
                        <th class="px-3 py-2 border border-gray-300">Price</th>
                        <th class="px-3 py-2 border border-gray-300">Service Description</th>
                        <th class="w-3 px-3 py-2 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $index => $service)
                    <tr class="even:bg-gray-100 odd:bg-white text-xs sm:text-sm md:text-base text-gray-800 cursor-pointer hover:bg-gray-200"
                        onclick="showPopup(event, {{ $service->id }}, '{{ $service->clientName }}', '{{ $service->dateTime }}', {{ $service->address }}, {{ $service->contactNo }}, {{ $service->service }}, {{ $service->serviceProvider }}, {{ $service->price }}, {{ $service->serviceDescription }}, '{{ asset($service->image_path) }}')">
                        <!-- Display Sequential Number -->
                        <td class="px-3 py-2 border border-gray-300 text-center">
                            {{ $services->firstItem() + $index }} <!-- Sequential Number -->
                        </td>

                        <!-- Image and Name Display -->
                        <td class="px-2 py-1 border border-gray-300 flex items-center space-x-2 h-10">
                            <img src="{{ asset($service->image_path) }}" alt="Image" class="w-8 h-8 object-cover mr-2 border-2 border-slate-400">
                            <span>{{ $service->clientName }}</span>
                        </td>
                        <td class="px-3 py-2 border border-gray-300">{{ $service->contactNo }}</td>
                        <td class="px-3 py-2 border border-gray-300 text-center">{{ $service->address }}</td>
                        <td class="px-3 py-2 border border-gray-300 text-center">{{ $service->service }}</td>
                        <td class="px-3 py-2 border border-gray-300 text-center">{{ $service->serviceProvider }}</td>
                        <td class="px-3 py-2 border border-gray-300 text-left">₱{{ number_format($service->price, 2) }}</td>
                        <td class="px-3 py-2 border border-gray-300 text-center">{{ $service->serviceDescription }}</td>
                        <td class="px-3 py-2 border border-gray-300">
                            <a href="{{ route('repairPage.edit', $service->id) }}">
                                <img src="{{ asset('imgs/edit.png') }}" alt="Edit" class="ml-5">
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-600">No items found.</td>
                    </tr>
                    @endforelse
                </tbody>


            </table>
        </div>
        <div class="flex center justify-center mt-5 mb-4">
            {{ $services->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
</div>

<!-- Pop-up -->
<div id="popup" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex justify-center items-center">
    <div class="bg-white p-5 rounded-lg shadow-lg max-w-lg w-1/3 relative">

        <div class="flex justify-start items-start mb-2">
            <p class=" text-gray-500 font-medium text-2xl ml-2">Item</p>
            <button onclick="closePopup()" class="absolute top-2 right-5 font-bold text-xl">
                x
            </button>
        </div>

        <!-- Name and Category -->
        <p id="popup-service-clientName" class="text-center font-bold text-xl"></p>
        <p id="popup-service-clientContactNumber" class="text-center text-xs mb-3"></p>
        <p id="popup-service-clientAddress" class="text-center text-xs mb-3"></p>
        <p id="popup-service-repairService" class="text-center text-xs mb-3"></p>
        <p id="popup-service-serviceProvider" class="text-center text-xs mb-3"></p>

        <!-- Image Container -->
        <div class=" flex flex-col items-center ">
            <div class="flex justify-center mt-3 w-80 h-52 overflow-hidden border-2 border-slate-500 rounded-lg shadow-lg" id="popup-service-image">
                <img src="" alt="Image" class="w-full h-full object-cover rounded-lg shadow-lg">
            </div>
        </div>

        <!-- Quantity and Price -->
        <div class="flex justify-between mt-9">
            <p id="popup-service-servicePrice" class="flex justify-start"></p>
            <p id="popup-service-serviceDescription" class="flex justify-end font-bold"></p>
        </div>

    </div>
</div>



<script>

        function showPopup(event, itemId, clientName, clientContactNumber, clientAddress, repairService, serviceProvider, servicePrice, serviceDescription, itemImagePath) {
        if (event.target.closest('td').classList.contains('w-3')) return;
        document.getElementById('popup-service-clientName').innerText = clientName;
        document.getElementById('popup-service-clientContactNumber').innerText = clientContactNumber;
        document.getElementById('popup-service-clientAddress').innerText = clientAddress;
        document.getElementById('popup-service-repairService').innerText = repairService;
        document.getElementById('popup-service-serviceProvider').innerText = serviceProvider;
        document.getElementById('popup-service-servicePrice').innerText = "₱" + servicePrice.toFixed(2);
        document.getElementById('popup-service-serviceDescription').innerText = serviceDescription;


        // Update the popup image
        const popupImage = document.getElementById('popup-service-image');
        if (itemImagePath) {
            popupImage.innerHTML = `<img src="${itemImagePath}" alt="Uploaded Image" class="w-full h-auto rounded-md">`;
        } else {
            popupImage.innerHTML = `<p class="text-gray-500">No image uploaded.</p>`;
        }

        document.getElementById('popup').classList.remove('hidden');
    }


    function closePopup() {
        document.getElementById('popup').classList.add('hidden');
    }


    // Listen to input changes for search
    document.getElementById('search-input').addEventListener('input', function () {
        const query = this.value;
        const suggestionsDiv = document.getElementById('suggestions');

        if (query.length >= 2) {
            fetch(`/search/suggestions?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsDiv.innerHTML = '';

                    if (data.length) {
                        suggestionsDiv.classList.remove('hidden');
                        data.forEach(item => {
                            const suggestion = document.createElement('div');
                            suggestion.classList.add('px-3', 'py-2', 'cursor-pointer');
                            suggestion.textContent = `${item.name} - ${item.category}`;

                            // Add event listener to the suggestion for clicking
                            suggestion.addEventListener('click', function () {
                                // Set the input field to the suggestion value
                                document.getElementById('search-input').value = item.name;

                                // Submit the form to search with the suggestion
                                document.querySelector('form').submit();
                            });

                            suggestionsDiv.appendChild(suggestion);
                        });
                    } else {
                        suggestionsDiv.classList.add('hidden');
                    }
                });
        } else {
            suggestionsDiv.classList.add('hidden');
        }
    });


    console.log('Popup triggered');





</script>

