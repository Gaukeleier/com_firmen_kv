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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_firmen', JPATH_ADMINISTRATOR);
?>

<!-- Styling for making front end forms look OK -->
<!-- This should probably be moved to the template CSS file -->
<style>
    .front-end-edit ul {
        padding: 0 !important;
    }
    .front-end-edit li {
        list-style: none;
        margin-bottom: 6px !important;
    }
    .front-end-edit label {
        margin-right: 10px;
        display: block;
        float: left;
        text-align: center;
        width: 200px !important;
    }
    .front-end-edit .radio label {
        float: none;
    }
    .front-end-edit .readonly {
        border: none !important;
        color: #666;
    }    
    .front-end-edit #editor-xtd-buttons {
        height: 50px;
        width: 600px;
        float: left;
    }
    .front-end-edit .toggle-editor {
        height: 50px;
        width: 120px;
        float: right;
    }

    #jform_rules-lbl{
        display:none;
    }

    #access-rules a:hover{
        background:#f5f5f5 url('../images/slider_minus.png') right  top no-repeat;
        color: #444;
    }

    fieldset.radio label{
        width: 50px !important;
    }
</style>
<script type="text/javascript">
    function getScript(url,success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
        done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                || this.readyState == 'loaded'
                || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',function() {
        js = jQuery.noConflict();
        js(document).ready(function(){
            js('#form-firmen').submit(function(event){
                 
            }); 
        
            
        });
    });
    
</script>

<div class="firmen-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Add</h1>
    <?php endif; ?>

    <form id="form-firmen" action="<?php echo JRoute::_('index.php?option=com_firmen&task=firmen.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <ul>
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

        </ul>

        <div>
            <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
            <?php echo JText::_('or'); ?>
            <a href="<?php echo JRoute::_('index.php?option=com_firmen&task=firmen.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" name="option" value="com_firmen" />
            <input type="hidden" name="task" value="firmenform.save" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
