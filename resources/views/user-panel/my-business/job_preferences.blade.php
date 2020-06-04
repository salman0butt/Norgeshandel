@extends('layouts.landingSite')

@section('style')
    <link href="{{ asset('public/admin/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page_content')
@php
    $job_function = \App\Taxonomy::where('slug', 'job_function')->first();
    $job_functions = $job_function->terms()->orderBy('name','ASC')->get();
@endphp
<main class="job-preferences">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mine jobb-preferanser</li>
                </ol>
            </nav>
        </div>
        <!---- end breadcrumb----->
        <div class="panel u-mb32" id="main-content">
            <h2 class="mb-5">Mine jobb-preferanser</h2>
            <p class="u-mb16" style="font-weight:600;">Jobb preferanser</p>
            <p class="u-mb16">Her kan la bedriftene finne deg relatert til dine jobb preferanser. Husk til enhver tid å ha oppdaterte
                preferanser slik at du er et steg nærmere drømme jobben din!</p>
        </div>

        <div class="panel" style="margin-bottom: 80px">
            <form>
                @csrf
                <div class="u-mb32 form-group">
                    <div class="input input--text u-mb8"><label for="keywords-input" class="u-t5">Dine preferanser</label>
                        <div class="u-position-relative" style="display: block;">
                            <select class="form-control select2" id="functions" name="functions[]"
                                    required multiple="">
                                @if($job_functions->count() > 0)
                                    @foreach($job_functions as $job_function)
                                        <option>{{$job_function->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="u-mb32 form-group">
                    <div class="input input--text u-mb8">
                        <label for="geo-region-input" class="u-t5">Hvor?</label>
                        <div class="u-position-relative" style="display: block;">
                            <input id="geo-region-input" type="text" role="combobox" aria-autocomplete="list" aria-expanded="false" autocomplete="off" value="" class="dme-form-control">
                        </div>
                    </div>
                </div>

                <div class="u-mb32 form-group">
                    <label>Hva ønsker du informasjon om?</label>
                    <div class="input-toggle">
                        <input id="notification_option_3" type="checkbox" class="mrs">
                        <label class="" for="notification_option_3">Nyheter om bedriften</label>
                    </div>
                    <div class="input-toggle">
                        <input id="notification_option_2" type="checkbox" class="mrs">
                        <label class="" for="notification_option_2">Arrangementer</label>
                    </div>
                </div>

                <div class="u-mb32 form-group">
                    <div class="input input--text u-mb8">
                        <button type="submit" class="dme-btn-outlined-blue float-left">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel u-d1 u-stone">
        </div>


    </div>
</main>
@endsection

@section('script')
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/select2.full.min.js') }}"></script>
    <script>
        $(".select2").select2();
    </script>
@endsection
