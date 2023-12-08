@extends('layouts.navigator')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
              <h6 class="text-white text-capitalize ps-3">Table Obat</h6>
              <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                  <label class="form-label">Type here...</label>
                  <input type="text" class="form-control" id="searchInput" onkeypress="handleKeyPress(event)">
                </div>
              </div>
              <a href="" class="btn btn-sm btn-light d-flex align-items-center" style="margin-bottom: 0; margin-right: 20px" data-bs-toggle="modal" data-bs-target="#registerMedicineModal">
                <span class="material-symbols-outlined me-2">add</span>
                Tambah Obat
              </a>
              
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
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medicines as $medicine)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{ asset('template') }}/assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $medicine->drug_name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $medicine->netto }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $medicine->type }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $medicine->description }}</p>
                      </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $medicine->price }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="ms-auto text-end">
                        <form action="" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Apakah kamu yakin menghapus obat ini dari daftar?')">
                              <i class="material-icons text-sm me-2">delete</i>Delete
                          </button>
                        </form>                      
                        <a class="btn btn-link text-dark px-3 mb-0" href=""><i class="material-icons text-sm me-2">edit</i>Edit</a>
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
@endsection