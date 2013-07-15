{foreach $settings as $fields}
	<!-- {$fields[$key]['label']} -->
	<p>
		{include file="$EASY_PLUGIN_FORM_FIELDS" fields=$fields}
	</p>
{/foreach}