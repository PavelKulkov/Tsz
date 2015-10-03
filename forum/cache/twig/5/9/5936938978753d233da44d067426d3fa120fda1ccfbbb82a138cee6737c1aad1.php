<?php

/* ucp_register.html */
class __TwigTemplate_5936938978753d233da44d067426d3fa120fda1ccfbbb82a138cee6737c1aad1 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "ucp_register.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<script type=\"text/javascript\">
// <![CDATA[
\t/**
\t* Change language
\t*/
\tfunction change_language(lang_iso)
\t{
\t\tdocument.cookie = '";
        // line 10
        if (isset($context["COOKIE_NAME"])) { $_COOKIE_NAME_ = $context["COOKIE_NAME"]; } else { $_COOKIE_NAME_ = null; }
        echo $_COOKIE_NAME_;
        echo "_lang=' + lang_iso + '; path=";
        if (isset($context["COOKIE_PATH"])) { $_COOKIE_PATH_ = $context["COOKIE_PATH"]; } else { $_COOKIE_PATH_ = null; }
        echo $_COOKIE_PATH_;
        echo "';
\t\tdocument.forms['register'].change_lang.value = lang_iso;
\t\tdocument.forms['register'].submit.click();
\t}
// ]]>
</script>

<form method=\"post\" action=\"";
        // line 17
        if (isset($context["S_UCP_ACTION"])) { $_S_UCP_ACTION_ = $context["S_UCP_ACTION"]; } else { $_S_UCP_ACTION_ = null; }
        echo $_S_UCP_ACTION_;
        echo "\" id=\"register\">

<div class=\"panel\">
\t<div class=\"inner\">

\t<h2>";
        // line 22
        if (isset($context["SITENAME"])) { $_SITENAME_ = $context["SITENAME"]; } else { $_SITENAME_ = null; }
        echo $_SITENAME_;
        echo " - ";
        echo $this->env->getExtension('phpbb')->lang("REGISTRATION");
        echo "</h2>

\t<fieldset class=\"fields2\">
\t";
        // line 25
        if (isset($context["ERROR"])) { $_ERROR_ = $context["ERROR"]; } else { $_ERROR_ = null; }
        if ($_ERROR_) {
            echo "<dl><dd class=\"error\">";
            if (isset($context["ERROR"])) { $_ERROR_ = $context["ERROR"]; } else { $_ERROR_ = null; }
            echo $_ERROR_;
            echo "</dd></dl>";
        }
        // line 26
        echo "\t";
        if (isset($context["L_REG_COND"])) { $_L_REG_COND_ = $context["L_REG_COND"]; } else { $_L_REG_COND_ = null; }
        if ($_L_REG_COND_) {
            // line 27
            echo "\t\t<dl><dd><strong>";
            echo $this->env->getExtension('phpbb')->lang("REG_COND");
            echo "</strong></dd></dl>
\t";
        }
        // line 29
        echo "\t";
        if (isset($context["ucp_register_credentials_before"])) { $_ucp_register_credentials_before_ = $context["ucp_register_credentials_before"]; } else { $_ucp_register_credentials_before_ = null; }
        // line 30
        echo "\t<dl>
\t\t<dt><label for=\"username\">";
        // line 31
        echo $this->env->getExtension('phpbb')->lang("USERNAME");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("USERNAME_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"text\" tabindex=\"1\" name=\"username\" id=\"username\" size=\"25\" value=\"";
        // line 32
        if (isset($context["USERNAME"])) { $_USERNAME_ = $context["USERNAME"]; } else { $_USERNAME_ = null; }
        echo $_USERNAME_;
        echo "\" class=\"inputbox autowidth\" title=\"";
        echo $this->env->getExtension('phpbb')->lang("USERNAME");
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"email\">";
        // line 35
        echo $this->env->getExtension('phpbb')->lang("EMAIL_ADDRESS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd><input type=\"email\" tabindex=\"2\" name=\"email\" id=\"email\" size=\"25\" maxlength=\"100\" value=\"";
        // line 36
        if (isset($context["EMAIL"])) { $_EMAIL_ = $context["EMAIL"]; } else { $_EMAIL_ = null; }
        echo $_EMAIL_;
        echo "\" class=\"inputbox autowidth\" title=\"";
        echo $this->env->getExtension('phpbb')->lang("EMAIL_ADDRESS");
        echo "\" autocomplete=\"off\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"new_password\">";
        // line 39
        echo $this->env->getExtension('phpbb')->lang("PASSWORD");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("PASSWORD_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input type=\"password\" tabindex=\"4\" name=\"new_password\" id=\"new_password\" size=\"25\" value=\"";
        // line 40
        if (isset($context["PASSWORD"])) { $_PASSWORD_ = $context["PASSWORD"]; } else { $_PASSWORD_ = null; }
        echo $_PASSWORD_;
        echo "\" class=\"inputbox autowidth\" title=\"";
        echo $this->env->getExtension('phpbb')->lang("NEW_PASSWORD");
        echo "\" autocomplete=\"off\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"password_confirm\">";
        // line 43
        echo $this->env->getExtension('phpbb')->lang("CONFIRM_PASSWORD");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd><input type=\"password\"  tabindex=\"5\" name=\"password_confirm\" id=\"password_confirm\" size=\"25\" value=\"";
        // line 44
        if (isset($context["PASSWORD_CONFIRM"])) { $_PASSWORD_CONFIRM_ = $context["PASSWORD_CONFIRM"]; } else { $_PASSWORD_CONFIRM_ = null; }
        echo $_PASSWORD_CONFIRM_;
        echo "\" class=\"inputbox autowidth\" title=\"";
        echo $this->env->getExtension('phpbb')->lang("CONFIRM_PASSWORD");
        echo "\" autocomplete=\"off\" /></dd>
\t</dl>

\t";
        // line 47
        if (isset($context["ucp_register_credentials_after"])) { $_ucp_register_credentials_after_ = $context["ucp_register_credentials_after"]; } else { $_ucp_register_credentials_after_ = null; }
        // line 48
        echo "\t<hr />

\t";
        // line 50
        if (isset($context["ucp_register_options_before"])) { $_ucp_register_options_before_ = $context["ucp_register_options_before"]; } else { $_ucp_register_options_before_ = null; }
        // line 51
        echo "\t<dl>
\t\t<dt><label for=\"lang\">";
        // line 52
        echo $this->env->getExtension('phpbb')->lang("LANGUAGE");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd><select name=\"lang\" id=\"lang\" onchange=\"change_language(this.value); return false;\" tabindex=\"6\" title=\"";
        // line 53
        echo $this->env->getExtension('phpbb')->lang("LANGUAGE");
        echo "\">";
        if (isset($context["S_LANG_OPTIONS"])) { $_S_LANG_OPTIONS_ = $context["S_LANG_OPTIONS"]; } else { $_S_LANG_OPTIONS_ = null; }
        echo $_S_LANG_OPTIONS_;
        echo "</select></dd>
\t</dl>

\t";
        // line 56
        $location = "timezone_option.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("timezone_option.html", "ucp_register.html", 56)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 57
        echo "
\t";
        // line 58
        if (isset($context["ucp_register_profile_fields_before"])) { $_ucp_register_profile_fields_before_ = $context["ucp_register_profile_fields_before"]; } else { $_ucp_register_profile_fields_before_ = null; }
        // line 59
        echo "\t";
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "profile_fields", array()))) {
            // line 60
            echo "\t\t<dl><dd><strong>";
            echo $this->env->getExtension('phpbb')->lang("ITEMS_REQUIRED");
            echo "</strong></dd></dl>

\t";
            // line 62
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "profile_fields", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["profile_fields"]) {
                // line 63
                echo "\t\t<dl>
\t\t\t<dt><label";
                // line 64
                if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                if ($this->getAttribute($_profile_fields_, "FIELD_ID", array())) {
                    echo " for=\"";
                    if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                    echo $this->getAttribute($_profile_fields_, "FIELD_ID", array());
                    echo "\"";
                }
                echo ">";
                if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                echo $this->getAttribute($_profile_fields_, "LANG_NAME", array());
                echo $this->env->getExtension('phpbb')->lang("COLON");
                if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                if ($this->getAttribute($_profile_fields_, "S_REQUIRED", array())) {
                    echo " *";
                }
                echo "</label>
\t\t\t";
                // line 65
                if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                if ($this->getAttribute($_profile_fields_, "LANG_EXPLAIN", array())) {
                    echo "<br /><span>";
                    if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                    echo $this->getAttribute($_profile_fields_, "LANG_EXPLAIN", array());
                    echo "</span>";
                }
                // line 66
                echo "\t\t\t";
                if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                if ($this->getAttribute($_profile_fields_, "ERROR", array())) {
                    echo "<br /><span class=\"error\">";
                    if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                    echo $this->getAttribute($_profile_fields_, "ERROR", array());
                    echo "</span>";
                }
                echo "</dt>
\t\t\t<dd>";
                // line 67
                if (isset($context["profile_fields"])) { $_profile_fields_ = $context["profile_fields"]; } else { $_profile_fields_ = null; }
                echo $this->getAttribute($_profile_fields_, "FIELD", array());
                echo "</dd>
\t\t</dl>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['profile_fields'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            echo "\t";
        }
        // line 71
        echo "
\t";
        // line 72
        if (isset($context["ucp_register_profile_fields_after"])) { $_ucp_register_profile_fields_after_ = $context["ucp_register_profile_fields_after"]; } else { $_ucp_register_profile_fields_after_ = null; }
        // line 73
        echo "\t</fieldset>
\t</div>
</div>
";
        // line 76
        if (isset($context["CAPTCHA_TEMPLATE"])) { $_CAPTCHA_TEMPLATE_ = $context["CAPTCHA_TEMPLATE"]; } else { $_CAPTCHA_TEMPLATE_ = null; }
        if ($_CAPTCHA_TEMPLATE_) {
            // line 77
            echo "\t";
            if (isset($context["CAPTCHA_TAB_INDEX"])) { $_CAPTCHA_TAB_INDEX_ = $context["CAPTCHA_TAB_INDEX"]; } else { $_CAPTCHA_TAB_INDEX_ = null; }
            $value = 8;
            $context['definition']->set('CAPTCHA_TAB_INDEX', $value);
            // line 78
            echo "\t";
            if (isset($context["CAPTCHA_TEMPLATE"])) { $_CAPTCHA_TEMPLATE_ = $context["CAPTCHA_TEMPLATE"]; } else { $_CAPTCHA_TEMPLATE_ = null; }
            $location = (("" . $_CAPTCHA_TEMPLATE_) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate((("" . $_CAPTCHA_TEMPLATE_) . ""), "ucp_register.html", 78)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 80
        echo "
";
        // line 81
        if (isset($context["S_COPPA"])) { $_S_COPPA_ = $context["S_COPPA"]; } else { $_S_COPPA_ = null; }
        if ($_S_COPPA_) {
            // line 82
            echo "

<div class=\"panel\">
\t<div class=\"inner\">

\t<h4>";
            // line 87
            echo $this->env->getExtension('phpbb')->lang("COPPA_COMPLIANCE");
            echo "</h4>

\t<p>";
            // line 89
            echo $this->env->getExtension('phpbb')->lang("COPPA_EXPLAIN");
            echo "</p>
\t</div>
</div>
";
        }
        // line 93
        echo "
<div class=\"panel\">
\t<div class=\"inner\">

\t<fieldset class=\"submit-buttons\">
\t\t";
        // line 98
        if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
        echo $_S_HIDDEN_FIELDS_;
        echo "
\t\t<input type=\"reset\" value=\"";
        // line 99
        echo $this->env->getExtension('phpbb')->lang("RESET");
        echo "\" name=\"reset\" class=\"button2\" />&nbsp;
\t\t<input type=\"submit\" tabindex=\"9\" name=\"submit\" id=\"submit\" value=\"";
        // line 100
        echo $this->env->getExtension('phpbb')->lang("SUBMIT");
        echo "\" class=\"button1 default-submit-action\" />
\t\t";
        // line 101
        if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
        echo $_S_FORM_TOKEN_;
        echo "
\t</fieldset>

\t</div>
</div>
</form>

";
        // line 108
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "ucp_register.html", 108)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_register.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  356 => 108,  345 => 101,  341 => 100,  337 => 99,  332 => 98,  325 => 93,  318 => 89,  313 => 87,  306 => 82,  303 => 81,  300 => 80,  285 => 78,  280 => 77,  277 => 76,  272 => 73,  270 => 72,  267 => 71,  264 => 70,  254 => 67,  243 => 66,  235 => 65,  217 => 64,  214 => 63,  209 => 62,  203 => 60,  199 => 59,  197 => 58,  194 => 57,  182 => 56,  173 => 53,  168 => 52,  165 => 51,  163 => 50,  159 => 48,  157 => 47,  148 => 44,  143 => 43,  134 => 40,  127 => 39,  118 => 36,  113 => 35,  104 => 32,  97 => 31,  94 => 30,  91 => 29,  85 => 27,  81 => 26,  73 => 25,  64 => 22,  55 => 17,  41 => 10,  31 => 2,  19 => 1,);
    }
}
