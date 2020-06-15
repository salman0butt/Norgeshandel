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
                    <h5>Annonse Tittel: </h5>
                    <h4>{{$ad->getTitle()}}</h4>
                    <h5>Rangering Bruker: </h5>
                    <h4>
                        @if($ad->user_id == Auth::id() && $ad->sold_to_user->count() > 0)
                            {{$ad->sold_to_user->first()->username ? $ad->sold_to_user->first()->username : 'NH-Bruker'}}
                        @endif

                        @if($ad->user_id != Auth::id() && $ad->user)
                            {{$ad->user->username ? $ad->user->username : 'NH-Brkuer'}}
                        @endif
                    </h4>
                    <form action="{{route('ratings-store',$ad->id)}}" method="POST">
                        @csrf
                        <div class="">
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

                            <button class="dme-btn-outlined-blue mb-3 col-12">Send inn</button>
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