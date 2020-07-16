
@extends('layouts.landingSite')

@section('page_content')
    @php
        $record_type = 'create';
        if(Request::is('my-business/company-agents/*/edit')){
            $record_type = 'edit';
        }
    @endphp
    <main>
        <div class="dme-container col-12">
            <div class="row">
                <div class="col-md-10 offset-md-1 my-5">
                    @include('common.partials.flash-messages')
                    <form class="main-form-mobile" action="@if(Request::is('my-business/company-agents/*/edit')) {{route('company-agents.update',$agent->id)}} @else {{route('company-agents.store')}} @endif" method="post" id="company_agent" enctype="multipart/form-data">
                        <h2 class="text-muted">{{$agent->name ? 'Oppdater' : 'Opprett'}} ansatt profil</h2>
                        @if(Request::is('my-business/company-agents/*/edit'))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="">

                            <div class="form-group">
                                <label class="u-t5">Selskaper</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <select name="created_by_company_id" id="company_type" type="text"
                                                class="form-control dme-form-control" {{$record_type == 'create' ? 'required' : ''}}>
                                            @if($record_type == 'create')
                                                <option value="">Velg...</option>
                                            @endif
                                            @if(Auth::user()->companies)
                                                @foreach(Auth::user()->companies as $company)
                                                    <option value="{{$company->id}}" {{$agent && $agent->created_by_company_id == $company->id ? 'selected' : ''}} {{$record_type == 'edit' ? 'disabled' : ''}}>{{$company->emp_name}} ({{$company->company_type}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="u-t5">E-post</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input id="email" type="email" class="dme-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$agent->email) }}" required autocomplete="email" {{$record_type == 'edit' ? 'disabled' : ''}}>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Passord</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="password" value="" class="dme-form-control" {{$record_type == 'edit' ? 'disabled' : ''}} {{$record_type == 'create' ? 'required' : ''}}/>
                                        <span class="error-span name"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Stilling</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="position" value="{{$agent->position}}" class="dme-form-control" required/>
                                        <span class="error-span position"></span>
                                    </div>
                                </div>
                            </div>

                            <button class="dme-btn-outlined-blue mb-3 col-12">{{$agent->name ? 'Oppdater' : 'Legg til'}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

@endsection