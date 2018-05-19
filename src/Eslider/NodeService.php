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
     * Get wallet full balance
     *
     * If account is not specified, returns the server's total available balance.
     * If account is specified (DEPRECATED), returns the balance in the account.
     * Note that the account "" is not the same as leaving the parameter out.
     * The server total may be different to the balance in the default "" account.
     *
     * @param string $account          (optional) DEPRECATED. The selected account, or "*" for entire wallet. It may be
     *                                 the default account using "".
     * @param int    $minconf          (numeric, optional, default=1) Only include transactions confirmed at least this
     *                                 many times.
     * @param bool   $addlockconf      (optional, default=false) Whether to add 5 confirmations
     *                                 to transactions locked via InstantSend.
     * @param bool   $includeWatchonly (optional, default=false) Also include balance in watchonly addresses (see
     *                                 'importaddress')
     *
     * @return float
     */
    public function getBalance($account = '*', $minconf = 1, $addlockconf = false, $includeWatchonly = false)
    {
        return $this->query('getbalance'
            . ' "' . $account . '"'
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
     * Lists groups of addresses which have had their common ownership
     * made public by common use as inputs or as the resulting change
     * in past transactions
     */
    public function listAddressGroupings()
    {
        $res = $this->query('listaddressgroupings', true);
        return $res;
    }

    /**
     * Get node name
     *
     * @return string DNS name
     */
    public function getName()
    {
        $url            = parse_url($this->apiUrl);
        $status['name'] = $url['host'];
        return $url['host'];
    }

    /**
     * Get IP Address
     *
     * @return string IP address
     */
    public function getIPAddress()
    {
        $dnsName = $this->getName();
        return `dig +short $dnsName`;
    }
}