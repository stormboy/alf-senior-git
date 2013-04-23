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
                    <% control Alphabet %>
                        <li><a href="{$CurrentPage.Link}?letter={$lower}" <% if $current %>class="current"<% end_if %>>$upper</a></li>
                    <% end_control %>
                </ul>
                <div id="directory-contents">
                    <ul>
                    <% control Staff %>
                        <li <% if Last %>class="last"<% end_if %>><a href="$Link">$Title</a></li>
                    <% end_control %>
                    </ul>
                </div>
                <ul id="directory-select-bottom">
                    <% control Alphabet %>
                        <li><a href="{$CurrentPage.Link}?letter={$lower}" <% if $current %>class="current"<% end_if %>>$upper</a></li>
                    <% end_control %>
                </ul>
            </div>


            <% include SideBar %>
            
        </div><!-- END #content -->
        
        <% include Footer%>
        
    </div> <!-- END .outer -->
</div><!-- END .wrap -->
