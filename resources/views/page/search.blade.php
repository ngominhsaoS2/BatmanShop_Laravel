@extends('master')

@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Rusults for: '{{$key}}'</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{count($listFoundProducts)}} styles found</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($listFoundProducts as $item)    
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        @if($item->promotion_price != 0)
                                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{route('Product', $item->id)}}"><img src="source/image/product/{{$item->image}}" alt="{{$item->name}}" height="250px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$item->name}}</p>
                                            <p class="single-item-price">
                                            @if($item->promotion_price == 0)
                                                <span>{{number_format($item->unit_price)}}</span>
                                            @else
                                                <span class="flash-del">{{number_format($item->unit_price)}}</span>
                                                <span class="flash-sale">{{number_format($item->promotion_price)}}</span>
                                            @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{route('AddToCart', $item->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{route('Product', $item->id)}}">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach  
                        </div>
                        <div class="row">{{$listFoundProducts->links()}}</div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection