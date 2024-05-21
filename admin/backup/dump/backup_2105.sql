--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1
-- Dumped by pg_dump version 16.1

-- Started on 2024-05-21 10:54:00

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
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 4898 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 235 (class 1255 OID 33000)
-- Name: ajout_client(text, text, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajout_client(text, text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '

  declare p_prenom alias for $1;
  declare p_nom alias for $2;
  declare p_tel alias for $3;
  declare p_adresse alias for $4;
  declare id integer;
  declare retour integer;
  
begin
    select into id id_client from client where tel_cli = p_tel;
    if not found
    then
      insert into client (nom_cli, prenom_cli, tel_cli, adresse_cli) values
        (p_nom,p_prenom,p_tel,p_adresse);
      select into id id_client from client where tel_cli = p_tel;
      if not found
      then    
        retour = -1;  --échec de la requête
      else
        retour = 1;   -- insertion ok
      end if;
    else
      retour = 0;      -- déjà en BD
    end if;
 return retour;
 end;

 ';


--
-- TOC entry 230 (class 1255 OID 32999)
-- Name: ajout_client(text, text, text, text, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajout_client(text, text, text, text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '

  declare p_prenom alias for $1;
  declare p_nom alias for $2;
  declare p_tel alias for $3;
  declare p_adresse alias for $4;
  declare id integer;
  declare retour integer;
  
begin
    select into id id_client from client where email = p_email;
    if not found
    then
      insert into client (nom_cli, prenom_cli, tel_cli, adresse_cli) values
        (p_nom,p_prenom,p_tel,p_adresse);
      select into id id_client from client where tel = p_tel;
      if not found
      then    
        retour = -1;  --échec de la requête
      else
        retour = 1;   -- insertion ok
      end if;
    else
      retour = 0;      -- déjà en BD
    end if;
 return retour;
 end;

 ';


--
-- TOC entry 228 (class 1255 OID 16671)
-- Name: delete_client(integer); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.delete_client(integer) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare p_id alias for $1;
	declare retour integer;
	-- declare id integer;
BEGIN
    delete from client where id_client=p_id;
	-- vérifier le delete
	RETURN 1;
END;
';


--
-- TOC entry 229 (class 1255 OID 16672)
-- Name: update_client(integer, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.update_client(integer, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare p_id alias for $1;
	declare p_champ alias for $2;
	declare p_valeur alias for $3;
BEGIN
    EXECUTE format(''UPDATE client SET %I = %L WHERE id_client = %L'', p_champ, p_valeur, p_id);
    -- execute format : utilisé lorsque les champs sont dynamiques
    -- %I : remplace le champ colonne, de manière sécurisée (échappement pour éviter les injections sql)
    -- %I : remplace la valeur, de manière sécurisée
    RETURN 1;
END;
';


--
-- TOC entry 227 (class 1255 OID 16670)
-- Name: verifier_admin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.verifier_admin(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare p_login alias for $1;
	declare p_password alias for $2;
	declare id integer;
	declare retour integer;

begin
	select into id id_admin from admin where login=p_login and password = p_password;
	if not found
	then 
	  retour = 0;
	else
	  retour =1;
	end if;
	return retour;
end;
';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 216 (class 1259 OID 16616)
-- Name: admin; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admin (
    id_admin integer NOT NULL,
    login text,
    password text
);


--
-- TOC entry 215 (class 1259 OID 16615)
-- Name: admin_id_admin_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.admin_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4899 (class 0 OID 0)
-- Dependencies: 215
-- Name: admin_id_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admin_id_admin_seq OWNED BY public.admin.id_admin;


--
-- TOC entry 220 (class 1259 OID 16634)
-- Name: categorie; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.categorie (
    id_cat integer NOT NULL,
    nom_cat text
);


--
-- TOC entry 219 (class 1259 OID 16633)
-- Name: categorie_id_cat_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.categorie_id_cat_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4900 (class 0 OID 0)
-- Dependencies: 219
-- Name: categorie_id_cat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.categorie_id_cat_seq OWNED BY public.categorie.id_cat;


--
-- TOC entry 218 (class 1259 OID 16625)
-- Name: client; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.client (
    id_client integer NOT NULL,
    nom_cli text,
    prenom_cli text,
    tel_cli text,
    adresse_cli text
);


--
-- TOC entry 217 (class 1259 OID 16624)
-- Name: client_id_client_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.client_id_client_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4901 (class 0 OID 0)
-- Dependencies: 217
-- Name: client_id_client_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.client_id_client_seq OWNED BY public.client.id_client;


--
-- TOC entry 222 (class 1259 OID 16643)
-- Name: marque; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.marque (
    id_marque integer NOT NULL,
    nom_marque text,
    image text
);


--
-- TOC entry 221 (class 1259 OID 16642)
-- Name: marque_id_marque_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.marque_id_marque_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4902 (class 0 OID 0)
-- Dependencies: 221
-- Name: marque_id_marque_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.marque_id_marque_seq OWNED BY public.marque.id_marque;


--
-- TOC entry 224 (class 1259 OID 16652)
-- Name: produit; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produit (
    id_produit integer NOT NULL,
    nom_prod text,
    descr_prod text,
    prix numeric(15,2),
    id_marque integer NOT NULL,
    id_cat integer NOT NULL,
    nom_marque text,
    image text
);


--
-- TOC entry 223 (class 1259 OID 16651)
-- Name: produit_id_produit_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produit_id_produit_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4903 (class 0 OID 0)
-- Dependencies: 223
-- Name: produit_id_produit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.produit_id_produit_seq OWNED BY public.produit.id_produit;


--
-- TOC entry 225 (class 1259 OID 24806)
-- Name: vue_produits_cat; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_produits_cat AS
 SELECT categorie.id_cat,
    categorie.nom_cat,
    produit.id_produit,
    produit.nom_prod
   FROM public.categorie,
    public.produit
  WHERE (produit.id_cat = categorie.id_cat);


--
-- TOC entry 226 (class 1259 OID 24810)
-- Name: vue_produits_marque; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_produits_marque AS
 SELECT marque.id_marque,
    marque.nom_marque,
    produit.id_produit,
    produit.nom_prod
   FROM public.marque,
    public.produit
  WHERE (produit.id_marque = marque.id_marque);


--
-- TOC entry 4721 (class 2604 OID 16619)
-- Name: admin id_admin; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);


--
-- TOC entry 4723 (class 2604 OID 16637)
-- Name: categorie id_cat; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorie ALTER COLUMN id_cat SET DEFAULT nextval('public.categorie_id_cat_seq'::regclass);


--
-- TOC entry 4722 (class 2604 OID 16628)
-- Name: client id_client; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client ALTER COLUMN id_client SET DEFAULT nextval('public.client_id_client_seq'::regclass);


--
-- TOC entry 4724 (class 2604 OID 16646)
-- Name: marque id_marque; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.marque ALTER COLUMN id_marque SET DEFAULT nextval('public.marque_id_marque_seq'::regclass);


--
-- TOC entry 4725 (class 2604 OID 16655)
-- Name: produit id_produit; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit ALTER COLUMN id_produit SET DEFAULT nextval('public.produit_id_produit_seq'::regclass);


--
-- TOC entry 4884 (class 0 OID 16616)
-- Dependencies: 216
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admin (id_admin, login, password) VALUES (1, 'selena', 'cookie');
INSERT INTO public.admin (id_admin, login, password) VALUES (2, 'cookie', 'selena');


--
-- TOC entry 4888 (class 0 OID 16634)
-- Dependencies: 220
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.categorie (id_cat, nom_cat) VALUES (1, 'visage');
INSERT INTO public.categorie (id_cat, nom_cat) VALUES (2, 'yeux');
INSERT INTO public.categorie (id_cat, nom_cat) VALUES (3, 'lèvres');


--
-- TOC entry 4886 (class 0 OID 16625)
-- Dependencies: 218
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (1, 'druart', 'antoine', '6515', 'cc');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (2, 'cookie', 'kikou', '2489', 'bjrrrrrr');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (3, 'selena', 'pookie', '123456', 'cc guys');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (5, 'test', 'test', 'test', 'test');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (45, 'salut', 'boubob', NULL, 'cc');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (46, 'salut', 'boubob', NULL, 'cc');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (47, 'chiori', 'chiori', NULL, 'chiori');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (48, 'kokomi', 'kokomi', '35', 'kokomi');
INSERT INTO public.client (id_client, nom_cli, prenom_cli, tel_cli, adresse_cli) VALUES (49, 'bonjourr', 'ccc', '', '');


--
-- TOC entry 4890 (class 0 OID 16643)
-- Dependencies: 222
-- Data for Name: marque; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.marque (id_marque, nom_marque, image) VALUES (1, 'elf', 'https://magees.ie/blog/wp-content/uploads/2018/10/elf-logo.jpg');
INSERT INTO public.marque (id_marque, nom_marque, image) VALUES (2, 'maybelline', 'https://1000logos.net/wp-content/uploads/2020/04/Maybelline-Logo.jpeg');
INSERT INTO public.marque (id_marque, nom_marque, image) VALUES (4, 'catrice', 'https://lofrev.net/wp-content/photos/2017/05/catrice_logo_1.jpg');
INSERT INTO public.marque (id_marque, nom_marque, image) VALUES (5, 'nyx', 'https://nikkmole.com/wp-content/uploads/2017/06/NYX_logo_black-4800x2400.png');
INSERT INTO public.marque (id_marque, nom_marque, image) VALUES (6, 'Essence', 'https://mma.prnewswire.com/media/1420043/essence_cosmetics_Logo.jpg?p=facebook');
INSERT INTO public.marque (id_marque, nom_marque, image) VALUES (3, 'too faced', 'https://logodix.com/logo/984306.jpg');


--
-- TOC entry 4892 (class 0 OID 16652)
-- Dependencies: 224
-- Data for Name: produit; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.produit (id_produit, nom_prod, descr_prod, prix, id_marque, id_cat, nom_marque, image) VALUES (5, 'Eyeliner Epic Ink', 'Eyeliner waterproof longue tenue', 10.95, 5, 2, 'Nyx', 'https://cdn.shopify.com/s/files/1/1164/0668/products/647292f981a348b812536b3a21481813ff5d7534_1024x1024.jpg?v=1614730266');
INSERT INTO public.produit (id_produit, nom_prod, descr_prod, prix, id_marque, id_cat, nom_marque, image) VALUES (6, 'Palette Be My Lover', 'Palette de 8 fards mattes et irisés', 31.00, 2, 2, 'Too Faced', 'https://www.sephora.pl/on/demandware.static/-/Sites-masterCatalog_Sephora/default/dw38c3d180/images/hi-res/alternates/PID_alternate1/PID_alternate1_1111/P10013390_1.jpg');
INSERT INTO public.produit (id_produit, nom_prod, descr_prod, prix, id_marque, id_cat, nom_marque, image) VALUES (4, 'Putty Blush', 'Blush crème, teinte Bora Bora', 7.00, 1, 1, 'Elf', 'https://luxplus.photos/files/uploads/products/67492-elf-putty-blush-bora-bora-10-g-20210902-104816-big-2x.jpg');
INSERT INTO public.produit (id_produit, nom_prod, descr_prod, prix, id_marque, id_cat, nom_marque, image) VALUES (7, 'Blush Baby Got Blush', 'Blush en stick, teinte Tickle Me Pink', 2.99, 6, 1, 'Essence', 'https://www.nobebeauty.fi/tuotekuvat/1200x1200/4059729381019_1.png');
INSERT INTO public.produit (id_produit, nom_prod, descr_prod, prix, id_marque, id_cat, nom_marque, image) VALUES (8, 'Gloss Lip Jam', 'Gloss légèrement teinté, non-collant. Teinte Strawberry.', 3.79, 4, 3, 'Catrice', 'https://cdn.parfumdreams.de/Img/Art/7/Catrice-Lipgloss-Lip-Jam-Hydrating-Lip-Gloss-115331.jpg');


--
-- TOC entry 4904 (class 0 OID 0)
-- Dependencies: 215
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 2, true);


--
-- TOC entry 4905 (class 0 OID 0)
-- Dependencies: 219
-- Name: categorie_id_cat_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.categorie_id_cat_seq', 3, true);


--
-- TOC entry 4906 (class 0 OID 0)
-- Dependencies: 217
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.client_id_client_seq', 49, true);


--
-- TOC entry 4907 (class 0 OID 0)
-- Dependencies: 221
-- Name: marque_id_marque_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.marque_id_marque_seq', 6, true);


--
-- TOC entry 4908 (class 0 OID 0)
-- Dependencies: 223
-- Name: produit_id_produit_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.produit_id_produit_seq', 8, true);


--
-- TOC entry 4727 (class 2606 OID 16623)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4731 (class 2606 OID 16641)
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id_cat);


--
-- TOC entry 4729 (class 2606 OID 16632)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 4733 (class 2606 OID 16650)
-- Name: marque marque_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.marque
    ADD CONSTRAINT marque_pkey PRIMARY KEY (id_marque);


--
-- TOC entry 4735 (class 2606 OID 16659)
-- Name: produit produit_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_pkey PRIMARY KEY (id_produit);


--
-- TOC entry 4736 (class 2606 OID 16665)
-- Name: produit produit_id_cat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_id_cat_fkey FOREIGN KEY (id_cat) REFERENCES public.categorie(id_cat);


--
-- TOC entry 4737 (class 2606 OID 16660)
-- Name: produit produit_id_marque_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_id_marque_fkey FOREIGN KEY (id_marque) REFERENCES public.marque(id_marque);


-- Completed on 2024-05-21 10:54:00

--
-- PostgreSQL database dump complete
--

