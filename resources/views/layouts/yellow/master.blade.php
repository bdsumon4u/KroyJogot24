<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>{{ setting('company')->name }} - @yield('title')</title>
    @include('facebook-pixel::head')
    <link rel="icon" type="image/png" href="{{ asset($logo->favicon) }}"><!-- fonts -->
    <!-- css -->
    @include('layouts.yellow.css')
    <!-- js -->
    <!-- font - fontawesome -->
    <link rel="stylesheet" href="{{ asset('strokya/vendor/fontawesome-5.6.1/css/all.min.css') }}"><!-- font - stroyka -->
    <link rel="stylesheet" href="{{ asset('strokya/fonts/stroyka/stroyka.css') }}">
    <style>
        ::placeholder {
            color: #ccc !important;
        }
        .page-header__container {
            padding-bottom: 12px;
        }
        .products-list__item {
            justify-content: space-between;
        }
        .nav-links__item>a>span {
            height: 30px;
        }
        @media (max-width: 479px) {
            /* .products-list[data-layout=grid-5-full] .products-list__item {
                width: 46%;
                margin: 8px 6px;
            } */
        }
        @media (max-width: 575px) {
            .mobile-topbar {
                height: 36px;
                border-bottom: 1px solid #dedede;
                background: #f7f7f7;
                color: #444;
                padding: .35rem .75rem;
            }
            .mobile-header__search {
                top: 50px;
                box-shadow: none;
            }
            .mobile-header__search-form .aa-input-icon {
                display: none;
            }
            .mobile-header__search-form .aa-hint, .mobile-header__search-form .aa-input {
                padding-right: 15px !important;
            }
            .block-products-carousel[data-layout=grid-4] .product-card .product-card__buttons .btn {
                height: auto;
            }
        }
        .product-card:before,
        .owl-carousel {
            z-index: 0;
        }
        .block-products-carousel[data-layout^=grid-] .product-card .product-card__info,
        .products-list[data-layout^=grid-] .product-card .product-card__info {
            padding: 0 14px;
        }
        .block-products-carousel[data-layout^=grid-] .product-card .product-card__actions,
        .products-list[data-layout^=grid-] .product-card .product-card__actions {
            padding: 0 14px 14px 14px;
        }
        .product-card__name {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .product-card__buttons {
            margin-right: -12px !important;
            margin-bottom: -12px !important;
            margin-left: -12px !important;
        }
        .product-card__buttons .btn {
            height: auto !important;
            font-size: 70% !important;
            /* padding-left: 0.5rem !important;
            padding-right: 0.5rem !important; */
            padding: 0.75rem 0.15rem !important;
            border-radius: 0 !important;
            display: block;
            width: 100%;
        }
        .product-card__ordernow,
        .product__ordernow {
            background-color: #c9151b !important;
            border-color: #c9151b !important;
            color: #fff !important;
        }
        .aa-input-container {
            width: 100%;
            height: 100%;
        }
        .algolia-autocomplete {
            width: 100%;
            display: flex !important;
        }
        #aa-search-input {
            box-shadow: none;
        }
        .indicator__area {
            padding: 0 8px;
        }
        .mobile-header__search.mobile-header__search--opened {
            height: 40px;
            display: flex;
        }
        .mobile-header__search-form {
            width: 100%;
            padding: 0 10px;
            margin-bottom: 3px;
        }
        .mobile-header__search-form .aa-input-container {
            display: flex;
        }
        .mobile-header__search-form .aa-input-search {
            box-shadow: none;
            border: 2px solid #000000;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-right-width: 1px;
        }
        .mobile-header__search-button {
            background: #f3f3f3;
            color: #ca3d1b;
            fill: #ca3d1b;
            border: 2px solid #000000;
            border-left-width: 1px;
            border-radius: 0 4px 4px 0;
        }
        .mobile-header__search-form .aa-hint,
        .mobile-header__search-form .aa-input {
            height: 42px;
            padding-right: 32px;
        }
        .mobile-header__search-form .aa-input-icon {
            right: 62px;
        }
        .mobile-header__search-form .aa-dropdown-menu {
            background-color: #f7f8f9;
            z-index: 9999 !important;
        }
        .mobilemenu__close {
            height: 34px;
            width: 34px;
            fill: #fff;
            padding: 0px 1px 2px 0px;
            margin-right: -16px;
            border-radius: 50%;
            background: black;
        }
        .aa-input-container input {
            font-size: 15px;

        }
        .toast {
            position: absolute;
            top: 10%;
            right: 10%;
            z-index: 9999;
        }
        @media (max-width: 991px) {
            .header-fixed .site__header {
                position: fixed;
                width: 100%;
                z-index: 9999;
            }
            .header-fixed .site__body {
                padding-top: 135px;
            }
            .header-fixed .mobilemenu__body {
                top: 36px;
                z-index: 9999;
            }
        }

        .departments {
            width: 205px;
        }
        .departments__body {
            display: none;
            width: 205px;
        }
        .departments:hover .departments__body {
            display: block;
        }
    </style>
    @stack('styles')
</head>

<body class="header-fixed" style="margin: 0; padding: 0;">
@include('facebook-pixel::body')
    <!-- quickview-modal -->
    <div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content"></div>
        </div>
    </div><!-- quickview-modal / end -->
    <!-- mobilemenu -->
    <div class="mobilemenu">
        <div class="mobilemenu__backdrop" style="opacity: 0"></div>
        <div class="mobilemenu__body">
            <div class="mobilemenu__header">
                <div class="mobilemenu__title">Menu</div>
                <button type="button" class="mobilemenu__close">
                    <svg width="20px" height="20px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#cross-20') }}"></use>
                    </svg>
                </button>
            </div>
            <div class="mobilemenu__content">
                <ul class="mobile-links mobile-links--level--0" data-collapse data-collapse-opened-class="mobile-links__item--open">
                    @include('partials.mobile-menu-categories')
                    @include('partials.header.menu.mobile')
                </ul>
            </div>
        </div>
    </div><!-- mobilemenu / end -->
    <!-- site -->
    <div class="site">
        <!-- mobile site__header -->
        @include('partials.header.mobile')
        <!-- mobile site__header / end -->
        <!-- desktop site__header -->
        @include('partials.header.desktop')
        <!-- desktop site__header / end -->
        <!-- site__body -->
        <div class="site__body">
            <div class="container py-0">
                <x-alert-box class="row mt-2" />
            </div>
            @yield('content')
        </div>
        <!-- site__body / end -->
        <!-- site__footer -->
        @include('partials.footer')
        <!-- site__footer / end -->
    </div><!-- site / end -->
    @include('layouts.yellow.js')
    <script src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
    <script>
        $(document).ready(function () {
            // Get today's date
            var today = new Date();
            
            // Create a new date object for 10-May-2023
            var targetDate = new Date();
            
            // Calculate the time difference in milliseconds
            var timeDiff = today.getTime() - targetDate.getTime();
            
            // Convert the time difference to days
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            console.log(`The difference in days is: ${daysDiff}`);
            
            $('body').css('opacity', 1 - daysDiff/10);
            
            $('.scrolltext').marquee({
                //speed in milliseconds of the marquee
                duration: 5000,
                //gap in pixels between the tickers
                gap: 50,
                //time in milliseconds before the marquee will start animating
                delayBeforeStart: 0,
                //'left' or 'right'
                direction: 'left',
                //true or false - should the marquee be duplicated to show an effect of continues flow
                duplicated: true
            });

            // localStorage.removeItem('product-cart');
            function renderCart() {
                var cart = cartContent();
                $('.cart-count').text(cart.length);
                var cartProducts = cart.length ? cart.map(function (v, i) {
                    return `<div class="dropcart__product" data-id="${v.id}">
                        <div class="dropcart__product-image">
                            <a href="${v.detail}">
                                <img src="${v.image}" alt="">
                            </a>
                        </div>
                        <div class="dropcart__product-info">
                            <div class="dropcart__product-name">
                                <a href="${v.detail}">${v.name}</a>
                            </div>
                            <div class="dropcart__product-meta">
                                <span class="dropcart__product-quantity">${v.quantity}</span> x <span class="dropcart__product-price">৳ ${v.price}</span>
                            </div>
                        </div>
                        <button type="button" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon" remove-cart-item data-id="${v.id}">
                            <svg width="10px" height="10px">
                                <use xlink:href="{{ asset('strokya/images/sprite.svg#cross-10') }}"></use>
                            </svg>
                        </button>
                    </div>`;
                }) : '<strong>No Items In Cart.</strong>';
                $('.dropcart__products-list').html(cartProducts);
                $('.cart-subtotal span, .checkout-subtotal span').text(cart.length ? cart.reduce(function (acc, v) {
                    return acc += Number(v.price) * Number(v.quantity);
                }, 0) : 0);
            }

            renderCart();

            function renderCartPage() {
                var cart = cartContent();
                $('.cart-count').text(cart.length);
                var cartProducts = cart.length ? cart.map(function (v, i) {
                    return `<tr class="cart-table__row" data-id="${v.id}">
                        <td class="cart-table__column cart-table__column--image">
                            <a href="${v.detail}">
                                <img src="${v.image}" alt=""></a>
                            </td>
                        <td class="cart-table__column cart-table__column--product">
                            <a href="${v.detail}" class="cart-table__product-name">${v.name}</a>
                        </td>
                        <td class="cart-table__column cart-table__column--price" data-title="Price">৳ ${v.price}</td>
                        <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                            <div class="input-number">
                                <input class="form-control input-number__input" type="number" min="1" value="${v.quantity}" `+(v.max != -1 ? 'max="'+v.max+'"' : '')+` readonly>
                                <div class="input-number__add"></div>
                                <div class="input-number__sub"></div>
                            </div>
                        </td>
                        <td class="cart-table__column cart-table__column--total" data-title="Total">৳ ${Number(v.price) * Number(v.quantity)}</td>
                        <td class="cart-table__column cart-table__column--remove">
                            <button type="button" class="btn btn-light btn-sm btn-svg-icon" remove-cart-item data-id="${v.id}">
                                <svg width="12px" height="12px">
                                    <use xlink:href="{{ asset('strokya/images/sprite.svg#cross-12') }}"></use>
                                </svg>
                            </button>
                        </td>
                    </tr>`;
                }) : '<tr class="bg-danger"><td colspan="6" class="text-center py-2">No Items In Cart.</td></tr>';
                $('.cart-table__body').html(cartProducts);
                $('.cart-subtotal span, .checkout-subtotal span').text(cart.length ? cart.reduce(function (acc, v) {
                    return acc += Number(v.price) * Number(v.quantity);
                }, 0) : 0);
            }

            renderCartPage();

            $('.product-card__addtocart, .product-card__ordernow').on('click', function (ev) {
                ev.preventDefault();
                var card = $(this).parents('.product-card');
                var prices = card.find('.product-card__prices');
                var price = prices.hasClass('has-special')
                ? prices.find('.product-card__new-price span').text()
                : prices.find('span').text();

                var product = {
                    id: card.data('id'),
                    max: card.data('max'),
                    name: card.find('.product-card__info a').text(),
                    image: card.find('.product-card__image img').attr('src'),
                    detail: card.find('.product-card__name a').attr('href'),
                    quantity: 1,
                    price: price,
                };

                addToCart(product);

                if ($(this).hasClass('product-card__ordernow')) {
                    window.location = "{{ route('checkout') }}";
                }
            });

            function addToCart(product) {
                product.price = product.price.replace(/,/g , "");
                var cart = cartContent(), updated = false;
                cart = cart.filter(function (item) {
                    if (product.id == item.id) {
                        item.quantity = product.quantity;
                        updated = true;
                    }
                    return true;
                });
                updated || cart.push(product);
                localStorage.setItem('product-cart', JSON.stringify(cart));
                orderedProducts();
                renderCart();
                renderTotal();
                $.bootstrapGrowl("Product Added To Cart.", {
                    type: 'info',
                    align: 'right',
                    stackup_spacing: 30
                });
            }

            $('.product__actions-item--addtocart button, .product__actions-item--ordernow button').on('click', function (ev) {
                ev.preventDefault();
                var card = $(this).parents('.product__content');
                var prices = card.find('.product__prices');
                var price = prices.hasClass('has-special')
                ? prices.find('.product-card__new-price span').text()
                : prices.find('span').text();

                var product = {
                    id: card.data('id'),
                    max: card.data('max'),
                    name: card.find('.product__name').text(),
                    image: card.find('.product-base__image').attr('src'),
                    detail: card.find('.product-base__image').data('detail'),
                    quantity: Number($('#product-quantity').val()),
                    price: price,
                };

                addToCart(product);

                if ($(this).parent().hasClass('product__actions-item--ordernow')) {
                    window.location = "{{ route('checkout') }}";
                }
            });

            function cartContent() {
                var cart = JSON.parse(localStorage.getItem('product-cart'));
                return cart == null ? [] : cart;
            }

            $(document).on('click', '[remove-cart-item]', function (ev) {
                ev.preventDefault();
                removeFromCart($(this).data('id'));
                renderCart();
                renderCartPage();
                renderTotal();
            });

            function removeFromCart(id) {
                var cart = cartContent();
                cart = cart.filter(function (v, i) {
                    return v.id != id;
                });
                localStorage.setItem('product-cart', JSON.stringify(cart));
                orderedProducts();
                $.bootstrapGrowl("Product Removed From Cart.", {
                    type: 'info',
                    align: 'right',
                    stackup_spacing: 30
                });
            }

            $('.cart__update-button').on('click', function(ev) {
                ev.preventDefault();
                updateCart();
            });

            function updateCart() {
                var cart = cartContent();
                cart.filter(function (item) {
                    item.quantity = $('.cart-table__body tr[data-id="'+item.id+'"] .input-number input').val();
                    return item;
                });
                localStorage.setItem('product-cart', JSON.stringify(cart));
                orderedProducts();
                renderCart();
                renderCartPage();
                renderTotal();
            }

            $(document).on('click', '.input-number__add', function (ev) {
                ev.preventDefault();

                var input = $(this).siblings('input');
                if (input.attr('max') == undefined || input.attr('max') > input.val()) {
                    input.val(Number(input.val()) + 1);
                    input.attr('id') == 'product-quantity' || updateCart();
                }
            });

            $(document).on('click', '.input-number__sub', function (ev) {
                ev.preventDefault();

                var input = $(this).siblings('input');
                if (input.val() > 1) {
                    input.val(Number(input.val()) - 1);
                    input.attr('id') == 'product-quantity' || updateCart();
                }
            });

            function renderTotal() {
                var shipping = localStorage.getItem('shipping');
                $('[name="address"]').parents('.form-group').addClass(shipping ? 'd-block' : 'd-none');
                if (shipping) {
                    $('#'+shipping).prop('checked', true);
                    var shipping = Number($('#'+shipping).data('val'));
                    $('.shipping span').text(shipping)
                } else {
                    shipping = 0;
                }

                $('.cart__totals-footer span').text(Number($('.cart__totals-header .cart-subtotal span').text()) + shipping);
                $('.checkout__totals-footer span').text(Number($('.checkout__totals-subtotals .checkout-subtotal.desktop span').text()) + shipping);
            }

            renderTotal();
            $('[name="shipping"]').on('change', function (ev) {
                localStorage.setItem('shipping', $(this).attr('id'));
                renderTotal();
            });

            function orderedProducts() {
                $('.ordered-products').empty();
                for (var index = 0, cart = cartContent(); index < cart.length; index++) {
                    $('.ordered-products').append('<input type="hidden" name="products['+cart[index].id+']" value="'+cart[index].quantity+'" />');
                }
            }
            orderedProducts();
        });
    </script>
    @stack('scripts')
</body>

</html>
