<?php

// Source: https://stackoverflow.com/questions/2762061/how-to-add-http-if-it-doesnt-exists-in-the-url#answer-14701491
function add_scheme( $url, $scheme = 'https://' ) {
  return parse_url( $url, PHP_URL_SCHEME ) === null ? $scheme . $url : $url;
}
