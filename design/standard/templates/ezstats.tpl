{* stats windows. *}
{def $page_limit = min( ezpreference( 'admin_list_limit' ), 3 )|choose( 10, 10, 25, 50 )
     $offset = first_set( $view_parameters.offset, 0 )
     $tr_class='bglight'
}

{def $stats = fetch( 'xrowmostviewed', 'stats', hash( 'object_id', $node.object.id ) )}
<table class="list" cellspacing="0">
<tr>
    <th>{'Type'|i18n( 'design/admin/node/view/full',, hash( '%related_objects_count', $related_ezflow_count ) )}</th>
    <th>{'Anzahl'|i18n( 'design/admin/node/view/full' )}</th>
</tr>
<tr class="{$tr_class}">
    <td>Views</td>
    <td>{$stats.views|wash}</td>
</tr>
<tr class="{$tr_class}">
    <td>Impressionen</td>
    <td>{$stats.impressions|wash}</td>
</tr>
{undef $tr_class }
</table>
