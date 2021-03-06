<?php


class Settings {

	/**
	 * Returns all settings in the database.
	 * @return
	 */
	public function getSettings() {
		$prefix = Core::getDbTablePrefix();
		$query = Core::$db->query("SELECT * FROM {$prefix}settings");

		// TODO. work out standardized return format... Exception maybe
		if ($query["success"]) {
			$results = array();
			while ($row = mysql_fetch_assoc($query["results"])) {
				$results[$row["setting_name"]] = $row["setting_value"];
			}
			return $results;
		} else {
			return;
		}
	}

	/**
	 * Returns the value of a specific settings.
	 * @param string the unique setting name (setting_name column value in the Settings table)
	 * @return
	 */
	public function getSetting($settingName) {
		$prefix = Core::getDbTablePrefix();

		$response = Core::$db->query("
			SELECT setting_value
			FROM {$prefix}settings
			WHERE setting_name = '$settingName'
		");
		$data = mysql_fetch_assoc($response["results"]);
		return $data["setting_value"];
	}


	/**
	 * Used to update the settings on the Settings tab.
	 * @param array $post
	 */
	public function updateSettings($post) {
		$consoleEventsPublish   = isset($post["consoleEventsPublish"]) ? "enabled" : "";
		$consoleEventsSubscribe = isset($post["consoleEventsSubscribe"]) ? "enabled" : "";

		$prefix = Core::getDbTablePrefix();
		$result = Core::$db->query("
			UPDATE {$prefix}settings
			SET    setting_value = '$consoleEventsPublish'
			WHERE  setting_name = 'consoleEventsPublish'
		");

		Core::$db->query("
			UPDATE {$prefix}settings
			SET    setting_value = '$consoleEventsSubscribe'
			WHERE  setting_name = 'consoleEventsSubscribe'
		");
	}
}
