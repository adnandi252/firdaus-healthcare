<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment\Doc;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()->role == 'admin') {
            $doctors = User::join('doctors', 'users.id', '=', 'doctors.user_id')
                ->select('users.id', 'users.name', 'users.email', 'doctors.spesialist', 'doctors.address', 'doctors.active_day', 'doctors.start_hour', 'doctors.end_hour', 'doctors.phone')
                ->get();
            return view('dashboard', compact('doctors'));

        }


        if(Auth::user()->role == 'pharmacist') {
            $topDrugs = MedicalRecord::select('drugs.id', 'drugs.drug_name', 'drugs.description', 'drugs.type', 'drugs.price', DB::raw('count(*) as total'))
            ->join('drugs', 'medical_records.drug_id', '=', 'drugs.id')
            ->groupBy('drugs.id', 'drugs.drug_name', 'drugs.description', 'drugs.type', 'drugs.price')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
            return view('dashboard', compact('topDrugs'));

        }
            
        
        if (Auth::user()->role == 'doctor') {
            $doctorId = Auth::user()->doctor->id;
            $lastAddedPatients = MedicalRecord::where('doctor_id', $doctorId)
            ->orderBy('tgl_berobat', 'desc')
            ->limit(5)
            ->get();
    
            // Ambil data pasien dari relasi
            $patients = $lastAddedPatients->map(function ($record) {
                return [
                    'patient_id' => $record->patient->id,
                    'name' => $record->patient->user->name,
                    'email' => $record->patient->user->email,
                    'address' => $record->patient->address,
                    'birth_date' => $record->patient->birth_date,
                    'phone' => $record->patient->phone,
                    'tgl_berobat' => $record->tgl_berobat,
                ];
            });
    
            return view('dashboard', compact('patients'));
        }

        if(Auth::user()->role == 'patient'){
            $medicalRecords = MedicalRecord::with(['patient', 'doctor', 'drug'])->get();

            return view('dashboard', compact('medicalRecords'));
        }
    }
}
