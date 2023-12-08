@extends('layouts.navigator')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
              <h6 class="text-white text-capitalize ps-3">Table Pasien</h6>
              <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                  <label class="form-label">Type here...</label>
                  <input type="text" class="form-control" id="searchInput" onkeypress="handleKeyPress(event)">
                </div>
              </div>
              <a href="{{route('userlist.patient.register')}}" class="btn btn-sm btn-light d-flex align-items-center" style="margin-bottom: 0; margin-right: 20px" data-bs-toggle="modal" data-bs-target="#registerPatientModal">
                <span class="material-symbols-outlined me-2">add</span>
                Register Pasien
              </a>
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
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
                          <h6 class="mb-0 text-sm">{{ $patient->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $patient->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs text-center font-weight-bold mb-0">{{ $patient->address }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $patient->birth_date }}</p>
                      </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $patient->phone }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="ms-auto text-end">
                        <form action="{{ route('userlist.delete.patient', ['id' => $patient->id]) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Are you sure you want to delete this user?')">
                              <i class="material-icons text-sm me-2">delete</i>Delete
                          </button>
                        </form>                      
                        <a class="btn btn-link text-dark px-3 mb-0" href="{{route('userlist.edit.patient', ['id' => $patient->id])}}"><i class="material-icons text-sm me-2">edit</i>Edit</a>
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

<!-- Register Patient Modal -->
<div class="modal fade" id="registerPatientModal" tabindex="-1" aria-labelledby="registerPatientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerPatientModalLabel">Register Patient</h5>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('userlist.patient.register') }}">
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
            <label for="address" class="form-label">{{ __('Alamat') }}</label>
            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address') }}</textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="birth_date" class="form-label">{{ __('Tanggal Lahir') }}</label>
            <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
            @error('birth_date')
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
@endsection