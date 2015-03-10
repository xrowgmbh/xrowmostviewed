<?php

class xrowMostViewedOperator
{

    function operatorList()
    {
        return array(
            'view_count'
        );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            'metadata' => array()
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {

        switch ( $operatorName )
        {
            case 'view_count':
            {
                if( isset( $operatorValue ) )
                {
                    $counter = xrowViewCounter::fetch( (int)$operatorValue );

                    if ( $counter ){
                        $operatorValue = $counter->views;
                    }
                    else{
                        $operatorValue = 0;
                    }
                }
                else
                {
                    $operatorValue = 0;
                }
            }break;
        }
    }
}