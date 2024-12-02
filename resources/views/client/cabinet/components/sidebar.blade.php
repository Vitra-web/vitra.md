@php
    $current_route = request()->route()->getName();

@endphp

<div class="cabinet_sidebar">
    <p class="user_name">{{$user->name}}</p>

    <div class="user_photo_container">
        <img class="user_photo" src="{{isset($user->picture_url) ? $user->picture_url :  url('images/upload_photo.png')}}" alt="user_photo">
    </div>
    <ul class="cabinet_sidebar_nav">
        <li class="cabinet_sidebar_item">
            <a href="{{route('client.account')}}" class="cabinet_sidebar_link">
                <img class="cabinet_sidebar_img" src="/images/cabinet/cont.png" alt="Cont-image">
                <p class="cabinet_sidebar_title {{str_contains($current_route, 'account') ? 'active':''}}">{{trans('cabinet.cont')}}</p>
            </a>
        </li>
        <li class="cabinet_sidebar_item">
            <a href="{{route('client.orders')}}" class="cabinet_sidebar_link">
                <img class="cabinet_sidebar_img" src="/images/cabinet/order.png" alt="Order-image">
                <p class="cabinet_sidebar_title">{{trans('cabinet.orders')}}</p>
            </a>
        </li>
        <li class="cabinet_sidebar_item">
            <a href="{{route('client.favorites')}}" class="cabinet_sidebar_link">
                <img class="cabinet_sidebar_img" src="/images/cabinet/favorite.png" alt="favorite-image">
                <p class="cabinet_sidebar_title">{{trans('cabinet.favorite')}}</p>
            </a>
        </li>
        <li class="cabinet_sidebar_item">
            <a href="{{route('client.logout')}}" class="cabinet_sidebar_link">
                <img class="cabinet_sidebar_img" src="/images/cabinet/logout.png" alt="log_out-image">
                <p class="cabinet_sidebar_title">{{trans('cabinet.log_out')}}</p>
            </a>

        </li>
    </ul>
</div>
