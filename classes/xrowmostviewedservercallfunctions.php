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
        if( $http->hasPostVariable( 'nodeid' ) )
        {
            $nodeid=(int)trim($http->postVariable( 'nodeid' ));
            
            if( $nodeid >= 1 )
            {
                xrowViewCounter::updateView( $nodeid );
                
                $impressions=$http->postVariable( 'impressions' );
                if ( is_array( $impressions ) )
                {
                    foreach( $impressions as $impression ){
                        $impression = (int)$impression;
                        if ( $impression >= 1 ){
                            xrowViewCounter::updateImpression( $impression );
                        }
                    }
                }

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