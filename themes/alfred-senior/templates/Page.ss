<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <% base_tag %>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Alfred Senior Medical Staff</title>
        $MetaTags(false)
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="$ThemeDir/css/normalize.css">
        <link rel="stylesheet" href="$ThemeDir/css/main.css">
        <link rel="stylesheet" href="$ThemeDir/css/style.css">
        <link href='http://fonts.googleapis.com/css?family=News+Cycle:400,700' rel='stylesheet' type='text/css'>
        <script src="$ThemeDir/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
    	<div class="wrap">
            <div class="outer">
            
                <div id="top">
                
                    <div id="links">
                        <a href="{$BaseHref}contact">Contact</a>
                        <% if CurrentMember %> 
                            <a href="{$BaseHref}Security/logout" title="Logout {$CurrentMember.FirstName}">Logout</a>
                        <% else %> 
                            <a href="{$BaseHref}Security/login?BackURL={$BaseHref}" title="Login">Login</a>
                        <% end_if %>
                    </div>
                    <div id="search-wrap">
                        <form action="#">
                            <fieldset>
                                <div id="Search" class="field text nolabel">
                                    <div class="middleColumn">
                                        <input id="SearchForm_SearchForm_Search" class="text nolabel" type="text" value="Search..." name="Search">
                                    </div>
                                </div>
                                <input id="SearchForm_SearchForm_action_results" class="action " type="image" title="SEARCH" value="SEARCH" name="action_results" src="$ThemeDir/images/button-search.gif">
                            </fieldset>
                        </form>
                    </div>
                </div>

                <div id="header">
                    <div id="logo">
                        <h1><a href="$HomepageForDomain">Alfred Senior Medical Staff</a></h1>
                    </div>
                    <% include Navigation %>
                </div>
            </div> <!-- END .outer -->
        </div><!-- END .wrap -->

        $Layout

        <script src="$ThemeDir/js/vendor/jquery-1.9.0.min.js"></script>
        <script src="$ThemeDir/js/plugins.js"></script>
        <script src="$ThemeDir/js/main.js"></script>
    </body>
</html>

