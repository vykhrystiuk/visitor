<?php

namespace app\components\wizbl\interfaces;

interface WizblClientInterface
{
    public function getBlockStash(): string;

    public function getAddressByAccount(): array;

    public function getWalletInfo(): array;

    public function getListAccount(): array;

    public function sendFrom($address, $amount, $emailFrom = '""'): string;

    public function getTransaction(string $hash);
}
