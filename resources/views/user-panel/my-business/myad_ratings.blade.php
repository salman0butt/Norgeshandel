@extends('layouts.landingSite')
@section('page_content')
    <main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-10 offset-md-1 mt-5 mb-2">
                    <h2 class="text-muted">Rangeringer og anmeldelser</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <form action="{{route('ratings-store',$ad->id)}}" method="POST">
                        @csrf
                        <div class="">
                            @if($ad->message_threads->count() > 0)
                                <div class="form-group">
                                    <label class="u-t5">Velg Bruker</label>
                                    <div class="row">
                                        @foreach($ad->message_threads as $message_thread)
                                            @if($message_thread->messages->count() > 0)
                                                @if($message_thread->users->where('id','<>',Auth::id()))
                                                    @php $user = $message_thread->users->where('id','<>',Auth::id())->first();@endphp
                                                    <div class="col-md-6 input-toggle d-flex align-items-center mt-3">
                                                        <input id="{{$user->first_name}}-{{$user->id}}" type="checkbox" value="{{$user->id}}" class="radio" name="to_user_id" required>
                                                        <label class="smalltext" for="{{$user->first_name}}-{{$user->id}}">
                                                            <div class="media">
                                                                <div class="trailing-border" style="height: 100px; width:100px;
                                                                        background-image: url('@if($user->media) {{\App\Helpers\common::getMediaPath($user->media)}} @else{{asset('public/images/male-avatar.jpg')}}@endif');
                                                                        background-position: center; @if($user->media) background-repeat: no-repeat; background-size: 100%; @else background-size: cover;  @endif">
                                                                </div>

                                                                <div class="media-body pl-2">
                                                                    <h5 class="mt-0">{{$user->first_name.' '.$user->last_name}}{{$user->username ? ' ('.$user->username.')' : ''}}</h5>
                                                                    <p class="mb-1"><i class="fa fa-envelope fa-lg pr-1"></i>{{$user->email}}</p>
                                                                    @if($user->mobile_number)
                                                                        <p><i class="fas fa-mobile-alt fa-lg pr-1"></i>{{$user->mobile_number}}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </label>

                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="u-t5">Veldig good kommunikasjon</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                    <span class="stars">
                                        @for($i=5;$i>=1;$i--)
                                            <input class="star" id="communication_ratings_{{$i}}" type="radio" name="communication_ratings" value="{{$i*2}}" {{$i==2 ? 'checked' : ''}} required/>
                                            <label class="star" for="communication_ratings_{{$i}}"></label>
                                        @endfor
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Problemfri overlevering</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                    <span class="stars">
                                        @for($i=5;$i>=1;$i--)
                                            <input class="star " id="delivery_ratings_{{$i}}" type="radio" name="delivery_ratings" value="{{$i*2}}" {{$i==2 ? 'checked' : ''}} required/>
                                            <label class="star" for="delivery_ratings_{{$i}}"></label>
                                        @endfor
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Nøyaktig beskrivelse</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                    <span class="stars">
                                        @for($i=5;$i>=1;$i--)
                                            <input class="star " id="description_ratings_{{$i}}" type="radio" name="description_ratings" value="{{$i*2}}" {{$i==2 ? 'checked' : ''}} required/>
                                            <label class="star" for="description_ratings_{{$i}}"></label>
                                        @endfor
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Problemfri betaling</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                    <span class="stars">
                                        @for($i=5;$i>=1;$i--)
                                            <input class="star " id="payment_ratings_{{$i}}" type="radio" name="payment_ratings" value="{{$i*2}}" {{$i==2 ? 'checked' : ''}} required/>
                                            <label class="star" for="payment_ratings_{{$i}}"></label>
                                        @endfor
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Generell vurdering</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                    <span class="stars">
                                        @for($i=5;$i>=1;$i--)
                                            <input class="star " id="general_ratings_{{$i}}" type="radio" name="general_ratings" value="{{$i*2}}" {{$i==2 ? 'checked' : ''}} required/>
                                            <label class="star" for="general_ratings_{{$i}}"></label>
                                        @endfor
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="u-t5">Anmeldelser</label>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <textarea name="review" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <button class="dme-btn-outlined-blue mb-3 col-12">Sende inn</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var checkbox_required = $('input[type="checkbox"]');

            checkbox_required.prop('required', true);

            checkbox_required.on('click', function(){
                if (checkbox_required.is(':checked')) {
                    checkbox_required.prop('required', false);
                } else {
                    checkbox_required.prop('required', true);
                }
            });

            $('[type="checkbox"]').change(function(){
                if(this.checked){
                    $('[type="checkbox"]').not(this).prop('checked', false);
                }
            });

        });
    </script>
@endsection