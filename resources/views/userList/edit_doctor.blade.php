@extends('layouts.navigator')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Update Dokter</h6>
                    </div>
                </div>
                <div class="card-body px-6 pb-2">
                    <form method="POST" action="{{ route('userlist.update.doctor', ['id' => $doctor->user->id]) }}">
                        @csrf
                        @method('PUT')
            
                        <!-- Your existing doctor data -->
                        <!-- You can use the values from the database to pre-fill the form fields -->
            
                        <div class="mb-3">
                        <label for="update_name" class="form-label">{{ __('Name') }}</label>
                        <input id="update_name" type="text" class="form-control @error('name') is-invalid @enderror" name="update_name" value="{{ $doctor->user->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="update_email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="update_email" type="email" class="form-control @error('update_email') is-invalid @enderror" name="update_email" value="{{ $doctor->user->email }}" required autocomplete="email">
                        @error('update_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="update_password" class="form-label">{{ __('New Password') }}</label>
                        <input id="update_password" type="password" class="form-control @error('password') is-invalid @enderror" name="update_password" autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm New Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
            
                        <div class="mb-3">
                        <label for="update_specialization" class="form-label">{{ __('Spesialisasi') }}</label>
                        <input id="update_specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="update_specialization" value="{{ $doctor->spesialist }}" required autocomplete="specialization">
                        @error('specialization')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="update_address" class="form-label">{{ __('Alamat') }}</label>
                        <textarea id="update_address" class="form-control @error('address') is-invalid @enderror" name="update_address" required>{{ $doctor->address }}</textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="update_active_day" class="form-label">{{ __('Hari Kerja') }}</label>
                        <select id="update_active_day" class="form-select @error('active_day') is-invalid @enderror" name="update_active_day" required>
                            <option value="1" {{ $doctor->active_day == 1 ? 'selected' : '' }}>Senin</option>
                            <option value="2" {{ $doctor->active_day == 2 ? 'selected' : '' }}>Selasa</option>
                            <option value="3" {{ $doctor->active_day == 3 ? 'selected' : '' }}>Rabu</option>
                            <option value="4" {{ $doctor->active_day == 4 ? 'selected' : '' }}>Kamis</option>
                            <option value="5" {{ $doctor->active_day == 5 ? 'selected' : '' }}>Jumat</option>
                            <option value="6" {{ $doctor->active_day == 6 ? 'selected' : '' }}>Sabtu</option>
                            <option value="0" {{ $doctor->active_day == 0 ? 'selected' : '' }}>Minggu</option>
                        </select>
                        @error('active_day')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="update_start_hour" class="form-label">{{ __('Jam Mulai Kerja') }}</label>
                        <input id="update_start_hour" type="time" class="form-control @error('start_hour') is-invalid @enderror" name="update_start_hour" required value="{{ $doctor->start_hour }}">
                        @error('start_hour')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="update_end_hour" class="form-label">{{ __('Jam Berakhir Kerja') }}</label>
                        <input id="update_end_hour" type="time" class="form-control @error('end_hour') is-invalid @enderror" name="update_end_hour" required value="{{ $doctor->end_hour }}">
                        @error('end_hour')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                        <label for="update_phone" class="form-label">{{ __('Nomor Telepon') }}</label>
                        <input id="update_phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="update_phone" value="{{ $doctor->phone }}" required>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-0">
                        <button type="submit" class="btn btn-primary">
                            Update
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
</div>
@endsection
