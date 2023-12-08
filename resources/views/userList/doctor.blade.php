@extends('layouts.navigator')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
              <h6 class="text-white text-capitalize ps-3">Table Dokter</h6>
              <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                  <label class="form-label">Type here...</label>
                  <input type="text" class="form-control" id="searchInput" onkeypress="handleKeyPress(event)">
                </div>
              </div>
              <a href="{{route('userlist.doctor.register')}}" class="btn btn-sm btn-light d-flex align-items-center" style="margin-bottom: 0; margin-right: 20px" data-bs-toggle="modal" data-bs-target="#registerDoctorModal">
                <span class="material-symbols-outlined me-2">add</span>
                Register Dokter
              </a>
              
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
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($doctors as $doctor)
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
                    <td class="align-middle text-center">
                      <div class="ms-auto text-end">
                        <form action="{{ route('userlist.delete.doctor', ['id' => $doctor->id]) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Are you sure you want to delete this user?')">
                              <i class="material-icons text-sm me-2">delete</i>Delete
                          </button>
                        </form>                      
                        <a class="btn btn-link text-dark px-3 mb-0" href="{{route('userlist.edit.doctor', ['id' => $doctor->id])}}"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                      </div>
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

<!-- Register Doctor Modal -->
<div class="modal fade" id="registerDoctorModal" tabindex="-1" aria-labelledby="registerDoctorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerDoctorModalLabel">Register Dokter</h5>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('userlist.doctor.register') }}">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          </div>

          <div class="mb-3">
            <label for="specialization" class="form-label">{{ __('Spesialisasi') }}</label>
            <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{ old('specialization') }}" required autocomplete="specialization">
            @error('specialization')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">{{ __('Alamat') }}</label>
            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address') }}</textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="active_day" class="form-label">{{ __('Hari Kerja') }}</label>
            <select id="active_day" class="form-select @error('active_day') is-invalid @enderror" name="active_day" required>
              <option value="1">Senin</option>
              <option value="2">Selasa</option>
              <option value="3">Rabu</option>
              <option value="4">Kamis</option>
              <option value="5">Jumat</option>
              <option value="6">Sabtu</option>
              <option value="0">Minggu</option>
            </select>
            @error('active_day')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="start_hour" class="form-label">{{ __('Jam Mulai Kerja') }}</label>
            <input id="start_hour" type="time" class="form-control @error('start_hour') is-invalid @enderror" name="start_hour" required>
            @error('start_hour')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="end_hour" class="form-label">{{ __('Jam Berakhir Kerja') }}</label>
            <input id="end_hour" type="time" class="form-control @error('end_hour') is-invalid @enderror" name="end_hour" required>
            @error('end_hour')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Nomor Telepon') }}</label>
            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-0">
            <button type="submit" class="btn btn-primary">
              {{ __('Register') }}
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
              Close
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@yield('edit-doctor-modal')


@endsection