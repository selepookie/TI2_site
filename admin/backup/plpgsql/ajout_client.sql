create or replace function ajout_client(text,text,text,text)returns integer
as
'

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

 'language 'plpgsql';