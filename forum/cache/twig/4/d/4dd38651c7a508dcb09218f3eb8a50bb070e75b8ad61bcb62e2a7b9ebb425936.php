<?php

/* posting_layout.html */
class __TwigTemplate_4dd38651c7a508dcb09218f3eb8a50bb070e75b8ad61bcb62e2a7b9ebb425936 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "posting_layout.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        if (isset($context["TOPIC_TITLE"])) { $_TOPIC_TITLE_ = $context["TOPIC_TITLE"]; } else { $_TOPIC_TITLE_ = null; }
        if ($_TOPIC_TITLE_) {
            // line 4
            echo "\t<h2 class=\"posting-title\">";
            if (isset($context["posting_topic_title_before"])) { $_posting_topic_title_before_ = $context["posting_topic_title_before"]; } else { $_posting_topic_title_before_ = null; }
            echo "<a href=\"";
            if (isset($context["U_VIEW_TOPIC"])) { $_U_VIEW_TOPIC_ = $context["U_VIEW_TOPIC"]; } else { $_U_VIEW_TOPIC_ = null; }
            echo $_U_VIEW_TOPIC_;
            echo "\">";
            if (isset($context["TOPIC_TITLE"])) { $_TOPIC_TITLE_ = $context["TOPIC_TITLE"]; } else { $_TOPIC_TITLE_ = null; }
            echo $_TOPIC_TITLE_;
            echo "</a></h2>
";
        } else {
            // line 6
            echo "\t<h2 class=\"posting-title\"><a href=\"";
            if (isset($context["U_VIEW_FORUM"])) { $_U_VIEW_FORUM_ = $context["U_VIEW_FORUM"]; } else { $_U_VIEW_FORUM_ = null; }
            echo $_U_VIEW_FORUM_;
            echo "\">";
            if (isset($context["FORUM_NAME"])) { $_FORUM_NAME_ = $context["FORUM_NAME"]; } else { $_FORUM_NAME_ = null; }
            echo $_FORUM_NAME_;
            echo "</a></h2>
 ";
        }
        // line 8
        echo "
";
        // line 9
        if (isset($context["S_FORUM_RULES"])) { $_S_FORUM_RULES_ = $context["S_FORUM_RULES"]; } else { $_S_FORUM_RULES_ = null; }
        if ($_S_FORUM_RULES_) {
            // line 10
            echo "\t<div class=\"rules";
            if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
            if ($_U_FORUM_RULES_) {
                echo " rules-link";
            }
            echo "\">
\t\t<div class=\"inner\">
\t\t
\t\t";
            // line 13
            if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
            if ($_U_FORUM_RULES_) {
                // line 14
                echo "\t\t\t<a href=\"";
                if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
                echo $_U_FORUM_RULES_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
                echo "</a>
\t\t";
            } else {
                // line 16
                echo "\t\t\t<strong>";
                echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
                echo "</strong><br />
\t\t\t";
                // line 17
                if (isset($context["FORUM_RULES"])) { $_FORUM_RULES_ = $context["FORUM_RULES"]; } else { $_FORUM_RULES_ = null; }
                echo $_FORUM_RULES_;
                echo "
\t\t";
            }
            // line 19
            echo "\t\t
\t\t</div>
\t</div>
";
        }
        // line 23
        echo "
<form id=\"postform\" method=\"post\" action=\"";
        // line 24
        if (isset($context["S_POST_ACTION"])) { $_S_POST_ACTION_ = $context["S_POST_ACTION"]; } else { $_S_POST_ACTION_ = null; }
        echo $_S_POST_ACTION_;
        echo "\"";
        if (isset($context["S_FORM_ENCTYPE"])) { $_S_FORM_ENCTYPE_ = $context["S_FORM_ENCTYPE"]; } else { $_S_FORM_ENCTYPE_ = null; }
        echo $_S_FORM_ENCTYPE_;
        echo ">

";
        // line 26
        if (isset($context["S_DRAFT_LOADED"])) { $_S_DRAFT_LOADED_ = $context["S_DRAFT_LOADED"]; } else { $_S_DRAFT_LOADED_ = null; }
        if ($_S_DRAFT_LOADED_) {
            // line 27
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t
\t\t<h3>";
            // line 30
            echo $this->env->getExtension('phpbb')->lang("INFORMATION");
            echo "</h3>
\t\t<p>";
            // line 31
            echo $this->env->getExtension('phpbb')->lang("DRAFT_LOADED");
            echo "</p>
\t\t
\t\t</div>
\t</div>
";
        }
        // line 36
        echo "
";
        // line 37
        if (isset($context["S_SHOW_DRAFTS"])) { $_S_SHOW_DRAFTS_ = $context["S_SHOW_DRAFTS"]; } else { $_S_SHOW_DRAFTS_ = null; }
        if ($_S_SHOW_DRAFTS_) {
            $location = "drafts.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("drafts.html", "posting_layout.html", 37)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 38
        echo "
";
        // line 39
        if (isset($context["S_POST_REVIEW"])) { $_S_POST_REVIEW_ = $context["S_POST_REVIEW"]; } else { $_S_POST_REVIEW_ = null; }
        if ($_S_POST_REVIEW_) {
            $location = "posting_review.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_review.html", "posting_layout.html", 39)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 40
        echo "
";
        // line 41
        if (isset($context["S_UNGLOBALISE"])) { $_S_UNGLOBALISE_ = $context["S_UNGLOBALISE"]; } else { $_S_UNGLOBALISE_ = null; }
        if ($_S_UNGLOBALISE_) {
            // line 42
            echo "\t<div class=\"panel bg3\">
\t\t<div class=\"inner\">
\t\t<fieldset class=\"fields1\">
\t\t\t<h2>";
            // line 45
            echo $this->env->getExtension('phpbb')->lang("SELECT_DESTINATION_FORUM");
            echo "</h2>
\t\t\t<p>";
            // line 46
            echo $this->env->getExtension('phpbb')->lang("UNGLOBALISE_EXPLAIN");
            echo "</p>
\t\t\t<dl>
\t\t\t\t<dt><label for=\"to_forum_id\">";
            // line 48
            echo $this->env->getExtension('phpbb')->lang("MOVE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t\t<dd><select id=\"to_forum_id\" name=\"to_forum_id\">";
            // line 49
            if (isset($context["S_FORUM_SELECT"])) { $_S_FORUM_SELECT_ = $context["S_FORUM_SELECT"]; } else { $_S_FORUM_SELECT_ = null; }
            echo $_S_FORUM_SELECT_;
            echo "</select></dd>
\t\t\t</dl>
\t\t\t
\t\t\t<dl>
\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t<dd><input class=\"button1\" type=\"submit\" name=\"post\" value=\"";
            // line 54
            echo $this->env->getExtension('phpbb')->lang("CONFIRM");
            echo "\" /> <input class=\"button2\" type=\"submit\" name=\"cancel_unglobalise\" value=\"";
            echo $this->env->getExtension('phpbb')->lang("CANCEL");
            echo "\" /></dd>
\t\t\t</dl>
\t\t</fieldset>

\t\t</div>
\t</div>
";
        }
        // line 61
        echo "
";
        // line 62
        if (isset($context["S_DISPLAY_PREVIEW"])) { $_S_DISPLAY_PREVIEW_ = $context["S_DISPLAY_PREVIEW"]; } else { $_S_DISPLAY_PREVIEW_ = null; }
        if ($_S_DISPLAY_PREVIEW_) {
            $location = "posting_preview.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_preview.html", "posting_layout.html", 62)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 63
        echo "
<div class=\"panel\" id=\"postingbox\">
\t<div class=\"inner\">
\t
\t<h3>";
        // line 67
        echo $this->env->getExtension('phpbb')->lang("POST_A");
        echo "</h3>

\t";
        // line 69
        if (isset($context["EXTRA_POSTING_OPTIONS"])) { $_EXTRA_POSTING_OPTIONS_ = $context["EXTRA_POSTING_OPTIONS"]; } else { $_EXTRA_POSTING_OPTIONS_ = null; }
        $value = 1;
        $context['definition']->set('EXTRA_POSTING_OPTIONS', $value);
        // line 70
        echo "\t";
        $location = "posting_editor.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("posting_editor.html", "posting_layout.html", 70)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 71
        echo "\t<input type=\"hidden\" name=\"show_panel\" value=\"options-panel\" />
\t";
        // line 72
        if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
        echo $_S_FORM_TOKEN_;
        echo "
\t</div>
</div>

";
        // line 76
        if (isset($context["S_SHOW_ATTACH_BOX"])) { $_S_SHOW_ATTACH_BOX_ = $context["S_SHOW_ATTACH_BOX"]; } else { $_S_SHOW_ATTACH_BOX_ = null; }
        if ($_S_SHOW_ATTACH_BOX_) {
            $location = "posting_attach_body.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_attach_body.html", "posting_layout.html", 76)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 77
        echo "
";
        // line 78
        if (isset($context["S_SHOW_POLL_BOX"])) { $_S_SHOW_POLL_BOX_ = $context["S_SHOW_POLL_BOX"]; } else { $_S_SHOW_POLL_BOX_ = null; }
        if (isset($context["S_POLL_DELETE"])) { $_S_POLL_DELETE_ = $context["S_POLL_DELETE"]; } else { $_S_POLL_DELETE_ = null; }
        if (($_S_SHOW_POLL_BOX_ || $_S_POLL_DELETE_)) {
            $location = "posting_poll_body.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_poll_body.html", "posting_layout.html", 78)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 79
        echo "
";
        // line 80
        if (isset($context["posting_layout_include_panel_body"])) { $_posting_layout_include_panel_body_ = $context["posting_layout_include_panel_body"]; } else { $_posting_layout_include_panel_body_ = null; }
        // line 81
        echo "
";
        // line 82
        if (isset($context["S_DISPLAY_REVIEW"])) { $_S_DISPLAY_REVIEW_ = $context["S_DISPLAY_REVIEW"]; } else { $_S_DISPLAY_REVIEW_ = null; }
        if ($_S_DISPLAY_REVIEW_) {
            $location = "posting_topic_review.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("posting_topic_review.html", "posting_layout.html", 82)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 83
        echo "
</form>

";
        // line 86
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "posting_layout.html", 86)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "posting_layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  337 => 86,  332 => 83,  317 => 82,  314 => 81,  312 => 80,  309 => 79,  293 => 78,  290 => 77,  275 => 76,  267 => 72,  264 => 71,  251 => 70,  247 => 69,  242 => 67,  236 => 63,  221 => 62,  218 => 61,  206 => 54,  197 => 49,  192 => 48,  187 => 46,  183 => 45,  178 => 42,  175 => 41,  172 => 40,  157 => 39,  154 => 38,  139 => 37,  136 => 36,  128 => 31,  124 => 30,  119 => 27,  116 => 26,  107 => 24,  104 => 23,  98 => 19,  92 => 17,  87 => 16,  78 => 14,  75 => 13,  65 => 10,  62 => 9,  59 => 8,  49 => 6,  37 => 4,  34 => 3,  31 => 2,  19 => 1,);
    }
}
