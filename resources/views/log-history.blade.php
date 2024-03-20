@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">History</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">History/logs</li>
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
                        <form class="position-relative">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control daterange">

                                <span class="input-group-text">
                                    <i class="ti ti-calendar fs-5"></i>
                                </span>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                    <div
                        class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <div class="action-btn show-btn" style="display: none">
                            <a href="javascript:void(0)"
                                class="delete-multiple btn-light-danger btn me-2 text-danger d-flex align-items-center font-medium">
                                <i class="ti ti-trash text-danger me-1 fs-5"></i> Delete All Row
                            </a>
                        </div>

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
                                <th>User</th>
                                <th>Page</th>

                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            if (Auth::user()->role == "Admin") {
                                $history = DB::table('log_history')->get();
                            } else {
                                $history = DB::table('log_history')->where('user_id', Auth::user()->id)->get();
                            }
                            @endphp
                            <!-- start row -->
                            @foreach ($history as $row)
                            @php
                                $user = DB::table('users')->where('id',$row->user_id)->first();
                            @endphp
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $row->page }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ date('Y-m-d',strtotime($row->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
