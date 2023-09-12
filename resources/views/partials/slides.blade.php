@push('styles')
<style>
    @media (max-width: 749px) {
        .block-slideshow {
            margin-bottom: 40px;
        }
        #slideshow-container {
            padding-left: 5px;
            padding-right: 5px;
        }
        #slideshow-container > div {
            margin-left: -5px;
            margin-right: -5px;
        }
        #slideshow-container > div > div {
            padding-left: 5px;
            padding-right: 5px;
        }
        .block-slideshow__body {
            margin-top: 5px !important;
        }
    }
    @media (max-width: 767px) {
        .block-slideshow__body, .block-slideshow__slide {
            height: 180px !important;
        }
        .block-slideshow__slide-image--mobile {
            background-size: cover;
        }
        .footer-contacts,
        .footer-links,
        .footer-newsletter {
            text-align: left;
        }
        .footer-links ul {
            padding-left: 27px;
        }
    }
</style>
@endpush
<div class="block-slideshow block-slideshow--layout--with-departments block">
    <div id="slideshow-container" class="container">
        <div class="row">
            <div class="col-12 col-lg-9 offset-lg-3">
                <div class="block-slideshow__body">
                    <div class="owl-carousel">
                        @foreach($slides as $slide)
                        <a class="block-slideshow__slide" href="{{ $slide->btn_href ?? '#' }}">
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop"
                                style="background-image: url({{ asset($slide->desktop_src) }}); background-position: center;"></div>
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile"
                                style="background-image: url({{ asset($slide->mobile_src) }}); background-position: center;"></div>
                            <div class="block-slideshow__slide-content">
                                <div class="block-slideshow__slide-title">{!! $slide->title !!}</div>
                                <div class="block-slideshow__slide-text">{!! $slide->text !!}</div>
                                @if($slide->btn_href && $slide->btn_name)
                                <div class="block-slideshow__slide-button">
                                    <span class="btn btn-primary btn-lg">{{ $slide->btn_name }}</span>
                                </div>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>