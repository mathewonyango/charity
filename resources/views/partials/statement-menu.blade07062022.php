<div class="nk-sidebar-widget mt-4">
    @if(auth()->check() && auth()->user()->type === 'super-admin'|| auth()->user()->type == 'Institution Checker'||auth()->user()->type === 'Institutional Maker')
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

         {{-- <div class="widget-title">
            <h6 class="overline-title">MPESA</h6>
        </div>
        <ul class="wallet-list">
            <li class="wallet-item wallet-item-add">
                <form action="{{ route('generate-stk') }}" method="POST" >
                    @csrf
                     <div class="wallet-icon"><em class="icon ni ni-mobile-phone"></em></div>

                    <button type="submit" class="btn btn-link text-decoration-none">
                        <div class="wallet-text">
                        <h6 class="wallet-name">STK Push</h6>
                    </div></button>
                </form>
                {{-- <a href="{{route('generate-stk')}}"> --}}

                {{-- </a> --}}
            {{-- </li> --}}

    @endif
</div>
