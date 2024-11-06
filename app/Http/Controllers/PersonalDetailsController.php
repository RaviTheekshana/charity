<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Guardian;
use App\Models\Personal_Details;
use Illuminate\Http\Request;

class PersonalDetailsController extends Controller
{
    public function index()
    {

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
                'program_id' => $child['program_id'],
                'guardian_id' => $guardian->id,
                'personal_details_id' => $personalDetails->id,
            ]);
        }

        return back()->with('flash.bannerStyle', 'success')
            ->with('flash.banner', 'Personal details created successfully!');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
