@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">תבנית הודעה</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="{{ url('/Home') }}">
                                        לוּחַ מַחווָנִים</a></li>
                                <li class="breadcrumb-item" aria-current="page">תבנית הודעה</li>
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
        <div class="card w-100 position-relative overflow-hidden">
            <div class="card-body">
                @if (Auth::user()->role == 'Staff')
                    @php
                        $data = DB::table('ticket')
                            ->where('user_id', Auth::user()->id)
                            ->paginate(20);
                    @endphp
                    <div class="row text-end">
                        <div class="col">
                            <a href="{{ url('New-Ticket') }}" class="btn btn-primary btn-sm">הוסף כרטיס <i class="ti ti-plus me-2"></i>
                                </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap">
                            <thead class="header-item">
                                <tr>
                                    <th>כרטיסים#</th>
                                    <th style="width: 100%;">כותרת</th>
                                    <th>סטָטוּס</th>
                                    <th>נוצר ב</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr style="cursor: pointer;"
                                        onclick="window.location = '{{ url('Ticket') }}/{{ $row->id }}'">
                                        <td>{{ $row->ticket_no }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ date('d.m.Y', strtotime($row->created_at)) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
                @if (Auth::user()->role == 'Admin')
                    @php
                        $data = DB::table('ticket')->paginate(20);
                    @endphp
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap">
                            <thead class="header-item">
                                <tr>
                                    <th style="width: 80%">שאלות</th>
                                    <th>כרטיסים#</th>
                                    <th>פעולה</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    @php
                                        $user = DB::table('users')
                                            ->where('id', $row->user_id)
                                            ->first();
                                    @endphp
                                    <tr style="cursor: pointer;"
                                        onclick="window.location = '{{ url('Ticket') }}/{{ $row->id }}'">
                                        <td>
                                            <h5>{{ $row->title }}</h5>
                                            <h6 class="text-muted">{{ $user->name }} on
                                                {{ date('d.m.Y', strtotime($row->created_at)) }}</h6>
                                        </td>
                                        <td>{{ $row->ticket_no }}</td>
                                        <td onclick="event.stopPropagation()">
                                            <form id="updateStatus_{{ $row->id }}" action="{{ url('update/status') }}/{{ $row->id }}" method="post">
                                                @csrf
                                                <select name="update_status" class="form-control" id="update_status" onchange="document.getElementById('updateStatus_{{ $row->id }}').submit();">
                                                    <option value="ממתין" {{ $row->status == "ממתין" ? 'selected' : '' }}>ממתין</option>
                                                    <option value="בטיפול" {{ $row->status == "בטיפול" ? 'selected' : '' }}>בטיפול</option>
                                                    <option value="סגור" {{ $row->status == "סגור" ? 'selected' : '' }}>סגור</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>


    </div>
@endsection

@section('javascript')
    <script>
        $(document).on('change', '#role', function() {
            var role = $('#role option:selected').val();
            if (role == 'Admin') {
                $('#permission').parent().addClass('d-none');
                $('#pool').parent().addClass('d-none');
            } else {
                $('#permission').parent().removeClass('d-none');
                $('#pool').parent().removeClass('d-none');
            }
        })
    </script>
@endsection
