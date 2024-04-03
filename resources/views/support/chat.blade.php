@extends('layouts.dashboard')
@section('content')
    @php
        $ticket_details = DB::table('chat')
            ->where('ticket_id', $ticket->id)
            ->get();
    @endphp
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
                <div class="d-flex justify-content-between">
                    <div>#{{ $ticket->ticket_no }} <span class="ms-3">{{ $ticket->title }}</span></div>
                    <div>{{ $ticket->status }}</div>
                </div>
            </div>
        </div>
        @foreach ($ticket_details as $row)
            @php
                $user = DB::table('users')
                    ->where('id', $row->from_id)
                    ->first();
            @endphp
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted d-flex align-items-center">{{ $user->email }}</h6>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted d-flex align-items-center">
                                {{ date('d.m.Y', strtotime($row->created_at)) }}</h6>
                            <h6 class="card-subtitle mb-2 text-muted d-flex align-items-center">
                                {{ date('H:i', strtotime($row->created_at)) }}</h6>
                        </div>
                    </div>
                    <p class="card-text pt-2">
                        {{ $row->description }}
                    </p>
                </div>
            </div>
        @endforeach
        <div class="card w-100 position-relative overflow-hidden">
            <div class="card-body">
                <form action="{{ url('Send-message') }}/{{ $ticket->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for=""> Description</label>
                            <textarea rows="5" class="form-control" name="description"></textarea>
                        </div>
                        <div class="col-3 mb-3">
                            <input type="file" class="form-control" id="file" name="file[]" multiple="true"/>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-lg-4 mt-3">
                            <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
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
