<div class="nk-sidebar-widget mt-4">
    @if(auth()->check() && auth()->user()->type === 'super-admin')
    @else
        <div class="widget-title">
            <h6 class="overline-title">STATEMENTS</h6>
        </div>
        <ul class="wallet-list">
            <li class="wallet-item wallet-item-add">
                <a href="{{route('statements.full')}}">
                    <div class="wallet-icon"><em class="icon ni ni-file-docs"></em></div>
                    <div class="wallet-text">
                        <h6 class="wallet-name">Full Statement</h6>
                    </div>
                </a>
            </li>
        </ul>
		  <div class="widget-title">
            <h6 class="overline-title">M-PESA</h6>
        </div>
        <ul class="wallet-list">
            <li class="wallet-item wallet-item-add">
                <a href="{{route('get-stk')}}">
                    <div class="wallet-icon"><em class="icon ni ni-file-docs"></em></div>
                    <div class="wallet-text">
                        <h6 class="wallet-name">Generate STK</h6>
                    </div>
                </a>
            </li>
        </ul>
    @endif
</div>
