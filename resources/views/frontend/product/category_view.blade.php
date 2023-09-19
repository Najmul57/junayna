@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
@section('title')
Category Nest Online Shop
@endsection
<main class="main">
    <div class="page-header">
        <div class="container-fluid">
            {{-- <div class="archive-header" style="background-image: url({{ asset($category->image) }});"> --}}
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h4 class="mb-5">
                            @if (session()->get('language') == 'bangla')
                                {{ $category->name_bn }}
                            @else
                                {{ $category->name_en }}
                            @endif
                        </h4>
                        <div class="breadcrumb">
                            <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>
                            @if (session()->get('language') == 'bangla')
                                {{ $category->name_bn }}
                            @else
                                {{ $category->name_en }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-30 category-wise-product">
        <div class="row">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover d-flex">
                            <div class="row">
                                <div class="form-group col-lg-6 col-12 col-md-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" onchange="filter()" name="brand">
                                            <option value="">All Brands</option>
                                            @foreach (\App\Models\Brand::all() as $brand)
                                                <option value="{{ $brand->slug }}"
                                                    @if ($brand_id == $brand->id) selected @endif>
                                                    {{ $brand->name_en ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-12 col-md-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" name="sort_by" onchange="filter()">
                                            <option value="newest" @if ($sort_by == 'newest') selected @endif>
                                                Newest</option>
                                            <option value="oldest" @if ($sort_by == 'oldest') selected @endif>
                                                Oldest</option>
                                            <option value="price-asc" @if ($sort_by == 'price-asc') selected @endif>
                                                Price Low to High</option>
                                            <option value="price-desc"
                                                @if ($sort_by == 'price-desc') selected @endif>Price High to Low
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
                        <div class="special-image">
                            <div class="special-image-front">
                                <img src="{{ asset($product->product_thumbnail) }}" alt="sd">
                            </div>
    
                            <div class="special-image-content">
                                <a href="{{ route('product.details', $product->slug) }}">
                                    @if (session()->get('language') == 'bangla')
                                        <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                        {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                    @else
                                        <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                        {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                    @endif
                                </a>
                                <div class="product__rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-stroke"></i>
                                </div>
                                <div class="price">
                                    <span>
                                        @php
                                            if ($product->discount_type == 1) {
                                                $price_after_discount = $product->regular_price - $product->discount_price;
                                            } elseif ($product->discount_type == 2) {
                                                $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                            }
                                        @endphp
    
                                        @if ($product->discount_price > 0)
                                            <div class="product-price price-derection">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price"
                                                    style="color: #DD1D21;"><del>৳{{ $product->regular_price }}</del></span>
                                            </div>
                                        @else
                                            <div class="product-price price-derection">
                                                <span class="price">৳{{ $product->regular_price }}</span>
                                            </div>
                                        @endif
                                    </span>
                                </div>
                            </div>
    
                            <div class="special-image-back">
                                @foreach ($product->multi_imgs->take(1) as $img)
                                    <a href="{{ route('product.details', $product->slug) }}"><img src="{{ asset($img->photo_name) }}" alt="sd"></a>
                                @endforeach
                            </div>
                            
                            <div class="back-quick-view">
                                <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fa-regular fa-eye"></i></a>
                                <!--<i class="fa fa-cart-shopping" data-bs-toggle="modal" data-bs-target="#cart_shopping"></i>-->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            {{ $products->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <!-- Fillter By Price -->
                @include('frontend.common.filterby')
                <!-- SideCategory -->
                @include('frontend.common.sidecategory')
            </div>
        </div>
    </div>
</main>
@endsection
@push('footer-script')
<script type="text/javascript">
</script>

<script type="text/javascript">
    function filter() {
        $('#search-form').submit();
    }
</script>
@endpush