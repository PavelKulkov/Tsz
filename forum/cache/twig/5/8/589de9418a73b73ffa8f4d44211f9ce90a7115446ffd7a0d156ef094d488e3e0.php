<?php

/* search_results.html */
class __TwigTemplate_589de9418a73b73ffa8f4d44211f9ce90a7115446ffd7a0d156ef094d488e3e0 extends Twig_Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "search_results.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        if (isset($context["search_results_header_before"])) { $_search_results_header_before_ = $context["search_results_header_before"]; } else { $_search_results_header_before_ = null; }
        // line 4
        echo "
<h2 class=\"searchresults-title\">";
        // line 5
        if (isset($context["SEARCH_TITLE"])) { $_SEARCH_TITLE_ = $context["SEARCH_TITLE"]; } else { $_SEARCH_TITLE_ = null; }
        if ($_SEARCH_TITLE_) {
            if (isset($context["SEARCH_TITLE"])) { $_SEARCH_TITLE_ = $context["SEARCH_TITLE"]; } else { $_SEARCH_TITLE_ = null; }
            echo $_SEARCH_TITLE_;
        } else {
            if (isset($context["SEARCH_MATCHES"])) { $_SEARCH_MATCHES_ = $context["SEARCH_MATCHES"]; } else { $_SEARCH_MATCHES_ = null; }
            echo $_SEARCH_MATCHES_;
        }
        if (isset($context["SEARCH_WORDS"])) { $_SEARCH_WORDS_ = $context["SEARCH_WORDS"]; } else { $_SEARCH_WORDS_ = null; }
        if ($_SEARCH_WORDS_) {
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <a href=\"";
            if (isset($context["U_SEARCH_WORDS"])) { $_U_SEARCH_WORDS_ = $context["U_SEARCH_WORDS"]; } else { $_U_SEARCH_WORDS_ = null; }
            echo $_U_SEARCH_WORDS_;
            echo "\">";
            if (isset($context["SEARCH_WORDS"])) { $_SEARCH_WORDS_ = $context["SEARCH_WORDS"]; } else { $_SEARCH_WORDS_ = null; }
            echo $_SEARCH_WORDS_;
            echo "</a>";
        }
        echo "</h2>
";
        // line 6
        if (isset($context["SEARCHED_QUERY"])) { $_SEARCHED_QUERY_ = $context["SEARCHED_QUERY"]; } else { $_SEARCHED_QUERY_ = null; }
        if ($_SEARCHED_QUERY_) {
            echo " <p>";
            echo $this->env->getExtension('phpbb')->lang("SEARCHED_QUERY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <strong>";
            if (isset($context["SEARCHED_QUERY"])) { $_SEARCHED_QUERY_ = $context["SEARCHED_QUERY"]; } else { $_SEARCHED_QUERY_ = null; }
            echo $_SEARCHED_QUERY_;
            echo "</strong></p>";
        }
        // line 7
        if (isset($context["IGNORED_WORDS"])) { $_IGNORED_WORDS_ = $context["IGNORED_WORDS"]; } else { $_IGNORED_WORDS_ = null; }
        if ($_IGNORED_WORDS_) {
            echo " <p>";
            echo $this->env->getExtension('phpbb')->lang("IGNORED_TERMS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <strong>";
            if (isset($context["IGNORED_WORDS"])) { $_IGNORED_WORDS_ = $context["IGNORED_WORDS"]; } else { $_IGNORED_WORDS_ = null; }
            echo $_IGNORED_WORDS_;
            echo "</strong></p>";
        }
        // line 8
        if (isset($context["PHRASE_SEARCH_DISABLED"])) { $_PHRASE_SEARCH_DISABLED_ = $context["PHRASE_SEARCH_DISABLED"]; } else { $_PHRASE_SEARCH_DISABLED_ = null; }
        if ($_PHRASE_SEARCH_DISABLED_) {
            echo " <p><strong>";
            echo $this->env->getExtension('phpbb')->lang("PHRASE_SEARCH_DISABLED");
            echo "</strong></p>";
        }
        // line 9
        echo "
";
        // line 10
        if (isset($context["SEARCH_TOPIC"])) { $_SEARCH_TOPIC_ = $context["SEARCH_TOPIC"]; } else { $_SEARCH_TOPIC_ = null; }
        if ($_SEARCH_TOPIC_) {
            // line 11
            echo "\t<p class=\"return-link\"><a class=\"arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" href=\"";
            if (isset($context["U_SEARCH_TOPIC"])) { $_U_SEARCH_TOPIC_ = $context["U_SEARCH_TOPIC"]; } else { $_U_SEARCH_TOPIC_ = null; }
            echo $_U_SEARCH_TOPIC_;
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("RETURN_TO_TOPIC");
            echo "</a></p>
";
        } else {
            // line 13
            echo "\t<p class=\"advanced-search-link\"><a class=\"arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" href=\"";
            if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
            echo $_U_SEARCH_;
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("GO_TO_SEARCH_ADV");
            echo "</a></p>
";
        }
        // line 15
        echo "
";
        // line 16
        if (isset($context["search_results_header_after"])) { $_search_results_header_after_ = $context["search_results_header_after"]; } else { $_search_results_header_after_ = null; }
        // line 17
        echo "
";
        // line 18
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["SEARCH_MATCHES"])) { $_SEARCH_MATCHES_ = $context["SEARCH_MATCHES"]; } else { $_SEARCH_MATCHES_ = null; }
        if (isset($context["TOTAL_MATCHES"])) { $_TOTAL_MATCHES_ = $context["TOTAL_MATCHES"]; } else { $_TOTAL_MATCHES_ = null; }
        if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
        if ((((twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array())) || $_SEARCH_MATCHES_) || $_TOTAL_MATCHES_) || $_PAGE_NUMBER_)) {
            // line 19
            echo "\t<div class=\"action-bar top\">

\t";
            // line 21
            if (isset($context["TOTAL_MATCHES"])) { $_TOTAL_MATCHES_ = $context["TOTAL_MATCHES"]; } else { $_TOTAL_MATCHES_ = null; }
            if (($_TOTAL_MATCHES_ > 0)) {
                // line 22
                echo "\t\t<div class=\"search-box\" role=\"search\">
\t\t\t<form method=\"post\" action=\"";
                // line 23
                if (isset($context["S_SEARCH_ACTION"])) { $_S_SEARCH_ACTION_ = $context["S_SEARCH_ACTION"]; } else { $_S_SEARCH_ACTION_ = null; }
                echo $_S_SEARCH_ACTION_;
                echo "\">
\t\t\t<fieldset>
\t\t\t\t<input class=\"inputbox search tiny\" type=\"search\" name=\"add_keywords\" id=\"add_keywords\" value=\"\" placeholder=\"";
                // line 25
                echo $this->env->getExtension('phpbb')->lang("SEARCH_IN_RESULTS");
                echo "\" />
\t\t\t\t<button class=\"button icon-button search-icon\" type=\"submit\" title=\"";
                // line 26
                echo $this->env->getExtension('phpbb')->lang("SEARCH");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH");
                echo "</button>
\t\t\t\t<a href=\"";
                // line 27
                if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
                echo $_U_SEARCH_;
                echo "\" class=\"button icon-button search-adv-icon\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
                echo "</a>
\t\t\t</fieldset>
\t\t\t</form>
\t\t</div>
\t";
            }
            // line 32
            echo "
\t\t";
            // line 33
            if (isset($context["search_results_searchbox_after"])) { $_search_results_searchbox_after_ = $context["search_results_searchbox_after"]; } else { $_search_results_searchbox_after_ = null; }
            // line 34
            echo "
\t\t<div class=\"pagination\">
\t\t\t";
            // line 36
            if (isset($context["SEARCH_MATCHES"])) { $_SEARCH_MATCHES_ = $context["SEARCH_MATCHES"]; } else { $_SEARCH_MATCHES_ = null; }
            echo $_SEARCH_MATCHES_;
            echo "
\t\t\t";
            // line 37
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array()))) {
                // line 38
                echo "\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "search_results.html", 38)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 39
                echo "\t\t\t";
            } else {
                // line 40
                echo "\t\t\t\t &bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t\t";
            }
            // line 42
            echo "\t\t</div>
\t</div>
";
        }
        // line 45
        echo "
";
        // line 46
        if (isset($context["S_SHOW_TOPICS"])) { $_S_SHOW_TOPICS_ = $context["S_SHOW_TOPICS"]; } else { $_S_SHOW_TOPICS_ = null; }
        if ($_S_SHOW_TOPICS_) {
            // line 47
            echo "
\t";
            // line 48
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "searchresults", array()))) {
                // line 49
                echo "\t<div class=\"forumbg\">

\t\t<div class=\"inner\">
\t\t<ul class=\"topiclist\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl class=\"icon\">
\t\t\t\t\t<dt><div class=\"list-inner\">";
                // line 55
                echo $this->env->getExtension('phpbb')->lang("TOPICS");
                echo "</div></dt>
\t\t\t\t\t<dd class=\"posts\">";
                // line 56
                echo $this->env->getExtension('phpbb')->lang("REPLIES");
                echo "</dd>
\t\t\t\t\t<dd class=\"views\">";
                // line 57
                echo $this->env->getExtension('phpbb')->lang("VIEWS");
                echo "</dd>
\t\t\t\t\t<dd class=\"lastpost\"><span>";
                // line 58
                echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                echo "</span></dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist topics\">

\t\t";
                // line 64
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "searchresults", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["searchresults"]) {
                    // line 65
                    echo "\t\t\t";
                    if (isset($context["search_results_topic_before"])) { $_search_results_topic_before_ = $context["search_results_topic_before"]; } else { $_search_results_topic_before_ = null; }
                    // line 66
                    echo "\t\t\t<li class=\"row";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if (($this->getAttribute($_searchresults_, "S_ROW_COUNT", array()) % 2 == 0)) {
                        echo " bg1";
                    } else {
                        echo " bg2";
                    }
                    echo "\">
\t\t\t\t<dl class=\"icon ";
                    // line 67
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_IMG_STYLE", array());
                    echo "\">
\t\t\t\t\t<dt ";
                    // line 68
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if ($this->getAttribute($_searchresults_, "TOPIC_ICON_IMG", array())) {
                        echo "style=\"background-image: url(";
                        if (isset($context["T_ICONS_PATH"])) { $_T_ICONS_PATH_ = $context["T_ICONS_PATH"]; } else { $_T_ICONS_PATH_ = null; }
                        echo $_T_ICONS_PATH_;
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "TOPIC_ICON_IMG", array());
                        echo "); background-repeat: no-repeat;\"";
                    }
                    echo " title=\"";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_FOLDER_IMG_ALT", array());
                    echo "\">
\t\t\t\t\t\t";
                    // line 69
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
                    if (($this->getAttribute($_searchresults_, "S_UNREAD_TOPIC", array()) &&  !$_S_IS_BOT_)) {
                        echo "<a href=\"";
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "U_NEWEST_POST", array());
                        echo "\" class=\"icon-link\"></a>";
                    }
                    // line 70
                    echo "\t\t\t\t\t\t<div class=\"list-inner\">

\t\t\t\t\t\t\t";
                    // line 72
                    if (isset($context["topiclist_row_prepend"])) { $_topiclist_row_prepend_ = $context["topiclist_row_prepend"]; } else { $_topiclist_row_prepend_ = null; }
                    // line 73
                    echo "\t\t\t\t\t\t\t";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
                    if (($this->getAttribute($_searchresults_, "S_UNREAD_TOPIC", array()) &&  !$_S_IS_BOT_)) {
                        echo "<a href=\"";
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "U_NEWEST_POST", array());
                        echo "\">";
                        if (isset($context["NEWEST_POST_IMG"])) { $_NEWEST_POST_IMG_ = $context["NEWEST_POST_IMG"]; } else { $_NEWEST_POST_IMG_ = null; }
                        echo $_NEWEST_POST_IMG_;
                        echo "</a> ";
                    }
                    // line 74
                    echo "\t\t\t\t\t\t\t<a href=\"";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "U_VIEW_TOPIC", array());
                    echo "\" class=\"topictitle\">";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_TITLE", array());
                    echo "</a> ";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "ATTACH_ICON_IMG", array());
                    echo "
\t\t\t\t\t\t\t";
                    // line 75
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if (($this->getAttribute($_searchresults_, "S_TOPIC_UNAPPROVED", array()) || $this->getAttribute($_searchresults_, "S_POSTS_UNAPPROVED", array()))) {
                        echo "<a href=\"";
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "U_MCP_QUEUE", array());
                        echo "\">";
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "UNAPPROVED_IMG", array());
                        echo "</a> ";
                    }
                    // line 76
                    echo "\t\t\t\t\t\t\t";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if ($this->getAttribute($_searchresults_, "S_TOPIC_DELETED", array())) {
                        echo "<a href=\"";
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "U_MCP_QUEUE", array());
                        echo "\">";
                        if (isset($context["DELETED_IMG"])) { $_DELETED_IMG_ = $context["DELETED_IMG"]; } else { $_DELETED_IMG_ = null; }
                        echo $_DELETED_IMG_;
                        echo "</a> ";
                    }
                    // line 77
                    echo "\t\t\t\t\t\t\t";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if ($this->getAttribute($_searchresults_, "S_TOPIC_REPORTED", array())) {
                        echo "<a href=\"";
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "U_MCP_REPORT", array());
                        echo "\">";
                        if (isset($context["REPORTED_IMG"])) { $_REPORTED_IMG_ = $context["REPORTED_IMG"]; } else { $_REPORTED_IMG_ = null; }
                        echo $_REPORTED_IMG_;
                        echo "</a>";
                    }
                    echo "<br />
\t\t\t\t\t\t\t";
                    // line 78
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if (twig_length_filter($this->env, $this->getAttribute($_searchresults_, "pagination", array()))) {
                        // line 79
                        echo "\t\t\t\t\t\t\t<div class=\"pagination\">
\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t";
                        // line 81
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_searchresults_, "pagination", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["pagination"]) {
                            // line 82
                            echo "\t\t\t\t\t\t\t\t\t";
                            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                            if ($this->getAttribute($_pagination_, "S_IS_PREV", array())) {
                                // line 83
                                echo "\t\t\t\t\t\t\t\t\t";
                            } elseif ($this->getAttribute($_pagination_, "S_IS_CURRENT", array())) {
                                echo "<li class=\"active\"><span>";
                                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                                echo $this->getAttribute($_pagination_, "PAGE_NUMBER", array());
                                echo "</span></li>
\t\t\t\t\t\t\t\t\t";
                            } elseif ($this->getAttribute($_pagination_, "S_IS_ELLIPSIS", array())) {
                                // line 84
                                echo "<li class=\"ellipsis\"><span>";
                                echo $this->env->getExtension('phpbb')->lang("ELLIPSIS");
                                echo "</span></li>
\t\t\t\t\t\t\t\t\t";
                            } elseif ($this->getAttribute($_pagination_, "S_IS_NEXT", array())) {
                                // line 86
                                echo "\t\t\t\t\t\t\t\t\t";
                            } else {
                                echo "<li><a href=\"";
                                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                                echo $this->getAttribute($_pagination_, "PAGE_URL", array());
                                echo "\">";
                                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                                echo $this->getAttribute($_pagination_, "PAGE_NUMBER", array());
                                echo "</a></li>
\t\t\t\t\t\t\t\t\t";
                            }
                            // line 88
                            echo "\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pagination'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 89
                        echo "\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                    }
                    // line 92
                    echo "\t\t\t\t\t\t\t";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    if ($this->getAttribute($_searchresults_, "S_HAS_POLL", array())) {
                        if (isset($context["POLL_IMG"])) { $_POLL_IMG_ = $context["POLL_IMG"]; } else { $_POLL_IMG_ = null; }
                        echo $_POLL_IMG_;
                        echo " ";
                    }
                    // line 93
                    echo "\t\t\t\t\t\t\t";
                    echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                    echo " ";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_AUTHOR_FULL", array());
                    echo " &raquo; ";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "FIRST_POST_TIME", array());
                    echo " &raquo; ";
                    echo $this->env->getExtension('phpbb')->lang("IN");
                    echo " <a href=\"";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "U_VIEW_FORUM", array());
                    echo "\">";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "FORUM_TITLE", array());
                    echo "</a>
\t\t\t\t\t\t\t";
                    // line 94
                    if (isset($context["topiclist_row_append"])) { $_topiclist_row_append_ = $context["topiclist_row_append"]; } else { $_topiclist_row_append_ = null; }
                    // line 95
                    echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</dt>
\t\t\t\t\t<dd class=\"posts\">";
                    // line 98
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_REPLIES", array());
                    echo "</dd>
\t\t\t\t\t<dd class=\"views\">";
                    // line 99
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_VIEWS", array());
                    echo "</dd>
\t\t\t\t\t<dd class=\"lastpost\"><span>
\t\t\t\t\t\t";
                    // line 101
                    echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                    echo " ";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "LAST_POST_AUTHOR_FULL", array());
                    echo "
\t\t\t\t\t\t";
                    // line 102
                    if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
                    if ( !$_S_IS_BOT_) {
                        echo "<a href=\"";
                        if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                        echo $this->getAttribute($_searchresults_, "U_LAST_POST", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("GOTO_LAST_POST");
                        echo "\">";
                        if (isset($context["LAST_POST_IMG"])) { $_LAST_POST_IMG_ = $context["LAST_POST_IMG"]; } else { $_LAST_POST_IMG_ = null; }
                        echo $_LAST_POST_IMG_;
                        echo "</a> ";
                    }
                    echo "<br />";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "LAST_POST_TIME", array());
                    echo "<br /> </span>
\t\t\t\t\t</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t\t";
                    // line 106
                    if (isset($context["search_results_topic_after"])) { $_search_results_topic_after_ = $context["search_results_topic_after"]; } else { $_search_results_topic_after_ = null; }
                    // line 107
                    echo "\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['searchresults'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 108
                echo "\t\t</ul>

\t\t</div>
\t</div>
\t";
            } else {
                // line 113
                echo "\t\t<div class=\"panel\">
\t\t\t<div class=\"inner\">
\t\t\t<strong>";
                // line 115
                echo $this->env->getExtension('phpbb')->lang("NO_SEARCH_RESULTS");
                echo "</strong>
\t\t\t</div>
\t\t</div>
\t";
            }
            // line 119
            echo "
";
        } else {
            // line 121
            echo "
\t";
            // line 122
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "searchresults", array()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["searchresults"]) {
                // line 123
                echo "\t\t";
                if (isset($context["search_results_post_before"])) { $_search_results_post_before_ = $context["search_results_post_before"]; } else { $_search_results_post_before_ = null; }
                // line 124
                echo "\t\t<div class=\"search post ";
                if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                if (($this->getAttribute($_searchresults_, "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                if ($this->getAttribute($_searchresults_, "S_POST_REPORTED", array())) {
                    echo " reported";
                }
                echo "\">
\t\t\t<div class=\"inner\">

\t";
                // line 127
                if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                if ($this->getAttribute($_searchresults_, "S_IGNORE_POST", array())) {
                    // line 128
                    echo "\t\t<div class=\"postbody\">
\t\t\t";
                    // line 129
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "L_IGNORE_POST", array());
                    echo "
\t\t</div>
\t";
                } else {
                    // line 132
                    echo "\t\t<dl class=\"postprofile\">
\t\t\t";
                    // line 133
                    if (isset($context["search_results_postprofile_before"])) { $_search_results_postprofile_before_ = $context["search_results_postprofile_before"]; } else { $_search_results_postprofile_before_ = null; }
                    // line 134
                    echo "\t\t\t<dt class=\"author\">";
                    echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                    echo " ";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "POST_AUTHOR_FULL", array());
                    echo "</dt>
\t\t\t<dd class=\"search-result-date\">";
                    // line 135
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "POST_DATE", array());
                    echo "</dd>
\t\t\t<dd>";
                    // line 136
                    echo $this->env->getExtension('phpbb')->lang("FORUM");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo " <a href=\"";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "U_VIEW_FORUM", array());
                    echo "\">";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "FORUM_TITLE", array());
                    echo "</a></dd>
\t\t\t<dd>";
                    // line 137
                    echo $this->env->getExtension('phpbb')->lang("TOPIC");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo " <a href=\"";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "U_VIEW_TOPIC", array());
                    echo "\">";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_TITLE", array());
                    echo "</a></dd>
\t\t\t<dd>";
                    // line 138
                    echo $this->env->getExtension('phpbb')->lang("REPLIES");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo " <strong>";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_REPLIES", array());
                    echo "</strong></dd>
\t\t\t<dd>";
                    // line 139
                    echo $this->env->getExtension('phpbb')->lang("VIEWS");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo " <strong>";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "TOPIC_VIEWS", array());
                    echo "</strong></dd>
\t\t\t";
                    // line 140
                    if (isset($context["search_results_postprofile_after"])) { $_search_results_postprofile_after_ = $context["search_results_postprofile_after"]; } else { $_search_results_postprofile_after_ = null; }
                    // line 141
                    echo "\t\t</dl>

\t\t<div class=\"postbody\">
\t\t\t<h3><a href=\"";
                    // line 144
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "U_VIEW_POST", array());
                    echo "\">";
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "POST_SUBJECT", array());
                    echo "</a></h3>
\t\t\t<div class=\"content\">";
                    // line 145
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "MESSAGE", array());
                    echo "</div>
\t\t</div>
\t";
                }
                // line 148
                echo "
\t";
                // line 149
                if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                if ( !$this->getAttribute($_searchresults_, "S_IGNORE_POST", array())) {
                    // line 150
                    echo "\t\t<ul class=\"searchresults\">
\t\t\t<li ><a href=\"";
                    // line 151
                    if (isset($context["searchresults"])) { $_searchresults_ = $context["searchresults"]; } else { $_searchresults_ = null; }
                    echo $this->getAttribute($_searchresults_, "U_VIEW_POST", array());
                    echo "\" class=\"arrow-";
                    if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
                    echo $_S_CONTENT_FLOW_END_;
                    echo "\">";
                    echo $this->env->getExtension('phpbb')->lang("JUMP_TO_POST");
                    echo "</a></li>
\t\t</ul>
\t";
                }
                // line 154
                echo "
\t\t\t</div>
\t\t</div>
\t\t";
                // line 157
                if (isset($context["search_results_post_after"])) { $_search_results_post_after_ = $context["search_results_post_after"]; } else { $_search_results_post_after_ = null; }
                // line 158
                echo "\t";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 159
                echo "\t\t<div class=\"panel\">
\t\t\t<div class=\"inner\">
\t\t\t<strong>";
                // line 161
                echo $this->env->getExtension('phpbb')->lang("NO_SEARCH_RESULTS");
                echo "</strong>
\t\t\t</div>
\t\t</div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['searchresults'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 166
        echo "
";
        // line 167
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
        if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
        if ((((twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array())) || twig_length_filter($this->env, $this->getAttribute($_loops_, "searchresults", array()))) || $_S_SELECT_SORT_KEY_) || $_S_SELECT_SORT_DAYS_)) {
            // line 168
            echo "\t<form method=\"post\" action=\"";
            if (isset($context["S_SEARCH_ACTION"])) { $_S_SEARCH_ACTION_ = $context["S_SEARCH_ACTION"]; } else { $_S_SEARCH_ACTION_ = null; }
            echo $_S_SEARCH_ACTION_;
            echo "\">

\t<fieldset class=\"display-options\">
\t\t";
            // line 171
            if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
            if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
            if (($_S_SELECT_SORT_DAYS_ || $_S_SELECT_SORT_KEY_)) {
                // line 172
                echo "\t\t\t<label>";
                if (isset($context["S_SHOW_TOPICS"])) { $_S_SHOW_TOPICS_ = $context["S_SHOW_TOPICS"]; } else { $_S_SHOW_TOPICS_ = null; }
                if ($_S_SHOW_TOPICS_) {
                    echo $this->env->getExtension('phpbb')->lang("DISPLAY_POSTS");
                } else {
                    echo $this->env->getExtension('phpbb')->lang("SORT_BY");
                    echo "</label><label>";
                }
                echo " ";
                if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
                echo $_S_SELECT_SORT_DAYS_;
                if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
                if ($_S_SELECT_SORT_KEY_) {
                    echo "</label> <label>";
                    if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
                    echo $_S_SELECT_SORT_KEY_;
                    echo "</label>
\t\t\t<label>";
                    // line 173
                    if (isset($context["S_SELECT_SORT_DIR"])) { $_S_SELECT_SORT_DIR_ = $context["S_SELECT_SORT_DIR"]; } else { $_S_SELECT_SORT_DIR_ = null; }
                    echo $_S_SELECT_SORT_DIR_;
                }
                echo "</label>
\t\t\t<input type=\"submit\" name=\"sort\" value=\"";
                // line 174
                echo $this->env->getExtension('phpbb')->lang("GO");
                echo "\" class=\"button2\" />
\t\t";
            }
            // line 176
            echo "\t</fieldset>

\t</form>

\t<hr />
";
        }
        // line 182
        echo "
";
        // line 183
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
        if (((twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array())) || twig_length_filter($this->env, $this->getAttribute($_loops_, "searchresults", array()))) || $_PAGE_NUMBER_)) {
            // line 184
            echo "<div class=\"action-bar bottom\">
\t<div class=\"pagination\">
\t\t";
            // line 186
            if (isset($context["SEARCH_MATCHES"])) { $_SEARCH_MATCHES_ = $context["SEARCH_MATCHES"]; } else { $_SEARCH_MATCHES_ = null; }
            echo $_SEARCH_MATCHES_;
            echo "
\t\t";
            // line 187
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array()))) {
                // line 188
                echo "\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "search_results.html", 188)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 189
                echo "\t\t";
            } else {
                // line 190
                echo "\t\t\t &bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t";
            }
            // line 192
            echo "\t</div>
</div>
";
        }
        // line 195
        echo "
";
        // line 196
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("jumpbox.html", "search_results.html", 196)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 197
        echo "
";
        // line 198
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "search_results.html", 198)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "search_results.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  823 => 198,  820 => 197,  808 => 196,  805 => 195,  800 => 192,  793 => 190,  790 => 189,  777 => 188,  774 => 187,  769 => 186,  765 => 184,  761 => 183,  758 => 182,  750 => 176,  745 => 174,  739 => 173,  720 => 172,  716 => 171,  708 => 168,  703 => 167,  700 => 166,  689 => 161,  685 => 159,  680 => 158,  678 => 157,  673 => 154,  661 => 151,  658 => 150,  655 => 149,  652 => 148,  645 => 145,  637 => 144,  632 => 141,  630 => 140,  622 => 139,  614 => 138,  603 => 137,  592 => 136,  587 => 135,  579 => 134,  577 => 133,  574 => 132,  567 => 129,  564 => 128,  561 => 127,  545 => 124,  542 => 123,  536 => 122,  533 => 121,  529 => 119,  522 => 115,  518 => 113,  511 => 108,  505 => 107,  503 => 106,  482 => 102,  475 => 101,  469 => 99,  464 => 98,  459 => 95,  457 => 94,  438 => 93,  430 => 92,  425 => 89,  419 => 88,  407 => 86,  401 => 84,  392 => 83,  388 => 82,  383 => 81,  379 => 79,  376 => 78,  362 => 77,  350 => 76,  339 => 75,  327 => 74,  314 => 73,  312 => 72,  308 => 70,  299 => 69,  284 => 68,  279 => 67,  269 => 66,  266 => 65,  261 => 64,  252 => 58,  248 => 57,  244 => 56,  240 => 55,  232 => 49,  229 => 48,  226 => 47,  223 => 46,  220 => 45,  215 => 42,  208 => 40,  205 => 39,  192 => 38,  189 => 37,  184 => 36,  180 => 34,  178 => 33,  175 => 32,  162 => 27,  156 => 26,  152 => 25,  146 => 23,  143 => 22,  140 => 21,  136 => 19,  130 => 18,  127 => 17,  125 => 16,  122 => 15,  108 => 13,  96 => 11,  93 => 10,  90 => 9,  83 => 8,  72 => 7,  61 => 6,  39 => 5,  36 => 4,  34 => 3,  31 => 2,  19 => 1,);
    }
}
