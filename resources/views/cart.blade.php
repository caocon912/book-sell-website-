@extends('layouts.app')
@section ('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{route('shop')}}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class=" spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table" id="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td class="cart-pic first-row"><img src="img/cart-page/product-1.jpg" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5>Pure Pineapple</h5>
                                    </td>
                                    <td class="p-price first-row">$60.00</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">$60.00</td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
                                </tr> -->
                                @if ($items != null&&count($items)!=0)
                                
                                @foreach($items as $item)
                                
                                <input type="hidden" value = "{{$item->ID}}" name="id_item">
                                <tr>
                                    <td class="cart-pic"><img src="{{$item->IMAGE}}" alt=""></td>
                                    <td class="cart-title">
                                        <h5>{{$item->NAME}}</h5>
                                    </td>
                                    <td class="p-price">{{$item->NEW_PRICE}}</td>
                                    <td class="qua-col">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" value="{{$item->QUANLITY}}" name="quanlity">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price">{{$item->QUANLITY * $item->NEW_PRICE}}</td>
                                    <td class="close-td"><a href="{{route('delete-item-cart',['product_id'=>$item->ID])}}"><i class="ti-close"></i></a></td>
                                </tr>
                                @endforeach
                                @else
                                    <tr><td colspan="6">You have no items in cart.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="{{route('shop')}}" class="primary-btn continue-shop">Continue shopping</a>
                                <button class="primary-btn up-cart" onclick="getListItemId('update-cart');">Update cart</button>
                            </div>
                    
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>{{$sub_total}}</span></li>
                                    <li class="cart-total">Total <span>{{$sub_total}}</span></li>
                                </ul>
                                <a href="{{route('checkout')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection