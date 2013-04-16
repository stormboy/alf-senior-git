<div class="wrap wrap-title"> 
    <div class="outer">
        <div class="inner">
            
            <div id="section">
                <h2>$Title</h2>
                <img src="$ThemeDir/images/section-{$Level(1).URLSegment}.png" alt="$Level(1).Title" />
            </div>
            
        </div><!-- END .inner -->
    </div> <!-- END .outer -->
</div><!-- END .wrap -->

<div class="wrap wrap-layout"> 
    <div class="outer">
    
        <div id="content">
            <div id="breadcrumb">
                <% include BreadCrumbs %>
            </div>

            <div id="staff">
                <div id="staff-overview">
                    <div id="staff-image">
                    <% if ProfileImageID %>
                        <img src="$ProfileImage.URL" alt="$Title" />
                    <% else %>
                        <img src="assets/statff-profile.jpg" alt="" />
                    <% end_if %>
                    </div>
                    <div id="staff-details">
                        <h2>$Title</h2>
                    <% if Email %>
                        <p><strong>Email:</strong><br />
                        <a href="mailto:$Email">$Email</a></p>
                    <% end_if %>
                    <% if Phone1 %>
                        <p><strong>Primary Telephone:</strong><br />
                        $Phone1</p>
                    <% end_if %>
                    <% if Phone2 %>
                        <p><strong>Secondary Telephone:</strong><br />
                        $Phone2</p>
                    <% end_if %>
                        <a href="#" class="button-blue">Download vCard</a>
                    </div>
                </div>
                <h3>Biography</h3>
                <p>$Biography</p>
                <h3>Accolades and Achievements</h3>
                <p>$Achievements</p>
                <h3>Other Information</h3>
                <p>$OtherInformation</p>
            </div>

            <% include SideBar %>
            
        </div><!-- END #content -->
        
        <% include Footer%>
        
    </div> <!-- END .outer -->
</div><!-- END .wrap -->

