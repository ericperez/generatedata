<?php

function smarty_function_data_types_dropdown($params, &$smarty) {
	$L = Core::$language->getCurrentLanguageStrings();
	$dataTypeGroups = Core::$dataTypePlugins; // TODO bad var name

	$options = "";
	while (list($group, $dataTypes) = each($dataTypeGroups)) {
		$groupName = $L[$group];
		$options .= "<optgroup label=\"$groupName\">\n";

		foreach ($dataTypes as $dataType) {
			$name = $dataType->getName();
			$options .= "<option value=\"{$dataType->folder}\">$name</option>\n";
		}
		$options .= "</optgroup>";
	}

	echo <<< END
	<select class="gdDataType" name="" id="gdDataType_%ROW%">
		<option value="">{$L["please_select"]}</option>
		$options
	</select>
END;
}
