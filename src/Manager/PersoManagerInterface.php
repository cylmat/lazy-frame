<?php

interface PersoManagerInterface
{
    public function recoitAttack ( int $force );
    public function attack( PersoManagerInterface $perso );
}