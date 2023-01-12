<?php

namespace App\DataTransferObjects;

abstract class AbstractBaseData
{
    public function all(): array
    {
        return (array) $this;
    }
}
