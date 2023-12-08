<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalRecordController extends Controller
{
    public function showTableMedicalRecord()
    {
        $medicalRecords = MedicalRecord::with(['patient', 'doctor', 'drug'])->get();

        return view('medicalRecord.medical_record', compact('medicalRecords'));
    }

    public function create()
    {
        $patients = Patient::all();
        $drugs = Drug::all();
        $pharmacists = Pharmacist::all();

        return view('medicalRecord.add_record', compact('patients', 'drugs', 'pharmacists'));
    }

    public function store(Request $request)
    {
        // Validasi request jika diperlukan

        $doctorId = Auth::user()->doctor->id;

        MedicalRecord::create([
            'doctor_id' => $doctorId,
            'patient_id' => $request->input('patient_id'),
            'drug_id' => $request->input('drug_id'),
            'pharmacist_id' => $request->input('id_apoteker'),
            'diagnosis' => $request->input('diagnosis'),
            'action' => $request->input('action'),
            'tgl_berobat' => $request->input('tgl_berobat'),
            'status' => 'Menunggu Obat',
        ]);

        return redirect()->route('medicalrecordlist')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $medicalRecord = MedicalRecord::find($id);
        $patients = Patient::all();
        $drugs = Drug::all();
        $pharmacists = Pharmacist::all();

        return view('medicalRecord.edit_record', compact('medicalRecord', 'patients', 'drugs', 'pharmacists'));
    }

    public function update(Request $request, $id)
    {
        // Validasi request jika diperlukan

        $medicalRecord = MedicalRecord::find($id);

        $medicalRecord->update([
            'patient_id' => $request->input('patient_id'),
            'drug_id' => $request->input('drug_id'),
            'pharmacist_id' => $request->input('id_apoteker'),
            'diagnosis' => $request->input('diagnosis'),
            'action' => $request->input('action'),
            'tgl_berobat' => $request->input('tgl_berobat'),
        ]);

        return redirect()->route('medicalrecordlist')->with('success', 'Rekam medis berhasil diubah.');
    }

    public function delete($id)
    {
        $medicalRecord = MedicalRecord::find($id);

        $medicalRecord->delete();

        return redirect()->route('medicalrecordlist')->with('success', 'Rekam medis berhasil dihapus.');
    }

    public function statusCheckDone($id)
    {
        $medicalRecord = MedicalRecord::find($id);

        $medicalRecord->update([
            'status' => 'Diberi Obat',
        ]);

        return redirect()->route('medicalrecordlist')->with('success', 'Status rekam medis berhasil diubah.');
    }
}