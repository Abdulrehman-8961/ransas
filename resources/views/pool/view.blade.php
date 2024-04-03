@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8"> בריכות</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Home') }}">לוּחַ מַחווָנִים</a></li>
                                <li class="breadcrumb-item" aria-current="page"> בריכות</li>
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
                    <div class="col-md-4 col-xl-3 d-flex">
                        <form class="position-relative" id="search-form" action="{{ url()->current() }}" method="GET">
                            <input type="text" name="search" id="search" class="form-control product-search ps-5"
                                id="input-search" placeholder="חיפוש משתמשים...">
                            <i
                                class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                            <button type="button" onclick="window.location.href='{{ url()->current() }}'"
                                class="btn btn-warning  rounded-2 ms-2">ברור</button>
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
                        <a href="{{ url('/Pool/add') }}" id="btn-add-contact"
                            class="btn btn-info d-flex align-items-center">
                            <i class="ti ti-users text-white me-1 fs-5"></i> הוסף בריכה
                        </a>
                    </div>
                </div>
            </div>
            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table search-table align-middle text-nowrap">
                        <thead class="header-item">
                            <tr>
                                <th>שֵׁם</th>
                                <th>אימייל</th>

                                <th>טלפון</th>
                                <th>פעולה</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @foreach ($users as $row)
                                <tr class="search-items">
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="ms-3">
                                                <div class="user-meta-info">
                                                    <h6 class="user-name mb-0" data-name="Emma Adams">{{ $row->name }}
                                                    </h6>
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
                                        <div class="action-btn">
                                            <a href="{{ url('/Pool/edit/' . $row->id) }}" class="text-info edit">
                                                <i class="ti ti-edit fs-5"></i>
                                            </a>
                                            <a href="{{ url('/Pool/delete/' . $row->id) }}" class="text-dark delete ms-2">
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
