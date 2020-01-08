
<?php 
    $col='list';
?>

<div class="col-md-12">
                    <div class="<?php
                    echo $col==='grid'?'row':'' ?>">

                        @foreach ($add_array as $key => $value)

                            <?php
                                
                                $commercial_plot = App\CommercialPlot::find($value->id);
                                $name       = $commercial_plot->media;
                                if(!$name->isEmpty())
                                {
                                    $name = $commercial_plot->media->first()->name_unique;
                                    $path       = \App\Helpers\common::getMediaPath($commercial_plot);
                                    $full_path  = $path."".$name; 
                                }
                                else
                                {
                                    $full_path  = "";
                                }

                            ?>  

                            <div class="<?php echo $col==='grid'?'col-sm-4 pr-0':'' ?>">
                                <a href="{{url('/commercial/plots/ads/description', $value->id)}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                                    <div class="image-section <?php echo $col==='grid'?'col-sm-12':'col-sm-4' ?>  p-2">
                                        <div class="trailing-border">
                                            <img src="{{$full_path}}" alt="" class="img-fluid radius-8">
                                        </div>
                                    </div>
                                    <div class="detailed-section <?php echo $col==='grid'?'col-sm-12':'col-sm-8' ?> p-2">
                                        <div class="week-status u-t5 text-muted" style="">{{$commercial_plot->street_address}}</div>
                                        <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div>
                                        <div class="location u-t5 text-muted mt-2">Christian Krohgs gate 16, 0186 Oslo</div>
                                        <div class="title color-grey">{{$commercial_plot->headline}}</div>
                                        <div class="mt-2">
                                            <div class="area font-weight-bold float-left color-grey">{{$commercial_plot->plot_size}} m²</div>
                                            <div class="price font-weight-bold float-right color-grey">{{$commercial_plot->asking_price}} kr</div>
                                        </div>
                                        <br>
                                        <div class="detail u-t5 mt-3 float-left text-muted">Innlandet Næringsmegling AS</div>
                                        <div class="dealer-logo float-right mt-3" ><img src="{{asset('public/images/dealer-logo.png')}} "  alt="" class="img-fluid"></div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>