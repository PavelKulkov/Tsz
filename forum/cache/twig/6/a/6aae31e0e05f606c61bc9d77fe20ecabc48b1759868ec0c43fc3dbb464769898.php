<?php

/* posting_poll_body.html */
class __TwigTemplate_6aae31e0e05f606c61bc9d77fe20ecabc48b1759868ec0c43fc3dbb464769898 extends Twig_Template
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
        echo "<div class=\"panel bg3\" id=\"poll-panel\">
\t<div class=\"inner\">

\t";
        // line 4
        if (isset($context["S_SHOW_POLL_BOX"])) { $_S_SHOW_POLL_BOX_ = $context["S_SHOW_POLL_BOX"]; } else { $_S_SHOW_POLL_BOX_ = null; }
        if ($_S_SHOW_POLL_BOX_) {
            // line 5
            echo "\t<p>";
            echo $this->env->getExtension('phpbb')->lang("ADD_POLL_EXPLAIN");
            echo "</p>
\t";
        }
        // line 7
        echo "
\t<fieldset class=\"fields2\">
\t";
        // line 9
        if (isset($context["S_POLL_DELETE"])) { $_S_POLL_DELETE_ = $context["S_POLL_DELETE"]; } else { $_S_POLL_DELETE_ = null; }
        if ($_S_POLL_DELETE_) {
            // line 10
            echo "\t\t<dl>
\t\t\t<dt><label for=\"poll_delete\">";
            // line 11
            echo $this->env->getExtension('phpbb')->lang("POLL_DELETE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label for=\"poll_delete\"><input type=\"checkbox\" name=\"poll_delete\" id=\"poll_delete\"";
            // line 12
            if (isset($context["S_POLL_DELETE_CHECKED"])) { $_S_POLL_DELETE_CHECKED_ = $context["S_POLL_DELETE_CHECKED"]; } else { $_S_POLL_DELETE_CHECKED_ = null; }
            if ($_S_POLL_DELETE_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> </label></dd>
\t\t</dl>
\t";
        }
        // line 15
        echo "
\t";
        // line 16
        if (isset($context["S_SHOW_POLL_BOX"])) { $_S_SHOW_POLL_BOX_ = $context["S_SHOW_POLL_BOX"]; } else { $_S_SHOW_POLL_BOX_ = null; }
        if ($_S_SHOW_POLL_BOX_) {
            // line 17
            echo "\t\t<dl>
\t\t\t<dt><label for=\"poll_title\">";
            // line 18
            echo $this->env->getExtension('phpbb')->lang("POLL_QUESTION");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"text\" name=\"poll_title\" id=\"poll_title\" maxlength=\"255\" value=\"";
            // line 19
            if (isset($context["POLL_TITLE"])) { $_POLL_TITLE_ = $context["POLL_TITLE"]; } else { $_POLL_TITLE_ = null; }
            echo $_POLL_TITLE_;
            echo "\" class=\"inputbox\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"poll_option_text\">";
            // line 22
            echo $this->env->getExtension('phpbb')->lang("POLL_OPTIONS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("POLL_OPTIONS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><textarea name=\"poll_option_text\" id=\"poll_option_text\" rows=\"5\" cols=\"35\" class=\"inputbox\">";
            // line 23
            if (isset($context["POLL_OPTIONS"])) { $_POLL_OPTIONS_ = $context["POLL_OPTIONS"]; } else { $_POLL_OPTIONS_ = null; }
            echo $_POLL_OPTIONS_;
            echo "</textarea></dd>
\t\t</dl>

\t\t<hr class=\"dashed\" />

\t\t<dl>
\t\t\t<dt><label for=\"poll_max_options\">";
            // line 29
            echo $this->env->getExtension('phpbb')->lang("POLL_MAX_OPTIONS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"number\" min=\"0\" max=\"999\" name=\"poll_max_options\" id=\"poll_max_options\" size=\"3\" maxlength=\"3\" value=\"";
            // line 30
            if (isset($context["POLL_MAX_OPTIONS"])) { $_POLL_MAX_OPTIONS_ = $context["POLL_MAX_OPTIONS"]; } else { $_POLL_MAX_OPTIONS_ = null; }
            echo $_POLL_MAX_OPTIONS_;
            echo "\" class=\"inputbox autowidth\" /></dd>
\t\t\t<dd>";
            // line 31
            echo $this->env->getExtension('phpbb')->lang("POLL_MAX_OPTIONS_EXPLAIN");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"poll_length\">";
            // line 34
            echo $this->env->getExtension('phpbb')->lang("POLL_FOR");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label for=\"poll_length\"><input type=\"number\" min=\"0\" max=\"999\" name=\"poll_length\" id=\"poll_length\" size=\"3\" maxlength=\"3\" value=\"";
            // line 35
            if (isset($context["POLL_LENGTH"])) { $_POLL_LENGTH_ = $context["POLL_LENGTH"]; } else { $_POLL_LENGTH_ = null; }
            echo $_POLL_LENGTH_;
            echo "\" class=\"inputbox autowidth\" /> ";
            echo $this->env->getExtension('phpbb')->lang("DAYS");
            echo "</label></dd>
\t\t\t<dd>";
            // line 36
            echo $this->env->getExtension('phpbb')->lang("POLL_FOR_EXPLAIN");
            echo "</dd>
\t\t</dl>

\t\t";
            // line 39
            if (isset($context["S_POLL_VOTE_CHANGE"])) { $_S_POLL_VOTE_CHANGE_ = $context["S_POLL_VOTE_CHANGE"]; } else { $_S_POLL_VOTE_CHANGE_ = null; }
            if ($_S_POLL_VOTE_CHANGE_) {
                // line 40
                echo "\t\t\t<hr class=\"dashed\" />

\t\t\t<dl>
\t\t\t\t<dt><label for=\"poll_vote_change\">";
                // line 43
                echo $this->env->getExtension('phpbb')->lang("POLL_VOTE_CHANGE");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t\t<dd><label for=\"poll_vote_change\"><input type=\"checkbox\" id=\"poll_vote_change\" name=\"poll_vote_change\"";
                // line 44
                if (isset($context["VOTE_CHANGE_CHECKED"])) { $_VOTE_CHANGE_CHECKED_ = $context["VOTE_CHANGE_CHECKED"]; } else { $_VOTE_CHANGE_CHECKED_ = null; }
                echo $_VOTE_CHANGE_CHECKED_;
                echo " /> ";
                echo $this->env->getExtension('phpbb')->lang("POLL_VOTE_CHANGE_EXPLAIN");
                echo "</label></dd>
\t\t\t</dl>
\t\t";
            }
            // line 47
            echo "\t";
        }
        // line 48
        echo "
\t";
        // line 49
        if (isset($context["posting_poll_body_options_after"])) { $_posting_poll_body_options_after_ = $context["posting_poll_body_options_after"]; } else { $_posting_poll_body_options_after_ = null; }
        // line 50
        echo "\t</fieldset>

\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "posting_poll_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 50,  157 => 49,  154 => 48,  151 => 47,  142 => 44,  137 => 43,  132 => 40,  129 => 39,  123 => 36,  116 => 35,  111 => 34,  105 => 31,  100 => 30,  95 => 29,  85 => 23,  78 => 22,  71 => 19,  66 => 18,  63 => 17,  60 => 16,  57 => 15,  48 => 12,  43 => 11,  40 => 10,  37 => 9,  33 => 7,  27 => 5,  24 => 4,  19 => 1,);
    }
}
