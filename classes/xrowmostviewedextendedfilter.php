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
        $result = array( 'tables' => ', ezview_counter',
                         'joins'  => $sql . ' ezcontentobject_tree.node_id = ezview_counter.node_id AND ',
                         'columns' => ', ezview_counter.count view_count ');
    return $result;
    }
}
?>