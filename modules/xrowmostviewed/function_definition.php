<?php

$FunctionList = array();

$FunctionList['stats'] = array( 'name' => 'stats',
                                'call_method' => array( 'include_file' => 'extension/xrowmostviewed/modules/xrowmostviewed/xrowmostviewedfunctioncollection.php',
                                                        'class' => 'xrowMostViewedFunctionCollection',
                                                        'method' => 'stats' ),
                                'parameter_type' => 'standard',
                                'parameters' => array( array( 'name' => 'object_id',
                                                               'type' => 'integer',
                                                               'required' => true )) );
