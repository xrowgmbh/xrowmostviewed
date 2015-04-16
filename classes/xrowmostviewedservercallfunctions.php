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
        $http=eZHTTPTool::instance();
        if( $http->hasPostVariable( 'impressions' ))
        {
            $impressions=$http->postVariable( 'impressions' );
            if ( is_array( $impressions ) )
            {
                foreach( $impressions as $impression )
                {
                   $impression = (int)$impression;
                   if ( $impression >= 1 )
                   {
                        xrowViewCounter::updateImpression( $impression );
                   }
                }
            }
        }
        if( $http->hasPostVariable( 'nodeid' ) and $nodeid >= 1 )
        {
            $nodeid=(int)trim($http->postVariable( 'nodeid' ));
            xrowViewCounter::updateView( $nodeid );
        }
    }
}