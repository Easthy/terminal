-- One-time activities
SELECT
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
	public.activity a
LEFT JOIN public.activity_category ac
ON ac.id=a.category_id
WHERE
	a.state = 0
AND a.execution_state = 0
AND a.periodicity_id = 1 /* One-time activity */
AND a.agency_id = :agency_id

UNION ALL

/* Periodical activities */
SELECT
	a.id,
	to_char(c.date, 'DD') as date,
	to_char(c.date, 'MM') as month,
	c.date,
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

INNER JOIN public.calendar c
-- Calendar date in the activity date range (from start date to end date)
ON c.date BETWEEN a.start_date AND COALESCE(a.end_date, CURRENT_DATE)
-- Day of week in the activity schedule
AND c.day IN (
	with activity_rows as (
		SELECT 
			json_populate_recordset(NULL :: SCHEDULE, REPLACE(trim(a.schedule::text,'"'), '\"', '"')::json) as schedule
	    FROM
	    	public.activity
	    ORDER BY
	    	id
	),
	b as (
		select 
			schedule::text::schedule as w 
		from 
			activity_rows
	)
	select
		(w).date
	from 
		b
)
WHERE
	a.state = 0
AND a.execution_state = 0
AND a.periodicity_id = 2 /* Periodical activity */
AND a.agency_id = :agency_id
AND c.date BETWEEN CURRENT_DATE AND (CURRENT_DATE + 14)

ORDER BY
	4
LIMIT 
	:limit
;