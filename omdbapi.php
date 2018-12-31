<?php
/**
 * Omdbapi Server
 * @since 1.0
 * @author Erick Meza (emezzza@icloud.com)
 */

class Omdbapi{

   /**
    * Server Api properties
    * @since 1.0
    */
   protected static $server = 'https://private.omdbapi.com/'; // Server Api
   protected static $apikey = '_YOUR_APIKEY_HERE_'; // Api Key for access to all data
   protected static $catime = 3600; // Time in cache


   /**
    * Get data in cache or from Server Api
    * @since 1.0
    */
   public static function Get($imdb_id){
      $file = 'cache/'.$imdb_id;
      $data = '';
      if(file_exists($file) && filemtime($file) + self::$catime >= time()){
         $data = file_get_contents($file);
      } else {
         $data = self::Api($imdb_id);
         file_put_contents($file,$data);
      }
      return $data;
   }


   /**
    * Curl Omdbapi Method GET
    * @since 1.0
    */
   public static function Api($imdb_id){
      $ap = self::$server.'?apikey='.self::$apikey.'&i='.$imdb_id;
      if(function_exists('curl_init')){
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $ap);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
         $response = curl_exec($curl);
         curl_close($curl);
         return $response;
      }else{
         return file_get_contents($ap);
      }
   }
}
