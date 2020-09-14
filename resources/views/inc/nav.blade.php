<div class="topbar sticky-top">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#"
        ><span class="icon"
            ><img src="{{asset('assets/logo-light-icon.png')}}" alt="image"
                /></span>
            <span class="name">sitename</span>
        </a>
        <ul class="navbar-nav mr-auto toggleLeftSideBar">
            <li>
                <label for="toggleLeftSideBar"><i class="mdi mdi-menu"></i></label>
                <input type="checkbox" name="" id="toggleLeftSideBar" />
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <span class="icon">
                    <img class="rounded-circle" src="{{ asset('assets/profile_img.jpg') }}" alt="user profile image"/>
                  </span>
                    <span class="text">{{ Auth::user()->name }}</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
