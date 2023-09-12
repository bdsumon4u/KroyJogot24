@extends('layouts.yellow.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('strokya/vendor/xzoom/xzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('strokya/vendor/xZoom-master/example/css/demo.css') }}">
    <style>
        #accordion .card-link {
            display: block;
            font-size: 20px;
            padding: 18px 48px;
            border-bottom: 2px solid transparent;
            color: inherit;
            font-weight: 500;
            border-radius: 3px 3px 0 0;
            transition: all .15s;
        }
        #accordion .card-link:not(.collapsed) {
            border-bottom: 2px solid #000;
            color: #000;
        }

        /*#xzoom-default {*/
        /*    max-height: 350px;*/
        /*    width: 100%;*/
        /*}*/
        .product__actions-item {
            flex: 1;
        }
        @media (max-width: 768px) {
            /*#xzoom-default {*/
            /*    max-height: 300px;*/
            /*    width: 100%;*/
            /*}*/
            .product__actions {
                justify-content: center;
            }
            .product__actions-item {
                width: 100%;
            }
        }
        .product__content {
            grid-template-columns: [gallery] calc(40% - 30px) [info] calc(5% - -18px) [sidebar] calc(45% - 10px) [other] calc(10% - 10px);
            grid-column-gap: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .original {
            position: relative;
        }
        .zoom-nav {
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .zoom-control {
            height: 40px;
            outline: none;
            border: 2px solid white;
            cursor: pointer;
            opacity: 0.8;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            width: 40px;
            border-radius: 20px;
            color: #ca3d1c;
            background: transparent;
        }
        .zoom-control:hover {
            opacity: 1;
        }
        .zoom-control:focus {
            outline: none;
        }
    </style>
@endpush

@section('title', $product->name)

@section('content')
    <div class="">
        <div class="container pt-2">
            <p class="product__name mb-2" style="font-size: 24px; font-weight: bold; line-height: 1.25;">{{ $product->name }}</p>

            <div class="product product--layout--standard" data-layout="standard">
                <div class="product__content" data-id="{{ $product->id }}" data-max="{{ $product->should_track ? $product->stock_count : -1 }}">

                    <div class="xzoom-container d-flex flex-column">
                        <div class="original">
                            <img class="xzoom" id="xzoom-default" src="{{ asset($product->base_image->src) }}" xoriginal="{{ asset($product->base_image->src) }}" style="width: 100%;" />
                            <div class="zoom-nav">
                                <button class="zoom-control left">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                                <button class="zoom-control right">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        @if($product->additional_images->isNotEmpty())
                            <div class="xzoom-thumbs d-flex mt-2">
                                <a href="{{ asset($product->base_image->src) }}">
                                    <img class="xzoom-gallery" width="60" src="{{ asset($product->base_image->src) }}" xpreview="{{ asset($product->base_image->src) }}">
                                </a>
                                @foreach($product->additional_images as $image)
                                    <a href="{{ asset($image->src) }}">
                                        <img class="xzoom-gallery" width="60" src="{{ asset($image->src) }}">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div></div>
                    <!-- .product__info -->
                    <div class="product__info">
                        <div class="product__prices {{$product->selling_price == $product->price ? '' : 'has-special'}} d-flex align-items-center mb-2">
                            Price: &nbsp;
                            @if($product->selling_price == $product->price)
                                {!!  theMoney($product->price)  !!}
                            @else
                                <span class="product-card__new-price">{!!  theMoney($product->selling_price)  !!}</span>
                                <span class="product-card__old-price" style="font-weight: normal;">{!!  theMoney($product->price)  !!}</span>
                            @endif
                            <div class="ml-auto" style="font-size: 70%;">Code: <strong>{{ $product->sku }}</strong></div>
                        </div>
                        <!-- .product__sidebar -->
                        <div class="product__sidebar">
                            <!-- .product__options -->
                            <form class="product__options">
                                <div class="form-group product__option">
                                    <div class="product__actions" style="row-gap: 5px">
                                        <div class="d-flex w-100" style="column-gap: 10px">
                                            <div class="product__actions-item d-flex justify-content-center flex-column" style="width: 120px;flex: 1">
                                                <label class="product__option-label text-center" for="product-quantity">Quantity</label>
                                                <div class="input-number product__quantity w-100">
                                                    <input id="product-quantity"
                                                           class="input-number__input form-control form-control-lg"
                                                           type="number" min="1" {{ $product->should_track ? 'max='.$product->stock_count : '' }} value="1">
                                                    <div class="input-number__add"></div>
                                                    <div class="input-number__sub"></div>
                                                </div>
                                            </div>
                                            <div class="call-for-order" style="flex: 1">
                                            <!--<img class="d-block mx-auto" src="{{ asset('call-now-icon-20.jpg') }}" width="80" alt="Call For Order">-->
                                                <div style="padding: 5px 10px;font-weight: bold; font-size: 88%;">
                                                    @foreach(explode(' ', setting('call_for_order') ?? '') as $phone)
                                                        <a href="tel:{{$phone}}" style="color: red; display: block;"><img style="width:30px" class="img-responsive " src="{{ asset('call-now.gif') }}" alt="Call" title="Call For Order"> {{ $phone }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @exp($available = !$product->should_track || $product->stock_count > 0)
                                        <div class="product__buttons d-flex w-100 flex-wrap">
                                            <div class="product__actions-item product__actions-item--addtocart">
                                                <button class="btn btn-primary product__addtocart btn-lg btn-block" {{ $available ? '' : 'disabled' }}>Add to cart</button>
                                            </div>
                                            <div class="product__actions-item product__actions-item--ordernow">
                                                <button class="btn btn-primary product__ordernow btn-lg btn-block" {{ $available ? '' : 'disabled' }}>Order Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form><!-- .product__options / end -->
                        </div><!-- .product__end -->

                        <div class="product__footer mt-2">
                            <div class="product__tags tags">
                                @if($product->brand)
                                    <p class="text-secondary mb-2">
                                        Brand: <a href="{{ route('brands.products', $product->brand) }}" class="text-primary badge badge-light"><big>{{ $product->brand->name }}</big></a>
                                    </p>
                                @endif
                                <div class="">
                                    <p class="text-secondary mb-2 d-inline-block mr-2">Categories:</p>
                                    @foreach($product->categories as $category)
                                        <a href="{{ route('categories.products', $category) }}" class="badge badge-primary">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><!-- .product__info / end -->
                    <div></div>
                </div>
            </div>
            <div id="accordion" class="mt-3">
                <div class="card">
                    <div class="card-header p-0">
                        <a class="card-link px-4" datatoggle="collapse" href="javascript:void(false)">
                            Product Description
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body p-4">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header p-0">
                        <a class="card-link px-4" datatoggle="collapse" href="javascript:void(false)">
                            Delivery and Payment
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                        <div class="card-body p-4">
                            {!! setting('delivery_text') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .block-products-carousel -->
    @include('partials.products.pure-grid', [
        'title' => 'Related Products',
        'cols' => $related_products->cols,
        'rows' => $related_products->rows,
    ])
    <!-- .block-products-carousel / end -->
@endsection

@push('scripts')
    <script src="{{ asset('strokya/vendor/xzoom/xzoom.min.js') }}"></script>
    <script src="{{ asset('strokya/vendor/xZoom-master/example/js/vendor/modernizr.js') }}"></script>
    <script src="{{ asset('strokya/vendor/xZoom-master/example/js/setup.js') }}"></script>
    <script>
        $(document).ready(function () {
            let activeG = 0;
            let lastG = 0;
            $('.zoom-control.left').click(function () {
                let gallery = $('.xzoom-gallery');
                gallery.each(function (g, e) {
                    if ($(e).hasClass('xactive')) {
                        activeG = g;
                    }
                    lastG = g;
                })
                const prev = activeG === 0 ? lastG : (activeG - 1);
                gallery.eq(prev).trigger('click');
            });
            $('.zoom-control.right').click(function () {
                let gallery = $('.xzoom-gallery');
                gallery.each(function (g, e) {
                    if ($(e).hasClass('xactive')) {
                        activeG = g;
                    }
                    lastG = g;
                })
                const next = activeG === lastG ? 0 : (activeG + 1);
                gallery.eq(next).trigger('click');
            });
        });
    </script>
@endpush
