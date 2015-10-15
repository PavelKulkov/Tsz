<?php

/* ucp_main_front.html */
class __TwigTemplate_5bdf47e0c89679ff5c33f475bab728fc35ec1ef324a94bfaf5399954fc82538a extends Twig_Template
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
        $location = "ucp_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_header.html", "ucp_main_front.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2>";
        // line 3
        echo $this->env->getExtension('phpbb')->lang("TITLE");
        echo "</h2>

<div class=\"panel\">
\t<div class=\"inner\">

\t<p>";
        // line 8
        echo $this->env->getExtension('phpbb')->lang("UCP_WELCOME");
        echo "</p>

";
        // line 10
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "topicrow", array()))) {
            // line 11
            echo "\t<h3>";
            echo $this->env->getExtension('phpbb')->lang("IMPORTANT_NEWS");
            echo "</h3>

\t<ul class=\"topiclist cplist two-long-columns\">
\t";
            // line 14
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "topicrow", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["topicrow"]) {
                // line 15
                echo "\t\t<li class=\"row";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if (($this->getAttribute($_topicrow_, "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl class=\"icon ";
                // line 16
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "TOPIC_IMG_STYLE", array());
                echo "\">
\t\t\t\t<dt ";
                // line 17
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if ($this->getAttribute($_topicrow_, "TOPIC_ICON_IMG", array())) {
                    echo "style=\"background-image: url(";
                    if (isset($context["T_ICONS_PATH"])) { $_T_ICONS_PATH_ = $context["T_ICONS_PATH"]; } else { $_T_ICONS_PATH_ = null; }
                    echo $_T_ICONS_PATH_;
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "TOPIC_ICON_IMG", array());
                    echo "); background-repeat: no-repeat;\"";
                }
                echo ">
\t\t\t\t\t";
                // line 18
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if ($this->getAttribute($_topicrow_, "S_UNREAD_TOPIC", array())) {
                    echo "<a href=\"";
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "U_NEWEST_POST", array());
                    echo "\" class=\"icon-link\"></a>";
                }
                // line 19
                echo "\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t";
                // line 20
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if ($this->getAttribute($_topicrow_, "S_UNREAD", array())) {
                    echo "<a href=\"";
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "U_NEWEST_POST", array());
                    echo "\">";
                    if (isset($context["NEWEST_POST_IMG"])) { $_NEWEST_POST_IMG_ = $context["NEWEST_POST_IMG"]; } else { $_NEWEST_POST_IMG_ = null; }
                    echo $_NEWEST_POST_IMG_;
                    echo "</a> ";
                }
                echo "<a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_VIEW_TOPIC", array());
                echo "\" class=\"topictitle\">";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "TOPIC_TITLE", array());
                echo "</a><br />
\t\t\t\t\t\t";
                // line 21
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if (twig_length_filter($this->env, $this->getAttribute($_topicrow_, "pagination", array()))) {
                    // line 22
                    echo "\t\t\t\t\t\t<div class=\"pagination\">
\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t";
                    // line 24
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($_topicrow_, "pagination", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["pagination"]) {
                        // line 25
                        echo "\t\t\t\t\t\t\t\t";
                        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                        if ($this->getAttribute($_pagination_, "S_IS_PREV", array())) {
                            // line 26
                            echo "\t\t\t\t\t\t\t\t";
                        } elseif ($this->getAttribute($_pagination_, "S_IS_CURRENT", array())) {
                            echo "<li class=\"active\"><span>";
                            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                            echo $this->getAttribute($_pagination_, "PAGE_NUMBER", array());
                            echo "</span></li>
\t\t\t\t\t\t\t\t";
                        } elseif ($this->getAttribute($_pagination_, "S_IS_ELLIPSIS", array())) {
                            // line 27
                            echo "<li class=\"ellipsis\"><span>";
                            echo $this->env->getExtension('phpbb')->lang("ELLIPSIS");
                            echo "</span></li>
\t\t\t\t\t\t\t\t";
                        } elseif ($this->getAttribute($_pagination_, "S_IS_NEXT", array())) {
                            // line 29
                            echo "\t\t\t\t\t\t\t\t";
                        } else {
                            echo "<li><a href=\"";
                            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                            echo $this->getAttribute($_pagination_, "PAGE_URL", array());
                            echo "\">";
                            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                            echo $this->getAttribute($_pagination_, "PAGE_NUMBER", array());
                            echo "</a></li>
\t\t\t\t\t\t\t\t";
                        }
                        // line 31
                        echo "\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pagination'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 32
                    echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                }
                // line 35
                echo "\t\t\t\t\t\t<div class=\"responsive-hide\">
\t\t\t\t\t\t\t";
                // line 36
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if ($this->getAttribute($_topicrow_, "ATTACH_ICON_IMG", array())) {
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "ATTACH_ICON_IMG", array());
                    echo " ";
                }
                // line 37
                echo "\t\t\t\t\t\t\t";
                echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                echo " ";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "TOPIC_AUTHOR_FULL", array());
                echo " &raquo; ";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "FIRST_POST_TIME", array());
                echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t";
                // line 40
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if ($this->getAttribute($_topicrow_, "ATTACH_ICON_IMG", array())) {
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "ATTACH_ICON_IMG", array());
                    echo " ";
                }
                // line 41
                echo "\t\t\t\t\t\t\t";
                echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                echo " ";
                echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                echo " ";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "LAST_POST_AUTHOR_FULL", array());
                echo " &laquo; <a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_LAST_POST", array());
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("GOTO_LAST_POST");
                echo "\">";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "LAST_POST_TIME", array());
                echo "</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"lastpost\"><span>";
                // line 45
                echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                echo " ";
                echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                echo " ";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "LAST_POST_AUTHOR_FULL", array());
                echo "
\t\t\t\t\t<a href=\"";
                // line 46
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_LAST_POST", array());
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("GOTO_LAST_POST");
                echo "\">";
                if (isset($context["LAST_POST_IMG"])) { $_LAST_POST_IMG_ = $context["LAST_POST_IMG"]; } else { $_LAST_POST_IMG_ = null; }
                echo $_LAST_POST_IMG_;
                echo "</a> <br />";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "LAST_POST_TIME", array());
                echo "</span>
\t\t\t\t</dd>
\t\t\t</dl>
\t\t</li>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topicrow'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            echo "\t</ul>
";
        }
        // line 53
        echo "
\t<h3>";
        // line 54
        echo $this->env->getExtension('phpbb')->lang("YOUR_DETAILS");
        echo "</h3>

";
        // line 56
        if (isset($context["ucp_main_front_user_activity_before"])) { $_ucp_main_front_user_activity_before_ = $context["ucp_main_front_user_activity_before"]; } else { $_ucp_main_front_user_activity_before_ = null; }
        // line 57
        echo "\t<dl class=\"details\">
\t\t<dt>";
        // line 58
        echo $this->env->getExtension('phpbb')->lang("JOINED");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</dt> <dd>";
        if (isset($context["JOINED"])) { $_JOINED_ = $context["JOINED"]; } else { $_JOINED_ = null; }
        echo $_JOINED_;
        echo "</dd>
\t\t<dt>";
        // line 59
        echo $this->env->getExtension('phpbb')->lang("LAST_ACTIVE");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</dt> <dd>";
        if (isset($context["LAST_VISIT_YOU"])) { $_LAST_VISIT_YOU_ = $context["LAST_VISIT_YOU"]; } else { $_LAST_VISIT_YOU_ = null; }
        echo $_LAST_VISIT_YOU_;
        echo "</dd>
\t\t<dt>";
        // line 60
        echo $this->env->getExtension('phpbb')->lang("TOTAL_POSTS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</dt> <dd>";
        if (isset($context["POSTS_PCT"])) { $_POSTS_PCT_ = $context["POSTS_PCT"]; } else { $_POSTS_PCT_ = null; }
        if ($_POSTS_PCT_) {
            if (isset($context["POSTS"])) { $_POSTS_ = $context["POSTS"]; } else { $_POSTS_ = null; }
            echo $_POSTS_;
            if (isset($context["S_DISPLAY_SEARCH"])) { $_S_DISPLAY_SEARCH_ = $context["S_DISPLAY_SEARCH"]; } else { $_S_DISPLAY_SEARCH_ = null; }
            if ($_S_DISPLAY_SEARCH_) {
                echo " | <strong><a href=\"";
                if (isset($context["U_SEARCH_USER"])) { $_U_SEARCH_USER_ = $context["U_SEARCH_USER"]; } else { $_U_SEARCH_USER_ = null; }
                echo $_U_SEARCH_USER_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_YOUR_POSTS");
                echo "</a></strong>";
            }
            echo "<br />(";
            if (isset($context["POSTS_DAY"])) { $_POSTS_DAY_ = $context["POSTS_DAY"]; } else { $_POSTS_DAY_ = null; }
            echo $_POSTS_DAY_;
            echo " / ";
            if (isset($context["POSTS_PCT"])) { $_POSTS_PCT_ = $context["POSTS_PCT"]; } else { $_POSTS_PCT_ = null; }
            echo $_POSTS_PCT_;
            echo ")";
        } else {
            if (isset($context["POSTS"])) { $_POSTS_ = $context["POSTS"]; } else { $_POSTS_ = null; }
            echo $_POSTS_;
        }
        echo "</dd>
\t\t";
        // line 61
        if (isset($context["ACTIVE_FORUM"])) { $_ACTIVE_FORUM_ = $context["ACTIVE_FORUM"]; } else { $_ACTIVE_FORUM_ = null; }
        if (($_ACTIVE_FORUM_ != "")) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb')->lang("ACTIVE_IN_FORUM");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</dt> <dd><strong><a href=\"";
            if (isset($context["U_ACTIVE_FORUM"])) { $_U_ACTIVE_FORUM_ = $context["U_ACTIVE_FORUM"]; } else { $_U_ACTIVE_FORUM_ = null; }
            echo $_U_ACTIVE_FORUM_;
            echo "\">";
            if (isset($context["ACTIVE_FORUM"])) { $_ACTIVE_FORUM_ = $context["ACTIVE_FORUM"]; } else { $_ACTIVE_FORUM_ = null; }
            echo $_ACTIVE_FORUM_;
            echo "</a></strong><br />(";
            if (isset($context["ACTIVE_FORUM_POSTS"])) { $_ACTIVE_FORUM_POSTS_ = $context["ACTIVE_FORUM_POSTS"]; } else { $_ACTIVE_FORUM_POSTS_ = null; }
            echo $_ACTIVE_FORUM_POSTS_;
            echo " / ";
            if (isset($context["ACTIVE_FORUM_PCT"])) { $_ACTIVE_FORUM_PCT_ = $context["ACTIVE_FORUM_PCT"]; } else { $_ACTIVE_FORUM_PCT_ = null; }
            echo $_ACTIVE_FORUM_PCT_;
            echo ")</dd>";
        }
        // line 62
        echo "\t\t";
        if (isset($context["ACTIVE_TOPIC"])) { $_ACTIVE_TOPIC_ = $context["ACTIVE_TOPIC"]; } else { $_ACTIVE_TOPIC_ = null; }
        if (($_ACTIVE_TOPIC_ != "")) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb')->lang("ACTIVE_IN_TOPIC");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</dt> <dd><strong><a href=\"";
            if (isset($context["U_ACTIVE_TOPIC"])) { $_U_ACTIVE_TOPIC_ = $context["U_ACTIVE_TOPIC"]; } else { $_U_ACTIVE_TOPIC_ = null; }
            echo $_U_ACTIVE_TOPIC_;
            echo "\">";
            if (isset($context["ACTIVE_TOPIC"])) { $_ACTIVE_TOPIC_ = $context["ACTIVE_TOPIC"]; } else { $_ACTIVE_TOPIC_ = null; }
            echo $_ACTIVE_TOPIC_;
            echo "</a></strong><br />(";
            if (isset($context["ACTIVE_TOPIC_POSTS"])) { $_ACTIVE_TOPIC_POSTS_ = $context["ACTIVE_TOPIC_POSTS"]; } else { $_ACTIVE_TOPIC_POSTS_ = null; }
            echo $_ACTIVE_TOPIC_POSTS_;
            echo " / ";
            if (isset($context["ACTIVE_TOPIC_PCT"])) { $_ACTIVE_TOPIC_PCT_ = $context["ACTIVE_TOPIC_PCT"]; } else { $_ACTIVE_TOPIC_PCT_ = null; }
            echo $_ACTIVE_TOPIC_PCT_;
            echo ")</dd>";
        }
        // line 63
        echo "\t\t";
        if (isset($context["WARNINGS"])) { $_WARNINGS_ = $context["WARNINGS"]; } else { $_WARNINGS_ = null; }
        if ($_WARNINGS_) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb')->lang("YOUR_WARNINGS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</dt> <dd class=\"error\">";
            if (isset($context["WARNING_IMG"])) { $_WARNING_IMG_ = $context["WARNING_IMG"]; } else { $_WARNING_IMG_ = null; }
            echo $_WARNING_IMG_;
            echo " [";
            if (isset($context["WARNINGS"])) { $_WARNINGS_ = $context["WARNINGS"]; } else { $_WARNINGS_ = null; }
            echo $_WARNINGS_;
            echo "]</dd>";
        }
        // line 64
        echo "\t</dl>
";
        // line 65
        if (isset($context["ucp_main_front_user_activity_after"])) { $_ucp_main_front_user_activity_after_ = $context["ucp_main_front_user_activity_after"]; } else { $_ucp_main_front_user_activity_after_ = null; }
        // line 66
        echo "
\t</div>
</div>

";
        // line 70
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_main_front.html", 70)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_main_front.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  383 => 70,  377 => 66,  375 => 65,  372 => 64,  357 => 63,  336 => 62,  316 => 61,  286 => 60,  278 => 59,  270 => 58,  267 => 57,  265 => 56,  260 => 54,  257 => 53,  253 => 51,  233 => 46,  224 => 45,  203 => 41,  196 => 40,  183 => 37,  176 => 36,  173 => 35,  168 => 32,  162 => 31,  150 => 29,  144 => 27,  135 => 26,  131 => 25,  126 => 24,  122 => 22,  119 => 21,  100 => 20,  97 => 19,  89 => 18,  77 => 17,  72 => 16,  62 => 15,  57 => 14,  50 => 11,  47 => 10,  42 => 8,  34 => 3,  31 => 2,  19 => 1,);
    }
}
