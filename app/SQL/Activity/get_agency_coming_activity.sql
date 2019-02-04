SELECT
	id,
	date,
	month,
	start_date,
	name,
	activity_schedule,
	periodicity_id,
	category_id,
	category_image,
	category_icon,
	ag_shortname
FROM
	public.coming_activity
WHERE
	agency_id = :agency_id
AND start_date BETWEEN CURRENT_DATE AND (CURRENT_DATE + 3)

ORDER BY
	4
LIMIT 
	:limit
;