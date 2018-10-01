SELECT
	to_char(a.start_date, 'DD') as date,
	to_char(a.start_date, 'MM') as month,
	a.start_date,
	a.name,
	a.schedule as activity_schedule,
	a.periodicity_id,
	a.category_id,
	ac.image_path as category_image,
	ac.icon_path as category_icon
FROM
	public.activity a
LEFT JOIN public.activity_category ac
ON ac.id=a.category_id
WHERE
	a.state = 0
AND a.execution_state = 0
AND a.agency_id = :agency_id
AND (a.start_date::date) <= public._calc_interval((now() at time zone 'utc'),:interval::varchar)
ORDER BY
	a.start_date
LIMIT :limit
;
