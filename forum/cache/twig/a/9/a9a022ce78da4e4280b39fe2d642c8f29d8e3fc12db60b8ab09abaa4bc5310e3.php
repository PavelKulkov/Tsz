<?php

/* acp_styles.html */
class __TwigTemplate_a9a022ce78da4e4280b39fe2d642c8f29d8e3fc12db60b8ab09abaa4bc5310e3 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_styles.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (isset($context["S_STYLE_DETAILS"])) { $_S_STYLE_DETAILS_ = $context["S_STYLE_DETAILS"]; } else { $_S_STYLE_DETAILS_ = null; }
        if ($_S_STYLE_DETAILS_) {
            // line 6
            echo "\t<a href=\"";
            if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
            echo $_U_ACTION_;
            echo "\" style=\"float: ";
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            echo ";\">&laquo; ";
            echo $this->env->getExtension('phpbb')->lang("BACK");
            echo "</a>
";
        }
        // line 8
        echo "
";
        // line 9
        if (isset($context["S_CONFIRM_ACTION"])) { $_S_CONFIRM_ACTION_ = $context["S_CONFIRM_ACTION"]; } else { $_S_CONFIRM_ACTION_ = null; }
        if ($_S_CONFIRM_ACTION_) {
            // line 10
            echo "<form id=\"confirm\" method=\"post\" action=\"";
            if (isset($context["S_CONFIRM_ACTION"])) { $_S_CONFIRM_ACTION_ = $context["S_CONFIRM_ACTION"]; } else { $_S_CONFIRM_ACTION_ = null; }
            echo $_S_CONFIRM_ACTION_;
            echo "\">

<fieldset>
\t<h1>";
            // line 13
            if (isset($context["MESSAGE_TITLE"])) { $_MESSAGE_TITLE_ = $context["MESSAGE_TITLE"]; } else { $_MESSAGE_TITLE_ = null; }
            echo $_MESSAGE_TITLE_;
            echo "</h1>
\t<p>";
            // line 14
            if (isset($context["MESSAGE_TEXT"])) { $_MESSAGE_TEXT_ = $context["MESSAGE_TEXT"]; } else { $_MESSAGE_TEXT_ = null; }
            echo $_MESSAGE_TEXT_;
            echo "</p>
\t";
            // line 15
            if (isset($context["S_CONFIRM_DELETE"])) { $_S_CONFIRM_DELETE_ = $context["S_CONFIRM_DELETE"]; } else { $_S_CONFIRM_DELETE_ = null; }
            if ($_S_CONFIRM_DELETE_) {
                // line 16
                echo "\t<label><input type=\"checkbox\" class=\"checkbox\" name=\"confirm_delete_files\" /> ";
                echo $this->env->getExtension('phpbb')->lang("DELETE_FROM_FS");
                echo "</label>
\t";
            }
            // line 18
            echo "
\t";
            // line 19
            if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
            echo $_S_HIDDEN_FIELDS_;
            echo "

\t<div style=\"text-align: center;\">
\t\t<input type=\"submit\" name=\"confirm\" value=\"";
            // line 22
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "\" class=\"button2\" />&nbsp;
\t\t<input type=\"submit\" name=\"cancel\" value=\"";
            // line 23
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "\" class=\"button2\" />
\t</div>

</fieldset>

</form>
";
        } else {
            // line 30
            echo "
";
            // line 31
            if (isset($context["L_TITLE"])) { $_L_TITLE_ = $context["L_TITLE"]; } else { $_L_TITLE_ = null; }
            if ($_L_TITLE_) {
                echo "<h1>";
                echo $this->env->getExtension('phpbb')->lang("TITLE");
                echo "</h1>";
            }
            // line 32
            echo "
";
            // line 33
            if (isset($context["L_EXPLAIN"])) { $_L_EXPLAIN_ = $context["L_EXPLAIN"]; } else { $_L_EXPLAIN_ = null; }
            if ($_L_EXPLAIN_) {
                echo "<p>";
                echo $this->env->getExtension('phpbb')->lang("EXPLAIN");
                echo "</p>";
            }
            // line 34
            echo "
<fieldset class=\"quick\">
\t<span class=\"small\"><a href=\"https://www.phpbb.com/go/customise/styles/3.1\" target=\"_blank\">";
            // line 36
            echo $this->env->getExtension('phpbb')->lang("BROWSE_STYLES_DATABASE");
            echo "</a></span>
</fieldset>

<form id=\"acp_styles\" method=\"post\" action=\"";
            // line 39
            if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
            echo $_U_ACTION_;
            echo "\">
";
            // line 40
            if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
            echo $_S_HIDDEN_FIELDS_;
            echo "
";
            // line 41
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "

";
            // line 43
            if (isset($context["S_STYLE_DETAILS"])) { $_S_STYLE_DETAILS_ = $context["S_STYLE_DETAILS"]; } else { $_S_STYLE_DETAILS_ = null; }
            if ($_S_STYLE_DETAILS_) {
                // line 44
                echo "\t<input type=\"hidden\" name=\"id\" value=\"";
                if (isset($context["STYLE_ID"])) { $_STYLE_ID_ = $context["STYLE_ID"]; } else { $_STYLE_ID_ = null; }
                echo $_STYLE_ID_;
                echo "\" />
\t<fieldset>
\t<dl>
\t\t<dt><label for=\"name\">";
                // line 47
                echo $this->env->getExtension('phpbb')->lang("STYLE_NAME");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t<dd><input type=\"text\" id=\"name\" name=\"style_name\" value=\"";
                // line 48
                if (isset($context["STYLE_NAME"])) { $_STYLE_NAME_ = $context["STYLE_NAME"]; } else { $_STYLE_NAME_ = null; }
                echo $_STYLE_NAME_;
                echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
                // line 51
                echo $this->env->getExtension('phpbb')->lang("STYLE_PATH");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t<dd><strong>";
                // line 52
                if (isset($context["STYLE_PATH"])) { $_STYLE_PATH_ = $context["STYLE_PATH"]; } else { $_STYLE_PATH_ = null; }
                echo $_STYLE_PATH_;
                echo "</strong></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"name\">";
                // line 55
                echo $this->env->getExtension('phpbb')->lang("COPYRIGHT");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t<dd><strong>";
                // line 56
                if (isset($context["STYLE_COPYRIGHT"])) { $_STYLE_COPYRIGHT_ = $context["STYLE_COPYRIGHT"]; } else { $_STYLE_COPYRIGHT_ = null; }
                echo $_STYLE_COPYRIGHT_;
                echo "</strong></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"style_parent\">";
                // line 59
                echo $this->env->getExtension('phpbb')->lang("INHERITING_FROM");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t<dd><select id=\"style_parent\" name=\"style_parent\">
\t\t\t<option value=\"\"";
                // line 61
                if (isset($context["STYLE_PARENT"])) { $_STYLE_PARENT_ = $context["STYLE_PARENT"]; } else { $_STYLE_PARENT_ = null; }
                if (($_STYLE_PARENT_ == 0)) {
                    echo " selected=\"selected\"";
                }
                echo "> - </option>
\t\t\t";
                // line 62
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "parent_styles", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["parent_styles"]) {
                    // line 63
                    echo "\t\t\t\t<option value=\"";
                    if (isset($context["parent_styles"])) { $_parent_styles_ = $context["parent_styles"]; } else { $_parent_styles_ = null; }
                    echo $this->getAttribute($_parent_styles_, "STYLE_ID", array());
                    echo "\"";
                    if (isset($context["parent_styles"])) { $_parent_styles_ = $context["parent_styles"]; } else { $_parent_styles_ = null; }
                    if (isset($context["STYLE_PARENT"])) { $_STYLE_PARENT_ = $context["STYLE_PARENT"]; } else { $_STYLE_PARENT_ = null; }
                    if (($this->getAttribute($_parent_styles_, "STYLE_ID", array()) == $_STYLE_PARENT_)) {
                        echo " selected=\"selected\"";
                    }
                    echo ">";
                    if (isset($context["parent_styles"])) { $_parent_styles_ = $context["parent_styles"]; } else { $_parent_styles_ = null; }
                    echo $this->getAttribute($_parent_styles_, "SPACER", array());
                    if (isset($context["parent_styles"])) { $_parent_styles_ = $context["parent_styles"]; } else { $_parent_styles_ = null; }
                    echo $this->getAttribute($_parent_styles_, "STYLE_NAME", array());
                    echo "</option>
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parent_styles'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 65
                echo "\t\t</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"style_active\">";
                // line 68
                echo $this->env->getExtension('phpbb')->lang("STYLE_ACTIVE");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"style_active\" value=\"1\"";
                // line 69
                if (isset($context["S_STYLE_ACTIVE"])) { $_S_STYLE_ACTIVE_ = $context["S_STYLE_ACTIVE"]; } else { $_S_STYLE_ACTIVE_ = null; }
                if ($_S_STYLE_ACTIVE_) {
                    echo " id=\"style_active\" checked=\"checked\"";
                }
                echo " /> ";
                echo $this->env->getExtension('phpbb')->lang("YES");
                echo "</label>
\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"style_active\" value=\"0\"";
                // line 70
                if (isset($context["S_STYLE_ACTIVE"])) { $_S_STYLE_ACTIVE_ = $context["S_STYLE_ACTIVE"]; } else { $_S_STYLE_ACTIVE_ = null; }
                if ( !$_S_STYLE_ACTIVE_) {
                    echo " id=\"style_active\" checked=\"checked\"";
                }
                echo " /> ";
                echo $this->env->getExtension('phpbb')->lang("NO");
                echo "</label></dd>
\t</dl>
\t";
                // line 72
                if (isset($context["S_STYLE_DEFAULT"])) { $_S_STYLE_DEFAULT_ = $context["S_STYLE_DEFAULT"]; } else { $_S_STYLE_DEFAULT_ = null; }
                if ( !$_S_STYLE_DEFAULT_) {
                    // line 73
                    echo "\t\t<dl>
\t\t\t<dt><label for=\"style_default\">";
                    // line 74
                    echo $this->env->getExtension('phpbb')->lang("STYLE_DEFAULT");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"style_default\" value=\"1\" /> ";
                    // line 75
                    echo $this->env->getExtension('phpbb')->lang("YES");
                    echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" id=\"style_default\" name=\"style_default\" value=\"0\" checked=\"checked\" /> ";
                    // line 76
                    echo $this->env->getExtension('phpbb')->lang("NO");
                    echo "</label></dd>
\t\t</dl>
\t";
                }
                // line 79
                echo "\t</fieldset>

\t<fieldset class=\"submit-buttons\">
\t\t<legend>";
                // line 82
                echo $this->env->getExtension('phpbb')->lang("SUBMIT");
                echo "</legend>
\t\t<input class=\"button1\" type=\"submit\" name=\"update\" value=\"";
                // line 83
                echo $this->env->getExtension('phpbb')->lang("SUBMIT");
                echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
                // line 84
                echo $this->env->getExtension('phpbb')->lang("RESET");
                echo "\" />
\t\t";
                // line 85
                if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
                echo $_S_FORM_TOKEN_;
                echo "
\t</fieldset>
";
            }
            // line 88
            echo "
";
            // line 89
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "styles_list", array()))) {
                // line 90
                echo "\t<table class=\"table1 styles\">
\t<thead>
\t<tr>
\t\t<th>";
                // line 93
                echo $this->env->getExtension('phpbb')->lang("STYLE_NAME");
                echo "</th>
\t\t";
                // line 94
                if (isset($context["STYLES_LIST_HIDE_COUNT"])) { $_STYLES_LIST_HIDE_COUNT_ = $context["STYLES_LIST_HIDE_COUNT"]; } else { $_STYLES_LIST_HIDE_COUNT_ = null; }
                if ( !$_STYLES_LIST_HIDE_COUNT_) {
                    echo "<th width=\"10%\" style=\"white-space: nowrap; text-align: center;\">";
                    echo $this->env->getExtension('phpbb')->lang("STYLE_USED_BY");
                    echo "</th>";
                }
                // line 95
                echo "\t\t<th width=\"25%\" style=\"white-space: nowrap; text-align: center;\">";
                echo $this->env->getExtension('phpbb')->lang("ACTIONS");
                echo "</th>
\t\t";
                // line 96
                if (isset($context["STYLES_LIST_EXTRA"])) { $_STYLES_LIST_EXTRA_ = $context["STYLES_LIST_EXTRA"]; } else { $_STYLES_LIST_EXTRA_ = null; }
                echo $_STYLES_LIST_EXTRA_;
                echo "
\t\t<th>&nbsp;</th>
\t</tr>
\t</thead>
\t";
                // line 100
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "styles_list", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["styles_list"]) {
                    // line 101
                    echo "\t<tbody id=\"styles-list-";
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    echo $this->getAttribute($_styles_list_, "S_ROW_COUNT", array());
                    echo "\">
\t<tr";
                    // line 102
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    if (($this->getAttribute($_styles_list_, "STYLE_ID", array()) &&  !$this->getAttribute($_styles_list_, "STYLE_ACTIVE", array()))) {
                        echo " class=\"row-inactive\"";
                    }
                    echo ">
\t\t";
                    // line 103
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    if (($this->getAttribute($_styles_list_, "LEVEL", array()) % 2 == 1)) {
                        // line 104
                        echo "\t\t\t";
                        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                        if (($this->getAttribute($_definition_, "ROW_CLASS", array()) == "row1a")) {
                            if (isset($context["ROW_CLASS"])) { $_ROW_CLASS_ = $context["ROW_CLASS"]; } else { $_ROW_CLASS_ = null; }
                            $value = "row1b";
                            $context['definition']->set('ROW_CLASS', $value);
                        } else {
                            if (isset($context["ROW_CLASS"])) { $_ROW_CLASS_ = $context["ROW_CLASS"]; } else { $_ROW_CLASS_ = null; }
                            $value = "row1a";
                            $context['definition']->set('ROW_CLASS', $value);
                        }
                        // line 105
                        echo "\t\t";
                    } else {
                        // line 106
                        echo "\t\t\t";
                        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                        if (($this->getAttribute($_definition_, "ROW_CLASS", array()) == "row2a")) {
                            if (isset($context["ROW_CLASS"])) { $_ROW_CLASS_ = $context["ROW_CLASS"]; } else { $_ROW_CLASS_ = null; }
                            $value = "row2b";
                            $context['definition']->set('ROW_CLASS', $value);
                        } else {
                            if (isset($context["ROW_CLASS"])) { $_ROW_CLASS_ = $context["ROW_CLASS"]; } else { $_ROW_CLASS_ = null; }
                            $value = "row2a";
                            $context['definition']->set('ROW_CLASS', $value);
                        }
                        // line 107
                        echo "\t\t";
                    }
                    // line 108
                    echo "\t\t<td class=\"";
                    if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                    echo $this->getAttribute($_definition_, "ROW_CLASS", array());
                    echo "\" style=\"padding-";
                    if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
                    echo $_S_CONTENT_FLOW_BEGIN_;
                    echo ": ";
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    echo $this->getAttribute($_styles_list_, "PADDING", array());
                    echo "px;\">
\t\t\t";
                    // line 109
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    if ((($this->getAttribute($_styles_list_, "STYLE_ID", array()) && ($this->getAttribute($_styles_list_, "COMMENT", array()) == "")) && $this->getAttribute($_styles_list_, "STYLE_ACTIVE", array()))) {
                        // line 110
                        echo "\t\t\t\t<div class=\"default-style\" style=\"display: none; float: ";
                        if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
                        echo $_S_CONTENT_FLOW_END_;
                        echo ";\">
\t\t\t\t\t<input class=\"radio\" type=\"radio\" name=\"default\" value=\"";
                        // line 111
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        echo $this->getAttribute($_styles_list_, "STYLE_ID", array());
                        echo "\"";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        if ($this->getAttribute($_styles_list_, "DEFAULT", array())) {
                            echo " checked=\"checked\"";
                        } else {
                            if (isset($context["S_DEFAULT"])) { $_S_DEFAULT_ = $context["S_DEFAULT"]; } else { $_S_DEFAULT_ = null; }
                            $value = 1;
                            $context['definition']->set('S_DEFAULT', $value);
                        }
                        echo " title=\"";
                        echo $this->env->getExtension('phpbb')->lang("STYLE_DEFAULT");
                        echo "\" />
\t\t\t\t</div>
\t\t\t";
                    }
                    // line 114
                    echo "\t\t\t";
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    if (($this->getAttribute($_styles_list_, "DEFAULT", array()) || $this->getAttribute($_styles_list_, "SHOW_COPYRIGHT", array()))) {
                        // line 115
                        echo "\t\t\t\t<strong>";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        echo $this->getAttribute($_styles_list_, "STYLE_NAME", array());
                        echo "</strong>
\t\t\t\t";
                        // line 116
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        if (($this->getAttribute($_styles_list_, "SHOW_COPYRIGHT", array()) && ($this->getAttribute($_styles_list_, "COMMENT", array()) == ""))) {
                            echo "<span><br />";
                            if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                            echo $this->getAttribute($_styles_list_, "STYLE_COPYRIGHT", array());
                            echo "</span>";
                        }
                        // line 117
                        echo "\t\t\t";
                    } else {
                        // line 118
                        echo "\t\t\t\t<span>";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        echo $this->getAttribute($_styles_list_, "STYLE_NAME", array());
                        echo "</span>
\t\t\t";
                    }
                    // line 120
                    echo "\t\t\t";
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    if (($this->getAttribute($_styles_list_, "COMMENT", array()) != "")) {
                        // line 121
                        echo "\t\t\t\t<span class=\"error\"><br />";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        echo $this->getAttribute($_styles_list_, "COMMENT", array());
                        echo "</span>
\t\t\t";
                    }
                    // line 123
                    echo "\t\t\t";
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    if (( !$this->getAttribute($_styles_list_, "STYLE_ID", array()) && ($this->getAttribute($_styles_list_, "COMMENT", array()) == ""))) {
                        // line 124
                        echo "\t\t\t\t<span class=\"style-path\"><br />";
                        echo $this->env->getExtension('phpbb')->lang("STYLE_PATH");
                        echo $this->env->getExtension('phpbb')->lang("COLON");
                        echo " ";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        echo $this->getAttribute($_styles_list_, "STYLE_PATH_FULL", array());
                        echo "</span>
\t\t\t";
                    }
                    // line 126
                    echo "\t\t</td>
\t\t";
                    // line 127
                    if (isset($context["STYLES_LIST_HIDE_COUNT"])) { $_STYLES_LIST_HIDE_COUNT_ = $context["STYLES_LIST_HIDE_COUNT"]; } else { $_STYLES_LIST_HIDE_COUNT_ = null; }
                    if ( !$_STYLES_LIST_HIDE_COUNT_) {
                        // line 128
                        echo "\t\t\t<td class=\"";
                        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                        echo $this->getAttribute($_definition_, "ROW_CLASS", array());
                        echo " users\">";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        echo $this->getAttribute($_styles_list_, "USERS", array());
                        echo "</td>
\t\t";
                    }
                    // line 130
                    echo "\t\t<td class=\"";
                    if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                    echo $this->getAttribute($_definition_, "ROW_CLASS", array());
                    echo " actions\">
\t\t\t";
                    // line 131
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($_styles_list_, "actions", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
                        // line 132
                        echo "\t\t\t\t";
                        if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                        if (($this->getAttribute($_actions_, "S_ROW_COUNT", array()) > 0)) {
                            echo " | ";
                        }
                        // line 133
                        echo "\t\t\t\t";
                        if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                        if ($this->getAttribute($_actions_, "U_ACTION", array())) {
                            // line 134
                            echo "\t\t\t\t\t<a href=\"";
                            if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                            echo $this->getAttribute($_actions_, "U_ACTION", array());
                            echo "\"";
                            if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                            echo $this->getAttribute($_actions_, "U_ACTION_ATTR", array());
                            echo ">";
                            if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                            echo $this->getAttribute($_actions_, "L_ACTION", array());
                            echo "</a>
\t\t\t\t";
                        }
                        // line 136
                        echo "\t\t\t\t";
                        if (isset($context["actions"])) { $_actions_ = $context["actions"]; } else { $_actions_ = null; }
                        echo $this->getAttribute($_actions_, "HTML", array());
                        echo "
\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 138
                    echo "\t\t</td>
\t\t";
                    // line 139
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    echo $this->getAttribute($_styles_list_, "EXTRA", array());
                    echo "
\t\t<td class=\"";
                    // line 140
                    if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                    echo $this->getAttribute($_definition_, "ROW_CLASS", array());
                    echo " mark\" width=\"20\">
\t\t\t";
                    // line 141
                    if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                    if ($this->getAttribute($_styles_list_, "STYLE_ID", array())) {
                        // line 142
                        echo "\t\t\t\t<input class=\"checkbox\" type=\"checkbox\" name=\"ids[]\" value=\"";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        echo $this->getAttribute($_styles_list_, "STYLE_ID", array());
                        echo "\" />
\t\t\t";
                    } else {
                        // line 144
                        echo "\t\t\t\t";
                        if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                        if (($this->getAttribute($_styles_list_, "COMMENT", array()) != "")) {
                            // line 145
                            echo "\t\t\t\t\t&nbsp;
\t\t\t\t";
                        } else {
                            // line 147
                            echo "\t\t\t\t\t<input class=\"checkbox\" type=\"checkbox\" name=\"dirs[]\" value=\"";
                            if (isset($context["styles_list"])) { $_styles_list_ = $context["styles_list"]; } else { $_styles_list_ = null; }
                            echo $this->getAttribute($_styles_list_, "STYLE_PATH", array());
                            echo "\" />
\t\t\t\t";
                        }
                        // line 149
                        echo "\t\t\t";
                    }
                    // line 150
                    echo "\t\t</td>
\t</tr>
\t</tbody>
\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['styles_list'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 154
                echo "\t</table>
";
            }
            // line 156
            echo "
";
            // line 157
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "extra_actions", array()))) {
                // line 158
                echo "\t<fieldset class=\"quick\">
\t\t";
                // line 159
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "extra_actions", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["extra_actions"]) {
                    // line 160
                    echo "\t\t\t<input type=\"submit\" name=\"";
                    if (isset($context["extra_actions"])) { $_extra_actions_ = $context["extra_actions"]; } else { $_extra_actions_ = null; }
                    echo $this->getAttribute($_extra_actions_, "ACTION_NAME", array());
                    echo "\" class=\"button2\" value=\"";
                    if (isset($context["extra_actions"])) { $_extra_actions_ = $context["extra_actions"]; } else { $_extra_actions_ = null; }
                    echo $this->getAttribute($_extra_actions_, "L_ACTION", array());
                    echo "\" />
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extra_actions'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 162
                echo "\t</fieldset>
";
            }
            // line 164
            echo "
</form>

";
        }
        // line 168
        echo "
";
        // line 169
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_styles.html", 169)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_styles.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  646 => 169,  643 => 168,  637 => 164,  633 => 162,  620 => 160,  615 => 159,  612 => 158,  609 => 157,  606 => 156,  602 => 154,  593 => 150,  590 => 149,  583 => 147,  579 => 145,  575 => 144,  568 => 142,  565 => 141,  560 => 140,  555 => 139,  552 => 138,  542 => 136,  529 => 134,  525 => 133,  519 => 132,  514 => 131,  508 => 130,  498 => 128,  495 => 127,  492 => 126,  482 => 124,  478 => 123,  471 => 121,  467 => 120,  460 => 118,  457 => 117,  449 => 116,  443 => 115,  439 => 114,  421 => 111,  415 => 110,  412 => 109,  400 => 108,  397 => 107,  385 => 106,  382 => 105,  370 => 104,  367 => 103,  360 => 102,  354 => 101,  349 => 100,  341 => 96,  336 => 95,  329 => 94,  325 => 93,  320 => 90,  317 => 89,  314 => 88,  307 => 85,  303 => 84,  299 => 83,  295 => 82,  290 => 79,  284 => 76,  280 => 75,  275 => 74,  272 => 73,  269 => 72,  259 => 70,  250 => 69,  245 => 68,  240 => 65,  219 => 63,  214 => 62,  207 => 61,  201 => 59,  194 => 56,  189 => 55,  182 => 52,  177 => 51,  170 => 48,  165 => 47,  157 => 44,  154 => 43,  148 => 41,  143 => 40,  138 => 39,  132 => 36,  128 => 34,  121 => 33,  118 => 32,  111 => 31,  108 => 30,  98 => 23,  94 => 22,  87 => 19,  84 => 18,  78 => 16,  75 => 15,  70 => 14,  65 => 13,  57 => 10,  54 => 9,  51 => 8,  39 => 6,  36 => 5,  31 => 2,  19 => 1,);
    }
}
