# SAE Minecraft

---

#### 1. Objectif
Ce projet vise à intégrer un gant connecté dans un environnement virtuel en utilisant un ESP32
pour interagir avec le jeu Minecraft. L'objectif est d'activer des super pouvoirs lors d'un mini-jeu
afin de rendre l'expérience de jeu immersive et interactive.


---

#### 2. Contexte
**Des user stories nous ont été imposées pour définir le but de la SAE. Voici les user stories :**
1. Deux joueurs vont jouer en réseau à Minecraft. Quand un joueur joue, il voudra récupérer
le plus rapidement possible un diamant qui aura été caché de manière aléatoire afin de
remporter la partie.
Besoin d'un réseau connectant les Raspberry et les ESP.
Création d'un serveur Minecraft pour permettre plusieurs connexions simultanées.
Mise en place d'un mini-jeu qui cache aléatoirement un diamant.
2. Chaque joueur dispose d’un gant connecté qui lui donnera accès à des super pouvoirs et
des pièges (malus) contre l’adversaire dans le jeu Minecraft.
Création de super pouvoirs et de pièges dans Minecraft.
3. Chaque gant dispose d’un bouton sur chaque doigt (sauf le pouce), chaque appui sur un
bouton activera une action dans le jeu. Les gants seront autonomes en énergie avec la connexion d’une batterie sur chaque gant.
Création d'un gant connecté avec des boutons.
Mise en place d'un serveur MQTT.
Mise en place d'un script Python.
4. Lorsqu'un joueur se déplace, il devra savoir s'il se rapproche ou s'éloigne du diamant. Un
texte devra s'afficher pour l'informer. S'il est très proche, le texte devra indiquer aux 2
joueurs le gagnant.
Création d'un système affichant la distance entre le joueur et le bloc de diamant.
Mise en place d'une détection de victoire et affichage aux joueurs.
5. On pourra faire un réglage du gant afin d'assigner des super pouvoirs à chaque doigt, le
choix du délai anti-rebond, éventuellement du nombre de joueurs.
Rendre le gant stable à son utilisation.
Augmenter le nombre de joueurs.
Création de super pouvoirs uniques à chaque doigt.

---

#### 3. But du jeu
Quatre joueurs vont jouer en réseau à Minecraft. L'une des deux équipes devra récupérer le
plus rapidement possible un diamant qui aura été caché de manière aléatoire afin de remporter
la partie. L'autre équipe devra protéger ce bloc de diamant.

---

#### 4. Règles du Jeu
Quatre joueurs, par équipes de deux.
La partie se termine lorsque le bloc de diamant est détruit ou après 10 minutes.
Une équipe de défenseurs et une équipe d'assaillants.
Chaque équipe aura un combattant chargé de casser/défendre le bloc et un sorcier qui
activera les pouvoirs tout en assistant l'autre joueur.
