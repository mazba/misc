<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
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
     * string encode for URL
     */
//    public function encodeString($str){
//        return Security::encrypt($str, Configure::read('security_key'));
//    }
    /*
     * string encode for URL
     */
    public function decodeString($str){
        return Security::decrypt($str, Configure::read('security_key'));
    }
}
