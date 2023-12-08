@extends('layouts.navigator')


@section('content')

@can('isAdmin')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
            <h6 class="text-white text-capitalize ps-3">Dokter</h6>
            
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Spesialisasi</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($doctors as $doctor)
                @php
                  $currentDateTime = \Carbon\Carbon::now();
                  $currentDateTimeUtc8 = $currentDateTime->setTimezone('Asia/Makassar');
                  $currentTimeOnly = $currentDateTimeUtc8->format('H:i:s');
              
                  $dayOfWeek = $currentDateTimeUtc8->dayOfWeek;
                  $startHour = $doctor->start_hour;
                  $endHour = $doctor->end_hour;
              
                  $isOnDuty = ($doctor->active_day == $dayOfWeek && $startHour && $currentTimeOnly <= $endHour);
                @endphp
                @if ($isOnDuty)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('template') }}/assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $doctor->name }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $doctor->email }}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $doctor->spesialist }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @php
                        $currentDateTime = \Carbon\Carbon::now();
                        $currentDateTimeUtc8 = $currentDateTime->setTimezone('Asia/Makassar');
                        $currentTimeOnly = $currentDateTimeUtc8->format('H:i:s');

                        $dayOfWeek = $currentDateTimeUtc8->dayOfWeek;
                        $startHour = $doctor->start_hour;
                        $endHour = $doctor->end_hour;

                    @endphp
            
                    @if ($doctor->active_day == $dayOfWeek && $startHour && $currentTimeOnly <= $endHour)
                        <p class="badge badge-sm bg-gradient-success">Bertugas</p>
                    @else
                        <p class="badge badge-sm bg-gradient-secondary">Tidak Bertugas</p>
                    @endif
                  </td>
                  <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">{{ $doctor->address }}</p>
                    </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $doctor->phone }}</span>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endcan


@can('isPharmacist')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
            <h6 class="text-white text-capitalize ps-3">Obat Terlaku</h6>
            
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Obat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipe</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Terbeli</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($topDrugs as $topDrug)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('template') }}/assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $topDrug->drug_name }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $topDrug->netto }}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $topDrug->type }}</p>
                  </td>
                  <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">{{ $topDrug->description }}</p>
                    </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $topDrug->total }}</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endcan

@can('isDoctor')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
            <h6 class="text-white text-capitalize ps-3">Table Pasien</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Periksa</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($patients as $patient)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('template') }}/assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $patient['name'] }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $patient['email'] }}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs text-center font-weight-bold mb-0">{{ $patient['address'] }}</p>
                  </td>
                  <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">{{ $patient['birth_date'] }}</p>
                    </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $patient['phone'] }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $patient['tgl_berobat'] }}</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endcan

@can('isPatient')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
            <h6 class="text-white text-capitalize ps-3">Table Pasien</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dokter Pemeriksa</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tindakan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Obat diterima</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diagnosis</th>
\                </tr>
              </thead>
              <tbody>
                @foreach ($medicalRecords as $record)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('template') }}/assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $record->doctor->user->name }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $record->doctor->phone }}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs text-center font-weight-bold mb-0">{{ $record->action }}</p>
                  </td>
                  <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">{{ $record->drug->drug_name }}</p>
                    </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record->diagnosis }}</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endcan
@endsection
