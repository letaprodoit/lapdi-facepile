 <div class="tsp_container">
	<div class="icon32" id="tsp_icon"></div>
	<h2>Facepile Default Settings (The Software People)</h2>
	<div class="mycomment">
		<p><h3>Using Facepile Shortcode <a href="#" class="toggle">(hide/show details)</a>:</h3></p>
		<div class="note-details">
			<ul style="list-style-type:square;">
				<li>Changing the default post options below allows you to place <strong>[tsp-facepile]</strong> shortcode tag into any post or page with these options.</li>
				<li>However, if you wish to add different options to the <strong>[tsp-facepile]</strong> shortcode please use the following settings:
					<ul style="padding-left: 30px;">
						<li>Title: <strong>title="Title of Posts"</strong></li>
						<li>Show Names: <strong>show_names="Y"</strong>(Options: Y, N)</li>
						<li>Show Member Count: <strong>member_count="Y"</strong>(Options: Y, N)</li>
						<li>Number of Rows: <strong>num_rows="4"</strong></li>
						<li>Number of Columns: <strong>num_cols="4"</strong></li>
						<li>Thumbnail Width: <strong>thumb_width="80"</strong></li>
						<li>Thumbnail Height: <strong>thumb_height="80"</strong></li>
						<li>HTML Tag Before Title: <strong>before_title="&lt;h3 class='widget-title'&gt;"</strong></li>
						<li>HTML Tag After Title: <strong>after_title="&lt;/h3&gt;"</strong></li>
					</ul>
				</li>
				<li>Insert your desired shortcode into any page or post.</li>
			</ul>
			<hr>
			A shortcode with all the options will look like the following:<br><br>
			<strong>[tsp-facepile title="Facepile" show_names="Y" member_count="N" num_rows="4" num_cols="4" thumb_width="80" thumb_height="80" before_title="" after_title=""]</strong>
		</div>
	
	</div>
	<script>
		{literal}
		jQuery("div.tsp_container a.toggle").click(function () {
			jQuery(".note-details").toggle();
		});
		{/literal}
	</script>
	<div class="updated fade" {if !$form || $error != ""}style="display:none;"{/if}><p><strong>{$message}</strong></p></div>
	<div class="error" {if !$error}style="display:none;"{/if}><p><strong>{$error}</strong></p></div>
	<form method="post" action="admin.php?page={$plugin_name}.php">
		<fieldset>
		{foreach $form_fields as $field}
			{include file="$EASY_DEV_FORM_FIELDS" field=$field}
		{/foreach}
		</fieldset>
		<input type="hidden" name="{$plugin_name}_form_submit" value="submit" />
		<p class="submit">
			<input type="submit" class="button-primary" value="Save Changes" />
		</p>
		{$nonce_name}
	</form>
</div><!-- tsp_container -->
