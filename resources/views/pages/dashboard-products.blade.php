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
        <h2 class="dashboard-title">My Products</h2>
        <p class="dashboard-subtitle">Manage it well and get money</p>
        </div>
        <div class="dashboard-content">
        <div class="row">
            <div class="col-12">
            <a
                href="{{ route('dashboard-product-create') }}"
                class="btn btn-success"
                >Add New Product</a
            >
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($products as $itemProduct)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a
                    href="{{ route('dashboard-product-details', $itemProduct->id) }}"
                    class="card card-dashboard-product d-block"
                >
                    <div class="card-body">
                    <img
                        src="{{ Storage::url($itemProduct->galleries->first()->photos ?? '') }}"
                        alt=""
                        class="w-100 mb-2"
                    />
                    <div class="product-title">{{ $itemProduct->name ?? '' }}</div>
                    <div class="product-category">{{ $itemProduct->category->name ?? '' }}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        </div>
    </div>
    </div>

@endsection
