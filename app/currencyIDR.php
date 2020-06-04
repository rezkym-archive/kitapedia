<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currencyIDR extends Model
{
    public static function toIDR($number) 
    {
        $rupiah = number_format($number ,0, ',' , '.' );
        return $rupiah;
    }
 
    public static function beCalculated($number) 
    {
        $presisi = 3;
        if ($number < 900) {
            return self::toIDR($number). ' perak';

        } else if ($number < 1000000) {
            return self::toIDR($number). ' rb';

        } else if ($number < 900000000) {
            $format_angka = number_format($number / 1000000, $presisi);
            $simbol = ' jt';
        } else if ($number < 900000000000) {
            $format_angka = number_format($number / 1000000000, $presisi);
            $simbol = 'M';
        } else {
            $format_angka = number_format($number / 1000000000000, $presisi);
            $simbol = 'T';
        }
     
        if ( $presisi > 0 ) {
            $pisah = '.' . str_repeat( '0', $presisi );
            $format_angka = str_replace( $pisah, '', $format_angka );
        }
        
        return $format_angka . $simbol;
    }
}
