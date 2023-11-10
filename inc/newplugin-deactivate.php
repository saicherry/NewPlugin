<?php 
/** 
 * @package NewPlugin
 * 
*/
 
class NewPlugin_Deactivate
{
    public static function deactivate(){
        flush_rewrite_rules( );
    }
}