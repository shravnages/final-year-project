@extends('layouts.app')

@section('content')

<div class="container">
<table border="1">
    <thead>
        <th><strong>Proof of GBP</strong></th>
        <th><strong>Proof of DGP</strong></th>
    </thead>
    <tbody>
    <tr>
    <td>
    &pound;{{$balance}} in the reserve account.
    </td>
    <td width="50%">
        <div id="digipounds"></div>
        <div id="remaining"></div>
        <div></div>
        <ul>
            @foreach ($users as $user)
                <li> Issued {{$user->balance}} DGP to {{$user->account}}. </li>
            @endforeach
        </ul>
        <div>Verify at 
            <a href="https://ropsten.etherscan.io/token/0xf6cd47eb9ca7e1a94e3b70722e9d7964fe14a811#balances">
            Etherscan. </a><small>*</small>
        </div>
    </td>
    </tbody>
    
</table>
<div>Updated in real time. Last transaction on {{$date}}.</div>
<small>*Exact totals of users may be subject to independent transactions, but total amount of DGP issued always correct.</small>
</div>

<script>
    var balance = 0;
    var accountAddress =  "0x0b5e6646f3665e5132fddaabf1af95386e70148f";
    token.balanceOf.call(accountAddress, function(err, bal) {
        if (!err) {
            balance = bal.toNumber(); 
            balance /= 1000000000000000000;
            currentbalance = Math.round(100000000 - balance); //total supply
            document.getElementById("digipounds").innerText = currentbalance + " DGP issued." 
            document.getElementById("remaining").innerText = balance + " DGP remaining in stock.";
        }
    });
</script>


</div>
@endsection