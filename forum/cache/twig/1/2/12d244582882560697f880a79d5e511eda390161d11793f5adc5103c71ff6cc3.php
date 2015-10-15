<?php

/* acp_logs.html */
class __TwigTemplate_12d244582882560697f880a79d5e511eda390161d11793f5adc5103c71ff6cc3 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_logs.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("TITLE");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb')->lang("EXPLAIN");
        echo "</p>

<form id=\"list\" method=\"post\" action=\"";
        // line 9
        if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
        echo $_U_ACTION_;
        echo "\">

<fieldset class=\"display-options search-box\">
\t";
        // line 12
        echo $this->env->getExtension('phpbb')->lang("SEARCH_KEYWORDS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " <input type=\"text\" name=\"keywords\" value=\"";
        if (isset($context["S_KEYWORDS"])) { $_S_KEYWORDS_ = $context["S_KEYWORDS"]; } else { $_S_KEYWORDS_ = null; }
        echo $_S_KEYWORDS_;
        echo "\" />&nbsp;<input type=\"submit\" class=\"button2\" name=\"filter\" value=\"";
        echo $this->env->getExtension('phpbb')->lang("SEARCH");
        echo "\" />
</fieldset>

";
        // line 15
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array()))) {
            // line 16
            echo "<div class=\"pagination top-pagination\">
\t";
            // line 17
            $location = "pagination.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("pagination.html", "acp_logs.html", 17)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 18
            echo "</div>
";
        }
        // line 20
        echo "
";
        // line 21
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "log", array()))) {
            // line 22
            echo "\t<table class=\"table1 zebra-table fixed-width-table\">
\t<thead>
\t<tr>
\t\t<th style=\"width: 15%;\">";
            // line 25
            echo $this->env->getExtension('phpbb')->lang("USERNAME");
            echo "</th>
\t\t<th style=\"width: 15%;\">";
            // line 26
            echo $this->env->getExtension('phpbb')->lang("IP");
            echo "</th>
\t\t<th style=\"width: 20%;\">";
            // line 27
            echo $this->env->getExtension('phpbb')->lang("TIME");
            echo "</th>
\t\t<th>";
            // line 28
            echo $this->env->getExtension('phpbb')->lang("ACTION");
            echo "</th>
\t\t";
            // line 29
            if (isset($context["S_CLEARLOGS"])) { $_S_CLEARLOGS_ = $context["S_CLEARLOGS"]; } else { $_S_CLEARLOGS_ = null; }
            if ($_S_CLEARLOGS_) {
                // line 30
                echo "\t\t\t<th style=\"width: 50px;\">";
                echo $this->env->getExtension('phpbb')->lang("MARK");
                echo "</th>
\t\t";
            }
            // line 32
            echo "\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 35
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "log", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 36
                echo "\t\t<tr>
\t\t\t<td>
\t\t\t\t";
                // line 38
                if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                echo $this->getAttribute($_log_, "USERNAME", array());
                echo "
\t\t\t\t";
                // line 39
                if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                if ($this->getAttribute($_log_, "REPORTEE_USERNAME", array())) {
                    // line 40
                    echo "\t\t\t\t<br />&raquo; ";
                    if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                    echo $this->getAttribute($_log_, "REPORTEE_USERNAME", array());
                    echo "
\t\t\t\t";
                }
                // line 42
                echo "\t\t\t</td>
\t\t\t<td style=\"text-align: center;\">";
                // line 43
                if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                echo $this->getAttribute($_log_, "IP", array());
                echo "</td>
\t\t\t<td style=\"text-align: center;\">";
                // line 44
                if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                echo $this->getAttribute($_log_, "DATE", array());
                echo "</td>
\t\t\t<td>";
                // line 45
                if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                echo $this->getAttribute($_log_, "ACTION", array());
                if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                if ($this->getAttribute($_log_, "DATA", array())) {
                    echo "<br /><span>";
                    if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                    echo $this->getAttribute($_log_, "DATA", array());
                    echo "</span>";
                }
                echo "</td>
\t\t\t";
                // line 46
                if (isset($context["S_CLEARLOGS"])) { $_S_CLEARLOGS_ = $context["S_CLEARLOGS"]; } else { $_S_CLEARLOGS_ = null; }
                if ($_S_CLEARLOGS_) {
                    // line 47
                    echo "\t\t\t\t<td style=\"text-align: center;\"><input type=\"checkbox\" class=\"radio\" name=\"mark[]\" value=\"";
                    if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                    echo $this->getAttribute($_log_, "ID", array());
                    echo "\" /></td>
\t\t\t";
                }
                // line 49
                echo "\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            echo "\t</tbody>
\t</table>

";
            // line 54
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array()))) {
                // line 55
                echo "\t<div class=\"pagination\">
\t\t";
                // line 56
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "acp_logs.html", 56)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 57
                echo "\t</div>
";
            }
            // line 59
            echo "
";
        } else {
            // line 61
            echo "\t<div class=\"errorbox\">
\t\t<p>";
            // line 62
            echo $this->env->getExtension('phpbb')->lang("NO_ENTRIES");
            echo "</p>
\t</div>
";
        }
        // line 65
        echo "
<fieldset class=\"display-options\">
\t";
        // line 67
        echo $this->env->getExtension('phpbb')->lang("DISPLAY_LOG");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " &nbsp;";
        if (isset($context["S_LIMIT_DAYS"])) { $_S_LIMIT_DAYS_ = $context["S_LIMIT_DAYS"]; } else { $_S_LIMIT_DAYS_ = null; }
        echo $_S_LIMIT_DAYS_;
        echo "&nbsp;";
        echo $this->env->getExtension('phpbb')->lang("SORT_BY");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " ";
        if (isset($context["S_SORT_KEY"])) { $_S_SORT_KEY_ = $context["S_SORT_KEY"]; } else { $_S_SORT_KEY_ = null; }
        echo $_S_SORT_KEY_;
        echo " ";
        if (isset($context["S_SORT_DIR"])) { $_S_SORT_DIR_ = $context["S_SORT_DIR"]; } else { $_S_SORT_DIR_ = null; }
        echo $_S_SORT_DIR_;
        echo "
\t<input class=\"button2\" type=\"submit\" value=\"";
        // line 68
        echo $this->env->getExtension('phpbb')->lang("GO");
        echo "\" name=\"sort\" />
\t";
        // line 69
        if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
        echo $_S_FORM_TOKEN_;
        echo "
</fieldset>
<hr />

";
        // line 73
        if (isset($context["S_SHOW_FORUMS"])) { $_S_SHOW_FORUMS_ = $context["S_SHOW_FORUMS"]; } else { $_S_SHOW_FORUMS_ = null; }
        if ($_S_SHOW_FORUMS_) {
            // line 74
            echo "\t<fieldset class=\"quick\">
\t\t";
            // line 75
            echo $this->env->getExtension('phpbb')->lang("SELECT_FORUM");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <select name=\"f\" onchange=\"if(this.options[this.selectedIndex].value != -1){ this.form.submit(); }\">";
            if (isset($context["S_FORUM_BOX"])) { $_S_FORUM_BOX_ = $context["S_FORUM_BOX"]; } else { $_S_FORUM_BOX_ = null; }
            echo $_S_FORUM_BOX_;
            echo "</select>
\t\t<input class=\"button2\" type=\"submit\" value=\"";
            // line 76
            echo $this->env->getExtension('phpbb')->lang("GO");
            echo "\" />
\t</fieldset>
";
        }
        // line 79
        echo "
";
        // line 80
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["S_CLEARLOGS"])) { $_S_CLEARLOGS_ = $context["S_CLEARLOGS"]; } else { $_S_CLEARLOGS_ = null; }
        if ((twig_length_filter($this->env, $this->getAttribute($_loops_, "log", array())) && $_S_CLEARLOGS_)) {
            // line 81
            echo "\t<fieldset class=\"quick\">
\t\t<input class=\"button2\" type=\"submit\" name=\"delall\" value=\"";
            // line 82
            echo $this->env->getExtension('phpbb')->lang("DELETE_ALL");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"submit\" name=\"delmarked\" value=\"";
            // line 83
            echo $this->env->getExtension('phpbb')->lang("DELETE_MARKED");
            echo "\" /><br />
\t\t<p class=\"small\"><a href=\"#\" onclick=\"marklist('list', 'mark', true); return false;\">";
            // line 84
            echo $this->env->getExtension('phpbb')->lang("MARK_ALL");
            echo "</a> &bull; <a href=\"#\" onclick=\"marklist('list', 'mark', false); return false;\">";
            echo $this->env->getExtension('phpbb')->lang("UNMARK_ALL");
            echo "</a></p>
\t</fieldset>
";
        }
        // line 87
        echo "
</form>

";
        // line 90
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_logs.html", 90)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_logs.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  318 => 90,  313 => 87,  305 => 84,  301 => 83,  297 => 82,  294 => 81,  290 => 80,  287 => 79,  281 => 76,  273 => 75,  270 => 74,  267 => 73,  259 => 69,  255 => 68,  238 => 67,  234 => 65,  228 => 62,  225 => 61,  221 => 59,  217 => 57,  205 => 56,  202 => 55,  199 => 54,  194 => 51,  187 => 49,  180 => 47,  177 => 46,  165 => 45,  160 => 44,  155 => 43,  152 => 42,  145 => 40,  142 => 39,  137 => 38,  133 => 36,  128 => 35,  123 => 32,  117 => 30,  114 => 29,  110 => 28,  106 => 27,  102 => 26,  98 => 25,  93 => 22,  90 => 21,  87 => 20,  83 => 18,  71 => 17,  68 => 16,  65 => 15,  53 => 12,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }
}
