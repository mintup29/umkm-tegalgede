@extends('layouts.dashboard')

@section('title')
    Store Dashboard
@endsection

@section('content')
<!-- Section Content -->
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
    <div class="dashboard-heading">
    <h2 class="dashboard-title">Dashboard</h2>
    <p class="dashboard-subtitle">
        Dashboard Admin
    </p>
    </div>
    <div class="dashboard-content">
    <div class="row">
        <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
            <div class="dashboard-card-title">
                Customer
            </div>
            <div class="dashboard-card-subtitle">
                {{ number_format($customer) }}
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
            <div class="dashboard-card-title">
                Jumlah Produk
            </div>
            <div class="dashboard-card-subtitle">
                {{ number_format($sum_product) }}
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
            <div class="dashboard-card-title">
                Jumlah Kategori
            </div>
            <div class="dashboard-card-subtitle">
                {{ number_format($sum_category) }}
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 mt-2">
            <h5 class="mb-3">Produk Terbaru</h5>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Foto
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Tanggal Upload
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <img
                                src="{{ Storage::url($product->galleries->first()->photos ?? '') }}"
                                class="w-10"
                            />
                        </td>
                        <td>{{ $product->name}}</td>
                        <td>{{ $product->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                
        </div>
    </div>
    </div>
</div>
</div>
@endsection