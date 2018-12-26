<!--Header-part-->
<div id="header">
  <h1><a href="{{ url('/admin/dashboard') }}">Laravel Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
  <li class=""><a title="" href="{{url('/admin/settings')}}"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
    <li class=""><a title="" href="{{url('/logout')}}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    <li class=""><a title="" target="_blank" href="{{url('/')}}"><i class="icon icon-site"></i> <span class="text">Visit Site</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
