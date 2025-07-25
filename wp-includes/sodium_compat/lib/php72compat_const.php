<?php

const SODIUM_LIBRARY_MAJOR_VERSION = 9;
const SODIUM_LIBRARY_MINOR_VERSION = 1;
const SODIUM_LIBRARY_VERSION = "1.0.8";

const SODIUM_BASE64_VARIANT_ORIGINAL = 1;
const SODIUM_BASE64_VARIANT_ORIGINAL_NO_PADDING = 3;
const SODIUM_BASE64_VARIANT_URLSAFE = 5;
const SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING = 7;
const SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_AES256GCM_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_AES256GCM_NPUBBYTES = 12;
const SODIUM_CRYPTO_AEAD_AES256GCM_ABYTES = 16;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_NPUBBYTES = 8;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_ABYTES = 16;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES = 12;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_ABYTES = 16;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES = 24;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_ABYTES = 16;
const SODIUM_CRYPTO_AUTH_BYTES = 32;
const SODIUM_CRYPTO_AUTH_KEYBYTES = 32;
const SODIUM_CRYPTO_BOX_SEALBYTES = 16;
const SODIUM_CRYPTO_BOX_SECRETKEYBYTES = 32;
const SODIUM_CRYPTO_BOX_PUBLICKEYBYTES = 32;
const SODIUM_CRYPTO_BOX_KEYPAIRBYTES = 64;
const SODIUM_CRYPTO_BOX_MACBYTES = 16;
const SODIUM_CRYPTO_BOX_NONCEBYTES = 24;
const SODIUM_CRYPTO_BOX_SEEDBYTES = 32;
const SODIUM_CRYPTO_KDF_BYTES_MIN = 16;
const SODIUM_CRYPTO_KDF_BYTES_MAX = 64;
const SODIUM_CRYPTO_KDF_CONTEXTBYTES = 8;
const SODIUM_CRYPTO_KDF_KEYBYTES = 32;
const SODIUM_CRYPTO_KX_BYTES = 32;
const SODIUM_CRYPTO_KX_PRIMITIVE = "x25519blake2b";
const SODIUM_CRYPTO_KX_SEEDBYTES = 32;
const SODIUM_CRYPTO_KX_KEYPAIRBYTES = 64;
const SODIUM_CRYPTO_KX_PUBLICKEYBYTES = 32;
const SODIUM_CRYPTO_KX_SECRETKEYBYTES = 32;
const SODIUM_CRYPTO_KX_SESSIONKEYBYTES = 32;
const SODIUM_CRYPTO_GENERICHASH_BYTES = 32;
const SODIUM_CRYPTO_GENERICHASH_BYTES_MIN = 16;
const SODIUM_CRYPTO_GENERICHASH_BYTES_MAX = 64;
const SODIUM_CRYPTO_GENERICHASH_KEYBYTES = 32;
const SODIUM_CRYPTO_GENERICHASH_KEYBYTES_MIN = 16;
const SODIUM_CRYPTO_GENERICHASH_KEYBYTES_MAX = 64;
const SODIUM_CRYPTO_PWHASH_SALTBYTES = 16;
const SODIUM_CRYPTO_PWHASH_STRPREFIX = '$argon2id$';
const SODIUM_CRYPTO_PWHASH_ALG_ARGON2I13 = 1;
const SODIUM_CRYPTO_PWHASH_ALG_ARGON2ID13 = 2;
const SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE = 33554432;
const SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE = 4;
const SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE = 134217728;
const SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE = 6;
const SODIUM_CRYPTO_PWHASH_MEMLIMIT_SENSITIVE = 536870912;
const SODIUM_CRYPTO_PWHASH_OPSLIMIT_SENSITIVE = 8;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_SALTBYTES = 32;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_STRPREFIX = '$7$';
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_INTERACTIVE = 534288;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_INTERACTIVE = 16777216;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_SENSITIVE = 33554432;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_SENSITIVE = 1073741824;
const SODIUM_CRYPTO_SCALARMULT_BYTES = 32;
const SODIUM_CRYPTO_SCALARMULT_SCALARBYTES = 32;
const SODIUM_CRYPTO_SHORTHASH_BYTES = 8;
const SODIUM_CRYPTO_SHORTHASH_KEYBYTES = 16;
const SODIUM_CRYPTO_SECRETBOX_KEYBYTES = 32;
const SODIUM_CRYPTO_SECRETBOX_MACBYTES = 16;
const SODIUM_CRYPTO_SECRETBOX_NONCEBYTES = 24;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_ABYTES = 17;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_HEADERBYTES = 24;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_KEYBYTES = 32;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_PUSH = 0;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_PULL = 1;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_REKEY = 2;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_FINAL = 3;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_MESSAGEBYTES_MAX = 0x3fffffff80;
const SODIUM_CRYPTO_SIGN_BYTES = 64;
const SODIUM_CRYPTO_SIGN_SEEDBYTES = 32;
const SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES = 32;
const SODIUM_CRYPTO_SIGN_SECRETKEYBYTES = 64;
const SODIUM_CRYPTO_SIGN_KEYPAIRBYTES = 96;
const SODIUM_CRYPTO_STREAM_KEYBYTES = 32;
const SODIUM_CRYPTO_STREAM_NONCEBYTES = 24;
const SODIUM_CRYPTO_STREAM_XCHACHA20_KEYBYTES = 32;
const SODIUM_CRYPTO_STREAM_XCHACHA20_NONCEBYTES = 24;
