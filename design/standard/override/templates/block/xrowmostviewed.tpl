{def $limit=5
     $expiry=ezini('General','CacheTime','xrowmostviewed.ini')
     $class_array=ezini('General','AllowedClasses','xrowmostviewed.ini')
}
{if is_set($block.custom_attributes.limit)}
    {set $limit=$block.custom_attributes.limit|wash()}
{/if}
{if ezini('General','UseCache','xrowmostviewed.ini')|eq('enabled')}
    {cache-block keys=array( 'xrowmostviewed', $block.custom_attributes.source_node_id, $limit ) expiry=$expiry}
        {def $mostviewed=fetch( 'content', 'tree', hash( 'parent_node_id', $block.custom_attributes.source_node_id|wash(),
                                                         'class_filter_type', 'include',
                                                         'class_filter_array', $class_array,
                                                         'extended_attribute_filter', hash( 'id', 'xrowMostViewedFilter',
                                                                                            'params', hash( 'exclude', array() ) ),
                                                         'sort_by', array( 'view_count', false() ),
                                                         'limit', $limit,
                                                         'offset', 0 ) )}
        {if count($mostviewed)|gt(0)}
            <h2>{$block.name|wash()}</h2>
            <ul>
                {foreach $mostviewed as $mostviewed_item}
                    <li><a href={$mostviewed_item.url_alias|ezurl( )} title="{$mostviewed_item.name|wash()}">{$mostviewed_item.name|wash()}</a></li>
                {/foreach}
            </ul>
        {/if}
    {/cache-block}
{else}
    {def $mostviewed=fetch( 'content', 'tree', hash( 'parent_node_id', $block.custom_attributes.source_node_id|wash(),
                                                     'class_filter_type', 'include',
                                                     'class_filter_array', $class_array,
                                                     'extended_attribute_filter', hash( 'id', 'xrowMostViewedFilter',
                                                                                       'params', hash( 'exclude', array() ) ),
                                                     'sort_by', array( 'view_count', false() ),
                                                     'limit', $limit,
                                                     'offset', 0 ) )}
    {if count($mostviewed)|gt(0)}
        <h2>{$block.name|wash()}</h2>
        <ul>
            {foreach $mostviewed as $mostviewed_item}
                <li><a href={$mostviewed_item.url_alias|ezurl( )} title="{$mostviewed_item.name|wash()}">{$mostviewed_item.name|wash()}</a></li>
            {/foreach}
        </ul>
    {/if}
{/if}