SELECT
	a.id,
	a.start_date,
	to_char(a.start_date, 'DD') as date,
	to_char(a.start_date, 'MM') as month,
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
ORDER BY
	a.start_date
;
