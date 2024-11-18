<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                                    <form action="<?php echo e(route('data.index')); ?>" method="GET">
                                        <input type="text" id="search-provider" name="search"
                                               class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
                                               placeholder="Search" value="<?php echo e(request('search')); ?>">
                                        <button type="submit" class="hidden"></button>
                                    </form>
                                </div>
                            </div>



































                            <form method="GET" action="<?php echo e(route('data.index')); ?>" x-data="{ open: false }" @click.away="open = false" class="relative inline-block">
                                <!-- Dropdown Button -->
                                <button @click="open = !open"
                                        type="button"
                                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none"
                                        aria-haspopup="menu">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/><path d="M7 12h10"/><path d="M10 18h4"/>
                                    </svg>
                                    Filter
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open"
                                     class="hs-dropdown-menu opacity-100 divide-y divide-gray-200 min-w-48 z-10 bg-white shadow-md rounded-lg mt-2 fixed right-96"
                                     role="menu"
                                     aria-orientation="vertical"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95">

                                    <!-- Dropdown Options -->
                                    <div x-data="{ clearFilters() {document.getElementById('age').value = ''; document.getElementById('prison').value = ''; document.getElementById('program').value = '';}}" class="divide-y divide-gray-200">
                                        <label for="filter-all" class="flex py-2.5 px-3">
                                            <input type="checkbox" id="filter-all" name="all" @change="clearFilters()" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500">
                                            <span class="ms-3 text-sm text-gray-800">All</span>
                                        </label>
                                        <!-- Age Filter -->
                                        <label for="age" class="block py-2.5 px-3">
                                            <span class="text-sm text-gray-800">Age Range</span>
                                            <select id="age" name="age_range"
                                                    class="text-sm mt-1 block w-full border-gray-300 rounded-2xl focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Select age range</option>
                                                <option value="0-5" <?php echo e(request()->get('age_range') == '0-5' ? 'selected' : ''); ?>>0-5</option>
                                                <option value="6-10" <?php echo e(request()->get('age_range') == '6-10' ? 'selected' : ''); ?>>6-10</option>
                                                <option value="11-15" <?php echo e(request()->get('age_range') == '11-15' ? 'selected' : ''); ?>>11-15</option>
                                                <option value="16-20" <?php echo e(request()->get('age_range') == '16-20' ? 'selected' : ''); ?>>16-20</option>
                                            </select>
                                        </label>
                                        <!-- Prison Filter -->
                                        <label for="prison" class="block py-2.5 px-3">
                                            <span class="text-sm text-gray-800">Prison</span>
                                            <select id="prison" name="prison"
                                                    class="text-sm mt-1 block w-full border-gray-300 rounded-2xl focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Select Prison</option>
                                                <?php $__currentLoopData = get_prisons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($prison->id); ?>" <?php echo e(request()->get('prison') == $prison->id ? 'selected' : ''); ?>><?php echo e($prison->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </label>
                                        <!-- Program Filter -->
                                        <label for="program" class="block py-2.5 px-3">
                                            <span class="text-sm text-gray-800">Program</span>
                                            <select id="program" name="program"
                                                    class="text-sm mt-1 block w-full border-gray-300 rounded-2xl focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Select Program</option>
                                                <?php $__currentLoopData = get_programs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($program->id); ?>" <?php echo e(request()->get('program') == $program->id ? 'selected' : ''); ?>><?php echo e($program->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </label>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="py-2 px-3">
                                        <button type="submit" class="w-full py-2 px-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Apply Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <div class="inline-flex gap-x-2">
                                    <a href="<?php echo e(route('dashboard')); ?>" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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
                                <th scope="col" colspan="2" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">Connecting Location & Program</span>
                                    </div>
                                </th>

                            </tr>
                            </thead>
                            <?php if($personalDetails->isEmpty()): ?>
                                <tr>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="pl-3 py-3">
                                            <span class="text-md-center font-semibold text-gray-600">No details found</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                                <?php $__currentLoopData = $personalDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personalDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            <div class="grow">
                                                <span class="block text-sm font-semibold text-gray-800"><?php echo e(Str::limit($personalDetail->Personal_Details->inmate_name, 15, '..')); ?></span>
                                                <span class="block text-sm text-gray-500"><?php echo e(get_prisons()->where('id', $personalDetail->Personal_Details->prison_id)->first()->name); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800"><?php echo e(Str::limit($personalDetail->child_name, 18, '..')); ?></span>
                                        <span class="block text-sm text-gray-500"><?php echo e($personalDetail->gender); ?></span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800"><?php echo e($personalDetail->age); ?> Year's</span>
                                        <span class="block text-sm text-gray-500"><?php echo e($personalDetail->date_of_birth->format('Y-m-d')); ?></span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm text-gray-800"><?php echo e($personalDetail->address); ?></span>
                                        <span class="block text-sm font-semibold text-gray-500"><?php echo e($personalDetail->city); ?></span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">Grade <?php echo e($personalDetail->grade); ?></span>
                                        <span class="block text-sm text-gray-500"><?php echo e($personalDetail->school); ?></span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800"><?php echo e($personalDetail->Guardian->guardian_name); ?></span>
                                        <span class="block text-sm text-gray-500"><?php echo e($personalDetail->Guardian->relationship); ?></span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800"><?php echo e($personalDetail->Guardian->contact_number_1); ?></span>
                                        <span class="block text-sm text-gray-500"><?php echo e($personalDetail->Guardian->contact_number_2); ?></span>
                                    </div>
                                </td>
                                <td class="h-px w-52 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm text-gray-800"><?php echo e($personalDetail->Guardian->connecting_location); ?></span>
                                        <?php $__currentLoopData = $personalDetail->Program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="block text-sm font-normal text-gray-500"><?php echo e(ucfirst($programs->name)); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </td>






                                <td class="size-px whitespace-nowrap">
                                    <div class="px-3 py-1.5">
                                        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="<?php echo e(route('data.edit', ['id' => $personalDetail->id])); ?>">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold text-gray-800"><?php echo e($personalDetails->count()); ?></span> results
                                </p>
                            </div>
                            <div>
                                <div class="inline-flex gap-x-2">
                                    <!-- Previous Page Link -->
                                    <button type="button"
                                            <?php if($personalDetails->onFirstPage()): ?> disabled <?php endif; ?>
                                            onclick="window.location='<?php echo e($personalDetails->previousPageUrl()); ?>'"
                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m15 18-6-6 6-6"/>
                                        </svg>
                                        Prev
                                    </button>

                                    <!-- Next Page Link -->
                                    <button type="button"
                                            <?php if(!$personalDetails->hasMorePages()): ?> disabled <?php endif; ?>
                                            onclick="window.location='<?php echo e($personalDetails->nextPageUrl()); ?>'"
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
        <script>
                let typingTimer;
                let debounceInterval = 500; // Delay time in milliseconds (0.5 seconds)

                document.getElementById('search-provider').addEventListener('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                document.getElementById('search-provider').form.submit();
            }, debounceInterval);
            });
        </script>
    </div>
    <!-- End Table Section -->
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\theek\Herd\charity\resources\views/data.blade.php ENDPATH**/ ?>