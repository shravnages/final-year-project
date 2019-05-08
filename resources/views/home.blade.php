@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard (ID: {{ $id }})</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>  
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif


                    <b>You have a balance of {{ $balance }} DGP.</b><br />
                    <!--<b>token_name</b><br />-->

                    <b>Recent Transactions:</b><br />
                    <ul>
                        @for ($i = count($transactions)-1; $i >= 0; $i-- )
                            @if (strpos($transactions[$i]->stripe_transaction, 'Transfer') !== false)
                                @if ($transactions[$i]->amount > 0)
                                <li>Received &pound;{{ number_format($transactions[$i]->amount, 2) }} from 
                                    {{ strlen($n = substr($transactions[$i]->stripe_transaction, 8)) > 0 ? $n : "Unknown" }} 
                                    on {{ $transactions[$i]->created_at }}.</li>
                                @else
                                <li>Transferred &pound;{{ number_format($transactions[$i]->amount *-1, 2) }} to 
                                    {{ strlen($n = substr($transactions[$i]->stripe_transaction, 8)) > 0 ? $n : "Unknown" }} 
                                    on {{ $transactions[$i]->created_at }}.</li>
                                @endif
                            @else
                                <li>Paid &pound;{{ number_format($transactions[$i]->amount, 2) }} 
                                    on {{ $transactions[$i]->created_at }}.</li>
                            @endif
                        @endfor
                    </ul>

                    <p></p>
                    <a class="btn btn-primary" href="/pay">Purchase Digipounds</a>
                    <a class="btn btn-primary" href="/transfer">Transfer Digipounds</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
