@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Detail
@endsection

@section('content')
<!-- Section Content -->
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Edit Produk</h2>
      <p class="dashboard-subtitle">
        Detail Produk
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
          <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
            <div class="card">
              <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Toko</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $product->store }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor HP</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $product->phone_number }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Produk</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $product->name }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Harga</label>
                      <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ $product->price }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="categories_id" class="form-control">
                        <option value="{{ $product->categories_id }}">Tidak diganti ({{ $product->category->name }})</option>
                        @foreach ($categories as $categories)
                          <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button
                      type="submit"
                      class="btn btn-primary px-5 btn-block"
                    >
                      Simpan Sekarang
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                @foreach ($product->galleries as $gallery)
                  <div class="col-md-4">
                    <div class="gallery-container">
                      <img
                        src="{{ asset('/storage/' . $gallery->photos) }}" alt="produk"
                        
                        alt="product"
                        class="w-100"
                      />
                      <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                        <img src="/images/icon-delete.svg" alt="" />
                      </a>
                    </div>
                  </div>
                @endforeach
                <div class="col-12">
                  <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" name="products_id">
                    <input
                      type="file"
                      name="photos"
                      id="file"
                      style="display: none;"
                      multiple
                      onchange="form.submit()"
                    />
                    <button
                      type="button"
                      class="btn btn-secondary btn-block mt-3"
                      onclick="thisFileUpload()"
                    >
                      Tambah Foto
                    </button>
                  </form>
                </div>
                <div class="card">
                <div class="card-body">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('dashboard-product-details-delete', $product->id) }}" class="delete-product" data-id="{{ $product->id }}">
                      <button
                          type="submit"
                          class="btn btn-danger px-5 btn-block"
                          
                        >
                          Hapus
                        </button>
                      </a>
                    </div>
                  </div>
                  </div>
                  </div>
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
    const deleteButtons = document.querySelectorAll('.delete-product');

    // Add a click event listener to each delete button
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const productId = this.getAttribute('data-id');

            // Show the SweetAlert confirmation modal
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Anda akan mengahapus produk ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus ini!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to deleteGallery route
                    window.location.href = `/dashboard/products/delete/${productId}`;
                }
            });
        });
    });
</script>
@endpush