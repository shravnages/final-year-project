
var Tx = require('ethereumjs-tx');
var Web3 = require('web3');
var web3 = new Web3(new Web3.providers.HttpProvider('http://127.0.0.1:8545/'));
var myAddress = "0x0B5e6646f3665E5132FDdAAbF1aF95386E70148f";
var toAddress = "0x0B5e6646f3665E5132FDdAAbF1aF95386E70148f";
var amount = web3.utils.toHex(1e16);

function tryThis(arg) {
    console.log("Hello");
}