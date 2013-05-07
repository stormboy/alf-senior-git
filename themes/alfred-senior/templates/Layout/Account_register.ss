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

            <div id="page" class="page-wide">
            
            <% if Image %>
                <img src="$Image.URL" style="float: left; width: 270px; margin: 10px;"/>
            <% end_if %>

            $Content
            $Form

            </div>

            <% include SideBar %>
            
        </div><!-- END #content -->
        
        <% include Footer%>
        
    </div> <!-- END .outer -->
</div><!-- END .wrap -->