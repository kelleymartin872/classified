<div class="card">
    <div class="card-body">
        @if(!auth()->user()->avatar)
            <img class="mx-auto d-block img-thumbnail" src="/img/man.jpg" >
        @endif 
        @if(auth()->user()->avatar && !auth()->user()->fb_id)
            <img src="{{Storage::url(auth()->user()->avatar)}}" style="width:100%;">
        @endif
        @if(auth()->user()->fb_id)
            <img src="{{auth()->user()->avatar}}" style="width:100%;">
        @endif
        <p class="text-center"><b>{{auth()->user()->name}}</b></p>
    </div>
    <hr style="border:2px solid blue;">
    <div class="vertical-menu">
        <a href="{{route('user.ads.view')}} " >Dashboard</a>
        <a href="{{route('user.profile')}}" class="{{ request()->is('user/profile') ? 'active' : ''}} ">Profile</a>
        <a href="{{route('user.ads.create')}}" class="{{ request()->is('user/ads/create') ? 'active' : ''}} ">Create Ads</a>
        <a href="{{route('user.ads.view')}} " class="{{ request()->is('user/ads/view') ? 'active' : ''}}">Published Ads</a>
        <a href="{{route('pending.ad')}}" class="{{ request()->is('ad-pending') ? 'active' : ''}}">Pending Ads</a>
        <a href="{{route('saved.ad')}}" class="{{ request()->is('saved-ads') ? 'active' : ''}}">Saved Ads</a>
        <a href="{{route('messages')}}" class="{{ request()->is('messages') ? 'active' : ''}}">Message</a>
    </div>
</div>