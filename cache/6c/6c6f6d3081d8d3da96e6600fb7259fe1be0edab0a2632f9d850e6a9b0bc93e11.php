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

/* recipe.twig */
class __TwigTemplate_262043b2485fe2fcfd9b2647797e9acc844f263d9370d4b761858e50b4318fea extends \Twig\Template
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
        $this->parent = $this->loadTemplate("template.twig", "recipe.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        // line 3
        echo "    <h4>Recette : ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "recipeTitle", []), "html", null, true);
        echo "</h4>
    <div>
        <p>De <strong>";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "nickname", []), "html", null, true);
        echo "</strong> à ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "recipeDate", []), "html", null, true);
        echo "</p>
        <p>Catégorie: ";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "category", []), "html", null, true);
        echo "</p>
        <p>Temps: ";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "cookingTime", []), "html", null, true);
        echo "mn</p>
        <p>Personnes: ";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "persons", []), "html", null, true);
        echo "</p>
        <p>Difficulté: ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "difficulty", []), "html", null, true);
        echo "</p>
        <p>";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "recipeContent", []), "html", null, true);
        echo "</p>
        <form action=\" ";
        // line 11
        echo twig_escape_filter($this->env, ($context["baseUrl"] ?? null), "html", null, true);
        echo "/recipes/id/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["recipe"] ?? null), "recipeId", []), "html", null, true);
        echo "/postcomment\" method=\"post\" class=\"form-group\">
            <div>
                <label for=\"comment\">Commentaire</label><br/>
                <textarea id=\"comment\" name=\"comment\" cols=\"50\" rows=\"5\" required class=\"form-control form-control-sm\"></textarea>
            </div>
            <div>
                <input type=\"submit\" value=\"Envoyer\" class=\"btn btn-primary mt-3 mb-0 p-1\"/>
            </div>
        </form>

        ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 22
            echo "            <p>
                <strong>";
            // line 23
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "nickname", []), "html", null, true);
            echo "</strong>
                Le
                ";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "date", []), "html", null, true);
            echo "
                <a href=\"#\" class=\"btn btn-danger p-1\">Signaler</a>
            </p>
            <p>
                ";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "content", []), "html", null, true);
            echo "
            </p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "        <a href=\"";
        echo twig_escape_filter($this->env, ($context["baseUrl"] ?? null), "html", null, true);
        echo "\" class=\"btn btn-secondary p-1 text-center\">Retour</a></p>
    </div>
";
    }

    public function getTemplateName()
    {
        return "recipe.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 32,  113 => 29,  106 => 25,  101 => 23,  98 => 22,  94 => 21,  79 => 11,  75 => 10,  71 => 9,  67 => 8,  63 => 7,  59 => 6,  53 => 5,  47 => 3,  44 => 2,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"template.twig\" %}
{% block body %}
    <h4>Recette : {{ recipe.recipeTitle }}</h4>
    <div>
        <p>De <strong>{{ recipe.nickname }}</strong> à {{ recipe.recipeDate }}</p>
        <p>Catégorie: {{ recipe.category }}</p>
        <p>Temps: {{ recipe.cookingTime }}mn</p>
        <p>Personnes: {{ recipe.persons }}</p>
        <p>Difficulté: {{ recipe.difficulty }}</p>
        <p>{{ recipe.recipeContent }}</p>
        <form action=\" {{ baseUrl }}/recipes/id/{{ recipe.recipeId }}/postcomment\" method=\"post\" class=\"form-group\">
            <div>
                <label for=\"comment\">Commentaire</label><br/>
                <textarea id=\"comment\" name=\"comment\" cols=\"50\" rows=\"5\" required class=\"form-control form-control-sm\"></textarea>
            </div>
            <div>
                <input type=\"submit\" value=\"Envoyer\" class=\"btn btn-primary mt-3 mb-0 p-1\"/>
            </div>
        </form>

        {% for comment in comments %}
            <p>
                <strong>{{ comment.nickname }}</strong>
                Le
                {{ comment.date }}
                <a href=\"#\" class=\"btn btn-danger p-1\">Signaler</a>
            </p>
            <p>
                {{ comment.content }}
            </p>
        {% endfor %}
        <a href=\"{{ baseUrl }}\" class=\"btn btn-secondary p-1 text-center\">Retour</a></p>
    </div>
{% endblock %}", "recipe.twig", "C:\\Users\\emilie\\OneDrive\\Projets\\Projet_5\\app\\view\\recipe.twig");
    }
}
