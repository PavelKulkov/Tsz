<?php

/* captcha_default.html */
class __TwigTemplate_93a436fcf2b8720e42dd7e1a601f1aacbbc95f5b74517d328d3e29a178795bb9 extends Twig_Template
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
        if (isset($context["S_TYPE"])) { $_S_TYPE_ = $context["S_TYPE"]; } else { $_S_TYPE_ = null; }
        if (($_S_TYPE_ == 1)) {
            // line 2
            echo "<div class=\"panel captcha-panel\">
\t<div class=\"inner\">

\t<h3 class=\"captcha-title\">";
            // line 5
            echo $this->env->getExtension('phpbb')->lang("CONFIRMATION");
            echo "</h3>
\t<p>";
            // line 6
            echo $this->env->getExtension('phpbb')->lang("CONFIRM_EXPLAIN");
            echo "</p>

\t<fieldset class=\"fields2\">
";
        }
        // line 10
        echo "
\t<dl>
\t\t<dt><label for=\"confirm_code\">";
        // line 12
        echo $this->env->getExtension('phpbb')->lang("CONFIRM_CODE");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd class=\"captcha captcha-image\"><img src=\"";
        // line 13
        if (isset($context["CONFIRM_IMAGE_LINK"])) { $_CONFIRM_IMAGE_LINK_ = $context["CONFIRM_IMAGE_LINK"]; } else { $_CONFIRM_IMAGE_LINK_ = null; }
        echo $_CONFIRM_IMAGE_LINK_;
        echo "\" alt=\"";
        echo $this->env->getExtension('phpbb')->lang("CONFIRM_CODE");
        echo "\" /></dd>
\t\t<dd><input type=\"text\" name=\"confirm_code\" id=\"confirm_code\" size=\"8\" maxlength=\"8\" tabindex=\"";
        // line 14
        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
        echo $this->getAttribute($_definition_, "CAPTCHA_TAB_INDEX", array());
        echo "\" class=\"inputbox narrow\" title=\"";
        echo $this->env->getExtension('phpbb')->lang("CONFIRM_CODE");
        echo "\" />
\t\t";
        // line 15
        if (isset($context["S_CONFIRM_REFRESH"])) { $_S_CONFIRM_REFRESH_ = $context["S_CONFIRM_REFRESH"]; } else { $_S_CONFIRM_REFRESH_ = null; }
        if ($_S_CONFIRM_REFRESH_) {
            echo "<input type=\"submit\" name=\"refresh_vc\" id=\"refresh_vc\" class=\"button2\" value=\"";
            echo $this->env->getExtension('phpbb')->lang("VC_REFRESH");
            echo "\" />";
        }
        // line 16
        echo "\t\t<input type=\"hidden\" name=\"confirm_id\" id=\"confirm_id\" value=\"";
        if (isset($context["CONFIRM_ID"])) { $_CONFIRM_ID_ = $context["CONFIRM_ID"]; } else { $_CONFIRM_ID_ = null; }
        echo $_CONFIRM_ID_;
        echo "\" /></dd>
\t\t<dd>";
        // line 17
        echo $this->env->getExtension('phpbb')->lang("CONFIRM_CODE_EXPLAIN");
        echo "</dd>
\t</dl>

";
        // line 20
        if (isset($context["S_TYPE"])) { $_S_TYPE_ = $context["S_TYPE"]; } else { $_S_TYPE_ = null; }
        if (($_S_TYPE_ == 1)) {
            // line 21
            echo "\t</fieldset>
\t</div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "captcha_default.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 21,  80 => 20,  74 => 17,  68 => 16,  61 => 15,  54 => 14,  47 => 13,  42 => 12,  38 => 10,  31 => 6,  27 => 5,  22 => 2,  19 => 1,);
    }
}
