@php
    $search = '';
    if(Request::get('search')){
        //$search = 'search='.Request::get('search');
    }
@endphp
@if($col == 'grid')
    <a href="?view=list" data-view="list" class="dme-btn-rounded-back-only" id="view">
        <i class="fa fa-list"></i>
    </a>
@else
    <a href="?view=grid" data-view="grid" class="dme-btn-rounded-back-only" id="view">
        <i class="fas fa-th"></i>
    </a>
@endif
