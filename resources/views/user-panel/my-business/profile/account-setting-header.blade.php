<a href="{{url('my-business/profile')}}" class="pb-3">« Tilbake til Norgeshandel.no</a>

<div class="d-flex justify-content-between py-1 row px-3 my-3" style="background-color: #f4f4f4">
    <div class="px-4" @if(Request::is('account/summary')) style="background-color: #ecdfe2; border-radius: 5px;" @endif>
        <a href="{{url('account/summary')}}">Konto</a>
    </div>

    <div class="px-4" @if(Request::is('account/privacy')) style="background-color: #ecdfe2; border-radius: 5px;" @endif>
        <a href="{{url('account/privacy')}}">Personvern</a>
    </div>

    <div class="px-4" @if(Request::is('account/purchasehistory')) style="background-color: #ecdfe2; border-radius: 5px;" @endif>
        <a href="{{url('account/purchasehistory')}}">Betalingshistorikk</a>
    </div>

    <div class="px-4" @if(Request::is('account/products')) style="background-color: #ecdfe2; border-radius: 5px;" @endif>
        <a href="{{url('account/products')}}">Produkter</a>
    </div>

    <div class="px-4" @if(Request::is('account/redeem')) style="background-color: #ecdfe2; border-radius: 5px;" @endif>
        <a href="{{url('account/redeem')}}">Innløse</a>
    </div>

</div>