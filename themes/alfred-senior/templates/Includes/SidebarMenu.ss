<%--Include SidebarMenu recursively --%>
<% if LinkOrSection = section %>
	<% if $Children %>
		<% loop $Children %>
			<li class="top $LinkingMode">
				<a href="$Link" class="$LinkingMode" title="Go to the $Title.XML page">
					$MenuTitle.XML
				</a>
				<% if $Children %>
					<ul>
						<% loop $Children %>
                            <li>
								<a href="$Link" class="$LinkingMode" title="Go to the $Title.XML page">
									$MenuTitle.XML
								</a>
                            </li>
                        <% end_loop %>
					</ul>
				<% end_if %>
			</li>
		<% end_loop %>
	<% end_if %>
<% end_if %>
