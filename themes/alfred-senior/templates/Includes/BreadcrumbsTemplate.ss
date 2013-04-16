<% if Pages %>
    <% loop Pages %>
        <% if Last %>$Title.XML<% else %><a href="$Link">$MenuTitle.XML</a> ><% end_if %>
    <% end_loop %>
<% end_if %>