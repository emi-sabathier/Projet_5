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

/* login.twig */
class __TwigTemplate_c3a4a2872fdae9a81d3ce23ed6fd7a5b98110dec518929643d2dfe01d7f31b70 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("template.twig", "login.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        // line 3
        echo "<div>
    <h3>Identifiez-vous</h3>
    <form action=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["baseUrl"] ?? null), "html", null, true);
        echo "/login\" method=\"post\" class=\"form-group needs-validation\" novalidate>
        <label for=\"signinEmail\">Login</label><br />
        <div class=\"col-md-3 mb-3 pl-0\">
            <input type=\"text\" id=\"signinEmail\" name=\"signinEmail\" class=\"form-control form-control-md\"
                   placeholder=\"Votre email\" required />
            ";
        // line 10
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "no_email", [])) {
            // line 11
            echo "                <p>L'identifiant n'existe pas</p>
            ";
        }
        // line 13
        echo "        </div>
        <div>
            <label for=\"signinPwd\">Mot de passe</label><br />
            <div class=\"col-md-3 mb-3 pl-0\">
                <input type=\"password\" id=\"signinPwd\" name=\"signinPwd\" rows=\"10\"
                       class=\"form-control form-control-md \" placeholder=\"Votre mot de passe\" required></textarea>
                ";
        // line 19
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "wrong_pwd", [])) {
            // line 20
            echo "                    <p>Le mot de passe est incorrect</p>
                ";
        }
        // line 22
        echo "            </div>
        </div>
        <?php if(\$error) : ?>
        <p><?= \$msg ?></p>
        <?php endif; ?>
        <p>Pas encore inscrit ? <a href=\"";
        // line 27
        echo twig_escape_filter($this->env, ($context["baseUrl"] ?? null), "html", null, true);
        echo "/register\">c'est par ici</a></p>
        <div>
            <input type=\"submit\" value=\"Envoyer\" class=\"btn btn-primary p-1\" />
        </div>
        ";
        // line 31
        if (twig_get_attribute($this->env, $this->source, ($context["errors"] ?? null), "empty_field", [])) {
            // line 32
            echo "            <p>Un des champs est vide.</p>
        ";
        }
        // line 34
        echo "    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 34,  95 => 32,  93 => 31,  86 => 27,  79 => 22,  75 => 20,  73 => 19,  65 => 13,  61 => 11,  59 => 10,  51 => 5,  47 => 3,  44 => 2,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"template.twig\" %}
{% block body %}
<div>
    <h3>Identifiez-vous</h3>
    <form action=\"{{ baseUrl }}/login\" method=\"post\" class=\"form-group needs-validation\" novalidate>
        <label for=\"signinEmail\">Login</label><br />
        <div class=\"col-md-3 mb-3 pl-0\">
            <input type=\"text\" id=\"signinEmail\" name=\"signinEmail\" class=\"form-control form-control-md\"
                   placeholder=\"Votre email\" required />
            {% if errors.no_email %}
                <p>L'identifiant n'existe pas</p>
            {% endif %}
        </div>
        <div>
            <label for=\"signinPwd\">Mot de passe</label><br />
            <div class=\"col-md-3 mb-3 pl-0\">
                <input type=\"password\" id=\"signinPwd\" name=\"signinPwd\" rows=\"10\"
                       class=\"form-control form-control-md \" placeholder=\"Votre mot de passe\" required></textarea>
                {% if errors.wrong_pwd %}
                    <p>Le mot de passe est incorrect</p>
                {% endif %}
            </div>
        </div>
        <?php if(\$error) : ?>
        <p><?= \$msg ?></p>
        <?php endif; ?>
        <p>Pas encore inscrit ? <a href=\"{{ baseUrl }}/register\">c'est par ici</a></p>
        <div>
            <input type=\"submit\" value=\"Envoyer\" class=\"btn btn-primary p-1\" />
        </div>
        {% if errors.empty_field %}
            <p>Un des champs est vide.</p>
        {% endif %}
    </form>
</div>
{% endblock %}", "login.twig", "C:\\Users\\emilie\\OneDrive\\Projets\\Projet_5\\app\\view\\login.twig");
    }
}
