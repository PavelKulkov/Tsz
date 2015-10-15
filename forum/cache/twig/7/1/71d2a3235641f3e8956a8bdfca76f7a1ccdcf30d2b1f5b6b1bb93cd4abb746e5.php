<?php

/* acp_update.html */
class __TwigTemplate_71d2a3235641f3e8956a8bdfca76f7a1ccdcf30d2b1f5b6b1bb93cd4abb746e5 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_update.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("VERSION_CHECK");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb')->lang("VERSION_CHECK_EXPLAIN");
        echo "</p>

";
        // line 9
        if (isset($context["S_UP_TO_DATE"])) { $_S_UP_TO_DATE_ = $context["S_UP_TO_DATE"]; } else { $_S_UP_TO_DATE_ = null; }
        if ($_S_UP_TO_DATE_) {
            // line 10
            echo "\t<div class=\"successbox\">
\t\t<p>";
            // line 11
            echo $this->env->getExtension('phpbb')->lang("VERSION_UP_TO_DATE_ACP");
            echo " - <a href=\"";
            if (isset($context["U_VERSIONCHECK_FORCE"])) { $_U_VERSIONCHECK_FORCE_ = $context["U_VERSIONCHECK_FORCE"]; } else { $_U_VERSIONCHECK_FORCE_ = null; }
            echo $_U_VERSIONCHECK_FORCE_;
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("VERSIONCHECK_FORCE_UPDATE");
            echo "</a></p>
\t</div>
";
        } else {
            // line 14
            echo "\t<div class=\"errorbox\">
\t\t<p>";
            // line 15
            echo $this->env->getExtension('phpbb')->lang("VERSION_NOT_UP_TO_DATE_ACP");
            echo " - <a href=\"";
            if (isset($context["U_VERSIONCHECK_FORCE"])) { $_U_VERSIONCHECK_FORCE_ = $context["U_VERSIONCHECK_FORCE"]; } else { $_U_VERSIONCHECK_FORCE_ = null; }
            echo $_U_VERSIONCHECK_FORCE_;
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("VERSIONCHECK_FORCE_UPDATE");
            echo "</a></p>
\t</div>
";
        }
        // line 18
        echo "
<fieldset>
\t<legend></legend>
\t<dl>
\t\t<dt><label>";
        // line 22
        echo $this->env->getExtension('phpbb')->lang("CURRENT_VERSION");
        echo "</label></dt>
\t\t<dd><strong>";
        // line 23
        if (isset($context["CURRENT_VERSION"])) { $_CURRENT_VERSION_ = $context["CURRENT_VERSION"]; } else { $_CURRENT_VERSION_ = null; }
        echo $_CURRENT_VERSION_;
        echo "</strong></dd>
\t</dl>
</fieldset>

";
        // line 27
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "updates_available", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["updates_available"]) {
            // line 28
            echo "\t<fieldset>
\t\t<legend></legend>
\t\t<dl>
\t\t\t<dt><label>";
            // line 31
            echo $this->env->getExtension('phpbb')->lang("LATEST_VERSION");
            echo "</label></dt>
\t\t\t<dd><strong>";
            // line 32
            if (isset($context["updates_available"])) { $_updates_available_ = $context["updates_available"]; } else { $_updates_available_ = null; }
            echo $this->getAttribute($_updates_available_, "current", array());
            echo "</strong></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label>";
            // line 35
            echo $this->env->getExtension('phpbb')->lang("RELEASE_ANNOUNCEMENT");
            echo "</label></dt>
\t\t\t<dd><strong><a href=\"";
            // line 36
            if (isset($context["updates_available"])) { $_updates_available_ = $context["updates_available"]; } else { $_updates_available_ = null; }
            echo $this->getAttribute($_updates_available_, "announcement", array());
            echo "\">";
            if (isset($context["updates_available"])) { $_updates_available_ = $context["updates_available"]; } else { $_updates_available_ = null; }
            echo $this->getAttribute($_updates_available_, "announcement", array());
            echo "</a></strong></dd>
\t\t</dl>
\t</fieldset>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['updates_available'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "
";
        // line 41
        if (isset($context["S_UP_TO_DATE"])) { $_S_UP_TO_DATE_ = $context["S_UP_TO_DATE"]; } else { $_S_UP_TO_DATE_ = null; }
        if ( !$_S_UP_TO_DATE_) {
            // line 42
            echo "\t";
            if (isset($context["UPDATE_INSTRUCTIONS"])) { $_UPDATE_INSTRUCTIONS_ = $context["UPDATE_INSTRUCTIONS"]; } else { $_UPDATE_INSTRUCTIONS_ = null; }
            echo $_UPDATE_INSTRUCTIONS_;
            echo "
\t<br /><br />
";
        }
        // line 45
        echo "
";
        // line 46
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_update.html", 46)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_update.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 46,  148 => 45,  140 => 42,  137 => 41,  134 => 40,  120 => 36,  116 => 35,  109 => 32,  105 => 31,  100 => 28,  95 => 27,  87 => 23,  83 => 22,  77 => 18,  66 => 15,  63 => 14,  52 => 11,  49 => 10,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }
}
