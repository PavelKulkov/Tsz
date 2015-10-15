<?php

/* viewtopic_body.html */
class __TwigTemplate_ca6e5c3b2d63e763c27df121e1fdd4cb9eecdf34febf742179cb11e7bb8bf820 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "viewtopic_body.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2 class=\"topic-title\">";
        // line 3
        if (isset($context["viewtopic_topic_title_prepend"])) { $_viewtopic_topic_title_prepend_ = $context["viewtopic_topic_title_prepend"]; } else { $_viewtopic_topic_title_prepend_ = null; }
        echo "<a href=\"";
        if (isset($context["U_VIEW_TOPIC"])) { $_U_VIEW_TOPIC_ = $context["U_VIEW_TOPIC"]; } else { $_U_VIEW_TOPIC_ = null; }
        echo $_U_VIEW_TOPIC_;
        echo "\">";
        if (isset($context["TOPIC_TITLE"])) { $_TOPIC_TITLE_ = $context["TOPIC_TITLE"]; } else { $_TOPIC_TITLE_ = null; }
        echo $_TOPIC_TITLE_;
        echo "</a>";
        if (isset($context["viewtopic_topic_title_append"])) { $_viewtopic_topic_title_append_ = $context["viewtopic_topic_title_append"]; } else { $_viewtopic_topic_title_append_ = null; }
        echo "</h2>
<!-- NOTE: remove the style=\"display: none\" when you want to have the forum description on the topic body -->
";
        // line 5
        if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
        if ($_FORUM_DESC_) {
            echo "<div style=\"display: none !important;\">";
            if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
            echo $_FORUM_DESC_;
            echo "<br /></div>";
        }
        // line 6
        echo "
";
        // line 7
        if (isset($context["MODERATORS"])) { $_MODERATORS_ = $context["MODERATORS"]; } else { $_MODERATORS_ = null; }
        if ($_MODERATORS_) {
            // line 8
            echo "<p>
\t<strong>";
            // line 9
            if (isset($context["S_SINGLE_MODERATOR"])) { $_S_SINGLE_MODERATOR_ = $context["S_SINGLE_MODERATOR"]; } else { $_S_SINGLE_MODERATOR_ = null; }
            if ($_S_SINGLE_MODERATOR_) {
                echo $this->env->getExtension('phpbb')->lang("MODERATOR");
            } else {
                echo $this->env->getExtension('phpbb')->lang("MODERATORS");
            }
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</strong> ";
            if (isset($context["MODERATORS"])) { $_MODERATORS_ = $context["MODERATORS"]; } else { $_MODERATORS_ = null; }
            echo $_MODERATORS_;
            echo "
</p>
";
        }
        // line 12
        echo "
";
        // line 13
        if (isset($context["S_FORUM_RULES"])) { $_S_FORUM_RULES_ = $context["S_FORUM_RULES"]; } else { $_S_FORUM_RULES_ = null; }
        if ($_S_FORUM_RULES_) {
            // line 14
            echo "\t<div class=\"rules";
            if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
            if ($_U_FORUM_RULES_) {
                echo " rules-link";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t";
            // line 17
            if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
            if ($_U_FORUM_RULES_) {
                // line 18
                echo "\t\t\t<a href=\"";
                if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
                echo $_U_FORUM_RULES_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
                echo "</a>
\t\t";
            } else {
                // line 20
                echo "\t\t\t<strong>";
                echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
                echo "</strong><br />
\t\t\t";
                // line 21
                if (isset($context["FORUM_RULES"])) { $_FORUM_RULES_ = $context["FORUM_RULES"]; } else { $_FORUM_RULES_ = null; }
                echo $_FORUM_RULES_;
                echo "
\t\t";
            }
            // line 23
            echo "
\t\t</div>
\t</div>
";
        }
        // line 27
        echo "
<div class=\"action-bar top\">

\t<div class=\"buttons\">
\t\t";
        // line 31
        if (isset($context["viewtopic_buttons_top_before"])) { $_viewtopic_buttons_top_before_ = $context["viewtopic_buttons_top_before"]; } else { $_viewtopic_buttons_top_before_ = null; }
        // line 32
        echo "
\t";
        // line 33
        if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
        if (isset($context["S_DISPLAY_REPLY_INFO"])) { $_S_DISPLAY_REPLY_INFO_ = $context["S_DISPLAY_REPLY_INFO"]; } else { $_S_DISPLAY_REPLY_INFO_ = null; }
        if (( !$_S_IS_BOT_ && $_S_DISPLAY_REPLY_INFO_)) {
            // line 34
            echo "\t\t<a href=\"";
            if (isset($context["U_POST_REPLY_TOPIC"])) { $_U_POST_REPLY_TOPIC_ = $context["U_POST_REPLY_TOPIC"]; } else { $_U_POST_REPLY_TOPIC_ = null; }
            echo $_U_POST_REPLY_TOPIC_;
            echo "\" class=\"button icon-button ";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo "locked-icon";
            } else {
                echo "reply-icon";
            }
            echo "\" title=\"";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("POST_REPLY");
            }
            echo "\">
\t\t\t";
            // line 35
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_POST_REPLY");
            }
            // line 36
            echo "\t\t</a>
\t";
        }
        // line 38
        echo "
\t\t";
        // line 39
        if (isset($context["viewtopic_buttons_top_after"])) { $_viewtopic_buttons_top_after_ = $context["viewtopic_buttons_top_after"]; } else { $_viewtopic_buttons_top_after_ = null; }
        // line 40
        echo "\t</div>

\t";
        // line 42
        $location = "viewtopic_topic_tools.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("viewtopic_topic_tools.html", "viewtopic_body.html", 42)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 43
        echo "\t";
        if (isset($context["viewtopic_dropdown_top_custom"])) { $_viewtopic_dropdown_top_custom_ = $context["viewtopic_dropdown_top_custom"]; } else { $_viewtopic_dropdown_top_custom_ = null; }
        // line 44
        echo "
\t";
        // line 45
        if (isset($context["S_DISPLAY_SEARCHBOX"])) { $_S_DISPLAY_SEARCHBOX_ = $context["S_DISPLAY_SEARCHBOX"]; } else { $_S_DISPLAY_SEARCHBOX_ = null; }
        if ($_S_DISPLAY_SEARCHBOX_) {
            // line 46
            echo "\t\t<div class=\"search-box\" role=\"search\">
\t\t\t<form method=\"get\" id=\"topic-search\" action=\"";
            // line 47
            if (isset($context["S_SEARCHBOX_ACTION"])) { $_S_SEARCHBOX_ACTION_ = $context["S_SEARCHBOX_ACTION"]; } else { $_S_SEARCHBOX_ACTION_ = null; }
            echo $_S_SEARCHBOX_ACTION_;
            echo "\">
\t\t\t<fieldset>
\t\t\t\t<input class=\"inputbox search tiny\"  type=\"search\" name=\"keywords\" id=\"search_keywords\" size=\"20\" placeholder=\"";
            // line 49
            echo $this->env->getExtension('phpbb')->lang("SEARCH_TOPIC");
            echo "\" />
\t\t\t\t<button class=\"button icon-button search-icon\" type=\"submit\" title=\"";
            // line 50
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "</button>
\t\t\t\t<a href=\"";
            // line 51
            if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
            echo $_U_SEARCH_;
            echo "\" class=\"button icon-button search-adv-icon\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "</a>
\t\t\t\t";
            // line 52
            if (isset($context["S_SEARCH_LOCAL_HIDDEN_FIELDS"])) { $_S_SEARCH_LOCAL_HIDDEN_FIELDS_ = $context["S_SEARCH_LOCAL_HIDDEN_FIELDS"]; } else { $_S_SEARCH_LOCAL_HIDDEN_FIELDS_ = null; }
            echo $_S_SEARCH_LOCAL_HIDDEN_FIELDS_;
            echo "
\t\t\t</fieldset>
\t\t\t</form>
\t\t</div>
\t";
        }
        // line 57
        echo "
\t";
        // line 58
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
        if ((twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array())) || $_TOTAL_POSTS_)) {
            // line 59
            echo "\t\t<div class=\"pagination\">
\t\t\t";
            // line 60
            if (isset($context["U_VIEW_UNREAD_POST"])) { $_U_VIEW_UNREAD_POST_ = $context["U_VIEW_UNREAD_POST"]; } else { $_U_VIEW_UNREAD_POST_ = null; }
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (($_U_VIEW_UNREAD_POST_ &&  !$_S_IS_BOT_)) {
                echo "<a href=\"";
                if (isset($context["U_VIEW_UNREAD_POST"])) { $_U_VIEW_UNREAD_POST_ = $context["U_VIEW_UNREAD_POST"]; } else { $_U_VIEW_UNREAD_POST_ = null; }
                echo $_U_VIEW_UNREAD_POST_;
                echo "\" class=\"mark\">";
                echo $this->env->getExtension('phpbb')->lang("VIEW_UNREAD_POST");
                echo "</a> &bull; ";
            }
            if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
            echo $_TOTAL_POSTS_;
            echo "
\t\t\t";
            // line 61
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array()))) {
                // line 62
                echo "\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "viewtopic_body.html", 62)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 63
                echo "\t\t\t";
            } else {
                // line 64
                echo "\t\t\t\t&bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t\t";
            }
            // line 66
            echo "\t\t</div>
\t";
        }
        // line 68
        echo "\t";
        if (isset($context["viewtopic_body_pagination_top_after"])) { $_viewtopic_body_pagination_top_after_ = $context["viewtopic_body_pagination_top_after"]; } else { $_viewtopic_body_pagination_top_after_ = null; }
        // line 69
        echo "</div>

";
        // line 71
        if (isset($context["viewtopic_body_poll_before"])) { $_viewtopic_body_poll_before_ = $context["viewtopic_body_poll_before"]; } else { $_viewtopic_body_poll_before_ = null; }
        // line 72
        echo "
";
        // line 73
        if (isset($context["S_HAS_POLL"])) { $_S_HAS_POLL_ = $context["S_HAS_POLL"]; } else { $_S_HAS_POLL_ = null; }
        if ($_S_HAS_POLL_) {
            // line 74
            echo "\t<form method=\"post\" action=\"";
            if (isset($context["S_POLL_ACTION"])) { $_S_POLL_ACTION_ = $context["S_POLL_ACTION"]; } else { $_S_POLL_ACTION_ = null; }
            echo $_S_POLL_ACTION_;
            echo "\" data-ajax=\"vote_poll\" class=\"topic_poll\">

\t<div class=\"panel\">
\t\t<div class=\"inner\">

\t\t<div class=\"content\">
\t\t\t<h2 class=\"poll-title\">";
            // line 80
            if (isset($context["viewtopic_body_poll_question_prepend"])) { $_viewtopic_body_poll_question_prepend_ = $context["viewtopic_body_poll_question_prepend"]; } else { $_viewtopic_body_poll_question_prepend_ = null; }
            if (isset($context["POLL_QUESTION"])) { $_POLL_QUESTION_ = $context["POLL_QUESTION"]; } else { $_POLL_QUESTION_ = null; }
            echo $_POLL_QUESTION_;
            if (isset($context["viewtopic_body_poll_question_append"])) { $_viewtopic_body_poll_question_append_ = $context["viewtopic_body_poll_question_append"]; } else { $_viewtopic_body_poll_question_append_ = null; }
            echo "</h2>
\t\t\t<p class=\"author\">";
            // line 81
            echo $this->env->getExtension('phpbb')->lang("POLL_LENGTH");
            if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
            if (isset($context["L_POLL_LENGTH"])) { $_L_POLL_LENGTH_ = $context["L_POLL_LENGTH"]; } else { $_L_POLL_LENGTH_ = null; }
            if (($_S_CAN_VOTE_ && $_L_POLL_LENGTH_)) {
                echo "<br />";
            }
            if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
            if ($_S_CAN_VOTE_) {
                echo "<span class=\"poll_max_votes\">";
                echo $this->env->getExtension('phpbb')->lang("MAX_VOTES");
                echo "</span>";
            }
            echo "</p>

\t\t\t<fieldset class=\"polls\">
\t\t\t";
            // line 84
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "poll_option", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["poll_option"]) {
                // line 85
                echo "\t\t\t\t";
                if (isset($context["viewtopic_body_poll_option_before"])) { $_viewtopic_body_poll_option_before_ = $context["viewtopic_body_poll_option_before"]; } else { $_viewtopic_body_poll_option_before_ = null; }
                // line 86
                echo "\t\t\t\t<dl class=\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED", array())) {
                    echo "voted";
                }
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if ($this->getAttribute($_poll_option_, "POLL_OPTION_MOST_VOTES", array())) {
                    echo " most-votes";
                }
                echo "\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED", array())) {
                    echo " title=\"";
                    echo $this->env->getExtension('phpbb')->lang("POLL_VOTED_OPTION");
                    echo "\"";
                }
                echo " data-poll-option-id=\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID", array());
                echo "\">
\t\t\t\t\t<dt>";
                // line 87
                if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
                if ($_S_CAN_VOTE_) {
                    echo "<label for=\"vote_";
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID", array());
                    echo "\">";
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_CAPTION", array());
                    echo "</label>";
                } else {
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_CAPTION", array());
                }
                echo "</dt>
\t\t\t\t\t";
                // line 88
                if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
                if ($_S_CAN_VOTE_) {
                    echo "<dd style=\"width: auto;\" class=\"poll_option_select\">";
                    if (isset($context["S_IS_MULTI_CHOICE"])) { $_S_IS_MULTI_CHOICE_ = $context["S_IS_MULTI_CHOICE"]; } else { $_S_IS_MULTI_CHOICE_ = null; }
                    if ($_S_IS_MULTI_CHOICE_) {
                        echo "<input type=\"checkbox\" name=\"vote_id[]\" id=\"vote_";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID", array());
                        echo "\" value=\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID", array());
                        echo "\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED", array())) {
                            echo " checked=\"checked\"";
                        }
                        echo " />";
                    } else {
                        echo "<input type=\"radio\" name=\"vote_id[]\" id=\"vote_";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID", array());
                        echo "\" value=\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID", array());
                        echo "\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED", array())) {
                            echo " checked=\"checked\"";
                        }
                        echo " />";
                    }
                    echo "</dd>";
                }
                // line 89
                echo "\t\t\t\t\t<dd class=\"resultbar";
                if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
                if ( !$_S_DISPLAY_RESULTS_) {
                    echo " hidden";
                }
                echo "\"><div class=\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT", array()) < 20)) {
                    echo "pollbar1";
                } elseif (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT", array()) < 40)) {
                    echo "pollbar2";
                } elseif (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT", array()) < 60)) {
                    echo "pollbar3";
                } elseif (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT", array()) < 80)) {
                    echo "pollbar4";
                } else {
                    echo "pollbar5";
                }
                echo "\" style=\"width:";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                echo $this->getAttribute($_poll_option_, "POLL_OPTION_PERCENT_REL", array());
                echo ";\">";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                echo $this->getAttribute($_poll_option_, "POLL_OPTION_RESULT", array());
                echo "</div></dd>
\t\t\t\t\t<dd class=\"poll_option_percent";
                // line 90
                if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
                if ( !$_S_DISPLAY_RESULTS_) {
                    echo " hidden";
                }
                echo "\">";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if (($this->getAttribute($_poll_option_, "POLL_OPTION_RESULT", array()) == 0)) {
                    echo $this->env->getExtension('phpbb')->lang("NO_VOTES");
                } else {
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_PERCENT", array());
                }
                echo "</dd>
\t\t\t\t</dl>
\t\t\t\t";
                // line 92
                if (isset($context["viewtopic_body_poll_option_after"])) { $_viewtopic_body_poll_option_after_ = $context["viewtopic_body_poll_option_after"]; } else { $_viewtopic_body_poll_option_after_ = null; }
                // line 93
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['poll_option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 94
            echo "
\t\t\t\t<dl class=\"poll_total_votes";
            // line 95
            if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
            if ( !$_S_DISPLAY_RESULTS_) {
                echo " hidden";
            }
            echo "\">
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd class=\"resultbar\">";
            // line 97
            echo $this->env->getExtension('phpbb')->lang("TOTAL_VOTES");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <span class=\"poll_total_vote_cnt\">";
            if (isset($context["TOTAL_VOTES"])) { $_TOTAL_VOTES_ = $context["TOTAL_VOTES"]; } else { $_TOTAL_VOTES_ = null; }
            echo $_TOTAL_VOTES_;
            echo "</span></dd>
\t\t\t\t</dl>

\t\t\t";
            // line 100
            if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
            if ($_S_CAN_VOTE_) {
                // line 101
                echo "\t\t\t\t<dl style=\"border-top: none;\" class=\"poll_vote\">
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd class=\"resultbar\"><input type=\"submit\" name=\"update\" value=\"";
                // line 103
                echo $this->env->getExtension('phpbb')->lang("SUBMIT_VOTE");
                echo "\" class=\"button1\" /></dd>
\t\t\t\t</dl>
\t\t\t";
            }
            // line 106
            echo "
\t\t\t";
            // line 107
            if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
            if ( !$_S_DISPLAY_RESULTS_) {
                // line 108
                echo "\t\t\t\t<dl style=\"border-top: none;\" class=\"poll_view_results\">
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd class=\"resultbar\"><a href=\"";
                // line 110
                if (isset($context["U_VIEW_RESULTS"])) { $_U_VIEW_RESULTS_ = $context["U_VIEW_RESULTS"]; } else { $_U_VIEW_RESULTS_ = null; }
                echo $_U_VIEW_RESULTS_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("VIEW_RESULTS");
                echo "</a></dd>
\t\t\t\t</dl>
\t\t\t";
            }
            // line 113
            echo "\t\t\t</fieldset>
\t\t\t<div class=\"vote-submitted hidden\">";
            // line 114
            echo $this->env->getExtension('phpbb')->lang("VOTE_SUBMITTED");
            echo "</div>
\t\t</div>

\t\t</div>
\t\t";
            // line 118
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t\t";
            // line 119
            if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
            echo $_S_HIDDEN_FIELDS_;
            echo "
\t</div>

\t</form>
\t<hr />
";
        }
        // line 125
        echo "
";
        // line 126
        if (isset($context["viewtopic_body_poll_after"])) { $_viewtopic_body_poll_after_ = $context["viewtopic_body_poll_after"]; } else { $_viewtopic_body_poll_after_ = null; }
        // line 127
        echo "
";
        // line 128
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "postrow", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["postrow"]) {
            // line 129
            echo "\t";
            if (isset($context["viewtopic_body_postrow_post_before"])) { $_viewtopic_body_postrow_post_before_ = $context["viewtopic_body_postrow_post_before"]; } else { $_viewtopic_body_postrow_post_before_ = null; }
            // line 130
            echo "\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_FIRST_UNREAD", array())) {
                // line 131
                echo "\t\t<a id=\"unread\" class=\"anchor\"";
                if (isset($context["S_UNREAD_VIEW"])) { $_S_UNREAD_VIEW_ = $context["S_UNREAD_VIEW"]; } else { $_S_UNREAD_VIEW_ = null; }
                if ($_S_UNREAD_VIEW_) {
                    echo " data-url=\"";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "U_MINI_POST", array());
                    echo "\"";
                }
                echo "></a>
\t";
            }
            // line 133
            echo "\t<div id=\"p";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID", array());
            echo "\" class=\"post has-profile ";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "S_ROW_COUNT", array()) % 2 == 1)) {
                echo "bg1";
            } else {
                echo "bg2";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_UNREAD_POST", array())) {
                echo " unreadpost";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_REPORTED", array())) {
                echo " reported";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_DELETED", array())) {
                echo " deleted";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "S_ONLINE", array()) &&  !$this->getAttribute($_postrow_, "S_POST_HIDDEN", array()))) {
                echo " online";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_WARNINGS", array())) {
                echo " warned";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t<dl class=\"postprofile\" id=\"profile";
            // line 136
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID", array());
            echo "\"";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_HIDDEN", array())) {
                echo " style=\"display: none;\"";
            }
            echo ">
\t\t\t<dt class=\"";
            // line 137
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "RANK_TITLE", array()) || $this->getAttribute($_postrow_, "RANK_IMG", array()))) {
                echo "has-profile-rank";
            } else {
                echo "no-profile-rank";
            }
            echo " ";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_AVATAR", array())) {
                echo "has-avatar";
            } else {
                echo "no-avatar";
            }
            echo "\">
\t\t\t\t<div class=\"avatar-container\">
\t\t\t\t\t";
            // line 139
            if (isset($context["viewtopic_body_avatar_before"])) { $_viewtopic_body_avatar_before_ = $context["viewtopic_body_avatar_before"]; } else { $_viewtopic_body_avatar_before_ = null; }
            // line 140
            echo "\t\t\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_AVATAR", array())) {
                // line 141
                echo "\t\t\t\t\t\t";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "U_POST_AUTHOR", array())) {
                    echo "<a href=\"";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "U_POST_AUTHOR", array());
                    echo "\" class=\"avatar\">";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POSTER_AVATAR", array());
                    echo "</a>";
                } else {
                    echo "<span class=\"avatar\">";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POSTER_AVATAR", array());
                    echo "</span>";
                }
                // line 142
                echo "\t\t\t\t\t";
            }
            // line 143
            echo "\t\t\t\t\t";
            if (isset($context["viewtopic_body_avatar_after"])) { $_viewtopic_body_avatar_after_ = $context["viewtopic_body_avatar_after"]; } else { $_viewtopic_body_avatar_after_ = null; }
            // line 144
            echo "\t\t\t\t</div>
\t\t\t\t";
            // line 145
            if (isset($context["viewtopic_body_post_author_before"])) { $_viewtopic_body_post_author_before_ = $context["viewtopic_body_post_author_before"]; } else { $_viewtopic_body_post_author_before_ = null; }
            // line 146
            echo "\t\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ( !$this->getAttribute($_postrow_, "U_POST_AUTHOR", array())) {
                echo "<strong>";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_AUTHOR_FULL", array());
                echo "</strong>";
            } else {
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_AUTHOR_FULL", array());
            }
            // line 147
            echo "\t\t\t\t";
            if (isset($context["viewtopic_body_post_author_after"])) { $_viewtopic_body_post_author_after_ = $context["viewtopic_body_post_author_after"]; } else { $_viewtopic_body_post_author_after_ = null; }
            // line 148
            echo "\t\t\t</dt>

\t\t\t";
            // line 150
            if (isset($context["viewtopic_body_postrow_rank_before"])) { $_viewtopic_body_postrow_rank_before_ = $context["viewtopic_body_postrow_rank_before"]; } else { $_viewtopic_body_postrow_rank_before_ = null; }
            // line 151
            echo "\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "RANK_TITLE", array()) || $this->getAttribute($_postrow_, "RANK_IMG", array()))) {
                echo "<dd class=\"profile-rank\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "RANK_TITLE", array());
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if (($this->getAttribute($_postrow_, "RANK_TITLE", array()) && $this->getAttribute($_postrow_, "RANK_IMG", array()))) {
                    echo "<br />";
                }
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "RANK_IMG", array());
                echo "</dd>";
            }
            // line 152
            echo "\t\t\t";
            if (isset($context["viewtopic_body_postrow_rank_after"])) { $_viewtopic_body_postrow_rank_after_ = $context["viewtopic_body_postrow_rank_after"]; } else { $_viewtopic_body_postrow_rank_after_ = null; }
            // line 153
            echo "
\t\t";
            // line 154
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "POSTER_POSTS", array()) != "")) {
                echo "<dd class=\"profile-posts\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("POSTS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if (($this->getAttribute($_postrow_, "U_SEARCH", array()) !== "")) {
                    echo "<a href=\"";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "U_SEARCH", array());
                    echo "\">";
                }
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POSTER_POSTS", array());
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if (($this->getAttribute($_postrow_, "U_SEARCH", array()) !== "")) {
                    echo "</a>";
                }
                echo "</dd>";
            }
            // line 155
            echo "\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_JOINED", array())) {
                echo "<dd class=\"profile-joined\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("JOINED");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POSTER_JOINED", array());
                echo "</dd>";
            }
            // line 156
            echo "\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_WARNINGS", array())) {
                echo "<dd class=\"profile-warnings\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("WARNINGS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POSTER_WARNINGS", array());
                echo "</dd>";
            }
            // line 157
            echo "
\t\t";
            // line 158
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_PROFILE_FIELD1", array())) {
                // line 159
                echo "\t\t\t<!-- Use a construct like this to include admin defined profile fields. Replace FIELD1 with the name of your field. -->
\t\t\t<dd><strong>";
                // line 160
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "PROFILE_FIELD1_NAME", array());
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "PROFILE_FIELD1_VALUE", array());
                echo "</dd>
\t\t";
            }
            // line 162
            echo "
\t\t";
            // line 163
            if (isset($context["viewtopic_body_postrow_custom_fields_before"])) { $_viewtopic_body_postrow_custom_fields_before_ = $context["viewtopic_body_postrow_custom_fields_before"]; } else { $_viewtopic_body_postrow_custom_fields_before_ = null; }
            // line 164
            echo "\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_postrow_, "custom_fields", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["custom_fields"]) {
                // line 165
                echo "\t\t\t";
                if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                if ( !$this->getAttribute($_custom_fields_, "S_PROFILE_CONTACT", array())) {
                    // line 166
                    echo "\t\t\t\t<dd class=\"profile-custom-field profile-";
                    if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                    echo $this->getAttribute($_custom_fields_, "PROFILE_FIELD_IDENT", array());
                    echo "\"><strong>";
                    if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                    echo $this->getAttribute($_custom_fields_, "PROFILE_FIELD_NAME", array());
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong> ";
                    if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                    echo $this->getAttribute($_custom_fields_, "PROFILE_FIELD_VALUE", array());
                    echo "</dd>
\t\t\t";
                }
                // line 168
                echo "\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_fields'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 169
            echo "\t\t";
            if (isset($context["viewtopic_body_postrow_custom_fields_after"])) { $_viewtopic_body_postrow_custom_fields_after_ = $context["viewtopic_body_postrow_custom_fields_after"]; } else { $_viewtopic_body_postrow_custom_fields_after_ = null; }
            // line 170
            echo "
\t\t";
            // line 171
            if (isset($context["viewtopic_body_contact_fields_before"])) { $_viewtopic_body_contact_fields_before_ = $context["viewtopic_body_contact_fields_before"]; } else { $_viewtopic_body_contact_fields_before_ = null; }
            // line 172
            echo "\t\t";
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (( !$_S_IS_BOT_ && twig_length_filter($this->env, $this->getAttribute($_postrow_, "contact", array())))) {
                // line 173
                echo "\t\t\t<dd class=\"profile-contact\">
\t\t\t\t<strong>";
                // line 174
                echo $this->env->getExtension('phpbb')->lang("CONTACT");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong>
\t\t\t\t<div class=\"dropdown-container dropdown-left\">
\t\t\t\t\t<a href=\"#\" class=\"dropdown-trigger\"><span class=\"imageset icon_contact\" title=\"";
                // line 176
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "CONTACT_USER", array());
                echo "\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "CONTACT_USER", array());
                echo "</span></a>
\t\t\t\t\t<div class=\"dropdown hidden\">
\t\t\t\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t\t\t\t<div class=\"dropdown-contents contact-icons\">
\t\t\t\t\t\t\t";
                // line 180
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_postrow_, "contact", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["contact"]) {
                    // line 181
                    echo "\t\t\t\t\t\t\t\t";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    $context["REMAINDER"] = ($this->getAttribute($_contact_, "S_ROW_COUNT", array()) % 4);
                    // line 182
                    echo "\t\t\t\t\t\t\t\t";
                    if (isset($context["S_LAST_CELL"])) { $_S_LAST_CELL_ = $context["S_LAST_CELL"]; } else { $_S_LAST_CELL_ = null; }
                    if (isset($context["REMAINDER"])) { $_REMAINDER_ = $context["REMAINDER"]; } else { $_REMAINDER_ = null; }
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    $value = (($_REMAINDER_ == 3) || ($this->getAttribute($_contact_, "S_LAST_ROW", array()) && ($this->getAttribute($_contact_, "S_NUM_ROWS", array()) < 4)));
                    $context['definition']->set('S_LAST_CELL', $value);
                    // line 183
                    echo "\t\t\t\t\t\t\t\t";
                    if (isset($context["REMAINDER"])) { $_REMAINDER_ = $context["REMAINDER"]; } else { $_REMAINDER_ = null; }
                    if (($_REMAINDER_ == 0)) {
                        // line 184
                        echo "\t\t\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t";
                    }
                    // line 186
                    echo "\t\t\t\t\t\t\t\t\t<a href=\"";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    if ($this->getAttribute($_contact_, "U_CONTACT", array())) {
                        if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                        echo $this->getAttribute($_contact_, "U_CONTACT", array());
                    } else {
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_POST_AUTHOR", array());
                    }
                    echo "\" title=\"";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    echo $this->getAttribute($_contact_, "NAME", array());
                    echo "\"";
                    if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                    if ($this->getAttribute($_definition_, "S_LAST_CELL", array())) {
                        echo " class=\"last-cell\"";
                    }
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    if (($this->getAttribute($_contact_, "ID", array()) == "jabber")) {
                        echo " onclick=\"popup(this.href, 750, 320); return false;\"";
                    }
                    echo ">
\t\t\t\t\t\t\t\t\t\t<span class=\"contact-icon ";
                    // line 187
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    echo $this->getAttribute($_contact_, "ID", array());
                    echo "-icon\">";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    echo $this->getAttribute($_contact_, "NAME", array());
                    echo "</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t";
                    // line 189
                    if (isset($context["REMAINDER"])) { $_REMAINDER_ = $context["REMAINDER"]; } else { $_REMAINDER_ = null; }
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    if ((($_REMAINDER_ == 3) || $this->getAttribute($_contact_, "S_LAST_ROW", array()))) {
                        // line 190
                        echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
                    }
                    // line 192
                    echo "\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contact'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 193
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</dd>
\t\t";
            }
            // line 198
            echo "\t\t";
            if (isset($context["viewtopic_body_contact_fields_after"])) { $_viewtopic_body_contact_fields_after_ = $context["viewtopic_body_contact_fields_after"]; } else { $_viewtopic_body_contact_fields_after_ = null; }
            // line 199
            echo "
\t\t</dl>

\t\t<div class=\"postbody\">
\t\t\t";
            // line 203
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_HIDDEN", array())) {
                // line 204
                echo "\t\t\t\t";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "S_POST_DELETED", array())) {
                    // line 205
                    echo "\t\t\t\t\t<div class=\"ignore\" id=\"post_hidden";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POST_ID", array());
                    echo "\">
\t\t\t\t\t\t";
                    // line 206
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_POST_DELETED_MESSAGE", array());
                    echo "<br />
\t\t\t\t\t\t";
                    // line 207
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_POST_DISPLAY", array());
                    echo "
\t\t\t\t\t</div>
\t\t\t\t";
                } elseif ($this->getAttribute($_postrow_, "S_IGNORE_POST", array())) {
                    // line 210
                    echo "\t\t\t\t\t<div class=\"ignore\" id=\"post_hidden";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POST_ID", array());
                    echo "\">
\t\t\t\t\t\t";
                    // line 211
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_IGNORE_POST", array());
                    echo "<br />
\t\t\t\t\t\t";
                    // line 212
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_POST_DISPLAY", array());
                    echo "
\t\t\t\t\t</div>
\t\t\t\t";
                }
                // line 215
                echo "\t\t\t";
            }
            // line 216
            echo "\t\t\t<div id=\"post_content";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID", array());
            echo "\"";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_HIDDEN", array())) {
                echo " style=\"display: none;\"";
            }
            echo ">

\t\t\t<h3 ";
            // line 218
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_FIRST_ROW", array())) {
                echo "class=\"first\"";
            }
            echo ">";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POST_ICON_IMG", array())) {
                echo "<img src=\"";
                if (isset($context["T_ICONS_PATH"])) { $_T_ICONS_PATH_ = $context["T_ICONS_PATH"]; } else { $_T_ICONS_PATH_ = null; }
                echo $_T_ICONS_PATH_;
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ICON_IMG", array());
                echo "\" width=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ICON_IMG_WIDTH", array());
                echo "\" height=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ICON_IMG_HEIGHT", array());
                echo "\" alt=\"\" /> ";
            }
            echo "<a href=\"#p";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID", array());
            echo "\">";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_SUBJECT", array());
            echo "</a></h3>

\t\t";
            // line 220
            if (isset($context["SHOW_POST_BUTTONS"])) { $_SHOW_POST_BUTTONS_ = $context["SHOW_POST_BUTTONS"]; } else { $_SHOW_POST_BUTTONS_ = null; }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            $value = ((((($this->getAttribute($_postrow_, "U_EDIT", array()) || $this->getAttribute($_postrow_, "U_DELETE", array())) || $this->getAttribute($_postrow_, "U_REPORT", array())) || $this->getAttribute($_postrow_, "U_WARN", array())) || $this->getAttribute($_postrow_, "U_INFO", array())) || $this->getAttribute($_postrow_, "U_QUOTE", array()));
            $context['definition']->set('SHOW_POST_BUTTONS', $value);
            // line 221
            echo "\t\t";
            if (isset($context["viewtopic_body_post_buttons_list_before"])) { $_viewtopic_body_post_buttons_list_before_ = $context["viewtopic_body_post_buttons_list_before"]; } else { $_viewtopic_body_post_buttons_list_before_ = null; }
            // line 222
            echo "\t\t";
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ( !$_S_IS_BOT_) {
                // line 223
                echo "\t\t\t";
                if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                if ($this->getAttribute($_definition_, "SHOW_POST_BUTTONS", array())) {
                    // line 224
                    echo "\t\t\t\t<ul class=\"post-buttons\">
\t\t\t\t\t";
                    // line 225
                    if (isset($context["viewtopic_body_post_buttons_before"])) { $_viewtopic_body_post_buttons_before_ = $context["viewtopic_body_post_buttons_before"]; } else { $_viewtopic_body_post_buttons_before_ = null; }
                    // line 226
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_EDIT", array())) {
                        // line 227
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 228
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_EDIT", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("EDIT_POST");
                        echo "\" class=\"button icon-button edit-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("BUTTON_EDIT");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 231
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_DELETE", array())) {
                        // line 232
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 233
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_DELETE", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("DELETE_POST");
                        echo "\" class=\"button icon-button delete-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("DELETE_POST");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 236
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_REPORT", array())) {
                        // line 237
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 238
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_REPORT", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("REPORT_POST");
                        echo "\" class=\"button icon-button report-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("REPORT_POST");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 241
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_WARN", array())) {
                        // line 242
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 243
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_WARN", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("WARN_USER");
                        echo "\" class=\"button icon-button warn-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("WARN_USER");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 246
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_INFO", array())) {
                        // line 247
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 248
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_INFO", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("INFORMATION");
                        echo "\" class=\"button icon-button info-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("INFORMATION");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 251
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_QUOTE", array())) {
                        // line 252
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 253
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_QUOTE", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("REPLY_WITH_QUOTE");
                        echo "\" class=\"button icon-button quote-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("QUOTE");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 256
                    echo "\t\t\t\t\t";
                    if (isset($context["viewtopic_body_post_buttons_after"])) { $_viewtopic_body_post_buttons_after_ = $context["viewtopic_body_post_buttons_after"]; } else { $_viewtopic_body_post_buttons_after_ = null; }
                    // line 257
                    echo "\t\t\t\t</ul>
\t\t\t";
                }
                // line 259
                echo "\t\t";
            }
            // line 260
            echo "\t\t";
            if (isset($context["viewtopic_body_post_buttons_list_after"])) { $_viewtopic_body_post_buttons_list_after_ = $context["viewtopic_body_post_buttons_list_after"]; } else { $_viewtopic_body_post_buttons_list_after_ = null; }
            // line 261
            echo "
\t\t\t";
            // line 262
            if (isset($context["viewtopic_body_postrow_post_details_before"])) { $_viewtopic_body_postrow_post_details_before_ = $context["viewtopic_body_postrow_post_details_before"]; } else { $_viewtopic_body_postrow_post_details_before_ = null; }
            // line 263
            echo "\t\t\t<p class=\"author\">";
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ($_S_IS_BOT_) {
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "MINI_POST_IMG", array());
            } else {
                echo "<a href=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MINI_POST", array());
                echo "\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "MINI_POST_IMG", array());
                echo "</a>";
            }
            echo "<span class=\"responsive-hide\">";
            echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
            echo " <strong>";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_AUTHOR_FULL", array());
            echo "</strong> &raquo; </span>";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_DATE", array());
            echo " </p>
\t\t\t";
            // line 264
            if (isset($context["viewtopic_body_postrow_post_details_after"])) { $_viewtopic_body_postrow_post_details_after_ = $context["viewtopic_body_postrow_post_details_after"]; } else { $_viewtopic_body_postrow_post_details_after_ = null; }
            // line 265
            echo "
\t\t\t";
            // line 266
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_UNAPPROVED", array())) {
                // line 267
                echo "\t\t\t<form method=\"post\" class=\"mcp_approve\" action=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_APPROVE_ACTION", array());
                echo "\">
\t\t\t\t<p class=\"post-notice unapproved\">
\t\t\t\t\t<strong>";
                // line 269
                echo $this->env->getExtension('phpbb')->lang("POST_UNAPPROVED_ACTION");
                echo "</strong>
\t\t\t\t\t<input class=\"button2\" type=\"submit\" value=\"";
                // line 270
                echo $this->env->getExtension('phpbb')->lang("DISAPPROVE");
                echo "\" name=\"action[disapprove]\" />
\t\t\t\t\t<input class=\"button1\" type=\"submit\" value=\"";
                // line 271
                echo $this->env->getExtension('phpbb')->lang("APPROVE");
                echo "\" name=\"action[approve]\" />
\t\t\t\t\t<input type=\"hidden\" name=\"post_id_list[]\" value=\"";
                // line 272
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ID", array());
                echo "\" />
\t\t\t\t\t";
                // line 273
                if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
                echo $_S_FORM_TOKEN_;
                echo "
\t\t\t\t</p>
\t\t\t</form>
\t\t\t";
            } elseif ($this->getAttribute($_postrow_, "S_POST_DELETED", array())) {
                // line 277
                echo "\t\t\t<form method=\"post\" class=\"mcp_approve\" action=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_APPROVE_ACTION", array());
                echo "\">
\t\t\t\t<p class=\"post-notice deleted\">
\t\t\t\t\t<strong>";
                // line 279
                echo $this->env->getExtension('phpbb')->lang("POST_DELETED_ACTION");
                echo "</strong>
\t\t\t\t\t<input class=\"button2\" type=\"submit\" value=\"";
                // line 280
                echo $this->env->getExtension('phpbb')->lang("DELETE");
                echo "\" name=\"action[disapprove]\" />
\t\t\t\t\t<input class=\"button1\" type=\"submit\" value=\"";
                // line 281
                echo $this->env->getExtension('phpbb')->lang("RESTORE");
                echo "\" name=\"action[restore]\" />
\t\t\t\t\t<input type=\"hidden\" name=\"post_id_list[]\" value=\"";
                // line 282
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ID", array());
                echo "\" />
\t\t\t\t\t";
                // line 283
                if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
                echo $_S_FORM_TOKEN_;
                echo "
\t\t\t\t</p>
\t\t\t</form>
\t\t\t";
            }
            // line 287
            echo "
\t\t\t";
            // line 288
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_REPORTED", array())) {
                // line 289
                echo "\t\t\t<p class=\"post-notice reported\">
\t\t\t\t<a href=\"";
                // line 290
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MCP_REPORT", array());
                echo "\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("POST_REPORTED");
                echo "</strong></a>
\t\t\t</p>
\t\t\t";
            }
            // line 293
            echo "
\t\t\t<div class=\"content\">";
            // line 294
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "MESSAGE", array());
            echo "</div>

\t\t\t";
            // line 296
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_HAS_ATTACHMENTS", array())) {
                // line 297
                echo "\t\t\t\t<dl class=\"attachbox\">
\t\t\t\t\t<dt>
\t\t\t\t\t\t";
                // line 299
                echo $this->env->getExtension('phpbb')->lang("ATTACHMENTS");
                echo "
\t\t\t\t\t</dt>
\t\t\t\t\t";
                // line 301
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_postrow_, "attachment", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["attachment"]) {
                    // line 302
                    echo "\t\t\t\t\t\t<dd>";
                    if (isset($context["attachment"])) { $_attachment_ = $context["attachment"]; } else { $_attachment_ = null; }
                    echo $this->getAttribute($_attachment_, "DISPLAY_ATTACHMENT", array());
                    echo "</dd>
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachment'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 304
                echo "\t\t\t\t</dl>
\t\t\t";
            }
            // line 306
            echo "
\t\t\t";
            // line 307
            if (isset($context["viewtopic_body_postrow_post_notices_before"])) { $_viewtopic_body_postrow_post_notices_before_ = $context["viewtopic_body_postrow_post_notices_before"]; } else { $_viewtopic_body_postrow_post_notices_before_ = null; }
            // line 308
            echo "\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_DISPLAY_NOTICE", array())) {
                echo "<div class=\"rules\">";
                echo $this->env->getExtension('phpbb')->lang("DOWNLOAD_NOTICE");
                echo "</div>";
            }
            // line 309
            echo "\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "DELETED_MESSAGE", array()) || $this->getAttribute($_postrow_, "DELETE_REASON", array()))) {
                // line 310
                echo "\t\t\t\t<div class=\"notice post_deleted_msg\">
\t\t\t\t\t";
                // line 311
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "DELETED_MESSAGE", array());
                echo "
\t\t\t\t\t";
                // line 312
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "DELETE_REASON", array())) {
                    echo "<br /><strong>";
                    echo $this->env->getExtension('phpbb')->lang("REASON");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong> <em>";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "DELETE_REASON", array());
                    echo "</em>";
                }
                // line 313
                echo "\t\t\t\t</div>
\t\t\t";
            } elseif (($this->getAttribute($_postrow_, "EDITED_MESSAGE", array()) || $this->getAttribute($_postrow_, "EDIT_REASON", array()))) {
                // line 315
                echo "\t\t\t\t<div class=\"notice\">
\t\t\t\t\t";
                // line 316
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "EDITED_MESSAGE", array());
                echo "
\t\t\t\t\t";
                // line 317
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "EDIT_REASON", array())) {
                    echo "<br /><strong>";
                    echo $this->env->getExtension('phpbb')->lang("REASON");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong> <em>";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "EDIT_REASON", array());
                    echo "</em>";
                }
                // line 318
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 320
            echo "
\t\t\t";
            // line 321
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "BUMPED_MESSAGE", array())) {
                echo "<div class=\"notice\"><br /><br />";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "BUMPED_MESSAGE", array());
                echo "</div>";
            }
            // line 322
            echo "\t\t\t";
            if (isset($context["viewtopic_body_postrow_post_notices_after"])) { $_viewtopic_body_postrow_post_notices_after_ = $context["viewtopic_body_postrow_post_notices_after"]; } else { $_viewtopic_body_postrow_post_notices_after_ = null; }
            // line 323
            echo "\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "SIGNATURE", array())) {
                echo "<div id=\"sig";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ID", array());
                echo "\" class=\"signature\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "SIGNATURE", array());
                echo "</div>";
            }
            // line 324
            echo "
\t\t\t";
            // line 325
            if (isset($context["viewtopic_body_postrow_post_content_footer"])) { $_viewtopic_body_postrow_post_content_footer_ = $context["viewtopic_body_postrow_post_content_footer"]; } else { $_viewtopic_body_postrow_post_content_footer_ = null; }
            // line 326
            echo "\t\t\t</div>

\t\t</div>

\t\t<div class=\"back2top\"><a href=\"#top\" class=\"top\" title=\"";
            // line 330
            echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
            echo "</a></div>

\t\t</div>
\t</div>

\t<hr class=\"divider\" />
\t";
            // line 336
            if (isset($context["viewtopic_body_postrow_post_after"])) { $_viewtopic_body_postrow_post_after_ = $context["viewtopic_body_postrow_post_after"]; } else { $_viewtopic_body_postrow_post_after_ = null; }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['postrow'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 338
        echo "
";
        // line 339
        if (isset($context["S_QUICK_REPLY"])) { $_S_QUICK_REPLY_ = $context["S_QUICK_REPLY"]; } else { $_S_QUICK_REPLY_ = null; }
        if ($_S_QUICK_REPLY_) {
            // line 340
            echo "\t";
            $location = "quickreply_editor.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("quickreply_editor.html", "viewtopic_body.html", 340)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 342
        echo "
";
        // line 343
        if (isset($context["S_NUM_POSTS"])) { $_S_NUM_POSTS_ = $context["S_NUM_POSTS"]; } else { $_S_NUM_POSTS_ = null; }
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if ((($_S_NUM_POSTS_ > 1) || twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array())))) {
            // line 344
            echo "\t<form id=\"viewtopic\" method=\"post\" action=\"";
            if (isset($context["S_TOPIC_ACTION"])) { $_S_TOPIC_ACTION_ = $context["S_TOPIC_ACTION"]; } else { $_S_TOPIC_ACTION_ = null; }
            echo $_S_TOPIC_ACTION_;
            echo "\">
\t<fieldset class=\"display-options\" style=\"margin-top: 0; \">
\t\t";
            // line 346
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ( !$_S_IS_BOT_) {
                // line 347
                echo "\t\t<label>";
                echo $this->env->getExtension('phpbb')->lang("DISPLAY_POSTS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo " ";
                if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
                echo $_S_SELECT_SORT_DAYS_;
                echo "</label>
\t\t<label>";
                // line 348
                echo $this->env->getExtension('phpbb')->lang("SORT_BY");
                echo " ";
                if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
                echo $_S_SELECT_SORT_KEY_;
                echo "</label> <label>";
                if (isset($context["S_SELECT_SORT_DIR"])) { $_S_SELECT_SORT_DIR_ = $context["S_SELECT_SORT_DIR"]; } else { $_S_SELECT_SORT_DIR_ = null; }
                echo $_S_SELECT_SORT_DIR_;
                echo "</label>
\t\t<input type=\"submit\" name=\"sort\" value=\"";
                // line 349
                echo $this->env->getExtension('phpbb')->lang("GO");
                echo "\" class=\"button2\" />
\t\t";
            }
            // line 351
            echo "\t</fieldset>
\t</form>
\t<hr />
";
        }
        // line 355
        echo "
";
        // line 356
        if (isset($context["viewtopic_body_topic_actions_before"])) { $_viewtopic_body_topic_actions_before_ = $context["viewtopic_body_topic_actions_before"]; } else { $_viewtopic_body_topic_actions_before_ = null; }
        // line 357
        echo "<div class=\"action-bar bottom\">
\t<div class=\"buttons\">
\t\t";
        // line 359
        if (isset($context["viewtopic_buttons_bottom_before"])) { $_viewtopic_buttons_bottom_before_ = $context["viewtopic_buttons_bottom_before"]; } else { $_viewtopic_buttons_bottom_before_ = null; }
        // line 360
        echo "
\t";
        // line 361
        if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
        if (isset($context["S_DISPLAY_REPLY_INFO"])) { $_S_DISPLAY_REPLY_INFO_ = $context["S_DISPLAY_REPLY_INFO"]; } else { $_S_DISPLAY_REPLY_INFO_ = null; }
        if (( !$_S_IS_BOT_ && $_S_DISPLAY_REPLY_INFO_)) {
            // line 362
            echo "\t\t<a href=\"";
            if (isset($context["U_POST_REPLY_TOPIC"])) { $_U_POST_REPLY_TOPIC_ = $context["U_POST_REPLY_TOPIC"]; } else { $_U_POST_REPLY_TOPIC_ = null; }
            echo $_U_POST_REPLY_TOPIC_;
            echo "\" class=\"button icon-button ";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo "locked-icon";
            } else {
                echo "reply-icon";
            }
            echo "\" title=\"";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("POST_REPLY");
            }
            echo "\">
\t\t\t";
            // line 363
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_POST_REPLY");
            }
            // line 364
            echo "\t\t</a>
\t";
        }
        // line 366
        echo "
\t\t";
        // line 367
        if (isset($context["viewtopic_buttons_bottom_after"])) { $_viewtopic_buttons_bottom_after_ = $context["viewtopic_buttons_bottom_after"]; } else { $_viewtopic_buttons_bottom_after_ = null; }
        // line 368
        echo "\t</div>

\t";
        // line 370
        $location = "viewtopic_topic_tools.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("viewtopic_topic_tools.html", "viewtopic_body.html", 370)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 371
        echo "
\t";
        // line 372
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "quickmod", array()))) {
            // line 373
            echo "\t\t<div class=\"dropdown-container dropdown-container-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo " dropdown-up dropdown-";
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            echo " dropdown-button-control\" id=\"quickmod\">
\t\t\t<span title=\"";
            // line 374
            echo $this->env->getExtension('phpbb')->lang("QUICK_MOD");
            echo "\" class=\"dropdown-trigger button icon-button modtools-icon dropdown-select\">";
            echo $this->env->getExtension('phpbb')->lang("QUICK_MOD");
            echo "</span>
\t\t\t<div class=\"dropdown hidden\">
\t\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t\t<ul class=\"dropdown-contents\">
\t\t\t\t";
            // line 378
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "quickmod", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["quickmod"]) {
                // line 379
                echo "\t\t\t\t\t";
                if (isset($context["QUICKMOD_AJAX"])) { $_QUICKMOD_AJAX_ = $context["QUICKMOD_AJAX"]; } else { $_QUICKMOD_AJAX_ = null; }
                if (isset($context["quickmod"])) { $_quickmod_ = $context["quickmod"]; } else { $_quickmod_ = null; }
                $value = twig_in_filter($this->getAttribute($_quickmod_, "VALUE", array()), array(0 => "lock", 1 => "unlock", 2 => "delete_topic", 3 => "restore_topic", 4 => "make_normal", 5 => "make_sticky", 6 => "make_announce", 7 => "make_global"));
                $context['definition']->set('QUICKMOD_AJAX', $value);
                // line 380
                echo "\t\t\t\t\t<li><a href=\"";
                if (isset($context["quickmod"])) { $_quickmod_ = $context["quickmod"]; } else { $_quickmod_ = null; }
                echo $this->getAttribute($_quickmod_, "LINK", array());
                echo "\"";
                if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                if ($this->getAttribute($_definition_, "QUICKMOD_AJAX", array())) {
                    echo " data-ajax=\"true\" data-refresh=\"true\"";
                }
                echo ">";
                if (isset($context["quickmod"])) { $_quickmod_ = $context["quickmod"]; } else { $_quickmod_ = null; }
                echo $this->getAttribute($_quickmod_, "TITLE", array());
                echo "</a></li>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quickmod'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 382
            echo "\t\t\t\t</ul>
\t\t\t</div>
\t\t</div>
\t";
        }
        // line 386
        echo "\t
\t";
        // line 387
        if (isset($context["viewtopic_dropdown_bottom_custom"])) { $_viewtopic_dropdown_bottom_custom_ = $context["viewtopic_dropdown_bottom_custom"]; } else { $_viewtopic_dropdown_bottom_custom_ = null; }
        // line 388
        echo "
\t";
        // line 389
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
        if ((twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array())) || $_TOTAL_POSTS_)) {
            // line 390
            echo "\t\t<div class=\"pagination\">
\t\t\t";
            // line 391
            if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
            echo $_TOTAL_POSTS_;
            echo "
\t\t\t";
            // line 392
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination", array()))) {
                // line 393
                echo "\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "viewtopic_body.html", 393)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 394
                echo "\t\t\t";
            } else {
                // line 395
                echo "\t\t\t\t&bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t\t";
            }
            // line 397
            echo "\t\t</div>
\t";
        }
        // line 399
        echo "\t<div class=\"clear\"></div>
</div>

";
        // line 402
        if (isset($context["viewtopic_body_footer_before"])) { $_viewtopic_body_footer_before_ = $context["viewtopic_body_footer_before"]; } else { $_viewtopic_body_footer_before_ = null; }
        // line 403
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("jumpbox.html", "viewtopic_body.html", 403)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 404
        echo "
";
        // line 405
        if (isset($context["S_DISPLAY_ONLINE_LIST"])) { $_S_DISPLAY_ONLINE_LIST_ = $context["S_DISPLAY_ONLINE_LIST"]; } else { $_S_DISPLAY_ONLINE_LIST_ = null; }
        if ($_S_DISPLAY_ONLINE_LIST_) {
            // line 406
            echo "\t<div class=\"stat-block online-list\">
\t\t<h3>";
            // line 407
            if (isset($context["U_VIEWONLINE"])) { $_U_VIEWONLINE_ = $context["U_VIEWONLINE"]; } else { $_U_VIEWONLINE_ = null; }
            if ($_U_VIEWONLINE_) {
                echo "<a href=\"";
                if (isset($context["U_VIEWONLINE"])) { $_U_VIEWONLINE_ = $context["U_VIEWONLINE"]; } else { $_U_VIEWONLINE_ = null; }
                echo $_U_VIEWONLINE_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("WHO_IS_ONLINE");
                echo "</a>";
            } else {
                echo $this->env->getExtension('phpbb')->lang("WHO_IS_ONLINE");
            }
            echo "</h3>
\t\t<p>";
            // line 408
            if (isset($context["LOGGED_IN_USER_LIST"])) { $_LOGGED_IN_USER_LIST_ = $context["LOGGED_IN_USER_LIST"]; } else { $_LOGGED_IN_USER_LIST_ = null; }
            echo $_LOGGED_IN_USER_LIST_;
            echo "</p>
\t</div>
";
        }
        // line 411
        echo "
";
        // line 412
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "viewtopic_body.html", 412)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "viewtopic_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1746 => 412,  1743 => 411,  1736 => 408,  1722 => 407,  1719 => 406,  1716 => 405,  1713 => 404,  1701 => 403,  1699 => 402,  1694 => 399,  1690 => 397,  1683 => 395,  1680 => 394,  1667 => 393,  1664 => 392,  1659 => 391,  1656 => 390,  1652 => 389,  1649 => 388,  1647 => 387,  1644 => 386,  1638 => 382,  1620 => 380,  1614 => 379,  1609 => 378,  1600 => 374,  1591 => 373,  1588 => 372,  1585 => 371,  1573 => 370,  1569 => 368,  1567 => 367,  1564 => 366,  1560 => 364,  1553 => 363,  1533 => 362,  1529 => 361,  1526 => 360,  1524 => 359,  1520 => 357,  1518 => 356,  1515 => 355,  1509 => 351,  1504 => 349,  1494 => 348,  1485 => 347,  1482 => 346,  1475 => 344,  1471 => 343,  1468 => 342,  1454 => 340,  1451 => 339,  1448 => 338,  1442 => 336,  1431 => 330,  1425 => 326,  1423 => 325,  1420 => 324,  1408 => 323,  1405 => 322,  1397 => 321,  1394 => 320,  1390 => 318,  1379 => 317,  1374 => 316,  1371 => 315,  1367 => 313,  1356 => 312,  1351 => 311,  1348 => 310,  1344 => 309,  1336 => 308,  1334 => 307,  1331 => 306,  1327 => 304,  1317 => 302,  1312 => 301,  1307 => 299,  1303 => 297,  1300 => 296,  1294 => 294,  1291 => 293,  1282 => 290,  1279 => 289,  1276 => 288,  1273 => 287,  1265 => 283,  1260 => 282,  1256 => 281,  1252 => 280,  1248 => 279,  1241 => 277,  1233 => 273,  1228 => 272,  1224 => 271,  1220 => 270,  1216 => 269,  1209 => 267,  1206 => 266,  1203 => 265,  1201 => 264,  1176 => 263,  1174 => 262,  1171 => 261,  1168 => 260,  1165 => 259,  1161 => 257,  1158 => 256,  1147 => 253,  1144 => 252,  1140 => 251,  1129 => 248,  1126 => 247,  1122 => 246,  1111 => 243,  1108 => 242,  1104 => 241,  1093 => 238,  1090 => 237,  1086 => 236,  1075 => 233,  1072 => 232,  1068 => 231,  1057 => 228,  1054 => 227,  1050 => 226,  1048 => 225,  1045 => 224,  1041 => 223,  1037 => 222,  1034 => 221,  1029 => 220,  999 => 218,  987 => 216,  984 => 215,  977 => 212,  972 => 211,  966 => 210,  959 => 207,  954 => 206,  948 => 205,  944 => 204,  941 => 203,  935 => 199,  932 => 198,  925 => 193,  919 => 192,  915 => 190,  911 => 189,  902 => 187,  878 => 186,  874 => 184,  870 => 183,  863 => 182,  859 => 181,  854 => 180,  843 => 176,  837 => 174,  834 => 173,  829 => 172,  827 => 171,  824 => 170,  821 => 169,  815 => 168,  801 => 166,  797 => 165,  791 => 164,  789 => 163,  786 => 162,  776 => 160,  773 => 159,  770 => 158,  767 => 157,  755 => 156,  743 => 155,  721 => 154,  718 => 153,  715 => 152,  700 => 151,  698 => 150,  694 => 148,  691 => 147,  679 => 146,  677 => 145,  674 => 144,  671 => 143,  668 => 142,  651 => 141,  647 => 140,  645 => 139,  628 => 137,  618 => 136,  583 => 133,  571 => 131,  567 => 130,  564 => 129,  559 => 128,  556 => 127,  554 => 126,  551 => 125,  541 => 119,  536 => 118,  529 => 114,  526 => 113,  517 => 110,  513 => 108,  510 => 107,  507 => 106,  501 => 103,  497 => 101,  494 => 100,  484 => 97,  476 => 95,  473 => 94,  467 => 93,  465 => 92,  449 => 90,  422 => 89,  388 => 88,  372 => 87,  350 => 86,  347 => 85,  342 => 84,  325 => 81,  318 => 80,  307 => 74,  304 => 73,  301 => 72,  299 => 71,  295 => 69,  292 => 68,  288 => 66,  281 => 64,  278 => 63,  265 => 62,  262 => 61,  247 => 60,  244 => 59,  240 => 58,  237 => 57,  228 => 52,  219 => 51,  213 => 50,  209 => 49,  203 => 47,  200 => 46,  197 => 45,  194 => 44,  191 => 43,  179 => 42,  175 => 40,  173 => 39,  170 => 38,  166 => 36,  159 => 35,  139 => 34,  135 => 33,  132 => 32,  130 => 31,  124 => 27,  118 => 23,  112 => 21,  107 => 20,  98 => 18,  95 => 17,  85 => 14,  82 => 13,  79 => 12,  64 => 9,  61 => 8,  58 => 7,  55 => 6,  47 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }
}
