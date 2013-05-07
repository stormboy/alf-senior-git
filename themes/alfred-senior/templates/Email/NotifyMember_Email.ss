<p>Hi {$FirstName}</p>
<% if Mode %>
<p>Your account has been {$Mode}.</p>
<% end_if %>
<p>Username: {$Email}<% if Mode = created %><br />
Password: {$MemberPassword}<% end_if %></p>