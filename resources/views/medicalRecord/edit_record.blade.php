@extends('layouts.navigator')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card px-4">
                <div class="card-header pb-0">
                    <h6>Edit Rekam Medis</h6>
                </div>
                <div class="card-body px-0 pt-0">
                    <form action="{{ route('medical_records.update', ['id' => $medicalRecord->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Pilih Pasien</label>
                            <select name="patient_id" id="patient_id" class="form-select ps-3">
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" @if(old('patient_id') == $patient->id) selected @endif>{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="id_apoteker" class="form-label">Pilih Apoteker</label>
                            <select name="id_apoteker" id="id_apoteker" class="form-select ps-3">
                                @foreach ($pharmacists as $pharmacist)
                                    <option value="{{ $pharmacist->id }}" @if(old('id_pharmacist') == $pharmacist->id) selected @endif>{{ $pharmacist->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="drug_id" class="form-label">Pilih Obat</label>
                            <select name="drug_id" id="drug_id" class="form-select ps-3">
                                @foreach ($drugs as $drug)
                                    <option value="{{ $drug->id }}" @if(old('drug_id') == $drug->id) selected @endif>{{ $drug->drug_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="diagnosis" class="form-label">Diagnosis</label>
                            <input type="text" name="diagnosis" id="diagnosis" class="form-control" required value="{{$medicalRecord->diagnosis}}">
                        </div>

                        <div class="mb-3">
                            <label for="action" class="form-label">Tindakan</label>
                            <textarea name="action" id="action" class="form-control" required>{{$medicalRecord->action}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tgl_berobat" class="form-label">Tgl. CheckUp</label>
                            <input id="tgl_berobat" type="date" class="form-control @error('tgl_berobat') is-invalid @enderror" name="tgl_berobat" value="{{ $medicalRecord->tgl_berobat }}" required>
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
