<!-- Left Sidebar -->
<aside class="leftsidebar" id="navbarSupportedContent">
    <div class="leftsidebar-nav">
        <ul class="noselect">
            <li class="{{(Request::segment(2)=='dashboard') ? 'active_class': ''}}">
                <a href="{{route("client.dashboard")}}">
                    <span class="mdi mdi-view-dashboard"></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="{{(Request::segment(3)=='orders') ? 'active_class': ''}}">
                <a href="{{route("client.orders.show", [Auth::user()->id])}}" >
                    <span class="mdi mdi-format-list-bulleted"></span>
                    <span class="text">My Orders</span>
                </a>
            </li>
            <li class="{{(Request::segment(2)=='profile') ? 'active_class': ''}}">
                <a href="{{route("profile")}}">
                    <span class="mdi mdi-face"></span>
                    <span class="text">My Profile</span>
                </a>
            </li>
            <li class="{{(Request::segment(2)=='payments') ? 'active_class': ''}}">
                <a href="{{route("payments")}}">
                    <span class="mdi mdi-bank"></span>
                    <span class="text">Payments</span>
                </a>
            </li>
            <li class="{{(Request::segment(2)=='messages') ? 'active_class': ''}}" >
                <a href="{{ route("messages")}}" >
                    <span class="mdi mdi-message-bulleted"></span>
                    <span class="text">Messages</span>
                </a>
            </li>
            <li class="{{(Request::segment(2)=='reviews') ? 'active_class': ''}}">
                <a href="{{route("reviews")}}">
                    <span class="mdi mdi-star"></span>
                    <span class="text">Reviews</span>
                </a>
            </li>
            <li class="{{(Request::segment(2)=='support') ? 'active_class': ''}}">
                <a href="{{route("support")}}">
                    <span class="mdi mdi-deskphone"></span>
                    <span class="text">Support</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="leftsidebar-footer">
        <ul
            class="d-flex flex-md-column pl-md-3 pl-xl-0 flex-xl-row justify-content-around"
        >
            <li><span class="mdi mdi-settings"></span></li>
            <li><span class="mdi mdi-message-bulleted"></span></li>
            <li>
                <a class="text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                    <span class="mdi mdi-power"></span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
<!-- #END# Left Sidebar -->
