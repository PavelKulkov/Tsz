<?php

/* jumpbox.html */
class __TwigTemplate_ccc6eff5eca4abc3123bb859a17d360bf02783f51c51fbc85311f390dbbc8c11 extends Twig_Template
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
";
        // line 2
        if (isset($context["S_VIEWTOPIC"])) { $_S_VIEWTOPIC_ = $context["S_VIEWTOPIC"]; } else { $_S_VIEWTOPIC_ = null; }
        if (isset($context["S_VIEWFORUM"])) { $_S_VIEWFORUM_ = $context["S_VIEWFORUM"]; } else { $_S_VIEWFORUM_ = null; }
        if (isset($context["SEARCH_TOPIC"])) { $_SEARCH_TOPIC_ = $context["SEARCH_TOPIC"]; } else { $_SEARCH_TOPIC_ = null; }
        if (isset($context["S_SEARCH_ACTION"])) { $_S_SEARCH_ACTION_ = $context["S_SEARCH_ACTION"]; } else { $_S_SEARCH_ACTION_ = null; }
        if ($_S_VIEWTOPIC_) {
            // line 3
            echo "\t<p class=\"jumpbox-return\"><a href=\"";
            if (isset($context["U_VIEW_FORUM"])) { $_U_VIEW_FORUM_ = $context["U_VIEW_FORUM"]; } else { $_U_VIEW_FORUM_ = null; }
            echo $_U_VIEW_FORUM_;
            echo "\" class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("RETURN_TO_FORUM");
            echo "</a></p>
";
        } elseif ($_S_VIEWFORUM_) {
            // line 5
            echo "\t<p class=\"jumpbox-return\"><a href=\"";
            if (isset($context["U_INDEX"])) { $_U_INDEX_ = $context["U_INDEX"]; } else { $_U_INDEX_ = null; }
            echo $_U_INDEX_;
            echo "\" class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("RETURN_TO_INDEX");
            echo "</a></p>
";
        } elseif ($_SEARCH_TOPIC_) {
            // line 7
            echo "\t<p class=\"jumpbox-return\"><a class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" href=\"";
            if (isset($context["U_SEARCH_TOPIC"])) { $_U_SEARCH_TOPIC_ = $context["U_SEARCH_TOPIC"]; } else { $_U_SEARCH_TOPIC_ = null; }
            echo $_U_SEARCH_TOPIC_;
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("RETURN_TO_TOPIC");
            echo "</a></p>
";
        } elseif ($_S_SEARCH_ACTION_) {
            // line 9
            echo "\t<p class=\"jumpbox-return\"><a class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" href=\"";
            if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
            echo $_U_SEARCH_;
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("GO_TO_SEARCH_ADV");
            echo "</a></p>
";
        }
        // line 11
        echo "
";
        // line 12
        if (isset($context["S_DISPLAY_JUMPBOX"])) { $_S_DISPLAY_JUMPBOX_ = $context["S_DISPLAY_JUMPBOX"]; } else { $_S_DISPLAY_JUMPBOX_ = null; }
        if ($_S_DISPLAY_JUMPBOX_) {
            // line 13
            echo "
\t<div class=\"dropdown-container dropdown-container-";
            // line 14
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            if (isset($context["S_IN_MCP"])) { $_S_IN_MCP_ = $context["S_IN_MCP"]; } else { $_S_IN_MCP_ = null; }
            if ( !$_S_IN_MCP_) {
                echo " dropdown-up";
            }
            echo " dropdown-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo " dropdown-button-control\" id=\"jumpbox\">
\t\t<span title=\"";
            // line 15
            if (isset($context["S_IN_MCP"])) { $_S_IN_MCP_ = $context["S_IN_MCP"]; } else { $_S_IN_MCP_ = null; }
            if (isset($context["S_MERGE_SELECT"])) { $_S_MERGE_SELECT_ = $context["S_MERGE_SELECT"]; } else { $_S_MERGE_SELECT_ = null; }
            if (($_S_IN_MCP_ && $_S_MERGE_SELECT_)) {
                echo $this->env->getExtension('phpbb')->lang("SELECT_TOPICS_FROM");
            } elseif ($_S_IN_MCP_) {
                echo $this->env->getExtension('phpbb')->lang("MODERATE_FORUM");
            } else {
                echo $this->env->getExtension('phpbb')->lang("JUMP_TO");
            }
            echo "\" class=\"dropdown-trigger button dropdown-select\">
\t\t\t";
            // line 16
            if (isset($context["S_IN_MCP"])) { $_S_IN_MCP_ = $context["S_IN_MCP"]; } else { $_S_IN_MCP_ = null; }
            if (isset($context["S_MERGE_SELECT"])) { $_S_MERGE_SELECT_ = $context["S_MERGE_SELECT"]; } else { $_S_MERGE_SELECT_ = null; }
            if (($_S_IN_MCP_ && $_S_MERGE_SELECT_)) {
                echo $this->env->getExtension('phpbb')->lang("SELECT_TOPICS_FROM");
            } elseif ($_S_IN_MCP_) {
                echo $this->env->getExtension('phpbb')->lang("MODERATE_FORUM");
            } else {
                echo $this->env->getExtension('phpbb')->lang("JUMP_TO");
            }
            // line 17
            echo "\t\t</span>
\t\t<div class=\"dropdown hidden\">
\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t<ul class=\"dropdown-contents\">
\t\t\t";
            // line 21
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "jumpbox_forums", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["jumpbox_forums"]) {
                // line 22
                echo "\t\t\t\t";
                if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                if (($this->getAttribute($_jumpbox_forums_, "FORUM_ID", array()) !=  -1)) {
                    // line 23
                    echo "\t\t\t\t\t<li>";
                    if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($_jumpbox_forums_, "level", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["level"]) {
                        echo "&nbsp; &nbsp;";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['level'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    echo "<a href=\"";
                    if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                    echo $this->getAttribute($_jumpbox_forums_, "LINK", array());
                    echo "\">";
                    if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                    echo $this->getAttribute($_jumpbox_forums_, "FORUM_NAME", array());
                    echo "</a></li>
\t\t\t\t";
                }
                // line 25
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['jumpbox_forums'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "\t\t\t</ul>
\t\t</div>
\t</div>

";
        } else {
            // line 31
            echo "\t<br /><br />
";
        }
    }

    public function getTemplateName()
    {
        return "jumpbox.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 31,  162 => 26,  156 => 25,  136 => 23,  132 => 22,  127 => 21,  121 => 17,  111 => 16,  99 => 15,  87 => 14,  84 => 13,  81 => 12,  78 => 11,  64 => 9,  52 => 7,  40 => 5,  28 => 3,  22 => 2,  19 => 1,);
    }
}
