<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showTableDoctor()
    {
        $doctors = User::join('doctors', 'users.id', '=', 'doctors.user_id')
            ->select('users.id', 'users.name', 'users.email', 'doctors.spesialist', 'doctors.address', 'doctors.active_day', 'doctors.start_hour', 'doctors.end_hour', 'doctors.phone')
            ->get();
        return view('userList.doctor', compact('doctors'));
    }


    public function showTablePatient()
    {
        $patients = User::join('patients', 'users.id', '=', 'patients.user_id')
            ->select('users.id', 'users.name', 'users.email', 'patients.address', 'patients.phone', 'patients.birth_date')
            ->get();
        return view('userList.patient', compact('patients'));
    }

    public function showTablePharmacist()
    {
        $pharmacists = User::join('pharmacists', 'users.id', '=', 'pharmacists.user_id')
            ->select('users.id', 'users.name', 'users.email', 'pharmacists.address', 'pharmacists.phone', 'pharmacists.birth_date')
            ->get();
        return view('userList.pharmacist', compact('pharmacists'));
    }

    // Controller untuk Dokter
    public function registerDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'specialization' => 'required|string|max:255',
            'address' => 'required|string',
            'active_day' => 'required|string',
            'start_hour' => 'required|date_format:H:i',
            'end_hour' => 'required|date_format:H:i|after:start_hour',
            'phone' => 'required|string',
        ]);

        info('User Data:', $request->only('name', 'email'));
        info('Doctor Data:', $request->only('specialization', 'address', 'active_day', 'start_hour', 'end_hour', 'phone'));

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'doctor'
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'spesialist' => $request->input('specialization'),
            'address' => $request->input('address'),
            'active_day' => $request->input('active_day'),
            'start_hour' => $request->input('start_hour'),
            'end_hour' => $request->input('end_hour'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('success', 'Dokter berhasil didaftarkan.');
    }

    public function editDoctor($id)
    {
        $doctor = Doctor::with('user')->where('user_id', $id)->first();
        // return $doctor;
        return view('userList.edit_doctor', compact('doctor'));
    }

    public function updateDoctor(Request $request, $id)
    {
        $request->validate([
            'update_name' => 'required|string|max:255',
            'update_email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'update_password' => 'nullable|string|min:8|confirmed',
            'update_specialization' => 'required|string|max:255',
            'update_address' => 'required|string',
            'update_active_day' => 'required|string',
            'update_start_hour' => 'required|date_format:H:i:s',
            'update_end_hour' => 'required|date_format:H:i:s|after:update_start_hour',
            'update_phone' => 'required|string',
        ]);

        // dd($request->all());
        // dd($request->validated());

        $user = User::find($id);

        if (!$user) {
            return redirect('/UserList/doctor')->with('error', 'Dokter tidak ditemukan.');
        }

        // Update data pada tabel 'users'
        $user->update([
            'name' => $request->input('update_name'),
            'email' => $request->input('update_email'),
            'password' => $request->filled('update_password') ? bcrypt($request->input('update_password')) : $user->password,
        ]);

        // Update data pada tabel 'doctors'
        $doctor = $user->doctor;

        if ($doctor) {
            $doctor->update([
                'spesialist' => $request->input('update_specialization'),
                'address' => $request->input('update_address'),
                'active_day' => $request->input('update_active_day'),
                'start_hour' => $request->input('update_start_hour'),
                'end_hour' => $request->input('update_end_hour'),
                'phone' => $request->input('update_phone'),
            ]);

            return redirect('/UserList/doctor')->with('success', 'Data dokter berhasil diperbarui.');
        } else {
            return redirect('/UserList/doctor')->with('error', 'Dokter tidak ditemukan.');
        }
    }

    public function deleteDoctor($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('/UserList/doctor')->with('error', 'Dokter tidak ditemukan.');
        }

        $user->delete();

        return redirect('/UserList/doctor')->with('success', 'Dokter berhasil dihapus.');
    }


    // Controller untuk Pasien
    public function registerPatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string',
            'phone' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        info('User Data:', $request->only('name', 'email'));
        info('Patient Data:', $request->only('address', 'phone', 'birth_date'));

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'patient',
            'password' => bcrypt($request->input('password')),
        ]);

        Patient::create([
            'user_id' => $user->id,
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'birth_date' => $request->input('birth_date'),
        ]);

        return redirect()->back()->with('success', 'Pasien berhasil didaftarkan.');
    }

    public function editPatient($id)
    {
        $patient = Patient::with('user')->where('user_id', $id)->first();
        // return $patient;
        return view('userList.edit_patient', compact('patient'));
    }

    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'update_name' => 'required|string|max:255',
            'update_email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'update_password' => 'nullable|string|min:8|confirmed',
            'update_address' => 'required|string',
            'update_phone' => 'required|string',
            'update_birth_date' => 'required|date',
        ]);

        // dd($request->all());
        // dd($request->validated());

        $user = User::find($id);

        if (!$user) {
            return redirect('/UserList/patient')->with('error', 'Pasien tidak ditemukan.');
        }

        // Update data pada tabel 'users'
        $user->update([
            'name' => $request->input('update_name'),
            'email' => $request->input('update_email'),
            'password' => $request->filled('update_password') ? bcrypt($request->input('update_password')) : $user->password,
        ]);

        // Update data pada tabel 'patients'
        $patient = $user->patient;

        if ($patient) {
            $patient->update([
                'address' => $request->input('update_address'),
                'phone' => $request->input('update_phone'),
                'birth_date' => $request->input('update_birth_date'),
            ]);

            return redirect('/UserList/patient')->with('success', 'Data pasien berhasil diperbarui.');
        } else {
            return redirect('/UserList/patient')->with('error', 'Pasien tidak ditemukan.');
        }
    }

    public function deletePatient($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('/UserList/patient')->with('error', 'Pasien tidak ditemukan.');
        }

        $user->delete();

        return redirect('/UserList/patient')->with('success', 'Pasien berhasil dihapus.');
    }

    // Controller untuk Apoteker
    public function registerPharmacist(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string',
            'phone' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        info('User Data:', $request->only('name', 'email'));
        info('Pharmacist Data:', $request->only('address', 'phone', 'birth_date'));

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'pharmacist',
            'password' => bcrypt($request->input('password')),
        ]);

        Pharmacist::create([
            'user_id' => $user->id,
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'birth_date' => $request->input('birth_date'),
        ]);

        return redirect()->back()->with('success', 'Apoteker berhasil didaftarkan.');
    }

    public function editPharmacist($id)
    {
        $pharmacist = Pharmacist::with('user')->where('user_id', $id)->first();
        // return $pharmacist;
        return view('userList.edit_pharmacist', compact('pharmacist'));
    }

    public function updatePharmacist(Request $request, $id)
    {
        $request->validate([
            'update_name' => 'required|string|max:255',
            'update_email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'update_password' => 'nullable|string|min:8|confirmed',
            'update_address' => 'required|string',
            'update_phone' => 'required|string',
            'update_birth_date' => 'required|date',
        ]);

        // dd($request->all());
        // dd($request->validated());

        $user = User::find($id);

        if (!$user) {
            return redirect('/UserList/pharmacist')->with('error', 'Apoteker tidak ditemukan.');
        }

        // Update data pada tabel 'users'
        $user->update([
            'name' => $request->input('update_name'),
            'email' => $request->input('update_email'),
            'password' => $request->filled('update_password') ? bcrypt($request->input('update_password')) : $user->password,
        ]);

        // Update data pada tabel 'pharmacists'
        $pharmacist = $user->pharmacist;

        if ($pharmacist) {
            $pharmacist->update([
                'address' => $request->input('update_address'),
                'phone' => $request->input('update_phone'),
                'birth_date' => $request->input('update_birth_date'),
            ]);

            return redirect('/UserList/pharmacist')->with('success', 'Data apoteker berhasil diperbarui.');
        } else {
            return redirect('/UserList/pharmacist')->with('error', 'Apoteker tidak ditemukan.');
        }
    }

    public function deletePharmacist($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('/UserList/pharmacist')->with('error', 'Apoteker tidak ditemukan.');
        }

        $user->delete();

        return redirect('/UserList/pharmacist')->with('success', 'Apoteker berhasil dihapus.');
    }

}