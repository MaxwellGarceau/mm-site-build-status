<?php

function format_values( $value ) {
  return ucwords( preg_replace('/\-+/', ' ', $value) );
}
