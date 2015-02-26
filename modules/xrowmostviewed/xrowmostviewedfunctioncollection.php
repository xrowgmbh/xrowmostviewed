<?php

class xrowMostViewedFunctionCollection
{
    function stats( $object_id )
    {
        return array( 'result' => xrowViewCounter::stats( $object_id ) );
    }
}