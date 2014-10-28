<?php $jsparams = array(
	'id' => 'tree-' . $this->tree[0]->root,
	'model_data' => $this->model_data,
	'urls' => $this->actions,
	'dyna_options' => $this->js_options,
);?>

<div id="<?php echo $jsparams['id']; ?>" class="dynatree">
    <?php //echo HtmlHelper::TreeGenerate($this->tree, $this->link_options); ?>

<?php 
    $html = '<ul>';

        $default_opts = array(
            'display_url' => true,
            'text_node' => 'title',
            'expanded' => array(1),
            'li_class' => array(
                'folder',
            ),
        );

        $opts = array_merge($default_opts, $this->link_options);

        if ( count($this->tree) == 0 ) {
            return '';
        }

        $tree = $this->tree;

        $prev_level = 1;
        $iteration = 0;
        foreach ( $tree as $k => $node ) {
            if ( $node->level < $prev_level ) {
                $html .= '</li>';

                for ( $i = $node->level; $i < $prev_level; $i++ ) {
                    $html .= '</ul></li>';
                }
            } elseif ( $node->level > $prev_level ) {
                $html .= '<ul>';
            } elseif ( $iteration++ > 0 ) {
                $html .= '</li>';
            }

            $li_class = implode(' ', $opts['li_class']);
            $li_class .= in_array($node->id, $opts['expanded']) ? ' expanded' : '';

            $li_id = 'key_' . $node->root . '-' . $node->level . '-' . $node->id;

            $p = array(
                'page_type' => ( isset($node['page_type']) ? $node['page_type'] : '' ),
                'home_page' => ( isset($node['home_page']) ? $node['home_page'] : '' ),
                'visible' => ( isset($node['visible']) ? $node['visible'] : '' ),
                'url' => ( isset($node['url']) && $opts['display_url'] ? $node['url'] : '' ),
            );

            $html .= '<li data="' .
                    'id: ' . $node->id . ', ' .
                    'page_url: \'' . $p['url'] . '\', ' .
                    'page_type: \'' . $p['page_type'] . '\', ' .
                    'home_page: \'' . $p['home_page'] . '\', ' .
                    'visible: \'' . $p['visible'] . '\', ' .
                    'level: ' . $node->level . '" id="' . $li_id . '" class="' . $li_class . '"><a data-id="' . $node->id . '" href="'
                . str_replace('--href--', $node[$opts['href_node']], $opts['url'])
                . '">' . $node->gallery->name_gallery . '</a>' . "\n";

            $prev_level = $node->level;
        }

        $html .= '</li>';

        for ( $i = 1; $i < $prev_level; $i++ ) {
            $html .= '</ul></li>';
        }

        echo $html;

 ?>

</div>

<script type="text/javascript">
$(function () {
	var jsparams = <?php echo CJavaScript::encode($jsparams); ?>;

	$('#' + jsparams.id).dynatreeAdapter(jsparams);
});
</script>
