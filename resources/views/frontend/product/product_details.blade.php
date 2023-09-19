@extends('layouts.frontend')
@push('css')
	<style>
	    .app-figure {
	        width: 100% !important;
	        margin: 0px auto;
	        border: 0px solid red;
	        padding: 20px;
	        position: relative;
	        text-align: center;
	    }
	    .MagicZoom {
	        display: none;
	    }
	    .MagicZoom.Active {
	        display: block;
	    }
	    .selectors { margin-top: 10px; }
	    .selectors .mz-thumb img { max-width: 56px; }

	    @media  screen and (max-width: 1023px) {
	        .app-figure { width: 99% !important; margin: 20px auto; padding: 0; }
	    }
	</style>
	<!-- Image zoom -->
    <link rel="stylesheet" href="{{asset('frontend/magiczoomplus/magiczoomplus.css')}}" />
@endpush
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
 <main class="main">
	<div class="page-header breadcrumb-wrap">
	    <div class="container">
	    	
	        <div class="breadcrumb">
	            <a href="{{ route('product.category', $product->category->slug) }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>
	            	@if(session()->get('language') == 'bangla') 
                        {{ $product->category->name_bn ?? 'No Category'}}
                    @else 
                        {{ $product->category->name_en ?? 'No Category'}} 
                    @endif
	            </a>
	        </div>
	    </div>
	</div>
	<div class="container mb-30">
	    <div class="row">
	        <div class="col-xl-11 col-lg-12 m-auto">
	            <div class="row">
	                <div class="col-xl-12">
	                    <div class="product-detail accordion-detail">
	                        <div class="row mb-50 mt-30">
	                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
	                                <!-- Product Zoom Image -->
	                                <div class="app-figure" id="zoom-fig">
								        <a rel="selectors-effect-speed: 600; disable-zoom: true;" id="Zoom-1" class="MagicZoom Active" data-options="zoomWidth: 500; zoomHeight: 500; expandZoomMode: magnifier; expandZoomOn: always; variableZoom: true; rightClick: true;" title="Show your product in stunning detail with {{config('app.name')}} Zoom." style="max-width: 438px; max-height: 438px;"
								            href="{{ asset($product->product_thumbnail) }}?h=1400"
								            data-zoom-image-2x="{{ asset($product->product_thumbnail) }}"
								            data-image-2x="{{ asset($product->product_thumbnail) }}"
								        >
								            <img id="product_zoom_img" style="max-width: 438px; max-height: 438px;" src="{{ asset($product->product_thumbnail ) }}" srcset="{{ asset($product->product_thumbnail) }}" alt="">
								        </a>
								        <div class="selectors">
								        	@foreach($product->multi_imgs as $img)
								            <a rel="selectors-effect-speed: 600; disable-zoom: true;"
								            	class="me-4"
								                data-zoom-id="Zoom-1"
								                href="{{ asset($img->photo_name ) }}"
								                data-image="{{ asset($img->photo_name ) }}"
								                data-zoom-image-2x="{{ asset($img->photo_name ) }}"
								                data-image-2x="{{ asset($img->photo_name ) }}"
								            >
								                <img style="height: 80px !important;" srcset="{{ asset($img->photo_name ) }}">
								            </a>
								            @endforeach
								        </div>
								    </div>
								    <!-- Product Zoom Image End -->
	                            </div>
	                            <div class="col-md-6 col-sm-12 col-xs-12">
	                                <div class="detail-info pr-30 pl-30">
	                                	@php
	                                		$discount = 0;
											$amount = $product->regular_price;
	                                		if($product->discount_price > 0){
	                                			if($product->discount_type == 1){
	                                				$discount = $product->discount_price;
	                                				$amount = $product->regular_price - $discount;
	                                			}else if($product->discount_type == 2){
	                                				$discount = $product->regular_price * $product->discount_price / 100;
	                                				$amount = $product->regular_price - $discount;
	                                			}else{
	                                				$amount = $product->regular_price;
	                                			}
	                                		}
		                          		@endphp

		                          		@if ($product->discount_price > 0)
		                          			@if ($product->discount_type == 1)
	                                			<span class="stock-status out-stock"> ৳{{  $discount }} Off </span>
	                                		@elseif ($product->discount_type == 2)
	                                			<span class="stock-status out-stock"> {{  $product->discount_price }}% Off </span>
	                                		@endif
			                            @endif

			                            <input type="hidden" id="discount_amount" value="{{ $discount }}">
			                             	
	                                    <h2 class="title-detail">
	                                    	@if(session()->get('language') == 'bangla') 
			                                    {{ $product->name_bn }}
			                                @else 
			                                    {{ $product->name_en }} 
			                                @endif
	                                    </h2>
	                                    <div class="clearfix product-price-cover">
	                                        <div class="product-price primary-color float-left">
	                                        	@if($product->discount_price <= 0)
	                                        	 	<span class="current-price text-brand">৳{{ $product->regular_price }}</span>
					                            @else
	                                                <span class="current-price text-brand">৳{{ $amount }}</span>
			                                            @if ($product->discount_type == 1)
					                                		<span class="save-price font-md color3 ml-15"> ৳{{ $discount }} Off </span>
							                            @elseif ($product->discount_type == 2)
							                             	<span class="save-price font-md color3 ml-15">{{ $product->discount_price }}% Off</span>
							                            @endif
	                                                <span class="old-price font-md ml-15">৳{{ $product->regular_price }}</span>
					                            @endif
	                                        </div>
	                                    </div>
	                                    <form id="choice_form">
		                                    <div class="row " id="choice_attributes">
		                                    	@if($product->is_varient)
		                                    		@php $i=0; @endphp
		                                    		@foreach(json_decode($product->attribute_values) as $attribute)
			                                    		@php
			                                    			$attr = get_attribute_by_id($attribute->attribute_id);
			                                    			$i++;
			                                    		@endphp
			                                    		<div class="attr-detail attr-size mb-30">
					                                        <strong class="mr-10">{{ $attr->name }}: </strong>
					                                        <input type="hidden" name="attribute_ids[]" id="attribute_id_{{ $i }}" value="{{ $attribute->attribute_id }}">
							                                <input type="hidden" name="attribute_names[]" id="attribute_name_{{ $i }}" value="{{ $attr->name }}">
															<input type="hidden" id="attribute_check_{{ $i }}" value="0">
															<input type="hidden" id="attribute_check_attr_{{ $i }}" value="0">
					                                        <ul class="list-filter size-filter font-small">
					                                        	@foreach($attribute->values as $value)
						                                            <li>
						                                            	<a href="#" onclick="selectAttribute('{{ $attribute->attribute_id }}{{ $attr->name }}', '{{ $value }}', '{{ $product->id }}', '{{ $i }}')" style="border: 1px solid #7E7E7E;">{{ $value }}</a>
						                                            </li>
					                                            @endforeach
					                                            <input type="hidden" name="attribute_options[]" id="{{ $attribute->attribute_id }}{{ $attr->name }}" class="attr_value_{{ $i }}">
					                                        </ul>
					                                    </div>
				                                    @endforeach
				                                    <input type="hidden" id="total_attributes" value="{{ count(json_decode($product->attribute_values)) }}">
				                                @endif
				                            </div>
			                        	</form>

										<div class="row" id="attribute_alert">
											
										</div>

	                                    <div class="detail-extralink mb-20 align-items-baseline d-flex">
	                                    	<div class="mr-10">
	                                    		<span class="">Quantity:</span>
	                                    	</div>
	                                        <div class="detail-qty border radius">
	                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
	                                            <input type="text" name="quantity" class="qty-val" value="1" min="1" id="qty">
	                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
	                                        </div>

											<div class="row" id="qty_alert">
											
											</div>
	                                    </div>
	                                    <div class="detail-extralink mb-50">
	                                        <div class="product-extra-link2">

	                                        	<input type="hidden" id="product_id" value="{{ $product->id }}">

	                                        	<input type="hidden" id="pname" value="{{ $product->name_en }}">

	                                        	<input type="hidden" id="product_price" value="{{ $amount }}">

	                                        	<input type="hidden" id="minimum_buy_qty" value="{{ $product->minimum_buy_qty }}" >
	                                        	<input type="hidden" id="stock_qty" value="{{ $product->stock_qty }}">

	                                        	<input type="hidden" id="pvarient" value="">
												
												<input type="hidden" id="buyNowCheck" value="0">

	                                            <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shoppi ng-cart"></i>Add to cart</button>

	                                            <button type="submit" class="button button-add-to-cart ml-5 bg-danger" onclick="buyNow()"><i class="fi-rs-shoppi ng-cart"></i>Buy Now</button>
	                                        </div>
											
	                                    </div>
										<div class="row mb-3" id="stock_alert">
											
										</div>
	                                    <div class="font-xs">
	                                        <ul class="mr-50 float-start">
	                                            <li class="mb-5">Regular Price: <span class="text-brand">{{ $product->regular_price }}</span></li>
	                                            <li class="mb-5">Stock: <span class="text-brand">{{ $product->stock_qty}}</span></li>
	                                            <li class="mb-5">Category:<span class="text-brand">
	                                            	{{ $product->category->name_en ?? 'No Category'}} 
	                                            </span></li>
	                                        </ul>
	                                        <ul class="float-start">
												@if($product->wholesell_price > 0)
													<li class="mb-5">
														Whole Sell Price: 
														<a href="#">{{ $product->wholesell_price }}</a>
													</li>
													<li class="mb-5">
														Whole Sell Quantity: 
														<a href="#">{{ $product->wholesell_minimum_qty }}</a>
													</li>
												@endif
	                                            <li class="mb-5">Brand:
	                                            	<a href="#" rel="tag">
	                                            		{{ $product->brand->name_en ?? 'No Brand'}} 
	                                            	</a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                </div>
	                                <!-- Detail Info -->
	                            </div>
	                        </div>
	                        <div class="product-info">
	                            <div class="tab-style3">
	                                <ul class="nav nav-tabs text-uppercase">
	                                    <li class="nav-item">
	                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
	                                    </li>
										<li class="nav-item">
											<a class="nav-link" id="review-tab" data-bs-toggle="tab" href="#reviews">reviews (0)</a>
										</li>
	                                </ul>
	                                <div class="tab-content shop_info_tab entry-main-content">
	                                    <div class="tab-pane fade show active" id="Description">
	                                        <div class="">
	                                            <p>
	                                            	@if(session()->get('language') == 'bangla') 
														{!! $product->description_en ?? 'No Product Long Descrption' !!}
								                    @else 
														{!! $product->description_bn ?? 'No Product Logn Descrption' !!} 
								                    @endif
	                                            </p>
	                                        </div>
	                                    </div>
										<div class="tab-pane fade" id="reviews">
											<div class="product__review__system">
												<h6>Youre reviewing:</h6>
												<h5>Head & Shoulders Soft and Manageable Anti Dandruff Shampoo - 1000ml</h5>

												<form action="">
													<div class="product__rating">
														<label for="name">Rating</label>
														<div class="rating-checked">
															<input type="radio" name="clr" style="--r: #ffb301" />
															<input type="radio" name="clr" style="--r: #ffb301" />
															<input type="radio" name="clr" style="--r: #ffb301" />
															<input type="radio" name="clr" style="--r: #ffb301" />
															<input type="radio" name="clr" style="--r: #ffb301" />
														</div>
													</div>

													<div class="review__form">
														<div class="row">
															<div class="col-md-6 col-12">
																<div class="form-group">
																	<label for="name">Name</label>
																	<input type="text" name="name" id="name">
																</div>
															</div>
															<div class="col-md-6 col-12">
																<div class="form-group">
																	<label for="summary">Summary</label>
																	<input type="text" name="summary" id="summary">
																</div>
															</div>
															<div class="col-md-6 col-12">
																<div class="form-group">
																	<label for="review">Review</label>
																	<input type="text" name="review" id="review">
																</div>
															</div>
														</div>
														<button type="submit" class="btn btn-info">Submit Review</button>
													</div>
												</form>
											</div>
											<div class="review_list">
												<div class="single-review-item">
													<div class="rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
													<h5 class="review-title">Best product</h5>
													<h6 class="review-user">Najmul</h6>
													<span class="review-description">Lorem ipsum dolor sit amet
														consectetur,
														adipisicing elit. Fugiat necessitatibus sit, vero non doloribus
														debitis porro nam adipisci molestiae nihil.</span>
												</div>
												<div class="single-review-item">
													<div class="rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
													<h5 class="review-title">Best product</h5>
													<h6 class="review-user">Najmul</h6>
													<span class="review-description">Lorem ipsum dolor sit amet
														consectetur,
														adipisicing elit. Fugiat necessitatibus sit, vero non doloribus
														debitis porro nam adipisci molestiae nihil.</span>
												</div>
												<div class="single-review-item">
													<div class="rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
													<h5 class="review-title">Best product</h5>
													<h6 class="review-user">Najmul</h6>
													<span class="review-description">Lorem ipsum dolor sit amet
														consectetur,
														adipisicing elit. Fugiat necessitatibus sit, vero non doloribus
														debitis porro nam adipisci molestiae nihil.</span>
												</div>
												<div class="single-review-item">
													<div class="rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
													<h5 class="review-title">Best product</h5>
													<h6 class="review-user">Najmul</h6>
													<span class="review-description">Lorem ipsum dolor sit amet
														consectetur,
														adipisicing elit. Fugiat necessitatibus sit, vero non doloribus
														debitis porro nam adipisci molestiae nihil.</span>
												</div>
											</div>
										</div>
										@if(get_setting('multi_vendor')->value)
										    @php
										        $vendor = \App\Models\Vendor::where('id', $product->vendor_id)->first();
										    @endphp
										    @if($vendor)
    											<div class="tab-pane fade" id="Vendor-info">
    												<div class="vendor-logo d-flex mb-30">
    													<img src="{{ asset($vendor->shop_profile) }}" alt="" />
    													<div class="vendor-name ml-15">
    														<h6>
    															<a href="{{ route('vendor.product', $vendor->slug) }}">{{ $vendor->shop_name }}</a>
    														</h6>
    													</div>
    												</div>
    												<ul class="contact-infor mb-50">
    													<li><img src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span></li>
    												</ul>
    												<p>
    													{{ $vendor->description }}
    												</p>
    											</div>
											@endif
										@endif
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row mt-60">
	                            <div class="col-12">
	                                <h2 class="section-title style-1 mb-30">Related products</h2>
	                            </div>
	                            <div class="col-12">
	                                <div class="row related-products">
	                                	@forelse($relatedProduct as $product)
	                                    <div class="col-lg-3 col-md-4 col-6 col-sm-6" style="padding-bottom: 25px;">
	                                        <div class="product-cart-wrap hover-up">
	                                            <div class="product-img-action-wrap">
	                                                <div class="product-img product-img-zoom">
	                                                    <a href="{{ route('product.details',$product->slug) }}" tabindex="0">
	                                                        <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />
	                                                        <img class="hover-img" src="{{asset($product->product_thumbnail)}}" alt="" />
	                                                    </a>
	                                                </div>
	                                                 <div class="product-action-1 d-flex">
                                                        <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                    </div>
                                                    <!-- start product discount section -->
                                                  	@php
                                                        if($product->discount_type == 1){
                                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                                        }elseif($product->discount_type == 2){
                                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                                        }
                                                  	@endphp
                                        
                                                    @if($product->discount_price > 0)
                                                    <div class="product-badges-right product-badges-position-right product-badges-mrg">
                                                            @if($product->discount_type == 1)
                                                                <span class="hot">৳{{ $product->discount_price }} off</span>
                                                            @elseif($product->discount_type == 2)
                                                                <span class="hot">{{ $product->discount_price }}% off</span>
                                                            @endif
                                                    </div>
                                                    @endif
			     
	                                            </div>
	                                            <div class="product-content-wrap">
                                                    <h2 class="mt-3" style="height: 40px;">
                                                        <a href="{{ route('product.details',$product->slug) }}">
                                                            @if(session()->get('language') == 'bangla')
                                                                <?php $p_name_bn =  strip_tags(html_entity_decode($product->name_bn))?>
                                                                {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                                            @else
                                                                <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                                                {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                                            @endif
                                                        </a>
                                                    </h2>
                                                    <div class="product-category">
                                                        <a href="{{ route('product.category', $product->category->slug) }}">
                                                            @if(session()->get('language') == 'bangla') 
                                                                {{ $product->category->name_bn }}
                                                            @else 
                                                                {{ $product->category->name_en }} 
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="product-card-bottom">
                                                    	@if ($product->discount_price > 0)
                                                            <div class="product-price">
                                                              	<span class="price">৳{{ $price_after_discount }}</span>
                                                              	<span class="old-price">৳{{ $product->regular_price }}</span>
                                                            </div>
                                                        @else
                                                            <div class="product-price">
                                                            	<span class="price">৳{{ $product->regular_price }}</span>
                                                            </div>
                                                        @endif
                                                        <div class="add-cart">
                                                            @if($product->is_varient == 1)
                                                                <a class="add" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            @else
                                                                <input type="hidden" id="pfrom" value="direct">
                                                                <input type="hidden" id="product_product_id" value="{{ $product->id }}">
                                                                <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                                                <a class="add" onclick="addToCartDirect({{ $product->id }})" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
	                                        </div>
	                                    </div>
	                                    @empty
						                    @if(session()->get('language') == 'bangla') 
						                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5> 
						                    @else 
						                       <h5 class="text-danger">No products were found here!</h5> 
						                    @endif
					                  	@endforelse
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                
	            </div>
	        </div>
	    </div>
	</div>
</main>
@endsection

@push('footer-script')
<!-- Image zoom -->
    <script src="{{asset('frontend/magiczoomplus/magiczoomplus.js')}}"></script>
	<script>
		var mzOptions = {
			zoomWidth: "400px",
			zoomHeight: "400px",
			zoomDistance: 15,
			expandZoomMode: "magnifier",
			expandZoomOn: "always",
			variableZoom: true,
			// lazyZoom: true,
			// selectorTrigger: "hover"
		};
	</script>
@endpush