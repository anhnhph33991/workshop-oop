@extends('layouts.master')
@section('title', 'Products')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
            <div class="section-header-button">
                <a href="{{ routeAdmin('products/create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ routeAdmin() }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ routeAdmin('products') }}">Products</a></div>
                <div class="breadcrumb-item">All Products</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Products</h2>
            <p class="section-lead">
                You can manage all product, such as editing, deleting and more.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">All <span class="badge badge-white">5</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Draft <span class="badge badge-primary">1</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pending <span class="badge badge-primary">1</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Trash <span class="badge badge-primary">0</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                <select class="form-control selectric">
                                    <option>Action For Selected</option>
                                    <option>Move to Draft</option>
                                    <option>Move to Pending</option>
                                    <option>Delete Pemanently</option>
                                </select>
                            </div>
                            <div class="float-right">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-center pt-2">
                                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                       data-checkbox-role="dad"
                                                       class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Image</th>
{{--                                        <th>Sku</th>--}}
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                    {{-- Start tbody--}}
                                    @foreach($products as $product)
                                        @php
                                            $image = explode(',', $product['p_image']);
//                                            echo "<pre>";
//                                            print_r($product);
//                                            echo "</pre>";
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                           class="custom-control-input" id="checkbox-2">
                                                    <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="gallery">
                                                    <div class="gallery-item"
                                                         data-image="{{ routeClient($image[0]) }}"
                                                         data-title="{{ $product['p_name'] }}">
                                                    </div>
                                                </div>
                                            </td>
{{--                                            <td>--}}
{{--                                                {{ $product['sku'] }}--}}
{{--                                            </td>--}}
                                            <td>
                                                {{ formatStrlen($product['p_name'], 20, 10) }}
                                            </td>
                                            <td>
                                                {{ formatPrice($product['price_offer'] ?: $product['price']) . 'đ'}}
                                            </td>
                                            <td>
                                                {{ $product['quantity'] }}
                                            </td>
                                            <td>
                                                {{ $product['c_name'] }}
                                            </td>
                                            <td>
                                                <div class="badge badge-primary
                                                {{ $product['status'] == 1 ? 'badge-primary' : 'badge-danger' }}">
                                                    {{ $product['status'] == 1 ? 'Published' : 'Draft' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="badge badge-primary
                                                {{ $product['type'] == 1 ? 'badge-danger' : 'badge-primary' }}">
                                                    {{ $product['type'] == 1 ? 'Sale' : 'No Sale' }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ routeAdmin("products/" . $product['p_id']) }}"
                                                   class="btn btn-secondary"
                                                   data-toggle="tooltip" data-placement="bottom"
                                                   data-original-title="Show">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a href="{{ routeAdmin('products/' . $product['p_id'] . '/edit') }}"
                                                   class="btn btn-warning" data-toggle="tooltip" data-placement="bottom"
                                                   data-original-title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ routeAdmin('products/' . $product['p_id'] . '/delete') }}"
                                                   class="btn btn-danger"
                                                   onclick="return confirm('Bạn có chắc muốn xóa: {{ $product['p_name'] }} ?')"
                                                   data-toggle="tooltip" data-placement="bottom"
                                                   data-original-title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item {{ $page == 1 ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ prevPage('products', $page) }}"
                                               aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $totalPage; $i++)
                                            <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                   href="{{ routeAdmin('products?page=' . $i) }}"
                                                >
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ $page == $totalPage ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ nextPage('products', $page, $totalPage) }}"
                                               aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('admin/js/page/features-posts.js') }}"></script>
@endsection
