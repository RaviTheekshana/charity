<x-app-layout>
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            @if ($errors->any())
                <div class="alert alert-danger text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('personal_information.update', ['id' => $personalDetails->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Section -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Inmate Details
                        </h2>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Inmate no
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input id="af-submit-application-full-name" value="{{$personalDetails->Personal_Details->inmate_no}}" name="inmate_no" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-b-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-s-lg sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-full-name" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Inmate name
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input id="af-submit-application-full-name" value="{{$personalDetails->Personal_Details->inmate_name}}" name="inmate_name" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-lg sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-prison" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Prison
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <select id="prison" x-model="prison" name="prison_id" class="py-2 px-3 pe-11 block w-80 border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                            <option value="">Select</option>
                            @foreach(get_prisons() as $prison)
                                <option value="{{ $prison->id }}" {{ $personalDetails->Personal_Details->prison_id == $prison->id ? 'selected' : '' }}>{{ ucfirst($prison->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Sentence No of Years
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input name="sentence_no" value="{{$personalDetails->Personal_Details->sentence_no}}" type="number" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                Sentence End Year
                            </label>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input
                            id="af-submit-application-current-company"
                            name="end_sentence"
                            type="date"
                            min="{{ \Carbon\Carbon::today()->toDateString() }}" value="{{$personalDetails->Personal_Details->end_year_sentence->format('Y-m-d')}}" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>

                    <!-- End Col -->
                </div>
                <!-- End Section -->
                <div x-data="{
    children: [
        {
            child_name: '{{ addslashes($personalDetails->child_name) }}',
            age: '{{ $personalDetails->age }}',
            birthday: '{{ $personalDetails->date_of_birth->format('Y-m-d') }}',
            gender: '{{ $personalDetails->gender }}',
            address: '{{ addslashes($personalDetails->address) }}',
            city: '{{ addslashes($personalDetails->city) }}',
            school: '{{ addslashes($personalDetails->school) }}',
            grade: '{{ $personalDetails->grade }}',
            program_id: '{{ $personalDetails->program }}'
        }
    ],
    addChild() {
        this.children.push({
            child_name: '',
            age: '',
            birthday: '',
            gender: '',
            address: '',
            city: '',
            school: '',
            grade: '',
            program_id: ''
        });
    },
    removeChild(index) {
        if (this.children.length > 1) {
            this.children.splice(index, 1);
        }
    }
}">
                    <!-- Main Form Header -->
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800">
                                Children Details
                            </h2>
                        </div>
                    </div>

                    <!-- Loop through children array -->
                    <template x-for="(child, index) in children" :key="index">
                        <div class="child-details-section grid sm:grid-cols-12 gap-2 sm:gap-4 pt-4 border-t border-gray-200">
                            <div class="sm:col-span-12">
                                <h3 class="text-md font-semibold text-gray-800">Child #<span x-text="index + 1"></span></h3>
                            </div>

                            <!-- Child Name -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    Child name
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <input type="text" x-model="child.child_name" :name="'children[' + index + '][child_name]'" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Age -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    Age
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <select x-model="child.age" :name="'children[' + index + '][age]'" class="py-2 px-3 pe-11 block w-50 border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select</option>
                                    @for ($age = 5; $age <= 19; $age++)
                                        <option value="{{ $age }}">{{ $age }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Date of Birth -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    Date of Birth
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <input type="date" x-model="child.birthday" :name="'children[' + index + '][birthday]'" class="py-2 px-3 pe-11 block w-80 border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Gender -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    Gender
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <select x-model="child.gender" :name="'children[' + index + '][gender]'" class="py-2 px-3 pe-11 block w-80 border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <!-- Address -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    Address
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <input type="text" x-model="child.address" :name="'children[' + index + '][address]'" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- City -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    City
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <input type="text" x-model="child.city" :name="'children[' + index + '][city]'" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- School -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    School
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <input type="text" x-model="child.school" :name="'children[' + index + '][school]'" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Grade -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    Grade
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <input type="text" x-model="child.grade" :name="'children[' + index + '][grade]'" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Program -->
                            <div class="sm:col-span-3">
                                <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                                    Program
                                </label>
                            </div>
                            <div class="sm:col-span-9">
                                <select x-model="child.program_id" :name="'children[' + index + '][program_id]'" class="py-2 px-3 pe-11 block w-80 border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select</option>
                                    @foreach(get_programs() as $program)
                                        <option value="{{ $program->id }}">{{ ucfirst($program->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Remove Button -->
                            <div class="sm:col-span-12 text-right">
                                <button type="button" @click="removeChild(index)" class="bg-red-500 text-white py-1 px-3 rounded-lg mt-2">Remove</button>
                            </div>
                        </div>
                    </template>
                    <!-- Add New Child Section Button -->
                    <div class="sm:col-span-12 text-right mt-4 pb-4">
                        <button type="button" @click="addChild()" class="bg-blue-500 text-white py-2 px-3 rounded-lg">Add Another Child</button>
                    </div>
                </div>


                <!-- Section -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Guardian Details
                        </h2>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-linkedin-url" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Guardian name
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-linkedin-url" value="{{$personalDetails->Guardian->guardian_name}}" name="guardian" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-twitter-url" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Contact no One
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="phone" name="contact_no_one" value="{{$personalDetails->Guardian->contact_number_1}}" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-github-url" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Contact no two
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="phone" name="contact_no_two" value="{{$personalDetails->Guardian->contact_number_2}}" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-portfolio-url" class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Relationship
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-portfolio-url" value="{{$personalDetails->Guardian->relationship}}" name="relationship" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Region
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input name="region" type="text" value="{{$personalDetails->Guardian->region}}" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5">
                            Connecting Location
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input name="connecting_location" type="text" value="{{$personalDetails->Guardian->connecting_location}}" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Section -->

                <!-- Section -->
                <div class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Submit application
                    </h2>
                    <p class="mt-3 text-sm text-gray-600">
                        In order to contact you with future programs that you may be selected in, we need to store your personal data.
                    </p>
                    <p class="mt-2 text-sm text-gray-600">
                        If you are happy for us to do so please click the checkbox below.
                    </p>

                    <div class="mt-5 flex">
                        <input type="checkbox" class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" id="af-submit-application-privacy-check">
                        <label for="af-submit-application-privacy-check" class="text-sm text-gray-500 ms-2">Allow us to process your personal information.</label>
                    </div>
                </div>
                <!-- End Section -->

                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Update application
                </button>
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
</x-app-layout>
