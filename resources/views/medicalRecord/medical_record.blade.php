@extends('layouts.navigator')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
              <h6 class="text-white text-capitalize ps-3">Catatan Rekam Medis Pasien</h6>
              {{-- <div class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama pasien" id="searchInput" oninput="filterRecords(event)">
                </div>
                </div> --}}
            
              @can('isDoctor')
              <a href="{{route('medical_records.create')}}" class="btn btn-sm btn-light d-flex align-items-center" style="margin-bottom: 0; margin-right: 20px">
                <span class="material-symbols-outlined me-2">add</span>
                Tambah Rekam Medis
              </a>   
              @endcan
              
            </div>
          </div>
            <div class="card-body pt-4 p-3">
                <div class="row">
                    @foreach ($medicalRecords as $record)
                    @if ((Auth::user()->role == 'patient' && $record->patient->user_id == Auth::user()->id) || Auth::user()->role == 'doctor')
                    <div class="border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg col-md-5 mx-auto" id="record{{ $record->id }}">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm">{{ $record->patient->user->name }}</h6>
                            <span class="mb-2 text-xs">Email Pasien: <span class="text-dark font-weight-bold ms-sm-2">{{$record->patient->user->email}}</span></span>
                            <span class="mb-2 text-xs">Pemeriksa: <span class="text-dark ms-sm-2 font-weight-bold">{{ $record->doctor->user->name }}</span></span>
                            <span class="text-xs">Tgl CheckUp: <span class="text-dark ms-sm-2 font-weight-bold">{{ $record->tgl_berobat }}</span></span>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-success px-1 mb-0" style="border: 1px solid #abe7c7; border-radius: 0.375rem;" href="javascript:;" data-bs-toggle="modal" data-bs-target="#viewMedicalRecordModal{{ $record->id }}">
                                <i class="material-icons text-sm me-2">info</i>View
                            </a>
                            @if (Auth::user()->role == 'doctor')
                                @if ($record->doctor->user_id == Auth::user()->id)
                                <a class="btn btn-link text-dark px-1 mb-0" style="border: 1px solid #6182a5; border-radius: 0.375rem;" href="{{route('medical_records.edit', ['id' => $record->id])}}"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                <form action="{{route('medical_records.delete', ['id' => $record->id])}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger text-gradient px-1 mb-0" style="border: 1px solid #baaaac; border-radius: 0.375rem;" onclick="return confirm('Apakah kamu yakin ingin menghapus rekam medis ini?')">
                                        <i class="material-icons text-sm me-2">delete</i>Delete
                                    </button>
                                  </form>   
                                @endif
                            @endif                   
                        </div>
                    </div>
                    @endif

                    @if (Auth::user()->role == 'pharmacist' && $record->pharmacist->user_id == Auth::user()->id)
                    <div class="border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg col-md-5 mx-auto">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm" id="record{{ $record->id }}">{{ $record->patient->user->name }}</h6>
                            <span class="mb-2 text-xs">Email Pasien: <span class="text-dark font-weight-bold ms-sm-2">{{$record->patient->user->email}}</span></span>
                            <span class="mb-2 text-xs">Pemeriksa: <span class="text-dark ms-sm-2 font-weight-bold">{{ $record->doctor->user->name }}</span></span>
                            <span class="text-xs">Tgl CheckUp: <span class="text-dark ms-sm-2 font-weight-bold">{{ $record->tgl_berobat }}</span></span>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-success px-1 mb-0" style="border: 1px solid #abe7c7; border-radius: 0.375rem;" href="javascript:;" data-bs-toggle="modal" data-bs-target="#viewMedicalRecordModal{{ $record->id }}">
                                <i class="material-icons text-sm me-2">info</i>View
                            </a>
                            <form action="{{route('medical_records.done', ['id' => $record->id])}}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-link text-dark text-gradient px-1 mb-0" style="border: 1px solid #baaaac; border-radius: 0.375rem;" onclick="return confirm('Apakah kamu yakin ingin melakukan tindakan ini?')">
                                    <i class="material-icons text-sm me-2">check</i>Done
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                    {{-- Modal View --}}
                    <div class="modal fade" id="viewMedicalRecordModal{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Rekam Medis</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td><span class="text-dark font-weight-bold">Nama Pasien</span></td>
                                            <td>:</td>
                                            <td>{{ $record->patient->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-dark font-weight-bold">Email Pasien</span></td>
                                            <td>:</td>
                                            <td>{{ $record->patient->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Telepon Pasien</td>
                                            <td>:</td>
                                            <td>{{ $record->patient->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Pemeriksa</td>
                                            <td>:</td>
                                            <td>{{ $record->doctor->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Diagnosa</td>
                                            <td>:</td>
                                            <td>{{ $record->diagnosis }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Resep</td>
                                            <td>:</td>
                                            <td>{{ $record->drug->drug_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Tanggal CheckUp</td>
                                            <td>:</td>
                                            <td>{{ $record->tgl_berobat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark font-weight-bold">Status</td>
                                            <td>:</td>
                                            <td>{{ $record->status }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
{{-- 
<script>
    function filterRecords(event) {
        if (event.key === 'Enter') {
            var inputRecord, filterRecord, records, patientName;
            inputRecord = document.getElementById("searchInput");
            filterRecord = input.value.trim().toLowerCase();
            records = document.querySelectorAll('[id^="record"]');

            records.forEach(function(record) {
                patientName = record.querySelector('.text-sm').textContent.toLowerCase();
                console.log(patientName);
                record.style.display = patientName.includes(filter) ? "block" : "none";
            });
        }
    };
    
</script> --}}
@endsection
