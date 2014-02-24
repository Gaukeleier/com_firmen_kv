<?php
/**
 * @version     1.0.0
 * @package     com_firmen
 * @copyright   Copyright (C) 2013. Alle Rechte vorbehalten.
 * @tdcense     GNU General Pubtdc tdcense version 2 oder später; siehe tdCENSE.txt
 * @author      Gaukeleier <gaukeleier@gmail.com> - http://
 */
// no direct access
defined('_JEXEC') or die;
//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_firmen', JPATH_ADMINISTRATOR);
$anrede = array("Frau","Herr"," "," ");
$systemart = array(3=>"Planung",2=>"Antragstellung",5=>"Montage",4=>"Wartung",6=>"privater Sachverständiger",7=>"Dichtheitsprüfung");
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_firmen');
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_firmen')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
$doc =& JFactory::getDocument();
$doc->setTitle("Klärfirma: " .$this->item->firma . " in " . $this->item->ort );
$doc->setDescription("Detailansicht der Firma " . $this->item->firma . " in " . $this->item->ort);
?>
<?php if ($this->item) :
	$adresse = $this->item->plz . "," . $this->item->ort . "," .$this->item->strasse;
 ?>
<br />
        <table class="table table-bordered">
        	<tr>        
			<td><h1><?php echo $this->item->firma; ?></h1></td>
            </tr>
            
            <?php if ($this->item->vorname != "" || $this->item->nachname != "") : ?>
            <tr>
			<td>Ansprechpartner: <?php echo $anrede[$this->item->anrede - 1] . " " . $this->item->vorname . " " . $this->item->nachname; ?></td>
            </tr>
            <?php endif; ?>
            <tr>
			<td><?php echo $this->item->strasse . " " . $this->item->nr; ?><br />
				<?php echo $this->item->plz. " " . $this->item->ort; ?><br />
                <?php echo $this->item->land; ?></td>
			<tr>                
            <tr>
			<td>
            <?php if($this->item->tel!="") :?>
            <i class="icon- fa fa-phone"></i>
			<?php echo $this->item->tel . "<br>"; endif; ?>            
            <?php if($this->item->fax!="") :?>
			<i class="icon icon-print"></i>
			<?php echo $this->item->fax . "<br>"; endif;?>
            <?php if($this->item->mobil!="") :?>
			<i class="icon icon-mobile-phone"></i>
			<?php echo $this->item->mobil . "<br>"; endif;?>
            <?php if($this->item->email!="") :?>
			<i class="icon icon-envelope"></i>
			<?php echo $this->item->email . "<br>"; endif;?>
            <?php if($this->item->homepage!="") :?>            	
			<i class="icon icon-home"></i>
			<?php echo $this->item->homepage; endif;?>
            
            </td>
            </tr>
			<?php if ($this->item->filter_systemart != "") : 
			$systems =  explode(";:;",$this->item->filter_systemart);
			?>
            <tr>
			<td>Anbieter von: <?php 
			foreach ($systems AS $nr) {
				echo $systemart[$nr] . ", "; 
				}
			?>
            </td>
            </tr>
            <?php endif; ?>

	     <?php // if ($this->item->as_praesentation != "") : ?>
            <tr>
			<td><?php echo base64_decode($this->item->as_praesentation); ?></td>
            </tr>
            <?php // endif; ?>
            
         </table>
 <img width="100%" src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $adresse;?>&zoom=13&size=980x200&markers=color:blue%7Clabel:S%7C<?php echo $adresse;?>&sensor=false" style="padding:10px;margin:15px 0;" class="img-shadow" />
<?php
else:
    echo JText::_('COM_FIRMEN_ITEM_NOT_LOADED');
endif;
?>
