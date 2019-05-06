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
    <form action=\"index.php?action=signin\" method=\"post\" class=\"form-group needs-validation\" novalidate>
        <label for=\"signinLogin\">Login</label><br />
        <div class=\"col-md-3 mb-3 pl-0\">
            <input type=\"text\" id=\"signinLogin\" name=\"signinLogin\" class=\"form-control form-control-md\"
                   placeholder=\"Votre login\" required />
            <div class=\"invalid-feedback\">
                Champ incorrect
            </div>
        </div>
        <div>
            <label for=\"signinPassword\">Mot de passe</label><br />
            <div class=\"col-md-3 mb-3 pl-0\">
                <input type=\"password\" id=\"signinPassword\" name=\"signinPassword\" rows=\"10\"
                       class=\"form-control form-control-md \" placeholder=\"Votre mot de passe\" required></textarea>
                <div class=\"invalid-feedback\">
                    Champ incorrect
                </div>
            </div>
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
    </form>
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
        return array (  73 => 27,  47 => 3,  44 => 2,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"template.twig\" %}
{% block body %}
<div>
    <h3>Identifiez-vous</h3>
    <form action=\"index.php?action=signin\" method=\"post\" class=\"form-group needs-validation\" novalidate>
        <label for=\"signinLogin\">Login</label><br />
        <div class=\"col-md-3 mb-3 pl-0\">
            <input type=\"text\" id=\"signinLogin\" name=\"signinLogin\" class=\"form-control form-control-md\"
                   placeholder=\"Votre login\" required />
            <div class=\"invalid-feedback\">
                Champ incorrect
            </div>
        </div>
        <div>
            <label for=\"signinPassword\">Mot de passe</label><br />
            <div class=\"col-md-3 mb-3 pl-0\">
                <input type=\"password\" id=\"signinPassword\" name=\"signinPassword\" rows=\"10\"
                       class=\"form-control form-control-md \" placeholder=\"Votre mot de passe\" required></textarea>
                <div class=\"invalid-feedback\">
                    Champ incorrect
                </div>
            </div>
        </div>
        <?php if(\$error) : ?>
        <p><?= \$msg ?></p>
        <?php endif; ?>
        <p>Pas encore inscrit ? <a href=\"{{ baseUrl }}/register\">c'est par ici</a></p>
        <div>
            <input type=\"submit\" value=\"Envoyer\" class=\"btn btn-primary p-1\" />
        </div>
    </form>
</div>
{% endblock %}", "login.twig", "C:\\Users\\cash\\Documents\\TAF\\Projet_5\\app\\view\\login.twig");
    }
}
