@extends('layouts.navigator')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Update Patient</h6>
                    </div>
                </div>
                <div class="card-body px-6 pb-2">
                    <form method="POST" action="{{ route('userlist.update.patient', ['id' => $patient->user->id]) }}">
                        @csrf
                        @method('PUT')
            
                        <!-- Your existing doctor data -->
                        <!-- You can use the values from the database to pre-fill the form fields -->
            
                        <div class="mb-3">
                        <label for="update_name" class="form-label">{{ __('Name') }}</label>
                        <input id="update_name" type="text" class="form-control @error('name') is-invalid @enderror" name="update_name" value="{{ $patient->user->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                        <label for="update_email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="update_email" type="email" class="form-control @error('update_email') is-invalid @enderror" name="update_email" value="{{ $patient->user->email }}" required autocomplete="email">
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
                        <label for="update_address" class="form-label">{{ __('Alamat') }}</label>
                        <textarea id="update_address" class="form-control @error('address') is-invalid @enderror" name="update_address" required>{{ $patient->address }}</textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
            
                        <div class="mb-3">
                            <label for="update_birth_date" class="form-label">{{ __('Tanggal Lahir') }}</label>
                            <input id="update_birth_date" type="date" class="form-control @error('update_birth_date') is-invalid @enderror" name="update_birth_date" value="{{ $patient->birth_date }}" required>
                            @error('update_birth_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                        <label for="update_phone" class="form-label">{{ __('Nomor Telepon') }}</label>
                        <input id="update_phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="update_phone" value="{{ $patient->phone }}" required>
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
                        <a href="{{route('userlist.patient')}}" class="btn btn-secondary">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
