<?php
namespace App\Classes;
use Illuminate\Support\Facades\App;

class LanguageHandler
{



   public function __construct()
    {

    }

    /**

     * @param $text string

     */
  public function replace( $textRo, $textRu, $textEn)
    {
        switch (App::getLocale()) {
            case 'ro':
                $name=$textRo;
                break;
            case 'ru':
                $name=$textRu;
                break;
            case 'en':
                $name=$textEn;
                break;
            default:
                $name= '';
        }
        return $name;
    }


}
