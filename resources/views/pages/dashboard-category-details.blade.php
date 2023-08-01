@extends('layouts.dashboard')

@section('title')
    Store Dashboard Category Detail
@endsection

@section('content')
<!-- Section Content -->
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Edit Kategori</h2>
      <p class="dashboard-subtitle">
        Detail Kategori
      </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <form action="{{ route('dashboard-category-update', $categories->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Kategori</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $categories->name }}"
                      />
                    </div>
                  </div>
                </div>
                  
                <div class="row">
                  <div class="col-md-6 text-right">
                    <button
                      type="submit"
                      class="btn btn-success px-5 btn-block"
                    >
                      Simpan Sekarang
                    </button>
                  </div>
                  
                  
                </div>
              </div>
            </div>
          </form>
          <div class="card">
          <div class="card-body">
          <div class="row">
            <div class="col-md-6 text-right">
                <a href="{{ route('dashboard-category-gallery-delete', $categories->id) }}" class="delete-gallery">
                <button
                    type="submit"
                    class="btn btn-danger px-5 btn-block"
                    data-id="{{ $categories->id }}"
                  >
                    Hapus
                  </button>
                </a>
              </div>
            </div>
            </div>
            </div>
          </div>
      
      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="card-body">
                  <img
                    src="{{ Storage::url($categories->photo ?? '') }}"
                    alt=""
                    class="w-100 mb-2"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
  <script>
    CKEDITOR.replace("editor");
  </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
<script>
    // Get all elements with class 'delete-gallery'
    const deleteButtons = document.querySelectorAll('.delete-gallery');

    // Add a click event listener to each delete button
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const categoryId = this.getAttribute('data-id');

            // Show the SweetAlert confirmation modal
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Pastikan kategori ini tidak memiliki produk apapun!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus ini!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to deleteGallery route
                    window.location.href = `/dashboard-category-gallery-delete/${categoryId}`;
                }
            });
        });
    });
</script>
@endpush
