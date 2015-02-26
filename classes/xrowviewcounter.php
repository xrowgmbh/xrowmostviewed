<?php

class xrowViewCounter extends eZPersistentObject
{
    const TABLE = "ex_xrow_counter";

    static function definition()
    {
        return array( "fields" => array( "node_id" => array( 'name' => "node_id",
                                                             'datatype' => 'integer',
                                                             'default' => 0,
                                                             'required' => true,
                                                             'foreign_class' => 'eZContentObjectTreeNode',
                                                             'foreign_attribute' => 'node_id',
                                                             'multiplicity' => '1..*' ),
                                         "views" => array( 'name' => "views",
                                                           'datatype' => 'integer',
                                                           'default' => 0,
                                                           'required' => true ),
                                         "impressions" => array( 'name' => "impressions",
                                                           'datatype' => 'integer',
                                                           'default' => 0,
                                                           'required' => false ) ),
                      "keys" => array( "node_id" ),
                      'relations' => array( 'node_id' => array( 'class' => 'eZContentObjectTreeNode',
                                                                'field' => 'node_id' ) ),
                      "class_name" => "xrowViewCounter",
                      "sort" => array( "count" => "desc" ),
                      "name" => self::TABLE );
    }
    
    static function create( $node_id )
    {
        $row = array("node_id" => $node_id,
                     "views" => 0,
                     "impressions" => 0 );
        return new self( $row );
    }

    /*!
     \note Transaction unsafe. If you call several transaction unsafe methods you must enclose
     the calls within a db transaction; thus within db->begin and db->commit.
     */
    public static function removeCounter( $node_id )
    {
        eZPersistentObject::removeObject( self::definition(),
                                          array("node_id" => $node_id ) );
    }

    /*!
     \note Transaction unsafe. If you call several transaction unsafe methods you must enclose
     the calls within a db transaction; thus within db->begin and db->commit.
     */
    static function clear( $node_id )
    {
        $counter = self::fetch( $node_id );
        if ( $counter != null )
        {
            $counter->setAttribute( 'views', 0 );
            $counter->setAttribute( 'impressions', 0 );
            $counter->store();
        }
    }
    static function updateView( $node_id )
    {
        return eZDB::instance()->query(
        "INSERT INTO ex_xrow_counter (node_id,views) VALUES (".(int)$node_id.",1) ON DUPLICATE KEY UPDATE views = views + 1"
        );
    }
    static function updateImpression( $node_id )
    {
        return eZDB::instance()->query(
            "INSERT INTO ex_xrow_counter (node_id,impressions) VALUES (".(int)$node_id.",1) ON DUPLICATE KEY UPDATE impressions = impressions + 1"
        );
    }

    static function fetch( $node_id, $asObject = true )
    {
        return eZPersistentObject::fetchObject( self::definition(),
                                                null,
                                                array("node_id" => $node_id ),
                                                $asObject );
    }

    static function fetchTopList( $classID = false, $sectionID = false, $offset = false, $limit = false )
    {
        if ( !$classID && !$sectionID )
        {

            return  eZPersistentObject::fetchObjectList( self::definition(),
                                                         null,
                                                         null,
                                                         null,
                                                         array( 'length' => $limit, 'offset' => $offset ),
                                                         false );
        }

        $queryPart = "";
        if ( $classID != false )
        {
            $classID = (int)$classID;
            $queryPart .= "ezcontentobject.contentclass_id=$classID AND ";
        }

        if ( $sectionID != false )
        {
            $sectionID = (int)$sectionID;
            $queryPart .= "ezcontentobject.section_id=$sectionID AND ";
        }

        $db = eZDB::instance();
        $query = "SELECT ".self::TABLE.".*
                  FROM
                         ezcontentobject_tree,
                         ezcontentobject,
                         ".self::TABLE."
                  WHERE
                         ".self::TABLE.".node_id=ezcontentobject_tree.node_id AND
                         $queryPart
                         ezcontentobject_tree.contentobject_id=ezcontentobject.id
                  ORDER BY ".self::TABLE.".views DESC";

        if ( !$offset && !$limit )
        {
            $countListArray = $db->arrayQuery( $query );
        }
        else
        {
            $countListArray = $db->arrayQuery( $query, array( "offset" => $offset,
                                                               "limit" => $limit ) );
        }
        return $countListArray;
    }

    public $node_id;
    public $impressions;
    public $views;
}