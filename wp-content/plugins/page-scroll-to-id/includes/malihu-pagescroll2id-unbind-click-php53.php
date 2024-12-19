<?php
/*
Unbind unrelated click events with specific selector (requires PHP 5.3 or higher)
*/

if(isset($pl_i['unbindUnrelatedClickEvents']) && $pl_i['unbindUnrelatedClickEvents']['value']=='true' && isset($pl_i['unbindUnrelatedClickEventsSelector']) && $pl_i['unbindUnrelatedClickEventsSelector']['value']!==''){
    add_action('wp_enqueue_scripts', function() use ($pl_i) {
        wp_register_script($_ENV["ps2id_p_plugin_slug"].'-plugin-unbind-defer-script', plugins_url('js/'.$_ENV["ps2id_p_plugin_unbind_defer_script"], __DIR__), array('jquery', $_ENV["ps2id_p_plugin_slug"].'-plugin-script'), $_ENV["ps2id_p_version"], 1);
        wp_enqueue_script($_ENV["ps2id_p_plugin_slug"].'-plugin-unbind-defer-script');
        $params=array(
            'unbindSelector' => $pl_i['unbindUnrelatedClickEventsSelector']['value'], 
        );
        $loc_script=$_ENV["ps2id_p_plugin_slug"].'-plugin-unbind-defer-script';
        wp_localize_script($loc_script, $_ENV["ps2id_p_pl_pfx"].'unbindScriptParams', $params);
    }, 99);
}
?>