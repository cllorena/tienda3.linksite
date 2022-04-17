<?php
/**
 *
 *
 * @package    VirtueMart
 * @subpackage Country
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 10424 2021-01-14 09:24:33Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
JLoader::register('vmuikitAdminUIHelper', $adminTemplate . 'helpers/vmuikit_adminuihelper.php');
vmuikitAdminUIHelper::startAdminArea($this);

$states = vmText::_('COM_VIRTUEMART_STATE_S');
?>

	<form action="index.php?option=com_virtuemart&view=country" method="post" name="adminForm" id="adminForm">


		<div id="filterbox" class="filter-bar">
			<?php
			echo adminSublayouts::renderAdminVmSubLayout('filterbar',
				array(
					'search'=>array(
						'label'=>'COM_VIRTUEMART_COUNTRY',
						'name'=>'filter_country',
						'value'=>vRequest::getVar('filter_country')
					),
					'resultsCounter'=>$this->pagination->getResultsCounter()
				));


			?>

		</div>


		<div id="editcell">
			<table class="uk-table uk-table-striped uk-table-responsive">
				<thead>
				<tr>
					<th>
						<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)"/>
					</th>
					<th>
						<?php echo $this->sort('country_name') ?>
					</th>
					<?php /* TODO not implemented				    <th>
				<?php echo vmText::_('COM_VIRTUEMART_ZONE_ASSIGN_CURRENT_LBL'); ?>
				</th> */ ?>
					<th>
						<?php echo $this->sort('country_2_code') ?>
					</th>
					<th>
						<?php echo $this->sort('country_3_code') ?>
					</th>
					<th style="min-width:80px;width:8%;text-align:center;">
						<?php echo $this->sort('c.ordering', 'COM_VIRTUEMART_ORDERING') ?>
						<?php echo JHtml::_('grid.order', $this->countries, 'filesave.png', 'saveOrder'); ?>
					</th>
					<th width="20">
						<?php echo $this->sort('published', 'COM_VIRTUEMART_PUBLISHED') ?>
					</th>
					<th width="20">
						<?php echo $this->sort('virtuemart_country_id') ?>
					</th>
				</tr>
				</thead>
				<?php
				$k = 0;
				for ($i = 0, $n = count($this->countries); $i < $n; $i++) {
					$row = $this->countries[$i];

					$checked = JHtml::_('grid.id', $i, $row->virtuemart_country_id);
					$published = $this->gridPublished($row, $i);
					$editlink = JROUTE::_('index.php?option=com_virtuemart&view=country&task=edit&cid[]=' . $row->virtuemart_country_id);
					$statelink = JROUTE::_('index.php?option=com_virtuemart&view=state&view=state&virtuemart_country_id=' . $row->virtuemart_country_id);
					?>
					<tr class="row<?php echo $k; ?>">
						<td>
							<?php echo $checked; ?>
						</td>
						<td align="left">
							<?php
							$prefix = "COM_VIRTUEMART_COUNTRY_";
							$country_string = vmText::_($prefix . $row->country_3_code); ?>
							<a href="<?php echo $editlink; ?>"><?php echo $row->country_name ?> </a>&nbsp;
							<?php
							$lang = vmLanguage::getLanguage();
							if ($lang->hasKey($prefix . $row->country_3_code)) {
								echo "(" . $country_string . ") ";
							}
							?>

							<a title="<?php echo vmText::sprintf('COM_VIRTUEMART_STATES_VIEW_LINK', $country_string); ?>"
									href="<?php echo $statelink; ?>">[<?php echo $states ?>]</a>
						</td>
						<?php /* TODO not implemented				<td align="left">
			<?php echo $row->virtuemart_worldzone_id; ?>
		</td> */ ?>
						<td>
							<?php echo $row->country_2_code; ?>
						</td>
						<td>
							<?php echo $row->country_3_code; ?>
						</td>
						<td class="vm-order">
							<input class="ordering" type="text" name="order[<?php echo $i ?>]"
									id="order[<?php echo $i ?>]" size="5" value="<?php echo $row->ordering; ?>"
									style="text-align: center"/><span class="vmicon vmicon-16-move"></span>
						</td>
						<td align="center">
							<?php echo $published; ?>
						</td>
						<td align="center">
							<?php echo $row->virtuemart_country_id; ?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
				?>
				<tfoot>
				<tr>
					<td colspan="10">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
				</tfoot>
			</table>
		</div>
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['filter_order_Dir']; ?>"/>
		<input type="hidden" name="filter_order" value="<?php echo $this->lists['filter_order']; ?>"/>
		<input type="hidden" name="option" value="com_virtuemart"/>
		<input type="hidden" name="controller" value="country"/>
		<input type="hidden" name="view" value="country"/>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<?php echo JHtml::_('form.token'); ?>
	</form>


<?php vmuikitAdminUIHelper::endAdminArea(); ?>