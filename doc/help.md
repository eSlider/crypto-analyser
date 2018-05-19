# Addressindex
* `getaddressbalance`
* `getaddressdeltas`
* `getaddressmempool`
* `getaddresstxids`
* `getaddressutxos`

# Blockchain
* `getbestblockhash`
* `getblock` "hash" ( verbose )
* `getblockchaininfo`
* `getblockcount`
* `getblockhash` index
* `getblockhashes` timestamp
* `getblockheader` "hash" ( verbose )
* `getblockheaders` "hash" ( count verbose )
* `getchaintips` ( count branchlen )
* `getdifficulty`
* `getmempoolinfo`
* `getrawmempool` ( verbose )
* `getspentinfo`
* `gettxout` "txid" n ( includemempool )
* `gettxoutproof` ["txid",...] ( blockhash )
* `gettxoutsetinfo`
* `verifychain` ( checklevel numblocks )
* `verifytxoutproof` "proof"

# Control
* `debug` ( 0|1|addrman|alert|bench|coindb|db|lock|rand|rpc|selectcoins|mempool|mempoolrej|net|proxy|prune|http|libevent|tor|zmq|cpay|privatesend|instantsend|masternode|spork|keepass|mnpayments|gobject )
* `getinfo`
* `help` ( "command" )
* `stop`

# Cpay
* `getgovernanceinfo`
* `getpoolinfo`
* `getsuperblockbudget` index
* `gobject` "command"...
* `masternode` "command"...
* `masternodebroadcast` "command"...
* `masternodelist` ( "mode" "filter" )
* `mnsync` [status|next|reset]
* `privatesend` "command"
* `sentinelping` version
* `spork` <name> [<value>]
* `voteraw` <masternode-tx-hash> <masternode-tx-index> <governance-hash> <vote-signal> [yes|no|abstain] <time> <vote-sig>

# Generating
* `generate` numblocks
* `getgenerate`
* `setgenerate` generate ( genproclimit )

# Mining
* `getblocktemplate` ( "jsonrequestobject" )
* `getmininginfo`
* `getnetworkhashps` ( blocks height )
* `prioritisetransaction` <txid> <priority delta> <fee delta>
* `submitblock` "hexdata" ( "jsonparametersobject" )

# Network
* `addnode` "node" "add|remove|onetry"
* `clearbanned`
* `disconnectnode` "node"
* `getaddednodeinfo` dummy ( "node" )
* `getconnectioncount`
* `getnettotals`
* `getnetworkinfo`
* `getpeerinfo`
* `listbanned`
* `ping`
* `setban` "ip(/netmask)" "add|remove" (bantime) (absolute)
* `setnetworkactive` true|false

# Rawtransactions
* `createrawtransaction` [{"txid":"id","vout":n},...] {"address":amount,"data":"hex",...} ( locktime )
* `decoderawtransaction` "hexstring"
* `decodescript` "hex"
* `fundrawtransaction` "hexstring" includeWatching
* `getrawtransaction` "txid" ( verbose )
* `sendrawtransaction` "hexstring" ( allowhighfees instantsend )
* `signrawtransaction` "hexstring" ( [{"txid":"id","vout":n,"scriptPubKey":"hex","redeemScript":"hex"},...] ["privatekey1",...] sighashtype )

# Util
* `createmultisig` nrequired ["key",...]
* `estimatefee` nblocks
* `estimatepriority` nblocks
* `estimatesmartfee` nblocks
* `estimatesmartpriority` nblocks
* `validateaddress` "cpayaddress"
* `verifymessage` "cpayaddress" "signature" "message"

# Wallet
* `abandontransaction` "txid"
* `addmultisigaddress` nrequired ["key",...] ( "account" )
* `backupwallet` "destination"
* `dumphdinfo`
* `dumpprivkey` "cpayaddress"
* `dumpwallet` "filename"
* `encryptwallet` "passphrase"
* `getaccount` "cpayaddress"
* `getaccountaddress` "account"
* `getaddressesbyaccount` "account"
* `getbalance` ( "account" minconf addlockconf includeWatchonly )
* `getnewaddress` ( "account" )
* `getrawchangeaddress`
* `getreceivedbyaccount` "account" ( minconf addlockconf )
* `getreceivedbyaddress` "cpayaddress" ( minconf addlockconf )
* `gettransaction` "txid" ( includeWatchonly )
* `getunconfirmedbalance`
* `getwalletinfo`
* `importaddress` "address" ( "label" rescan p2sh )
* `importelectrumwallet` "filename" index
* `importprivkey` "cpayprivkey" ( "label" rescan )
* `importpubkey` "pubkey" ( "label" rescan )
* `importwallet` "filename"
* `instantsendtoaddress` "cpayaddress" amount ( "comment" "comment-to" subtractfeefromamount )
* `keepass` <genkey|init|setpassphrase>
* `keypoolrefill` ( newsize )
* `listaccounts` ( minconf addlockconf includeWatchonly)
* `listaddressgroupings`
* `listlockunspent`
* `listreceivedbyaccount` ( minconf addlockconf includeempty includeWatchonly)
* `listreceivedbyaddress` ( minconf addlockconf includeempty includeWatchonly)
* `listsinceblock` ( "blockhash" target-confirmations includeWatchonly)
* `listtransactions`    ( "account" count from includeWatchonly)
* `listunspent` ( minconf maxconf ["address",...] )
* `lockunspent` unlock [{"txid":"txid","vout":n},...]
* `move` "fromaccount" "toaccount" amount ( minconf "comment" )
* `sendfrom` "fromaccount" "tocpayaddress" amount ( minconf addlockconf "comment" "comment-to" )
* `sendmany` "fromaccount" {"address":amount,...} ( minconf addlockconf "comment" ["address",...] subtractfeefromamount use_is use_ps )
* `sendtoaddress` "cpayaddress" amount ( "comment" "comment-to" subtractfeefromamount use_is use_ps )
* `setaccount` "cpayaddress" "account"
* `settxfee` amount
* `signmessage` "cpayaddress" "message"