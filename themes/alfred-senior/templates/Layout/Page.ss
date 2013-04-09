<div class="wrap wrap-title"> 
            <div class="outer">
                <div class="inner">
                    
                    <div id="section">
                        <h2>$Title</h2>
                        <img src="$ThemeDir/images/section-about.png" alt="About" />
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

                    <!--
                    <div id="subtitle">
                        <span>20 December 2012</span>
                    </div>
                    -->
                    <div id="page" class="page-wide">
                        
                    $Content
                    $Form

                    </div>

                    <% include SideBar %>
                    
                </div><!-- END #content -->
                
                <% include Footer%>
                
            </div> <!-- END .outer -->
        </div><!-- END .wrap -->