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
            'metadata' => array(
                'node_id' => array(
                    'type' => 'int' ,
                    'required' => true ,
                    'default' => null
                )
            )
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'view_count':
            {
                if( isset( $namedParameters['node_id'] ) )
                {
                    $counter = xrowViewCounter::fetch( (int)$namedParameters['node_id'] );
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