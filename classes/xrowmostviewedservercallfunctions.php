<?php
/**
 * Implements xrowmostviewed method called remotely by sending XHR calls
 *
 */
class xrowMostViewedServerCallFunctions
{
    /**
     * Increases viewcounter by one otherwise if not exists create entry
     *
     * @param mixed $args
     * @return true
     */
    public static function increaseViewCounter( $args )
    {
        //eZLog::write( 'NodeID: ', 'xrowmostviewed.log' );
        $http=eZHTTPTool::instance();
        if( $http->hasPostVariable( 'nodeid' ) )
        {
            $nodeid=trim((int)$http->postVariable( 'nodeid' ));
            if( $nodeid != 0 and $nodeid > 10 )
            {
                $counter = eZViewCounter::fetch( $nodeid );
                if ( !is_object( $counter ) )
                {
                    $counter = eZViewCounter::create( $nodeid );
                }
                $counter->increase();
                return array(1, $nodeid );
            }
            else
            {
                return array(0, $nodeid );
            }
        }
        else
        {
            return array(0, $nodeid );
        }
    }
}
?>