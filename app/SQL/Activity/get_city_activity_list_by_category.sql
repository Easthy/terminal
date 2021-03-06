SELECT
	ag.shortname,
	a.id,
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
	public.city_activity a
LEFT JOIN public.city_activity_category ac
ON ac.id = a.category_id
LEFT JOIN public.agency ag
ON ag.id = a.agency_id
WHERE
	a.state = 0
AND a.execution_state = 0
AND ac.id = :category_id
ORDER BY
	a.start_date
;
