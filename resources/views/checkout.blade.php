@extends('layouts.app')
@section('content')
<script
    src="https://www.paypal.com/sdk/js?client-id=ASnMVy-Y7Lkt77djzs2A-MeMcyNbL2Lalap0Z4mZuq0o3YK2lCRlpnrP3SOFPT2BvIirMbNpB-masXdy"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{route('shop')}}">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="{{route('checkout-submit')}}" class="checkout-form" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            @if (!Auth::check())
                                <a href="{{route('login')}}" class="content-btn">Click Here To Login</a>
                            @endif
                        </div>
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fir">Full name<span>*</span></label>
                                <input type="text" id="fir" name="full-name" @if($customer_info != null) value="{{$customer_info->NAME}}" @else value="" @endif >
                            </div>
                            <div class="col-lg-12">
                                <label for="cun-name">Home address</label>
                                <input type="text" id="cun-name" name="address_1" @if($customer_info != null) value="{{$customer_info->ADDRESS_1}}" @else value="" @endif >
                            </div>
                            <!-- <div class="col-lg-12">
                                <label for="cun">Country<span>*</span></label>
                                <input type="text" id="cun" name="country">
                            </div> -->
                            <div class="col-lg-12">
                                <label for="street">Company address<span>*</span></label>
                                <input type="text" id="street" class="street-first" name="address_2" @if($customer_info != null) value="{{$customer_info->ADDRESS_2}}" @else value="" @endif >
                            </div>
                            <!-- <div class="col-lg-12">
                                <label for="zip">Postcode / ZIP (optional)</label>
                                <input type="text" id="zip" name="postcode">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span></label>
                                <input type="text" id="town" name="">
                            </div> -->
                            <div class="col-lg-6">
                                <label for="email">Email Address<span>*</span></label>
                                <input type="text" id="email" name="email" @if($customer_info != null) value="{{$customer_info->EMAIL}}" @else value="" @endif >
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" id="phone" name="phone" @if($customer_info != null) value="{{$customer_info->PHONE_NUMBER}}" @else value="" @endif >
                            </div>
                            <!-- <div class="col-lg-12">
                                <div class="create-item">
                                    <label for="acc-create">
                                        Create an account?
                                        <input type="checkbox" id="acc-create">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <input type="text" placeholder="Enter Your Coupon Code" name="coupon-code">
                        </div>
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    @if ($cart_items != null&&count($cart_items)!=0) 
                                    @foreach($cart_items as $item)
                                        <li class="fw-normal">{{$item->NAME}} x {{$item->QUANLITY}} <span>{{$item->QUANLITY * $item->NEW_PRICE}}</span></li>
                                    @endforeach
                                    @else
                                        <li class="fw-normal"><b>You dont have any item</b></li> 
                                    @endif
                                    <li class="fw-normal">Subtotal <span>{{$total_pay}}</span></li>
                                    <li class="total-price">Total <span>{{$total_pay}}</span></li>
                                    <input type="hidden" name = "total-price" id = "total_price" value={{$total_pay}}>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Cheque Payment
                                            <input type="checkbox" id="pc-check">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Paypal
                                            <div name="paypal" id="paypal">
                                            <input type="checkbox" id="pc-paypal">
                                            <div id="paypal-button-container"></div>
                                            <span class="checkmark"></span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->
<script>
    var total_price = document.getElementById("total_price").value;
    var price_usd = Math.round(parseFloat(parseInt(total_price)/22000)*1000)/1000;
    console.log(price_usd);
    paypal.Buttons({
        createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
            purchase_units: [{
            amount: {
                value: 0.05
            }
            }]
        });
        },
        onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            alert('Transaction completed by ' + details.payer.name.given_name);
        });
        }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.
</script>
@endsection
