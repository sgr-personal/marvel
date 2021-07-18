<aside class="col-md-3">
    <div class="card mb-3">
        <div class="card-body">
            <div class="profile-header-container">
                <div class="profile-header-img">
                    <a class="navbar-brand ml-2" href="{{ route('home') }}">
                        <a href="{{ route('home') }}"><img src="{{ _asset(Cache::get('web_logo')) }}" alt="logo"></a>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group">
        <a href="{{ route('my-account') }}" class="list-group-item"><em class="fa fa-user"></em><span class="side-menu">{{__('msg.my_profile')}}</span></a>
        <a href="{{ route('change-password') }}" class="list-group-item"><em class="fa fa-asterisk"></em><span class="side-menu">{{__('msg.change_password')}}</span></a>
        <a href="{{ route('my-orders') }}" class="list-group-item"><em class="fas fa-taxi"></em><span class="side-menu">{{__('msg.my_orders')}}</span></a>
        <a href="{{ route('notification') }}" class="list-group-item"><em class="fa fa-bell"></em><span class="side-menu">{{__('msg.notifications')}}</span></a>
        <a href="{{ route('favourite') }}" class="list-group-item"><em class="fa fa-heart"></em><span class="side-menu">{{__('msg.favourite')}}</span></a>
        <a href="{{ route('wallet-history') }}" class="list-group-item"><em class="fab fa-google-wallet"></em><span class="side-menu">{{__('msg.wallet_history')}}</span></a>
        <a href="{{ route('transaction-history') }}" class="list-group-item"><em class="fa fa-outdent"></em><span class="side-menu">{{__('msg.transaction_history')}}</span></a>
        <a href="{{ route('refer-earn') }}" class="list-group-item"><em class="fa fa-user-plus"></em><span class="side-menu">{{__('msg.refer_and_earn')}}</span></a>
        <a href="{{ route('addresses') }}" class="list-group-item"><em class="fa fa-wrench"></em><span class="side-menu">{{__('msg.manage_addresses')}}</span></a>
        @if(isset($data['profile']['is_agent']) && intval($data['profile']['is_agent']) == 1)
            <a href="{{ route('agent-commission') }}" class="list-group-item"><em class="fa fa-money-check"></em><span class="side-menu">{{__('msg.agent_commission')}}</span></a>
        @endif
        <a href="{{ route('logout') }}" class="list-group-item"><em class="fa fa-sign-out-alt"></em><span class="side-menu">{{__('msg.logout')}}</span></a>
    </div>
</aside>
