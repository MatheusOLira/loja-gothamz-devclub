<?php

class LightOpenID
{
    public $identity;
    public $returnUrl;
    public $required = [];
    public $optional = [];
    private $server;
    private $version = '2.0';
    private $trustRoot;

    function __construct($host)
    {
        $this->trustRoot = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $host;
        $this->returnUrl = $this->trustRoot . $_SERVER['REQUEST_URI'];
    }

    function authUrl()
    {
        return "https://steamcommunity.com/openid/login?" . http_build_query([
            'openid.ns' => 'http://specs.openid.net/auth/2.0',
            'openid.mode' => 'checkid_setup',
            'openid.return_to' => $this->returnUrl,
            'openid.realm' => $this->trustRoot,
            'openid.identity' => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select'
        ]);
    }

    function validate()
    {
        return isset($_GET['openid_claimed_id']);
    }
}