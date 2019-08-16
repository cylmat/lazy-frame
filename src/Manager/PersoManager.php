<?php

class PersoManager implements PersoManagerInterface
{
    private $perso;

    public function __construct( PersoEntity $perso )
    {
        $this->perso = $perso;
    }

    public function get()
    {
        return $this->perso;
    }

    public function recoitAttack( int $force )
    {
        $this->perso->setLife( $this->perso->getLife() - $force );
    }

    public function attack( PersoManagerInterface $perso )
    {
        $perso->recoitAttack( $this->perso->getForce() );
    }
}