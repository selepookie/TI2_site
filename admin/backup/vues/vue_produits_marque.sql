create or replace view public.vue_produits_marque
  as
  select marque.id_marque,
  marque.nom_marque,
  produit.id_produit,
  produit.nom_prod
  from marque, produit
  where produit.id_marque = marque.id_marque;