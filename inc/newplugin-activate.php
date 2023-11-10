<?php 
/** 
 * @package NewPlugin
 * 
*/
 
class NewPlugin_Activate
{
    public static function activate(){
        flush_rewrite_rules( );
    }
}