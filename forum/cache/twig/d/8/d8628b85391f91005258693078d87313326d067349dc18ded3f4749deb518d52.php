<?php

/* search_body.html */
class __TwigTemplate_d8628b85391f91005258693078d87313326d067349dc18ded3f4749deb518d52 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "search_body.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2 class=\"solo\">";
        // line 3
        echo $this->env->getExtension('phpbb')->lang("SEARCH");
        echo "</h2>

";
        // line 5
        if (isset($context["search_body_form_before"])) { $_search_body_form_before_ = $context["search_body_form_before"]; } else { $_search_body_form_before_ = null; }
        // line 6
        echo "<form method=\"get\" action=\"";
        if (isset($context["S_SEARCH_ACTION"])) { $_S_SEARCH_ACTION_ = $context["S_SEARCH_ACTION"]; } else { $_S_SEARCH_ACTION_ = null; }
        echo $_S_SEARCH_ACTION_;
        echo "\" data-focus=\"keywords\">

<div class=\"panel\">
\t<div class=\"inner\">
\t<h3>";
        // line 10
        echo $this->env->getExtension('phpbb')->lang("SEARCH_QUERY");
        echo "</h3>

\t<fieldset>
\t<dl>
\t\t<dt><label for=\"keywords\">";
        // line 14
        echo $this->env->getExtension('phpbb')->lang("SEARCH_KEYWORDS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("SEARCH_KEYWORDS_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"search\" class=\"inputbox\" name=\"keywords\" id=\"keywords\" size=\"40\" title=\"";
        // line 15
        echo $this->env->getExtension('phpbb')->lang("SEARCH_KEYWORDS");
        echo "\" /></dd>
\t\t<dd><label for=\"terms1\"><input type=\"radio\" name=\"terms\" id=\"terms1\" value=\"all\" checked=\"checked\" /> ";
        // line 16
        echo $this->env->getExtension('phpbb')->lang("SEARCH_ALL_TERMS");
        echo "</label></dd>
\t\t<dd><label for=\"terms2\"><input type=\"radio\" name=\"terms\" id=\"terms2\" value=\"any\" /> ";
        // line 17
        echo $this->env->getExtension('phpbb')->lang("SEARCH_ANY_TERMS");
        echo "</label></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"author\">";
        // line 20
        echo $this->env->getExtension('phpbb')->lang("SEARCH_AUTHOR");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("SEARCH_AUTHOR_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"search\" class=\"inputbox\" name=\"author\" id=\"author\" size=\"40\" title=\"";
        // line 21
        echo $this->env->getExtension('phpbb')->lang("SEARCH_AUTHOR");
        echo "\" /></dd>
\t</dl>
\t</fieldset>

\t</div>
</div>

<div class=\"panel bg2\">
\t<div class=\"inner\">

\t<h3>";
        // line 31
        echo $this->env->getExtension('phpbb')->lang("SEARCH_OPTIONS");
        echo "</h3>

\t<fieldset>
\t<dl>
\t\t<dt><label for=\"search_forum\">";
        // line 35
        echo $this->env->getExtension('phpbb')->lang("SEARCH_FORUMS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("SEARCH_FORUMS_EXPLAIN");
        echo "</span></dt>
\t\t<dd><select name=\"fid[]\" id=\"search_forum\" multiple=\"multiple\" size=\"8\" title=\"";
        // line 36
        echo $this->env->getExtension('phpbb')->lang("SEARCH_FORUMS");
        echo "\">";
        if (isset($context["S_FORUM_OPTIONS"])) { $_S_FORUM_OPTIONS_ = $context["S_FORUM_OPTIONS"]; } else { $_S_FORUM_OPTIONS_ = null; }
        echo $_S_FORUM_OPTIONS_;
        echo "</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"search_child1\">";
        // line 39
        echo $this->env->getExtension('phpbb')->lang("SEARCH_SUBFORUMS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t<label for=\"search_child1\"><input type=\"radio\" name=\"sc\" id=\"search_child1\" value=\"1\" checked=\"checked\" /> ";
        // line 41
        echo $this->env->getExtension('phpbb')->lang("YES");
        echo "</label>
\t\t\t<label for=\"search_child2\"><input type=\"radio\" name=\"sc\" id=\"search_child2\" value=\"0\" /> ";
        // line 42
        echo $this->env->getExtension('phpbb')->lang("NO");
        echo "</label>
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"sf1\">";
        // line 46
        echo $this->env->getExtension('phpbb')->lang("SEARCH_WITHIN");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd><label for=\"sf1\"><input type=\"radio\" name=\"sf\" id=\"sf1\" value=\"all\" checked=\"checked\" /> ";
        // line 47
        echo $this->env->getExtension('phpbb')->lang("SEARCH_TITLE_MSG");
        echo "</label></dd>
\t\t<dd><label for=\"sf2\"><input type=\"radio\" name=\"sf\" id=\"sf2\" value=\"msgonly\" /> ";
        // line 48
        echo $this->env->getExtension('phpbb')->lang("SEARCH_MSG_ONLY");
        echo "</label></dd>
\t\t<dd><label for=\"sf3\"><input type=\"radio\" name=\"sf\" id=\"sf3\" value=\"titleonly\" /> ";
        // line 49
        echo $this->env->getExtension('phpbb')->lang("SEARCH_TITLE_ONLY");
        echo "</label></dd>
\t\t<dd><label for=\"sf4\"><input type=\"radio\" name=\"sf\" id=\"sf4\" value=\"firstpost\" /> ";
        // line 50
        echo $this->env->getExtension('phpbb')->lang("SEARCH_FIRST_POST");
        echo "</label></dd>
\t</dl>

\t<hr class=\"dashed\" />

\t<dl>
\t\t<dt><label for=\"show_results1\">";
        // line 56
        echo $this->env->getExtension('phpbb')->lang("DISPLAY_RESULTS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t<label for=\"show_results1\"><input type=\"radio\" name=\"sr\" id=\"show_results1\" value=\"posts\" checked=\"checked\" /> ";
        // line 58
        echo $this->env->getExtension('phpbb')->lang("POSTS");
        echo "</label>
\t\t\t<label for=\"show_results2\"><input type=\"radio\" name=\"sr\" id=\"show_results2\" value=\"topics\" /> ";
        // line 59
        echo $this->env->getExtension('phpbb')->lang("TOPICS");
        echo "</label>
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"sd\">";
        // line 63
        echo $this->env->getExtension('phpbb')->lang("RESULT_SORT");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd>";
        // line 64
        if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
        echo $_S_SELECT_SORT_KEY_;
        echo "&nbsp;
\t\t\t<label for=\"sa\"><input type=\"radio\" name=\"sd\" id=\"sa\" value=\"a\" /> ";
        // line 65
        echo $this->env->getExtension('phpbb')->lang("SORT_ASCENDING");
        echo "</label>
\t\t\t<label for=\"sd\"><input type=\"radio\" name=\"sd\" id=\"sd\" value=\"d\" checked=\"checked\" /> ";
        // line 66
        echo $this->env->getExtension('phpbb')->lang("SORT_DESCENDING");
        echo "</label>
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
        // line 70
        echo $this->env->getExtension('phpbb')->lang("RESULT_DAYS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd>";
        // line 71
        if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
        echo $_S_SELECT_SORT_DAYS_;
        echo "</dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
        // line 74
        echo $this->env->getExtension('phpbb')->lang("RETURN_FIRST");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd><select name=\"ch\" title=\"";
        // line 75
        echo $this->env->getExtension('phpbb')->lang("RETURN_FIRST");
        echo "\">";
        if (isset($context["S_CHARACTER_OPTIONS"])) { $_S_CHARACTER_OPTIONS_ = $context["S_CHARACTER_OPTIONS"]; } else { $_S_CHARACTER_OPTIONS_ = null; }
        echo $_S_CHARACTER_OPTIONS_;
        echo "</select> ";
        echo $this->env->getExtension('phpbb')->lang("POST_CHARACTERS");
        echo "</dd>
\t</dl>
\t</fieldset>

\t</div>
</div>

<div class=\"panel bg3\">
\t<div class=\"inner\">

\t<fieldset class=\"submit-buttons\">
\t\t";
        // line 86
        if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
        echo $_S_HIDDEN_FIELDS_;
        echo "<input type=\"reset\" value=\"";
        echo $this->env->getExtension('phpbb')->lang("RESET");
        echo "\" name=\"reset\" class=\"button2\" />&nbsp;
\t\t<input type=\"submit\" name=\"submit\" value=\"";
        // line 87
        echo $this->env->getExtension('phpbb')->lang("SEARCH");
        echo "\" class=\"button1\" />
\t</fieldset>

\t</div>
</div>

</form>

";
        // line 95
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "recentsearch", array()))) {
            // line 96
            echo "<div class=\"forumbg forumbg-table\">
\t<div class=\"inner\">

\t<table class=\"table1\">
\t<thead>
\t<tr>
\t\t<th colspan=\"2\" class=\"name\">";
            // line 102
            echo $this->env->getExtension('phpbb')->lang("RECENT_SEARCHES");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 106
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "recentsearch", array()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["recentsearch"]) {
                // line 107
                echo "\t\t<tr class=\"";
                if (isset($context["recentsearch"])) { $_recentsearch_ = $context["recentsearch"]; } else { $_recentsearch_ = null; }
                if (($this->getAttribute($_recentsearch_, "S_ROW_COUNT", array()) % 2 == 0)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                echo "\">
\t\t\t<td><a href=\"";
                // line 108
                if (isset($context["recentsearch"])) { $_recentsearch_ = $context["recentsearch"]; } else { $_recentsearch_ = null; }
                echo $this->getAttribute($_recentsearch_, "U_KEYWORDS", array());
                echo "\">";
                if (isset($context["recentsearch"])) { $_recentsearch_ = $context["recentsearch"]; } else { $_recentsearch_ = null; }
                echo $this->getAttribute($_recentsearch_, "KEYWORDS", array());
                echo "</a></td>
\t\t\t<td class=\"active\">";
                // line 109
                if (isset($context["recentsearch"])) { $_recentsearch_ = $context["recentsearch"]; } else { $_recentsearch_ = null; }
                echo $this->getAttribute($_recentsearch_, "TIME", array());
                echo "</td>
\t\t</tr>
\t";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 112
                echo "\t\t<tr class=\"bg1\">
\t\t\t<td colspan=\"2\">";
                // line 113
                echo $this->env->getExtension('phpbb')->lang("NO_RECENT_SEARCHES");
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recentsearch'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 116
            echo "\t</tbody>
\t</table>

\t</div>
</div>
";
        }
        // line 122
        echo "
";
        // line 123
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "search_body.html", 123)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "search_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  330 => 123,  327 => 122,  319 => 116,  310 => 113,  307 => 112,  298 => 109,  290 => 108,  280 => 107,  274 => 106,  267 => 102,  259 => 96,  256 => 95,  245 => 87,  238 => 86,  219 => 75,  214 => 74,  207 => 71,  202 => 70,  195 => 66,  191 => 65,  186 => 64,  181 => 63,  174 => 59,  170 => 58,  164 => 56,  155 => 50,  151 => 49,  147 => 48,  143 => 47,  138 => 46,  131 => 42,  127 => 41,  121 => 39,  112 => 36,  105 => 35,  98 => 31,  85 => 21,  78 => 20,  72 => 17,  68 => 16,  64 => 15,  57 => 14,  50 => 10,  41 => 6,  39 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }
}
