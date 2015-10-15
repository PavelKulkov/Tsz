<?php

/* acp_ext_list.html */
class __TwigTemplate_d90c72da4ff848814c2006da25e3538f12b82127dd2c025f9a57982e039c1a18 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_ext_list.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

\t<h1>";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("EXTENSIONS_ADMIN");
        echo "</h1>

\t<p>";
        // line 7
        echo $this->env->getExtension('phpbb')->lang("EXTENSIONS_EXPLAIN");
        echo "</p>

\t<fieldset class=\"quick\">
\t\t<span class=\"small\"><a href=\"https://www.phpbb.com/go/customise/extensions/3.1\" target=\"_blank\">";
        // line 10
        echo $this->env->getExtension('phpbb')->lang("BROWSE_EXTENSIONS_DATABASE");
        echo "</a> &bull; <a href=\"";
        if (isset($context["U_VERSIONCHECK_FORCE"])) { $_U_VERSIONCHECK_FORCE_ = $context["U_VERSIONCHECK_FORCE"]; } else { $_U_VERSIONCHECK_FORCE_ = null; }
        echo $_U_VERSIONCHECK_FORCE_;
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("VERSIONCHECK_FORCE_UPDATE_ALL");
        echo "</a> &bull; <a href=\"javascript:phpbb.toggleDisplay('version_check_settings');\">";
        echo $this->env->getExtension('phpbb')->lang("SETTINGS");
        echo "</a></span>
\t</fieldset>

\t<form id=\"version_check_settings\" method=\"post\" action=\"";
        // line 13
        if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
        echo $_U_ACTION_;
        echo "\" style=\"display:none\">

\t<fieldset>
\t\t<legend>";
        // line 16
        echo $this->env->getExtension('phpbb')->lang("EXTENSIONS_VERSION_CHECK_SETTINGS");
        echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"force_unstable\">";
        // line 18
        echo $this->env->getExtension('phpbb')->lang("FORCE_UNSTABLE");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t\t<dd>
\t\t\t\t<label><input type=\"radio\" id=\"force_unstable\" name=\"force_unstable\" class=\"radio\" value=\"1\"";
        // line 20
        if (isset($context["FORCE_UNSTABLE"])) { $_FORCE_UNSTABLE_ = $context["FORCE_UNSTABLE"]; } else { $_FORCE_UNSTABLE_ = null; }
        if ($_FORCE_UNSTABLE_) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("YES");
        echo "</label>
\t\t\t\t<label><input type=\"radio\" name=\"force_unstable\" class=\"radio\" value=\"0\"";
        // line 21
        if (isset($context["FORCE_UNSTABLE"])) { $_FORCE_UNSTABLE_ = $context["FORCE_UNSTABLE"]; } else { $_FORCE_UNSTABLE_ = null; }
        if ( !$_FORCE_UNSTABLE_) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("NO");
        echo "</label>
\t\t\t</dd>
\t\t</dl>

\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" name=\"update\" value=\"";
        // line 26
        echo $this->env->getExtension('phpbb')->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"reset\" name=\"reset\" value=\"";
        // line 27
        echo $this->env->getExtension('phpbb')->lang("RESET");
        echo "\" />
\t\t\t<input type=\"hidden\" name=\"action\" value=\"set_config_version_check_force_unstable\" />
\t\t\t";
        // line 29
        if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
        echo $_S_FORM_TOKEN_;
        echo "
\t\t</p>
\t</fieldset>
\t</form>

\t<table class=\"table1\">
\t\t<col class=\"row1\" ><col class=\"row1\" ><col class=\"row2\" ><col class=\"row2\" >
\t<thead>
\t\t<tr>
\t\t\t<th>";
        // line 38
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_NAME");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 20%;\">";
        // line 39
        echo $this->env->getExtension('phpbb')->lang("CURRENT_VERSION");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 10%;\">";
        // line 40
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_OPTIONS");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 25%;\">";
        // line 41
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_ACTIONS");
        echo "</th>
\t\t</tr>
\t</thead>
\t<tbody>
\t\t";
        // line 45
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "enabled", array()))) {
            // line 46
            echo "\t\t<tr>
\t\t\t<td class=\"row3\" colspan=\"4\"><strong>";
            // line 47
            echo $this->env->getExtension('phpbb')->lang("EXTENSIONS_ENABLED");
            echo "</strong></td>
\t\t</tr>
\t\t";
            // line 49
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "enabled", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["enabled"]) {
                // line 50
                echo "\t\t<tr class=\"ext_enabled\">
\t\t\t<td><strong>";
                // line 51
                if (isset($context["enabled"])) { $_enabled_ = $context["enabled"]; } else { $_enabled_ = null; }
                echo $this->getAttribute($_enabled_, "META_DISPLAY_NAME", array());
                echo "</strong></td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 53
                if (isset($context["enabled"])) { $_enabled_ = $context["enabled"]; } else { $_enabled_ = null; }
                if ($this->getAttribute($_enabled_, "S_VERSIONCHECK", array())) {
                    // line 54
                    echo "\t\t\t\t<strong ";
                    if (isset($context["enabled"])) { $_enabled_ = $context["enabled"]; } else { $_enabled_ = null; }
                    if ($this->getAttribute($_enabled_, "S_UP_TO_DATE", array())) {
                        echo "style=\"color: #228822;\"";
                    } else {
                        echo "style=\"color: #BC2A4D;\"";
                    }
                    echo ">";
                    if (isset($context["enabled"])) { $_enabled_ = $context["enabled"]; } else { $_enabled_ = null; }
                    echo $this->getAttribute($_enabled_, "META_VERSION", array());
                    echo "</strong>
\t\t\t\t";
                } else {
                    // line 56
                    echo "\t\t\t\t";
                    if (isset($context["enabled"])) { $_enabled_ = $context["enabled"]; } else { $_enabled_ = null; }
                    echo $this->getAttribute($_enabled_, "META_VERSION", array());
                    echo "
\t\t\t\t";
                }
                // line 58
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\"><a href=\"";
                // line 59
                if (isset($context["enabled"])) { $_enabled_ = $context["enabled"]; } else { $_enabled_ = null; }
                echo $this->getAttribute($_enabled_, "U_DETAILS", array());
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("DETAILS");
                echo "</a></td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 61
                if (isset($context["enabled"])) { $_enabled_ = $context["enabled"]; } else { $_enabled_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_enabled_, "actions", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
                    // line 62
                    echo "\t\t\t\t\t<a href=\"";
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    echo $this->getAttribute($_actions_, "U_ACTION", array());
                    echo "\"";
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    if ($this->getAttribute($_actions_, "L_ACTION_EXPLAIN", array())) {
                        echo " title=\"";
                        if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                        echo $this->getAttribute($_actions_, "L_ACTION_EXPLAIN", array());
                        echo "\"";
                    }
                    echo ">";
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    echo $this->getAttribute($_actions_, "L_ACTION", array());
                    echo "</a>
\t\t\t\t\t";
                    // line 63
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    if ( !$this->getAttribute($_actions_, "S_LAST_ROW", array())) {
                        echo "&nbsp;|&nbsp;";
                    }
                    // line 64
                    echo "\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 65
                echo "\t\t\t</td>
\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['enabled'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "\t\t";
        }
        // line 69
        echo "
\t\t";
        // line 70
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "disabled", array()))) {
            // line 71
            echo "\t\t<tr>
\t\t\t<td class=\"row3\" colspan=\"4\"><strong>";
            // line 72
            echo $this->env->getExtension('phpbb')->lang("EXTENSIONS_DISABLED");
            echo "</strong></td>
\t\t</tr>
\t\t";
            // line 74
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "disabled", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["disabled"]) {
                // line 75
                echo "\t\t<tr class=\"ext_disabled\">
\t\t\t<td><strong>";
                // line 76
                if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                echo $this->getAttribute($_disabled_, "META_DISPLAY_NAME", array());
                echo "</strong></td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 78
                if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                if ($this->getAttribute($_disabled_, "S_VERSIONCHECK", array())) {
                    // line 79
                    echo "\t\t\t\t<strong ";
                    if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                    if ($this->getAttribute($_disabled_, "S_UP_TO_DATE", array())) {
                        echo "style=\"color: #228822;\"";
                    } else {
                        echo "style=\"color: #BC2A4D;\"";
                    }
                    echo ">";
                    if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                    echo $this->getAttribute($_disabled_, "META_VERSION", array());
                    echo "</strong>
\t\t\t\t";
                } else {
                    // line 81
                    echo "\t\t\t\t";
                    if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                    echo $this->getAttribute($_disabled_, "META_VERSION", array());
                    echo "
\t\t\t\t";
                }
                // line 83
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 85
                if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                if ($this->getAttribute($_disabled_, "U_DETAILS", array())) {
                    echo "<a href=\"";
                    if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                    echo $this->getAttribute($_disabled_, "U_DETAILS", array());
                    echo "\">";
                    echo $this->env->getExtension('phpbb')->lang("DETAILS");
                    echo "</a>";
                }
                // line 86
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\">
\t\t\t\t";
                // line 88
                if (isset($context["disabled"])) { $_disabled_ = $context["disabled"]; } else { $_disabled_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_disabled_, "actions", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
                    // line 89
                    echo "\t\t\t\t\t<a href=\"";
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    echo $this->getAttribute($_actions_, "U_ACTION", array());
                    echo "\"";
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    if ($this->getAttribute($_actions_, "L_ACTION_EXPLAIN", array())) {
                        echo " title=\"";
                        if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                        echo $this->getAttribute($_actions_, "L_ACTION_EXPLAIN", array());
                        echo "\"";
                    }
                    echo ">";
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    echo $this->getAttribute($_actions_, "L_ACTION", array());
                    echo "</a>
\t\t\t\t\t";
                    // line 90
                    if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                    if ( !$this->getAttribute($_actions_, "S_LAST_ROW", array())) {
                        echo "&nbsp;|&nbsp;";
                    }
                    // line 91
                    echo "\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 92
                echo "\t\t\t</td>
\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['disabled'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 95
            echo "\t\t";
        }
        // line 96
        echo "\t</tbody>
\t</table>

\t<table class=\"table1\">
\t<tr>
\t\t<th>";
        // line 101
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_INSTALL_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 104
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_INSTALL_EXPLAIN");
        echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
        // line 107
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_UPDATE_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 110
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_UPDATE_EXPLAIN");
        echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
        // line 113
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_REMOVE_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 116
        echo $this->env->getExtension('phpbb')->lang("EXTENSION_REMOVE_EXPLAIN");
        echo "</td>
\t</tr>
\t</tbody>
\t</table>

";
        // line 121
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_ext_list.html", 121)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_ext_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  404 => 121,  396 => 116,  390 => 113,  384 => 110,  378 => 107,  372 => 104,  366 => 101,  359 => 96,  356 => 95,  348 => 92,  342 => 91,  337 => 90,  320 => 89,  315 => 88,  311 => 86,  301 => 85,  297 => 83,  290 => 81,  276 => 79,  273 => 78,  267 => 76,  264 => 75,  259 => 74,  254 => 72,  251 => 71,  248 => 70,  245 => 69,  242 => 68,  234 => 65,  228 => 64,  223 => 63,  206 => 62,  201 => 61,  193 => 59,  190 => 58,  183 => 56,  169 => 54,  166 => 53,  160 => 51,  157 => 50,  152 => 49,  147 => 47,  144 => 46,  141 => 45,  134 => 41,  130 => 40,  126 => 39,  122 => 38,  109 => 29,  104 => 27,  100 => 26,  87 => 21,  78 => 20,  72 => 18,  67 => 16,  60 => 13,  47 => 10,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }
}
