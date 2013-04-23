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

            <div id="news-feed">
                <% control Items %>
                    <!-- last post is different -->
                    <div class="news-post <% if Last %> last<% end_if %>">
                        <div class="news-post-alpha">
                            <span>$Date.format("d F Y")</span>
                        </div>
                        <div class="news-post-beta">
                            <h2>$Title</h2>
                            <p>
                                <% if Summary %>
                                    $Summary
                                <% else %>
                                    $Content.FirstParagraph()
                                <% end_if %>
                            </p>
                            <a href="$Link" class="read-more">Read the full article</a>
                        </div>
                    </div>
                <% end_control %>

                <!-- pagination -->
                <% if PaginatedItems.MoreThanOnePage %> 
                    <div id="news-pagination">
                        <% if PaginatedItems.PrevLink %> 
                            <a href="$PaginatedItems.PrevLink" class="newer-articles">Newer Articles</a>
                        <% end_if %>

                        <span>
                        <% control PaginatedItems.Pages %>
                            <% if CurrentBool %> 
                                <strong>$PageNum</strong>
                            <% else %> 
                                <a href="$Link" title="Go to page $PageNum">$PageNum</a> 
                            <% end_if %> 
                        <% end_control %>
                        </span>

                        <% if PaginatedItems.NextLink %> 
                            <a href="$PaginatedItems.NextLink" class="older-articles">Older Articles</a>
                        <% end_if %> 
                    </div> 
                <% end_if %>
            </div>

            <% include SideBar %>
            
        </div><!-- END #content -->
        
        <% include Footer%>
        
    </div> <!-- END .outer -->
</div><!-- END .wrap -->