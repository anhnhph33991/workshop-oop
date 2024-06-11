@extends('layouts.master')
@section('title', 'Categories')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
            <div class="section-header-button">
                <a href="{{ routeAdmin('orders/create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Orders</a></div>
                <div class="breadcrumb-item">All Orders</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Orders</h2>
            <p class="section-lead">
                You can manage all orders, such as editing, deleting and more.
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
                            <h4>All Orders</h4>
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
                                        <th>Name</th>
                                        <th>SubTotal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach($orders as $order)
                                        @php
                                            $images = explode(',', $order['p_image']);
//											echo "<pre>";
//											print_r($order);
//											echo "</pre>";

											switch ($order['o_status']){
                                case "0":
                                    $status = "Cho Xac Nhan";
									$css = "";
                                    break;
                                    case "1":
                                        $status = "Da Xac Nhan";
                                    break;
                                    case "2":
                                        $status = "Dang Chuan Bi Hang";
                                    break;
                                    case "3":
                                        $status = "Dang Giao Hang";
                                    break;
                                    case "4":
                                        $status = "Da Giao Hang";
                                    break;
                                    case "5":
                                        $status = "Da Huy";
                                    break;
                                    case "6":
                                        $status = "Hoan Hang";
                                    break;

                            }

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
                                                         data-image="{{ routeClient($images[0]) }}"
                                                         data-title="{{ $order['od_productName'] }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $order['od_productName'] }}
                                            </td>
                                            <td>
                                                {{ number_format(($order['od_priceOffer'] ?: $order['od_price']) * $order['od_qty']) }}
                                            </td>
                                            <td>
                                                <div class="badge badge-primary">
                                                    {{ $status }}
                                                </div>
                                            </td>
                                            <td>
                                                {{--                                                <div class="badge badge-primary">Published</div>--}}
                                                <a href="{{ routeAdmin("orders/" . $order['od_id']) }}"
                                                   class="btn btn-secondary"
                                                   data-toggle="tooltip" data-placement="bottom"
                                                   data-original-title="Show">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a href="{{ routeAdmin('orders/' . $order['od_id'] . '/edit') }}"
                                                   class="btn btn-warning" data-toggle="tooltip" data-placement="bottom"
                                                   data-original-title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ routeAdmin('orders/' . $order['od_id'] . '/delete') }}"
                                                   class="btn btn-danger"
                                                   onclick="return confirm('Bạn có chắc muốn xóa: {{ $order['od_productName'] }} ?')"
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
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
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
