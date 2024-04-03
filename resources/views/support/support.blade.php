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
                @if(Auth::user()->role == "Staff")
                @php
                    $data = DB::table('ticket')->where('user_id', Auth::user()->id)->paginate(20)
                @endphp
                    <div class="row text-end">
                        <div class="col">
                            <a href="{{ url('New-Ticket') }}" class="btn btn-primary btn-sm"><i class="ti ti-plus me-2"></i> Add Ticket</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap">
                            <thead class="header-item">
                                <tr>
                                    <th>Ticket#</th>
                                    <th style="width: 100%;">Title</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                <tr style="cursor: pointer;" onclick="window.location = '{{ url('Ticket') }}/{{ $row->id }}'">
                                    <td>{{ $row->ticket_no }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>{{ date('d.m.Y',strtotime($row->created_at)) }}</td>
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
