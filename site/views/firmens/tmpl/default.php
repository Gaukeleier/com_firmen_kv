<?php
/**
 * @version     1.0.0
 * @package     com_firmen
 * @copyright   Copyright (C) 2013. Alle Rechte vorbehalten.
 * @license     GNU General Public License version 2 oder später; siehe LICENSE.txt
 * @author      Gaukeleier <gaukeleier@gmail.com> - http://
 */
// no direct access
defined('_JEXEC') or die;
$doc =& JFactory::getDocument();
$doc->addStyleSheet('components/com_firmen/views/firmens/css/style.css');
$doc->addScript('http://maps.google.com/maps/api/js?sensor=false');
$doc->addScript('components/com_firmen/views/firmens/js/map3.js');
echo "<h1>".JText::_('COM_FIRMEN_TITEL')."</h1>";
?>
<p class="lead">Suche: 
	<select name="map_cat" id="map_cat" class="lead" style="height: 34px;">
        <option selected="selected" value="3">Planung</option>
        <option value="2">Antragstellung</option>
        <option value="5">Montage</option>
        <option value="4">Wartung</option>
        <option value="6">privater Sachverständiger</option>
        <option value="7">Dichtheitsprüfung</option>   
        <option value="1">Regenwassernutzung</option>                                
  	</select> 
    Umkreis: 
    <select name="bes_umkreissuche" id="bes_umkreissuche" class="lead" style="height: 34px;">
		<option selected="selected" value="50">50km</option>
		<option value="100">100km</option>
		<option value="200">200km</option>
	</select>
	Ort: 
	<input id="ort" type="text" size="20" class="lead" style="height: 24px;">
    <button onclick="searchLocations()" title="Suche" class="btn btn-small" style="margin-left: 10px;">Suche </button>
</p>
<div id="map_wrapper">
	<div id="map"></div>
	<div id="results_table"></div>
</div>
<div class="firmen">
<h2>Weitere Firmen in Deutschland</h2>
    <ul class="firmen_list">
<?php $show = false; ?>
   <?php foreach ($this->items as $item) : ?>         
		<?php
		$show = true;?>
        <li>
		<a href="<?php echo JRoute::_('index.php?option=com_firmen&view=firmen&id=' . (int)$item->id); ?>"><?php echo $item->firma; ?></a>
		</li>
	<?php endforeach; ?>
    <?php
        if (!$show):
            echo JText::_('COM_FIRMEN_NO_ITEMS');
        endif;
        ?>
    </ul>
</div>
<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>
