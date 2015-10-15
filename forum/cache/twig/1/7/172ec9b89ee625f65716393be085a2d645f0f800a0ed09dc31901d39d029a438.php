<?php

/* pagination.html */
class __TwigTemplate_172ec9b89ee625f65716393be085a2d645f0f800a0ed09dc31901d39d029a438 extends Twig_Template
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
        echo "
 \t<a href=\"#\" onclick=\"jumpto(); return false;\" title=\"";
        // line 2
        echo $this->env->getExtension('phpbb')->lang("JUMP_TO_PAGE_CLICK");
        echo "\">";
        if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
        echo $_PAGE_NUMBER_;
        echo "</a> &bull; 
\t<ul>
\t";
        // line 4
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "pagination", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["pagination"]) {
            // line 5
            echo "\t\t";
            if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
            if ($this->getAttribute($_pagination_, "S_IS_PREV", array())) {
                echo "<li><a href=\"";
                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                echo $this->getAttribute($_pagination_, "PAGE_URL", array());
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("PREVIOUS");
                echo "</a></li>
\t\t";
            } elseif ($this->getAttribute($_pagination_, "S_IS_CURRENT", array())) {
                // line 6
                echo "<li class=\"active\"><span>";
                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                echo $this->getAttribute($_pagination_, "PAGE_NUMBER", array());
                echo "</span></li>
\t\t";
            } elseif ($this->getAttribute($_pagination_, "S_IS_ELLIPSIS", array())) {
                // line 7
                echo "<li class=\"ellipsis\"><span>";
                echo $this->env->getExtension('phpbb')->lang("ELLIPSIS");
                echo "</span></li>
\t\t";
            } elseif ($this->getAttribute($_pagination_, "S_IS_NEXT", array())) {
                // line 8
                echo "<li><a href=\"";
                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                echo $this->getAttribute($_pagination_, "PAGE_URL", array());
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("NEXT");
                echo "</a></li>
\t\t";
            } else {
                // line 9
                echo "<li><a href=\"";
                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                echo $this->getAttribute($_pagination_, "PAGE_URL", array());
                echo "\">";
                if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                echo $this->getAttribute($_pagination_, "PAGE_NUMBER", array());
                echo "</a></li>
\t\t";
            }
            // line 11
            echo "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pagination'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "\t</ul>
";
    }

    public function getTemplateName()
    {
        return "pagination.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 12,  79 => 11,  69 => 9,  60 => 8,  54 => 7,  47 => 6,  35 => 5,  30 => 4,  22 => 2,  19 => 1,);
    }
}
