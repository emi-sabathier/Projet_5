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

/* home.twig */
class __TwigTemplate_ab5ae3c67238a59dbdb3d32217842d626f88b94d7b15aeca8175408f06fdaecf extends \Twig\Template
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
        $this->parent = $this->loadTemplate("template.twig", "home.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        // line 3
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["listRecipes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["recipe"]) {
            // line 4
            echo "        <h4>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "recipeTitle", []), "html", null, true);
            echo "</h4>
        <p>De <strong>";
            // line 5
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "nickname", []), "html", null, true);
            echo "</strong> à ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "recipeDate", []), "html", null, true);
            echo "</p>
        <p>Catégorie: ";
            // line 6
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "category", []), "html", null, true);
            echo "</p>
        <p>Temps: ";
            // line 7
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "cookingTime", []), "html", null, true);
            echo "mn</p>
        <p>Personnes: ";
            // line 8
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "persons", []), "html", null, true);
            echo "</p>
        <p>Difficulté: ";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "difficulty", []), "html", null, true);
            echo "</p>
        <p>";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "recipeContent", []), "html", null, true);
            echo "</p>

        <p class=\"text-center\"><a href=\"recipes/id/";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["recipe"], "recipeId", []), "html", null, true);
            echo "\" class=\"btn btn-primary p-1\">Voir la recette</a></p>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recipe'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 12,  79 => 10,  75 => 9,  71 => 8,  67 => 7,  63 => 6,  57 => 5,  52 => 4,  47 => 3,  44 => 2,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"template.twig\" %}
{% block body %}
    {% for recipe in listRecipes %}
        <h4>{{ recipe.recipeTitle }}</h4>
        <p>De <strong>{{ recipe.nickname }}</strong> à {{ recipe.recipeDate }}</p>
        <p>Catégorie: {{ recipe.category }}</p>
        <p>Temps: {{ recipe.cookingTime }}mn</p>
        <p>Personnes: {{ recipe.persons }}</p>
        <p>Difficulté: {{ recipe.difficulty }}</p>
        <p>{{ recipe.recipeContent }}</p>

        <p class=\"text-center\"><a href=\"recipes/id/{{ recipe.recipeId }}\" class=\"btn btn-primary p-1\">Voir la recette</a></p>
    {% endfor %}
{% endblock %} ", "home.twig", "C:\\Users\\cash\\Documents\\TAF\\Projet_5\\app\\view\\home.twig");
    }
}
