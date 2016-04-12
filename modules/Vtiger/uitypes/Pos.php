<?php
/**
 * UIType POS Field Class
 * @package YetiForce.UIType
 * @license licenses/License.html
 * @author Tomasz Kur <t.kur@yetiforce.com>
 */
class Vtiger_Pos_UIType extends Vtiger_Base_UIType
{

	private function getServers()
	{
		$db = PearDatabase::getInstance();
		$result = $db->pquery('SELECT id, name FROM w_yf_servers WHERE type = ? AND status = ?', ['POS', 1]);
		$listServers = [];
		while ($server = $db->getRow($result)) {
			$listServers[$server['id']] = $server['name'];
		}
		return $listServers;
	}

	public function getTemplateName()
	{
		return 'uitypes/Pos.tpl';
	}

	public function getDisplayValue($values, $record = false, $recordInstance = false, $rawText = false)
	{
		$listServers = $this->getServers();
		$namesOfServers = '';
		if (!empty($values)) {
			$values = explode(',', $values);
			foreach ($values as $server) {
				$namesOfServers.= $listServers[$server] . ', ';
			}
		}
		return $namesOfServers;
	}

	public function getPicklistValues()
	{
		return $this->getServers();
	}
}
