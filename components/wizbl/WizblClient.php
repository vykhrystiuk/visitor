<?php

namespace app\components\wizbl;

use app\components\wizbl\interfaces\WizblClientInterface;

class WizblClient implements WizblClientInterface
{
    private $dockerExec;

    /**
     * WizblClient constructor.
     */
    public function __construct()
    {
        $this->dockerExec = \app\helpers\Param::get('wizbl_docker_exec');
    }

    /**
     * @param string $command
     * @return string
     */
    private function exec(string $command)
    {
        return shell_exec(sprintf('%s %s', $this->dockerExec, $command));
    }

    /**
     * @return string
     */
    public function getBlockStash(): string
    {
        return $this->exec('getbestblockhash');
    }

    public function getAddressByAccount(): array
    {
        return json_decode($this->exec('getaddressesbyaccount ""'));
    }

    public function getWalletInfo(): array
    {
        return json_decode($this->exec('getwalletinfo'), true);
    }

    public function getListAccount(): array
    {
        return json_decode($this->exec('listaccounts'), true);
    }

    /**
     * get hash of transaction
     *
     * @param $address
     * @param $amount
     * @param string $emailFrom
     * @return string
     */
    public function sendFrom($address, $amount, $emailFrom = '""'): string
    {
        return $this->exec(sprintf(
            'sendfrom %s %s %s',
            $emailFrom,
            $address,
            $amount
        ));
    }

    public function getTransaction(string $hash)
    {
        return $this->exec(sprintf('gettransaction %s', $hash));
    }
}
