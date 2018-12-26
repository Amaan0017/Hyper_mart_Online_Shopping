@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top:20px;"> <!--form-->
    <div class="container">
    <div class="breadcrumbs">
            <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Check Out</li>
            </ol>
    </div>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_error') }}</strong>
    </div>
    @endif
    <form action="{{url('/checkout')}}" method="POST"> {{csrf_field()}}
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Bill To</h2>
                <div class="form-group">
                <input name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif 
                type="text" placeholder="Billing Name" class="form-control" />
                </div>
                <div class="form-group">
                <input name="billing_address" id="billing_address" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif 
                 type="text" placeholder="Billing Address" class="form-control"/>
                </div>
                <div class="form-group">
                <input name="billing_city" id="billing_city" @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif
                 type="text" placeholder="Billing City" class="form-control"/>
                </div>
                <div class="form-group">
                <input name="billing_state" id="billing_state" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif
                 type="text" placeholder="Billing State" class="form-control"/>
                </div>
                <div class="form-group">
                <select name="billing_country" id="billing_country" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                <option value="{{$country->country_name}}" 
                @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>
                {{$country->country_name}}</option>
                @endforeach
                </select>
                </div>
                <div class="form-group">
                <input type="text" name="billing_pincode" id="billing_pincode" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif
                 placeholder="Billing Pincode" class="form-control"/>
                </div>
                <div class="form-group">
                <input name="billing_mobile" id="billing_mobile" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif
                 type="text" placeholder="Billing Mobile" class="form-control"/>
                </div>
                <div class="form-check">
                <input value="{{$userDetails->name}}" type="checkbox" class="form-check-input" id="billtoship">
                <label class="form-check-label" for="billtoship">Shipping Address Same As Billing Address</label>
                </div>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2></h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Ship To</h2>
                <div class="form-group">
                <input type="text" name="shipping_name" id="shipping_name" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif placeholder="Shipping Name" class="form-control" />
                </div>
                <div class="form-group">
                <input type="text" name="shipping_address" id="shipping_address" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif placeholder="Shipping Address" class="form-control"/>
                </div>
                <div class="form-group">
                <input type="text" name="shipping_city" id="shipping_city" @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif placeholder="Shipping City" class="form-control"/>
                </div>
                <div class="form-group">
                <input type="text" name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif placeholder="Shipping State" class="form-control"/>
                </div>
                <div class="form-group">
                <select name="shipping_country" id="shipping_country" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                <option value="{{$country->country_name}}"@if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>
                    {{$country->country_name}}</option>
                @endforeach
                </select>
                </div>
                <div class="form-group">
                <input type="text" name="shipping_pincode" id="shipping_pincode" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif placeholder="Shipping Pincode" class="form-control"/>
                </div>
                <div class="form-group">
                <input type="text" name="shipping_mobile" id="shipping_mobile" @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif placeholder="Shipping Mobile" class="form-control"/>
                </div>
            <button type="submit" class="btn btn-mini check_out">CheckOut</button>
                </div><!--/sign up form-->
            </div>
        </div>
    </form>
    </div>
</section><!--/form-->

@endsection