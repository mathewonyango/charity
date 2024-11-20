{{--@if(is_agent() || is_merchant())--}}
    <div class="nk-sidebar-widget mt-3">
        <div class="widget-title">
            <h6 class="overline-title">DEPOSIT & WITHDRAW</h6>
        </div>
        <ul class="wallet-list">

{{--            @if(is_agent())--}}
                <li class="wallet-item wallet-item-add">
                    <a href="{{route('customer-deposit')}}">
                        <div class="wallet-icon"><em class="icon ni ni-plus-circle"></em></div>
                        <div class="wallet-text">
                            <h6 class="wallet-name">Customer Deposit</h6>
                        </div>
                    </a>
                </li>
{{--            @endif--}}

{{--            @if(is_agent())--}}
                <li class="wallet-item wallet-item-add">
                    <a href="{{route('cashless-withdraw')}}">
                        <div class="wallet-icon"><em class="icon ni ni-minus-round-fill"></em></div>
                        <div class="wallet-text">
                            <h6 class="wallet-name">Cashless Withdraw</h6>
                        </div>
                    </a>
                </li>
{{--            @endif--}}

{{--            @if(is_agent())--}}
                <li class="wallet-item wallet-item-add">
                    <a href="{{route('customer-withdraw')}}">
                        <div class="wallet-icon"><em class="icon ni ni-minus-circle"></em></div>
                        <div class="wallet-text">
                            <h6 class="wallet-name">Customer Withdraw</h6>
                        </div>
                    </a>
                </li>
{{--            @endif--}}



{{--            @if(is_merchant())--}}
                <li class="wallet-item wallet-item-add">
                    <a href="{{route('merchant-withdraw')}}">
                        <div class="wallet-icon"><em class="icon ni ni-minus-round-fill"></em></div>
                        <div class="wallet-text">
                            <h6 class="wallet-name">Merchant Account Withdraw</h6>
                        </div>
                    </a>
                </li>
{{--            @endif--}}

        </ul>
    </div>
{{--@endif--}}
