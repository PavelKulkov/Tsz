<?php

/* ucp_agreement.html */
class __TwigTemplate_b68e643bc497a09f5f1d11058347b9a1b23ad8bcc334e65989f4bc1efeb2fa10 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "ucp_agreement.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        if (isset($context["S_SHOW_COPPA"])) { $_S_SHOW_COPPA_ = $context["S_SHOW_COPPA"]; } else { $_S_SHOW_COPPA_ = null; }
        if (isset($context["S_REGISTRATION"])) { $_S_REGISTRATION_ = $context["S_REGISTRATION"]; } else { $_S_REGISTRATION_ = null; }
        if (isset($context["S_AGREEMENT"])) { $_S_AGREEMENT_ = $context["S_AGREEMENT"]; } else { $_S_AGREEMENT_ = null; }
        if (($_S_SHOW_COPPA_ || $_S_REGISTRATION_)) {
            // line 4
            echo "
";
            // line 5
            if (isset($context["S_LANG_OPTIONS"])) { $_S_LANG_OPTIONS_ = $context["S_LANG_OPTIONS"]; } else { $_S_LANG_OPTIONS_ = null; }
            if ($_S_LANG_OPTIONS_) {
                // line 6
                echo "<script type=\"text/javascript\">
// <![CDATA[
\t/**
\t* Change language
\t*/
\tfunction change_language(lang_iso)
\t{
\t\tdocument.cookie = '";
                // line 13
                if (isset($context["COOKIE_NAME"])) { $_COOKIE_NAME_ = $context["COOKIE_NAME"]; } else { $_COOKIE_NAME_ = null; }
                echo $_COOKIE_NAME_;
                echo "_lang=' + lang_iso + '; path=";
                if (isset($context["COOKIE_PATH"])) { $_COOKIE_PATH_ = $context["COOKIE_PATH"]; } else { $_COOKIE_PATH_ = null; }
                echo $_COOKIE_PATH_;
                echo "';
\t\tdocument.forms['register'].change_lang.value = lang_iso;
\t\tdocument.forms['register'].submit();
\t}

// ]]>
</script>

\t<form method=\"post\" action=\"";
                // line 21
                if (isset($context["S_UCP_ACTION"])) { $_S_UCP_ACTION_ = $context["S_UCP_ACTION"]; } else { $_S_UCP_ACTION_ = null; }
                echo $_S_UCP_ACTION_;
                echo "\" id=\"register\">
\t\t<p class=\"rightside\">
\t\t\t<label for=\"lang\">";
                // line 23
                echo $this->env->getExtension('phpbb')->lang("LANGUAGE");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label><select name=\"lang\" id=\"lang\" onchange=\"change_language(this.value); return false;\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("LANGUAGE");
                echo "\">";
                if (isset($context["S_LANG_OPTIONS"])) { $_S_LANG_OPTIONS_ = $context["S_LANG_OPTIONS"]; } else { $_S_LANG_OPTIONS_ = null; }
                echo $_S_LANG_OPTIONS_;
                echo "</select>
\t\t\t";
                // line 24
                if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
                echo $_S_HIDDEN_FIELDS_;
                echo "
\t\t</p>
\t</form>

\t<div class=\"clear\"></div>

";
            }
            // line 31
            echo "
\t<form method=\"post\" action=\"";
            // line 32
            if (isset($context["S_UCP_ACTION"])) { $_S_UCP_ACTION_ = $context["S_UCP_ACTION"]; } else { $_S_UCP_ACTION_ = null; }
            echo $_S_UCP_ACTION_;
            echo "\" id=\"agreement\">

\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t<div class=\"content\">
\t\t\t<h2 class=\"sitename-title\">";
            // line 37
            if (isset($context["SITENAME"])) { $_SITENAME_ = $context["SITENAME"]; } else { $_SITENAME_ = null; }
            echo $_SITENAME_;
            echo " - ";
            echo $this->env->getExtension('phpbb')->lang("REGISTRATION");
            echo "</h2>
\t\t\t";
            // line 38
            if (isset($context["ucp_agreement_terms_before"])) { $_ucp_agreement_terms_before_ = $context["ucp_agreement_terms_before"]; } else { $_ucp_agreement_terms_before_ = null; }
            // line 39
            echo "\t\t\t<p>";
            if (isset($context["S_SHOW_COPPA"])) { $_S_SHOW_COPPA_ = $context["S_SHOW_COPPA"]; } else { $_S_SHOW_COPPA_ = null; }
            if ($_S_SHOW_COPPA_) {
                echo $this->env->getExtension('phpbb')->lang("COPPA_BIRTHDAY");
            } else {
                echo $this->env->getExtension('phpbb')->lang("TERMS_OF_USE");
            }
            echo "</p>
\t\t\t";
            // line 40
            if (isset($context["ucp_agreement_terms_after"])) { $_ucp_agreement_terms_after_ = $context["ucp_agreement_terms_after"]; } else { $_ucp_agreement_terms_after_ = null; }
            // line 41
            echo "\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t<fieldset class=\"submit-buttons\">
\t\t\t";
            // line 48
            if (isset($context["S_SHOW_COPPA"])) { $_S_SHOW_COPPA_ = $context["S_SHOW_COPPA"]; } else { $_S_SHOW_COPPA_ = null; }
            if ($_S_SHOW_COPPA_) {
                // line 49
                echo "\t\t\t<strong><a href=\"";
                if (isset($context["U_COPPA_NO"])) { $_U_COPPA_NO_ = $context["U_COPPA_NO"]; } else { $_U_COPPA_NO_ = null; }
                echo $_U_COPPA_NO_;
                echo "\" class=\"button1\">";
                echo $this->env->getExtension('phpbb')->lang("COPPA_NO");
                echo "</a></strong>&nbsp; <a href=\"";
                if (isset($context["U_COPPA_YES"])) { $_U_COPPA_YES_ = $context["U_COPPA_YES"]; } else { $_U_COPPA_YES_ = null; }
                echo $_U_COPPA_YES_;
                echo "\" class=\"button2\">";
                echo $this->env->getExtension('phpbb')->lang("COPPA_YES");
                echo "</a>
\t\t\t";
            } else {
                // line 51
                echo "\t\t\t<input type=\"submit\" name=\"agreed\" id=\"agreed\" value=\"";
                echo $this->env->getExtension('phpbb')->lang("AGREE");
                echo "\" class=\"button1\" />&nbsp;
\t\t\t<input type=\"submit\" name=\"not_agreed\" value=\"";
                // line 52
                echo $this->env->getExtension('phpbb')->lang("NOT_AGREE");
                echo "\" class=\"button2\" />
\t\t\t";
            }
            // line 54
            echo "\t\t\t";
            if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
            echo $_S_HIDDEN_FIELDS_;
            echo "
\t\t\t";
            // line 55
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t\t</fieldset>
\t\t</div>
\t</div>
\t</form>

";
        } elseif ($_S_AGREEMENT_) {
            // line 62
            echo "
\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t<div class=\"content\">
\t\t\t<h2 class=\"sitename-title\">";
            // line 66
            if (isset($context["SITENAME"])) { $_SITENAME_ = $context["SITENAME"]; } else { $_SITENAME_ = null; }
            echo $_SITENAME_;
            echo " - ";
            if (isset($context["AGREEMENT_TITLE"])) { $_AGREEMENT_TITLE_ = $context["AGREEMENT_TITLE"]; } else { $_AGREEMENT_TITLE_ = null; }
            echo $_AGREEMENT_TITLE_;
            echo "</h2>
\t\t\t<p>";
            // line 67
            if (isset($context["AGREEMENT_TEXT"])) { $_AGREEMENT_TEXT_ = $context["AGREEMENT_TEXT"]; } else { $_AGREEMENT_TEXT_ = null; }
            echo $_AGREEMENT_TEXT_;
            echo "</p>
\t\t\t<hr class=\"dashed\" />
\t\t\t<p><a href=\"";
            // line 69
            if (isset($context["U_BACK"])) { $_U_BACK_ = $context["U_BACK"]; } else { $_U_BACK_ = null; }
            echo $_U_BACK_;
            echo "\" class=\"button2\">";
            echo $this->env->getExtension('phpbb')->lang("BACK");
            echo "</a></p>
\t\t</div>
\t\t</div>
\t</div>

";
        }
        // line 75
        echo "
";
        // line 76
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "ucp_agreement.html", 76)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_agreement.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 76,  214 => 75,  202 => 69,  196 => 67,  188 => 66,  182 => 62,  171 => 55,  165 => 54,  160 => 52,  155 => 51,  141 => 49,  138 => 48,  129 => 41,  127 => 40,  117 => 39,  115 => 38,  108 => 37,  99 => 32,  96 => 31,  85 => 24,  75 => 23,  69 => 21,  54 => 13,  45 => 6,  42 => 5,  39 => 4,  34 => 3,  31 => 2,  19 => 1,);
    }
}
