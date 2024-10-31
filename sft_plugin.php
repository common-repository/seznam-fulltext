<style type="text/css">
table.myTable { border-collapse:collapse; }
table.myTable td, table.myTable th { border:1px solid black;padding:5px; }
.pridej { background-color:#CCFF66; }
.jeVindexu { background-color:#FF9999; }


</style>

<?php
/**
 * Plugin Name: Seznam Fulltext
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Snadné přidávání článku do Seznam.cz fulltextu
 * Version: 1.0
 * Author: Stolda
 * Author URI: http://stolda.cz
 */


function notify_new_post($post_id) {
    if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {

echo '<script type="text/javascript" language="javascript"> 
window.open("http://www.seznam.cz"); 
</script>'; 

}
}


if(!is_admin()){
    return;
}else{
 

 
    /*****  Definice námi vytvořených funkcí  *****/
 
    // Vytvoření stránky
    function UP_VytvorStranku(){
        add_action("admin_menu", "UP_PridejStranku");
    }
 
    // Přidání stránky do menu
    function UP_PridejStranku(){
        add_menu_page("Seznam fulltext", "Seznam fulltext", "activate_plugins", "sft_plugin", "UP_ZobrazStranku", "http://stolda.cz/files/ikona.png");
    }
 
    // Zobrazení samotné stránky
    function UP_ZobrazStranku(){

echo  " 
<center><table width=auto class=myTable>
<caption><h1>Přidání článků do fulltextu</h1></caption> ";

$args = array( 'posts_per_page' => -1, 'post_status' => 'any', 'post_parent' => null );
        $recent_posts = wp_get_recent_posts( $args );
        foreach( $recent_posts as $recent ){
        echo '

<tr><td class="jeVindexu"><a href="http://search.seznam.cz/?q=site:' . get_site_url() .  '+intitle:' . get_the_title($recent["ID"]) . '" target="_blank">Je v indexu?</a></td>
<td><a href="' . get_permalink($recent["ID"]) . '"  target="_blank">' . get_the_title($recent["ID"]) . '</a></td>


<td class="pridej"><a href="http://search.seznam.cz/pridej-stranku?url=' . get_permalink($recent["ID"]) . '"  target="_blank">Přidej do fulltextu</a></td></tr>
';
        }
echo'<a href="http://search.seznam.cz/?q=site:' . get_site_url() . '" target="_blank"><h2>Počet zaindexovaných stran</h2></a></table>
Autor: <a href="http://stolda.cz"  target="_blank">Stolda</a>.

';
    }
    /***** Konec definice funkcí *****/
 
 
 
 
    // Spuštění funkce pro vytvoření stránky
    UP_VytvorStranku();
}

?>