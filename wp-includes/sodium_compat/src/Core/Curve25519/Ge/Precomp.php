<?php

if (class_exists("ParagonIE_Sodium_Core_Curve25519_Ge_Precomp", false)) {
    return;
}

/**
 * Class ParagonIE_Sodium_Core_Curve25519_Ge_Precomp
 */
class ParagonIE_Sodium_Core_Curve25519_Ge_Precomp
{
    /**
     * @var ParagonIE_Sodium_Core_Curve25519_Fe
     */
    public $yplusx;

    /**
     * @var ParagonIE_Sodium_Core_Curve25519_Fe
     */
    public $yminusx;

    /**
     * @var ParagonIE_Sodium_Core_Curve25519_Fe
     */
    public $xy2d;

    /**
     * ParagonIE_Sodium_Core_Curve25519_Ge_Precomp constructor.
     *
     * @internal You should not use this directly from another application
     *
     * @param ParagonIE_Sodium_Core_Curve25519_Fe $yplusx
     * @param ParagonIE_Sodium_Core_Curve25519_Fe $yminusx
     * @param ParagonIE_Sodium_Core_Curve25519_Fe $xy2d
     */
    public function __construct($yplusx = null, $yminusx = null, $xy2d = null)
    {
        if ($yplusx === null) {
            $yplusx = new ParagonIE_Sodium_Core_Curve25519_Fe();
        }
        if (!($yplusx instanceof ParagonIE_Sodium_Core_Curve25519_Fe)) {
            throw new TypeError(
                "Argument 1 must be an instance of ParagonIE_Sodium_Core_Curve25519_Fe"
            );
        }
        $this->yplusx = $yplusx;
        if ($yminusx === null) {
            $yminusx = new ParagonIE_Sodium_Core_Curve25519_Fe();
        }
        if (!($yminusx instanceof ParagonIE_Sodium_Core_Curve25519_Fe)) {
            throw new TypeError(
                "Argument 2 must be an instance of ParagonIE_Sodium_Core_Curve25519_Fe"
            );
        }
        $this->yminusx = $yminusx;
        if ($xy2d === null) {
            $xy2d = new ParagonIE_Sodium_Core_Curve25519_Fe();
        }
        if (!($xy2d instanceof ParagonIE_Sodium_Core_Curve25519_Fe)) {
            throw new TypeError(
                "Argument 3 must be an instance of ParagonIE_Sodium_Core_Curve25519_Fe"
            );
        }
        $this->xy2d = $xy2d;
    }
}
