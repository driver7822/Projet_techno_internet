--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.20
-- Dumped by pg_dump version 13.2

-- Started on 2021-05-24 15:51:37

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 215 (class 1255 OID 113762)
-- Name: ajoutavis(text, date, text, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajoutavis(text, date, text, integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_pseudo alias for $1;
	declare f_date alias for $2;
	declare f_message alias for $3;
	declare f_id_produit alias for $4;
	declare id integer;
	declare retour integer;

BEGIN
	SELECT id_utilisateur INTO id FROM utilisateur WHERE pseudo = f_pseudo;
	
	IF NOT FOUND THEN
		retour = 0;
	ELSE
		INSERT INTO avis (message,date_message,id_produit,id_utilisateur) VALUES (f_message,f_date,f_id_produit,id);
		retour = 1;
	END IF;
	
	return retour;
END;
';


--
-- TOC entry 212 (class 1255 OID 113753)
-- Name: ajoutproduit(text, text, real, integer, text, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajoutproduit(text, text, real, integer, text, integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_nom alias for $1;
	declare f_description alias for $2;
	declare f_prix alias for $3;
	declare f_stock alias for $4;
	declare f_photo alias for $5;
	declare f_id_categorie alias for $6;
	declare retour integer;
	
	begin
		INSERT INTO produit (nom,description,prix,stock,photo,id_categorie) VALUES (f_nom,f_description,f_prix,f_stock,f_photo,f_id_categorie);
		retour=1;
		return retour;
	end;
';


--
-- TOC entry 210 (class 1255 OID 113744)
-- Name: ajoututilisateur(text, text, text, date, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajoututilisateur(text, text, text, date, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_pseudo alias for $1;
	declare f_nom alias for $2;
	declare f_prenom alias for $3;
	declare f_date_naissance alias for $4;
	declare f_email alias for $5;
	declare f_mdp alias for $6;
	declare retour integer;
	declare id integer;
	
begin
	SELECT INTO id id_utilisateur FROM utilisateur WHERE pseudo = f_pseudo;
		if not found
		then
			INSERT INTO utilisateur (pseudo,nom,prenom,date_naissance,email,mdp) VALUES (f_pseudo,f_nom,f_prenom,f_date_naissance,f_email,MD5(f_mdp));
			retour = 1;
		else
			retour = 0;
		end if;
		return retour;
end;
';


--
-- TOC entry 196 (class 1255 OID 113484)
-- Name: is_admin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_admin(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
declare f_login alias for $1;
	declare f_password alias for $2;
	declare id integer;
	declare retour integer;
	
	begin
		select into id id_admin from table_admin where pseudo = f_login and mdp = f_password;
		
		if not found
		then
			retour = 0;
		else
			retour = 1;
		end if;
		return retour;
	end;
';


--
-- TOC entry 197 (class 1255 OID 113748)
-- Name: is_utilisateur(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_utilisateur(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
declare f_login alias for $1;
	declare f_password alias for $2;
	declare id integer;
	declare retour integer;
	
	begin
		select into id id_utilisateur from utilisateur where pseudo = f_login and mdp = f_password;
		
		if not found
		then
			retour = 0;
		else
			retour = 1;
		end if;
		return retour;
	end;
';


--
-- TOC entry 214 (class 1255 OID 113759)
-- Name: modifiermdputilisateur(text, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.modifiermdputilisateur(text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_pseudo alias for $1;
	declare f_vieux_mdp alias for $2;
	declare f_nouveau_mdp alias for $3;
	declare verif text;
	declare retour integer;
	
begin
	SELECT mdp INTO verif FROM utilisateur WHERE pseudo = f_pseudo;
	
	if not found
	then
		retour = 0;
	else
		if (verif = f_nouveau_mdp) then
			retour = 2;
		else
			UPDATE utilisateur SET mdp=f_nouveau_mdp WHERE pseudo = f_pseudo;
			retour = 1;
		end if;
	end if;
	
	return retour;
end;
';


--
-- TOC entry 211 (class 1255 OID 113752)
-- Name: updateproduit(integer, text, text, real, integer, integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.updateproduit(integer, text, text, real, integer, integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_id_produit alias for $1;
		declare f_nom alias for $2;
		declare f_desc alias for $3;
		declare f_prix alias for $4;
		declare f_stock alias for $5;
		declare f_id_categorie alias for $6;
		declare retour integer;

	begin
		UPDATE produit SET nom=f_nom, description=f_desc, prix=f_prix, stock=f_stock, id_categorie=f_id_categorie WHERE id_produit = f_id_produit;
		if not found
		then
			retour = 0;
		else
			retour = 1;
		end if;
		return retour;
	end;
';


--
-- TOC entry 213 (class 1255 OID 113756)
-- Name: updateutilisateur(integer, text, text, text, text, date); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.updateutilisateur(integer, text, text, text, text, date) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_id_utilisateur alias for $1;
	declare f_pseudo alias for $2;
	declare f_prenom alias for $3;
	declare f_nom alias for $4;
	declare f_email alias for $5;
	declare f_date_naissance alias for $6;
	declare retour integer;
	
begin
	UPDATE utilisateur SET pseudo=f_pseudo, nom=f_nom, prenom=f_prenom, date_naissance=f_date_naissance, email=f_email WHERE id_utilisateur = f_id_utilisateur;
	if not found
	then
		retour = 0;
	else
		retour = 1;
	end if;
	
	return retour;
end;
';


--
-- TOC entry 190 (class 1259 OID 113249)
-- Name: avis_id_avis_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.avis_id_avis_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


SET default_tablespace = '';

--
-- TOC entry 188 (class 1259 OID 113223)
-- Name: avis; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.avis (
    id_avis integer DEFAULT nextval('public.avis_id_avis_seq'::regclass) NOT NULL,
    message text NOT NULL,
    date_message date NOT NULL,
    id_produit integer NOT NULL,
    id_utilisateur integer
);


--
-- TOC entry 189 (class 1259 OID 113246)
-- Name: categorie_id_categorie_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.categorie_id_categorie_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 186 (class 1259 OID 113207)
-- Name: categorie; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.categorie (
    id_categorie integer DEFAULT nextval('public.categorie_id_categorie_seq'::regclass) NOT NULL,
    nom_categorie text
);


--
-- TOC entry 191 (class 1259 OID 113251)
-- Name: produit_id_produit_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produit_id_produit_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 185 (class 1259 OID 113199)
-- Name: produit; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produit (
    id_produit integer DEFAULT nextval('public.produit_id_produit_seq'::regclass) NOT NULL,
    nom text,
    description text,
    prix real,
    stock integer,
    photo text,
    id_categorie integer
);


--
-- TOC entry 193 (class 1259 OID 113468)
-- Name: table_admin; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.table_admin (
    id_admin integer NOT NULL,
    pseudo text,
    mdp text
);


--
-- TOC entry 195 (class 1259 OID 113738)
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.utilisateur_id_utilisateur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 187 (class 1259 OID 113215)
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.utilisateur (
    id_utilisateur integer DEFAULT nextval('public.utilisateur_id_utilisateur_seq'::regclass) NOT NULL,
    pseudo text NOT NULL,
    nom text,
    prenom text,
    date_naissance date,
    email text NOT NULL,
    mdp text NOT NULL
);


--
-- TOC entry 194 (class 1259 OID 113682)
-- Name: vue_avis_user; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_avis_user AS
 SELECT avis.id_avis,
    avis.message,
    avis.date_message,
    avis.id_produit,
    utilisateur.pseudo
   FROM public.avis,
    public.utilisateur
  WHERE (utilisateur.id_utilisateur = avis.id_utilisateur);


--
-- TOC entry 192 (class 1259 OID 113255)
-- Name: vue_produit; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_produit AS
 SELECT produit.id_produit,
    produit.nom,
    produit.description,
    produit.prix,
    produit.stock,
    produit.photo,
    produit.id_categorie
   FROM public.produit;


--
-- TOC entry 2189 (class 0 OID 113223)
-- Dependencies: 188
-- Data for Name: avis; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.avis (id_avis, message, date_message, id_produit, id_utilisateur) VALUES (12, 'Papier splendide !!', '2021-05-12', 1, 3);
INSERT INTO public.avis (id_avis, message, date_message, id_produit, id_utilisateur) VALUES (13, 'Bon rapport qualité prix', '2021-05-20', 7, 1);


--
-- TOC entry 2187 (class 0 OID 113207)
-- Dependencies: 186
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.categorie (id_categorie, nom_categorie) VALUES (2, 'Classeurs');
INSERT INTO public.categorie (id_categorie, nom_categorie) VALUES (3, 'Accessoires');
INSERT INTO public.categorie (id_categorie, nom_categorie) VALUES (1, 'Papier');


--
-- TOC entry 2186 (class 0 OID 113199)
-- Dependencies: 185
-- Data for Name: produit; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (8, 'Evercopy papier A4 80g', 'Papier format A4 <br>
80g<br>
500 feuilles dans la rame', 6.26999998, 15, 'Evercopy_500_papierA4_80g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (11, 'Classeur A4 - Rouge', 'Classeur format A4 <br>
Couleur : Rouge<br>
Dos du classeur : 80mm', 1.45000005, 20, 'ClasseurA4_rouge.jpg', 2);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (12, 'Classeur A4 - Vert', 'Classeur format A4 <br>
Couleur : Vert<br>
Dos du classeur : 80mm', 1.45000005, 20, 'ClasseurA4_vert.jpg', 2);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (13, 'Business surligneur bleu', 'Business surligneur <br>
Couleur : bleu', 0.289999992, 50, 'Business_surligneur_bleu.jpg', 3);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (14, 'Business surligneur rose', 'Business surligneur <br>
Couleur : rose', 0.289999992, 50, 'Business_surligneur_rose.jpg', 3);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (15, 'Business surligneur vert', 'Business surligneur <br>
Couleur : vert', 0.289999992, 50, 'Business_surligneur_vert.jpg', 3);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (16, 'Stabilo Pack 5 Surligneurs', 'Stabilo Boss Mini<br>
sachet de 5 couleurs <br>
couleur : Jaune, Orange, Rose, Vert, Bleu', 6.17999983, 30, 'Stabilo_sachet_5surligneursBoss.jpg', 3);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (6, 'Budget papier A4 80g', 'Papier format A4 <br>80g<br>500 feuilles dans la rame', 3.97000003, 20, 'Budget_500_papierA4_80g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (1, 'Clairefontaine papier A3 250g', 'Papier format A3 <br>250g <br>125 feuilles dans la rame', 19.9500008, 20, 'Clairefontaine_125_papierA3_250g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (5, 'Budget papier A3 80g', 'Papier format A3 <br>
80g<br>
500 feuilles dans la rame', 12.3299999, 10, 'Budget_500_papierA3_80g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (2, 'Clairefontaine papier A3 160g', 'Papier format A3 <br>
160g <br>
250 feuilles dans la rame', 24.75, 20, 'Clairefontaine_250_papierA3_160g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (3, 'Clairefontaine papier A4 160g', 'Papier format A4 <br>
160g<br>
250 feuilles dans la rame', 8.39000034, 20, 'Clairefontaine_250_papierA4_160g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (4, 'Clairefontaine papier A4 110g', 'Papier format A4 <br>
110g<br>
500 feuilles dans la rame', 14.9499998, 20, 'Clairefontaine_500_papierA4_110g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (10, 'Classeur A4 - Noir', 'Classeur format A4 <br>Couleur : Noir<br>Dos du classeur : 80mm', 1.45000005, 20, 'ClasseurA4_noir.jpg', 2);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (9, 'Classeur A4 - Bleu', 'Classeur format A4 <br>Couleur : Bleu <br>Dos du classeur : 80mm', 1.45000005, 20, 'ClasseurA4_bleu.jpg', 2);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (7, 'Discovery papier A4 75g', 'Papier format A4 <br>
75g<br>
500 feuilles dans la rame', 3.3900001, 9, 'Discovery_500_papierA4_75g.jpg', 1);
INSERT INTO public.produit (id_produit, nom, description, prix, stock, photo, id_categorie) VALUES (17, 'Stick de colle UHU', 'Stick de colle UHU', 0.649999976, 0, 'Uhu_colle_stick.jpg', 3);


--
-- TOC entry 2193 (class 0 OID 113468)
-- Dependencies: 193
-- Data for Name: table_admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.table_admin (id_admin, pseudo, mdp) VALUES (1, 'Admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO public.table_admin (id_admin, pseudo, mdp) VALUES (2, 'test', '098f6bcd4621d373cade4e832627b4f6');


--
-- TOC entry 2188 (class 0 OID 113215)
-- Dependencies: 187
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.utilisateur (id_utilisateur, pseudo, nom, prenom, date_naissance, email, mdp) VALUES (1, 'VictorLorf', 'Lorfèvre', 'Victor', '2001-08-20', 'victor.lorfevre@gmail.com', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO public.utilisateur (id_utilisateur, pseudo, nom, prenom, date_naissance, email, mdp) VALUES (3, 'Remise', 'Martens', 'Rémi', '1997-12-25', 'remi.martens@condorcet.be', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO public.utilisateur (id_utilisateur, pseudo, nom, prenom, date_naissance, email, mdp) VALUES (4, 'Alexis', 'Volant', 'Alexis', '2000-10-26', 'alexis.volant@condorcet.be', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO public.utilisateur (id_utilisateur, pseudo, nom, prenom, date_naissance, email, mdp) VALUES (2, 'didierdu25', 'Raoul', 'Didier', '1996-01-20', 'didier.raoul@gmail.com', '098f6bcd4621d373cade4e832627b4f6');


--
-- TOC entry 2200 (class 0 OID 0)
-- Dependencies: 190
-- Name: avis_id_avis_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.avis_id_avis_seq', 13, true);


--
-- TOC entry 2201 (class 0 OID 0)
-- Dependencies: 189
-- Name: categorie_id_categorie_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.categorie_id_categorie_seq', 13, true);


--
-- TOC entry 2202 (class 0 OID 0)
-- Dependencies: 191
-- Name: produit_id_produit_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.produit_id_produit_seq', 23, true);


--
-- TOC entry 2203 (class 0 OID 0)
-- Dependencies: 195
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.utilisateur_id_utilisateur_seq', 4, true);


--
-- TOC entry 2063 (class 2606 OID 113472)
-- Name: table_admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.table_admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 2061 (class 2606 OID 113230)
-- Name: avis avis_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_pkey PRIMARY KEY (id_avis);


--
-- TOC entry 2055 (class 2606 OID 113214)
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id_categorie);


--
-- TOC entry 2053 (class 2606 OID 113206)
-- Name: produit produit_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_pkey PRIMARY KEY (id_produit);


--
-- TOC entry 2057 (class 2606 OID 113704)
-- Name: utilisateur pseudo_uk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT pseudo_uk UNIQUE (pseudo);


--
-- TOC entry 2059 (class 2606 OID 113222)
-- Name: utilisateur user_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT user_pkey PRIMARY KEY (id_utilisateur);


--
-- TOC entry 2065 (class 2606 OID 113236)
-- Name: avis avis_id_produit_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_id_produit_fkey FOREIGN KEY (id_produit) REFERENCES public.produit(id_produit) NOT VALID;


--
-- TOC entry 2066 (class 2606 OID 113241)
-- Name: avis avis_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_id_user_fkey FOREIGN KEY (id_utilisateur) REFERENCES public.utilisateur(id_utilisateur) NOT VALID;


--
-- TOC entry 2064 (class 2606 OID 113231)
-- Name: produit produit_id_categorie_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_id_categorie_fkey FOREIGN KEY (id_categorie) REFERENCES public.categorie(id_categorie) NOT VALID;


-- Completed on 2021-05-24 15:51:41

--
-- PostgreSQL database dump complete
--

