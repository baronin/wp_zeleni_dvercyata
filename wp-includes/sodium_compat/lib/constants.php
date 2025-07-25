<?php
namespace Sodium;

require_once dirname(dirname(__FILE__)) . "/autoload.php";

use ParagonIE_Sodium_Compat;

const CRYPTO_AEAD_AES256GCM_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_AES256GCM_KEYBYTES;
const CRYPTO_AEAD_AES256GCM_NSECBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_AES256GCM_NSECBYTES;
const CRYPTO_AEAD_AES256GCM_NPUBBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_AES256GCM_NPUBBYTES;
const CRYPTO_AEAD_AES256GCM_ABYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_AES256GCM_ABYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_KEYBYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_NSECBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_NSECBYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_NPUBBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_NPUBBYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_ABYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_ABYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_IETF_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_IETF_KEYBYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_IETF_NSECBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_IETF_NSECBYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES;
const CRYPTO_AEAD_CHACHA20POLY1305_IETF_ABYTES = ParagonIE_Sodium_Compat::CRYPTO_AEAD_CHACHA20POLY1305_IETF_ABYTES;
const CRYPTO_AUTH_BYTES = ParagonIE_Sodium_Compat::CRYPTO_AUTH_BYTES;
const CRYPTO_AUTH_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_AUTH_KEYBYTES;
const CRYPTO_BOX_SEALBYTES = ParagonIE_Sodium_Compat::CRYPTO_BOX_SEALBYTES;
const CRYPTO_BOX_SECRETKEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_BOX_SECRETKEYBYTES;
const CRYPTO_BOX_PUBLICKEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_BOX_PUBLICKEYBYTES;
const CRYPTO_BOX_KEYPAIRBYTES = ParagonIE_Sodium_Compat::CRYPTO_BOX_KEYPAIRBYTES;
const CRYPTO_BOX_MACBYTES = ParagonIE_Sodium_Compat::CRYPTO_BOX_MACBYTES;
const CRYPTO_BOX_NONCEBYTES = ParagonIE_Sodium_Compat::CRYPTO_BOX_NONCEBYTES;
const CRYPTO_BOX_SEEDBYTES = ParagonIE_Sodium_Compat::CRYPTO_BOX_SEEDBYTES;
const CRYPTO_KX_BYTES = ParagonIE_Sodium_Compat::CRYPTO_KX_BYTES;
const CRYPTO_KX_SEEDBYTES = ParagonIE_Sodium_Compat::CRYPTO_KX_SEEDBYTES;
const CRYPTO_KX_PUBLICKEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_KX_PUBLICKEYBYTES;
const CRYPTO_KX_SECRETKEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_KX_SECRETKEYBYTES;
const CRYPTO_GENERICHASH_BYTES = ParagonIE_Sodium_Compat::CRYPTO_GENERICHASH_BYTES;
const CRYPTO_GENERICHASH_BYTES_MIN = ParagonIE_Sodium_Compat::CRYPTO_GENERICHASH_BYTES_MIN;
const CRYPTO_GENERICHASH_BYTES_MAX = ParagonIE_Sodium_Compat::CRYPTO_GENERICHASH_BYTES_MAX;
const CRYPTO_GENERICHASH_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_GENERICHASH_KEYBYTES;
const CRYPTO_GENERICHASH_KEYBYTES_MIN = ParagonIE_Sodium_Compat::CRYPTO_GENERICHASH_KEYBYTES_MIN;
const CRYPTO_GENERICHASH_KEYBYTES_MAX = ParagonIE_Sodium_Compat::CRYPTO_GENERICHASH_KEYBYTES_MAX;
const CRYPTO_SCALARMULT_BYTES = ParagonIE_Sodium_Compat::CRYPTO_SCALARMULT_BYTES;
const CRYPTO_SCALARMULT_SCALARBYTES = ParagonIE_Sodium_Compat::CRYPTO_SCALARMULT_SCALARBYTES;
const CRYPTO_SHORTHASH_BYTES = ParagonIE_Sodium_Compat::CRYPTO_SHORTHASH_BYTES;
const CRYPTO_SHORTHASH_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_SHORTHASH_KEYBYTES;
const CRYPTO_SECRETBOX_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_SECRETBOX_KEYBYTES;
const CRYPTO_SECRETBOX_MACBYTES = ParagonIE_Sodium_Compat::CRYPTO_SECRETBOX_MACBYTES;
const CRYPTO_SECRETBOX_NONCEBYTES = ParagonIE_Sodium_Compat::CRYPTO_SECRETBOX_NONCEBYTES;
const CRYPTO_SIGN_BYTES = ParagonIE_Sodium_Compat::CRYPTO_SIGN_BYTES;
const CRYPTO_SIGN_SEEDBYTES = ParagonIE_Sodium_Compat::CRYPTO_SIGN_SEEDBYTES;
const CRYPTO_SIGN_PUBLICKEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_SIGN_PUBLICKEYBYTES;
const CRYPTO_SIGN_SECRETKEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_SIGN_SECRETKEYBYTES;
const CRYPTO_SIGN_KEYPAIRBYTES = ParagonIE_Sodium_Compat::CRYPTO_SIGN_KEYPAIRBYTES;
const CRYPTO_STREAM_KEYBYTES = ParagonIE_Sodium_Compat::CRYPTO_STREAM_KEYBYTES;
const CRYPTO_STREAM_NONCEBYTES = ParagonIE_Sodium_Compat::CRYPTO_STREAM_NONCEBYTES;
