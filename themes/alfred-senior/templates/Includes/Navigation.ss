<div id="navigation">
    <ul>
        <% loop $Menu(1) %>
			<li><a id="$MenuTitle" class="$LinkingMode" href="$Link" title="$Title.XML">$MenuTitle.XML</a></li>
		<% end_loop %>
    </ul>
</div>