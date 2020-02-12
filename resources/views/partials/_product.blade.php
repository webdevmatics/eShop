<div class="popular-product-area wrapper-padding-3 pt-115 pb-115">
    <div class="container-fluid">
        <div class="section-title-6 text-center mb-50">
            <h2>All Product</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text</p>
        </div>
        <div class="product-style">
            <div class="popular-product-active owl-carousel">
                @foreach ($allProducts as $item)

                @php

                if(!empty($item->cover_img)) {
                $imagePath = asset('storage/'.$item->cover_img);
                }else {
                $imagePath = asset('storage/products/default.jpg');
                }

                @endphp
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <img src="{{$imagePath}}" alt="">
                        </a>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="#">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Add To Cart" href="{{route('cart', $item->id)}}">
                                <i class="pe-7s-cart"></i>
                            </a>
                            <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal"
                                href="#">
                                <i class="pe-7s-look"></i>
                            </a>
                        </div>
                    </div>
                    <div class="funiture-product-content text-center">
                        <h4><a href="product-details.html">{{ $item->name }}</a></h4>
                        <span>$ {{ $item->price }}</span>
                    </div>


                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
