@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8"> Users</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page"> Users</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="widget-content searchable-container list">
            <!-- --------------------- start Contact ---------------- -->
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <form class="position-relative" id="search-form" action="{{ url()->current() }}" method="GET">
                            <input type="text" name="search" id="search" class="form-control product-search ps-5" id="input-search"
                                placeholder="Search Contacts...">
                            <i
                                class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                        </form>
                    </div>
                    <div
                        class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <div class="action-btn show-btn" style="display: none">
                            <a href="javascript:void(0)"
                                class="delete-multiple btn-light-danger btn me-2 text-danger d-flex align-items-center font-medium">
                                <i class="ti ti-trash text-danger me-1 fs-5"></i> Delete All Row
                            </a>
                        </div>
                        <a href="{{ url('/User/add') }}" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
                            <i class="ti ti-users text-white me-1 fs-5"></i> Add Users
                        </a>
                    </div>
                </div>
            </div>
            <!-- ---------------------
                                end Contact
                            ---------------- -->
            <!-- Modal -->
            <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog"
                aria-labelledby="addContactModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h5 class="modal-title">Contact</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="add-contact-box">
                                <div class="add-contact-content">
                                    <form id="addContactModalTitle">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 contact-name">
                                                    <input type="text" id="c-name" class="form-control"
                                                        placeholder="Name">
                                                    <span class="validation-text text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 contact-email">
                                                    <input type="text" id="c-email" class="form-control"
                                                        placeholder="Email">
                                                    <span class="validation-text text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 contact-occupation">
                                                    <input type="text" id="c-occupation" class="form-control"
                                                        placeholder="Occupation">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 contact-phone">
                                                    <input type="text" id="c-phone" class="form-control"
                                                        placeholder="Phone">
                                                    <span class="validation-text text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3 contact-location">
                                                    <input type="text" id="c-location" class="form-control"
                                                        placeholder="Location">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-add" class="btn btn-success rounded-pill px-4">Add</button>
                            <button id="btn-edit" class="btn btn-success rounded-pill px-4">Save</button>
                            <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal"> Discard </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table search-table align-middle text-nowrap">
                        <thead class="header-item">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>

                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @foreach ($users as $row)
                            <tr class="search-items" style="cursor: pointer;" onclick="window.location = '{{ url('Login-to-user') }}/{{ $row->id }}'">
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="ms-3">
                                            <div class="user-meta-info">
                                                <h6 class="user-name mb-0" data-name="Emma Adams">{{ $row->name }}</h6>
                                                <span class="user-work fs-3" data-occupation="Admin">{{ $row->role }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="usr-email-addr" data-email="adams@mail.com">{{ $row->email }}</span>
                                </td>

                                <td>
                                    <span class="usr-ph-no" data-phone="+1 (070) 123-4567">{{ $row->phone }}</span>
                                </td>
                                <td>
                                    <div class="action-btn" onclick="event.stopPropagation()">
                                        <a href="{{ url('/User/edit/'.$row->id) }}" class="text-info edit">
                                            <i class="ti ti-edit fs-5"></i>
                                        </a>
                                        <a href="{{ url('/User/delete/'.$row->id) }}" class="text-dark delete ms-2">
                                            <i class="ti ti-trash fs-5"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endsection
