<?php

namespace AppBundle\Entity;

use AppBundle\Entity\SymfonyUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * NormalUser
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NormalUserRepository")
 */
class NormalUser extends SymfonyUser {

    protected $regra = 'NORMALUSER';

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Propriedade do expositor no set inválido');
        }

        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Propriedade do expositor no get inválido');
        }

        return $this->$method();
    }

    /**
     * Set tipoNormalUserId
     *
     * @param integer $tipoNormalUserId
     * @return NormalUser
     */
    public function setTipoNormalUserId($tipoNormalUserId) {
        $this->tipoNormalUserId = $tipoNormalUserId;

        return $this;
    }

    public function getNomeClasse() {
        return 'NormalUser';
    }

}
