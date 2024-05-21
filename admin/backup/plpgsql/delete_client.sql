CREATE OR REPLACE FUNCTION delete_client(int) RETURNS integer AS
'
	declare p_id alias for $1;
	declare retour integer;
	-- declare id integer;
BEGIN
    delete from client where id_client=p_id;
	-- vérifier le delete
	RETURN 1;
END;
' LANGUAGE 'plpgsql';
