# SAE_Minecraft
---
Yanis DEZZAZ,
Guillaume GREDER,
Xavier KNOEPFFLER-POUT,
Théo MARCHAND,
***
# Introduction
## Présentation du projet

Ce projet  a pour objectif d'intégrer un gant connecté à un environnement virtuel. Nous utiliserons un ESP32 qui devrait interagir avec le jeu Minecraft, en activant des super pouvoirs lors d'un mini-jeu.

## Liste du matériel
Lors de cette SAE nous aurons à notre disposition le matériel suivant :
- 2 Raspberry
- Borne Lynksys
- Ordinateurs portables
- 2 ESP32
- Câbles
- Platine de montage
- Boutons

## Définition du Projet

Des user stories nous ont été imposé pour définir le but de la SAE. Voici les user stories :


1. Deux joueurs vont jouer en réseau à Minecraft . Quand un joueur joue , il voudra récupérer le plus rapidement possible un diamant qui aura été caché de manière aléatoire afin de gagner la partie. 
	- Dans la première user story, on peut voir qu'on aura besoin d'un réseau capable de connecter les Raspberry et les ESP ensembles.
	- Créer un Serveur Minecraft pouvant accueillir simultanément plusieurs clients.
	- Créer un mini-jeu qui cache aléatoirement un diamant.
2. Chaque joueur dispose d’un gant connecté qui lui donnera accès à des superpouvoirs et des pièges (malus) contre l’adversaire dans le jeu Minecraft.
	- Créer des super pouvoirs et pièges dans Minecraft
3.  Chaque gant dispose d’un bouton sur chaque doigt (sauf le pouce), chaque appui sur un bouton activera une action dans le jeu. Les gants seront autonomes en énergie avec la connexion d’une batterie sur chaque gant
	- Créer un gant connecté avec des boutons
	- Mise en place d'un serveur MQTT
	- Mise en place d'un script python
4. Lorsqu'un joueur se déplace, il devra savoir s'il se rapproche ou s'éloigne du diamant. un texte devra s'afficher pour l'informer. S'il est très proche, le texte devra indiquer aux 2 joueurs, le gagnant.
	- Créer un système qui permet d'afficher la distance entre le joueur et le bloc de diamant.
	- Créer une détection de victoire et de l'afficher aux joueurs. 
5. on pourra faire un réglage du gant afin d'assigner des supers pouvoirs à chaque doigt, le choix du délai anti rebond, éventuellement du nombre de joueurs.
	- Rendre le gant stable a son utilisation.
	- Augmenter le nombre de joueur.
	- Créer des super pouvoirs uniques à chaque doigts.
# Règle du jeu

Nous allons affiner les régler du jeu pour avoir une meilleur vue du projet.
## But du jeu
Quatre joueurs vont jouer en réseau à Minecraft . L'une des deux équipes devra récupérer le plus rapidement possible un diamant qui aura été caché de manière aléatoire afin de gagner la partie. L'autre équipe devra protéger ce bloc de diamant.
## Règles du jeu
- Quatre joueurs, par équipes de deux.
- La partie se termine quand le bloc de diamant est détruit ou après 10 minutes.
- Une équipe de défenseur et une équipe d'assaillant.
- Par équipe, il aura un combattant qui devra casser/défendre le bloc et un sorcier qui activera les pouvoirs et qui assistera l'autre joueur.

## Sommaire :

I. User Story 1
	a. Mise en place d'un réseau
	b. Serveur Minecraft
	c. Bloc de diamant
II. User Story 2
	a. super pouvoir
III. User Story 3
	a. Serveur MQTT
	b. Detection de bouton
	c. Connexion Wifi
	d. Publication MQTT
	e. Script Python
	f. Energie
IV. User Story 4
	a. Détections de victoire
	b. Afficher la distance du bloc de diamant
V. Bonus
	a. Texture Pack
	b. Map
	c. Outil
VI. Gestion de Projet
VII. Conclusion

# I. User Story 1

## a. Mise en place d'un réseau

![[Réseau.png]]

Voici l'architecture de notre réseau. Le client peut être un ordinateur personnel ou la Raspberry avec un client Minecraft ou MQTT pour des tests et le serveur réellement une Raspberry, mais nous avons utiliser nos ordinateurs personnels pour les tests, afin de ne pas être limité par la puissance de la Raspberry.
Pour la configuration de la borne, nous avons effectuer un reset et changer le SSID et mot de passe, ainsi que la sécurité de la connexion en WPA Personnal pour que l'ESP puisse se connecter.

## b. Serveur Minecraft

L'architecture matériel de la Raspberry limite les versions de Minecraft qu'on peut utiliser. Les versions "Classic" ne sont pas adapté à la Raspberry. Cependant, grâce au launcher (application qui permet de lancer Minecraft) Prism Launcher (https://prismlauncher.org/), nous pouvons avoir accès à tous les versions de Minecraft. Nous l'avons installer depuis un app store dédié à la Raspberry, Pi-Apps (https://pi-apps.io/).
Nous avons utilisés la version Fabric de Minecraft. Fabric est un "mod loader", Un version modifié qui permet d'ajouter des mods (rajoute de contenu) qui peut être utile à la création de mini-jeu ou une aide de jeu. Par exemple à la construction de map, l'affichage de donnée utile au débogage. Voici les commandes nécessaire pour faire fonction le serveur : 
```bash
sudo apt install openjdk-17-jre
mkdir ~/Documents/ServeurMinecraft
cd ~/Documents/ServeurMinecraft
wget https://meta.fabricmc.net/v2/versions/loader/1.20.4/0.15.3/1.0.0/server/jar
java -Xmx2G -jar fabric-server-mc.1.20.4-loader.0.15.3-launcher.1.0.0.jar nogui
nano eula.txt
###remplacer false par true
java -Xmx2G -jar fabric-server-mc.1.20.4-loader.0.15.3-launcher.1.0.0.jar nogui
```
Et nous avons un serveur fonctionnel.
## c. Bloc de diamant

Pour placer aléatoirement le bloc de diamant nous avons utilisés les datapacks. Les datapacks est un langage natif de Minecraft qui permet de créer des scripts. Nous retrouves des choses similaire à un langage de programmation ordinaire. Le système de classes, de fonctions, variables et etc...
A l'exécution du datapack nous définition un tableau de valeur qui stockera les coordonnées du bloc de diamant avec ces commandes.

	scoreboard objectives remove coordinates
	scoreboard objectives add coordinates dummy

La première ligne nous effaçons l'ancien tableau existe et après nous le recréons. Ensuite nous allons stocker des coordonnés générer de façon aléatoire dans le tableau avec le joueur x, y et z.

	execute store result score x coordinates run random roll 0..50
	execute store result score y coordinates run random roll 0..50
	execute store result score z coordinates run random roll 0..50

donc il génère un nombre entre 0 et 50. Ensuite, vu que nous pouvons pas simplement faire apparaitre ce bloc à ces coordonnes nous allons faire autrement. Nous allons faire apparaître un porte-armure, invisible, indestructibles et non-soumis à la gravité avec un identifiant pour qu'il soit unique au coordonnées 0 en x, 0 en y et 0 en z.

	summon armor_stand 0 0 0 {NoGravity:1b,Invulnerable:1b,Invisible:1b,Tags:["diamond"]}

Ensuite, Nous pouvons pas le faire téléporter d'un coup au coordonnées mais on peut utilise une autre méthode. 

	execute at @e[tag=diamond,limit=1] run tp @e[tag=diamond] ~1 ~ ~

Cette ligne s'exécute en tant que le porte-armure avec le identifiant diamond et le téléporte de sa position initiale mais ajouter +1 en x. Donc par exemple si le nombre généré et 23 en x et que nous exécutons 23 fois. le porte-armure sera à la coordonnés x:23 y:0 et z:0.

	execute if score x coordinates matches 1.. at @e[tag=diamond,limit=1] run tp @e[tag=diamond] ~1 ~ ~
	execute if score x coordinates matches 1.. run scoreboard players remove x coordinates 1

La première ligne correspond à : "Si x est différent de 0 tu téléporte le porte-armure à +1 de sa coordonnés x" et la deuxième : "Si x est différent de 0 faire -1 à x"

donc on fait ça pour tous les axes (x, y et z) et on rappelle la fonction tant que toutes les valeurs ne sont pas à 0. Quand x, y et z sont à 0 alors nous pouvons exécuter cette commande :

	execute if score x coordinates matches 0 if score y coordinates matches 0 if score z coordinates matches 0 at @e[tag=diamond] run setblock ~ ~ ~ diamond_block

et on place le bloc de diamant à la position du porte-armure et nous pouvons faire disparaître ce porte-armure.

# II. User Story 2

## a. super pouvoir

Donc on va créer 4 super pouvoirs. Voici la liste des pouvoirs qu'on souhaite :
- Super Saut
- Super Punch
- Cocon
- Lenteur

Le Super Saut se décompose en deux phase la monté et la descente. Pour la monté nous appliquons un effet de Minecraft qui s'appelle lévitation. Il fait s'envole le joueur.

	effect give @a[gamemode=survival,team=red] levitation 5 10 true

la ligne donne un effet de lévitation au joueur en survie de l'équipe rouge (combattant) pendant 5s de puissance 10 et on cache les effets au joueur (true). Donc le joueur va avoir l'impression d'avoir fait un grand saut mais le problème si la chute est trop importante, il peut mourir de dégât de chute. Donc nous allons données en même temps un effet de chute ralenti pendant plus longtemps.

	effect give @a[gamemode=survival,team=red] slow_falling 30 1 true

Pendant 30 secondes de puissance 1 donner l'effet chute ralenti.

Le Super Punch va être un gant qui inflige plus de dégâts et donne un effet de recul plus important qu'un gant normal.

	give @a[gamemode=survival,team=red] stone_sword{HideFlags:1,Damage:129,CustomModelData:1,Enchantments:[{id:"minecraft:knockback",lvl:10s}]} 1

On donne une épée au joueur avec l'enchantement knockback de niveau 10 et il ne reste plus que 3 trois à l'épée avant de se casse. Comme ça le joueur ne garde pas indéfiniment cette épée. "Damage:129" signifie que l'épée a été endommager 129 fois et la durabilité de l'arme est de 131. Et pour que ce soit un gant nous utilisons un pack de texture et nous applique le model customisé numéro 1 ou 2 selon l'équipe.

Le cocon crée une cage autour du joueur soit de bloc de magma qui font des dégâts assez léger ou fait apparaître une bulle d'eau selon l'équipe.

	execute at @a[team=red,gamemode=survival] run setblock ~ ~ ~ water keep

On fait apparaître sur l'équipe d'adverse un bloc seulement si l'endroit est vide (ou de l'air fait avec l'option keep) sinon on garde le bloc en place pour éviter de casser le bloc de diamant.

On répète l'opération pour le nombre de bloc à poser.

La lenteur est un pouvoir qui obstrue la vue et ralenti l'ennemi comme avec une malédiction. Pour faire ça nous utilisons deux effets de potions avec l'effet slowness et blindness.

	 effect give @a[team=red,gamemode=survival] slowness 15 3 true
	effect give @a[team=red,gamemode=survival] blindness 10 3 true

Donc l'effet de ralentissement est donné pendant 15 secondes et de puissance 3 et d'aveuglement pendant 10 secondes à l'équipe adverse.

# III. User Story 3

## a. Serveur MQTT

Installation de MQTT sur raspberry via la command " _sudo apt install mosquitto_ ". Nous avons créer un fichier default.conf dans le repertoire /etc/mosquitto/conf.d/ avec la configuration :  
_listener 1883 (se placer sur le port 1883)_

_allow_anonymous true (autoriser toutes les connections même inconnu)_

Ensuite, il suffit de lancer le serveur avec la commande :

_- mosquitto -c /etc/mosquitto/conf.d/default.conf_

(a l'installation du paquet mosquitto un serveur est démarré donc il est important de l'éteindre avec la commande "service mosquitto stop" ).

 Pour tester le serveur on installe mosquitto-clients avec la commande "_apt install mosquitto-clients_". On a réussi le test de connexion sur la même machine et ensuite sur le même réseau.

Nous pouvons ajouter des mots de passe pour augmenter la sécurité du réseau. Pour commencer, nous exécutons la commande "_mosquitto_passwd -b passwordfile Utilisateur MotdePasse"_. Il faut modifier le fichier  de configuration "_sudo nano /etc/mosquitto/conf.d/default.conf_". 

	per_listener_settings true`
	allow_anonymous false
	password_file /etc/mosquitto/passwordfile
	listener 8883

Après redémarré le serveur mosquitto nous pouvons effectuer des tests.
	
	mosquitto_sub -h localhost -t \# -v -u Utilisateur -P MotdePasse
	mosquitto_pub -h localhost -m "test" -t topic/test -u Utilisateur -P MotdePasse

Nous avons réussi à nous connecter en local et en réseau avec les mot de passes.

## b. Détection de bouton

Nous pouvons maintenant passer à la réalisation du gant.
![[espmontage.png]]

Ce schéma a été fait avec une carte Arduino mais nous l'avons réellement fait sur l'ESP32. Nous avons commencer par la réalisation d'un programme pour détecter la pression de bouton.
```cpp
	const int but1 = 34; 
	const int but2 = 35;
	const int but3 = 32;
	const int but4 = 33;
	
	void setup()
	{
	  pinMode(but1, INPUT);
	  pinMode(but2, INPUT);
	  pinMode(but3, INPUT);
	  pinMode(but4, INPUT);
	  Serial.begin(921600);
	}
	
	void loop()
	{
	  delay(100);
	  if( digitalRead(but1)==1 ){
	    Serial.println("Boutton 1 pressé.");
	    while(digitalRead(but1)==1){delay(50);Serial.print(".");}
	    Serial.println("fin de la pression");
	  }
	  else if( digitalRead(but2)==1 ){
	    Serial.println("Boutton 2 pressé.");
	    while(digitalRead(but2)==1){delay(50);Serial.print(".");}
	    Serial.println("fin de la pression");
	  }
	  else if( digitalRead(but3)==1 ){
	    Serial.println("Boutton 3 pressé.");
	    while(digitalRead(but3)==1){delay(50);Serial.print(".");}
	    Serial.println("fin de la pression");
	  }
	  else if( digitalRead(but4)==1 ){
	    Serial.println("Boutton 4 pressé.");
	    while(digitalRead(but4)==1){delay(50);Serial.print(".");}
	    Serial.println("fin de la pression");
	  }
	}
```
![[arduinoterminal.png]]
Avec ce montage avec un bouton poussoir de type pulldown, il n'y aucune perturbation et l'appui donne un résultat unique. La réponse est très réactive.

## c. Connexion WIFI

Nous avons pris le WifiClientBasic qui se trouve dans les exemples de codes de Arduino pour tester la connexion à notre réseau.

```cpp
	#include <WiFi.h>
	#define WIFI_SSID       "plouf"
	#define WIFI_PASSWORD   "dracaufeu"
	
	WiFiClient client;
	
	void setup()
	{
	  byte mac[6];
	  WiFi.macAddress(mac);
	  device.setUniqueId(mac, sizeof(mac));
	  Serial.begin(921600);
	  delay(10);
	  
	  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
	  Serial.println();
	  Serial.println();
	  Serial.print("Waiting for WiFi... ");
	  while (WiFi.status() != WL_CONNECTED) {
	    Serial.print(".");
	    delay(500);
	  }
	  Serial.println();
	  Serial.println("Connected to the network");
	  Serial.println("");
	  Serial.println("WiFi connected");
	  Serial.println("IP address: ");
	  Serial.println(WiFi.localIP());
	  delay(500);
	}
	
	void loop(){}
```
Voici le résultat après exécution :
![[Wificlientscreen.png]]

## d. Publication MQTT

Nous avons crée un programme qui permet de faire des publication MQTT

```cpp
	#include <WiFi.h>
	#include <ArduinoHA.h>
	#define BROKER_ADDR     IPAddress(192, 168, 1, 115)
	#define WIFI_SSID       "plouf"
	#define WIFI_PASSWORD   "dracaufeu"
	
	WiFiClient client;
	HADevice device;
	HAMqtt mqtt(client, device);
	
	void setup()
	{
	  byte mac[6];
	  WiFi.macAddress(mac);
	  device.setUniqueId(mac, sizeof(mac));
	  Serial.begin(921600);
	  delay(10);
	
	  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
	  Serial.println();
	  Serial.println();
	  Serial.print("Waiting for WiFi... ");
	  while (WiFi.status() != WL_CONNECTED) {
	    Serial.print(".");
	    delay(500);
	  }
	  Serial.println();
	  Serial.println("Connected to the network");
	  Serial.println("");
	  Serial.println("WiFi connected");
	  Serial.println("IP address: ");
	  Serial.println(WiFi.localIP());
	  delay(500);
	
	  mqtt.begin(BROKER_ADDR,8883,"dracaufeu","carapuce");
	}
	
	void loop()
	{
	  mqtt.loop();
	  mqtt.publish("ESP/test/", "1");
	  delay(100);
	}
```
Après exécution nous pouvons voir les messages (ESP/test/ 1)envoyer via un souscription sur un client.

Une fois que chaque programme fonction nous avons tous assemblés et ajouter une fonctionnalité qui permet d'allumé une LED leur de l'envoyer d'un messages MQTT spécifique pour vérifier que l'ESP est bien connecté.

```cpp
#include <WiFi.h>
#include <ArduinoHA.h>

// Définition des constantes
#define BROKER_ADDR     IPAddress(192, 168, 1, 115)  // Adresse IP du broker MQTT
#define WIFI_SSID       "plouf"  // SSID du réseau WiFi
#define WIFI_PASSWORD   "dracaufeu"  // Mot de passe du réseau WiFi
#define LED_PIN         2  // Broche de la LED

// Initialisation des objets et des variables
WiFiClient client;  // Objet client WiFi
HADevice device;  // Objet représentant le périphérique Home Assistant
HAMqtt mqtt(client, device);  // Objet MQTT avec le client WiFi et le périphérique Home Assistant

// Déclaration d'un interrupteur Home Assistant
HASwitch ledSwitch("led");

// Broches pour les boutons
const int but1 = 34;
const int but2 = 35;
const int but3 = 32;
const int but4 = 33;
int firstload = 0;  // Variable pour gérer le premier chargement

// Fonction appelée lorsqu'une commande d'interrupteur est reçue
void onSwitchCommand(bool state, HASwitch* sender)
{
    Serial.print("Received switch command: ");
    Serial.println(state ? "ON" : "OFF");
    digitalWrite(LED_PIN, state ? HIGH : LOW);
    sender->setState(state); // rapporte l'état à Home Assistant
}

// Configuration initiale du programme
void setup()
{
    // Configuration des broches des boutons en tant qu'entrées
    pinMode(but1, INPUT);
    pinMode(but2, INPUT);
    pinMode(but3, INPUT);
    pinMode(but4, INPUT);

    // Obtention de l'adresse MAC pour identifier de manière unique le périphérique
    byte mac[6];
    WiFi.macAddress(mac);
    device.setUniqueId(mac, sizeof(mac));

    Serial.begin(921600);
    delay(10);

    // Connexion au réseau WiFi
    WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
    Serial.println();
    Serial.println();
    Serial.print("Waiting for WiFi... ");
    while (WiFi.status() != WL_CONNECTED) {
        Serial.print(".");
        delay(500);
    }
    Serial.println();
    Serial.println("Connected to the network");
    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
    delay(500);

    // Configuration du périphérique Home Assistant
    device.setName("ESP-AQUA");
    device.setSoftwareVersion("1.0.0");

    // Configuration de la LED
    pinMode(LED_PIN, OUTPUT);
    digitalWrite(LED_PIN, LOW);

    // Configuration de l'interrupteur Home Assistant
    ledSwitch.onCommand(onSwitchCommand);
    ledSwitch.setName("LED Switch"); // optionnel

    // Configuration de la connexion MQTT
    mqtt.begin(BROKER_ADDR, 8883, "dracaufeu", "carapuce");
}

// Boucle principale du programme
void loop()
{
    // Gestion des événements MQTT
    mqtt.loop();

    // Publication d'un message lors du premier chargement
    if (firstload == 0) {
        mqtt.publish("ESP/AQUA/", "1");
        firstload = 1;
    }

    // Détection des pressions des boutons
    delay(100);
    if (digitalRead(but1) == 1) {
        Serial.println("Bouton 1 pressé.");
        mqtt.publish("ESP/AQUA/buttonPress", "1");
        while (digitalRead(but1) == 1) {
            delay(50);
            Serial.print(".");
        }
        Serial.println("Fin de la pression");
    } else if (digitalRead(but2) == 1) {
        Serial.println("Bouton 2 pressé.");
        mqtt.publish("ESP/AQUA/buttonPress", "2");
        while (digitalRead(but2) == 1) {
            delay(50);
            Serial.print(".");
        }
        Serial.println("Fin de la pression");
    } else if (digitalRead(but3) == 1) {
        Serial.println("Bouton 3 pressé.");
        mqtt.publish("ESP/AQUA/buttonPress", "3");
        while (digitalRead(but3) == 1) {
            delay(50);
            Serial.print(".");
        }
        Serial.println("Fin de la pression");
    } else if (digitalRead(but4) == 1) {
        Serial.println("Bouton 4 pressé.");
        mqtt.publish("ESP/AQUA/buttonPress", "4");
        while (digitalRead(but4) == 1) {
            delay(50);
            Serial.print(".");
        }
        Serial.println("Fin de la pression");
    }
}
```
Le programme fonctionne bien le broker MQTT reçoit toutes les informations et on peut allumer la LED avec une publication.

## e. Script Python

Nous avons besoin d'un script python qui peut lire les publications du gant connecté et qui envois des commandes au serveur Minecraft. Dans un premier temps, nous devons le server.proprieties du serveur Minecraft. Voici les lignes à modifier :

```bash
#Nous pouvons modifier ce port pour plus de sécurité
rcon.port=25575
#Remplacer false par true
enable-rcon=true
#Ajouter un mot de passe
rcon.password=MotdePasse
```
Nous venons d'activer la fonction "Remote Console" qui permet d’accéder à la console à distance par exemple via Python et ainsi exécuter des commandes.

```Python
import paho.mqtt.client as mqtt
from mcrcon import MCRcon
import ssl

# Connexion au serveur Minecraft RCON
with MCRcon("192.168.1.117", "dracaufeu") as mcr:
    # Envoi de la commande "/say mqtt allume" au serveur Minecraft
    resp = mcr.command("/say mqtt allume")
    print(resp)

# Initialisation de la connexion au serveur Minecraft RCON
mcr = MCRcon("192.168.1.117", "dracaufeu")
mcr.connect()

# Fonction appelée lors de la connexion au serveur MQTT
def on_connect(client, userdata, flags, rc):
    print("Connected with result code "+str(rc))
    # S'abonner aux messages du topic "ESP/#"
    client.subscribe("ESP/#")

# Fonction appelée lorsqu'un message est reçu sur un topic MQTT
def on_message(client, userdata, msg):
    # Vérification du topic et traitement en conséquence
    if str(msg.topic) == "ESP/AQUA/buttonPress":
        handle_button_press(msg.payload, "aqua")
    elif str(msg.topic) == "ESP/MAGMA/buttonPress":
        handle_button_press(msg.payload, "magma")
    elif str(msg.topic) == "ESP/AQUA/":
        handle_esp_connection("aqua")
    elif str(msg.topic) == "ESP/MAGMA/":
        handle_esp_connection("magma")
    else:
        print("Unknown topic")
        return "Erreur"

# Fonction pour traiter la pression d'un bouton
def handle_button_press(payload, team):
    if str(payload) == "b'1'":
        print(f"Bouton 1 est pressé pour l'équipe {team}.")
        resp = mcr.command(f"/function {team}:supersaut")
        print(resp)
    elif str(payload) == "b'2'":
        print(f"Bouton 2 est pressé pour l'équipe {team}.")
        resp = mcr.command(f"/function {team}:superpunch")
        print(resp)
    elif str(payload) == "b'3'":
        print(f"Bouton 3 est pressé pour l'équipe {team}.")
        resp = mcr.command(f"/function {team}:cocon")
        print(resp)
    elif str(payload) == "b'4'":
        print(f"Bouton 4 est pressé pour l'équipe {team}.")
        resp = mcr.command(f"/function {team}:lenteur")
        print(resp)

# Fonction pour traiter la connexion d'un ESP
def handle_esp_connection(team):
    print(f"ESP de la team {team} est connecté.")
    # Publication d'un message pour allumer la LED associée à l'ESP
    client.publish(f"aha/08d1f9e8e990/led/cmd_t", "ON")

# Initialisation du client MQTT
client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

# Configuration des informations d'identification pour la connexion au serveur MQTT
client.username_pw_set(username="dracaufeu", password="carapuce")

# Connexion au serveur MQTT
client.connect("192.168.1.115", 8883, 60)

# Boucle principale pour maintenir la connexion au serveur MQTT
client.loop_forever()
```
### Explications du Code Python

#### Importation des bibliothèques
Le code utilise les bibliothèques `paho.mqtt.client` pour la communication MQTT, `mcrcon` pour la communication avec le serveur Minecraft RCON, et `ssl` pour la sécurisation des connexions.

#### Connexion au serveur Minecraft RCON
Le code se connecte au serveur Minecraft RCON à l'adresse IP "192.168.1.117" avec le mot de passe "dracaufeu". Il envoie ensuite une commande "/say mqtt allume" au serveur Minecraft.

#### Initialisation de la connexion au serveur Minecraft RCON
Le code initialise une connexion au serveur Minecraft RCON sans envoyer de commande immédiatement.

#### Fonctions MQTT
Deux fonctions (`on_connect` et `on_message`) sont définies pour gérer les événements de connexion et les messages MQTT reçus.

#### Traitement des Messages MQTT
La fonction `on_message` analyse les messages reçus sur les topics MQTT "ESP/AQUA/buttonPress", "ESP/MAGMA/buttonPress", "ESP/AQUA/", "ESP/MAGMA/" et appelle des fonctions spécifiques en conséquence.

#### Traitement des Pressions de Bouton et Connexions d'ESP
Les fonctions `handle_button_press` et `handle_esp_connection` effectuent des actions spécifiques en fonction des messages reçus, comme l'exécution de commandes Minecraft RCON et la publication de messages MQTT.

#### Configuration du Client MQTT
Le client MQTT est configuré avec des informations d'identification.

#### Connexion au Serveur MQTT et Boucle Principale
Le client MQTT se connecte au serveur MQTT à l'adresse IP "192.168.1.115" sur le port 8883. La boucle principale (`loop_forever()`) maintient la connexion active.

## f. Energie

Nous avons essayer de simuler le cas le moins favorables énergétiquement pour l'ESP lors d'une partie, cet à dire d'appuyer surtout les boutons tous le temps pour avoir un maximum de communication WIFI à faire. En 10 minutes, l'ESP a consommé 12mAh.
![[Pasted image 20240115013537.png]]
La batterie qu'on nous a fourni est de 2000mAh.

2000/1.2= 1666.67min = 27 heures 46 minutes

Si la batterie est chargé complètement, nous pourrions tenir toutes une journée même si la batterie est abîmé.

Une fois le mini-jeu terminé, nous avons placé tous les serveurs et le script python et pris des mesures avec la commande top et vcgencmd measure_temp.

	one@raspberrypi:~ $ vcgencmd measure_temp
	temp=38.4'C

La température du processeur est très correcte. 

	top - 08:28:53 up 14 min, 2 users, load average: 3,10, 1,98, 1,11
	Tâches: 202 total, 5 en cours, 197 en veille, 0 arrêté, 0 zombie
	%Cpu(s): 53,0 ut, 16,0 sy, 0,0 ni, 30,6 id, 0,1 wa, 0,0 hi, 0,3 si, 0,0 st
	MiB Mem : 3793,3 total, 118,7 libr, 3158,3 util, 857,9 tamp/cache
	MiB Éch : 100,0 total, 100,0 libr, 0,0 util. 634,9 dispo Mem
	
	PID UTIL. PR NI VIRT RES SHR S %CPU %MEM TEMPS+ COM.
	2674 one 20 0 10,4g 205484 90448 R 112,5 53,3 0:07.63 java
	2171 one 20 0 5914924 1,8g 26836 S 15,2 8,3 0:17.95 mosquitto
	2498 one 20 0 11,0g 380656 202632 R 23,1 9,8 0:05.31 python

On peut voir que le serveur minecraft utilise plus d'un cœur, il y a des pic à plus de 300% et la mémoire qui dépasse les 70% et de temps en temps surchargé. mais pour mosquitto et Python, leur charge est relativement légère. Malgré tout, en jeu la qualités est relativement satisfaisant pour deux mais pour plus c'est plus compliqué. Mais le jeu répond bien, les plus gros problèmes sont le chargement de zones et la distance de rendu du jeu.
# IV. User Story 4
## a. Détections de victoire

Nous avons deux conditions à vérifier. La première est seul de casser le bloc de diamant. Nous pouvons créer un Scoreboard avec les datapacks de minecraft qui permet de compter le nombre de bloc de diamant casser. Par exemple, Si le joueur Dracaufeu casse un bloc de diamant, il sera afficher et son score augmentera de 1. 

	scoreboard objectives remove redstoneMined
	scoreboard objectives add redstoneMined minecraft.mined:minecraft.redstone_block

et donc si le score augmente d'un on sait quelle équipe à gagner et on afficher un texte selon ça. 

	execute if score @a[team=red,limit=1,gamemode=survival] redstoneMined matches 1.. run scoreboard players set a win 1
	execute if score @a[team=red,limit=1,gamemode=survival] redstoneMined matches 1.. run title @a title {"text":"TEAM MAGMA A GAGNE!!!","color":"gold","bold":true}

et pour savoir si on dépasse les dix minutes on a un scoreboard time avec le joueur t qui augmente de 1 toutes les 10s et à 60 l'autre équipe gagne.

	execute if score t time matches 60 run scoreboard players set a win 1
	execute if score t time matches ..59 run scoreboard players add t time 1
	execute if score a win matches 1 run gamemode spectator
	execute if score a win matches 0 run schedule function partie:windetect 10s
	execute if score a win matches 1 run function partie:end

	execute if score t time matches 60.. run title @a title {"text":"TEAM AQUA A GAGNE!!!","color":"aqua","bold":true}

la commande schedule permet exécution une fonction avec un délais. Donc cette fonction se rappelle elle-même. La commande title permet d'afficher du texte en gros plan sur l'écran des joueurs.

	
## b. Afficher la distance du bloc de diamant

Lors de l'apparition du bloc de diamant nous récupérons ces coordonnées via le porte-armure et nous le stockons dans le scoreboard coordinatesDiamond. Lors de la partie nous récupérons les coordonnées du joueur que nous stockons dans un scoreboard coordinatesBlue(ou coordinatesRed). et nous effectuons l’opération coordonnées du joueur - les coordonnées du bloc de diamant. Ainsi on récupère une valeur qui nous indique si nous nous rapprochons du bloc.

	execute store result score x coordinatesBlue at @a[gamemode=survival,team=blue] run data get entity @a[gamemode=survival,team=blue,limit=1] Pos[0]
	execute store result score y coordinatesBlue at @a[gamemode=survival,team=blue] run data get entity @a[gamemode=survival,team=blue,limit=1] Pos[1]
	execute store result score z coordinatesBlue at @a[gamemode=survival,team=blue] run data get entity @a[gamemode=survival,team=blue,limit=1] Pos[2]
	scoreboard players operation x compassAqua = x coordinatesRedstone
	scoreboard players operation y compassAqua = y coordinatesRedstone
	scoreboard players operation z compassAqua = z coordinatesRedstone
	scoreboard players operation x compassAqua -= x coordinatesBlue
	scoreboard players operation y compassAqua -= y coordinatesBlue
	scoreboard players operation z compassAqua -= z coordinatesBlue
		execute if score a win matches 0 run schedule function partie:redstoneradarblue 1s

et nous affichons les scoreboards avec ces commandes :

	scoreboard objectives setdisplay sidebar.team.blue compassAqua
	scoreboard objectives setdisplay sidebar.team.red compassMagma
Pour les afficher à lors équipe uniquement.
# V. Bonus
## a. Texture Pack

 Nous avons crée un texture pack qui un fichier qui doit s'ajouter sur le client Minecraft. On doit le télécharger et dans les options du jeu, ouvrir le fichier de texture pack et glisser le fichier dans ce dossier. Celui-ci permet de modifier les sons et apparence du jeu. Nous avons donc créer des modèles modifier en forme de gant pour l'épée en pierre.
 ![[Pasted image 20240115005350.png]]
 Les deux gants, on les même propriétés qu'un épée en pierre, seulement l'aspect change. On a également changer les musiques de Minecraft. On s'est inspiré de l'histoire d'un jeu Pokémon, donc on a remplace certaines musiques de Minecraft par celle de Pokémon. ainsi, avec la commande :
 
	playsound music.nether.nether_wastes master @a
	playsound music.overworld.badlands master @a

Une pour l'introduction et l'autre pendant la partie.
## b. Map

La monde que nous avons utilisés pour la SAE a été entièrement fait par nous.

![[Capture d’écran du 2023-12-07 07-40-58.png]]
![[Capture d’écran du 2023-12-07 07-41-19.png]]
![[Capture d’écran du 2023-12-07 07-41-40.png]]
![[Capture d’écran du 2023-12-08 06-55-44.png]]
![[Capture d’écran du 2023-12-08 06-55-57.png]]
![[Capture d’écran du 2023-12-08 06-57-31.png]]

![[Pasted image 20240115010753.png]]
![[Pasted image 20240115011203.png]]

On a ajouté également une détection automatique via des zones pour choisir les roles et l'équipe. A chaque début de partie, on a une cinématique qui présente les règles et les objectif de chaque équipe.
## c. Outil

Pour cette SAE on a utilisé vs code pour développer le data packs avec le site https://mcstacker.net/ qui peut aider pour toutes commandes sauf les scoreboards et la partie execute. Pour construire la map nous avons utiliser WorldEdit https://www.curseforge.com/minecraft/mc-mods/worldedit qui est très utile pour les constructions de grandes evergures. Pour les modèles 3D des gants nous avons utilisés BlockBench https://www.blockbench.net/.
# VI. Gestion de Projet

Nous avons commencé par utiliser une carte mentale pour définir les besoins de la SAE.
![[Pasted image 20240115012513.png]]
et nous l'avons organisés les taches sur un trello.
![[Pasted image 20240115012558.png]]
Nous avons en place un serveur Discord pour communiquer ce fixer des rendez et réunions pour s'organiser et partager les fichier. Repartie en plusieurs salons :
![[Pasted image 20240115012832.png]]
Nous avons essayé de faire travailler tous le monde sur toutes les taches afin garantir la maîtrise de tous les outils. On a évité de se spécialiser sur une tâches et on essayais de travailler soit ensemble ou par groupe de deux.
# VII. Conclusion

La réalisation de cette SAE a été une expérience enrichissante et stimulante. Nous avons pu mettre en œuvre nos compétences en programmation, en conception de jeu et en gestion de projet pour créer un mini-jeu Minecraft innovant et divertissant. L'utilisation de plusieurs technologies, telles que les datapacks, les scripts Python, MQTT, et la configuration d'un serveur Minecraft, a permis de créer une expérience de jeu unique.

La collaboration étroite entre les membres de l'équipe, la communication efficace via Discord, et l'utilisation d'outils tels que Trello ont facilité la coordination des tâches et la gestion du projet. La conception de la map, la création du datapack, l'implémentation des fonctionnalités du gant connecté, la gestion de l'énergie de l'ESP, et la détection de la victoire ont été des aspects essentiels du projet.

L'ajout de bonus tels que le texture pack personnalisé et la création d'une map originale ont contribué à rendre le jeu plus immersif et divertissant. La gestion de l'énergie de l'ESP a également été abordée de manière réaliste, avec des mesures prises pour optimiser la consommation d'énergie et assurer une autonomie suffisante.

En fin de compte, la SAE a abouti à la création d'un jeu original et à une expérience complète qui a mis en avant notre créativité, nos compétences techniques et notre capacité à prévenir les problèmes. Nous avons également acquis une expérience précieuse dans la gestion de projet collaboratif et la réalisation de projets complexes.
