SELECT
	ag.id as agency_id,
	a.id,
	to_char(a.start_date, 'DD') as date,
	to_char(a.start_date, 'MM') as month,
	to_char(a.start_date, 'YYYY') as year,
	a.start_date,
	a.name,
	a.schedule as activity_schedule,
	a.periodicity_id,
	a.category_id,
	a.description,
	a.address,
	ac.image_path as category_image,
	ac.name as category_name
FROM
	public.long_life_activity a
LEFT JOIN public.long_life_activity_category ac
ON ac.id=a.category_id
LEFT JOIN public.agency ag
ON ag.id = a.agency_id
WHERE
	a.state = 0
AND a.execution_state = 0
AND a.id = :activity_id
ORDER BY
	a.start_date
;
