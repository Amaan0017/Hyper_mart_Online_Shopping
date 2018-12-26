@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
<div id="content-header">
<div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
<a href="#">Coupons</a> <a href="#" class="current">View Coupons</a> </div>
<h1>Coupons</h1>
@if(Session::has('flash_message_error'))
<div class="alert alert-error alert-block">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
</button>
<strong>{{ session('flash_message_error') }}</strong>
</div>
@endif
@if(Session::has('flash_message_success'))
<div class="alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
</button>
<strong>{{ session('flash_message_success') }}</strong>
</div>
@endif
</div>
<div class="container-fluid">
<hr>
<div class="row-fluid">
<div class="span12">
<div class="widget-box">
<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
<h5>View Coupons</h5>
</div>
<div class="widget-content nopadding">
<table class="table table-bordered data-table">
        <thead>
            <tr>
            <th>Coupon ID</th>
            <th>Coupon Code</th>
            <th>Amount</th>
            <th>Amount Type</th>
            <th>Expiry Date</th>
            <th>Created Date</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($coupons as $coupon)
            <tr class="gradeX">
            <td>{{ $coupon->id }}</td>
            <td>{{ $coupon->coupon_code }}</td>
            <td>
            {{ $coupon->amount }}
            @if($coupon->amount_type == "Percentage") % @else PKR @endif
            </td>
            <td>{{ $coupon->amount_type }}</td>
            <td>{{ $coupon->expiry_date }}</td>
            <td>{{ $coupon->created_at }}</td>
            <td>
            @if($coupon->status=="1") Active @else Inactive @endif
            </td>
            <td class="center">
            <a href="{{url('/admin/edit-coupon/'.$coupon->id)}}" class="btn btn-primary btn-mini" title="Edit Coupons">Edit</a>
            <a  rel="{{$coupon->id}}" rel1="delete-coupon"
            href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Coupons">Delete</a></div>
        </td>              
        @endforeach
        </tbody>
        </table>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
