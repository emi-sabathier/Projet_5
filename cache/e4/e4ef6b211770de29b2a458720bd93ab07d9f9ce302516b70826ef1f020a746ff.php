<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* register.twig */
class __TwigTemplate_8d753ec2554d7390a472361193395d7f235d70066181328bbc1218a0226ce433 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "template.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("template.twig", "register.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        // line 3
        echo "    <div>
        <h3>Inscrivez-vous</h3>
        <form action=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["baseUrl"] ?? null), "html", null, true);
        echo "/newuser\" method=\"post\" class=\"form-group needs-validation\" novalidate>
            <label for=\"registerEmail\">Votre email</label>
            <div class=\"input-group mb-3 col-md-3 pl-0\">
                <div class=\"input-group-prepend\">
                    <span class=\"input-group-text\" id=\"inputGroupPrepend\">@</span>
                </div>
                <input type=\"text\" id=\"registerEmail\" name=\"registerEmail\" aria-describedby=\"inputGroupPrepend\"
                       placeholder=\"Votre email\" required/>
                ";
        // line 13
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "email_exists", [])) {
            // line 14
            echo "                    <p>L'email existe déjà</p>
                ";
        } elseif (twig_get_attribute($this->env, $this->source,         // line 15
($context["errors"] ?? null), "regex_email", [])) {
            // line 16
            echo "                    <p>Veuillez rentrer un email valide. Lettres, chiffres, _ , . , - autorisés</p>
                ";
        }
        // line 18
        echo "            </div>
            <div>
                <label for=\"Nickname\">Votre pseudo</label><br/>
                <div class=\"col-md-3 mb-3 pl-0\">
                    <input type=\"text\" id=\"registerNickname\" name=\"registerNickname\" rows=\"10\"
                           placeholder=\"Votre pseudo\" required/>
                </div>
                ";
        // line 25
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "nickname_exists", [])) {
            // line 26
            echo "                    <p>Le pseudo est déjà pris</p>
                ";
        } elseif (twig_get_attribute($this->env, $this->source,         // line 27
($context["errors"] ?? null), "regex_nickname", [])) {
            // line 28
            echo "                    <p>Renseignez un pseudo valide (Lettres et chiffres)</p>
                ";
        } elseif (twig_get_attribute($this->env, $this->source,         // line 29
($context["errors"] ?? null), "short_nickname", [])) {
            // line 30
            echo "                    <p>Le pseudo doit faire minimum 3 caractères</p>
                ";
        }
        // line 32
        echo "            </div>
            <div>
                <label for=\"registerPwd\">Mot de passe</label><br/>
                <div class=\"col-md-3 mb-3 pl-0\">
                    <input type=\"password\" id=\"registerPwd\" name=\"registerPwd\" rows=\"10\"
                           placeholder=\"Votre mot de passe\" class=\"form-control form-control-md\"
                           placeholder=\"Votre mot de passe\" required>
                    ";
        // line 39
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "regex_pwd", [])) {
            // line 40
            echo "                        <p>Le mot de passe ne doit comprendre que des chiffres et lettres</p>
                    ";
        } elseif (twig_get_attribute($this->env, $this->source,         // line 41
($context["errors"] ?? null), "short_pwd", [])) {
            // line 42
            echo "                        <p>Le mot de passe doit faire minimum 8 caractères </p>
                    ";
        }
        // line 44
        echo "                </div>
            </div>
            <div>
                <input type=\"submit\" value=\"Envoyer\" class=\"btn btn-primary p-1\"/>
            </div>
            ";
        // line 49
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "empty_field", [], "any", true, true)) {
            // line 50
            echo "                <p>Un des champs est vide</p>
            ";
        }
        // line 52
        echo "        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  131 => 52,  127 => 50,  125 => 49,  118 => 44,  114 => 42,  112 => 41,  109 => 40,  107 => 39,  98 => 32,  94 => 30,  92 => 29,  89 => 28,  87 => 27,  84 => 26,  82 => 25,  73 => 18,  69 => 16,  67 => 15,  64 => 14,  62 => 13,  51 => 5,  47 => 3,  44 => 2,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"template.twig\" %}
{% block body %}
    <div>
        <h3>Inscrivez-vous</h3>
        <form action=\"{{ baseUrl }}/newuser\" method=\"post\" class=\"form-group needs-validation\" novalidate>
            <label for=\"registerEmail\">Votre email</label>
            <div class=\"input-group mb-3 col-md-3 pl-0\">
                <div class=\"input-group-prepend\">
                    <span class=\"input-group-text\" id=\"inputGroupPrepend\">@</span>
                </div>
                <input type=\"text\" id=\"registerEmail\" name=\"registerEmail\" aria-describedby=\"inputGroupPrepend\"
                       placeholder=\"Votre email\" required/>
                {% if errors.email_exists %}
                    <p>L'email existe déjà</p>
                {% elseif errors.regex_email %}
                    <p>Veuillez rentrer un email valide. Lettres, chiffres, _ , . , - autorisés</p>
                {% endif %}
            </div>
            <div>
                <label for=\"Nickname\">Votre pseudo</label><br/>
                <div class=\"col-md-3 mb-3 pl-0\">
                    <input type=\"text\" id=\"registerNickname\" name=\"registerNickname\" rows=\"10\"
                           placeholder=\"Votre pseudo\" required/>
                </div>
                {% if errors.nickname_exists %}
                    <p>Le pseudo est déjà pris</p>
                {% elseif errors.regex_nickname %}
                    <p>Renseignez un pseudo valide (Lettres et chiffres)</p>
                {% elseif errors.short_nickname %}
                    <p>Le pseudo doit faire minimum 3 caractères</p>
                {% endif %}
            </div>
            <div>
                <label for=\"registerPwd\">Mot de passe</label><br/>
                <div class=\"col-md-3 mb-3 pl-0\">
                    <input type=\"password\" id=\"registerPwd\" name=\"registerPwd\" rows=\"10\"
                           placeholder=\"Votre mot de passe\" class=\"form-control form-control-md\"
                           placeholder=\"Votre mot de passe\" required>
                    {% if errors.regex_pwd %}
                        <p>Le mot de passe ne doit comprendre que des chiffres et lettres</p>
                    {% elseif errors.short_pwd %}
                        <p>Le mot de passe doit faire minimum 8 caractères </p>
                    {% endif %}
                </div>
            </div>
            <div>
                <input type=\"submit\" value=\"Envoyer\" class=\"btn btn-primary p-1\"/>
            </div>
            {% if errors.empty_field is defined %}
                <p>Un des champs est vide</p>
            {% endif %}
        </form>
    </div>
{% endblock %}", "register.twig", "C:\\Users\\emilie\\OneDrive\\Projets\\Projet_5\\app\\view\\register.twig");
    }
}
