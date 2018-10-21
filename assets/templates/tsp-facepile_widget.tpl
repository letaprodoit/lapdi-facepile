{if $first_entry}
<div class="{$key}_wp_user_grid">
	<table class="{$key}_wp_user_table">
{/if}
    	{if $start_row}
    	<tr>
		{/if}
			<td>
				<div class="{$key}_wp_user_table_cell">
					{$display_gravatar}
				</div>
			</td>
		{if $end_row}
		</tr>
		{/if}
{if $last_entry}
	</table>
</div>
{if $show_count == 'Y'}<br><span class="{$key}_wp_user_grid_text">Total Members: {$total_users}</span>{/if}
{/if}
