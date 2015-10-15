<?php

/* ucp_header.html */
class __TwigTemplate_120faf8dc217f46ad45c51fb150a1a0937f249654fb3ec0dcf2bc9fd55a40c7c extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "ucp_header.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2 class=\"ucp-title\">";
        // line 3
        echo $this->env->getExtension('phpbb')->lang("UCP");
        echo "</h2>

<div id=\"tabs\">
\t<ul>
\t\t";
        // line 7
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "t_block1", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["t_block1"]) {
            // line 8
            echo "\t\t<li class=\"tab";
            if (isset($context["t_block1"])) { $_t_block1_ = $context["t_block1"]; } else { $_t_block1_ = null; }
            if ($this->getAttribute($_t_block1_, "S_SELECTED", array())) {
                echo " activetab";
            }
            echo "\"><a href=\"";
            if (isset($context["t_block1"])) { $_t_block1_ = $context["t_block1"]; } else { $_t_block1_ = null; }
            echo $this->getAttribute($_t_block1_, "U_TITLE", array());
            echo "\">";
            if (isset($context["t_block1"])) { $_t_block1_ = $context["t_block1"]; } else { $_t_block1_ = null; }
            echo $this->getAttribute($_t_block1_, "L_TITLE", array());
            echo "</a></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t_block1'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "\t</ul>
</div>

";
        // line 13
        if (isset($context["S_COMPOSE_PM"])) { $_S_COMPOSE_PM_ = $context["S_COMPOSE_PM"]; } else { $_S_COMPOSE_PM_ = null; }
        if ($_S_COMPOSE_PM_) {
            // line 14
            echo "<form id=\"postform\" method=\"post\" action=\"";
            if (isset($context["S_POST_ACTION"])) { $_S_POST_ACTION_ = $context["S_POST_ACTION"]; } else { $_S_POST_ACTION_ = null; }
            echo $_S_POST_ACTION_;
            echo "\"";
            if (isset($context["S_FORM_ENCTYPE"])) { $_S_FORM_ENCTYPE_ = $context["S_FORM_ENCTYPE"]; } else { $_S_FORM_ENCTYPE_ = null; }
            echo $_S_FORM_ENCTYPE_;
            echo ">
";
        }
        // line 16
        echo "
<div class=\"panel bg3\">
\t<div class=\"inner\">

\t<div style=\"width: 100%;\">

\t<div id=\"cp-menu\">
\t\t<div id=\"navigation\" role=\"navigation\">

\t\t";
        // line 25
        if (isset($context["S_PRIVMSGS"])) { $_S_PRIVMSGS_ = $context["S_PRIVMSGS"]; } else { $_S_PRIVMSGS_ = null; }
        if ($_S_PRIVMSGS_) {
            // line 26
            echo "\t\t\t";
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "t_block2", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["t_block2"]) {
                // line 27
                echo "\t\t\t\t";
                if (isset($context["S_PRIVMSGS"])) { $_S_PRIVMSGS_ = $context["S_PRIVMSGS"]; } else { $_S_PRIVMSGS_ = null; }
                if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                if (($_S_PRIVMSGS_ &&  !$this->getAttribute($_t_block2_, "S_LAST_ROW", array()))) {
                    // line 28
                    echo "\t\t\t\t<ul>
\t\t\t\t\t";
                    // line 29
                    if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                    if ($this->getAttribute($_t_block2_, "S_SELECTED", array())) {
                        // line 30
                        echo "\t\t\t\t\t\t<li id=\"active-subsection\"><a href=\"";
                        if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                        echo $this->getAttribute($_t_block2_, "U_TITLE", array());
                        echo "\"><span>";
                        if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                        echo $this->getAttribute($_t_block2_, "L_TITLE", array());
                        echo "</span></a></li>
\t\t\t\t\t";
                    } else {
                        // line 32
                        echo "\t\t\t\t\t\t<li><a href=\"";
                        if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                        echo $this->getAttribute($_t_block2_, "U_TITLE", array());
                        echo "\"><span>";
                        if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                        echo $this->getAttribute($_t_block2_, "L_TITLE", array());
                        echo "</span></a></li>
\t\t\t\t\t";
                    }
                    // line 34
                    echo "\t\t\t\t</ul>
\t\t\t\t";
                }
                // line 36
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t_block2'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "
\t\t\t<hr />
\t\t\t";
            // line 39
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "folder", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["folder"]) {
                // line 40
                echo "\t\t\t\t";
                if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                if ($this->getAttribute($_folder_, "S_FIRST_ROW", array())) {
                    echo "<ul>";
                }
                // line 41
                echo "\t\t\t\t";
                if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                if ($this->getAttribute($_folder_, "S_CUR_FOLDER", array())) {
                    // line 42
                    echo "\t\t\t\t\t<li id=\"active-subsection\"><a href=\"";
                    if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                    echo $this->getAttribute($_folder_, "U_FOLDER", array());
                    echo "\">";
                    if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                    if (($this->getAttribute($_folder_, "UNREAD_MESSAGES", array()) > 0)) {
                        echo "<strong>";
                        if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                        echo $this->getAttribute($_folder_, "FOLDER_NAME", array());
                        echo " (";
                        if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                        echo $this->getAttribute($_folder_, "UNREAD_MESSAGES", array());
                        echo ")</strong>";
                    } else {
                        if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                        echo $this->getAttribute($_folder_, "FOLDER_NAME", array());
                    }
                    echo "</a></li>
\t\t\t\t";
                } else {
                    // line 44
                    echo "\t\t\t\t\t<li><a href=\"";
                    if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                    echo $this->getAttribute($_folder_, "U_FOLDER", array());
                    echo "\"><span>";
                    if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                    if (($this->getAttribute($_folder_, "UNREAD_MESSAGES", array()) > 0)) {
                        echo "<strong>";
                        if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                        echo $this->getAttribute($_folder_, "FOLDER_NAME", array());
                        echo " (";
                        if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                        echo $this->getAttribute($_folder_, "UNREAD_MESSAGES", array());
                        echo ")</strong>";
                    } else {
                        if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                        echo $this->getAttribute($_folder_, "FOLDER_NAME", array());
                    }
                    echo "</span></a></li>
\t\t\t\t";
                }
                // line 46
                echo "\t\t\t\t";
                if (isset($context["folder"])) { $_folder_ = $context["folder"]; } else { $_folder_ = null; }
                if ($this->getAttribute($_folder_, "S_LAST_ROW", array())) {
                    echo "</ul>";
                }
                // line 47
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['folder'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "\t\t\t<hr />
\t\t";
        }
        // line 50
        echo "
\t\t\t<ul>
\t\t";
        // line 52
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "t_block2", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["t_block2"]) {
            // line 53
            echo "\t\t\t";
            if (isset($context["S_PRIVMSGS"])) { $_S_PRIVMSGS_ = $context["S_PRIVMSGS"]; } else { $_S_PRIVMSGS_ = null; }
            if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
            if ((($_S_PRIVMSGS_ && $this->getAttribute($_t_block2_, "S_LAST_ROW", array())) ||  !$_S_PRIVMSGS_)) {
                // line 54
                echo "\t\t\t\t";
                if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                if ($this->getAttribute($_t_block2_, "S_SELECTED", array())) {
                    // line 55
                    echo "\t\t\t\t\t<li id=\"active-subsection\"><a href=\"";
                    if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                    echo $this->getAttribute($_t_block2_, "U_TITLE", array());
                    echo "\"><span>";
                    if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                    echo $this->getAttribute($_t_block2_, "L_TITLE", array());
                    echo "</span></a></li>
\t\t\t\t";
                } else {
                    // line 57
                    echo "\t\t\t\t\t<li><a href=\"";
                    if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                    echo $this->getAttribute($_t_block2_, "U_TITLE", array());
                    echo "\"><span>";
                    if (isset($context["t_block2"])) { $_t_block2_ = $context["t_block2"]; } else { $_t_block2_ = null; }
                    echo $this->getAttribute($_t_block2_, "L_TITLE", array());
                    echo "</span></a></li>
\t\t\t\t";
                }
                // line 59
                echo "\t\t\t";
            }
            // line 60
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t_block2'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "\t\t\t</ul>
\t\t</div>

\t\t";
        // line 64
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if ((twig_length_filter($this->env, $this->getAttribute($_loops_, "friends_online", array())) || twig_length_filter($this->env, $this->getAttribute($_loops_, "friends_offline", array())))) {
            // line 65
            echo "\t\t<div class=\"cp-mini\">
\t\t\t<div class=\"inner\">

\t\t\t<dl class=\"mini\">
\t\t\t\t<dt>";
            // line 69
            echo $this->env->getExtension('phpbb')->lang("FRIENDS");
            echo "</dt>

\t\t\t\t";
            // line 71
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "friends_online", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["friends_online"]) {
                // line 72
                echo "\t\t\t\t\t<dd class=\"friend-online\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FRIENDS_ONLINE");
                echo "\">";
                if (isset($context["friends_online"])) { $_friends_online_ = $context["friends_online"]; } else { $_friends_online_ = null; }
                echo $this->getAttribute($_friends_online_, "USERNAME_FULL", array());
                echo " ";
                if (isset($context["S_SHOW_PM_BOX"])) { $_S_SHOW_PM_BOX_ = $context["S_SHOW_PM_BOX"]; } else { $_S_SHOW_PM_BOX_ = null; }
                if ($_S_SHOW_PM_BOX_) {
                    echo " <input type=\"submit\" name=\"add_to[";
                    if (isset($context["friends_online"])) { $_friends_online_ = $context["friends_online"]; } else { $_friends_online_ = null; }
                    echo $this->getAttribute($_friends_online_, "USER_ID", array());
                    echo "]\" value=\"";
                    echo $this->env->getExtension('phpbb')->lang("ADD");
                    echo "\" class=\"button2\" />";
                }
                if (isset($context["friends_online"])) { $_friends_online_ = $context["friends_online"]; } else { $_friends_online_ = null; }
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                if (($this->getAttribute($_friends_online_, "S_LAST_ROW", array()) && twig_length_filter($this->env, $this->getAttribute($_loops_, "friends_offline", array())))) {
                    echo "<hr />";
                }
                echo "</dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['friends_online'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "
\t\t\t\t";
            // line 75
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "friends_offline", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["friends_offline"]) {
                // line 76
                echo "\t\t\t\t\t<dd class=\"friend-offline\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FRIENDS_OFFLINE");
                echo "\">";
                if (isset($context["friends_offline"])) { $_friends_offline_ = $context["friends_offline"]; } else { $_friends_offline_ = null; }
                echo $this->getAttribute($_friends_offline_, "USERNAME_FULL", array());
                echo " ";
                if (isset($context["S_SHOW_PM_BOX"])) { $_S_SHOW_PM_BOX_ = $context["S_SHOW_PM_BOX"]; } else { $_S_SHOW_PM_BOX_ = null; }
                if ($_S_SHOW_PM_BOX_) {
                    echo "<input type=\"submit\" name=\"add_to[";
                    if (isset($context["friends_offline"])) { $_friends_offline_ = $context["friends_offline"]; } else { $_friends_offline_ = null; }
                    echo $this->getAttribute($_friends_offline_, "USER_ID", array());
                    echo "]\" value=\"";
                    echo $this->env->getExtension('phpbb')->lang("ADD");
                    echo "\" class=\"button2\" />";
                }
                echo "</dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['friends_offline'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            echo "\t\t\t</dl>

\t\t\t</div>
\t\t</div>
\t\t";
        }
        // line 83
        echo "
\t\t";
        // line 84
        if (isset($context["S_SHOW_COLOUR_LEGEND"])) { $_S_SHOW_COLOUR_LEGEND_ = $context["S_SHOW_COLOUR_LEGEND"]; } else { $_S_SHOW_COLOUR_LEGEND_ = null; }
        if ($_S_SHOW_COLOUR_LEGEND_) {
            // line 85
            echo "\t\t<div class=\"cp-mini\">
\t\t\t<div class=\"inner\">

\t\t\t<dl class=\"mini\">
\t\t\t\t<dt>";
            // line 89
            echo $this->env->getExtension('phpbb')->lang("MESSAGE_COLOURS");
            echo "</dt>
\t\t\t\t";
            // line 90
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "pm_colour_info", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["pm_colour_info"]) {
                // line 91
                echo "\t\t\t\t\t<dd class=\"pm-legend";
                if (isset($context["pm_colour_info"])) { $_pm_colour_info_ = $context["pm_colour_info"]; } else { $_pm_colour_info_ = null; }
                if ($this->getAttribute($_pm_colour_info_, "CLASS", array())) {
                    echo " ";
                    if (isset($context["pm_colour_info"])) { $_pm_colour_info_ = $context["pm_colour_info"]; } else { $_pm_colour_info_ = null; }
                    echo $this->getAttribute($_pm_colour_info_, "CLASS", array());
                }
                echo "\">";
                if (isset($context["pm_colour_info"])) { $_pm_colour_info_ = $context["pm_colour_info"]; } else { $_pm_colour_info_ = null; }
                if ($this->getAttribute($_pm_colour_info_, "IMG", array())) {
                    if (isset($context["pm_colour_info"])) { $_pm_colour_info_ = $context["pm_colour_info"]; } else { $_pm_colour_info_ = null; }
                    echo $this->getAttribute($_pm_colour_info_, "IMG", array());
                    echo " ";
                }
                if (isset($context["pm_colour_info"])) { $_pm_colour_info_ = $context["pm_colour_info"]; } else { $_pm_colour_info_ = null; }
                echo $this->getAttribute($_pm_colour_info_, "LANG", array());
                echo "</dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pm_colour_info'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            echo "\t\t\t</dl>

\t\t\t</div>
\t\t</div>
\t\t";
        }
        // line 98
        echo "
\t</div>

\t<div id=\"cp-main\" class=\"ucp-main panel-container\">
";
    }

    public function getTemplateName()
    {
        return "ucp_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  406 => 98,  399 => 93,  376 => 91,  371 => 90,  367 => 89,  361 => 85,  358 => 84,  355 => 83,  348 => 78,  326 => 76,  321 => 75,  318 => 74,  291 => 72,  286 => 71,  281 => 69,  275 => 65,  272 => 64,  267 => 61,  261 => 60,  258 => 59,  248 => 57,  238 => 55,  234 => 54,  229 => 53,  224 => 52,  220 => 50,  216 => 48,  210 => 47,  204 => 46,  183 => 44,  162 => 42,  158 => 41,  152 => 40,  147 => 39,  143 => 37,  137 => 36,  133 => 34,  123 => 32,  113 => 30,  110 => 29,  107 => 28,  102 => 27,  96 => 26,  93 => 25,  82 => 16,  72 => 14,  69 => 13,  64 => 10,  46 => 8,  41 => 7,  34 => 3,  31 => 2,  19 => 1,);
    }
}
