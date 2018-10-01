SELECT
	screen_saver.*,
	screen_file.*
FROM
	public.screen_saver
INNER JOIN public.screen_file
ON screen_file.screensaver_id=screen_saver.id
WHERE
	active=true
AND agency_id=:agency_id
;