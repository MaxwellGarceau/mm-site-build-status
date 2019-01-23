<?php

function determine_status_icon( $option ) {
  switch( $option ) {
    case 'pending':
      return '<i class="fas fa-pause"></i>';
    case 'in-progress':
      return '<i class="fas fa-play"></i>';
    case 'completed':
      return '<i class="fas fa-check"></i>';
  }
}
