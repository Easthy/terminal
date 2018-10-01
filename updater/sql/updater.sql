BEGIN;

	CREATE TEMP TABLE updater_{table} ( fields jsonb );
	COPY updater_{table} FROM '{updater_json_file}' encoding 'utf-8'
	;

	TRUNCATE {table} CASCADE
	;

	INSERT INTO {table}
	SELECT 
		* 
	FROM 
		jsonb_populate_recordset(
			null::{table}, 
			(SELECT fields FROM updater_{table}) 
		)
	;

END;