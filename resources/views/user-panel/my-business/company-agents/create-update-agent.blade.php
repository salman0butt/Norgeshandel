@extends('layouts.landingSite')

@section('page_content')
    @php
        $record_type = 'create';
        if(Request::is('my-business/company-agents/*/edit')){
            $record_type = 'edit';
        }
    @endphp
    <main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-10 offset-md-1 mt-5 mb-5">
                    @include('common.partials.flash-messages')
                    <h2 class="text-muted">{{$agent->name ? 'Oppdater' : 'Opprett'}} megler profil</h2>

                    <form action="@if(Request::is('my-business/company-agents/*/edit')) {{route('company-agents.update',$agent->id)}} @else {{route('company-agents.store')}} @endif" method="post" id="company_agent" enctype="multipart/form-data">
                        @if(Request::is('my-business/company-agents/*/edit'))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="">
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
                                        <input type="text" name="password" value="" class="dme-form-control" {{$record_type == 'edit' ? 'disabled' : ''}}/>
                                        <span class="error-span name"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Stilling</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="position" value="{{$agent->position}}" class="dme-form-control"/>
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