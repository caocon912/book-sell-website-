@extends('layouts.cms_app')
@section('content')
<section id="main-content">
    <section class="wrapper">
        <h2>Hôm nay, {{$date ?? ''}}</h2>
        <h3>Tin nhắn: </h3>
        <h3>Người đăng kí mới : {{$count_new_acc ?? ''}}</h3>
        <h3>Tổng số đơn hàng mới: {{$count_new_orders ?? ''}} </h3>
        <h3>Sản phẩm sắp hết số lượng: {{$count_outstock_products ?? ''}}</h3>    
    </section>
</section>
@endsection