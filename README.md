# SAE_502 Piloter un projet informatique
### Cahier des Charges Détails
**Projet : Infrastructure réseau pour un hôpital de campagne (YETA Networks)**  
**Équipe : Théo Marchand (3B), Erwann Sautet (3D), Yoland Coudert-Bourne (3A), Adrien Le Gousse (3B)**  
**SAÉ 502 : Piloter un projet informatique**  

---

#### 1. Objectif
L’objectif est de mettre en place une infrastructure réseau sécurisée et adaptée à un hôpital de campagne. Le réseau doit permettre la communication interne et externe, assurer la gestion des objets connectés pour la sécurité et la gestion de l’hôpital, tout en garantissant la protection des données sensibles des patients.

---

#### 2. Contexte
L’hôpital de campagne sera opérationnel à distance via un réseau WAN. Il doit permettre la gestion cloisonnée des services (médical, administration, IoT) et assurer la sécurité des échanges de données. Le réseau devra intégrer des dispositifs de sécurité avancés, des systèmes de téléphonie IP, ainsi que des objets connectés (IoT) pour la surveillance et la gestion des infrastructures.

---

#### 3. Équipements réseau requis

##### 3.1 Routeur  
**Nombre :** 8 unités minimum  
**Fonctionnalités :**  
- Sécurisation des flux entrants et sortants  
- Support du VPN pour interconnecter plusieurs sites  
- Priorisation des services critiques (médicaux, sécurité)  
**Caractéristiques :**  
- Compatibilité avec les protocoles de cybersécurité  
- DMZ pour accès public  

##### 3.2 Switch  
**Nombre :** 4 unités (modèle : Alcatel 6360)  
**Fonctionnalités :**  
- Répartition du réseau en segments (médical, administration, sécurité)  
- Support VLAN pour cloisonner les réseaux  
**Caractéristiques :**  
- PoE pour caméras et téléphones IP  

##### 3.3 Pare-feu (Firewall)  
**Nombre :** 3 unités minimum  
**Fonctionnalités :**  
- Filtrage des accès, prévention des intrusions  
- Analyse des flux en temps réel, prévention contre les attaques DDoS  
**Caractéristiques :**  
- Support IPS/IDS  

##### 3.4 Téléphonie IP  
**Nombre de postes :** 10 postes téléphoniques  
**Fonctionnalités :**  
- Téléphonie VoIP interne et externe  
- Communication interservice, liaison avec l'accueil  
**Caractéristiques :**  
- Système de téléphonie intégré au réseau de l’hôpital  

---

#### 4. Sécurité réseau et cybersécurité

##### 4.1 Séparation des flux réseau  
- Cloisonnement des services : réseau médical, administration, IoT  
- Sécurité des flux pour éviter les intrusions  

##### 4.2 Authentification  
- Authentification centralisée via 802.1X et Radius  
- Gestion des accès sécurisés pour les utilisateurs fixes et mobiles  

##### 4.3 Accès restreint à certaines salles  
- Accès sécurisé aux zones sensibles via des lecteurs de badge  
- Capteurs pour surveiller l'ouverture/fermeture des portes  

##### 4.4 Vidéosurveillance  
- Caméras IP pour la surveillance interne et externe  
- Accès restreint aux flux vidéos  

##### 4.5 Données des patients  
- Accès contrôlé et limité aux données des patients en fonction des niveaux de responsabilité  
- Stockage des données sur des serveurs sécurisés  

---

#### 5. Objets connectés (IoT) et gestion des infrastructures

##### 5.1 Capteurs de sécurité  
- Capteurs de mouvement et de qualité de l’air dans les salles de soins  
- Suivi des accès via capteurs aux portes  

##### 5.2 Contrôle d'accès  
- Lecteurs de badge RFID pour l'accès du personnel et des visiteurs  

---

#### 6. Gestion et maintenance

##### 6.1 Sauvegardes et reprise après sinistre  
- Système de sauvegarde des données patients et logs d’accès  
- Réinstallation automatique des serveurs en cas de panne  

##### 6.2 Procédures de basculement  
- Serveur de secours pour garantir la continuité des services  
- Rotation des serveurs principal et de secours  

##### 6.3 Maintenance et astreinte  
- Contrats de maintenance avec délais garantis  
- Support technique 24/7 pour les urgences  

---

#### 7. Infrastructure réseau et accès distant

##### 7.1 Couverture Wifi  
- Couverture Wifi complète pour garantir la connectivité des dispositifs IoT et du personnel  

##### 7.2 Interconnexion VPN  
- VPN sécurisé pour l’accès distant à l’hôpital  

##### 7.3 Téléphonie et communications  
- Réseau de téléphonie IP interne pour les communications entre services  
- Interconnexion avec le service d'accueil  

---

#### 8. Outils de gestion

##### 8.1 Gestion de projet  
- **Trello** pour le suivi des tâches  

##### 8.2 Collaboration et stockage  
- **Google Drive** pour le partage et la gestion des documents  

##### 8.3 Gestion de version  
- **GitHub** pour la gestion des configurations réseau et scripts  

---

#### 9. Budget Prévisionnel

##### 9.1 Matériel Réseau  
1. **Routeurs (8 unités minimum)** :  
   - Prix unitaire : 500 € à 1 000 €  
   - Total : 4 000 € à 8 000 €  
2. **Switchs (4 unités)** :  
   - Prix unitaire : 300 € à 600 €  
   - Total : 1 200 € à 2 400 €  
3. **Pare-feu (3 unités minimum)** :  
   - Prix unitaire : 1 000 € à 2 000 €  
   - Total : 3 000 € à 6 000 €  
4. **Téléphonie IP (10 postes)** :  
   - Prix unitaire : 150 € à 300 €  
   - Total : 1 500 € à 3 000 €  
5. **Caméras IP (5 à 10 unités)** :  
   - Prix unitaire : 200 € à 500 €  
   - Total : 1 000 € à 5 000 €  

##### 9.2 Infrastructures de Sécurité et IoT  
1. **Capteurs de sécurité** :  
   - 100 € par unité  
   - Total : 1 000 € à 2 000 €  
2. **Contrôle d'accès (lecteurs/graveurs)** :  
   - Prix unitaire : 510 €  
   - Total : 2 550 €  

##### 9.3 Maintenance et Support  
- **Contrats de maintenance** : 7 450 € par an  
- **Support technique 24/7** : 3 000 € par an  

##### 9.4 Coûts de Formation  
- Formation : 1 500 €  

##### 9.5 Coûts d'Installation et de Déploiement  
1. Installation des équipements réseau : 8 430 €  
2. Téléphonie IP : 1 100 €  
3. Vidéosurveillance et IoT : 1 500 €  
4. Contrôle d’accès : 450 €  
5. Tests et validation : 1 100 €  
**Total Installation :** 12 580 €  

##### 9.6 Ajustements et Prévisions de Déploiement  
Les ajustements seront effectués en fonction des contraintes logistiques. Un planning détaillé sera fourni avant le début des travaux.  

---

**Budget Global :** 28 500 € à 64 000 €  
Ce budget couvre l’ensemble des équipements, services de maintenance, installation et formation nécessaires pour la mise en place du réseau.
