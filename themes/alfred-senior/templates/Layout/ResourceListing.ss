<div class="wrap wrap-title"> 
	<div class="outer">
        <div class="inner">
            
            <div id="promo">
                <div id="promo-image">
                    <img src="assets/resource-promo.jpg" alt="" />
                </div>
                <div id="promo-copy">
                    <div id="promo-content">
                        <h1>Landing Header</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ultricies magna quis massa vestibulum tincidunt sit amet consequat lorem. Cras ac leo urna, at dapibus lacus.</p>
                    </div>
                </div>
            </div>
			 </div><!-- END .inner -->
    </div> <!-- END .outer -->
</div><!-- END .wrap -->
                    
<div class="wrap wrap-layout"> 
    <div class="outer">
    
        <div id="content">
            <div id="breadcrumb">
                <span><strong>YOU ARE HERE: <a href="#">Home</a> > </strong><a href="#">Resources</a></span>
            </div>
            <div id="resource-list">
				<% control Children %>
	                <div class="resource-item">
	                    <div class="resource-item-alpha">
	                        <img src="assets/hold-resource-item.jpg" alt="$Title" />
	                    </div>
	                    <div class="resource-item-beta">
	                        <h2>$Title</h2>
	                        <p>
	                        <% if Summary %>
								$Summary
							<% else %>
								$Content.FirstParagraph()
							<% end_if %>
							</p>
	                        <a href="$Link" class="button-blue">Learn More</a>
	                    </div>
	                </div>
				<% end_control %>

            </div>
        </div><!-- END #content -->
                
        <% include Footer%>
                
	</div> <!-- END .outer -->
</div><!-- END .wrap -->