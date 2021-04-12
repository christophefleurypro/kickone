
### Récupération de tous les fichiers non versionnés
voir .gitignore

### BDD :
Récupérer les identifiants sur la preprod (wp-config.php)<br />
<br />
Nous utilisons une BDD partagée pour éviter tout conflit, celle-ci est sauvegardée 1fois/h<br />
Tout le projet sur la preprod est sauvegardé 1fois/h<br />
Libre à vous de récupérer la BDD en local<br />
phpmyadmin : chfleury.fr/phpmyadmin (log danw wp-config.php)

### Hosts/Vhosts :
kickone.chfleury.fr à faire pointer dans votre dossier de projet<br />
L'objectif est de travailler tous avec la même url pour avoir une BDD partagée

### Thème :
/wp-content/themes/kickone-theme

### Assets : (yarn) - Utilisation de Sass/Webpack
```sh
$ cd /wp-content/themes/kickone-theme/web
// Installation des dépendances
$ yarn install
// Build les assets
$ yarn build
// Watch les assets + ouverture localhost:3000
$ yarn start

# Structure

#### Plugins
Timber (gestion des tpl comme sur Symfony)<br />
ACF PRO (gstion des champs custom)<br />
Contact FORM 7 (gestion des formulaires - hors devis/réservation)<br />
Yoast (Référencement)<br />
Autres (Aucun intérêt de les présenter)

#### Theme structure
```
├── app/ (configuration)
├── controllers/
├── managers/
├── dist/      (fichiers compilés - ne pas toucher)
├── services/
├── templates/ (Modèles de page)
├── views/     (tpl)
├── web/       (assets)
├── ajax.php            
├── functions.php       
├── index.php           
├── Readme.md           
├── screenshot.jpg      
└── style.css           
```

#### Configuration

##### Traduction
```
├── app/config/_translations.php
```
=> Gestion des clefs de langue<br />
=> Dans une vue => {{ lang.XX }}

##### Custom post type
```
├── app/config/cpt.yml
```
Déclaration des CPT

##### Routes - Custom post type 
```
├── app/config/cpt-routes.yml
```
Gestion du routing des cpt - Renvoie vers les bons controllers<br />
Archives/Single 

##### Routes
```
├── app/config/routing.yml
```
Gestion du routing standard de WP

##### Taxonomies

```
├── app/config/taxonomy.yml
```
Déclaration des Taxonomies

##### Timber (tpl)

```
├── app/config/timber.yml
```
Déclaration des ids utilisés au niveau des pages<br />
Cela nous permettra de faire des liens depuis nos tpl.<br />
{{ links.pages.XX }}

##### Wordpress (tpl)

```
├── app/config/wordpress.yml
```
Gestion de la configuration / Utiliser dans le fichier managers/WordpressManager.php<br />
Gestion des query vars<br />
Gestion des images (en sachant qu'on fera squizzer ça à la fin/ on va utiliser un CDN)<br />


#### Controllers

Chaque route matchée doit être renvoyée sur un controlleur

##### Créer un controller
```
<?php 
// controllers/
namespace Controllers;

use \TimberPost;
use \Timber\PostQuery;
use \Timber;

class PageController extends AppController
{
    public function __construct(){
        parent::__construct();
    }
}
```

##### Créer une méthode
```
<?php 
// controllers/
namespace Controllers;

use \TimberPost;
use \Timber\PostQuery;
use \Timber;

class PageController extends AppController
{
    public function __construct(){
        parent::__construct();
    }

    public function pageExempleAction(){
        //...
        // Logique
        //...

        // Renvoie du tpl (views/pages/page-exemple.twig) 
        $this->render('pages/page-exemple.twig', array(
            'post' => new TimberPost()
        ));
    }
}
```
##### Créer une vue
```
# view/pages/page-exemple.twig
{% extends 'layout.twig' %}

{% block content %}
    <div id="page-exemple">
        {# Your HTML goes here... #}
    </div>
{% endblock %}
```


#### Managers
##### TimberManager
Gestion des filtres & fonctions twig<br />
Gestion des variables globales/locales envoyées à la vue

##### WordpressManager
Gestion de toutes les méthodes classiques que peut gérer Wordpress<br />
Anciennement tout ce qu'on pouvait mettre dans le fichier functions.php
Attention bien faire pointer vers la classe courante<br />
```
Exemple
private function wordpress() {
    //...
    add_filter( 'posts_where', array($this, 'custom_posts_where'));
}

function custom_posts_where( $where ) {
    if (preg_match('#(.*)meta_key = \'((.*)\$(.*))\'(.*)#', $where, $matches)) {
        $where = str_replace( "meta_key = '".$matches[2]."'", "meta_key LIKE '".str_replace('$', '%', $matches[2])."'", $where );
    }
    return $where;
}
```
##### Les autres managers ne vous serviront pas

#### Services
##### CartService
La méthode qui va vous intéréssez est celle ci-dessous <br />
Elle est appélée lorsque l'on finalise le devis.

```
// Controller faisant appel à notre méthode finale :
// DevisController->devisDemandeAction()


// service/CartService.php
// On arrive ici quand on est sur que tout est OK

public function createQuotation() {
// Enregistrement BDD
// Envoyer au Middle Office
// Envoyer un email
}
```

##### PaymentPhoneService étend de PaymentService
```

// Controller faisant appel à notre méthode finale :
// AchatController->paiementAction()

public function createReservation() {
// Enregistrement BDD
// Envoyer au Middle Office
// Envoyer un email
}
```
##### PaymentSherlockService à créer
```
Gestion du form à rajouter coté tpl (view/achat/tpl-tunnel-paiement.twig)
Se caler sur le cas du paymentPhone
```
##### PaymentOneyService à créer
```
Gestion du form à rajouter coté tpl (view/achat/tpl-tunnel-paiement.twig)
Se caler sur le cas du paymentPhone
```