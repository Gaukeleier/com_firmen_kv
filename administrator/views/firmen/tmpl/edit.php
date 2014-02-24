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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_firmen/assets/css/firmen.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function(){
        
    });
    
    Joomla.submitbutton = function(task)
    {
        if(task == 'firmen.cancel'){
            Joomla.submitform(task, document.getElementById('firmen-form'));
        }
        else{
            
            if (task != 'firmen.cancel' && document.formvalidator.isValid(document.id('firmen-form'))) {
                
                Joomla.submitform(task, document.getElementById('firmen-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_firmen&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="firmen-form" class="form-validate">
    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset class="adminform">

                			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('adresseid'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('adresseid'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('anrede'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('anrede'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('firma'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('firma'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('vorname'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('vorname'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('nachname'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('nachname'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('strasse'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('strasse'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('nr'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('nr'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('land'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('land'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('plz'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('plz'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('ort'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('ort'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('tel'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('tel'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('fax'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('fax'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('mobil'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('mobil'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('auftragid'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('auftragid'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('kategorieid'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('kategorieid'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('geb'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('geb'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('gebrem'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('gebrem'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('gebremmail'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('gebremmail'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('type'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('type'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('bemerkung'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('bemerkung'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('adressespracheid'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('adressespracheid'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('homepage'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('homepage'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('vsgkundentyp'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('vsgkundentyp'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('exporttoldap'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('exporttoldap'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('zusatz1'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('zusatz1'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('position'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('position'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('lastchange'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('lastchange'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('bezirk'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('bezirk'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailinvalid'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailinvalid'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('titelprefix'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('titelprefix'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('titelsuffix'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('titelsuffix'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('abteilung'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('abteilung'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('kundennummer'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('kundennummer'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('as_praesentation'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('as_praesentation'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('breite'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('breite'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('laenge'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('laenge'); ?></div>
			</div>


            </fieldset>
        </div>

        

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>