
 <h1>Examen Symfony</h1>
    <h2>Application de Collection de films</h2>
    <p>On développe une application de bibliotheque de films sur symfony. Il ne s'agit pas de vidéos, mais de descriptions de films</p>
    <p>on veut, à terme, pouvoir afficher, créer, supprimer et modifier des films, et faire de meme pour des impressions (commentaires) laissés individuellement sur les films. Egalement, un systeme de gestion des utilisateurs permettra de savoir qui a posté un film, et qui a laissé une impression sur un film. Egalement, un systeme de likes sera mis en place sur le films et sur les impressions</p>
    <h1>Les étapes à suivre dans l'ordre :</h1>
    <p>1. Création d'une base de données de films, et d'une nouvelle application symfony vierge</p>
    <p>on utilisera bootstrap</p>
    <p>2. Focus sur les Films : un film aura un nom (string), un (court) résumé (text), un(e) réalisateur/trice (string) et une année de sortie (datetime). Aucun de ces champs n'est autorisé à etre vide</p>
    <p>3. On ajoute quelques films directement par PhpMyAdmin, et on créé une methode et un template pour les afficher tous, ainsi qu'une methode (show) pour les afficher individuellement</p>
    <p>il n'y a pas d'image à ce stade-la</p>
    <p>4. On créé des methodes de création, suppression, et édition de films (au choix create et edit dans la meme methode ou séparés)</p>
    <p>le formulaire de création de film est sur une page séparée</p>
    <p>5. Focus sur les impressions : création de la nouvelle entité : une Impression aura un contenu (content, de type text), une date de création (qui sera un new \DateTime() ) et un film (relation)</p>
    <p>une impression ne sera liée qu'à un seul film, un film pourra etre lié à plusieurs impressions</p>
    <p>(une Impression est un 'avis' sur un film)</p>
    <p>6. on veut afficher les impressions d'un film sur la page (show) de ce film. Pour cela, on ajoute quelques impression directement sur PhpMyAdmin pour commencer</p>
    <p>7. une fois l'affichage fonctionnel, on s'occupe de créer, supprimer et editer une impression</p>
    <p>le formulaire de création d'impression est directement sur la page du film</p>
    <p>8. Lorsque tout est fonctionnel, focus sur les users : dans cette nouvelle entité, on trouvera un username, un password et un email (le username sera utilisé pour l'authentification)</p>
    <p>9. Créer une methode de création de compte, avec un mot de passe en clair dans un premier temps, puis avec un mot de passe hashé</p>
    <p>10. Créer une methode de login et la tester, s'assurer de la bonne configuration des encoders, providers et firewalls</p>
    <p>11. vider les tables SQL et lier les users aux films et impressions de maniere a ce que qu'ils aient tous deux un auteur, dont on pourra voir le nom sur un film ou une impression</p>
    <p>12. Réadapter les différentes methodes de création/suppression/edition afin qu'un film/une impression ait toujours un auteur pour etre créé, et qu'une édition ou suppression ne puisse etre faite que par l'auteur d'un film ou impression</p>
    <p>13. Sécuriser les fonctionnalités : sans être connecté, on peut uniquement voir les films et impressions, il faut etre connecté pour créer, supprimer ou éditer</p>
    <hr><hr><h3>BONUS</h3>
    <p>14. Mettre en place un systeme de catégorie de film (horreur, comédie etc) avec simplement une propriété description. Les films auront une catégorie, les catégories pourront etre liées à plusieurs films. Réadapter les formulaires de création de films et afficher leurs catégories. On ajoutera simplement quelques catégories dans la base de données, pas d'interface de création</p>
    <p>15. Mettre en place un systeme de Likes et de compte de likes pour chaque film et impression : pour chaque film ou impression, un bouton sera disponible et affichera le nombre de likes, et sera cliquable lorsque connecté, pour ajouter ou retirer un like, eventuellement changer de couleur si l'user en cours à liké ou non. A tester sans AJAX puis avec AJAX</p>
    <hr><hr><h3>MAXI-BONUS</h3>
    <p>16. Mettre en place un role Admin qui permet d'avoir un bouton de suppression sur chaque film ou like, egalement une page qui liste les utilisateurs et qui permet de les supprimer</p>
    <p>17. Ajouter une image et une fonctionnalité d'upload d'image pour chaque film (penser à vider la base de données)</p>
    <hr><hr>
    <h3>Ce travail n'est pas un exercice de front-end, il ne faut pas perdre de temps à faire du CSS. Quelques classes Bootstrap et une navbar simple suffiront.</h3>
    <p>vous etes libres de vos choix graphiques, du moment que l'interface est simple et que son design n'est pas chronophage</p>
    <h2>Rendu :</h3>
        <p>-soit un dépot github pour ceux qui sont habitués</p>
        <p> <strong> soit une archive contenant les dossiers : config, src et templates</strong></p>
