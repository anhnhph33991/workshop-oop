@extends('layouts.master')
@section('title', 'Users')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-button">
                <a href="{{ routeAdmin('users/create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Users</a></div>
                <div class="breadcrumb-item">All Users</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Users</h2>
            <p class="section-lead">
                You can manage all Users, such as editing, deleting and more.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ routeAdmin('users') }}">
                                        All
                                        <span class="badge badge-white">5</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ routeAdmin('users?a=1') }}">
                                        Active
                                        <span class="badge badge-primary">1</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ routeAdmin('users?a=0') }}">
                                        IsActive
                                        <span class="badge badge-primary">1</span>
                                    </a>
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
                            <h4>All Posts</h4>
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
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Active</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($users as $user)
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
                                                         data-image="{{ routeClient($user['image'] ?? 'assets/uploads/avatar.jpg') }}"
                                                         data-title="{{ $user['username'] }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $user['username'] ?? 'No Data' }}
                                            </td>
                                            <td>
                                                {{ $user['email'] ?? "No Data" }}
                                            </td>
                                            <td>
                                                {{ $user['address'] ?? "No Data" }}
                                            </td>
                                            <td>
                                                <div class="badge
                                                {{ $user['is_active'] == 1 ? 'badge-primary' : 'badge-danger' }}"
                                                >
                                                    {{ $user['is_active'] == 1 ? 'Active' : 'Inactive' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="badge
                                                {{ $user['role'] == 1 ? 'badge-primary' : 'badge-info' }}"
                                                >
                                                    {{ $user['role'] == 1 ? 'Admin' : 'User' }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ routeAdmin("users/" . $user['id']) }}"
                                                   class="btn btn-secondary"
                                                   data-toggle="tooltip" data-placement="bottom"
                                                   data-original-title="Show">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a href="{{ routeAdmin('users/' . $user['id'] . '/edit') }}"
                                                   class="btn btn-warning" data-toggle="tooltip" data-placement="bottom"
                                                   data-original-title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ routeAdmin('users/' . $user['id'] . '/delete') }}"
                                                   class="btn btn-danger"
                                                   onclick="return confirm('Bạn có chắc muốn xóa: {{ $user['username'] }} ?')"
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
                                            <a class="page-link" href="{{ prevPage('users', $page) }}"
                                               aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        @for($i = 1; $i <= $totalPage; $i++)
                                            <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                   href="{{ routeAdmin('users?page=' . $i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ $page == $totalPage ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ nextPage('users', $page, $totalPage) }}"
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
