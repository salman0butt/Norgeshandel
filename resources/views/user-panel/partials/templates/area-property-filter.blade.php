@if(!Request::is('map/select-property') && !Request::is('map/select-job'))
    <div class="form-group nav-dynamic-checks property-filter-area-list">
        <h3 class="u-t5">Område</h3>
        <?php
        if (!empty($tax = App\Taxonomy::where('slug', 'states_and_cities')->first())) {
            echo App\Helpers\common::map_nav($tax->parent_terms());
        }
        ?>
    </div>
@endif