<?php

/* overall_footer.html */
class __TwigTemplate_d08ed9975e1363a5cde419a7517b9cff8ddee4ee6344b3a8d30e1cdf61338b7e extends Twig_Template
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
        echo "\t\t";
        if (isset($context["overall_footer_content_after"])) { $_overall_footer_content_after_ = $context["overall_footer_content_after"]; } else { $_overall_footer_content_after_ = null; }
        // line 2
        echo "\t</div>

";
        // line 4
        if (isset($context["overall_footer_page_body_after"])) { $_overall_footer_page_body_after_ = $context["overall_footer_page_body_after"]; } else { $_overall_footer_page_body_after_ = null; }
        // line 5
        echo "
<div id=\"page-footer\" role=\"contentinfo\">
\t";
        // line 7
        $location = "navbar_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("navbar_footer.html", "overall_footer.html", 7)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 8
        echo "
\t<div class=\"copyright\">
\t\t";
        // line 10
        if (isset($context["overall_footer_copyright_prepend"])) { $_overall_footer_copyright_prepend_ = $context["overall_footer_copyright_prepend"]; } else { $_overall_footer_copyright_prepend_ = null; }
        // line 11
        echo "\t\t";
        if (isset($context["CREDIT_LINE"])) { $_CREDIT_LINE_ = $context["CREDIT_LINE"]; } else { $_CREDIT_LINE_ = null; }
        echo $_CREDIT_LINE_;
        echo "
\t\t";
        // line 12
        if (isset($context["TRANSLATION_INFO"])) { $_TRANSLATION_INFO_ = $context["TRANSLATION_INFO"]; } else { $_TRANSLATION_INFO_ = null; }
        if ($_TRANSLATION_INFO_) {
            echo "<br />";
            if (isset($context["TRANSLATION_INFO"])) { $_TRANSLATION_INFO_ = $context["TRANSLATION_INFO"]; } else { $_TRANSLATION_INFO_ = null; }
            echo $_TRANSLATION_INFO_;
        }
        // line 13
        echo "\t\t";
        if (isset($context["overall_footer_copyright_append"])) { $_overall_footer_copyright_append_ = $context["overall_footer_copyright_append"]; } else { $_overall_footer_copyright_append_ = null; }
        // line 14
        echo "\t\t";
        if (isset($context["DEBUG_OUTPUT"])) { $_DEBUG_OUTPUT_ = $context["DEBUG_OUTPUT"]; } else { $_DEBUG_OUTPUT_ = null; }
        if ($_DEBUG_OUTPUT_) {
            echo "<br />";
            if (isset($context["DEBUG_OUTPUT"])) { $_DEBUG_OUTPUT_ = $context["DEBUG_OUTPUT"]; } else { $_DEBUG_OUTPUT_ = null; }
            echo $_DEBUG_OUTPUT_;
        }
        // line 15
        echo "\t\t";
        if (isset($context["U_ACP"])) { $_U_ACP_ = $context["U_ACP"]; } else { $_U_ACP_ = null; }
        if ($_U_ACP_) {
            echo "<br /><strong><a href=\"";
            if (isset($context["U_ACP"])) { $_U_ACP_ = $context["U_ACP"]; } else { $_U_ACP_ = null; }
            echo $_U_ACP_;
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("ACP");
            echo "</a></strong>";
        }
        // line 16
        echo "\t</div>

\t<div id=\"darkenwrapper\" data-ajax-error-title=\"";
        // line 18
        echo $this->env->getExtension('phpbb')->lang("AJAX_ERROR_TITLE");
        echo "\" data-ajax-error-text=\"";
        echo $this->env->getExtension('phpbb')->lang("AJAX_ERROR_TEXT");
        echo "\" data-ajax-error-text-abort=\"";
        echo $this->env->getExtension('phpbb')->lang("AJAX_ERROR_TEXT_ABORT");
        echo "\" data-ajax-error-text-timeout=\"";
        echo $this->env->getExtension('phpbb')->lang("AJAX_ERROR_TEXT_TIMEOUT");
        echo "\" data-ajax-error-text-parsererror=\"";
        echo $this->env->getExtension('phpbb')->lang("AJAX_ERROR_TEXT_PARSERERROR");
        echo "\">
\t\t<div id=\"darken\">&nbsp;</div>
\t</div>

\t<div id=\"phpbb_alert\" class=\"phpbb_alert\" data-l-err=\"";
        // line 22
        echo $this->env->getExtension('phpbb')->lang("ERROR");
        echo "\" data-l-timeout-processing-req=\"";
        echo $this->env->getExtension('phpbb')->lang("TIMEOUT_PROCESSING_REQ");
        echo "\">
\t\t<a href=\"#\" class=\"alert_close\"></a>
\t\t<h3 class=\"alert_title\">&nbsp;</h3><p class=\"alert_text\"></p>
\t</div>
\t<div id=\"phpbb_confirm\" class=\"phpbb_alert\">
\t\t<a href=\"#\" class=\"alert_close\"></a>
\t\t<div class=\"alert_text\"></div>
\t</div>
</div>

</div>

<div>
\t<a id=\"bottom\" class=\"anchor\" accesskey=\"z\"></a>
\t";
        // line 36
        if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
        if ( !$_S_IS_BOT_) {
            if (isset($context["RUN_CRON_TASK"])) { $_RUN_CRON_TASK_ = $context["RUN_CRON_TASK"]; } else { $_RUN_CRON_TASK_ = null; }
            echo $_RUN_CRON_TASK_;
        }
        // line 37
        echo "</div>

<script type=\"text/javascript\" src=\"";
        // line 39
        if (isset($context["T_JQUERY_LINK"])) { $_T_JQUERY_LINK_ = $context["T_JQUERY_LINK"]; } else { $_T_JQUERY_LINK_ = null; }
        echo $_T_JQUERY_LINK_;
        echo "\"></script>
";
        // line 40
        if (isset($context["S_ALLOW_CDN"])) { $_S_ALLOW_CDN_ = $context["S_ALLOW_CDN"]; } else { $_S_ALLOW_CDN_ = null; }
        if ($_S_ALLOW_CDN_) {
            echo "<script type=\"text/javascript\">window.jQuery || document.write(unescape('%3Cscript src=\"";
            if (isset($context["T_ASSETS_PATH"])) { $_T_ASSETS_PATH_ = $context["T_ASSETS_PATH"]; } else { $_T_ASSETS_PATH_ = null; }
            echo $_T_ASSETS_PATH_;
            echo "/javascript/jquery.min.js?assets_version=";
            if (isset($context["T_ASSETS_VERSION"])) { $_T_ASSETS_VERSION_ = $context["T_ASSETS_VERSION"]; } else { $_T_ASSETS_VERSION_ = null; }
            echo $_T_ASSETS_VERSION_;
            echo "\" type=\"text/javascript\"%3E%3C/script%3E'));</script>";
        }
        // line 41
        echo "<script type=\"text/javascript\" src=\"";
        if (isset($context["T_ASSETS_PATH"])) { $_T_ASSETS_PATH_ = $context["T_ASSETS_PATH"]; } else { $_T_ASSETS_PATH_ = null; }
        echo $_T_ASSETS_PATH_;
        echo "/javascript/core.js?assets_version=";
        if (isset($context["T_ASSETS_VERSION"])) { $_T_ASSETS_VERSION_ = $context["T_ASSETS_VERSION"]; } else { $_T_ASSETS_VERSION_ = null; }
        echo $_T_ASSETS_VERSION_;
        echo "\"></script>
";
        // line 42
        $asset_file = "forum_fn.js";
        $asset = new \phpbb\template\asset($asset_file, $this->getEnvironment()->get_path_helper());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->getEnvironment()->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->getEnvironment()->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            $asset->add_assets_version('1');
            $asset_file = $asset->get_url();
            }
        }
        $context['definition']->append('SCRIPTS', '<script type="text/javascript" src="' . $asset_file. '"></script>

');
        // line 43
        $asset_file = "ajax.js";
        $asset = new \phpbb\template\asset($asset_file, $this->getEnvironment()->get_path_helper());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->getEnvironment()->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->getEnvironment()->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            $asset->add_assets_version('1');
            $asset_file = $asset->get_url();
            }
        }
        $context['definition']->append('SCRIPTS', '<script type="text/javascript" src="' . $asset_file. '"></script>

');
        // line 44
        echo "
";
        // line 45
        if (isset($context["overall_footer_after"])) { $_overall_footer_after_ = $context["overall_footer_after"]; } else { $_overall_footer_after_ = null; }
        // line 46
        echo "
";
        // line 47
        if (isset($context["S_PLUPLOAD"])) { $_S_PLUPLOAD_ = $context["S_PLUPLOAD"]; } else { $_S_PLUPLOAD_ = null; }
        if ($_S_PLUPLOAD_) {
            $location = "plupload.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("plupload.html", "overall_footer.html", 47)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 48
        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
        echo $this->getAttribute($_definition_, "SCRIPTS", array());
        echo "

";
        // line 50
        if (isset($context["overall_footer_body_after"])) { $_overall_footer_body_after_ = $context["overall_footer_body_after"]; } else { $_overall_footer_body_after_ = null; }
        // line 51
        echo "
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "overall_footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 51,  217 => 50,  211 => 48,  196 => 47,  193 => 46,  191 => 45,  188 => 44,  173 => 43,  158 => 42,  149 => 41,  138 => 40,  133 => 39,  129 => 37,  123 => 36,  104 => 22,  89 => 18,  85 => 16,  74 => 15,  66 => 14,  63 => 13,  56 => 12,  50 => 11,  48 => 10,  44 => 8,  32 => 7,  28 => 5,  26 => 4,  22 => 2,  19 => 1,);
    }
}
