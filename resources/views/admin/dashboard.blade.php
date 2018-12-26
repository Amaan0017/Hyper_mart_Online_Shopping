@extends('layouts.adminLayout.admin_design');
@section('content')

<!--main-container-part-->
<div id="content" style="margin-top:-75px;">
    <!--breadcrumbs-->
      <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
      </div>
    <!--End-breadcrumbs-->
    
    <!--Action boxes-->
      <div class="container-fluid">
        <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lb"> <a href="{{url ('/admin/dashboard')}}"> <i class="icon-dashboard"></i> My Dashboard </a> </li>
          <li class="bg_lg span3"> <a href="{{url ('/admin/view-categories')}}"> <i class="icon icon-list"></i><span class="label label-important">{{$categoryCount->total()}}</span> Categories</a> </li>
            <li class="bg_ly"> <a href="{{url ('/admin/view-products')}}"> <i class="icon icon-list"></i><span class="label label-success">{{$productsAll->total()}}</span> Products </a> </li>
            <li class="bg_lo"> <a href="{{url ('/admin/view-coupons')}}"> <i class="icon icon-list"></i><span class="label label-info">{{$couponCount->total()}}</span> Coupons</a> </li>
            <li class="bg_ls"> <a href="{{url ('/admin/view-orders')}}"> <i class="icon-fullscreen"></i><span class="label label-warning">{{$orderCount->total()}}</span> Orders</a> </li>
    
          </ul>
        </div>
    <!--End-Action boxes-->    
    
    <!--Chart-box-->    
        <div class="row-fluid">
          <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
              <h5>Site Analytics</h5>
            </div>
            <div class="widget-content" >
              <div class="row-fluid">
                <div class="span12">
                    <ul class="site-stats">
                    <li class="bg_lh"><i class="icon-user"></i> <strong>{{$userCount->total()}}</strong> <h4>Total Users</h4></li>
                        <li class="bg_lh"><i class="icon-plus"></i> <strong>{{$productsAll->total()}}</strong> <h4>Total Products </h4></li>
                        <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>{{$orderCount->total()}}</h4> <h4>Total Shop</h4></li>
                        <li class="bg_lh"><i class="icon-tag"></i> <strong>{{$orderCount->total()}}</h4> <h4>Total Orders</h4></li>
                        <li class="bg_lh"><i class="icon-repeat"></i> <strong>10</strong> <h4>Pending Orders</h4></li>
                        <li class="bg_lh"><i class="icon-globe"></i> <strong>10</strong> <h4>Online Orders</h4></li>
                      </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
    <!--End-Chart-box--> 
        <hr/>

      </div>
    </div>
    
    <!--end-main-container-part-->
@endsection