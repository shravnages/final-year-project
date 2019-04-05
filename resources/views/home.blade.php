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


                    <b>You have a balance of {!! $balance !!} DGP.</b><br />

                    <b>Transactions:</b><br />
                    <ul>
                        @foreach ($transactions as $t)
                            @if (strpos($t->stripe_transaction, 'Transfer') !== false)
                                @if ($t->amount > 0)
                                <li>Received &pound;{{ number_format($t->amount, 2) }} from 
                                    {{ strlen($n = substr($t->stripe_transaction, 8)) > 0 ? $n : "Unknown" }} 
                                    on {{ $t->created_at }}.</li>
                                @else
                                <li>Transferred &pound;{{ number_format($t->amount *-1, 2) }} to 
                                    {{ strlen($n = substr($t->stripe_transaction, 8)) > 0 ? $n : "Unknown" }} 
                                    on {{ $t->created_at }}.</li>
                                @endif
                            @else
                                <li>Paid &pound;{{ number_format($t->amount, 2) }} on {{ $t->created_at }}.</li>
                            @endif
                        @endforeach
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
