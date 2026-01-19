<?php
namespace App\Helpers;

class General {
   /**
    * Digunakan untuk menggabungkan semua message error dari validasi menjadi satu string  
    * @param array $messageArray
    * @return string
    */
   public static function convertMessageError($message_Array) {
      $getAllMessageErrors = collect($message_Array)->flatten();
      $getAllMessageErrors = $getAllMessageErrors->map(function($message) {
         return rtrim($message, '.'); // menghapus titik di akhir message
      })->implode(', ');

      return $getAllMessageErrors;
   }
}