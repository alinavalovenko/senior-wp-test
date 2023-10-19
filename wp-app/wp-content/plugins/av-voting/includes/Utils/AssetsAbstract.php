<?php

namespace AvVoting\Utils;

abstract class AssetsAbstract
{
    public function __invoke()
    {
        $this->styles();
        $this->scripts();
    }

    abstract public function styles();
    abstract public function scripts();
}