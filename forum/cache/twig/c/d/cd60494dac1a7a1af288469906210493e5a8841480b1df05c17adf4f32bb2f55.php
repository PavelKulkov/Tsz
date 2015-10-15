<?php

/* notification_dropdown.html */
class __TwigTemplate_cd60494dac1a7a1af288469906210493e5a8841480b1df05c17adf4f32bb2f55 extends Twig_Template
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
        echo "<div id=\"notification_list\" class=\"dropdown dropdown-extended notification_list\">
\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t<div class=\"dropdown-contents\">
\t\t<div class=\"header\">
\t\t\t";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("NOTIFICATIONS");
        echo "
\t\t\t<span class=\"header_settings\">
\t\t\t\t<a href=\"";
        // line 7
        if (isset($context["U_NOTIFICATION_SETTINGS"])) { $_U_NOTIFICATION_SETTINGS_ = $context["U_NOTIFICATION_SETTINGS"]; } else { $_U_NOTIFICATION_SETTINGS_ = null; }
        echo $_U_NOTIFICATION_SETTINGS_;
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("SETTINGS");
        echo "</a>
\t\t\t\t";
        // line 8
        if (isset($context["NOTIFICATIONS_COUNT"])) { $_NOTIFICATIONS_COUNT_ = $context["NOTIFICATIONS_COUNT"]; } else { $_NOTIFICATIONS_COUNT_ = null; }
        if ($_NOTIFICATIONS_COUNT_) {
            // line 9
            echo "\t\t\t\t\t<span id=\"mark_all_notifications\"> &bull; <a href=\"";
            if (isset($context["U_MARK_ALL_NOTIFICATIONS"])) { $_U_MARK_ALL_NOTIFICATIONS_ = $context["U_MARK_ALL_NOTIFICATIONS"]; } else { $_U_MARK_ALL_NOTIFICATIONS_ = null; }
            echo $_U_MARK_ALL_NOTIFICATIONS_;
            echo "\" data-ajax=\"notification.mark_all_read\">";
            echo $this->env->getExtension('phpbb')->lang("MARK_ALL_READ");
            echo "</a></span>
\t\t\t\t";
        }
        // line 11
        echo "\t\t\t</span>
\t\t</div>

\t\t<ul>
\t\t\t";
        // line 15
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if ( !twig_length_filter($this->env, $this->getAttribute($_loops_, "notifications", array()))) {
            // line 16
            echo "\t\t\t\t<li class=\"no_notifications\">
\t\t\t\t\t";
            // line 17
            echo $this->env->getExtension('phpbb')->lang("NO_NOTIFICATIONS");
            echo "
\t\t\t\t</li>
\t\t\t";
        }
        // line 20
        echo "\t\t\t";
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "notifications", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["notifications"]) {
            // line 21
            echo "\t\t\t\t<li class=\"";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "UNREAD", array())) {
                echo " bg2";
            }
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "STYLING", array())) {
                echo " ";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "STYLING", array());
            }
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ( !$this->getAttribute($_notifications_, "URL", array())) {
                echo " no-url";
            }
            echo "\">
\t\t\t\t\t";
            // line 22
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "URL", array())) {
                // line 23
                echo "\t\t\t\t\t\t<a class=\"notification-block\" href=\"";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                if ($this->getAttribute($_notifications_, "UNREAD", array())) {
                    if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                    echo $this->getAttribute($_notifications_, "U_MARK_READ", array());
                    echo "\" data-real-url=\"";
                    if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                    echo $this->getAttribute($_notifications_, "URL", array());
                } else {
                    if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                    echo $this->getAttribute($_notifications_, "URL", array());
                }
                echo "\">
\t\t\t\t\t";
            }
            // line 25
            echo "\t\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "AVATAR", array())) {
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "AVATAR", array());
            } else {
                echo "<img src=\"";
                if (isset($context["T_THEME_PATH"])) { $_T_THEME_PATH_ = $context["T_THEME_PATH"]; } else { $_T_THEME_PATH_ = null; }
                echo $_T_THEME_PATH_;
                echo "/images/no_avatar.gif\" alt=\"\" />";
            }
            // line 26
            echo "\t\t\t\t\t\t<div class=\"notification_text\">
\t\t\t\t\t\t\t<p class=\"notification-title\">";
            // line 27
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            echo $this->getAttribute($_notifications_, "FORMATTED_TITLE", array());
            echo "</p>
\t\t\t\t\t\t\t";
            // line 28
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "REFERENCE", array())) {
                echo "<p class=\"notification-reference\">";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "REFERENCE", array());
                echo "</p>";
            }
            // line 29
            echo "\t\t\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "FORUM", array())) {
                echo "<p class=\"notification-forum\">";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "FORUM", array());
                echo "</p>";
            }
            // line 30
            echo "\t\t\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "REASON", array())) {
                echo "<p class=\"notification-reason\">";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "REASON", array());
                echo "</p>";
            }
            // line 31
            echo "\t\t\t\t\t\t\t<p class=\"notification-time\">";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            echo $this->getAttribute($_notifications_, "TIME", array());
            echo "</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
            // line 33
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "URL", array())) {
                echo "</a>";
            }
            // line 34
            echo "\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "UNREAD", array())) {
                // line 35
                echo "\t\t\t\t\t\t<a href=\"";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "U_MARK_READ", array());
                echo "\" class=\"mark_read icon-mark\" data-ajax=\"notification.mark_read\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("MARK_READ");
                echo "\"></a>
\t\t\t\t\t";
            }
            // line 37
            echo "\t\t\t\t</li>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notifications'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "\t\t</ul>

\t\t<div class=\"footer\">
\t\t\t<a href=\"";
        // line 42
        if (isset($context["U_VIEW_ALL_NOTIFICATIONS"])) { $_U_VIEW_ALL_NOTIFICATIONS_ = $context["U_VIEW_ALL_NOTIFICATIONS"]; } else { $_U_VIEW_ALL_NOTIFICATIONS_ = null; }
        echo $_U_VIEW_ALL_NOTIFICATIONS_;
        echo "\"><span>";
        echo $this->env->getExtension('phpbb')->lang("SEE_ALL");
        echo "</span></a>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "notification_dropdown.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 42,  188 => 39,  181 => 37,  172 => 35,  168 => 34,  163 => 33,  156 => 31,  147 => 30,  138 => 29,  130 => 28,  125 => 27,  122 => 26,  110 => 25,  94 => 23,  91 => 22,  73 => 21,  67 => 20,  61 => 17,  58 => 16,  55 => 15,  49 => 11,  40 => 9,  37 => 8,  30 => 7,  25 => 5,  19 => 1,);
    }
}
