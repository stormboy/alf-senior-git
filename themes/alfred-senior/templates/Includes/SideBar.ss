
<% if $Menu(2) %>
	<div id="sub-navigation">
		<ul>
		<% with $Level(1) %>
			<% include SidebarMenu %>
		<% end_with %>
		</ul>
 	</div>
<% end_if %>
