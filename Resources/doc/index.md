Installation steps
==================

1.In your project composer.json file "extra" section add the following information

    "extra": {
        "installer-paths": {
            "src/Ibtikar/ShareEconomyCMSBundle/": ["Ibtikar/ShareEconomyCMSBundle"]
        }
    }

2.Require the package using composer by running

    composer require Ibtikar/ShareEconomyCMSBundle

3.Add to your appkernel the next line
    new Ibtikar\ShareEconomyUMSBundle\IbtikarShareEconomyCMSBundle(),

4.Add this route to your routing file

    ibtikar_share_economy_cms:
        resource: "@IbtikarShareEconomyCMSBundle/Resources/config/routing.yml"
        prefix:   /

5.Add the next line to your .gitignore file

    /src/Ibtikar/ShareEconomyCMSBundle

6.Configure the bundle templates: add the following lines to your project config.yml
    
    ibtikar_share_economy_cms:
        frontend_layout: "AppBundle:Frontend:layout.html.twig"

6.Run doctrine migrations command

    bin/console doctrine:migrations:migrate --configuration=src/Ibtikar/ShareEconomyCMSBundle/Resources/config/migrations.yml