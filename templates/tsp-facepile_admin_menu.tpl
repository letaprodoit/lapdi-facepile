<div class="wrap">
	<div class="icon32 icon32-tsp" id="icon-options-general"></div>
	<h2>{$title}</h2>
	<h3 style="color: #B4100E;">Professional WordPress Plugins</h3>
	{if  0 < $count_activate_pro}
		<div style="padding-left:15px;">
			<h4>Activated plugins</h4>
			{foreach $array_activate_pro as $activate_plugin}
				<div style="float:left; width:200px;">{$activate_plugin.title}</div> 
				<p>
					<a href="{$activate_plugin.title}" target="_blank">Read more</a>
					<a href="{$activate_plugin.url}">Settings</a>
				</p>
			{/foreach}
		</div>
	{/if}
	{if  0 < $count_install_pro}
		<div style="padding-left:15px;">
			<h4>Installed plugins</h4>
			{foreach $array_install_pro as $install_plugin}
				<div style="float:left; width:200px;">{$install_plugin.title}</div>
				<p><a href="{$install_plugin.link}" target="_blank">Read more</a></p>
			{/foreach}
		</div>
	{/if}
	{if  0 < $count_recomend_pro }
		<div style="padding-left:15px;">
			<h4>Recommended plugins</h4>
			{foreach $array_recomend_pro as $recomend_plugin }
				<div style="float:left; width:200px;">{$recomend_plugin.title}</div> 
				<p>
					<a href="{$recomend_plugin.link}" target="_blank">Read more</a>
					<a href="{$recomend_plugin.href}" target="_blank">Purchase</a>
				</p>
			{/foreach}
		</div>
	{/if}
	<br />
	<h3 style="color: #1A77B1">Free WordPress Plugins</h3>
	{if  0 < $count_activate }
		<div style="padding-left:15px;">
			<h4>Activated plugins</h4>
			{foreach $array_activate as $activate_plugin }
				<div style="float:left; width:200px;">{$activate_plugin.title}</div> 
				<p>
					<a href="{$activate_plugin.link}" target="_blank">Read more</a> 
					<a href="{$activate_plugin.url}">Settings</a>
				</p>
			{/foreach}
		</div>
	{/if}
	{if  0 < $count_install }
		<div style="padding-left:15px;">
			<h4>Installed plugins</h4>
			{foreach $array_install as $install_plugin }
				<div style="float:left; width:200px;">{$install_plugin.title}</div>
				<p><a href="{$install_plugin.link}" target="_blank">Read more</a></p>
			{/foreach}
		</div>
	{/if}
	{if  0 < $count_recomend }
		<div style="padding-left:15px;">
			<h4>Recommended plugins</h4>
			{foreach $array_recomend as $recomend_plugin }
				<div style="float:left; width:200px;">{$recomend_plugin.title}</div> 
				<p>
					<a href="{$recomend_plugin.link}" target="_blank">Read more</a>
					<a href="{$recomend_plugin.href}" target="_blank">Download</a> 
					<a class="install-now" href="{$blog_url} {$recomend_plugin.slug}; ?>" title="Install {$recomend_plugin.title}" target="_blank">Install now from wordpress.org</a>
				</p>
			{/foreach}
		</div>
	{/if}
	<br />		
	<span style="color: rgb(136, 136, 136); font-size: 10px;">If you have any questions, please contact us via <a target="_blank" href="{$contact_url}">{$contact_url}</a></span>
</div>
