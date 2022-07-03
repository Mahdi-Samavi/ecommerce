@extends('admin.layouts.main')

@section('title', __('Products'))

@section('plugin-style')
  <link rel="stylesheet" href="{{ asset('admin/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
@endsection

@section('content')
  @if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <div class="card">
    <div class="card-body">
      <div class="card-title">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-rounded btn-icon">
          <i class="ti-plus"></i> {{ __('New product') }}
        </a>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Image') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Reference') }}</th>
                  <th>{{ __('Price') }}</th>
                  <th>{{ __('Quantity') }}</th>
                  <th>{{ __('Active') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset('storage/images/p') . '/' . $product->id . '/' . $product->cover }}" alt="{{ $product->name }}"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->reference }}</td>
                    <td class="product-price">@price($product->regular_price)</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                      <a href="{{ route('admin.products.change-status', $product) }}"
                        data-text-inactive="{{ __('Disable') }}"
                        data-text-active="{{ __('Enable') }}"
                        onclick="updateStatus('{{ $product->id }}')"
                        class="badge badge-{{ $product->active ? 'success' : 'danger' }}">
                        @if ($product->active)
                          <i class="mdi mdi-check"></i> {{ __('Enable') }}
                        @else
                          <i class="mdi mdi-close"></i> {{ __('Disable') }}
                        @endif
                      </a>
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary"><i class="mdi mdi-pencil"></i> {{ __('Edit') }}</a>
                        <button id="product-{{ $loop->iteration }}" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-haspop="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="product-{{ $loop->iteration }}">
                          <button class="dropdown-item" onclick="remove('{{ $product->id }}')"><i class="mdi mdi-delete"></i> {{ __('Delete') }}</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr class="border-0">
                    <td colspan="7" class="border-0 text-center p-0 pt-4"><i class="mdi mdi-alert fs-2"></i></td>
                  </tr>
                  <tr class="border-0">
                    <td colspan="7" class="text-center p-2">{{ __('No records found.') }}</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            {{ $products->links('admin.partials.pagination') }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('plugin-script')
  <script src="{{ asset('admin/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
@endsection

@section('script')
  <script src="{{ asset('admin/js/toastDemo.js') }}"></script>
  <script src="{{ asset('admin/js/desktop-notification.js') }}"></script>
  <script src="{{ asset('admin/js/data-table.js') }}"></script>
@endsection