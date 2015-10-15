<?php

/* posting_attach_body.html */
class __TwigTemplate_6162a32014bc548ada1b1c273abc4ca72223cb5c494bafafe2247bf871f4dd19 extends Twig_Template
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
        echo "<div class=\"panel bg3 panel-container\" id=\"attach-panel\">
\t<div class=\"inner\">

\t<p>";
        // line 4
        echo $this->env->getExtension('phpbb')->lang("ADD_ATTACHMENT_EXPLAIN");
        echo " <span class=\"hidden\" id=\"drag-n-drop-message\">";
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_DRAG_TEXTAREA");
        echo "</span></p>
\t
\t<fieldset class=\"fields2\" id=\"attach-panel-basic\">
\t<dl>
\t\t<dt><label for=\"fileupload\">";
        // line 8
        echo $this->env->getExtension('phpbb')->lang("FILENAME");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t<input type=\"file\" name=\"fileupload\" id=\"fileupload\" maxlength=\"";
        // line 10
        if (isset($context["FILESIZE"])) { $_FILESIZE_ = $context["FILESIZE"]; } else { $_FILESIZE_ = null; }
        echo $_FILESIZE_;
        echo "\" value=\"\" class=\"inputbox autowidth\" /> 
\t\t\t<input type=\"submit\" name=\"add_file\" value=\"";
        // line 11
        echo $this->env->getExtension('phpbb')->lang("ADD_FILE");
        echo "\" class=\"button2\" onclick=\"upload = true;\" />
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"filecomment\">";
        // line 15
        echo $this->env->getExtension('phpbb')->lang("FILE_COMMENT");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd><textarea name=\"filecomment\" id=\"filecomment\" rows=\"1\" cols=\"40\" class=\"inputbox autowidth\">";
        // line 16
        if (isset($context["FILE_COMMENT"])) { $_FILE_COMMENT_ = $context["FILE_COMMENT"]; } else { $_FILE_COMMENT_ = null; }
        echo $_FILE_COMMENT_;
        echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<div id=\"attach-panel-multi\">
\t\t<input type=\"button\" class=\"button2\" value=\"";
        // line 21
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_ADD_FILES");
        echo "\" id=\"add_files\" />
\t</div>

\t<div class=\"panel";
        // line 24
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if ( !twig_length_filter($this->env, $this->getAttribute($_loops_, "attach_row", array()))) {
            echo " hidden";
        }
        echo "\" id=\"file-list-container\">
\t\t<div class=\"inner\">
\t\t\t<table class=\"table1 zebra-list fixed-width-table\">
\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th class=\"attach-name\">";
        // line 29
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_FILENAME");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-comment\">";
        // line 30
        echo $this->env->getExtension('phpbb')->lang("FILE_COMMENT");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-filesize\">";
        // line 31
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_SIZE");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-status\">";
        // line 32
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_STATUS");
        echo "</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody class=\"responsive-skip-empty\" id=\"file-list\">
\t\t\t\t\t<tr class=\"attach-row\" id=\"attach-row-tpl\">
\t\t\t\t\t\t\t<td class=\"attach-name\">
\t\t\t\t\t\t\t\t<span class=\"file-name ellipsis-text\"></span>
\t\t\t\t\t\t\t\t<span class=\"attach-controls\">
\t\t\t\t\t\t\t\t\t<input type=\"button\" value=\"";
        // line 40
        echo $this->env->getExtension('phpbb')->lang("PLACE_INLINE");
        echo "\" class=\"button2 hidden file-inline-bbcode\" />&nbsp;
\t\t\t\t\t\t\t\t\t<input type=\"button\" value=\"";
        // line 41
        echo $this->env->getExtension('phpbb')->lang("DELETE_FILE");
        echo "\" class=\"button2 file-delete\" />
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"clear\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-comment\">
\t\t\t\t\t\t\t\t<textarea rows=\"1\" cols=\"30\" class=\"inputbox\"></textarea>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-filesize\">
\t\t\t\t\t\t\t\t<span class=\"file-size\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-status\">
\t\t\t\t\t\t\t\t<span class=\"file-progress\">
\t\t\t\t\t\t\t\t\t<span class=\"file-progress-bar\"></span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"file-status\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
        // line 58
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "attach_row", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["attach_row"]) {
            // line 59
            echo "\t\t\t\t\t\t<tr class=\"attach-row\" data-attach-id=\"";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "ATTACH_ID", array());
            echo "\">
\t\t\t\t\t\t\t<td class=\"attach-name\">
\t\t\t\t\t\t\t\t<span class=\"file-name ellipsis-text\"><a href=\"";
            // line 61
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "U_VIEW_ATTACHMENT", array());
            echo "\">";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "FILENAME", array());
            echo "</a></span>
\t\t\t\t\t\t\t\t<span class=\"attach-controls\">
\t\t\t\t\t\t\t\t\t";
            // line 63
            if (isset($context["S_INLINE_ATTACHMENT_OPTIONS"])) { $_S_INLINE_ATTACHMENT_OPTIONS_ = $context["S_INLINE_ATTACHMENT_OPTIONS"]; } else { $_S_INLINE_ATTACHMENT_OPTIONS_ = null; }
            if ($_S_INLINE_ATTACHMENT_OPTIONS_) {
                echo "<input type=\"button\" value=\"";
                echo $this->env->getExtension('phpbb')->lang("PLACE_INLINE");
                echo "\" class=\"button2 file-inline-bbcode\" />&nbsp; ";
            }
            // line 64
            echo "\t\t\t\t\t\t\t\t\t<input type=\"submit\" name=\"delete_file[";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "ASSOC_INDEX", array());
            echo "]\" value=\"";
            echo $this->env->getExtension('phpbb')->lang("DELETE_FILE");
            echo "\" class=\"button2 file-delete\" />
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"clear\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-comment\">
\t\t\t\t\t\t\t\t<textarea name=\"comment_list[";
            // line 69
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "ASSOC_INDEX", array());
            echo "]\" rows=\"1\" cols=\"30\" class=\"inputbox\">";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "FILE_COMMENT", array());
            echo "</textarea>
\t\t\t\t\t\t\t\t";
            // line 70
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "S_HIDDEN", array());
            echo "
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-filesize\">
\t\t\t\t\t\t\t\t<span class=\"file-size\">";
            // line 73
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "FILESIZE", array());
            echo "</span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-status\">
\t\t\t\t\t\t\t\t<span class=\"file-status file-uploaded\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attach_row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "posting_attach_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 80,  184 => 73,  177 => 70,  169 => 69,  157 => 64,  150 => 63,  141 => 61,  134 => 59,  129 => 58,  109 => 41,  105 => 40,  94 => 32,  90 => 31,  86 => 30,  82 => 29,  71 => 24,  65 => 21,  56 => 16,  51 => 15,  44 => 11,  39 => 10,  33 => 8,  24 => 4,  19 => 1,);
    }
}
