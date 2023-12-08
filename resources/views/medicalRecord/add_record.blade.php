<!-- resources/views/medical_records/create.blade.php -->

@extends('layouts.navigator')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card px-4">
                <div class="card-header pb-0">
                    <h6>Tambah Rekam Medis</h6>
                </div>
                <div class="card-body px-0 pt-0">
                    <form action="{{ route('medical_records.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ auth()->user()->doctor->id }}">
                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Pilih Pasien</label>
                            <select name="patient_id" id="patient_id" class="form-select ps-3">
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="id_apoteker" class="form-label">Pilih Apoteker</label>
                            <select name="id_apoteker" id="id_apoteker" class="form-select ps-3">
                                @foreach ($pharmacists as $pharmacist)
                                    <option value="{{ $pharmacist->id }}">{{ $pharmacist->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="drug_id" class="form-label">Pilih Obat</label>
                            <select name="drug_id" id="drug_id" class="form-select ps-3">
                                @foreach ($drugs as $drug)
                                    <option value="{{ $drug->id }}">{{ $drug->drug_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="diagnosis" class="form-label">Diagnosis</label>
                            <input type="text" name="diagnosis" id="diagnosis" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="action" class="form-label">Tindakan</label>
                            <textarea name="action" id="action" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tgl_berobat" class="form-label">Tgl CheckUp</label>
                            <input id="tgl_berobat" type="date" class="form-control @error('tgl_berobat') is-invalid @enderror" name="tgl_berobat" value="{{ old('tgl_berobat') }}" required>
                            @error('tgl_berobat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
