<h2 class="u-t4">Lagrede søk</h2>
<ul>
    @if (Auth::check())
        @if (isset($saved_search) && $saved_search->count() > 0)
            @foreach($saved_search as $search)
                <li><a href="{{!empty($search->filter)?url($search->filter):"#"}}">{{ $search->name }}</a></li>
            @endforeach
                <li><a href="javascript:void(0);" class="clear_searches_link" data-search_type="saved" data-action="{{route('clear-searches')}}" style="font-weight: 500">Tøm lista</a></li>
        @else
            <li><p class="u-d1">Det er ingen lagrede søk</p></li>
        @endif
    @else
        <p class="u-d1"><a href="{{url('/login')}}">Logg inn</a> for å vise dine lagrede søk</p>
    @endif
</ul>

<h2 class="u-t4">Siste søk</h2>
<ul>
    @if (Auth::check())
        @if (isset($recent_search) && $recent_search->count() > 0)
            @foreach($recent_search as $recent)
                <li><a href="{{url(htmlspecialchars($recent->filter))}}">{{ $recent->name }}</a></li>
            @endforeach
                <li><a href="javascript:void(0);" class="clear_searches_link" data-search_type="recent" data-action="{{route('clear-searches')}}" style="font-weight: 500">Tøm lista</a></li>
        @else
            <p class="u-d1">Det er ingen nylig søk</p>
        @endif
    @else
        <p class="u-d1"><a href="{{ url('/login') }}">Logg inn</a> for å vise dine siste søk her</p>
    @endif
</ul>


