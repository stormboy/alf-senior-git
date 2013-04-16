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

            <% if Content %>
            <div id="page" class="page-wide">
                $Content
            </div>
            <% end_if %>

            <div id="directory">
                <!--
                <h2>Dr. First name Lastname</h2>
                -->
                <ul id="directory-select-top">
                    <li><a href="#">A</a></li>
                    <li><a href="#">B</a></li>
                    <li><a href="#" class="current">C</a></li>
                    <li><a href="#">D</a></li>
                    <li><a href="#">E</a></li>
                    <li><a href="#">F</a></li>
                    <li><a href="#">G</a></li>
                    <li><a href="#">H</a></li>
                    <li><a href="#">I</a></li>
                    <li><a href="#">J</a></li>
                    <li><a href="#">K</a></li>
                    <li><a href="#">L</a></li>
                    <li><a href="#">M</a></li>
                    <li><a href="#">N</a></li>
                    <li><a href="#">O</a></li>
                    <li><a href="#">P</a></li>
                    <li><a href="#">Q</a></li>
                    <li><a href="#">R</a></li>
                    <li><a href="#">S</a></li>
                    <li><a href="#">T</a></li>
                    <li><a href="#">U</a></li>
                    <li><a href="#">V</a></li>
                    <li><a href="#">W</a></li>
                    <li><a href="#">X</a></li>
                    <li><a href="#">Y</a></li>
                    <li><a href="#">Z</a></li>
                </ul>
                <div id="directory-contents">
                    <ul>
                    <% control Staff('A') %>
                        <li <% if Last %>class="last"<% end_if %>><a href="$Link">$Title</a></li>
                    <% end_control %>
                    </ul>
                </div>
                <ul id="directory-select-bottom">
                    <li><a href="#">A</a></li>
                    <li><a href="#">B</a></li>
                    <li><a href="#" class="current">C</a></li>
                    <li><a href="#">D</a></li>
                    <li><a href="#">E</a></li>
                    <li><a href="#">F</a></li>
                    <li><a href="#">G</a></li>
                    <li><a href="#">H</a></li>
                    <li><a href="#">I</a></li>
                    <li><a href="#">J</a></li>
                    <li><a href="#">K</a></li>
                    <li><a href="#">L</a></li>
                    <li><a href="#">M</a></li>
                    <li><a href="#">N</a></li>
                    <li><a href="#">O</a></li>
                    <li><a href="#">P</a></li>
                    <li><a href="#">Q</a></li>
                    <li><a href="#">R</a></li>
                    <li><a href="#">S</a></li>
                    <li><a href="#">T</a></li>
                    <li><a href="#">U</a></li>
                    <li><a href="#">V</a></li>
                    <li><a href="#">W</a></li>
                    <li><a href="#">X</a></li>
                    <li><a href="#">Y</a></li>
                    <li><a href="#">Z</a></li>
                </ul>
            </div>


            <% include SideBar %>
            
        </div><!-- END #content -->
        
        <% include Footer%>
        
    </div> <!-- END .outer -->
</div><!-- END .wrap -->
