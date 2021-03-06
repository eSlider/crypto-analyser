<?php

namespace Eslider;

class NodeService
{
    /** @var string API Node URL */
    public $apiUrl;

    /** @var string Node name */
    public $name;

    /** @var boolean Is shell */
    public  $isShell = false;

    /** @var bool Is remote shell */
    private $isRemoteShell;

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

        $this->isShell = strpos($this->apiUrl, 'sh://') === 0;
        if ($this->isShell) {
            $this->apiUrl = substr($this->apiUrl, 5);
        }

        $this->isRemoteShell = strpos($this->apiUrl, 'ssh://') === 0;
        if ($this->isRemoteShell) {
            $this->url = parse_url($this->apiUrl);
        }
    }

    /**
     * Query node
     *
     * @param string $args
     * @param bool   $json Convert JSON result to Array?
     * @return string|array
     * @throws \Exception
     */
    public function query($args, $json = true)
    {
        $result = null;
        if($this->isRemoteShell){
            if (is_string($args)) {
                $args = explode(' ', $args);
            }
            $query   = implode(' ', array_map('escapeshellarg', $args));
            $spliter = ':-start-ssh-output-:';
            $cmd     = 'ssh ' . $this->url['user'] . '@' . $this->url['host'] . '<<-"REMOTEQUERY"' . "\n" . 'echo "' . $spliter . '";' . $this->url['query'] . ' ' . $query . " 2>&1\nREMOTEQUERY";
            $result  = explode($spliter, `$cmd`)[1];
            $result  = trim($result);
        }elseif ($this->isShell) {

            if (is_string($args)) {
                $args = explode(' ', $args);
            }

            $cmd = $this->apiUrl . ' ' . implode(' ', array_map(function ($arg) {
                    return "'" . escapeshellarg($arg) . "'";
                }, $args));

            $result = trim(`$cmd 2>&1`);
            if (strpos($result, 'Error:') === 0 || preg_match('/ not found$/', $result)) {
                throw  new \Exception($result);
            }
        } else {
            $url    = $this->apiUrl . rawurlencode($args);
            $result = @file_get_contents($url);
            if (!$result) {
                $error = error_get_last();
                throw new \Exception($error['message']);
            }

            $result = trim($result);
        }

        if ($json) {
            $result = json_decode($result, true);
        }

        return $result;
    }

    /**
     * Get node status info
     *
     * @return array|string
     * @throws \Exception
     */
    public function getStatus()
    {
        return $this->query('mnsync status');
    }

    /**
     * Get node status info
     *
     * @return array|string
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
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
     *
     * @throws \Exception
     */
    public function isBlockGenerationOn()
    {
        return $this->query('getgenerate', false) === 'true';
    }

    /**
     * Lists groups of addresses which have had their common ownership
     * made public by common use as inputs or as the resulting change
     * in past transactions
     *
     * @throws \Exception
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
        if ($this->name) {
            $name = $this->name;
        } elseif ($this->isShell) {
            $name = gethostname();
        } else {
            $url  = parse_url($this->apiUrl);
            $name = $url['host'];
        }
        return $name;
    }

    /**
     * Get IP Address
     *
     * @return string IP address
     */
    public function getIPAddress()
    {
        if ($this->isShell) {
            return `hostname --ip-address`;
        }
        $dnsName = $this->getName();
        return `dig +short $dnsName`;
    }

    /**
     * @return array|string
     * @throws \Exception
     */
    public function getPeers()
    {
        return $this->query('getpeerinfo');
    }
}