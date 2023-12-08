@extends('layouts.navigator')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
      <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
      <div class="row gx-4 mb-2">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <img src="{{ asset('template/assets/img/bruce-mars.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{ auth()->user()->name }}
            </h5>
            <p class="mb-0 font-weight-normal text-sm">
              {{ auth()->user()->role }}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="row">
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Profile Information</h6>
                  </div>
                  <div class="col-md-4 text-end">
                    <a href="javascript:;">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <p class="text-sm">
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae facere nam nisi nihil voluptates consequuntur. Quisquam, voluptate. Quisquam, voluptate.
                </p>
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                    @if (auth()->user()->role == 'doctor')         
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ auth()->user()->name }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ auth()->user()->email }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Spesialist:</strong> &nbsp; {{ auth()->user()->doctor->spesialist }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telepon:</strong> &nbsp; {{ auth()->user()->doctor->phone }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat:</strong> &nbsp; {{ auth()->user()->doctor->address }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Hari Kerja:</strong> &nbsp; {{ auth()->user()->doctor->active_day }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Jam Mulai:</strong> &nbsp; {{ auth()->user()->doctor->start_hour }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Jam Selesai:</strong> &nbsp; {{ auth()->user()->doctor->end_hour }}</li>
                    @endif
                    @if (auth()->user()->role == 'pharmacist')         
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ auth()->user()->name }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ auth()->user()->email }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telepon:</strong> &nbsp; {{ auth()->user()->pharmacist->phone }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat:</strong> &nbsp; {{ auth()->user()->pharmacist->address }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address:</strong> &nbsp; {{ auth()->user()->pharmacist->birth_date }}</li>
                    @endif
                    @if (auth()->user()->role == 'patient')         
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ auth()->user()->name }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ auth()->user()->email }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telepon:</strong> &nbsp; {{ auth()->user()->patient->phone }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat:</strong> &nbsp; {{ auth()->user()->patient->address }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tanggal Lahir:</strong> &nbsp; {{ auth()->user()->patient->birth_date }}</li>
                    @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
