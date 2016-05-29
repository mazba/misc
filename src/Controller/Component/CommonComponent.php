<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Security;

/**
 * Common component
 */
class CommonComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /*
     * security key for encoding & decoding
     */
    private $key = 'LSDFSDJFTXGenFoZoiLwQGrLgdboMAZBAscakeFS';
    /*
     * string encode for URL
     */
    public function encodeString($str){
        return Security::encrypt($str, $this->key);
    }
    /*
     * string encode for URL
     */
    public function decodeString($str){
        return Security::decrypt($str, $this->key);
    }
}
