<?php

namespace App\Http\Controllers;

use App\Imports\InmateDataImport;
use App\Models\Children;
use App\Models\Guardian;
use App\Models\Personal_Details;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isEmpty;

class PersonalDetailsController extends Controller
{
    public function index(Request $request)
    {
        $query = Children::with('guardian', 'Personal_Details');

        // Search Query
        if ($request->filled('search')) {
            $searchQuery = $request->input('search');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('child_name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhereHas('guardian', function ($q) use ($searchQuery) {
                        $q->where('guardian_name', 'LIKE', '%' . $searchQuery . '%');
                        $q->orWhere('contact_number_1', 'LIKE', '%' . $searchQuery . '%');
                        $q->orWhere('contact_number_2', 'LIKE', '%' . $searchQuery . '%');
                    })
                    ->orWhereHas('Personal_Details', function ($q) use ($searchQuery) {
                        $q->where('inmate_name', 'LIKE', '%' . $searchQuery . '%');
                    });
            });
        }

        // Gender Filter with "All" Option Handling
        if ($request->input('all') !== 'on') {

            // Age Range Filter
            if ($request->filled('age_range')) {
                list($minAge, $maxAge) = explode('-', $request->input('age_range'));
                $query->whereHas('Personal_Details', function ($q) use ($minAge, $maxAge) {
                    $q->whereBetween('age', [(int)$minAge, (int)$maxAge]);
                });
            }
            //Prison Filter
            if ($request->filled('prison')) {
                $prison = $request->input('prison');
                $query->whereHas('Personal_Details', function ($q) use ($prison) {
                    $q->where('prison_id', [(int)$prison]);
                });
            }
            // Program Filter
            if ($request->filled('program')) {
                $program = $request->input('program');
                $query->whereHas('program', function ($q) use ($program) {
                    $q->where('program', [(int)$program]);
                });
            }
        }
        // Pagination and View
        $personalDetails = $query->paginate(8);
        return view('data', compact('personalDetails'));
    }


    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'inmate_no' => 'required|string|max:25',
            'inmate_name' => 'required|string|max:255',
            'prison_id' => 'required|exists:prisons,id',
            'sentence_no' => 'required|int',
            'end_sentence' => 'required|date|after:today',
            'children.*.child_name' => 'required|string|max:255',
            'children.*.age' => 'required|int',
            'children.*.birthday' => 'required|date',
            'children.*.gender' => 'required|string|max:10',
            'children.*.address' => 'required|string|max:255',
            'children.*.city' => 'required|string|max:20',
            'children.*.school' => 'required|string|max:50',
            'children.*.grade' => 'required|integer',
            'children.*.program_id' => 'required|exists:programs,id',
            'guardian' => 'required|string|max:255',
            'contact_no_one' => 'required',
            'contact_no_two' => 'required|different:contact_no_one',
            'relationship' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'connecting_location' => 'required|string|max:50',
        ]);
        $personalDetails = Personal_Details::create([
            'inmate_no' => $request->input('inmate_no'),
            'inmate_name' => $request->input('inmate_name'),
            'prison_id' => $request->input('prison_id'),
            'sentence_no' => $request->input('sentence_no'),
            'end_year_sentence' => $request->input('end_sentence')
            ]);

        $guardian = Guardian::create([
            'guardian_name' => $request->input('guardian'),
            'contact_number_1' => $request->input('contact_no_one'),
            'contact_number_2' => $request->input('contact_no_two'),
            'relationship' => $request->input('relationship'),
            'region' => $request->input('region'),
            'connecting_location' => $request->input('connecting_location'),
        ]);

        // Loop through each child in the 'children' array and create a record in the 'Children' table
        foreach ($request->input('children') as $child) {
            Children::create([
                'child_name' => $child['child_name'],
                'age' => $child['age'],
                'date_of_birth' => $child['birthday'],
                'gender' => $child['gender'],
                'address' => $child['address'],
                'city' => $child['city'],
                'grade' => $child['grade'],
                'school' => $child['school'],
                'program' => $child['program_id'],
                'guardian_id' => $guardian->id,
                'personal_details_id' => $personalDetails->id,
            ]);
        }

        return back()->with('flash.bannerStyle', 'success')
            ->with('flash.banner', 'Personal details created successfully!');
    }
    public function import(Request $request)
    {
        $request->validate([
            'photo' => 'required|file|mimes:csv,txt'
        ]);

        // Import data from the uploaded CSV file
        Excel::import(new InmateDataImport, $request->file('photo'));

        //Session success or error message
        if (session('error')) {
            return back()->with('flash.bannerStyle', 'danger')
                ->with('flash.banner', 'Some records were not imported because they already exist in the database.');
        } else {
            return back()->with('flash.bannerStyle', 'success')
                ->with('flash.banner', 'Data imported successfully!');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //Get the child's guardian and personal details
        $personalDetails = Children::with('guardian', 'Personal_Details')->where('id', $id)->first();
//        dd($personalDetails);
        return view('update', compact('personalDetails'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'inmate_no' => 'required|string|max:25',
            'inmate_name' => 'required|string|max:255',
            'prison_id' => 'required|exists:prisons,id',
            'sentence_no' => 'required|int',
            'end_sentence' => 'required|date|after:today',
            'children.*.child_name' => 'required|string|max:255',
            'children.*.age' => 'required|int',
            'children.*.birthday' => 'required|date',
            'children.*.gender' => 'required|string|max:10',
            'children.*.address' => 'required|string|max:255',
            'children.*.city' => 'required|string|max:20',
            'children.*.school' => 'required|string|max:50',
            'children.*.grade' => 'required|integer',
            'children.*.program_id' => 'required|exists:programs,id',
            'guardian' => 'required|string|max:255',
            'contact_no_one' => 'required',
            'contact_no_two' => 'required|different:contact_no_one',
            'relationship' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'connecting_location' => 'required|string|max:50',
        ]);
        $child = Children::find($id);
        $personalDetails = Personal_Details::findOrFail($request->input('personal_details_id'));
        $guardian = Guardian::findOrFail($request->input('guardian_id'));

        if ($child == null) {
            // Update existing child
            dd($request->all());
        } else {
            // Create new children records if the child is not found
            foreach ($request->input('children') as $childData) {
                Children::create([
                    'child_name' => $childData['child_name'],
                    'age' => $childData['age'],
                    'date_of_birth' => $childData['birthday'],
                    'gender' => $childData['gender'],
                    'address' => $childData['address'],
                    'city' => $childData['city'],
                    'grade' => $childData['grade'],
                    'school' => $childData['school'],
                    'program' => $childData['program_id'],
                    'guardian_id' =>  $guardian->id,
                    'personal_details_id' => $personalDetails->id,
                ]);
            }
        }

        // Update personal details for the child
        $personalDetails->update([
            'inmate_no' => $request->input('inmate_no'),
            'inmate_name' => $request->input('inmate_name'),
            'prison_id' => $request->input('prison_id'),
            'sentence_no' => $request->input('sentence_no'),
            'end_year_sentence' => $request->input('end_sentence')
        ]);

        // Update guardian details
        $guardian->update([
            'guardian_name' => $request->input('guardian'),
            'contact_number_1' => $request->input('contact_no_one'),
            'contact_number_2' => $request->input('contact_no_two'),
            'relationship' => $request->input('relationship'),
            'region' => $request->input('region'),
            'connecting_location' => $request->input('connecting_location'),
        ]);

        return back()->with('flash.bannerStyle', 'success')
            ->with('flash.banner', 'Personal details updated successfully!');
    }

    public function destroy($id)
    {
    }
}
