@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product
@endsection

@section('content')
    <!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Daftar Kategori</h2>
                <p class="dashboard-subtitle">
                  
                </p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    <a
                      href="{{ route('dashboard-category-create') }}"
                      class="btn btn-primary"
                      >Tambah Kategori Baru</a
                    >
                  </div>
                </div>
                <div class="row mt-4">

                  @foreach ($categories as $category)
                      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a
                          href="{{ route('dashboard-category-details', $category->id) }}"
                          class="card card-dashboard-product d-block"
                        >
                          <div class="card-body">
                            <img
                              src="{{ Storage::url($category->photo ?? '') }}"
                              alt=""
                              class="w-100 mb-2"
                            />
                            <div class="product-title">{{ $category->name }}</div>
                            
                          </div>
                        </a>
                      </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>
@endsection