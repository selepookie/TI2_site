create or replace view public.vue_produits_cat
  as
  select categorie.id_cat,
  categorie.nom_cat,
  produit.id_produit,
  produit.nom_prod
  from categorie, produit
  where produit.id_cat = categorie.id_cat;