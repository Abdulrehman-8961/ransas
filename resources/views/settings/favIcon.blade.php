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
                <form action="{{ url('/Fav-Icon/Save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="name" class="form-label">נושא</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" value="{{ @$template->subject }}" name="file"
                                id="file">
                        </div>
                    </div>
                    <div>
                        <a href="{{ url('/Fav-Icon/Delete') }}" class="btn btn-danger mt-2">לִמְחוֹק</a>
                        <button type="submit" class="btn btn-primary mt-2">שמור שינויים</button>
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
