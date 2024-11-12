<?php

namespace App\Http\Controllers;

use App\Imports\InmateDataImport;
use App\Models\Children;
use App\Models\Guardian;
use App\Models\Personal_Details;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
                    })
                    ->orWhereHas('Personal_Details', function ($q) use ($searchQuery) {
                        $q->where('inmate_name', 'LIKE', '%' . $searchQuery . '%');
                    });
            });
        }

        // Gender Filter
        if ($request->filled('gender')) {
            $genders = $request->input('gender');
            $query->whereHas('Personal_Details', function ($q) use ($genders) {
                $q->whereIn('gender', $genders);
            });
        }
        // Age Range Filter
        if ($request->filled('age_range')) {
            list($minAge, $maxAge) = explode('-', $request->input('age_range'));
            $query->whereHas('Personal_Details', function ($q) use ($minAge, $maxAge) {
                $q->whereBetween('age', [(int)$minAge, (int)$maxAge]);
            });
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
        $child = Children::findOrFail($id);
        foreach ($request->input('children') as $childs) {
            $child->update([
                'child_name' => $childs['child_name'],
                'age' => $childs['age'],
                'date_of_birth' => $childs['birthday'],
                'gender' => $childs['gender'],
                'address' => $childs['address'],
                'city' => $childs['city'],
                'grade' => $childs['grade'],
                'school' => $childs['school'],
                'program' => $childs['program_id'],
            ]);
        }
        $personal_details = Personal_Details::findOrFail($child->personal_details_id);
        $personal_details->update([
            'inmate_no' => $request->input('inmate_no'),
            'inmate_name' => $request->input('inmate_name'),
            'prison_id' => $request->input('prison_id'),
            'sentence_no' => $request->input('sentence_no'),
            'end_year_sentence' => $request->input('end_sentence')
        ]);
        $guardian = Guardian::findOrFail($child->guardian_id);
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
