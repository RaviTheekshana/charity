<x-app-layout>
    <!-- Table Section -->
    <div class="max-w-[100rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <!-- Header -->
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">
                                    Children
                                </h2>
                                <p class="text-sm text-gray-600">
                                    Add Inmate, Edit and View.
                                </p>
                            </div>
                            <div class="sm:col-span-1">
                                <label for="hs-as-table-product-review-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <form action="{{ route('data.index') }}" method="GET">
                                        <input type="text" id="search-provider" name="search"
                                               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
                                               placeholder="Search" value="{{ request('search') }}">
                                        <button type="submit" class="hidden"></button>
                                    </form>
                                </div>
                            </div>
                            <div class="hs-dropdown [--placement:bottom-right] relative inline-block" data-hs-dropdown-auto-close="inside">
                                <button id="hs-as-table-table-filter-dropdown" type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M7 12h10"/><path d="M10 18h4"/></svg>
                                    Filter
                                    <span class="ps-2 text-xs font-semibold text-blue-600 border-s border-gray-200">1</span>
                                </button>
                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-48 z-10 bg-white shadow-md rounded-lg mt-2" role="menu" aria-orientation="vertical" aria-labelledby="hs-as-table-table-filter-dropdown">
                                    <div class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        <label for="hs-as-filters-dropdown-all" class="flex py-2.5 px-3">
                                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" id="hs-as-filters-dropdown-all" checked>
                                            <span class="ms-3 text-sm text-gray-800 dark:text-neutral-200">All</span>
                                        </label>
                                        <label for="hs-as-filters-dropdown-published" class="flex py-2.5 px-3">
                                            <input type="checkbox" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" id="hs-as-filters-dropdown-published">
                                            <span class="ms-3 text-sm text-gray-800 dark:text-neutral-200">Published</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="inline-flex gap-x-2">
                                    <a href="{{ route('dashboard') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                        Add Inmate
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- End Header -->
                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="ps-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      Inmate Name
                    </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      Children Name
                    </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      Age & Birth Date
                    </span></div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      Address & City
                    </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      School & Grade
                    </span>
                                    </div>
                                </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      Guardian
                    </span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      Contact
                    </span>
                                        </div>
                                    </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                      Connecting Location
                    </span>
                                    </div>
                                </th>
{{--                                    <th scope="col" class="px-1 py-3 text-start">--}}
{{--                                        <div class="flex items-center">--}}
{{--                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">--}}
{{--                        Program--}}
{{--                    </span>--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
                                <th scope="col" class="px-3 py-3 text-end"></th>
                            </tr>
                            </thead>
                                @foreach($personalDetails as $personalDetail)
                            <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            <div class="grow">
                                                <span class="block text-sm font-semibold text-gray-800">{{$personalDetail->Personal_Details->inmate_name}}</span>
                                                <span class="block text-sm text-gray-500">{{get_prisons()->where('id', $personalDetail->Personal_Details->prison_id)->first()->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">{{$personalDetail->child_name}}</span>
                                        <span class="block text-sm text-gray-500">{{$personalDetail->gender}}</span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">{{$personalDetail->age}} Year's</span>
                                        <span class="block text-sm text-gray-500">{{ $personalDetail->date_of_birth->format('Y-m-d') }}</span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm text-gray-800">{{ $personalDetail->address}}</span>
                                        <span class="block text-sm font-semibold text-gray-500">{{$personalDetail->city}}</span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">Grade {{$personalDetail->grade}}</span>
                                        <span class="block text-sm text-gray-500">{{ $personalDetail->school}}</span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">Grade {{$personalDetail->Guardian->guardian_name}}</span>
                                        <span class="block text-sm text-gray-500">{{ $personalDetail->Guardian->relationship}}</span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">{{$personalDetail->Guardian->contact_number_1}}</span>
                                        <span class="block text-sm text-gray-500">{{ $personalDetail->Guardian->contact_number_2}}</span>
                                    </div>
                                </td>
                                <td class="h-px w-52 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm text-gray-800">{{ $personalDetail->Guardian->connecting_location}}</span>
                                        <span class="block text-sm font-semibold text-gray-500">{{$personalDetail->Guardian->region}}</span>
                                    </div>
                                </td>
{{--                                <td class="h-px w-40 whitespace-nowrap">--}}
{{--                                    <div class="px-1 py-3">--}}
{{--                                        <span class="block text-sm text-gray-800">{{ $personalDetail->program}}</span>--}}
{{--                                        <span class="block text-sm font-semibold text-gray-500"></span>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                                <td class="size-px whitespace-nowrap">
                                    <div class="px-3 py-1.5">
                                        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="{{ route('data.edit', ['id' => $personalDetail->id])}}">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800">{{ $personalDetails->count() }}</span> results
                                </p>
                            </div>
                            <div>
                                <div class="inline-flex gap-x-2">
                                    <!-- Previous Page Link -->
                                    <button type="button"
                                            @if($personalDetails->onFirstPage()) disabled @endif
                                            onclick="window.location='{{ $personalDetails->previousPageUrl() }}'"
                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m15 18-6-6 6-6"/>
                                        </svg>
                                        Prev
                                    </button>

                                    <!-- Next Page Link -->
                                    <button type="button"
                                            @if(!$personalDetails->hasMorePages()) disabled @endif
                                            onclick="window.location='{{ $personalDetails->nextPageUrl() }}'"
                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                                        Next
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m9 18 6-6-6-6"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->
</x-app-layout>
