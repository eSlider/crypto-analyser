<?php

namespace Eslider;

class NodeService
{
    /** @var string API Node URL */
    public $apiUrl;

    /**
     * NodeService constructor.
     *
     * @param $args
     */
    public function __construct($args)
    {
        foreach ($args as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Query node
     *
     * @param string $args
     * @param bool   $json Convert JSON result to Array?
     * @return string|array
     */
    public function query($args, $json = true)
    {
        $url      = $this->apiUrl . rawurlencode($args);
        $contents = trim(file_get_contents($url));
        if ($json) {
            $contents = json_decode($contents, true);
        }
        return $contents;
    }

    /**
     * Get node status info
     *
     * @return array|string
     */
    public function getStatus()
    {
        return $this->query('mnsync status');
    }

    /**
     * Get node status info
     *
     * @return array|string
     */
    public function getBlockChainInfo()
    {
        return $this->query('getblockchaininfo');
    }


    /**
     *
     * If account is not specified, returns the server's total available balance.
     * If account is specified (DEPRECATED), returns the balance in the account.
     * Note that the account "" is not the same as leaving the parameter out.
     * The server total may be different to the balance in the default "" account.
     *
     * Arguments:
     * 1. "account"        (string, optional) DEPRECATED. The selected account, or "*" for entire wallet.
     *                      It may be the default account using "".
     * 2. minconf          (numeric, optional, default=1) Only include transactions confirmed at least this many times.
     * 3. addlockconf      (bool, optional, default=false) Whether to add 5 confirmations
     *                     to transactions locked via InstantSend.
     * 4. includeWatchonly (bool, optional, default=false) Also include balance in watchonly addresses
     *                     (see 'importaddress')
     *
     * @return array|string
     */
    public function getBalance($accoint = '*', $minconf = 1, $addlockconf = false, $includeWatchonly = false)
    {
        return $this->query('getbalance'
            . ' "' . $accoint. '"'
            . ' ' . $minconf
            . ' ' . ($addlockconf ? 'true' : 'false')
            . ' ' . ($includeWatchonly ? 'true' : 'false')
            , false);
    }

    /**
     * Get node status info
     *
     * @return array|string
     */
    public function get()
    {
        return $this->query('getblockchaininfo');
    }

    /**
     * Return if the server is set to generate coins or not. The default is false.
     * It is set with the command line argument -gen (or cpay.conf setting gen)
     * It can also be set with the setgenerate call.
     *
     * Result
     * true|false      (boolean) If the server is set to generate coins or not
     */
    public function isBlockGenerationOn()
    {
        return $this->query('getgenerate', false) === 'true';
    }

    /**
     * Get node name
     *
     * @return string
     */
    public function getName()
    {
        $url            = parse_url($this->apiUrl);
        $status['name'] = $url['host'];
        return $url['host'];
    }

    /**
     * Get IP Address
     * @return mixed
     */
    public function getIPAddress(){
        $dnsName = $this->getName();
        return `dig +short $dnsName`;
    }
}