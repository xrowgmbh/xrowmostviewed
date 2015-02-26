<?php
class xrowMostViewedExtendedFilter
{
    /**
     * Sort the result by result in ezview_counter
     *
     * @param unknown_type $params
     * @return unknown
     */
	public function xrowMostViewedFilter( $params )
    {
        $sql = '';
        if ( isset( $params['exclude'] ) and count( $params['exclude'] ) > 0 )
        {
            $params['exclude'] = array_unique( $params['exclude'] );
            if ( isset( $params['type'] )
                 and $params['type'] == 'object_id' )
            {
                $sql = ' ezcontentobject.id NOT IN ( ' . implode( ', ', $params['exclude'] ) . ' ) AND ';
            }
            else
            {
                $sql = ' ezcontentobject_tree.node_id NOT IN ( ' . implode( ', ', $params['exclude'] ) . ' ) AND ';
            }
        }
        $result = array( 'tables' => ', ex_xrow_counter',
                         'joins'  => $sql . ' ezcontentobject_tree.node_id = ex_xrow_counter.node_id AND ',
                         'columns' => ', ex_xrow_counter.views view_count ');
    return $result;
    }
}