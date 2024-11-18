<?php

namespace App\Imports;

use App\Models\Personal_Details;
use App\Models\Guardian;
use App\Models\Children;
use App\Models\Prison;
use App\Models\Program;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InmateDataImport implements ToCollection, WithValidation, WithHeadingRow
{
    /**
     * @param Collection $rows
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function collection(Collection $rows)
    {
        $duplicates = [];
        foreach ($rows as $row) {
            // Check if inmate_no already exists in Personal_Details
            if (Personal_Details::where('inmate_no', $row['inmate_no'])->exists()) {
                $duplicates[] = $row['inmate_no'];
                continue; // Skip this row if inmate_no exists
            }

            // Get the prison ID from the prison name
            $prison = Prison::where('name', $row['prison_name'])->first();
            if (!$prison) {
                continue; // Skip this row if prison not found
            }

            // Create or retrieve the Personal Details
            $personalDetails = Personal_Details::create([
                'inmate_no' => $row['inmate_no'],
                'inmate_name' => $row['inmate_name'],
                'prison_id' => $prison->id,
                'sentence_no' => $row['sentence_no'],
                'end_year_sentence' => $row['end_sentence']
            ]);

            // Create or retrieve the Guardian
            $guardian = Guardian::create([
                'guardian_name' => $row['guardian'],
                'contact_number_1' => $row['contact_no_one'],
                'contact_number_2' => $row['contact_no_two'],
                'relationship' => $row['relationship'],
                'region' => $row['region'],
                'connecting_location' => $row['connecting_location']
            ]);

            // Create a new Child record
            $child = Children::create([
                'child_name' => $row['child_name'],
                'age' => $row['age'],
                'date_of_birth' => $row['birthday'],
                'gender' => $row['gender'],
                'address' => $row['address'],
                'city' => $row['city'],
                'grade' => $row['grade'],
                'school' => $row['school'],
                'guardian_id' => $guardian->id,
                'personal_details_id' => $personalDetails->id,
            ]);
            // Map program columns (Angel Tree, Kids Clubs, etc.)
            $programColumns = ['angel_tree', 'kids_clubs', 'promis_path', 'scholarship', 'poorna_jeevana'];
            foreach ($programColumns as $programColumn) {
                if (isset($row[$programColumn]) && $row[$programColumn] == 1) {
                    $program = Program::where('name', str_replace('_', ' ', ucfirst($programColumn)))->first();
                    if ($program) {
                            $program->children()->attach($child->id);
                            $program->save();
                        }
                    }
            }

        }
        // If duplicates were found, return with an error
        if (!empty($duplicates)) {
            // Redirect back with error message including the duplicate inmate_no values
            return back()->with('error', 'The following inmate numbers already exist: ' . implode(', ', $duplicates));
        }
    }
    public function rules(): array
    {
        return [
            'inmate_no' => 'required|string|max:25',
            'inmate_name' => 'required|string|max:255',
            'prison_name' => 'required|exists:prisons,name',
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
            'guardian' => 'required|string|max:255',
            'contact_no_one' => 'required',
            'contact_no_two' => 'required|different:contact_no_one',
            'relationship' => 'required|string|max:50',
            'region' => 'required|string|max:50',
            'connecting_location' => 'required|string|max:50',
        ];
    }
}
