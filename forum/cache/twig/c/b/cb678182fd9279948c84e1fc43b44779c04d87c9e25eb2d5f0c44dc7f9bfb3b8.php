<?php

/* overall_header.html */
class __TwigTemplate_cb678182fd9279948c84e1fc43b44779c04d87c9e25eb2d5f0c44dc7f9bfb3b8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        if (isset($context["S_CONTENT_DIRECTION"])) { $_S_CONTENT_DIRECTION_ = $context["S_CONTENT_DIRECTION"]; } else { $_S_CONTENT_DIRECTION_ = null; }
        echo $_S_CONTENT_DIRECTION_;
        echo "\" lang=\"";
        if (isset($context["S_USER_LANG"])) { $_S_USER_LANG_ = $context["S_USER_LANG"]; } else { $_S_USER_LANG_ = null; }
        echo $_S_USER_LANG_;
        echo "\">
<head>
<meta charset=\"utf-8\" />
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
";
        // line 6
        if (isset($context["META"])) { $_META_ = $context["META"]; } else { $_META_ = null; }
        echo $_META_;
        echo "
<title>";
        // line 7
        if (isset($context["UNREAD_NOTIFICATIONS_COUNT"])) { $_UNREAD_NOTIFICATIONS_COUNT_ = $context["UNREAD_NOTIFICATIONS_COUNT"]; } else { $_UNREAD_NOTIFICATIONS_COUNT_ = null; }
        if ($_UNREAD_NOTIFICATIONS_COUNT_) {
            echo "(";
            if (isset($context["UNREAD_NOTIFICATIONS_COUNT"])) { $_UNREAD_NOTIFICATIONS_COUNT_ = $context["UNREAD_NOTIFICATIONS_COUNT"]; } else { $_UNREAD_NOTIFICATIONS_COUNT_ = null; }
            echo $_UNREAD_NOTIFICATIONS_COUNT_;
            echo ") ";
        }
        if (isset($context["S_VIEWTOPIC"])) { $_S_VIEWTOPIC_ = $context["S_VIEWTOPIC"]; } else { $_S_VIEWTOPIC_ = null; }
        if (isset($context["S_VIEWFORUM"])) { $_S_VIEWFORUM_ = $context["S_VIEWFORUM"]; } else { $_S_VIEWFORUM_ = null; }
        if (( !$_S_VIEWTOPIC_ &&  !$_S_VIEWFORUM_)) {
            echo "Форум Ассоциации ТСЖ - ";
        }
        if (isset($context["S_IN_MCP"])) { $_S_IN_MCP_ = $context["S_IN_MCP"]; } else { $_S_IN_MCP_ = null; }
        if (isset($context["S_IN_UCP"])) { $_S_IN_UCP_ = $context["S_IN_UCP"]; } else { $_S_IN_UCP_ = null; }
        if ($_S_IN_MCP_) {
            echo $this->env->getExtension('phpbb')->lang("MCP");
            echo " - ";
        } elseif ($_S_IN_UCP_) {
            echo $this->env->getExtension('phpbb')->lang("UCP");
            echo " - ";
        }
        if (isset($context["PAGE_TITLE"])) { $_PAGE_TITLE_ = $context["PAGE_TITLE"]; } else { $_PAGE_TITLE_ = null; }
        echo $_PAGE_TITLE_;
        if (isset($context["S_VIEWTOPIC"])) { $_S_VIEWTOPIC_ = $context["S_VIEWTOPIC"]; } else { $_S_VIEWTOPIC_ = null; }
        if (isset($context["S_VIEWFORUM"])) { $_S_VIEWFORUM_ = $context["S_VIEWFORUM"]; } else { $_S_VIEWFORUM_ = null; }
        if (($_S_VIEWTOPIC_ || $_S_VIEWFORUM_)) {
            echo " - ";
            if (isset($context["SITENAME"])) { $_SITENAME_ = $context["SITENAME"]; } else { $_SITENAME_ = null; }
            echo $_SITENAME_;
        }
        echo "</title>

";
        // line 9
        if (isset($context["S_ENABLE_FEEDS"])) { $_S_ENABLE_FEEDS_ = $context["S_ENABLE_FEEDS"]; } else { $_S_ENABLE_FEEDS_ = null; }
        if ($_S_ENABLE_FEEDS_) {
            // line 10
            echo "\t";
            if (isset($context["S_ENABLE_FEEDS_OVERALL"])) { $_S_ENABLE_FEEDS_OVERALL_ = $context["S_ENABLE_FEEDS_OVERALL"]; } else { $_S_ENABLE_FEEDS_OVERALL_ = null; }
            if ($_S_ENABLE_FEEDS_OVERALL_) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                if (isset($context["SITENAME"])) { $_SITENAME_ = $context["SITENAME"]; } else { $_SITENAME_ = null; }
                echo $_SITENAME_;
                echo "\" href=\"";
                if (isset($context["U_FEED"])) { $_U_FEED_ = $context["U_FEED"]; } else { $_U_FEED_ = null; }
                echo $_U_FEED_;
                echo "\">";
            }
            // line 11
            echo "\t";
            if (isset($context["S_ENABLE_FEEDS_NEWS"])) { $_S_ENABLE_FEEDS_NEWS_ = $context["S_ENABLE_FEEDS_NEWS"]; } else { $_S_ENABLE_FEEDS_NEWS_ = null; }
            if ($_S_ENABLE_FEEDS_NEWS_) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FEED_NEWS");
                echo "\" href=\"";
                if (isset($context["U_FEED"])) { $_U_FEED_ = $context["U_FEED"]; } else { $_U_FEED_ = null; }
                echo $_U_FEED_;
                echo "?mode=news\">";
            }
            // line 12
            echo "\t";
            if (isset($context["S_ENABLE_FEEDS_FORUMS"])) { $_S_ENABLE_FEEDS_FORUMS_ = $context["S_ENABLE_FEEDS_FORUMS"]; } else { $_S_ENABLE_FEEDS_FORUMS_ = null; }
            if ($_S_ENABLE_FEEDS_FORUMS_) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("ALL_FORUMS");
                echo "\" href=\"";
                if (isset($context["U_FEED"])) { $_U_FEED_ = $context["U_FEED"]; } else { $_U_FEED_ = null; }
                echo $_U_FEED_;
                echo "?mode=forums\">";
            }
            // line 13
            echo "\t";
            if (isset($context["S_ENABLE_FEEDS_TOPICS"])) { $_S_ENABLE_FEEDS_TOPICS_ = $context["S_ENABLE_FEEDS_TOPICS"]; } else { $_S_ENABLE_FEEDS_TOPICS_ = null; }
            if ($_S_ENABLE_FEEDS_TOPICS_) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FEED_TOPICS_NEW");
                echo "\" href=\"";
                if (isset($context["U_FEED"])) { $_U_FEED_ = $context["U_FEED"]; } else { $_U_FEED_ = null; }
                echo $_U_FEED_;
                echo "?mode=topics\">";
            }
            // line 14
            echo "\t";
            if (isset($context["S_ENABLE_FEEDS_TOPICS_ACTIVE"])) { $_S_ENABLE_FEEDS_TOPICS_ACTIVE_ = $context["S_ENABLE_FEEDS_TOPICS_ACTIVE"]; } else { $_S_ENABLE_FEEDS_TOPICS_ACTIVE_ = null; }
            if ($_S_ENABLE_FEEDS_TOPICS_ACTIVE_) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FEED_TOPICS_ACTIVE");
                echo "\" href=\"";
                if (isset($context["U_FEED"])) { $_U_FEED_ = $context["U_FEED"]; } else { $_U_FEED_ = null; }
                echo $_U_FEED_;
                echo "?mode=topics_active\">";
            }
            // line 15
            echo "\t";
            if (isset($context["S_ENABLE_FEEDS_FORUM"])) { $_S_ENABLE_FEEDS_FORUM_ = $context["S_ENABLE_FEEDS_FORUM"]; } else { $_S_ENABLE_FEEDS_FORUM_ = null; }
            if (isset($context["S_FORUM_ID"])) { $_S_FORUM_ID_ = $context["S_FORUM_ID"]; } else { $_S_FORUM_ID_ = null; }
            if (($_S_ENABLE_FEEDS_FORUM_ && $_S_FORUM_ID_)) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FORUM");
                echo " - ";
                if (isset($context["FORUM_NAME"])) { $_FORUM_NAME_ = $context["FORUM_NAME"]; } else { $_FORUM_NAME_ = null; }
                echo $_FORUM_NAME_;
                echo "\" href=\"";
                if (isset($context["U_FEED"])) { $_U_FEED_ = $context["U_FEED"]; } else { $_U_FEED_ = null; }
                echo $_U_FEED_;
                echo "?f=";
                if (isset($context["S_FORUM_ID"])) { $_S_FORUM_ID_ = $context["S_FORUM_ID"]; } else { $_S_FORUM_ID_ = null; }
                echo $_S_FORUM_ID_;
                echo "\">";
            }
            // line 16
            echo "\t";
            if (isset($context["S_ENABLE_FEEDS_TOPIC"])) { $_S_ENABLE_FEEDS_TOPIC_ = $context["S_ENABLE_FEEDS_TOPIC"]; } else { $_S_ENABLE_FEEDS_TOPIC_ = null; }
            if (isset($context["S_TOPIC_ID"])) { $_S_TOPIC_ID_ = $context["S_TOPIC_ID"]; } else { $_S_TOPIC_ID_ = null; }
            if (($_S_ENABLE_FEEDS_TOPIC_ && $_S_TOPIC_ID_)) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("TOPIC");
                echo " - ";
                if (isset($context["TOPIC_TITLE"])) { $_TOPIC_TITLE_ = $context["TOPIC_TITLE"]; } else { $_TOPIC_TITLE_ = null; }
                echo $_TOPIC_TITLE_;
                echo "\" href=\"";
                if (isset($context["U_FEED"])) { $_U_FEED_ = $context["U_FEED"]; } else { $_U_FEED_ = null; }
                echo $_U_FEED_;
                echo "?f=";
                if (isset($context["S_FORUM_ID"])) { $_S_FORUM_ID_ = $context["S_FORUM_ID"]; } else { $_S_FORUM_ID_ = null; }
                echo $_S_FORUM_ID_;
                echo "&amp;t=";
                if (isset($context["S_TOPIC_ID"])) { $_S_TOPIC_ID_ = $context["S_TOPIC_ID"]; } else { $_S_TOPIC_ID_ = null; }
                echo $_S_TOPIC_ID_;
                echo "\">";
            }
            // line 17
            echo "\t";
            if (isset($context["overall_header_feeds"])) { $_overall_header_feeds_ = $context["overall_header_feeds"]; } else { $_overall_header_feeds_ = null; }
        }
        // line 19
        echo "
";
        // line 20
        if (isset($context["U_CANONICAL"])) { $_U_CANONICAL_ = $context["U_CANONICAL"]; } else { $_U_CANONICAL_ = null; }
        if ($_U_CANONICAL_) {
            // line 21
            echo "\t<link rel=\"canonical\" href=\"";
            if (isset($context["U_CANONICAL"])) { $_U_CANONICAL_ = $context["U_CANONICAL"]; } else { $_U_CANONICAL_ = null; }
            echo $_U_CANONICAL_;
            echo "\">
";
        }
        // line 23
        echo "
<!--
\tphpBB style name: prosilver
\tBased on style:   prosilver (this is the default phpBB3 style)
\tOriginal author:  Tom Beddard ( http://www.subBlue.com/ )
\tModified by:
-->

";
        // line 31
        if (isset($context["S_ALLOW_CDN"])) { $_S_ALLOW_CDN_ = $context["S_ALLOW_CDN"]; } else { $_S_ALLOW_CDN_ = null; }
        if ($_S_ALLOW_CDN_) {
            // line 32
            echo "<script>
\tWebFontConfig = {
\t\tgoogle: {
\t\t\tfamilies: ['Open+Sans:600:cyrillic-ext,latin,greek-ext,greek,vietnamese,latin-ext,cyrillic']
\t\t}
\t};

\t(function(d) {
\t\tvar wf = d.createElement('script'), s = d.scripts[0];
\t\twf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js';
\t\twf.async = true;
\t\ts.parentNode.insertBefore(wf, s);
\t})(document);
</script>
";
        }
        // line 47
        echo "<link href=\"";
        if (isset($context["T_STYLESHEET_LINK"])) { $_T_STYLESHEET_LINK_ = $context["T_STYLESHEET_LINK"]; } else { $_T_STYLESHEET_LINK_ = null; }
        echo $_T_STYLESHEET_LINK_;
        echo "\" rel=\"stylesheet\">
<link href=\"";
        // line 48
        if (isset($context["T_STYLESHEET_LANG_LINK"])) { $_T_STYLESHEET_LANG_LINK_ = $context["T_STYLESHEET_LANG_LINK"]; } else { $_T_STYLESHEET_LANG_LINK_ = null; }
        echo $_T_STYLESHEET_LANG_LINK_;
        echo "\" rel=\"stylesheet\">
<link href=\"";
        // line 49
        if (isset($context["T_THEME_PATH"])) { $_T_THEME_PATH_ = $context["T_THEME_PATH"]; } else { $_T_THEME_PATH_ = null; }
        echo $_T_THEME_PATH_;
        echo "/responsive.css?assets_version=";
        if (isset($context["T_ASSETS_VERSION"])) { $_T_ASSETS_VERSION_ = $context["T_ASSETS_VERSION"]; } else { $_T_ASSETS_VERSION_ = null; }
        echo $_T_ASSETS_VERSION_;
        echo "\" rel=\"stylesheet\" media=\"all and (max-width: 700px), all and (max-device-width: 700px)\">

";
        // line 51
        if (isset($context["S_CONTENT_DIRECTION"])) { $_S_CONTENT_DIRECTION_ = $context["S_CONTENT_DIRECTION"]; } else { $_S_CONTENT_DIRECTION_ = null; }
        if (($_S_CONTENT_DIRECTION_ == "rtl")) {
            // line 52
            echo "\t<link href=\"";
            if (isset($context["T_THEME_PATH"])) { $_T_THEME_PATH_ = $context["T_THEME_PATH"]; } else { $_T_THEME_PATH_ = null; }
            echo $_T_THEME_PATH_;
            echo "/bidi.css?assets_version=";
            if (isset($context["T_ASSETS_VERSION"])) { $_T_ASSETS_VERSION_ = $context["T_ASSETS_VERSION"]; } else { $_T_ASSETS_VERSION_ = null; }
            echo $_T_ASSETS_VERSION_;
            echo "\" rel=\"stylesheet\">
";
        }
        // line 54
        echo "
";
        // line 55
        if (isset($context["S_PLUPLOAD"])) { $_S_PLUPLOAD_ = $context["S_PLUPLOAD"]; } else { $_S_PLUPLOAD_ = null; }
        if ($_S_PLUPLOAD_) {
            // line 56
            echo "\t<link href=\"";
            if (isset($context["T_THEME_PATH"])) { $_T_THEME_PATH_ = $context["T_THEME_PATH"]; } else { $_T_THEME_PATH_ = null; }
            echo $_T_THEME_PATH_;
            echo "/plupload.css?assets_version=";
            if (isset($context["T_ASSETS_VERSION"])) { $_T_ASSETS_VERSION_ = $context["T_ASSETS_VERSION"]; } else { $_T_ASSETS_VERSION_ = null; }
            echo $_T_ASSETS_VERSION_;
            echo "\" rel=\"stylesheet\">
";
        }
        // line 58
        echo "
<!--[if lte IE 9]>
\t<link href=\"";
        // line 60
        if (isset($context["T_THEME_PATH"])) { $_T_THEME_PATH_ = $context["T_THEME_PATH"]; } else { $_T_THEME_PATH_ = null; }
        echo $_T_THEME_PATH_;
        echo "/tweaks.css?assets_version=";
        if (isset($context["T_ASSETS_VERSION"])) { $_T_ASSETS_VERSION_ = $context["T_ASSETS_VERSION"]; } else { $_T_ASSETS_VERSION_ = null; }
        echo $_T_ASSETS_VERSION_;
        echo "\" rel=\"stylesheet\">
<![endif]-->

";
        // line 63
        if (isset($context["overall_header_head_append"])) { $_overall_header_head_append_ = $context["overall_header_head_append"]; } else { $_overall_header_head_append_ = null; }
        // line 64
        echo "
";
        // line 65
        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
        echo $this->getAttribute($_definition_, "STYLESHEETS", array());
        echo "

";
        // line 67
        if (isset($context["overall_header_stylesheets_after"])) { $_overall_header_stylesheets_after_ = $context["overall_header_stylesheets_after"]; } else { $_overall_header_stylesheets_after_ = null; }
        // line 68
        echo "
</head>
<body id=\"phpbb\" class=\"nojs notouch section-";
        // line 70
        if (isset($context["SCRIPT_NAME"])) { $_SCRIPT_NAME_ = $context["SCRIPT_NAME"]; } else { $_SCRIPT_NAME_ = null; }
        echo $_SCRIPT_NAME_;
        echo " ";
        if (isset($context["S_CONTENT_DIRECTION"])) { $_S_CONTENT_DIRECTION_ = $context["S_CONTENT_DIRECTION"]; } else { $_S_CONTENT_DIRECTION_ = null; }
        echo $_S_CONTENT_DIRECTION_;
        echo " ";
        if (isset($context["BODY_CLASS"])) { $_BODY_CLASS_ = $context["BODY_CLASS"]; } else { $_BODY_CLASS_ = null; }
        echo $_BODY_CLASS_;
        echo "\">

";
        // line 72
        if (isset($context["overall_header_body_before"])) { $_overall_header_body_before_ = $context["overall_header_body_before"]; } else { $_overall_header_body_before_ = null; }
        // line 73
        echo "
<div id=\"wrap\">
\t<a id=\"top\" class=\"anchor\" accesskey=\"t\"></a>
\t<div id=\"page-header\">
\t\t<div class=\"headerbar\" role=\"banner\">
\t\t\t<div class=\"inner\">

\t\t\t<div id=\"site-description\">
\t\t\t\t<a id=\"logo\" class=\"logo\" href=\"/forum\">";
        // line 81
        if (isset($context["SITE_LOGO_IMG"])) { $_SITE_LOGO_IMG_ = $context["SITE_LOGO_IMG"]; } else { $_SITE_LOGO_IMG_ = null; }
        echo $_SITE_LOGO_IMG_;
        echo "</a>
\t\t\t\t<h1>Ассоциация ТСЖ</h1>
\t\t\t\t
\t\t\t\t<p class=\"skiplink\"><a href=\"#start_here\">";
        // line 84
        echo $this->env->getExtension('phpbb')->lang("SKIP");
        echo "</a></p>
\t\t\t</div>

\t\t\t";
        // line 87
        if (isset($context["overall_header_searchbox_before"])) { $_overall_header_searchbox_before_ = $context["overall_header_searchbox_before"]; } else { $_overall_header_searchbox_before_ = null; }
        // line 88
        echo "\t\t\t";
        if (isset($context["S_DISPLAY_SEARCH"])) { $_S_DISPLAY_SEARCH_ = $context["S_DISPLAY_SEARCH"]; } else { $_S_DISPLAY_SEARCH_ = null; }
        if (isset($context["S_IN_SEARCH"])) { $_S_IN_SEARCH_ = $context["S_IN_SEARCH"]; } else { $_S_IN_SEARCH_ = null; }
        if (($_S_DISPLAY_SEARCH_ &&  !$_S_IN_SEARCH_)) {
            // line 89
            echo "\t\t\t<div id=\"search-box\" class=\"search-box search-header\" role=\"search\">
\t\t\t\t<form action=\"";
            // line 90
            if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
            echo $_U_SEARCH_;
            echo "\" method=\"get\" id=\"search\">
\t\t\t\t<fieldset>
\t\t\t\t\t<input name=\"keywords\" id=\"keywords\" type=\"search\" maxlength=\"128\" title=\"";
            // line 92
            echo $this->env->getExtension('phpbb')->lang("SEARCH_KEYWORDS");
            echo "\" class=\"inputbox search tiny\" size=\"20\" value=\"";
            if (isset($context["SEARCH_WORDS"])) { $_SEARCH_WORDS_ = $context["SEARCH_WORDS"]; } else { $_SEARCH_WORDS_ = null; }
            echo $_SEARCH_WORDS_;
            echo "\" placeholder=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_MINI");
            echo "\" />
\t\t\t\t\t<button class=\"button icon-button search-icon\" type=\"submit\" title=\"";
            // line 93
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "</button>
\t\t\t\t\t<a href=\"";
            // line 94
            if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
            echo $_U_SEARCH_;
            echo "\" class=\"button icon-button search-adv-icon\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "</a>
\t\t\t\t\t";
            // line 95
            if (isset($context["S_SEARCH_HIDDEN_FIELDS"])) { $_S_SEARCH_HIDDEN_FIELDS_ = $context["S_SEARCH_HIDDEN_FIELDS"]; } else { $_S_SEARCH_HIDDEN_FIELDS_ = null; }
            echo $_S_SEARCH_HIDDEN_FIELDS_;
            echo "
\t\t\t\t</fieldset>
\t\t\t\t</form>
\t\t\t</div>
\t\t\t";
        }
        // line 100
        echo "
\t\t\t</div>
\t\t</div>
\t\t";
        // line 103
        if (isset($context["overall_header_navbar_before"])) { $_overall_header_navbar_before_ = $context["overall_header_navbar_before"]; } else { $_overall_header_navbar_before_ = null; }
        // line 104
        echo "\t\t";
        $location = "navbar_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("navbar_header.html", "overall_header.html", 104)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 105
        echo "\t</div>

\t";
        // line 107
        if (isset($context["overall_header_page_body_before"])) { $_overall_header_page_body_before_ = $context["overall_header_page_body_before"]; } else { $_overall_header_page_body_before_ = null; }
        // line 108
        echo "
\t<a id=\"start_here\" class=\"anchor\"></a>
\t<div id=\"page-body\" role=\"main\">
\t\t";
        // line 111
        if (isset($context["S_BOARD_DISABLED"])) { $_S_BOARD_DISABLED_ = $context["S_BOARD_DISABLED"]; } else { $_S_BOARD_DISABLED_ = null; }
        if (isset($context["S_USER_LOGGED_IN"])) { $_S_USER_LOGGED_IN_ = $context["S_USER_LOGGED_IN"]; } else { $_S_USER_LOGGED_IN_ = null; }
        if (isset($context["U_MCP"])) { $_U_MCP_ = $context["U_MCP"]; } else { $_U_MCP_ = null; }
        if (isset($context["U_ACP"])) { $_U_ACP_ = $context["U_ACP"]; } else { $_U_ACP_ = null; }
        if ((($_S_BOARD_DISABLED_ && $_S_USER_LOGGED_IN_) && ($_U_MCP_ || $_U_ACP_))) {
            // line 112
            echo "\t\t<div id=\"information\" class=\"rules\">
\t\t\t<div class=\"inner\">
\t\t\t\t<strong>";
            // line 114
            echo $this->env->getExtension('phpbb')->lang("INFORMATION");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</strong> ";
            echo $this->env->getExtension('phpbb')->lang("BOARD_DISABLED");
            echo "
\t\t\t</div>
\t\t</div>
\t\t";
        }
        // line 118
        echo "
\t\t";
        // line 119
        if (isset($context["overall_header_content_before"])) { $_overall_header_content_before_ = $context["overall_header_content_before"]; } else { $_overall_header_content_before_ = null; }
    }

    public function getTemplateName()
    {
        return "overall_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  451 => 119,  448 => 118,  438 => 114,  434 => 112,  428 => 111,  423 => 108,  421 => 107,  417 => 105,  404 => 104,  402 => 103,  397 => 100,  388 => 95,  379 => 94,  373 => 93,  364 => 92,  358 => 90,  355 => 89,  350 => 88,  348 => 87,  342 => 84,  335 => 81,  325 => 73,  323 => 72,  311 => 70,  307 => 68,  305 => 67,  299 => 65,  296 => 64,  294 => 63,  284 => 60,  280 => 58,  270 => 56,  267 => 55,  264 => 54,  254 => 52,  251 => 51,  242 => 49,  237 => 48,  231 => 47,  214 => 32,  211 => 31,  201 => 23,  194 => 21,  191 => 20,  188 => 19,  184 => 17,  161 => 16,  141 => 15,  128 => 14,  115 => 13,  102 => 12,  89 => 11,  75 => 10,  72 => 9,  38 => 7,  33 => 6,  22 => 2,  19 => 1,);
    }
}
